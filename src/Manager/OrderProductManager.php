<?php

namespace App\Manager;

use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\OrderProduct;
use App\Entity\Vinyl;
use App\Repository\OrderProductRepository;


class OrderProductManager
{

    public function __construct(ObjectManager $entityManager, OrderProductRepository $orderProductRepository)
    {
        $this->entityManager = $entityManager;
        $this->orderProductRepository = $orderProductRepository;
    }

    public function createOrderProduct(Vinyl $vinyl, $cart, $unitPrice)
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
