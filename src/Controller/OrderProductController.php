<?php

namespace App\Controller;

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
    public function deleteOrderProduct(Request $request, OrderProductRepository $orderProductRepository): Response
    {

        $idOrderProduct = $request->request->get('_idOrderProduct');
        dump($idOrderProduct);
        $orderProductToDelete = $orderProductRepository->findOneBy(array('id' => $idOrderProduct));


        if ($this->isCsrfTokenValid('delete' . $orderProductToDelete->getId(), $request->request->get('_tokenOrderProduct'))) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($orderProductToDelete);
            $entityManager->flush();
        }

        return $this->redirectToRoute('cart_index');
    }
}
