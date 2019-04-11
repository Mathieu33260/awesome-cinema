<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Horaire
 *
 * @ORM\Table(name="horaire")
 * @ORM\Entity(repositoryClass="App\Repository\HoraireRepository")
 */
class Horaire
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
    private $heureDebut;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Film", inversedBy="horaires")
     * @ORM\JoinColumn(name="film_id", referencedColumnName="id", nullable=false)
     */
    private $film;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Salle", inversedBy="horaires")
     * @ORM\JoinColumn(name="salle_id", referencedColumnName="id", nullable=false)
     */
    private $salle;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Reservation", mappedBy="horaire", orphanRemoval=true, cascade={"persist", "remove"})
     */
    private $reservations;

    public function __construct()
    {
        $this->reservations = new ArrayCollection();
    }

    /**
     * @return Reservation[]|Collection
     */
    public function getReservations()
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): self
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations[] = $reservation;
            $reservation->setHoraire($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): self
    {
        if ($this->reservations->contains($reservation)) {
            $this->reservations->removeElement($reservation);
            // set the owning side to null (unless already changed)
            if ($reservation->getHoraire() === $this) {
                $reservation->setHoraire(null);
            }
        }

        return $this;
    }

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
        return $this->heureDebut;
    }

    /**
     * @param \DateTime $heureDebut
     */
    public function setHeureDebut(\DateTime $heureDebut): void
    {
        $this->heureDebut = $heureDebut;
    }

    /**
     * @return mixed
     */
    public function getFilm()
    {
        return $this->film;
    }

    /**
     * @param mixed $film
     */
    public function setFilm($film): void
    {
        $this->film = $film;
    }

    /**
     * @return mixed
     */
    public function getSalle()
    {
        return $this->salle;
    }

    /**
     * @param mixed $salle
     */
    public function setSalle($salle): void
    {
        $this->salle = $salle;
    }

}
