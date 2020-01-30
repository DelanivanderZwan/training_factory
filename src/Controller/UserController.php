<?php

namespace App\Controller;

use App\Entity\Training;
use App\Form\RegistrationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class UserController
 * @package App\Controller
 * @Route("/user", name="user_")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    /**
     * @Route("/training", name="training")
     */
    public function trainingAction()
    {
        $training = $this->getDoctrine()->getRepository('App:Training')->findAll();
        return $this->render('user/training/training.html.twig', [
            'training' => $training
        ]);
    }

    /**
     * @Route("/inschrijven", name="inschrijven")
     */
    public function inschrijvingAction()
    {
        $trainingen = $this->getDoctrine()->getRepository(Training::class)->findAll();
        return $this->render('user/inschrijving.html.twig', [
            'trainingen' => $trainingen
        ]);
    }

    /**
     * @Route("/profileEdit", name="profileedit_", methods={"GET","POST"})
     */
    public function profileEditAction(Request $request): Response
    {
        $user = $this->getUser();
        $password = $user->getPassword();
        $form = $this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $user->setPassword($password);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('homepage');
        }

        return $this->render('user/profiledit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
            'title' => 'Profiel bewerken'
        ]);
    }
}
