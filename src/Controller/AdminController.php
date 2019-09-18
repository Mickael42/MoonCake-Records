<?php

namespace App\Controller;

use App\Entity\Vinyl;
use App\Entity\Orders;
use App\Form\VinylType;
use App\Repository\UserRepository;

use App\Repository\VinylRepository;
use App\Repository\OrdersRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/**
 * @Route("/admin")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/", name="admin")
     */
    public function index(OrdersRepository $ordersRepository, UserRepository $userRepository, VinylRepository $vinylRepository)
    {

        //getting the sales revenus of the web store
        $listOrdersPaid = $ordersRepository->findAllStatus('paid');
        $salesRevenue = 0;
        foreach ($listOrdersPaid as $order) {
            $salesRevenue = $salesRevenue + $order->getTotalAmount();
        }

        $numberOfOrders = $ordersRepository->findAll();
        $numberOfUsers = $userRepository->findAll();
        $numberOfVinyls = $vinylRepository->findAll();

        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
            'salesRevenue' => $salesRevenue,
            'numberOfUsers' => count($numberOfUsers),
            'numberOfVinyls' => count($numberOfVinyls),
            'numberOfOrders' => count($numberOfOrders),
        ]);
    }

    /**
     * @Route("/ajout-produit", name="add_product", methods={"GET","POST"})
     */
    public function addProduct(Request $request)
    {
        $vinyl = new Vinyl();
        $form = $this->createForm(VinylType::class, $vinyl);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($vinyl);
            $entityManager->flush();

            return $this->render('admin/manageProduct/addProduct.html.twig', [
                'vinyl' => $vinyl,
                'form' => $form->createView(),
            ]);
        }

        return $this->render('admin/manageProduct/addProduct.html.twig', [
            'vinyl' => $vinyl,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/modifier-produit", name="vinyl_edit_list")
     */
    public function chooseEditProduct(VinylRepository $vinylRepository): Response
    {
        return $this->render('admin/manageProduct/editProduct.html.twig', [
            'vinyls' => $vinylRepository->findAll(),
        ]);
    }

    /**
     * @Route("/edit/{id}", name="product_edit",methods={"GET","POST"})
     */
    public function editProduct(Request $request, Vinyl $vinyl)
    {
        $form = $this->createForm(VinylType::class, $vinyl);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('vinyl_edit_list');
        }

        return $this->render('vinyl/edit_form.html.twig', [
            'vinyl' => $vinyl,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="delete_products",methods={"DELETE"})
     */
    public function deleteProduct(Request $request, Vinyl $vinyl)
    {
        if ($this->isCsrfTokenValid('delete' . $vinyl->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($vinyl);
            $entityManager->flush();
        }
        return $this->redirectToRoute('vinyl_edit_list');
    }
}
