<?php


namespace App\Controller;

use App\Entity\Training;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
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
     * @Route("/Contact", name="contact")
     */
    public function contactAction()
    {
        return $this->render('bezoeker/contact.html.twig');
    }
    /**
     * @Route("/Inloggen", name="inloggen")
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
        return $this->render('bezoeker/registreren.html.twig');
    }
}