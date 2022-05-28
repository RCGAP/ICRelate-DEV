<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{   
    
    
    /**
     * @Route("/", name="homepage")
     */
    public function index(PostRepository $repo)
    {

        $quotes = $this->getDoctrine()
            ->getRepository(post::class)
            ->findAll();

            $key = array_rand($quotes);
            $random = $quotes[$key];


        return $this->render('index.html.twig', [
            'quote' => $random,
        ]);
    }
    /**
     * @Route("/favoris", name="favoris")
     */
    public function favoris(PostRepository $repo)
    {
        return $this->render('favoris.html.twig', [
            'posts' => $repo->findAll(),
        ]);
    }

    /**
     * @Route("/about", name="about")
     */
    public function about()
    {
        return $this->render('about.html.twig', [
        ]);
    }
}
