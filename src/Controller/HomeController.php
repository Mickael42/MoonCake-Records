<?php

namespace App\Controller;

use App\Repository\VinylRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(VinylRepository $vinylRepository): Response
    {
        //custom querry created in the repository to get only 4 last vinyls
        $lastVinyls = $vinylRepository->findByLastVinyls(4);
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'vinyls' => $lastVinyls
        ]);
    }
    /** 
     * @Route("/contact", name="contact", methods={"POST", "GET"})
     */
    public function contact(Request $request, \Swift_Mailer $mailer)
    {
        if ($request->getMethod() === "POST") {

            //send the messga eto the administrator of the website

            $message = (new \Swift_Message('Message contact | MoonCake Records'))
            ->setFrom('contact@mooncakerecords.com')
            ->setTo('mickael13.08@hotmail.fr')
            ->setBody(
                $this->renderView(
                    'email/contact.html.twig',
                    [   
                        'firstname' => $request->request->get('firstname'),
                        'lastname'=>$request->request->get('lastname'),
                        'phone'=>$request->request->get('phone'),
                        'email'=>$request->request->get('email'),
                        'message' => $request->request->get('message')
                    ]
                ),
                'text/html'
            );  

        $mailer->send($message);




            $this->addFlash(
                'notice',
                'Merci! Votre message a bien été envoyé, l\'équipe de MoonCake Records vous contactera dans les plus brefs délais!'
            );
        }
       
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
