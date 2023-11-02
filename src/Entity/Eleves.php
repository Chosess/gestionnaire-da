<?php

namespace App\Entity;

use App\Repository\ElevesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
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

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $photo = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $civilite = null;

    #[ORM\ManyToOne(inversedBy: 'eleves')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Educateurs $educateurs_id = null;

    #[ORM\OneToMany(mappedBy: 'eleves', targetEntity: Entretiens::class)]
    private Collection $entretiens;

    #[ORM\OneToMany(mappedBy: 'eleves', targetEntity: Transports::class)]
    private Collection $transports;

    #[ORM\OneToMany(mappedBy: 'eleves', targetEntity: Documents::class)]
    private Collection $documents;

    #[ORM\OneToMany(mappedBy: 'eleves', targetEntity: Absences::class)]
    private Collection $absences;

    #[ORM\Column(nullable: true)]
    private ?bool $validation_inscription = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_inscription = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $formation = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $annee_formation = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $prescripteur = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $conseiller = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $adresse = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $code_postal = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $ville = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $portable = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $fixe = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nom_urgence = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $prenom_urgence = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $telephone_urgence = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $lieu_naissance = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_naissance = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nationalite = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $etat_civil = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $enfants = null;

    #[ORM\Column(nullable: true)]
    private ?bool $ordinateur = null;

    #[ORM\Column(nullable: true)]
    private ?bool $droit_image = null;

    #[ORM\Column(nullable: true)]
    private ?bool $suivi = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $lien_parente = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_fin_suivi = null;

    #[ORM\Column(nullable: true)]
    private ?bool $cotisations = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $cotisations_date = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $identifiant_cned = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $password_cned = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $moyen_paiement = null;

    #[ORM\Column(nullable: true)]
    private ?int $montant = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $dispositif_aide = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Motif = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $indicatif_cned = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $stage_debut = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $stage_fin = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $stage_entreprise = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $stage_tuteur = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $stage_tuteur_fonction = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $stage_tel = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_cned = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $statut_cned = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_inscription_cned = null;

    #[ORM\Column(nullable: true)]
    private ?bool $complet = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $incomplet = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $stage_mail = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $lieu_ml = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $permis = null;

    public function __construct()
    {
        $this->entretiens = new ArrayCollection();
        $this->transports = new ArrayCollection();
        $this->documents = new ArrayCollection();
        $this->absences = new ArrayCollection();
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
    
    public function __toString() {
        return $this->nom;
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

    /**
     * @return Collection<int, Absences>
     */
    public function getAbsences(): Collection
    {
        return $this->absences;
    }

    public function addAbsence(Absences $absence): static
    {
        if (!$this->absences->contains($absence)) {
            $this->absences->add($absence);
            $absence->setEleves($this);
        }

        return $this;
    }

    public function removeAbsence(Absences $absence): static
    {
        if ($this->absences->removeElement($absence)) {
            // set the owning side to null (unless already changed)
            if ($absence->getEleves() === $this) {
                $absence->setEleves(null);
            }
        }

        return $this;
    }

    public function isValidationInscription(): ?bool
    {
        return $this->validation_inscription;
    }

    public function setValidationInscription(bool $validation_inscription): static
    {
        $this->validation_inscription = $validation_inscription;

        return $this;
    }

    public function getDateInscription(): ?\DateTimeInterface
    {
        return $this->date_inscription;
    }

    public function setDateInscription(\DateTimeInterface $date_inscription): static
    {
        $this->date_inscription = $date_inscription;

        return $this;
    }

    public function getFormation(): ?string
    {
        return $this->formation;
    }

    public function setFormation(string $formation): static
    {
        $this->formation = $formation;

        return $this;
    }

    public function getAnneeFormation(): ?int
    {
        return $this->annee_formation;
    }

    public function setAnneeFormation(int $annee_formation): static
    {
        $this->annee_formation = $annee_formation;

        return $this;
    }

    public function getPrescripteur(): ?string
    {
        return $this->prescripteur;
    }

    public function setPrescripteur(string $prescripteur): static
    {
        $this->prescripteur = $prescripteur;

        return $this;
    }

    public function getConseiller(): ?string
    {
        return $this->conseiller;
    }

    public function setConseiller(string $conseiller): static
    {
        $this->conseiller = $conseiller;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->code_postal;
    }

    public function setCodePostal(string $code_postal): static
    {
        $this->code_postal = $code_postal;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): static
    {
        $this->ville = $ville;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPortable(): ?string
    {
        return $this->portable;
    }

    public function setPortable(string $portable): static
    {
        $this->portable = $portable;

        return $this;
    }

    public function getFixe(): ?string
    {
        return $this->fixe;
    }

    public function setFixe(string $fixe): static
    {
        $this->fixe = $fixe;

        return $this;
    }

    public function getNomUrgence(): ?string
    {
        return $this->nom_urgence;
    }

    public function setNomUrgence(string $nom_urgence): static
    {
        $this->nom_urgence = $nom_urgence;

        return $this;
    }

    public function getPrenomUrgence(): ?string
    {
        return $this->prenom_urgence;
    }

    public function setPrenomUrgence(string $prenom_urgence): static
    {
        $this->prenom_urgence = $prenom_urgence;

        return $this;
    }

    public function getTelephoneUrgence(): ?string
    {
        return $this->telephone_urgence;
    }

    public function setTelephoneUrgence(string $telephone_urgence): static
    {
        $this->telephone_urgence = $telephone_urgence;

        return $this;
    }

    public function getLieuNaissance(): ?string
    {
        return $this->lieu_naissance;
    }

    public function setLieuNaissance(string $lieu_naissance): static
    {
        $this->lieu_naissance = $lieu_naissance;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->date_naissance;
    }

    public function setDateNaissance(\DateTimeInterface $date_naissance): static
    {
        $this->date_naissance = $date_naissance;

        return $this;
    }

    public function getNationalite(): ?string
    {
        return $this->nationalite;
    }

    public function setNationalite(string $nationalite): static
    {
        $this->nationalite = $nationalite;

        return $this;
    }

    public function getEtatCivil(): ?string
    {
        return $this->etat_civil;
    }

    public function setEtatCivil(string $etat_civil): static
    {
        $this->etat_civil = $etat_civil;

        return $this;
    }

    public function getEnfants(): ?int
    {
        return $this->enfants;
    }

    public function setEnfants(int $enfants): static
    {
        $this->enfants = $enfants;

        return $this;
    }

    public function isOrdinateur(): ?bool
    {
        return $this->ordinateur;
    }

    public function setOrdinateur(bool $ordinateur): static
    {
        $this->ordinateur = $ordinateur;

        return $this;
    }

    public function isDroitImage(): ?bool
    {
        return $this->droit_image;
    }

    public function setDroitImage(bool $droit_image): static
    {
        $this->droit_image = $droit_image;

        return $this;
    }

    public function isSuivi(): ?bool
    {
        return $this->suivi;
    }

    public function setSuivi(bool $suivi): static
    {
        $this->suivi = $suivi;

        return $this;
    }

    public function getLienParente(): ?string
    {
        return $this->lien_parente;
    }

    public function setLienParente(?string $lien_parente): static
    {
        $this->lien_parente = $lien_parente;

        return $this;
    }

    public function getDateFinSuivi(): ?\DateTimeInterface
    {
        return $this->date_fin_suivi;
    }

    public function setDateFinSuivi(?\DateTimeInterface $date_fin_suivi): static
    {
        $this->date_fin_suivi = $date_fin_suivi;

        return $this;
    }

    public function isCotisations(): ?bool
    {
        return $this->cotisations;
    }

    public function setCotisations(?bool $cotisations): static
    {
        $this->cotisations = $cotisations;

        return $this;
    }

    public function getCotisationsDate(): ?\DateTimeInterface
    {
        return $this->cotisations_date;
    }

    public function setCotisationsDate(?\DateTimeInterface $cotisations_date): static
    {
        $this->cotisations_date = $cotisations_date;

        return $this;
    }

    public function getIdentifiantCned(): ?string
    {
        return $this->identifiant_cned;
    }

    public function setIdentifiantCned(?string $identifiant_cned): static
    {
        $this->identifiant_cned = $identifiant_cned;

        return $this;
    }

    public function getPasswordCned(): ?string
    {
        return $this->password_cned;
    }

    public function setPasswordCned(?string $password_cned): static
    {
        $this->password_cned = $password_cned;

        return $this;
    }

    public function getMoyenPaiement(): ?string
    {
        return $this->moyen_paiement;
    }

    public function setMoyenPaiement(?string $moyen_paiement): static
    {
        $this->moyen_paiement = $moyen_paiement;

        return $this;
    }

    public function getMontant(): ?int
    {
        return $this->montant;
    }

    public function setMontant(?int $montant): static
    {
        $this->montant = $montant;

        return $this;
    }

    public function getDispositifAide(): ?string
    {
        return $this->dispositif_aide;
    }

    public function setDispositifAide(?string $dispositif_aide): static
    {
        $this->dispositif_aide = $dispositif_aide;

        return $this;
    }

    public function getMotif(): ?string
    {
        return $this->Motif;
    }

    public function setMotif(?string $Motif): static
    {
        $this->Motif = $Motif;

        return $this;
    }

    public function getIndicatifCned(): ?string
    {
        return $this->indicatif_cned;
    }

    public function setIndicatifCned(?string $indicatif_cned): static
    {
        $this->indicatif_cned = $indicatif_cned;

        return $this;
    }

    public function getStageDebut(): ?\DateTimeInterface
    {
        return $this->stage_debut;
    }

    public function setStageDebut(?\DateTimeInterface $stage_debut): static
    {
        $this->stage_debut = $stage_debut;

        return $this;
    }

    public function getStageFin(): ?\DateTimeInterface
    {
        return $this->stage_fin;
    }

    public function setStageFin(?\DateTimeInterface $stage_fin): static
    {
        $this->stage_fin = $stage_fin;

        return $this;
    }

    public function getStageEntreprise(): ?string
    {
        return $this->stage_entreprise;
    }

    public function setStageEntreprise(?string $stage_entreprise): static
    {
        $this->stage_entreprise = $stage_entreprise;

        return $this;
    }

    public function getStageTuteur(): ?string
    {
        return $this->stage_tuteur;
    }

    public function setStageTuteur(?string $stage_tuteur): static
    {
        $this->stage_tuteur = $stage_tuteur;

        return $this;
    }

    public function getStageTuteurFonction(): ?string
    {
        return $this->stage_tuteur_fonction;
    }

    public function setStageTuteurFonction(?string $stage_tuteur_fonction): static
    {
        $this->stage_tuteur_fonction = $stage_tuteur_fonction;

        return $this;
    }

    public function getStageTel(): ?string
    {
        return $this->stage_tel;
    }

    public function setStageTel(?string $stage_tel): static
    {
        $this->stage_tel = $stage_tel;

        return $this;
    }

    public function getDateCned(): ?\DateTimeInterface
    {
        return $this->date_cned;
    }

    public function setDateCned(?\DateTimeInterface $date_cned): static
    {
        $this->date_cned = $date_cned;

        return $this;
    }

    public function getStatutCned(): ?string
    {
        return $this->statut_cned;
    }

    public function setStatutCned(?string $statut_cned): static
    {
        $this->statut_cned = $statut_cned;

        return $this;
    }

    public function getDateInscriptionCned(): ?\DateTimeInterface
    {
        return $this->date_inscription_cned;
    }

    public function setDateInscriptionCned(?\DateTimeInterface $date_inscription_cned): static
    {
        $this->date_inscription_cned = $date_inscription_cned;

        return $this;
    }

    public function isComplet(): ?bool
    {
        return $this->complet;
    }

    public function setComplet(?bool $complet): static
    {
        $this->complet = $complet;

        return $this;
    }

    public function getIncomplet(): ?string
    {
        return $this->incomplet;
    }

    public function setIncomplet(?string $incomplet): static
    {
        $this->incomplet = $incomplet;

        return $this;
    }

    public function getStageMail(): ?string
    {
        return $this->stage_mail;
    }

    public function setStageMail(?string $stage_mail): static
    {
        $this->stage_mail = $stage_mail;

        return $this;
    }

    public function getLieuMl(): ?string
    {
        return $this->lieu_ml;
    }

    public function setLieuMl(?string $lieu_ml): static
    {
        $this->lieu_ml = $lieu_ml;

        return $this;
    }

    public function getPermis(): ?string
    {
        return $this->permis;
    }

    public function setPermis(?string $permis): static
    {
        $this->permis = $permis;

        return $this;
    }
}
