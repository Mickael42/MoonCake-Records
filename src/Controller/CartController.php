<?php

namespace App\Controller;

use App\Entity\Cart;
use App\Entity\Client;
use App\Form\CartType;
use App\Form\ClientType;
use App\Repository\CartRepository;
use App\Repository\OrderProductRepository;
use App\Repository\VinylRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/panier")
 */
class CartController extends AbstractController
{
    /**
     * @Route("/", name="cart_index", methods={"GET"})
     */
    public function index(CartRepository $cartRepository, VinylRepository $vinylRepository, Request $request): Response
    {
        $clientIpAddress = $request->server->get('REMOTE_ADDR');
        $cart = $cartRepository->findOneBy(array('ipAddress' => $clientIpAddress));
       


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
    public function show(Request $request, Cart $cart, Client $client = null): Response
    {
        if (!$client) {
            $client = new Client();
        }

        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);
        

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($client);

            //We bind the client and the cart
            $cart->setClient($client);
            $entityManager->flush();

            return $this->render('cart/show.html.twig', [
                'cart' => $cart,
                'formClient' => $form->createView()
            ]);
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
     * @Route("/{id}", name="cart_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Cart $cart): Response
    {
        if ($this->isCsrfTokenValid('delete' . $cart->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($cart);
            $entityManager->flush();
        }

        return $this->redirectToRoute('cart_index');
    }
}
