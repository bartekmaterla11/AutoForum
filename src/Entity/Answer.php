<?php

namespace App\Entity;

use App\Repository\AnswerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AnswerRepository::class)
 */
class Answer
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="answers")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Post::class, inversedBy="answers")
     */
    private $post;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $content;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $file;

    /**
     * @ORM\Column(type="datetime")
     */
    private $uploadedAt;

    /**
     * @ORM\OneToMany(targetEntity=CommentAnswer::class, mappedBy="answer")
     */
    private $commentAnswers;

    /**
     * @ORM\Column(type="integer")
     */
    private $likeUp;

    public function __construct()
    {
        $this->commentAnswers = new ArrayCollection();
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

    public function getPost(): ?Post
    {
        return $this->post;
    }

    public function setPost(?Post $post): self
    {
        $this->post = $post;

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

    public function getFile(): ?string
    {
        return $this->file;
    }

    public function setFile(?string $file): self
    {
        $this->file = $file;

        return $this;
    }

    public function getUploadedAt(): ?\DateTimeInterface
    {
        return $this->uploadedAt;
    }

    public function setUploadedAt(\DateTimeInterface $uploadedAt): self
    {
        $this->uploadedAt = $uploadedAt;

        return $this;
    }

    /**
     * @return Collection|CommentAnswer[]
     */
    public function getCommentAnswers(): Collection
    {
        return $this->commentAnswers;
    }

    public function addCommentAnswer(CommentAnswer $commentAnswer): self
    {
        if (!$this->commentAnswers->contains($commentAnswer)) {
            $this->commentAnswers[] = $commentAnswer;
            $commentAnswer->setAnswer($this);
        }

        return $this;
    }

    public function removeCommentAnswer(CommentAnswer $commentAnswer): self
    {
        if ($this->commentAnswers->removeElement($commentAnswer)) {
            // set the owning side to null (unless already changed)
            if ($commentAnswer->getAnswer() === $this) {
                $commentAnswer->setAnswer(null);
            }
        }

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

}
