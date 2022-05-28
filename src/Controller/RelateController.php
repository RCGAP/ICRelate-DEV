<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\PostLike;
use App\Entity\PostDislike;
use App\Repository\PostLikeRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\PostDislikeRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RelateController extends AbstractController
{
/**
     * @Route("/post/{id}/icanrelate",name="like")
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

    /**
     * @Route("/post/{id}/idontrelate",name="dislike")
     */
    public function dislike(Post $post, EntityManagerInterface $Manager, PostDislikeRepository $dislikeRepo): Response
    {
        $user = $this->getUser();
        if (!$user) return $this->json([
            'code' => '403',
            'message' => 'non autorisé'
        ], 403);
        if ($post->isDislikedByUser($user)) {
            $Postdislike = $dislikeRepo->findOneBy([
                'post' => $post,
                'user' => $user
            ]);
            $Manager->remove($Postdislike);
            $Manager->flush();
            return $this->json([
                'code' => 200,
                'message' => 'dislike bien supprimé',
                'likes' => $dislikeRepo->count([
                    'post' => $post
                ])
            ], 200);
        }
        $Postdislike = new PostDislike();
        $Postdislike->setPost($post)
            ->setUser($user);
        $Manager->persist($Postdislike);
        $Manager->flush();

        return $this->json([
            'code' => 200,
            'message' => 'dislike bien ajouté"',
            'likes' => $dislikeRepo->count([
                'post' => $post
            ])

        ], 200);
    }
}
