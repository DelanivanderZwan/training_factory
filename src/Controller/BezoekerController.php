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
     * @Route("/{id}", name="agenda")
     */
    public function agendaAction($id, EntityManagerInterface $em)
    {
        $em = $this->getDoctrine()->getRepository(Training::class);
        $training = $em->findOneBy([
            'id' => $id,
        ]);
        return $this->render('bezoeker/agenda.html.twig', [
                'post' => $training,
            ]);
    }
}