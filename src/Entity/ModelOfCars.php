<?php

namespace App\Entity;

use App\Repository\ModelOfCarsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ModelOfCarsRepository::class)
 */
class ModelOfCars
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
     * @ORM\ManyToOne(targetEntity=MarkOfCars::class, inversedBy="modelOfCars")
     */
    private $mark;

    public function __toString()
    {
        return $this->getName();
    }

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

    public function getMark(): ?MarkOfCars
    {
        return $this->mark;
    }

    public function setMark(?MarkOfCars $mark): self
    {
        $this->mark = $mark;

        return $this;
    }
}
