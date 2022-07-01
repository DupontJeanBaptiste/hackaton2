<?php

namespace App\Components;

use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\Collection;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\LiveComponent\Attribute\LiveProp;

#[AsLiveComponent('project_search')]
class ProjectSearchComponent
{
    use DefaultActionTrait;


    #[LiveProp(writable: true)]
    public string $query = '';

    public function __construct(
        private ProjectRepository $ProjectRepository
    ) 
    {
        $this->ProjectRepository = $ProjectRepository;
    }

    public function getProjectsByQuery(): array
    {
        return $this->ProjectRepository->findByQuery($this->query);
    }
}
