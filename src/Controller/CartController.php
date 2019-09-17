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
        //We get the id of the cart stored in the cookie
        if ($user) {
            $cart = $cartRepository->findOneBy(['user' => $user, 'isOrder' => '0']);
        } else {
            $idCartDecoded = base64_decode($request->cookies->get('id'));
            $cart = $cartRepository->find($idCartDecoded);
        }

        return $this->render('cart/index.html.twig', [
            'cart' => $cart,
            'vinyls' => $vinylRepository->findAll(),

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
    public function show(Request $request, Cart $cart, OrderProductRepository $orderProductRepository, Client $client = null, UserInterface $user = null): Response
    {
        
        if (!$client) {
            $client = new Client();
        }

        $form = $this->createForm(ClientType::class, $client);
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

            return $this->redirectToRoute('payment',["id"=>$order->getId()]);
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

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($cart);
            $entityManager->flush();
        }

        return $this->redirectToRoute('cart_index');
    }
}
