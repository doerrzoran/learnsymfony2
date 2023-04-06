<?php

namespace App\Entity;

use App\Repository\ProfileRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProfileRepository::class)]
class Profile
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $url = null;

    #[ORM\Column(length: 50)]
    private ?string $rs = null;

    #[ORM\OneToOne(mappedBy: 'profile', cascade: ['persist', 'remove'])]
    private ?Personne $personne = null;

    #[ORM\ManyToMany(targetEntity: Hobbie::class)]
    private Collection $Hobbie;

    public function __construct()
    {
        $this->Hobbie = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getRs(): ?string
    {
        return $this->rs;
    }

    public function setRs(string $rs): self
    {
        $this->rs = $rs;

        return $this;
    }

    public function getPersonne(): ?Personne
    {
        return $this->personne;
    }

    public function setPersonne(?Personne $personne): self
    {
        // unset the owning side of the relation if necessary
        if ($personne === null && $this->personne !== null) {
            $this->personne->setProfile(null);
        }

        // set the owning side of the relation if necessary
        if ($personne !== null && $personne->getProfile() !== $this) {
            $personne->setProfile($this);
        }

        $this->personne = $personne;

        return $this;
    }

    /**
     * @return Collection<int, Hobbie>
     */
    public function getHobbie(): Collection
    {
        return $this->Hobbie;
    }

    public function addHobbie(Hobbie $hobbie): self
    {
        if (!$this->Hobbie->contains($hobbie)) {
            $this->Hobbie->add($hobbie);
        }

        return $this;
    }

    public function removeHobbie(Hobbie $hobbie): self
    {
        $this->Hobbie->removeElement($hobbie);

        return $this;
    }
}
