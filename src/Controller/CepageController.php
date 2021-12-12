<?php

namespace App\Controller;

use App\Form\CepageType;
use App\Entity\Cepage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CepageController extends AbstractController
{

    /**
     * @Route("/cepage-create", name="cepage-create")
     */
    public function create(EntityManagerInterface $entityManager, Request $request)
    {
        $cepage = new Cepage();
        $form = $this->createForm(CepageType::class, $cepage);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($cepage);
            $entityManager->flush();
            return $this->redirectToRoute('cepage-create');
        }
        $cepages = $entityManager->getRepository(Cepage::class)->findAll();
        return $this->renderForm('cepage/index.html.twig', [
            'form' => $form,
            'cepages' => $cepages
        ]);
    }

    /**
     * @Route("/cepage", name="cepage")
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $cepages = ['Cabernet Sauvignon', 'Merlot', 'Pinot Noir', 'Chardonnay'];
        foreach ($cepages as $cepageVariety) {
            $cepage = new Cepage();
            $cepage->setVariety($cepageVariety);
            $entityManager->persist($cepage);
        }
        $entityManager->flush();

        return $this->render('cepage/index.html.twig', [
            'controller_name' => 'CepageController',
        ]);
    }
}
