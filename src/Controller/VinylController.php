<?php

namespace App\Controller;

use App\Entity\Cart;
use App\Entity\OrderProduct;
use App\Entity\Vinyl;
use App\Form\VinylType;
use App\Repository\CartRepository;
use App\Repository\GenreRepository;
use App\Repository\OrderProductRepository;
use App\Repository\TrackRepository;
use App\Repository\VinylRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/vinyl")
 */
class VinylController extends AbstractController
{
    /**
     * @Route("/", name="vinyl_index", methods={"GET"})
     */
    public function index(VinylRepository $vinylRepository, GenreRepository $genreRepository): Response
    {



        return $this->render('vinyl/index.html.twig', [
            'vinyls' => $vinylRepository->findAll(),
            'genres' => $genreRepository->findAll()
        ]);
    }

    /**
     * @Route("/promo", name="vinyl_promo", methods={"GET"})
     */
    public function promo(VinylRepository $vinylRepository): Response
    {
        return $this->render('vinyl/promo.html.twig', [
            'vinyls' => $vinylRepository->findAllVinylPromo(),
        ]);
    }

    /**
     * @Route("/new", name="vinyl_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $vinyl = new Vinyl();
        $form = $this->createForm(VinylType::class, $vinyl);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($vinyl);
            $entityManager->flush();

            return $this->redirectToRoute('vinyl_index');
        }

        return $this->render('vinyl/new.html.twig', [
            'vinyl' => $vinyl,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="vinyl_show", methods={"GET","POST"})
     */
    public function show(Vinyl $vinyl, TrackRepository $trackRepository, VinylRepository $vinylRepository, CartRepository $cartRepository, OrderProductRepository $orderProductRepository, Request $request): Response
    {
        $vinylGenre = $vinyl->getGenre();
        $vinylRelated = $vinylRepository->findBy(array('genre' => $vinylGenre));

        //get all the tracks related to the vinyl
        $vinylId = $vinyl->getId();
        $tracks = $trackRepository->findBy(array('vinyl' => $vinylId));


        //if the customer click on 'add to cart', we create a new entry in OrderProduct and a new Cart
        if ($request->request->get('vinylSelected')) {

            // we check if the vinyl as a discount and we store the price
            $vinylPrice = 0;
            if ($vinyl->getReducePrice() > 0) {
                $vinylPrice = $vinyl->getReducePrice();
            } else {
                $vinylPrice = $vinyl->getRegularPrice();
            }

            // we check if the customer have already an cart in progress
            $cartInProgress = $cartRepository->findOneBy(['ipAddress' => $request->server->get('REMOTE_ADDR')]);

            if ($cartInProgress) {
                // we check if the cart in progress doesn't have already the product selected
                $cartWithProductAlreadySelected = $orderProductRepository->findOneBy(['cart' => $cartInProgress, 'vinyl' => $vinyl]);
                if ($cartWithProductAlreadySelected) {
                    $this->addFlash(
                        'notice',
                        'Le vinyle est déjà dans votre panier!'
                    );
                    return $this->render('vinyl/show.html.twig', [
                        'vinyl' => $vinyl,
                        'tracks' => $tracks,
                        'relatedVinyls' => $vinylRelated
                    ]);
                }

                //calculating the new ammount of the cart
                $newAmmount = $cartInProgress->getTotalAmount() + $vinylPrice;
                $cartInProgress->setTotalAmount($newAmmount);
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($cartInProgress);

                //creating a new order Product 
                $orderProduct = new OrderProduct();
                $orderProduct->setVinyl($vinyl);
                $orderProduct->setCart($cartInProgress);
                $orderProduct->setPrice($vinylPrice);
                $orderProduct->setQuantity(1);
                $entityManager->persist($orderProduct);
                $entityManager->flush();

                $this->addFlash(
                    'notice',
                    'Le vinyle a bien été ajouté au panier!'
                );

                return $this->render('vinyl/show.html.twig', [
                    'vinyl' => $vinyl,
                    'tracks' => $tracks,
                    'relatedVinyls' => $vinylRelated
                ]);
            }

            //creating a new Cart
            $cart = new Cart;
            $cart->setIpAddress($request->server->get('REMOTE_ADDR'));
            $cart->setTotalAmount($vinylPrice);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cart);

            //creating a new Order Product
            $orderProduct = new OrderProduct();
            $orderProduct->setVinyl($vinyl);
            $orderProduct->setCart($cart);
            $orderProduct->setPrice($vinylPrice);
            $orderProduct->setQuantity(1);
            $entityManager->persist($orderProduct);
            $entityManager->flush();
            $this->addFlash(
                'notice',
                'Le vinyle a bien été ajouté au panier!'
            );
        }

        return $this->render('vinyl/show.html.twig', [
            'vinyl' => $vinyl,
            'tracks' => $tracks,
            'relatedVinyls' => $vinylRelated
        ]);
    }

    /**
     * @Route("/{id}/edit", name="vinyl_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Vinyl $vinyl): Response
    {
        $form = $this->createForm(VinylType::class, $vinyl);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('vinyl_index');
        }

        return $this->render('vinyl/edit.html.twig', [
            'vinyl' => $vinyl,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="vinyl_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Vinyl $vinyl): Response
    {
        if ($this->isCsrfTokenValid('delete' . $vinyl->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($vinyl);
            $entityManager->flush();
        }

        return $this->redirectToRoute('vinyl_index');
    }
}
