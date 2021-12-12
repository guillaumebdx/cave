<?php

namespace App\Controller;

use App\Entity\Cepage;
use App\Entity\Region;
use App\Entity\Wine;
use App\Repository\BottleRepository;
use App\Repository\WineRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BottleController extends AbstractController
{

    /**
     * @Route("/bottle/{region}/cepage/{cepage}", name="bottle")
     */
    public function index(Region $region,
                          Cepage $cepage,
                          ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $wineRepository = $doctrine->getRepository(Wine::class);
        $wines = $wineRepository->findAll();
        dd($wines);
        return $this->render('bottle/index.html.twig', [
            'controller_name' => 'BottleController',
        ]);
    }

    /**
     * @Route("/wine/play", name="wine_play")
     */
    public function play(ManagerRegistry $doctrine)
    {
        $wineRepository = $doctrine->getRepository(Wine::class);
        $chateauDeSable = $wineRepository->findByColor('rosé');
        $wines = $wineRepository->findAll();


        dd($wines);

        return $this->render('bottle/index.html.twig', [
            'controller_name' => 'BottleController',
        ]);
    }
}
