<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     */
    public function blog(PostRepository $repo)
    {
        return $this->render('blog/blog.html.twig', [
            'posts' => $repo->findAll(),
        ]);
    }
    
    /**
     * @Route("/blog/{id}/blog_show", name="blog_show")
     */
    public function blog_show(Post $post): Response
    {
        return $this->render('blog/blog_show.html.twig', [
            'post' => $post,
        ]);
    }

}
