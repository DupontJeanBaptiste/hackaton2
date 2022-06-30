<?php

namespace App\Entity;

use App\Repository\SprintRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SprintRepository::class)]
class Sprint
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $number;

    #[ORM\Column(type: 'text')]
    private $description;

    #[ORM\Column(type: 'datetime', length: 255)]
    private $creationdate;

    #[ORM\Column(type: 'datetime', length: 255)]
    private $enddate;

    #[ORM\ManyToOne(targetEntity: Project::class, inversedBy: 'sprints')]
    #[ORM\JoinColumn(nullable: false)]
    private $project;

    #[ORM\OneToMany(mappedBy: 'sprint', targetEntity: Tache::class)]
    private $taches;

    public function __construct()
    {
        $this->taches = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

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

    public function getCreationdate(): ?DateTime
    {
        return $this->creationdate;
    }

    public function setCreationdate(DateTime $creationdate): self
    {
        $this->creationdate = $creationdate;

        return $this;
    }

    public function getEnddate(): ?DateTime
    {
        return $this->enddate;
    }

    public function setEnddate(DateTime $enddate): self
    {
        $this->enddate = $enddate;

        return $this;
    }

    public function getProject(): ?Project
    {
        return $this->project;
    }

    public function setProject(?Project $project): self
    {
        $this->project = $project;

        return $this;
    }

    /**
     * @return Collection<int, Tache>
     */
    public function getTaches(): Collection
    {
        return $this->taches;
    }

    public function addTach(Tache $tach): self
    {
        if (!$this->taches->contains($tach)) {
            $this->taches[] = $tach;
            $tach->setSprint($this);
        }

        return $this;
    }

    public function removeTach(Tache $tach): self
    {
        if ($this->taches->removeElement($tach)) {
            // set the owning side to null (unless already changed)
            if ($tach->getSprint() === $this) {
                $tach->setSprint(null);
            }
        }

        return $this;
    }
}
