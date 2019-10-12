<?php

namespace App\Controller;

use App\Entity\Orders;
use App\Entity\Vinyl;
use App\Repository\OrderProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PaymentController extends AbstractController
{
    /**
     * @Route("/paiement/{id}", name="payment", methods={"POST", "GET"})
     */
    public function paymentForm(Orders $order, Request $request)
    {
        //deleting the cookie who stores data about the cart
        $response = new Response();
        $response->headers->clearCookie("id");

        $amount = $order->getTotalAmount() * 100;

        \Stripe\Stripe::setApiKey('sk_test_bfHv9DFUb0tj17UHOsD63dks00IUrgmQ30');

        $intent = \Stripe\PaymentIntent::create([
            'amount' => $amount,
            'currency' => 'eur',
            'payment_method_types' => ['card'],
            'metadata' => ['order_id' => $order->getId()],
        ]);

        $charges = \Stripe\Charge::all([
            'payment_intent' => '{{PAYMENT_INTENT_ID}}',
            // Limit the number of objects to return (the default is 10)
            'limit' => 3,
        ]);

        $checkbox = $request->request->get('check');
        $nameCartHolder = $request->request->get('cartHolder');

        if (!empty($checkbox) and !empty($nameCartHolder)) {
            $entityManager = $this->getDoctrine()->getManager();
            $order->setStatus("paid");
            $entityManager->persist($order);
            $entityManager->flush();

            return $this->redirectToRoute('payment_confirmation', [
                'id' => $order->getId()
            ]);
        }

        return $this->render('payment/index.html.twig', [
            'controller_name' => 'PaymentController',
            'order' => $order,
            'clientPayment' => $intent->client_secret
        ], $response);
    }


    /**
     * @Route("/confirmation/{id}", name="payment_confirmation", methods={"POST", "GET"})
     */
    public function paymentConfirmation(Orders $order, Request $request, OrderProductRepository $orderProductRepository)
    {
        $cart = $order->getCart();
        $entityManager = $this->getDoctrine()->getManager();


        //Deleting in the database all products selected and link to the cart
        //also updating the available quantity stock for each purchased vinyl 


        $arrayOfOrderProduct = $orderProductRepository->findByCart($cart);
        foreach ($arrayOfOrderProduct as $orderProduct) {
            $quantityOrder = $orderProduct->getQuantity();
            $vinyl = new Vinyl();
            $vinyl = $orderProduct->getVinyl();
            $quantityVinylStock = $vinyl->getQuantityStock();
            $newQuantityStock = $quantityVinylStock - $quantityOrder;
            $vinyl->setQuantityStock($newQuantityStock);
            $cart->removeOrderProduct($orderProduct);
        }

        $entityManager->flush();


        return $this->render('payment/confirmation.html.twig');
    }
}
