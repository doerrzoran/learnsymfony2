<?php

namespace App\Entity;

use App\Repository\HobbieRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Trait\TimeStampTrait;

#[ORM\Entity(repositoryClass: HobbieRepository::class)]
#[ORM\HasLifecycleCallbacks()]
class Hobbie
{
    use TimeStampTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 70)]
    private ?string $designation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(string $designation): self
    {
        $this->designation = $designation;

        return $this;
    }
}
