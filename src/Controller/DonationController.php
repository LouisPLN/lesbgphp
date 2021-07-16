<?php

namespace App\Controller;

use App\Entity\Donation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class DonationController extends AbstractController
{
    /**
     * @Route("/app/donation", name="donation")
     */
    public function index(): Response
    {
        $repo = $this->getDoctrine()->getRepository(Donation::class);

        $donations = $repo->findAllDesc();

        return $this->render('donation/index.html.twig', [
            'controller_name' => 'DonationController',
            'donations' => $donations
        ]);
    }

    /**
     * @Route("/app/donation/new", name="donation_create")
     */
    public function create(Request $request, EntityManagerInterface $manager)
    {
        if($request->request->count() > 0) 
        { 
            $post = new Donation;
            $date = new \DateTime();

            
            $post->setAmount($request->request->get('amount')) 
                 ->setDate($date)
                 ->setUser($this->getUser());
            $manager->persist($post); 
            $manager->flush(); 

            return $this->redirectToRoute('donation');
        }

        return $this->render('donation/create.html.twig'); 
    }
}
