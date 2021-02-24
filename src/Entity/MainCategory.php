<?php

namespace App\Entity;

use App\Repository\MainCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MainCategoryRepository::class)
 */
class MainCategory
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
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\OneToMany(targetEntity=ChildrenCategory::class, mappedBy="parentCategory")
     */
    private $childrenCategories;

    /**
     * @ORM\OneToMany(targetEntity=Offer::class, mappedBy="category")
     */
    private $offers;

    /**
     * @ORM\OneToOne(targetEntity=Template::class, mappedBy="category", cascade={"persist", "remove"})
     */
    private $template;

    public function __construct()
    {
        $this->childrenCategories = new ArrayCollection();
        $this->offers = new ArrayCollection();
    }

    public function __toString(): string
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
     * @return Collection|ChildrenCategory[]
     */
    public function getChildrenCategories(): Collection
    {
        return $this->childrenCategories;
    }

    public function addChildrenCategory(ChildrenCategory $childrenCategory): self
    {
        if (!$this->childrenCategories->contains($childrenCategory)) {
            $this->childrenCategories[] = $childrenCategory;
            $childrenCategory->setParentCategory($this);
        }

        return $this;
    }

    public function removeChildrenCategory(ChildrenCategory $childrenCategory): self
    {
        if ($this->childrenCategories->removeElement($childrenCategory)) {
            // set the owning side to null (unless already changed)
            if ($childrenCategory->getParentCategory() === $this) {
                $childrenCategory->setParentCategory(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Offer[]
     */
    public function getOffers(): Collection
    {
        return $this->offers;
    }

    public function addOffer(Offer $offer): self
    {
        if (!$this->offers->contains($offer)) {
            $this->offers[] = $offer;
            $offer->setCategory($this);
        }

        return $this;
    }

    public function removeOffer(Offer $offer): self
    {
        if ($this->offers->removeElement($offer)) {
            // set the owning side to null (unless already changed)
            if ($offer->getCategory() === $this) {
                $offer->setCategory(null);
            }
        }

        return $this;
    }

    public function getTemplate(): ?Template
    {
        return $this->template;
    }

    public function setTemplate(?Template $template): self
    {
        $this->template = $template;

        // set (or unset) the owning side of the relation if necessary
        $newCategory = null === $template ? null : $this;
        if ($template->getCategory() !== $newCategory) {
            $template->setCategory($newCategory);
        }

        return $this;
    }
}
