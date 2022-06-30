<?php

namespace App\Components;

use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\Collection;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('project')]
class ProjectComponent
{

    public string $id;
    public string $name;
    public string $description;
    public string $client;
    public Collection $users;
    public string $creationDate;

    public function __construct(private ProjectRepository $projectRepository)
    {
    }
}
