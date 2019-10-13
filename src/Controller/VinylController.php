<?php

namespace App\Controller;


use App\Entity\Vinyl;
use App\Form\VinylType;
use App\Manager\CartManager;
use App\Manager\OrderProductManager;
use App\Manager\SessionManager;
use App\Manager\VinylManager;
use App\Repository\CartRepository;
use App\Repository\GenreRepository;
use App\Repository\TrackRepository;
use App\Repository\VinylRepository;
use App\Repository\OrderProductRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @Route("/vinyl")
 */
class VinylController extends AbstractController
{
    /**
     * @Route("/", name="vinyl_index", methods={"GET"})
     */
    public function index(VinylRepository $vinylRepository, PaginatorInterface $paginator, GenreRepository $genreRepository, Request $request): Response
    {

        //we show vinyls by genres
        if ($request->query->get('genre')) {
            $idGenre = $request->query->get('genre');
            $vinylsFiltredByGenre = $paginator->paginate(
                $vinylRepository->finByGenreQuery($idGenre),
                $request->query->getInt('page', 1),
                8
            );
            return $this->render('vinyl/index.html.twig', [
                'vinyls' => $vinylsFiltredByGenre,
                'genres' => $genreRepository->findAll()
            ]);

        };
        $allvinyls = $paginator->paginate(
            $vinylRepository->findAllQuery(),
            $request->query->getInt('page', 1),
            8
        );
        $numberAllVinyls = $allvinyls->getTotalItemCount();
        return $this->render('vinyl/index.html.twig', [
            'vinyls' => $allvinyls,
            'numberAllVinyls'=>$numberAllVinyls,
            'genres' => $genreRepository->findAll()
        ]);
    }

    /**
     * @Route("/promo", name="vinyl_promo", methods={"GET"})
     */
    public function promo(VinylRepository $vinylRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $vinylsPromo = $paginator->paginate(
            $vinylRepository->findAllVinylPromoQuery(),
            $request->query->getInt('page', 1),
            8
    );
        return $this->render('vinyl/promo.html.twig', [
            'vinyls' => $vinylsPromo,
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
    public function show(SessionManager $sessionManager ,UserInterface $user = null, Vinyl $vinyl, TrackRepository $trackRepository, VinylRepository $vinylRepository, CartRepository $cartRepository, OrderProductRepository $orderProductRepository, Request $request, VinylManager $vinylManager, OrderProductManager $orderProductManager, CartManager $cartManager): Response
    {
        $vinylRelated = $vinylRepository->findByRelatedVinyls($vinyl->getGenre()->getId());

        //get all the tracks related to the vinyl
        $vinylId = $vinyl->getId();
        $tracks = $trackRepository->findBy(array('vinyl' => $vinylId));

        //if the customer click on 'add to cart', we create a new entry in OrderProduct and a new Cart
        if ($request->request->get('vinylSelected')) {

            // we check if the vinyl as a discount and we store the price
            $vinylPrice = $vinylManager->getUnitPrice($vinyl);

            // we check if the customer have already an cart in progress (id stored in the session)
            $cartInProgress = $cartRepository->find($sessionManager->getCartSession());

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
                $cartManager->persistingUpdateTotalAmount($cartInProgress, $vinylPrice);

                //creating a new order Product 
                $orderProductManager->createOrderProduct($vinyl, $cartInProgress,$vinylPrice);
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
            $cart = $cartManager->createInitialCart($user, $vinylPrice);

            //creating a new Order Product
            $orderProductManager->createOrderProduct($vinyl, $cart,$vinylPrice);

            //We save the cart Id in the session
           $sessionManager->create($cart->getId());
            $this->addFlash(
                'notice',
                'Le vinyle a bien été ajouté au panier!'
            );
        }

        return  $this->render('vinyl/show.html.twig', [
            'vinyl' => $vinyl,
            'tracks' => $tracks,
            'relatedVinyls' => $vinylRelated
        ]);
    }
}
