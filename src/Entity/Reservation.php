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
     * @var int
     *
     * @ORM\Column(name="nb_places", type="integer", nullable=false, options={"default" : 1})
     */
    private $nbPlaces;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Horaire", inversedBy="reservations"  )
     * @ORM\JoinColumn(name="horaire_id", referencedColumnName="id", nullable=false)
     */
    private $horaire;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="reservations")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    private $user;

    /**
     * @return int
     */
    public function getId()
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

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user): void
    {
        $this->user = $user;
    }

    /**
     * @return int
     */
    public function getNbPlaces()
    {
        return $this->nbPlaces;
    }

    /**
     * @param int $nbPlaces
     */
    public function setNbPlaces(int $nbPlaces): void
    {
        $this->nbPlaces = $nbPlaces;
    }

    public function __toString()
    {
        return $this->getUser()->getEmail();
    }

}
