<?php

namespace App\Manager;

use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Client;
use App\Entity\Cart;
use App\Entity\User;
use App\Entity\Orders;


class OrderManager
{
    protected $entityManager;

    public function __construct(ObjectManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function create(Client $client, User $user = null, Cart $cart)
    {

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
        $this->entityManager->persist($order);

        //Changing the status of the cart 
        $cart->setIsOrder(true);

        $this->entityManager->flush();
        return $order;
    }
}
