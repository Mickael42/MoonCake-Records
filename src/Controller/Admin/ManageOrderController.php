<?php

namespace App\Controller\Admin;


use App\Repository\ClientRepository;
use App\Repository\OrdersRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/**
 * @Route("/admin/gestion-commandes")
 */
class ManageOrderController extends AbstractController
{

    /**
     * @Route("/liste-commandes", name="list_order", methods={"GET","POST"})
     */
    public function listOrder(OrdersRepository $ordersRepository): Response
    {
        
        return $this->render('admin/manageOrder/listOrder.html.twig', [
            'orders' => $ordersRepository->findAll(),
    
        ]);
    }

}
