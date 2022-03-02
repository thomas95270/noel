<?php

namespace App\Controller;

use App\Repository\BouleRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FrontController extends AbstractController
{
    //Accueil
    #[Route('/', name: 'accueil')]
    public function index(BouleRepository $bouleRepository): Response
    {
        $boules = $bouleRepository->findAll();
        return $this->render('front/index.html.twig', [
            'boules' => $boules,
        ]);
    }

    //Produit
    #[Route('/produit/{titre}/{id}', name:'produit')]
    public function produit($titre, $id, BouleRepository $bouleRepository): Response
    {   
        $boule = $bouleRepository->find($id);
        $message='promotion';
        return $this->render('front/produit.html.twig', [
            'boule'=>$boule,
            'message'=>$message
        ]);
    }

}
