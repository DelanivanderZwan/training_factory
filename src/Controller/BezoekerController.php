<?php


namespace App\Controller;

use App\Entity\Training;
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
     * @Route("/regels", name="regels")
     */
    public function regelsAction()
    {
        return $this->render('bezoeker/regels.html.twig');
    }

    /**
     * @Route("/contact", name="contact")
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
     * @Route("/registreren", name="registreren")
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