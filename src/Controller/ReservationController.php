<?php

namespace App\Controller;

use App\Entity\Film;
use App\Entity\Horaire;
use App\Entity\Reservation;
use App\Form\ReservationType;
use App\Service\ReservationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ReservationController extends AbstractController
{
    /** @var ReservationService $reservationService */
    private $reservationService;

    public function __construct(ReservationService $reservationService)
    {
        $this->reservationService = $reservationService;
    }

    /**
     * @Route("/reservation", name="reservations")
     */
    public function home()
    {
        $reservations = $this->getDoctrine()->getRepository(Reservation::class)->findBy(['user' => $this->getUser()]);

        return $this->render('reseravtion/list.twig', [
            'reservations' => $reservations
        ]);
    }

    /**
     * @Route("/reservation/detail/{id}", name="reservation_detail")
     */
    public function detail(Reservation $reservation, Request $request)
    {
        return $this->render('reservation/allDetail.twig', [
            'reservation' => $reservation
        ]);
    }

    /**
     * @Route("/reservation/add", name="reservation_add")
     */
    public function add(Request $request)
    {
        if ($request->get('filmId')) {
            $film = $this->getDoctrine()->getRepository(Film::class)->find($request->get('filmId'));
        }

        $form = $this->createForm(ReservationType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();

            /** @var Reservation $resa */
            $resa = $form->getData();
            $resa->setUser($this->getUser());

            $em->persist($resa);
            $em->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('reservation/addResa.html.twig', [
            'resaForm' => $form->createView(),
            'film' => $film,
        ]);
    }
//todo un user peut pas suppr un resa dun autre user
    /**
     * @Route("/delete/{id}", name="reservation_delete")
     */
    public function delete(Reservation $reservation)
    {
        $this->reservationService->delete($reservation);

        return $this->redirectToRoute('home');
    }
}