<?php

namespace App\Repository;

use App\Entity\Intercambio;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class IntercambioRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Intercambio::class);
    }

    /**
     * Encuentra intercambios propuestos por un usuario.
     */
    public function findByUsuarioOfrece(int $userId): array
    {
        return $this->createQueryBuilder('i')
            ->where('i.usuarioOfrece = :userId')
            ->setParameter('userId', $userId)
            ->getQuery()
            ->getResult();
    }

    /**
     * Encuentra intercambios dirigidos a un usuario.
     */
    public function findByUsuarioDesea(int $userId): array
    {
        return $this->createQueryBuilder('i')
            ->where('i.usuarioDesea = :userId')
            ->setParameter('userId', $userId)
            ->getQuery()
            ->getResult();
    }

}
