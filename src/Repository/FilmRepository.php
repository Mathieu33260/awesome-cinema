<?php

namespace App\Repository;

use App\Entity\Film;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;


class FilmRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Film::class);
    }

    public function findByNomDate($nom, $date)
    {
        $qb = $this->createQueryBuilder('f');

        if ($nom) {
            $qb->andWhere('f.nom like :nom')
                ->setParameter('nom', "%$nom%");
        }

        if ($date) {
            $qb->andWhere('f.date = :date')
                ->setParameter('date', $date);
        }

        return $qb->getQuery()->getResult();
    }

}
