<?php

namespace App\Service;

use App\Entity\Reservation;
use Doctrine\ORM\EntityManagerInterface;

class ReservationService
{
    /**
     * @var EntityManagerInterface $entityManager
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function checkNbPlaces(Reservation $resa)
    {
        $resas = $this->entityManager->getRepository(Reservation::class)->findBy(['horaire' => $resa->getHoraire()]);
        $nbPlaces = 0;

        foreach ($resas as $reservation) {
            $nbPlaces += $reservation->getNbPlaces();
        }

        return $nbPlaces + $resa->getNbPlaces() <= $resa->getHoraire()->getSalle()->getNbPlaces();
    }

    public function delete(Reservation $reservation)
    {
        $this->entityManager->remove($reservation);
        $this->entityManager->flush();
    }
}
