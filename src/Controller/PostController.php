<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\PostLike;
use App\Repository\PostLikeRepository;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(PostRepository $repo)
    {
        return $this->render('post/index.html.twig', [
            'posts' => $repo->findAll(),
        ]);
    }
    /**
     * @Route("/post/{id}/likes",name="like")
     */
    public function like(Post $post, EntityManagerInterface $Manager, PostLikeRepository $likeRepo): Response
    {
        $user = $this->getUser();
        if (!$user) return $this->json([
            'code' => '403',
            'message' => 'non authoriser'
        ], 403);
        if ($post->isLikedByUser($user)) {
            $like = $likeRepo->findOneBy([
                'post' => $post,
                'user' => $user
            ]);
            $Manager->remove($like);
            $Manager->flush();
            return $this->json([
                'code' => 200,
                'message' => 'Like bien supprime',
                'likes' => $likeRepo->count([
                    'post' => $post
                ])
            ], 200);
        }
        $like = new PostLike();
        $like->setPost($post)
            ->setUser($user);
        $Manager->persist($like);
        $Manager->flush();

        return $this->json([
            'code' => 200,
            'message' => 'Like bien ajoute',
            'likes' => $likeRepo->count([
                'post' => $post
            ])

        ], 200);
    }
}
