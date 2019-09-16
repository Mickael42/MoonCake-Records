<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PaymentController extends AbstractController
{
    /**
     * @Route("/paiement", name="payment")
     */
    public function paymentForm(Request $request)
    {   
        //deleting the cookie who stores data about the cart
        $response = new Response();
        $response->headers->clearCookie("id");
        



        return $this->render('payment/index.html.twig', [
            'controller_name' => 'PaymentController',
        ], $response);
    }
}
