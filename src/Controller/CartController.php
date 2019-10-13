<?php

namespace App\Controller;

use App\Entity\Cart;
use App\Entity\Client;
use App\Form\ClientType;
use App\Entity\OrderProduct;
use App\Entity\Orders;
use App\Repository\ClientRepository;
use App\Manager\CartManager;
use App\Manager\SessionManager;
use App\Manager\VinylManager;
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
    public function index(UserInterface $user = null, SessionManager $sessionManager, CartManager $cartManager): Response
    {
      
        //we use the showCart() method of the CartMAnager to the show the cart in Progress depending if it is stored in the database or in the session
        $arrayCartData = $cartManager->showCart($user, $sessionManager->getCartSession());

        //getting total number of vinyls in the cart using CartManger
        $quantityOrder = $cartManager->showQuantityTotal($arrayCartData[0]);

        return $this->render('cart/index.html.twig', [
            'cart' => $arrayCartData[0],
            'totalQuantityVinylOrder' => $quantityOrder,
            'vinyls' => $arrayCartData[1],
        ]);
    }
    /**
     * @Route("/updateQuantityCart/{id}", name="updating_quantity_order", methods={"GET","POST"})
     */

    public function updateQuantityCart(Request $request, VinylManager $vinylManager, OrderProduct $orderProduct, CartManager $cartManager): Response
    {
        $quantityWanted = $request->request->get('quantity');
        $newQuantityOrderProduct = $quantityWanted += $orderProduct->getQuantity();

        //checking the unit price to choose (reduce or regular price)
        $unitPrice = $vinylManager->getUnitPrice($orderProduct->getVinyl());

        $quantityStockVinyl = $orderProduct->getVinyl()->getQuantityStock();
        if ($newQuantityOrderProduct <= $quantityStockVinyl) {
            //calling the CartManager to update the quantity cart
            $cartManager->updateQuantityCart($orderProduct, $newQuantityOrderProduct, $unitPrice);
        }
        return $this->redirectToRoute('cart_index');
    }

    /**
     * @Route("/{id}", name="cart_show", methods={"GET","POST"})
     */
    public function show(Request $request, Cart $cart, CartManager $cartManager, Client $client = null, UserInterface $user = null, ClientRepository $clientRepository): Response
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

            $entityManager->flush();
            return $this->redirectToRoute('payment', ["id" => $order->getId()]);
        }

        //getting total number of vinyls in the cart using CartManger
        $quantityOrder = $cartManager->showQuantityTotal($cart);

        return $this->render('cart/show.html.twig', [
            'cart' => $cart,
            'totalQuantityVinylOrder' => $quantityOrder,
            'formClient' => $form->createView(),

        ]);
    }

    /**
     * @Route("/{id}", name="cart_deleteCart", methods={"DELETE"})
     */
    public function deleteCart(Request $request, Cart $cart, SessionManager $sessionManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $cart->getId(), $request->request->get('_token'))) {
            //delete the cart data stored in the session
            $sessionManager->delete();
             //delete the cart data stored in the database
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($cart);
            $entityManager->flush();
        }
        return $this->redirectToRoute('cart_index');
    }
}
