<?php

namespace App\Controller;

use App\Entity\Cart;
use App\Repository\OrderProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OrderProductController extends AbstractController
{
    /**
     * @Route("/{id}", name="cart_deleteOrderProduct", methods={"DELETE"})
     */
    public function deleteOrderProduct(Request $request, Cart $cart, OrderProductRepository $orderProductRepository): Response
    {

        $idOrderProduct = $request->request->get('_idOrderProduct');
        $orderProductToDelete = $orderProductRepository->findOneBy(array('id' => $idOrderProduct));


        if ($this->isCsrfTokenValid('delete' . $orderProductToDelete->getId(), $request->request->get('_tokenOrderProduct'))) {

            //We have to change the cart's bill
            $amountToRemove = $orderProductToDelete->getPrice();
            $newAmmount = $cart->getTotalAmount() - $amountToRemove;
            $cart->setTotalAmount($newAmmount);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cart);

            $entityManager->remove($orderProductToDelete);
            $entityManager->flush();
            
            //We check if the cart contians at least one product
            //If not, we remove the cart
            $numberOrderProductsInCart = $cart->getOrderProducts()->getKeys();
            if (empty($numberOrderProductsInCart)) {
                $entityManager->remove($cart);
                $entityManager->flush();
            }
        }

        return $this->redirectToRoute('cart_index');
    }
}
