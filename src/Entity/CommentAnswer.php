<?php

namespace App\Entity;

use App\Repository\CommentAnswerRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommentAnswerRepository::class)
 */
class CommentAnswer
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="commentAnswers")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Answer::class, inversedBy="commentAnswers")
     */
    private $answer;

    /**
     * @ORM\Column(type="datetime")
     */
    private $uploaded_at;

    /**
     * @ORM\Column(type="integer")
     */
    private $like_up;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $content_com;

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

    public function getAnswer(): ?Answer
    {
        return $this->answer;
    }

    public function setAnswer(?Answer $answer): self
    {
        $this->answer = $answer;

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

    public function getLikeUp(): ?int
    {
        return $this->like_up;
    }

    public function setLikeUp(int $like_up): self
    {
        $this->like_up = $like_up;

        return $this;
    }

    public function getContentCom(): ?string
    {
        return $this->content_com;
    }

    public function setContentCom(string $content_com): self
    {
        $this->content_com = $content_com;

        return $this;
    }
}
