<?php

namespace App\Entity;

use App\Repository\TransportsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TransportsRepository::class)]
class Transports
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $transport = null;

    #[ORM\ManyToOne(inversedBy: 'transports')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Eleves $eleves = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTransport(): ?string
    {
        return $this->transport;
    }

    public function setTransport(string $transport): static
    {
        $this->transport = $transport;

        return $this;
    }

    public function __toString() {
        return $this->transport;
    }

    public function getEleves(): ?Eleves
    {
        return $this->eleves;
    }

    public function setEleves(?Eleves $eleves): static
    {
        $this->eleves = $eleves;

        return $this;
    }
}
