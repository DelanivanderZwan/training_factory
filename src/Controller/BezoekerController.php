<?php


namespace App\Controller;

use App\Entity\Training;
use App\Entity\User;
use App\Form\RegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


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