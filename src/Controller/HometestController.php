<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HometestController extends AbstractController
{
    #[Route('/hometest', name: 'app_hometest')]
    public function index(): Response
    {
        return $this->render('hometest/index.html.twig', [
            'controller_name' => 'HometestController',
        ]);
    }
}
