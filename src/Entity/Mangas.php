<?php

namespace App\Entity;

use App\Repository\MangasRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MangasRepository::class)]
class Mangas
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_parution = null;

    #[ORM\Column]
    private ?int $nb_tomes = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $statut = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $genre = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\ManyToOne(inversedBy: 'mangas')]
    #[ORM\JoinColumn(nullable: false)]
    public ?Auteur $auteur_id = null;

    #[ORM\OneToMany(mappedBy: 'manga_id', targetEntity: Commentaires::class)]
    private Collection $commentaires;

    public function __construct()
    {
        $this->commentaires = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDateParution(): ?\DateTimeInterface
    {
        return $this->date_parution;
    }

    public function setDateParution(\DateTimeInterface $date_parution): self
    {
        $this->date_parution = $date_parution;

        return $this;
    }

    public function getNbTomes(): ?int
    {
        return $this->nb_tomes;
    }

    public function setNbTomes(int $nb_tomes): self
    {
        $this->nb_tomes = $nb_tomes;

        return $this;
    }

    public function getStatut(): ?int
    {
        return $this->statut;
    }

    public function setStatut(int $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getAuteurId(): ?Auteur
    {
        return $this->auteur_id;
    }

    public function setAuteurId(?Auteur $auteur_id): self
    {
        $this->auteur_id = $auteur_id;

        return $this;
    }

    /**
     * @return Collection<int, Commentaires>
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Commentaires $commentaire): self
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires->add($commentaire);
            $commentaire->setMangaId($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaires $commentaire): self
    {
        if ($this->commentaires->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getMangaId() === $this) {
                $commentaire->setMangaId(null);
            }
        }

        return $this;
    }
}
