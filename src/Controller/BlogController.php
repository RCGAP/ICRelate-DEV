<?php

namespace App\Controller;

use App\Entity\BlogPost;
use App\Repository\BlogPostRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     */
    public function blog(BlogPostRepository $repo)
    {
        return $this->render('blog/blog.html.twig', [
            'posts' => $repo->findAll(),
        ]);
    }
    
    /**
     * @Route("/blog/{id}/blog_show", name="blog_show")
     */
    public function blog_show(BlogPost $post): Response
    {
        return $this->render('blog/blog_show.html.twig', [
            'post' => $post,
        ]);
    }

}
