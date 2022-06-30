<?php

namespace App\Controller;

use App\Entity\Project;
use App\Entity\User;
use App\Repository\ProjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/project')]
class ProjectController extends AbstractController
{
    #[Route('/', name: 'project_index')]
    public function index(): Response
    {
        return $this->render('project.html.twig');
    }

    #[Route('/save/{id}', name: 'project_save')]
    public function saveProject(Project $project, EntityManagerInterface $em ): Response
    {
        $user = $this->getUser();
        $isOnProject = $user->isOnProject($project);
        if ($isOnProject) {
            $user->removeProject($project);
            $isOnProject = false;
        } else {
            $user->addProject($project);
            $isOnProject = true;
        }

        $em->flush();

        return $this->json(['isOnProject' => $isOnProject]);
    }
}
