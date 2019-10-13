<?php

namespace App\Manager;

use App\Entity\Cart;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\OrderProduct;
use App\Entity\Vinyl;
use App\Repository\OrderProductRepository;


class OrderProductManager
{
    protected $entityManager;
    protected $orderProductRepository;

    public function __construct(ObjectManager $entityManager, OrderProductRepository $orderProductRepository)
    {
        $this->entityManager = $entityManager;
        $this->orderProductRepository = $orderProductRepository;
    }

    public function createOrderProduct(Vinyl $vinyl, Cart $cart, int $unitPrice)
    {
        $orderProduct = new OrderProduct();
        $orderProduct->setVinyl($vinyl);
        $orderProduct->setCart($cart);
        $orderProduct->setPrice($unitPrice);
        $orderProduct->setQuantity(1);
        $this->entityManager->persist($orderProduct);
        $this->entityManager->flush();
    }
}
