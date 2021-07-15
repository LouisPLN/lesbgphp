<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class ProductController extends AbstractController
{
    /**
     * @Route("/product", name="product")
     */
    public function index(): Response
    {
        $repo = $this->getDoctrine()->getRepository(Product::class);

        $products = $repo->findAll();

        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
            'products' => $products
        ]);
    }

    /**
     * @Route("/product/new", name="product_create")
     */
    public function create(Request $request, EntityManagerInterface $manager)
    {
        if($request->request->count() > 0) 
        { 
            $post = new Product;
            
            $post->setName($request->request->get('name')) 
                ->setDescription($request->request->get('description')) 
                ->setPrice($request->request->get('price'))
                ->setType($request->request->get('type'))
                ->setStock($request->request->get('stock'))
                ->setUrlImg($request->request->get('img')); 
            $manager->persist($post); 
            $manager->flush(); 

            return $this->redirectToRoute('product');
        }

        return $this->render('product/create.html.twig'); 
    }
}
