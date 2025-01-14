<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\MensajeRepository;

#[ORM\Entity(repositoryClass: MensajeRepository::class)]
#[ORM\Table(name: "mensajes")]
class Mensaje
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Intercambio::class)]
    #[ORM\JoinColumn(name: "intercambio_id", referencedColumnName: "id", nullable: false, onDelete: "CASCADE")]
    private ?Intercambio $intercambio = null;

    #[ORM\ManyToOne(targetEntity: Usuario::class)]
    #[ORM\JoinColumn(name: "remitente_id", referencedColumnName: "id", nullable: false, onDelete: "CASCADE")]
    private ?Usuario $remitente = null;

    #[ORM\Column(type: "text")]
    private ?string $mensaje = null;

    #[ORM\Column(type: "datetime")]
    private \DateTimeInterface $fechaEnvio;

    public function __construct()
    {
        $this->fechaEnvio = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIntercambio(): ?Intercambio
    {
        return $this->intercambio;
    }

    public function setIntercambio(Intercambio $intercambio): self
    {
        $this->intercambio = $intercambio;

        return $this;
    }

    public function getRemitente(): ?Usuario
    {
        return $this->remitente;
    }

    public function setRemitente(Usuario $remitente): self
    {
        $this->remitente = $remitente;

        return $this;
    }

    public function getMensaje(): ?string
    {
        return $this->mensaje;
    }

    public function setMensaje(string $mensaje): self
    {
        $this->mensaje = $mensaje;

        return $this;
    }

    public function getFechaEnvio(): \DateTimeInterface
    {
        return $this->fechaEnvio;
    }

    public function setFechaEnvio(\DateTimeInterface $fechaEnvio): self
    {
        $this->fechaEnvio = $fechaEnvio;

        return $this;
    }
}
