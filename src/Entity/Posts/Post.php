<?php

namespace App\Entity\Posts;

use App\Entity\User;
use App\Repository\Posts\PostRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PostRepository::class)
 */
class Post
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="posts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="datetime")
     */
    private $uploaded_at;

    /**
     * @ORM\Column(type="string", length=3000)
     */
    private $content;

    /**
     * @ORM\OneToMany(targetEntity=Answer::class, mappedBy="post")
     */
    private $answers;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="integer")
     */
    private $likeUp;

    /**
     * @ORM\OneToMany(targetEntity=PhotoFilesForPosts::class, mappedBy="post", cascade={"persist"})
     * @ORM\JoinColumn (nullable=true)
     */
    private $photoFilesForPosts;

    /**
     * @ORM\ManyToOne(targetEntity=CategoryPost::class, inversedBy="post")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    public function __construct()
    {
        $this->answers = new ArrayCollection();
        $this->photoFilesForPosts = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
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

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getUploadedAt(): ?\DateTimeInterface
    {
        return $this->uploaded_at;
    }

    public function setUploadedAt(\DateTimeInterface $uploaded_at): self
    {
        $this->uploaded_at = $uploaded_at;

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
     * @return Collection|Answer[]
     */
    public function getAnswers(): Collection
    {
        return $this->answers;
    }

    public function addAnswer(Answer $answer): self
    {
        if (!$this->answers->contains($answer)) {
            $this->answers[] = $answer;
            $answer->setPost($this);
        }

        return $this;
    }

    public function removeAnswer(Answer $answer): self
    {
        if ($this->answers->removeElement($answer)) {
            // set the owning side to null (unless already changed)
            if ($answer->getPost() === $this) {
                $answer->setPost(null);
            }
        }

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getLikeUp(): ?int
    {
        return $this->likeUp;
    }

    public function setLikeUp(int $likeUp): self
    {
        $this->likeUp = $likeUp;

        return $this;
    }

    /**
     * @return Collection|PhotoFilesForPosts[]
     */
    public function getPhotoFilesForPosts(): Collection
    {
        return $this->photoFilesForPosts;
    }

    public function addPhotoFilesForPost(PhotoFilesForPosts $photoFilesForPost): self
    {
        if (!$this->photoFilesForPosts->contains($photoFilesForPost)) {
            $this->photoFilesForPosts[] = $photoFilesForPost;
            $photoFilesForPost->setPost($this);
        }

        return $this;
    }

    public function removePhotoFilesForPost(PhotoFilesForPosts $photoFilesForPost): self
    {
        if ($this->photoFilesForPosts->removeElement($photoFilesForPost)) {
            // set the owning side to null (unless already changed)
            if ($photoFilesForPost->getPost() === $this) {
                $photoFilesForPost->setPost(null);
            }
        }

        return $this;
    }

    public function getCategory(): ?CategoryPost
    {
        return $this->category;
    }

    public function setCategory(?CategoryPost $category): self
    {
        $this->category = $category;

        return $this;
    }
}
