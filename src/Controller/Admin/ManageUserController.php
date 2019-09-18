<?php

namespace App\Controller\Admin;


use App\Repository\ClientRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/**
 * @Route("/admin/gestion-utilisateurs")
 */
class ManageUserController extends AbstractController
{

    /**
     * @Route("/liste-clients", name="customer_list", methods={"GET","POST"})
     */
    public function listUser(ClientRepository $clientRepository): Response
    {
        
        return $this->render('admin/manageCustomer/listCustomer.html.twig', [
            'customers' => $clientRepository->findAll(),
    
        ]);
    }

}
