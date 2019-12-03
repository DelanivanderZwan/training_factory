<?php


// src/Controller/TaskController.php
namespace App\Controller;

use App\Entity\Training;
use App\Form\Type\TrainingType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DirecteurController extends AbstractController
{
    /**
     * @Route("/form", name="form")
     */
    public function new(Request $request)
    {
        // creates a task object and initializes some data for this example
        $task = new Training();


        $form = $this->createForm(TrainingType::class, $task);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $task = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();
            $entityManager->persist($task);

            return $this->redirectToRoute('task_success');
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
}