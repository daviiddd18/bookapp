<?php 

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\IntercambioRepository;

#[ORM\Entity(repositoryClass: IntercambioRepository::class)]
#[ORM\Table(name: "intercambios")]
class Intercambio
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Usuario::class)]
    #[ORM\JoinColumn(name: "usuario_ofrece_id", referencedColumnName: "id", nullable: false, onDelete: "CASCADE")]
    private ?Usuario $usuarioOfrece = null;

    #[ORM\ManyToOne(targetEntity: Libro::class)]
    #[ORM\JoinColumn(name: "libro_ofrecido_id", referencedColumnName: "id", nullable: false, onDelete: "CASCADE")]
    private ?Libro $libroOfrecido = null;

    #[ORM\ManyToOne(targetEntity: Usuario::class)]
    #[ORM\JoinColumn(name: "usuario_desea_id", referencedColumnName: "id", nullable: false, onDelete: "CASCADE")]
    private ?Usuario $usuarioDesea = null;

    #[ORM\ManyToOne(targetEntity: Libro::class)]
    #[ORM\JoinColumn(name: "libro_deseado_id", referencedColumnName: "id", nullable: false, onDelete: "CASCADE")]
    private ?Libro $libroDeseado = null;

    #[ORM\Column(type: "datetime")]
    private \DateTimeInterface $fechaSolicitud;

    public function __construct()
    {
        $this->fechaSolicitud = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsuarioOfrece(): ?Usuario
    {
        return $this->usuarioOfrece;
    }

    public function setUsuarioOfrece(Usuario $usuarioOfrece): self
    {
        $this->usuarioOfrece = $usuarioOfrece;

        return $this;
    }

    public function getLibroOfrecido(): ?Libro
    {
        return $this->libroOfrecido;
    }

    public function setLibroOfrecido(Libro $libroOfrecido): self
    {
        $this->libroOfrecido = $libroOfrecido;

        return $this;
    }

    public function getUsuarioDesea(): ?Usuario
    {
        return $this->usuarioDesea;
    }

    public function setUsuarioDesea(Usuario $usuarioDesea): self
    {
        $this->usuarioDesea = $usuarioDesea;

        return $this;
    }

    public function getLibroDeseado(): ?Libro
    {
        return $this->libroDeseado;
    }

    public function setLibroDeseado(Libro $libroDeseado): self
    {
        $this->libroDeseado = $libroDeseado;

        return $this;
    }

    public function getFechaSolicitud(): \DateTimeInterface
    {
        return $this->fechaSolicitud;
    }

    public function setFechaSolicitud(\DateTimeInterface $fechaSolicitud): self
    {
        $this->fechaSolicitud = $fechaSolicitud;

        return $this;
    }
}
