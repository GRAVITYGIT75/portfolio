<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route("/", name: "app_home")]
    public function index(): Response
    {
        return $this->render('home.html.twig', [
            'projects' => $this->getDummyProjects()
        ]);
    }

    private function getDummyProjects(): array
    {
        return [
            [
                'title' => 'Interface Quantique',
                'description' => 'Système de gestion de données quantiques',
                'tags' => ['AI', 'Quantique', 'React'],
                'image' => 'quantum.jpg'
            ],
            [
                'title' => 'Réseau Neural',
                'description' => 'Architecture de réseau neuronal profond',
                'tags' => ['Machine Learning', 'Python'],
                'image' => 'neural.jpg'
            ],
            [
                'title' => 'Hologram OS',
                'description' => 'Système d\'exploitation holographique',
                'tags' => ['UI/UX', 'Holographie'],
                'image' => 'hologram.jpg'
            ]
        ];
    }
}
