<?php

namespace App\Controller;

use App\Entity\Pets;
use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AccueilController extends AbstractController
{
    /**
     * @Route("/app/accueil", name="accueil")
     */
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        $lastUsername = $authenticationUtils->getLastUsername();

        $repoPets = $this->getDoctrine()->getRepository(Pets::class);

        $pets = $repoPets->findLastPets();

        $repoProduct = $this->getDoctrine()->getRepository(Product::class);

        $product = $repoProduct->findLastProducts();

        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
            'last_username' => $lastUsername,
            'pets' => $pets,
            'products' => $product
        ]);
    }
}
