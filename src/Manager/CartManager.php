<?php

namespace App\Manager;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\OrderProduct;
use App\Entity\Cart;

class CartManager
{

    public function __construct(ObjectManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }    

    public function updateQuantityCart(OrderProduct $orderProduct, $quantityWanted, $unitPrice)
    {
        $initialQuantityOrder = $orderProduct->getQuantity();
        $newQuantityOrder = $quantityWanted += $initialQuantityOrder;

         //updating price and total amount in the cart
        $amountUpdated = $newQuantityOrder * $unitPrice;
        $previousTotalAmount = $orderProduct->getCart()->getTotalAmount();
        $totalAmountUpdated = $previousTotalAmount += $amountUpdated;

       //updating OrderProduct
        $orderProduct->setPrice($amountUpdated);
        $orderProduct->setQuantity($newQuantityOrder);
        $this->entityManager->persist($orderProduct);

        //updating the cart's total amount 
        $cart = new Cart();
        $cart = $orderProduct->getCart();
        $cart->setTotalAmount($totalAmountUpdated);
        $this->entityManager->persist($cart);
        $this->entityManager->flush();


    }
}
