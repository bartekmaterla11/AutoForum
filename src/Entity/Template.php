<?php

namespace App\Entity;

use App\Repository\TemplateRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TemplateRepository::class)
 */
class Template
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
     * @ORM\ManyToMany(targetEntity=Attribute::class, inversedBy="templates")
     */
    private $attribute;

    /**
     * @ORM\OneToMany(targetEntity=Offer::class, mappedBy="template")
     */
    private $offer;

    /**
     * @ORM\OneToMany(targetEntity=MarkOfCars::class, mappedBy="template")
     */
    private $markOfCars;

    /**
     * @ORM\OneToMany(targetEntity=MarkOfVansAndTrucks::class, mappedBy="template")
     */
    private $markOfVansAndTrucks;

    /**
     * @ORM\OneToOne(targetEntity=MainCategory::class, inversedBy="template", cascade={"persist", "remove"})
     */
    private $category;

    /**
     * @ORM\OneToMany(targetEntity=MarkOfMotors::class, mappedBy="template")
     */
    private $markOfMotors;

    public function __construct()
    {
        $this->attribute = new ArrayCollection();
        $this->markOfCars = new ArrayCollection();
        $this->markOfVansAndTrucks = new ArrayCollection();
        $this->markOfMotors = new ArrayCollection();
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

    /**
     * @return Collection|Attribute[]
     */
    public function getAttribute(): Collection
    {
        return $this->attribute;
    }

    public function addAttribute(Attribute $attribute): self
    {
        if (!$this->attribute->contains($attribute)) {
            $this->attribute[] = $attribute;
        }

        return $this;
    }

    public function removeAttribute(Attribute $attribute): self
    {
        $this->attribute->removeElement($attribute);

        return $this;
    }

    public function getOffer(): ?Offer
    {
        return $this->offer;
    }

    public function setOffer(?Offer $offer): self
    {
        $this->offer = $offer;

        return $this;
    }

    /**
     * @return Collection|MarkOfCars[]
     */
    public function getMarkOfCars(): Collection
    {
        return $this->markOfCars;
    }

    public function addMarkOfCar(MarkOfCars $markOfCar): self
    {
        if (!$this->markOfCars->contains($markOfCar)) {
            $this->markOfCars[] = $markOfCar;
            $markOfCar->setTemplate($this);
        }

        return $this;
    }

    public function removeMarkOfCar(MarkOfCars $markOfCar): self
    {
        if ($this->markOfCars->removeElement($markOfCar)) {
            // set the owning side to null (unless already changed)
            if ($markOfCar->getTemplate() === $this) {
                $markOfCar->setTemplate(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|MarkOfVansAndTrucks[]
     */
    public function getMarkOfVansAndTrucks(): Collection
    {
        return $this->markOfVansAndTrucks;
    }

    public function addMarkOfVansAndTruck(MarkOfVansAndTrucks $markOfVansAndTruck): self
    {
        if (!$this->markOfVansAndTrucks->contains($markOfVansAndTruck)) {
            $this->markOfVansAndTrucks[] = $markOfVansAndTruck;
            $markOfVansAndTruck->setTemplate($this);
        }

        return $this;
    }

    public function removeMarkOfVansAndTruck(MarkOfVansAndTrucks $markOfVansAndTruck): self
    {
        if ($this->markOfVansAndTrucks->removeElement($markOfVansAndTruck)) {
            // set the owning side to null (unless already changed)
            if ($markOfVansAndTruck->getTemplate() === $this) {
                $markOfVansAndTruck->setTemplate(null);
            }
        }

        return $this;
    }

    public function getCategory(): ?MainCategory
    {
        return $this->category;
    }

    public function setCategory(?MainCategory $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection|MarkOfMotors[]
     */
    public function getMarkOfMotors(): Collection
    {
        return $this->markOfMotors;
    }

    public function addMarkOfMotor(MarkOfMotors $markOfMotor): self
    {
        if (!$this->markOfMotors->contains($markOfMotor)) {
            $this->markOfMotors[] = $markOfMotor;
            $markOfMotor->setTemplate($this);
        }

        return $this;
    }

    public function removeMarkOfMotor(MarkOfMotors $markOfMotor): self
    {
        if ($this->markOfMotors->removeElement($markOfMotor)) {
            // set the owning side to null (unless already changed)
            if ($markOfMotor->getTemplate() === $this) {
                $markOfMotor->setTemplate(null);
            }
        }

        return $this;
    }
}
