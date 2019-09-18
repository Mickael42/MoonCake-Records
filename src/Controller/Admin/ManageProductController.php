<?php

namespace App\Controller\Admin;

use App\Entity\Track;
use App\Entity\Vinyl;
use App\Form\TrackType;
use App\Form\VinylType;

use App\Repository\VinylRepository;
use App\Repository\TrackRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/**
 * @Route("/admin/gestion-produits")
 */
class ManageProductController extends AbstractController
{

    /**
     * @Route("/ajout-produit", name="add_product", methods={"GET","POST"})
     */
    public function addProduct(Request $request)
    {
        $vinyl = new Vinyl();
        $form = $this->createForm(VinylType::class, $vinyl);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            //getting all data from the cover uploaded
            $cover = $form['cover']->getData();
            $originalFilename = pathinfo($cover->getClientOriginalName(), PATHINFO_FILENAME);
            // this is needed to safely include the file name as part of the URL
            $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
            $newFilename = $safeFilename . '-' . uniqid() . '.' . $cover->guessExtension();
            $cover->move(
                //the directory file is set in config/service.yaml
                $this->getParameter('cover_directory'),
                $newFilename
            );
            $newPathCover = 'assets/img/Covers/' . $newFilename;
            $vinyl->setCover($newPathCover);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($vinyl);
            $entityManager->flush();
            $this->addFlash(
                'notice',
                'Le vinyle est a bien été créé!'
            );

            return $this->redirectToRoute('vinyl_edit_list');
        }

        return $this->render('admin/manageProduct/addProduct.html.twig', [
            'vinyl' => $vinyl,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/liste-vinyles", name="vinyl_edit_list")
     */
    public function listVinyls(VinylRepository $vinylRepository): Response
    {
        return $this->render('admin/manageProduct/editProduct.html.twig', [
            'vinyls' => $vinylRepository->findAll(),
        ]);
    }

    /**
     * @Route("/edit/{id}", name="vinyl_edit",methods={"GET","POST"})
     */
    public function editProduct(Request $request, Vinyl $vinyl)
    {
        $form = $this->createForm(VinylType::class, $vinyl);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            //getting all data from the cover uploaded
            $cover = $form['cover']->getData();
            $originalFilename = pathinfo($cover->getClientOriginalName(), PATHINFO_FILENAME);
            // this is needed to safely include the file name as part of the URL
            $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
            $newFilename = $safeFilename . '-' . uniqid() . '.' . $cover->guessExtension();
            $cover->move(
                //the directory file is set in config/service.yaml
                $this->getParameter('cover_directory'),
                $newFilename
            );
            $newPathCover = 'assets/img/Covers/' . $newFilename;
            $vinyl->setCover($newPathCover);
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash(
                'notice',
                'Le vinyle est a bien été modifié!'
            );

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
            $this->addFlash(
                'notice',
                'Le vinyle est a bien été supprimé!'
            );
        }
        return $this->redirectToRoute('vinyl_edit_list');
    }

    /**
     * @Route("/ajout-titre", name="add_track", methods={"GET","POST"})
     */
    public function addTrack(Request $request)
    {
        $track = new Track();
        $form = $this->createForm(TrackType::class, $track);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($track);
            $entityManager->flush();
            $this->addFlash(
                'notice',
                'Le titre a bien été ajouté!'
            );
            return $this->redirectToRoute('add_track');
        }
        return $this->render('admin/manageProduct/addTrack.html.twig', [
            'track' => $track,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/liste-titre", name="track_edit_list")
     */
    public function listTrack(TrackRepository $trackRepository): Response
    {
        return $this->render('admin/manageProduct/editTrack.html.twig', [
            'tracks' => $trackRepository->findAll(),
        ]);
    }

    /**
     * @Route("/editTrack/{id}", name="track_edit",methods={"GET","POST"})
     */
    public function editTrack(Request $request, Track $track)
    {
        $form = $this->createForm(TrackType::class, $track);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->getDoctrine()->getManager()->flush();
            $this->addFlash(
                'notice',
                'Le titre a bien été modifié!'
            );

            return $this->redirectToRoute('track_edit_list');
        }
        return $this->render('track/edit.html.twig', [
            'track' => $track,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete-track/{id}", name="track_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Track $track): Response
    {
        if ($this->isCsrfTokenValid('delete'.$track->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($track);
            $entityManager->flush();
            $this->addFlash(
                'notice',
                'Le titre a bien été supprimé!'
            );
        }

        return $this->redirectToRoute('track_edit_list');
    }
}
