<?php

namespace App\Repository;

use App\Entity\Mensaje;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class MensajeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Mensaje::class);
    }

    /**
     * Encuentra mensajes de un intercambio específico.
     */
    public function findByIntercambio(int $intercambioId): array
    {
        return $this->createQueryBuilder('m')
            ->where('m.intercambio = :intercambioId')
            ->setParameter('intercambioId', $intercambioId)
            ->orderBy('m.fechaEnvio', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Encuentra mensajes enviados por un usuario en un intercambio.
     */
    public function findByUsuarioAndIntercambio(int $userId, int $intercambioId): array
    {
        return $this->createQueryBuilder('m')
            ->where('m.remitente = :userId AND m.intercambio = :intercambioId')
            ->setParameter('userId', $userId)
            ->setParameter('intercambioId', $intercambioId)
            ->orderBy('m.fechaEnvio', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
