<?php

namespace App\Controller;

use App\Entity\Bottle;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(ManagerRegistry $managerRegistry): Response
    {
        $bottleRepository = $managerRegistry->getRepository(Bottle::class);
        $bottles = $bottleRepository->findAll();
        return $this->render('home/index.html.twig', [
            'bottles' => $bottles,
        ]);
    }
}
