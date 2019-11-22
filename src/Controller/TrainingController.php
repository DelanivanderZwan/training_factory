<?php


namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class TrainingController
{
    /**
     * @Route("/")
     */
    public function homepage()
    {
        return new Response('OMG! My firt page already! Wooo!');
    }

}