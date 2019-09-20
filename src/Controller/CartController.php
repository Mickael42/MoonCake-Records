<?php

namespace App\Controller;

use DateTime;
use App\Entity\Cart;
use App\Entity\User;
use App\Entity\Client;
use App\Form\CartType;
use App\Form\ClientType;
use App\Entity\OrderProduct;
use App\Entity\Orders;
use App\Repository\CartRepository;
use App\Repository\ClientRepository;
use App\Repository\OrderProductRepository;
use App\Repository\VinylRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/panier")
 */
class CartController extends AbstractController
{
    /**
     * @Route("/", name="cart_index", methods={"GET"})
     */
    public function index(UserInterface $user = null, CartRepository $cartRepository, VinylRepository $vinylRepository, Request $request): Response
    {

        //If a customer is logged, we get the cart id store in database
        //Also the get the genre Id of the first vinyl in cart and the show vinyls related 
        if ($user) {
            $cart = $cartRepository->findOneBy(['user' => $user, 'isOrder' => '0']);

            if (!$cart) {
                $vinylsListMayInterested = $vinylRepository->findByLastVinyls(4);
            } else {
                $idGenreFirstVinylSelected = $cart->getOrderProducts()[0]->getVinyl()->getGenre();
                $vinylsListMayInterested = $vinylRepository->findByRelatedVinyls($idGenreFirstVinylSelected);
            };
            return $this->render('cart/index.html.twig', [
                'cart' => $cart,
                'vinyls' => $vinylsListMayInterested,

            ]);


            //If the customer is not logged, we get data of cart stored inside a cookie
            //Also the get the genre Id of the first vinyl in cart and the show vinyls related 
        } else {
            $idCartDecoded = base64_decode($request->cookies->get('id'));
            $cart = $cartRepository->find($idCartDecoded);

            if (!$cart) {
                $vinylsListMayInterested = $vinylRepository->findByLastVinyls(4);
            } else {
                //If the customer delete his cart, we show to him the last vinyls
                $idGenreFirstVinylSelected = $cart->getOrderProducts()[0]->getVinyl()->getGenre();
                $vinylsListMayInterested = $vinylRepository->findByRelatedVinyls($idGenreFirstVinylSelected);
            };

            return $this->render('cart/index.html.twig', [
                'cart' => $cart,
                'vinyls' => $vinylsListMayInterested,

            ]);
        }

        return $this->render('cart/index.html.twig', [
            'cart' => $cart,
            'vinyls' => $vinylRepository->findByLastVinyls(4),

        ]);
    }

    /**
     * @Route("/new", name="cart_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $cart = new Cart();
        $form = $this->createForm(CartType::class, $cart);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cart);
            $entityManager->flush();

            return $this->redirectToRoute('cart_index');
        }

        return $this->render('cart/new.html.twig', [
            'cart' => $cart,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cart_show", methods={"GET","POST"})
     */
    public function show(Request $request, Cart $cart, OrderProductRepository $orderProductRepository, Client $client = null, UserInterface $user = null, ClientRepository $clientRepository): Response
    {
        if ($user) {
            //We check if the user connected have already client data
            $client = $clientRepository->findOneBy(['user' => $user]);
            if ($client) {
                $form = $this->createForm(ClientType::class, $client);
            } else {
                //If the user doesn't have client data
                $client = new Client();
                $form = $this->createForm(ClientType::class, $client);
            }
        } else {
            //if the customer is not register in the database
            $client = new Client();
            $form = $this->createForm(ClientType::class, $client);
        }

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($client);
            if ($user) {
                $client->setUser($user);
            }

            //Creating an order
            $order = new Orders;
            $order->setClient($client);
            $order->setOrderDate(new \DateTime());
            $order->setPaymentMethod('unknow');
            $order->setStatus("unpaid");
            if ($user) {
                $order->setUser($user);
            }

            $order->setTotalAmount($cart->getTotalAmount());
            $order->setCart($cart);
            $entityManager->persist($order);

            //Changing the status of the cart and cleaning the cookie
            $cart->setIsOrder(true);


            //Deleting in the database all products selected and link to the cart
            $arrayOfOrderProduct = $orderProductRepository->findByCart($cart);
            foreach ($arrayOfOrderProduct as $orderProduct) {
                $cart->removeOrderProduct($orderProduct);
            }
            $entityManager->flush();

            return $this->redirectToRoute('payment', ["id" => $order->getId()]);
        }



        return $this->render('cart/show.html.twig', [
            'cart' => $cart,
            'formClient' => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}/edit", name="cart_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Cart $cart): Response
    {
        $form = $this->createForm(CartType::class, $cart);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('cart_index');
        }

        return $this->render('cart/edit.html.twig', [
            'cart' => $cart,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cart_deleteCart", methods={"DELETE"})
     */
    public function deleteCart(Request $request, Cart $cart): Response
    {
        if ($this->isCsrfTokenValid('delete' . $cart->getId(), $request->request->get('_token'))) {

            $response = new Response();
            $response->headers->clearCookie("id");
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($cart);
            $entityManager->flush();
        }

        return $this->redirectToRoute('cart_index');
    }
}
