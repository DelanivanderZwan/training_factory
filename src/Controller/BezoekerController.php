<?php


namespace App\Controller;

use App\Entity\Training;
use App\Form\RegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use http\Env\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
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
     * @Route("/Lesaanbod", name="aanbod")
     */
    public function aanbodAction()
    {
        $posts = $this->getDoctrine()->getRepository('App:Training')->findAll();
        return $this->render('bezoeker/aanbod.html.twig', [
            'posts' => $posts
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
    public function registrerenAction()
    {
        $form = $this->createForm(RegistrationType::class);
        return $this->render('bezoeker/registreren.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}