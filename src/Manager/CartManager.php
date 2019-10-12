<?php

namespace App\Manager;

use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\OrderProduct;
use App\Entity\Cart;
use App\Entity\User;
use App\Repository\OrderProductRepository;
use App\Repository\VinylRepository;
use App\Repository\CartRepository;

class CartManager
{

    public function __construct(ObjectManager $entityManager, OrderProductRepository $orderProductRepository, VinylRepository $vinylRepository, CartRepository $cartRepository)
    {
        $this->entityManager = $entityManager;
        $this->orderProductRepository = $orderProductRepository;
        $this->vinylRepository = $vinylRepository;
        $this->cartRepository = $cartRepository;
    }

    public function createInitialCart(User $user = null, $unitPrice)
    {
        $cart = new Cart;
        $cart->setIsOrder(false);
        //if the client is logged, we save the data in the data base
        if ($user) {
            $cart->setUser($user);
        }
        $cart->setTotalAmount($unitPrice);
        $this->entityManager->persist($cart);

        return $cart;
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

    public function showQuantityTotal($cart)
    {
        $listOrderProduct = $this->orderProductRepository->findBy(['cart' => $cart]);
        $quantityOrder = 0;
        foreach ($listOrderProduct as $orderProduct) {
            $quantityOrder += $orderProduct->getQuantity();
        }
        return $quantityOrder;
    }

    public function showCart($user, $dataStoredInCookie)
    {
        //if a user if logged, first we check if he has a cart in progress stored in database
        if ($user) {
            $cart = $this->cartRepository->findOneBy(['user' => $user, 'isOrder' => '0']);
            if ($cart) {
                $idGenreFirstVinylSelected = $cart->getOrderProducts()[0]->getVinyl()->getGenre();
                $vinylsListMayInterested = $this->vinylRepository->findByRelatedVinyls($idGenreFirstVinylSelected);
            } else {
                //if not, we check if the user has a cart stored in a cookie
                $cart = $this->cartRepository->find($dataStoredInCookie);
                if ($cart) {
                    $idGenreFirstVinylSelected = $cart->getOrderProducts()[0]->getVinyl()->getGenre();
                    $vinylsListMayInterested = $this->vinylRepository->findByRelatedVinyls($idGenreFirstVinylSelected);
                } else {
                    $vinylsListMayInterested = $this->vinylRepository->findByLastVinyls(4);
                }
            }
        } else {
            //if the visitor is not logged, we check if a cart is stored in a cookie
            $cart = $this->cartRepository->find($dataStoredInCookie);
            if ($cart) {
                $cart = $this->cartRepository->find($dataStoredInCookie);
                $idGenreFirstVinylSelected = $cart->getOrderProducts()[0]->getVinyl()->getGenre();
                $vinylsListMayInterested = $this->vinylRepository->findByRelatedVinyls($idGenreFirstVinylSelected);
            } else {
                $vinylsListMayInterested = $this->vinylRepository->findByLastVinyls(4);
            };
        }
        return [$cart, $vinylsListMayInterested];
    }

    public function persistingUpdateTotalAmount($cart, $vinylPrice)
    {
        $newAmmount = $cart->getTotalAmount() + $vinylPrice;
        $cart->setTotalAmount($newAmmount);
        $this->entityManager->persist($cart);
    }
}
