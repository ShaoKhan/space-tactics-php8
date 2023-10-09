<?php

namespace App\Controller;

use App\Entity\Uni;
use App\Form\UniType;
use App\Repository\UniRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/uni')]
class UniController extends CustomAbstractController
{

    use Traits\MessagesTrait;
    use Traits\PlanetsTrait;

    #[Route('/', name: 'uni_index', methods: ['GET'])]
    public function index(UniRepository $uniRepository): Response
    {
        return $this->render(
            'admin/uni/index.html.twig', [
            'unis' => $uniRepository->findAll(),
        ],
        );
    }

    #[Route('/new', name: 'uni_new', methods: ['GET', 'POST'])]
    public function new(Request $request, UniRepository $uniRepository): Response
    {
        $uni = new Uni();
        $form = $this->createForm(UniType::class, $uni);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $uniRepository->save($uni, TRUE);

            return $this->redirectToRoute('uni_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render(
            'admin/uni/new.html.twig', [
            'uni'  => $uni,
            'form' => $form->createView(),
        ],
        );
    }

    #[Route('/{id}', name: 'uni_show', methods: ['GET'])]
    public function show(Uni $uni): Response
    {
        return $this->render(
            'admin/uni/show.html.twig', [
            'uni' => $uni,
        ],
        );
    }

    #[Route('/{id}/edit', name: 'uni_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Uni $uni, UniRepository $uniRepository): Response
    {
        $form = $this->createForm(UniType::class, $uni);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $uniRepository->save($uni, TRUE);

            return $this->redirectToRoute('uni_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render(
            'admin/uni/edit.html.twig', [
            'uni'  => $uni,
            'form' => $form->createView(),
        ],
        );
    }

    #[Route('/{id}', name: 'uni_delete', methods: ['POST'])]
    public function delete(Request $request, Uni $uni, UniRepository $uniRepository): Response
    {
        if($this->isCsrfTokenValid('delete' . $uni->getId(), $request->request->get('_token'))) {
            $uniRepository->remove($uni, TRUE);
        }

        return $this->redirectToRoute('uni_delete', [], Response::HTTP_SEE_OTHER);
    }
}
