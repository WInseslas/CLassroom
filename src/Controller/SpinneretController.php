<?php

namespace App\Controller;

use App\Entity\Spinneret;
use App\Form\SpinneretType;
use App\Repository\SpinneretRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/spinneret')]
class SpinneretController extends AbstractController
{
    #[Route('/', name: 'app_spinneret_index', methods: ['GET'])]
    public function index(SpinneretRepository $spinneretRepository): Response
    {
        return $this->render('spinneret/index.html.twig', [
            'spinnerets' => $spinneretRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_spinneret_new', methods: ['GET', 'POST'])]
    public function new(Request $request, SpinneretRepository $spinneretRepository): Response
    {
        $spinneret = new Spinneret();
        $form = $this->createForm(SpinneretType::class, $spinneret);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $spinneretRepository->save($spinneret, true);

            return $this->redirectToRoute('app_spinneret_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('spinneret/new.html.twig', [
            'spinneret' => $spinneret,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_spinneret_show', methods: ['GET'])]
    public function show(Spinneret $spinneret): Response
    {
        return $this->render('spinneret/show.html.twig', [
            'spinneret' => $spinneret,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_spinneret_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Spinneret $spinneret, SpinneretRepository $spinneretRepository): Response
    {
        $form = $this->createForm(SpinneretType::class, $spinneret);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $spinneretRepository->save($spinneret, true);

            return $this->redirectToRoute('app_spinneret_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('spinneret/edit.html.twig', [
            'spinneret' => $spinneret,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_spinneret_delete', methods: ['POST'])]
    public function delete(Request $request, Spinneret $spinneret, SpinneretRepository $spinneretRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$spinneret->getId(), $request->request->get('_token'))) {
            $spinneretRepository->remove($spinneret, true);
        }

        return $this->redirectToRoute('app_spinneret_index', [], Response::HTTP_SEE_OTHER);
    }
}
