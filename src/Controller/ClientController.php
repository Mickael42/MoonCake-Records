<?php

namespace App\Controller;

use App\Repository\ClientRepository;
use App\Repository\OrdersRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @Route("/espace-client")
 */
class ClientController extends AbstractController
{
    /**
     * @Route("/", name="client_index")
     */
    public function clientIndex(UserInterface $user, ClientRepository $clientRepository, OrdersRepository $ordersRepository): Response
    {
        $idUser = $user->getId();
        $clientOrders = $ordersRepository->findBy(['client'=> $idUser], ['orderDate' =>'DESC']);
        return $this->render('client/index.html.twig', [
            'clientOrders'=>$clientOrders
        ]);
    }
}
