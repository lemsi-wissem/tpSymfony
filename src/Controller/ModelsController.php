<?php

namespace App\Controller;

use App\Entity\Models;
use App\Form\ModelsType;
use App\Repository\ModelsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/models')]
class ModelsController extends AbstractController
{
    #[Route('/', name: 'app_models_index', methods: ['GET'])]
    public function index(ModelsRepository $modelsRepository): Response
    {
        return $this->render('models/index.html.twig', [
            'models' => $modelsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_models_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $model = new Models();
        $form = $this->createForm(ModelsType::class, $model);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($model);
            $entityManager->flush();

            return $this->redirectToRoute('app_models_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('models/new.html.twig', [
            'model' => $model,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_models_show', methods: ['GET'])]
    public function show(Models $model): Response
    {
        return $this->render('models/show.html.twig', [
            'model' => $model,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_models_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Models $model, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ModelsType::class, $model);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_models_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('models/edit.html.twig', [
            'model' => $model,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_models_delete', methods: ['POST'])]
    public function delete(Request $request, Models $model, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$model->getId(), $request->request->get('_token'))) {
            $entityManager->remove($model);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_models_index', [], Response::HTTP_SEE_OTHER);
    }
}
