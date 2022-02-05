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
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class PostController extends AbstractController
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
        return $this->render('post/favoris.html.twig', [
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

    /**
     * @Route("/post/{id}/likes",name="like")
     */
    public function like(Post $post, EntityManagerInterface $Manager, PostLikeRepository $likeRepo): Response
    {
        $user = $this->getUser();
        if (!$user) return $this->json([
            'code' => '403',
            'message' => 'non autorisé'
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
                'message' => 'Like bien supprimé',
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
            'message' => 'Like bien ajouté"',
            'likes' => $likeRepo->count([
                'post' => $post
            ])

        ], 200);
    }
}
