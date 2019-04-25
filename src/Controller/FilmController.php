<?php

namespace App\Controller;

use App\Entity\Film;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/film")
 */

class FilmController extends AbstractController
{
    /**
     * @Route("/{id}", name="film_detail")
     *
     * @param Film $film
     * @return Response
     */
    public function detail(Film $film)
    {
        return $this->render('film/allDetail.twig', [
            'film' => $film
        ]);
    }
}
