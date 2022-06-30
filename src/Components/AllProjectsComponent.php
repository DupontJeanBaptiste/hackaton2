<?php

namespace App\Components;

use App\Repository\ProjectRepository;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('all_projects')]
class AllProjectsComponent
{
    public function __construct(private ProjectRepository $projectRepository){
    
    }

    public function getAllProjects(){
        return $this->projectRepository->findAll();
    }
}
