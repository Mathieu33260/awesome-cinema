<?php

namespace App\Controller;

use App\Entity\Film;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        $films = $this->getDoctrine()->getRepository(Film::class)->findAll();

        return $this->render('index.twig', [
            'films' => $films
        ]);
    }
}
