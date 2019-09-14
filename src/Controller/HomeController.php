<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\VinylRepository;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(VinylRepository $vinylRepository): Response
    {

        $lastVinyls = $vinylRepository->findAll(
            ['id' => 'DESC']
        
        );
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'vinyls'=> $lastVinyls
        ]);
    }
    /** 
     * @Route("/contact", name="contact")
     */
    public function contact()
    {
        return $this->render('contact/index.html.twig', []);
    }
    /** 
     * @Route("/mentions", name="mentions")
     */
    public function mentions()
    {
        return $this->render('mentionsLegales/index.html.twig', []);
    }
}
