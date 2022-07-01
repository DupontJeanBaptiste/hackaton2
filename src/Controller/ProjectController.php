<?php

namespace App\Controller;

use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/project')]
class ProjectController extends AbstractController
{
    #[Route('/', name: 'project_index')]
    public function index(ProjectRepository $projectRepository): Response
    {
        $projects = $projectRepository->findAll();

        return $this->render(
            'project/project.html.twig',
            [
                'projects' => $projects,
            ]
        );
    }

    #[Route('/search', name: 'app_search')]
    public function search(): Response
    {
        return $this->render('project/search.html.twig', [
            'controller_name' => 'ProjectController',
        ]);
    }
}
