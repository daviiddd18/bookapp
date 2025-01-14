<?php

namespace App\Repository;

use App\Entity\Usuario;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class UsuarioRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Usuario::class);
    }

    /**
     * Encuentra usuarios que tengan un libro específico.
     */
    public function findUsersByLibro(int $libroId): array
    {
        return $this->createQueryBuilder('u')
            ->join('u.libros', 'l')
            ->where('l.id = :libroId')
            ->setParameter('libroId', $libroId)
            ->getQuery()
            ->getResult();
    }

   /**
     * Busca usuarios por nombre, correo electrónico o nickname.
     */
    public function findByNameOrEmailOrNickname(string $search): array
    {
        if (empty($search)) {
            return [];
        }

        return $this->createQueryBuilder('u')
            ->where('u.name LIKE :search')
            ->orWhere('u.email LIKE :search')
            ->orWhere('u.nickname LIKE :search')
            ->setParameter('search', '%' . $search . '%')
            ->getQuery()
            ->getResult();
    }

}
