<?php

namespace App\Controller;

use App\Entity\Film;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home(Request $request)
    {
        $films = $this->getDoctrine()->getRepository(Film::class)->findByNomDate($request->get('nom'), $request->get('date'));

        return $this->render('index.twig', [
            'films' => $films
        ]);
    }
}
