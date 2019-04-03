<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $Nom;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $Prenom;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $Pseudo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Photo;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Article", mappedBy="vendeur")
     */
    private $articles_vendu;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Article", mappedBy="acheteur")
     */
    private $articles_achete;

    public function __construct()
    {
        $this->articles_vendu = new ArrayCollection();
        $this->articles_achete = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->Prenom;
    }

    public function setPrenom(string $Prenom): self
    {
        $this->Prenom = $Prenom;

        return $this;
    }

    public function getPseudo(): ?string
    {
        return $this->Pseudo;
    }

    public function setPseudo(string $Pseudo): self
    {
        $this->Pseudo = $Pseudo;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->Photo;
    }

    public function setPhoto(?string $Photo): self
    {
        $this->Photo = $Photo;

        return $this;
    }

    /**
     * @return Collection|Article[]
     */
    public function getArticlesVendu(): Collection
    {
        return $this->articles_vendu;
    }

    public function addArticlesVendu(Article $articlesVendu): self
    {
        if (!$this->articles_vendu->contains($articlesVendu)) {
            $this->articles_vendu[] = $articlesVendu;
            $articlesVendu->setVendeur($this);
        }

        return $this;
    }

    public function removeArticlesVendu(Article $articlesVendu): self
    {
        if ($this->articles_vendu->contains($articlesVendu)) {
            $this->articles_vendu->removeElement($articlesVendu);
            // set the owning side to null (unless already changed)
            if ($articlesVendu->getVendeur() === $this) {
                $articlesVendu->setVendeur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Article[]
     */
    public function getArticlesAchete(): Collection
    {
        return $this->articles_achete;
    }

    public function addArticlesAchete(Article $articlesAchete): self
    {
        if (!$this->articles_achete->contains($articlesAchete)) {
            $this->articles_achete[] = $articlesAchete;
            $articlesAchete->setAcheteur($this);
        }

        return $this;
    }

    public function removeArticlesAchete(Article $articlesAchete): self
    {
        if ($this->articles_achete->contains($articlesAchete)) {
            $this->articles_achete->removeElement($articlesAchete);
            // set the owning side to null (unless already changed)
            if ($articlesAchete->getAcheteur() === $this) {
                $articlesAchete->setAcheteur(null);
            }
        }

        return $this;
    }
}
