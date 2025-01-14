<?php 

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: 'App\Repository\LibroRepository')]
#[ORM\Table(name: 'libros', uniqueConstraints: [new ORM\UniqueConstraint(name: 'id_libro_unique', columns: ['id_libro'])])]
class Libro
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    #[ORM\Column(type: "integer")]
    private ?int $id = null;

    #[ORM\Column(type: "string", length: 100, unique: true)]
    private ?string $id_libro = null;

    #[ORM\Column(type: "string", length: 100)]
    private ?string $titulo = null;

    #[ORM\Column(type: "text", nullable: true)]
    private ?string $descripcion = null;

    #[ORM\Column(type: "string", length: 100)]
    private ?string $autor = null;

    #[ORM\Column(type: "string", length: 50, nullable: true)]
    private ?string $editorial = null;

    #[ORM\Column(type: "datetime", nullable: true)]
    private ?\DateTimeInterface $fecha_publicacion = null;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $imagen = null;

    #[ORM\Column(type: "string", length: 50, nullable: true)]
    private ?string $categoria = null;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $url_compra = null;

    #[ORM\ManyToMany(targetEntity: "App\Entity\User", inversedBy: "libros")]
    #[ORM\JoinTable(name: "user_libro")]
    private $usuarios;

    public function __construct()
    {
        $this->usuarios = new ArrayCollection();
    }

    // Getters y setters
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdLibro(): ?string
    {
        return $this->id_libro;
    }

    public function setIdLibro(string $id_libro): self
    {
        $this->id_libro = $id_libro;

        return $this;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): self
    {
        $this->titulo = $titulo;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getAutor(): ?string
    {
        return $this->autor;
    }

    public function setAutor(?string $autor): self
    {
        $this->autor = $autor;

        return $this;
    }

    public function getEditorial(): ?string
    {
        return $this->editorial;
    }

    public function setEditorial(?string $editorial): self
    {
        $this->editorial = $editorial;

        return $this;
    }

    public function getFechaPublicacion(): ?\DateTimeInterface
    {
        return $this->fecha_publicacion;
    }

    public function setFechaPublicacion(?\DateTimeInterface $fecha_publicacion): self
    {
        $this->fecha_publicacion = $fecha_publicacion;

        return $this;
    }

    public function getImagen(): ?string
    {
        return $this->imagen;
    }

    public function setImagen(?string $imagen): self
    {
        $this->imagen = $imagen;

        return $this;
    }

    public function getUrl_compra(): ?string
    {
        return $this->url_compra;
    }

    public function setUrl_compra(?string $url_compra): self
    {
        $this->url_compra = $url_compra;

        return $this;
    }
    public function getCategoria(): ?string
    {
        return $this->categoria;
    }

    public function setCategoria(?string $categoria): self
    {
        $this->categoria = $categoria;

        return $this;
    }

    public function getUsuarios(): Collection
    {
        return $this->usuarios;
    }

    public function addUsuario(Usuario $usuario): self
    {
        if (!$this->usuarios->contains($usuario)) {
            $this->usuarios[] = $usuario;
        }

        return $this;
    }

    public function removeUsuario(Usuario $usuario): self
    {
        $this->usuarios->removeElement($usuario);

        return $this;
    }

}
