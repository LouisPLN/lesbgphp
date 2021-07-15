<?php

namespace App\Controller;

use App\Entity\Pets;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class PetsController extends AbstractController
{
    /**
     * @Route("/pets", name="pets")
     */
    public function index(): Response
    {
        $repo = $this->getDoctrine()->getRepository(Pets::class);

        $pets = $repo->findAll();

        return $this->render('pets/index.html.twig', [
            'controller_name' => 'PetsController',
            'pets' => $pets
        ]);
    }

    /**
     * @Route("/pets/new", name="pets_create")
     */
    public function create(Request $request, EntityManagerInterface $manager)
    {
        if($request->request->count() > 0) 
        { 
            $post = new Pets;
            
            $post->setName($request->request->get('name')) 
                ->setType($request->request->get('type'))
                ->setRace($request->request->get('race'))
                ->setAge($request->request->get('age'))
                ->setWeight($request->request->get('weight')) 
                ->setColor($request->request->get('color'))
                ->setState($request->request->get('state'))
                ->setUrlImg($request->request->get('img')); 
            $manager->persist($post); 
            $manager->flush(); 

            return $this->redirectToRoute('pets');
        }

        return $this->render('pets/create.html.twig'); 
    }
}
