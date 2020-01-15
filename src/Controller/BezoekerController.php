<?php


namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Routing\Annotation\Route;


class BezoekerController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function homepageAction()
    {
        $posts = $this->getDoctrine()->getRepository('App:Training')->findAll();
        return $this->render('bezoeker/index.html.twig', [
            'posts' => $posts
        ]);
    }

    /**
     * @Route("/training", name="training")
     */
    public function trainingAction()
    {
        $training = $this->getDoctrine()->getRepository('App:Training')->findAll();
        return $this->render('training/training.html.twig', [
            'training' => $training
        ]);
    }

    /**
     * @Route("/Agenda", name="agenda")
     */
    public function agendaAction()
    {
        return $this->render('bezoeker/agenda.html.twig');
    }

    /**
     * @Route("/Inschrijven", name="inschrijven")
     */
    public function inschrijvingAction()
    {
        $inschrijven = $this->getDoctrine()->getRepository('App:Training')->findAll();
        return $this->render('bezoeker/inschrijving.html.twig', [
            'inschrijving' => $inschrijven
        ]);
    }

    /**
     * @Route("/Regels", name="regels")
     */
    public function regelsAction()
    {
        return $this->render('bezoeker/regels.html.twig');
    }

    /**
     * @Route("/Contact", name="contact")
     */
    public function contactAction()
    {
        return $this->render('bezoeker/contact.html.twig');
    }
    /**
     * @Route("/Login", name="Login")
     */
    public function inloggenAction()
    {
        return $this->render('bezoeker/login.html.twig');
    }

    /**
     * @Route("/ProfileEdit", name="profileedit", methods={"GET","POST"})
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

        return $this->render('bezoeker/profiledit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
            'title' => 'Profiel bewerken'
        ]);
    }

    /**
     * @Route("/Registreren", name="registreren")
     */
    public function registrerenAction(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $user = new User();

        $form = $this->createForm(RegistrationType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
             $user = $form->getData();
             $user->setRoles(['ROLE_USER']);
             $user->setPassword($passwordEncoder->encodePassword(
                  $user,
                  $user->getPassword()
             ));

             $entityManager = $this->getDoctrine()->getManager();
             $entityManager->persist($user);
             $entityManager->flush();

            return $this->redirectToRoute('homepage');
        }

        return $this->render('bezoeker/registreren.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}