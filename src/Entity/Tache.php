<?php

namespace App\Entity;

use App\Repository\TacheRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TacheRepository::class)]
class Tache
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'text')]
    private $description;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $label;

    #[ORM\Column(type: 'string', length: 255)]
    private $status;

    #[ORM\Column(type: 'boolean')]
    private $freeacess;

    #[ORM\Column(type: 'integer')]
    private $numberrequire;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'tache')]
    private $users;

    #[ORM\ManyToOne(targetEntity: Sprint::class, inversedBy: 'taches')]
    #[ORM\JoinColumn(nullable: false)]
    private $sprint;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(?string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function isFreeacess(): ?bool
    {
        return $this->freeacess;
    }

    public function setFreeacess(bool $freeacess): self
    {
        $this->freeacess = $freeacess;

        return $this;
    }

    public function getNumberrequire(): ?int
    {
        return $this->numberrequire;
    }

    public function setNumberrequire(int $numberrequire): self
    {
        $this->numberrequire = $numberrequire;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->addTache($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            $user->removeTache($this);
        }

        return $this;
    }

    public function getSprint(): ?Sprint
    {
        return $this->sprint;
    }

    public function setSprint(?Sprint $sprint): self
    {
        $this->sprint = $sprint;

        return $this;
    }
}
