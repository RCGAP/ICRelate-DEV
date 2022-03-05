<?php

namespace App\Entity;

use App\Repository\PostDislikeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PostDislikeRepository::class)
 */
class PostDislike
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Post::class, inversedBy="dislikes")
     */
    private $post;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="dislikes")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPost(): ?Post
    {
        return $this->post;
    }

    public function setPost(?Post $post): self
    {
        $this->post = $post;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
