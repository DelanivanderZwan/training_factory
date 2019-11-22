<?php


namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;



class TrainingController
{
    public function homepage()
    {
        return new Response('OMG! My firt page already! Wooo!');
    }
}