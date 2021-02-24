<?php

namespace App\Entity;

use App\Repository\MarkOfCarsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MarkOfCarsRepository::class)
 */
class MarkOfCars
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
     * @ORM\ManyToOne(targetEntity=Template::class, inversedBy="markOfCars")
     */
    private $template;

    /**
     * @ORM\OneToMany(targetEntity=ModelOfCars::class, mappedBy="mark")
     */
    private $modelOfCars;

    public function __construct()
    {
        $this->modelOfCars = new ArrayCollection();
    }

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

    public function getTemplate(): ?Template
    {
        return $this->template;
    }

    public function setTemplate(?Template $template): self
    {
        $this->template = $template;

        return $this;
    }

    /**
     * @return Collection|ModelOfCars[]
     */
    public function getModelOfCars(): Collection
    {
        return $this->modelOfCars;
    }

    public function addModelOfCar(ModelOfCars $modelOfCar): self
    {
        if (!$this->modelOfCars->contains($modelOfCar)) {
            $this->modelOfCars[] = $modelOfCar;
            $modelOfCar->setMark($this);
        }

        return $this;
    }

    public function removeModelOfCar(ModelOfCars $modelOfCar): self
    {
        if ($this->modelOfCars->removeElement($modelOfCar)) {
            // set the owning side to null (unless already changed)
            if ($modelOfCar->getMark() === $this) {
                $modelOfCar->setMark(null);
            }
        }

        return $this;
    }
}
