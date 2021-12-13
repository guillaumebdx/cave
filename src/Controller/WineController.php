<?php

namespace App\Controller;

use App\Entity\Region;
use App\Entity\Wine;
use App\Form\WineType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/wine", name="wine_")
 */
class WineController extends AbstractController
{
    /**
     * @Route("/create-wine", name="create-wine")
     */
    public function create(EntityManagerInterface $entityManager, Request $request)
    {
        dump($this->getUser());
        $wine = new Wine();
        $form = $this->createForm(WineType::class, $wine);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($wine);
            $entityManager->flush();
            return $this->redirectToRoute('wine_create-wine');
        }

        return $this->renderForm('wine/index.html.twig', [
            'form' => $form,
        ]);
    }
    /**
     * @Route("/play", name="index")
     */
    public function play(EntityManagerInterface $entityManager)
    {
        $region = new Region();
        $region->setName('Languedoc');
        $entityManager->persist($region);

        $wine = new Wine();
        $wine->setName('Côtes de Provence');
        $wine->setColor('rosé');
        $wine->setRegion($region);

        $entityManager->persist($wine);
        $entityManager->flush();

        dd($wine);
    }

    /**
     * @Route("/", name="all")
     */
    public function index(): Response
    {
        $wines = [
            'Chateau de Chablis',
            'Domaine de Chateauneuf-du-Pape',
            'Pessac-Léognan',
            'Sancerre',
            'Château de Chateauneuf-du-Pape',
            'Château de Chablis',
        ];
        dump($wines);
        return $this->render('wine/index.html.twig', [
            'wines' => $wines,
        ]);
    }

    /**
     * @Route("/insert", name="insert")
     */
    public function insert(): Response
    {
        return $this->render('wine/insert.html.twig');
    }
}
