<?php

namespace App\Manager;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\OrderProduct;
use App\Entity\Cart;
use App\Repository\OrderProductRepository;

class CartManager
{

    public function __construct(ObjectManager $entityManager, OrderProductRepository $orderProductRepository)
    {
        $this->entityManager = $entityManager;
        $this->orderProductRepository = $orderProductRepository;
    }    

    public function updateQuantityCart(OrderProduct $orderProduct, $newQuantityOrderProduct, $unitPrice)
    {
      
         //updating price and total amount in the cart
        $amountUpdated = $newQuantityOrderProduct * $unitPrice;

      
// get all others OrderProduct in the cart to update correctly the totalAmount
        $cart = new Cart();
        $cart = $orderProduct->getCart();

        $allOtherOrderProducts = $this->orderProductRepository->findByCartExceptOne($cart, $orderProduct);
     
        $othersOrderProductTotalAmount = 0;
        foreach ($allOtherOrderProducts as $otherOrderProduct) {
            $othersOrderProductTotalAmount += $otherOrderProduct->getPrice();
        }
     
        $totalAmountUpdated = $othersOrderProductTotalAmount + $amountUpdated;

       //updating OrderProduct
        $orderProduct->setPrice($amountUpdated);
        $orderProduct->setQuantity($newQuantityOrderProduct);
       
        $this->entityManager->persist($orderProduct);
       
        //updating the cart's total amount 
        $cart->setTotalAmount($totalAmountUpdated);
        $this->entityManager->persist($cart);
        $this->entityManager->flush();

    }
}
