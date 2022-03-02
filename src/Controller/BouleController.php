<?php

namespace App\Controller;

use App\Entity\Boule;
use App\Form\BouleType;
use App\Form\CategoryType;
use Doctrine\ORM\EntityManager;
use App\Repository\BouleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BouleController extends AbstractController
{

    //PAGE DES BOULES
    #[Route('/boule', name: 'boule')]
    public function index(BouleRepository $bouleRepository): Response
    {
        $boules=$bouleRepository->findAll();
        return $this->render('boule/index.html.twig', [
            'boules'=> $boules
            ]);
    }

    //AJOUTER BOULES
    #[Route('/boule/ajouter', name: 'boule_ajouter')]
    public function bouleAjouter(Request $request, EntityManagerInterface $manager): Response
    {
        $boule = new Boule;
        $form = $this->createForm(BouleType::class, $boule, [
            'method' => 'POST'
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid() ){
            $manager->persist($boule);
            $manager->flush();
            $this->addFlash('success', 'La boule a été ajoutée.');
            return $this->redirectToRoute('boule');
        }
        
        return $this->render('boule/boule_ajouter.html.twig',[
            'formBoule' => $form->createView()
            ]);
    }


}
