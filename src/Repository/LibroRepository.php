<?php

namespace App\Repository;

use App\Entity\Libro;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class LibroRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Libro::class);
    }

    /**
     * Encuentra libros que coincidan con un título.
     */
    public function findByTitle(string $title): array
    {
        return $this->createQueryBuilder('l')
            ->where('l.titulo LIKE :title')
            ->setParameter('title', '%' . $title . '%')
            ->getQuery()
            ->getResult();
    }

    /**
     * Encuentra libros que coincidan con un id.
     */
    public function findByIdLibri(string $id_libro): array
    {
        return $this->createQueryBuilder('l')
            ->where('l.id_libro LIKE :id_libro')
            ->setParameter('id_libro', $id_libro)
            ->getQuery()
            ->getResult();
    }

    /**
     * Encuentra libros de un usuario específico.
     */
    public function findByUser(int $userId): array
    {
        return $this->createQueryBuilder('l')
            ->join('l.user', 'u')
            ->where('u.id = :userId')
            ->setParameter('userId', $userId)
            ->getQuery()
            ->getResult();
    }
}
