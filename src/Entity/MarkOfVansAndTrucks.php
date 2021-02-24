<?php

namespace App\Entity;

use App\Repository\MarkOfVansAndTrucksRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MarkOfVansAndTrucksRepository::class)
 */
class MarkOfVansAndTrucks
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=Template::class, inversedBy="markOfVansAndTrucks")
     */
    private $template;

    /**
     * @ORM\ManyToOne(targetEntity=ChildrenCategory::class, inversedBy="markOfVansAndTrucks")
     */
    private $childrenCategory;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getTemplate(): ?Template
    {
        return $this->template;
    }

    public function setTemplate(?Template $template): self
    {
        $this->template = $template;

        return $this;
    }

    public function getChildrenCategory(): ?ChildrenCategory
    {
        return $this->childrenCategory;
    }

    public function setChildrenCategory(?ChildrenCategory $childrenCategory): self
    {
        $this->childrenCategory = $childrenCategory;

        return $this;
    }
}
