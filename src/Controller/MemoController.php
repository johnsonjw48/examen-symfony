<?php

namespace App\Controller;

use App\Entity\Memo;
use App\Form\MemoType;
use App\Repository\MemoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use DateTime;


class MemoController extends AbstractController
{
    /**
     * @Route("/", name="memo_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $memo = new Memo();
        $memo->setCreatedAt(new DateTime('now'));
        $form = $this->createForm(MemoType::class, $memo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($memo);
            $entityManager->flush();

            return $this->redirectToRoute('memo_show', ['id' => $memo->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('memo/new.html.twig', [
            'memo' => $memo,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="memo_show", methods={"GET"})
     */
    public function show(Memo $memo): Response
    {
        
       
        return $this->render('memo/show.html.twig', [
            'memo' => $memo,
           
        ]);
    }

   
}
