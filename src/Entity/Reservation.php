<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reservation
 *
 * @ORM\Table(name="reservation")
 * @ORM\Entity(repositoryClass="App\Repository\ReservationRepository")
 */
class Reservation
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heure_debut", type="datetime", nullable=false)
     */
    private $heure_debut;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Horaire", inversedBy="reservations")
     * @ORM\JoinColumn(name="horaire_id", referencedColumnName="id", nullable=false)
     */
    private $horaire;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return \DateTime
     */
    public function getHeureDebut(): \DateTime
    {
        return $this->heure_debut;
    }

    /**
     * @param \DateTime $heure_debut
     */
    public function setHeureDebut(\DateTime $heure_debut): void
    {
        $this->heure_debut = $heure_debut;
    }

    /**
     * @return mixed
     */
    public function getHoraire()
    {
        return $this->horaire;
    }

    /**
     * @param mixed $horaire
     */
    public function setHoraire($horaire): void
    {
        $this->horaire = $horaire;
    }

}
