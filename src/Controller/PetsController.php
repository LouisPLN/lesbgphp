<?php

namespace App\Controller;

use App\Entity\Pets;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
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
     * @Route("/pets/{id}", name="pets_id")
     */
    public function detail(int $id): Response
    {
        $pet = $this->getDoctrine()
            ->getRepository(Pets::class)
            ->find($id);

        $session = new Session();
        
        $userID = $session->get('user_mail');
        
        if($userID = ""){
            throw $this->createNotFoundException(
                'User no found'
            );
        }

        if (!$pet) {
            throw $this->createNotFoundException(
                'No pets found for id '.$id
            );
        }
        
        return $this->render('pets/detail.html.twig', [
            'pet' => $pet,
            'userId' => $userID,
        ]);
    }

    /**
     * @Route("/admin/pets/new", name="pets_create")
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

    /**
     * @Route("/pets/adopt", name="pets_adopt")
     */
    public function adoption(int $id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $pet = $entityManager->getRepository(Pets::class)->find($id);

        if (!$pet) {
            throw $this->createNotFoundException(
                'No Pet found for id '.$id
            );
        }

        //$product->setName('New product name!');
        //$entityManager->flush();

        return $this->redirectToRoute('pets_id', [
            'id' => $pet->getId()
        ]);

    }
}
