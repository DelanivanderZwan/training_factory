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
     * @Route("/2", name="aanbod")
     */
    public function aanbodAction()
    {
        $posts = $this->getDoctrine()->getRepository('App:Training')->findAll();
        return $this->render('bezoeker/aanbod.html.twig', [
            'posts' => $posts
        ]);
    }

    /**
     * @Route("/3", name="agenda")
     */
    public function agendaAction()
    {
        return $this->render('bezoeker/agenda.html.twig');
    }

    /**
     * @Route("/4", name="contact")
     */
    public function contactAction()
    {
        return $this->render('bezoeker/contact.html.twig');
    }
    /**
     * @Route("/5", name="inloggen")
     */
    public function inloggenAction()
    {
        return $this->render('bezoeker/login.html.twig');
    }
    /**
     * @Route("/6", name="registreren")
     */
    public function registrerenAction()
    {
        return $this->render('bezoeker/registreren.html.twig');
    }
}