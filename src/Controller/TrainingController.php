<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class TrainingController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function homepage()
    {
        $posts = $this->getDoctrine()->getRepository('App:Training')->findAll();
        return $this->render('base.html.twig', [
            'posts' => $posts
        ]);
    }

}