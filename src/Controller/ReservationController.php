<?php

namespace App\Controller;

use App\Entity\Film;
use App\Entity\Reservation;
use App\Form\ReservationType;
use App\Service\ReservationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/reservation")
 */
class ReservationController extends AbstractController
{
    /** @var ReservationService $reservationService */
    private $reservationService;

    public function __construct(ReservationService $reservationService)
    {
        $this->reservationService = $reservationService;
    }

    /**
     * @Route("/", name="reservations")
     *
     * @return Response
     */
    public function home()
    {
        $reservations = $this->getDoctrine()->getRepository(Reservation::class)->findBy(['user' => $this->getUser()]);

        return $this->render('reservation/index.twig', [
            'resas' => $reservations
        ]);
    }

    /**
     * @Route("/detail/{id}", name="reservation_detail")
     *
     * @param Reservation $reservation
     * @return Response
     */
    public function detail(Reservation $reservation)
    {
        return $this->render('reservation/allDetail.twig', [
            'resa' => $reservation
        ]);
    }

    /**
         * @Route("/add", name="reservation_add")
     *
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function add(Request $request)
    {
        $form = $this->createForm(ReservationType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Reservation $resa */
            $resa = $form->getData();

            if (!$this->reservationService->check($this->getUser(), $resa)) {
                $this->get('session')->getFlashBag()->add('error', 'Plus de places disponible pour cette séance !');

                return $this->render('reservation/addResa.html.twig', [
                    'resaForm' => $form->createView(),
                    'film' => $resa->getHoraire()->getFilm(),
                ]);
            }

            $this->get('session')->getFlashBag()->add('success', 'Réservation créée avec succés !');

            return $this->redirectToRoute('reservation_detail', ['id' => $resa->getId()]);
        }

        return $this->render('reservation/addResa.html.twig', [
            'resaForm' => $form->createView(),
            'film' => $this->getDoctrine()->getRepository(Film::class)->find($request->get('film')),
        ]);
    }

    /**
     * @Route("/delete/{id}", name="reservation_delete")
     *
     * @param Reservation $reservation
     * @return RedirectResponse
     */
    public function delete(Reservation $reservation)
    {
        if ($reservation->getUser()->getId() !== $this->getUser()->getId()) {
            $this->get('session')->getFlashBag()->add('error', 'Vous ne pouvez pas supprimer la réservation d\'un autre utilisateur !');
            return $this->redirectToRoute('home');
        }
        $this->reservationService->delete($reservation);

        $this->get('session')->getFlashBag()->add('success', 'Réservation supprimé avec succès !');

        return $this->redirectToRoute('home');
    }
}
