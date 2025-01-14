<?php 

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: "App\Repository\UsuarioRepository")]
class Usuario implements UserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id = null;

    #[ORM\Column(type: "string", length: 20)]
    #[Assert\NotBlank]
    #[Assert\Length(max: 20)]
    private ?string $role = null;

    #[ORM\Column(type: "string", length: 50, unique: true)]
    #[Assert\NotBlank]
    #[Assert\Email]
    private ?string $email = null;

    #[ORM\Column(type: "string", length: 20)]
    #[Assert\NotBlank]
    private ?string $name = null;

    #[ORM\Column(type: "string", length: 50, nullable: true)]
    private ?string $surname = null;

    #[ORM\Column(type: "string", length: 50, unique: true)]
    #[Assert\NotBlank]
    private ?string $nickname = null;

    #[ORM\Column(type: "string", length: 255)]
    #[Assert\NotBlank]
    private ?string $password = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRoles(): array
    {
        return [$this->role];
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(?string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getNickname(): ?string
    {
        return $this->nickname;
    }

    public function setNickname(string $nickname): self
    {
        $this->nickname = $nickname;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    // Métodos de UserInterface
    
    public function getUserIdentifier(): string
    {
        return $this->email; 
    }

    public function eraseCredentials()
    {
        $this->password = null;
    }

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Libro", mappedBy="users")
     */
    private $libros;

    public function __construct()
    {
        $this->libros = new ArrayCollection();
    }

    public function getLibros(): Collection
    {
        return $this->libros;
    }

    public function addLibro(Libro $libro): self
    {
        if (!$this->libros->contains($libro)) {
            $this->libros[] = $libro;
            $libro->addUsuario($this);
        }

        return $this;
    }

    public function removeLibro(Libro $libro): self
    {
        if ($this->libros->removeElement($libro)) {
            $libro->removeUsuario($this);
        }

        return $this;
    }

}
