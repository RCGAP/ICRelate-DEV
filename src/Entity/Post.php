<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @apiResource(attributes={
 *          "formats"={"json"}})
 * @ORM\Entity(repositoryClass="App\Repository\PostRepository")
 */
class Post
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $introduction;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\OneToMany(targetEntity=PostLike::class, mappedBy="post", orphanRemoval=true)
     */
    private $postLikes;

    /**
     * @ORM\OneToMany(targetEntity=PostDislike::class, mappedBy="post")
     */
    private $dislikes;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $youtube;

    public function __construct()
    {
        $this->postLikes = new ArrayCollection();
        $this->dislikes = new ArrayCollection();
    }
    public function __toString()
    {
        return $this->title;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getIntroduction(): ?string
    {
        return $this->introduction;
    }

    public function setIntroduction(string $introduction): self
    {
        $this->introduction = $introduction;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return Collection|PostLike[]
     */
    public function getPostLikes(): Collection
    {
        return $this->postLikes;
    }

    public function addPostLike(PostLike $postLike): self
    {
        if (!$this->postLikes->contains($postLike)) {
            $this->postLikes[] = $postLike;
            $postLike->setPost($this);
        }

        return $this;
    }

    public function removePostLike(PostLike $postLike): self
    {
        if ($this->postLikes->removeElement($postLike)) {
            // set the owning side to null (unless already changed)
            if ($postLike->getPost() === $this) {
                $postLike->setPost(null);
            }
        }

        return $this;
    }
    public function isLikedByUser(User $user): bool
    {
        foreach ($this->postLikes as $postLike) {
            if ($postLike->getUser() === $user) return true;
        }
        return false;
    }

    /**
     * @return Collection|PostDislike[]
     */
    public function getDislikes(): Collection
    {
        return $this->dislikes;
    }

    public function addDislike(PostDislike $dislike): self
    {
        if (!$this->dislikes->contains($dislike)) {
            $this->dislikes[] = $dislike;
            $dislike->setPost($this);
        }

        return $this;
    }

    public function removeDislike(PostDislike $dislike): self
    {
        if ($this->dislikes->removeElement($dislike)) {
            // set the owning side to null (unless already changed)
            if ($dislike->getPost() === $this) {
                $dislike->setPost(null);
            }
        }

        return $this;
    }

    public function isDislikedByUser(User $user): bool
    { foreach($this->dislikes as $dislike){
        if($dislike->getUser() === $user){
        return true;
        }
    }

    return false;
    }

        public function getYoutube(): ?string
        {
            return $this->youtube;
        }

        public function setYoutube(?string $youtube): self
        {
            $this->youtube = $youtube;

            return $this;
        }
}
