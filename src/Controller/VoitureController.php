<?php

namespace App\Controller;

use App\Entity\Voiture;
use App\Form\VoitureForm;
use App\Repository\VoitureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VoitureController extends AbstractController
{
    #[Route('/voiture', name: 'app_voiture')]
    public function listeVoiture(VoitureRepository $vr): Response
    {
        $voitures = $vr->findAll();
        return $this->render('voiture/liste.html.twig', [
            'voitures' => $voitures,
        ]);
    }

    #[Route('/addVoiture', name: 'addVoiture')]
    public function addVoiture(Request $request, EntityManagerInterface $em)
    {
        $voiture = new Voiture();
        $form = $this->createForm(VoitureForm::class, $voiture);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($voiture);
            $em->flush();
            return $this->redirectToRoute('app_voiture');
        }
        return $this->render('voiture/addVoiture.html.twig', [
            'formV' => $form->createView()
        ]);
    }

    #[Route('/voiture/{id}', name: 'voitureDelete')]
    public function delete($id, EntityManagerInterface $em, VoitureRepository $vr)
    {
        $voiture = $vr->find($id);
        $em->remove($voiture);
        $em->flush();
        return $this->redirectToRoute('app_voiture');
    }

    #[Route('/updateVoiture/{id}', name: 'voitureUpdate')]
    public function edit($id, Request $request, EntityManagerInterface $em, VoitureRepository $vr)
    {
        $voiture = $vr->find($id);
        $form = $this->createForm(VoitureForm::class, $voiture);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($voiture);
            $em->flush();
            return $this->redirectToRoute('app_voiture');
        }
        return $this->render('voiture/updateVoiture.html.twig', [
            'formV' => $form->createView()
        ]);
    }

    #[Route('/searchVoiture', name: 'searchVoiture')]
    public function searchVoiture(Request $request, EntityManagerInterface $entityManager): Response
    {
        $voitures = null;

        if ($request->isMethod('POST')) {
            $search = $request->request->get('input_serie');
            $query = $entityManager->createQuery(
                'SELECT  v FROM App\Entity\Voiture v WHERE v.serie like :serie'
            )
                ->setParameter('serie', '%' . $search . '%');
            $voitures = $query->getResult();
        }
        return $this->render('voiture/rechercheVoiture.html.twig', [
            'voitures' => $voitures
        ]);
    }

    #[Route('/searchVoitureByModel', name: 'searchVoitureByModel')]
    public function searchVoitureByModel(Request $request, EntityManagerInterface $entityManager): Response
    {
        $voitures = null;
        if ($request->isMethod('POST')) {
            $search = $request->request->get('input_model');
            $query = $entityManager->createQuery(
                'SELECT v from App\Entity\Voiture v join v.models m where m.label like :model'
            )
                ->setParameter('model', '%' . $search . '%');
            $voitures = $query->getResult();
        }
        return $this->render('voiture/rechercheVoitureByModels.html.twig', [
            'voitures' => $voitures
        ]);
    }

    #[Route('/getVoitureGroupedByModel', name: 'getVoitureGroupedByModel')]
    public function getVoitureGroupedByModel(Request $request, EntityManagerInterface $entityManager): Response
    {
        $query = $entityManager->createQuery(
            'SELECT m from App\Entity\Models m '
        );
        $voitures = $query->getResult();
        dump($voitures);
        return $this->render('voiture/voitureGroupedByModel.html.twig', [
            'voitures' => $voitures
        ]);
    }
}
