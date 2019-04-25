<?php

namespace App\Controller;

use App\Entity\Film;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/film")
 */

class FilmController extends AbstractController
{
    /**
     * @Route("/{id}", name="film_detail")
     */
    public function detail(Film $film, Request $request)
    {
        return $this->render('film/allDetail.twig', [
            'film' => $film
        ]);
    }
}
