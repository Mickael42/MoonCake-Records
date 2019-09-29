<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\ClientType;
use App\Repository\ClientRepository;
use App\Repository\OrdersRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/espace-client")
 */
class ClientController extends AbstractController
{
    /**
     * @Route("/", name="client_index")
     */
    public function clientIndex(UserInterface $user, Request $request, ClientRepository $clientRepository, OrdersRepository $ordersRepository): Response
    {
        $idUser = $user->getId();
        $client = $clientRepository->findOneBy(['user' => $user]);


        //checking if the the user have already client data
        if (! $client) {
            $client = new Client();
            $form = $this->createForm(ClientType::class, $client);
        } else {
            $form = $this->createForm(ClientType::class, $client);
        }

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $client->setUser($user);
            $entityManager->persist($client);
            $entityManager->flush();
            $this->addFlash(
                'notice',
                'Vos informations ont été mises à jour!');

            return $this->redirectToRoute('client_index');
        }


        $clientOrders = $ordersRepository->findBy(['user' => $idUser], ['orderDate' => 'DESC']);
        return $this->render('client/index.html.twig', [
            'clientOrders' => $clientOrders,
            'form' => $form->createView(),
        ]);
    }
}
