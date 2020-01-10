<?php


// src/Controller/TaskController.php
namespace App\Controller;

use App\Entity\Training;
use App\Form\Type\TrainingType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\UserType;
use App\Entity\User;


/**
 * Require ROLE_ADMIN for *every* controller method in this class.
 * @Route("/admin", name="admin_")
 * @IsGranted("ROLE_ADMIN")
 */

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
     * @Route("/InstructorOverzicht", name="instructoroverzicht")
     */
    public function InstructorOverzichtAction()
    {
        $instructor = $this->getDoctrine()->getRepository(User::class)->findByRole('ROLE_INSTRUCTOR');
        return $this->render('medewerker/instructeuroverzicht.html.twig', [
            'instructeur' => $instructor
        ]);
    }

    /**
     * @Route("/{id}", name="user_delete", methods={"DELETE"})
     */
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_ledenoverzicht');
    }

    /**
     * @Route("/LedenOverzicht", name="ledenoverzicht")
     */
    public function LedenAction()
    {
        $lid = $this->getDoctrine()->getRepository(User::class)->findByRole('ROLE_USER');
        return $this->render('medewerker/leden.html.twig', [
            'leden' => $lid
        ]);
    }


    public function adminDashboard()
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
    }
}