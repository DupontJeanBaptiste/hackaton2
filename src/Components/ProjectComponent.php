<?php

namespace App\Components;

use App\Entity\Project;
use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\Collection;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('project')]
class ProjectComponent
{

    public Project $project;
    public string $id;
    public string $name;
    public string $description;
    public string $client;
    public Collection $users;
    public string $creationDate;

    public function __construct(private ProjectRepository $projectRepository)
    {
    }

    public function getProject(): Project
    {
        return $this->blogRepository->find($this->id);
    }

}

