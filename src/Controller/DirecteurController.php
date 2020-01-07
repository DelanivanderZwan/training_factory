<?php


// src/Controller/TaskController.php
namespace App\Controller;

use App\Entity\Training;
use App\Form\Type\TrainingType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DirecteurController extends AbstractController
{
    /**
     * @Route("/form", name="form")
     */
    public function new(Request $request): Response
    {
        // creates a task object and initializes some data for this example
        $task = new Training();
        $form = $this->createForm(TrainingType::class, $task);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($task);
            $entityManager->flush();

            return $this->redirectToRoute('homepage');
        }


        return $this->render('medewerker/training.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/", name="task_success")
     */
    public function succesAction()
    {
        return $this->render('medewerker/training.html.twig');
    }

    /**
     * @Route("leden", name="leden")
     */
    public function ledenAction()
    {
        return $this->render('medewerker/leden.html.twig');
    }

    public function adminDashboard()
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
    }
}