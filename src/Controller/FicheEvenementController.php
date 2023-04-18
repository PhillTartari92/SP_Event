<?php

namespace App\Controller;

use App\Entity\AjoutEvenement;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FicheEvenementController extends AbstractController
{
    #[Route('/fiche/evenement/{id}', name: 'app_fiche_evenement', methods: ['GET'])]
    public function index( AjoutEvenement $ajoutEvenement): Response
    {

        return $this->render('fiche_evenement/index.html.twig', [
            'events' => $ajoutEvenement,
            
        ]);
    }
}
