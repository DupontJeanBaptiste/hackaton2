<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjectRepository::class)]
class Project
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'text')]
    private $description;

    #[ORM\Column(type: 'string', length: 255)]
    private $client;

    #[ORM\Column(type: 'boolean')]
    private $status;

    #[ORM\Column(type: 'string', length: 255)]
    private $po;

    #[ORM\Column(type: 'datetime', length: 255)]
    private $creationdate;

    #[ORM\Column(type: 'datetime', length: 255)]
    private $enddate;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'project')]
    private $users;

    #[ORM\OneToMany(mappedBy: 'project', targetEntity: Sprint::class)]
    private $sprints;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->sprints = new ArrayCollection();
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

    public function getClient(): ?string
    {
        return $this->client;
    }

    public function setClient(string $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function isStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getPo(): ?string
    {
        return $this->po;
    }

    public function setPo(string $po): self
    {
        $this->po = $po;

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
            $user->addProject($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            $user->removeProject($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Sprint>
     */
    public function getSprints(): Collection
    {
        return $this->sprints;
    }

    public function addSprint(Sprint $sprint): self
    {
        if (!$this->sprints->contains($sprint)) {
            $this->sprints[] = $sprint;
            $sprint->setProject($this);
        }

        return $this;
    }

    public function removeSprint(Sprint $sprint): self
    {
        if ($this->sprints->removeElement($sprint)) {
            // set the owning side to null (unless already changed)
            if ($sprint->getProject() === $this) {
                $sprint->setProject(null);
            }
        }

        return $this;
    }
}
