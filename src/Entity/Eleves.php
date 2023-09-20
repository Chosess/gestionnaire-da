<?php

namespace App\Entity;

use App\Repository\ElevesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ElevesRepository::class)]
class Eleves
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $photo = null;

    #[ORM\Column(length: 255)]
    private ?string $civilite = null;

    #[ORM\ManyToOne(inversedBy: 'eleves')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Educateurs $educateurs_id = null;

    #[ORM\OneToMany(mappedBy: 'eleves', targetEntity: Entretiens::class)]
    private Collection $entretiens;

    #[ORM\OneToMany(mappedBy: 'eleves', targetEntity: Transports::class)]
    private Collection $transports;

    #[ORM\OneToMany(mappedBy: 'eleves', targetEntity: Documents::class)]
    private Collection $documents;

    public function __construct()
    {
        $this->entretiens = new ArrayCollection();
        $this->transports = new ArrayCollection();
        $this->documents = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): static
    {
        $this->photo = $photo;

        return $this;
    }

    public function getCivilite(): ?string
    {
        return $this->civilite;
    }

    public function setCivilite(string $civilite): static
    {
        $this->civilite = $civilite;

        return $this;
    }

    public function getEducateursId(): ?Educateurs
    {
        return $this->educateurs_id;
    }

    public function setEducateursId(?Educateurs $educateurs_id): static
    {
        $this->educateurs_id = $educateurs_id;

        return $this;
    }

    /**
     * @return Collection<int, Entretiens>
     */
    public function getEntretiens(): Collection
    {
        return $this->entretiens;
    }

    public function addEntretien(Entretiens $entretien): static
    {
        if (!$this->entretiens->contains($entretien)) {
            $this->entretiens->add($entretien);
            $entretien->setEleves($this);
        }

        return $this;
    }

    public function removeEntretien(Entretiens $entretien): static
    {
        if ($this->entretiens->removeElement($entretien)) {
            // set the owning side to null (unless already changed)
            if ($entretien->getEleves() === $this) {
                $entretien->setEleves(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Transports>
     */
    public function getTransports(): Collection
    {
        return $this->transports;
    }

    public function addTransport(Transports $transport): static
    {
        if (!$this->transports->contains($transport)) {
            $this->transports->add($transport);
            $transport->setEleves($this);
        }

        return $this;
    }

    public function removeTransport(Transports $transport): static
    {
        if ($this->transports->removeElement($transport)) {
            // set the owning side to null (unless already changed)
            if ($transport->getEleves() === $this) {
                $transport->setEleves(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Documents>
     */
    public function getDocuments(): Collection
    {
        return $this->documents;
    }

    public function addDocument(Documents $document): static
    {
        if (!$this->documents->contains($document)) {
            $this->documents->add($document);
            $document->setEleves($this);
        }

        return $this;
    }

    public function removeDocument(Documents $document): static
    {
        if ($this->documents->removeElement($document)) {
            // set the owning side to null (unless already changed)
            if ($document->getEleves() === $this) {
                $document->setEleves(null);
            }
        }

        return $this;
    }
}
