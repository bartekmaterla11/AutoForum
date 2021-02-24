<?php

namespace App\Entity;

use App\Repository\ChildrenCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ChildrenCategoryRepository::class)
 */
class ChildrenCategory
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=MainCategory::class, inversedBy="childrenCategories")
     */
    private $parentCategory;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\OneToMany(targetEntity=MarkOfVansAndTrucks::class, mappedBy="childrenCategory")
     */
    private $markOfVansAndTrucks;

    public function __construct()
    {
        $this->markOfVansAndTrucks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getParentCategory(): ?MainCategory
    {
        return $this->parentCategory;
    }

    public function setParentCategory(?MainCategory $parentCategory): self
    {
        $this->parentCategory = $parentCategory;

        return $this;
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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

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
            $markOfVansAndTruck->setChildrenCategory($this);
        }

        return $this;
    }

    public function removeMarkOfVansAndTruck(MarkOfVansAndTrucks $markOfVansAndTruck): self
    {
        if ($this->markOfVansAndTrucks->removeElement($markOfVansAndTruck)) {
            // set the owning side to null (unless already changed)
            if ($markOfVansAndTruck->getChildrenCategory() === $this) {
                $markOfVansAndTruck->setChildrenCategory(null);
            }
        }

        return $this;
    }
}
