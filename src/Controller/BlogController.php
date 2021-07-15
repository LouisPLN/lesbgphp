<?php

namespace App\Controller;

use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class BlogController extends AbstractController
{
    /**
     * @Route("/app/blog", name="blog")
     */
    public function index(): Response
    {

        $repo = $this->getDoctrine()->getRepository(Post::class);

        $posts = $repo->findAll();


        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController', 
            'posts' => $posts
        ]);
    }

    /**
     * @Route("/admin/blog/new", name="blog_create")
     */
    public function create(Request $request, EntityManagerInterface $manager)
    {

        dump($request);

        if($request->request->count() > 0) 
        { 
            $post = new Post;
            
            $post->setTitle($request->request->get('title')) 
                ->setDescription($request->request->get('description')) 
                ->setCreatedAt(new \DateTime()); 
            $manager->persist($post); 
            $manager->flush(); 

            return $this->redirectToRoute('blog');
        }

        return $this->render('blog/create.html.twig'); 
    }
}
