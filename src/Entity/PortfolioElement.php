<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PortfolioElementRepository")
 */
class PortfolioElement
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $active;

    /**
     * @ORM\Column(type="integer")
     */
    private $sort;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $titleDetail;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imageForList;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imageDetailBreadcrumbs;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $breadcrumbsStyles;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\PortfolioCategory")
     */
    private $category;

    public function __construct()
    {
        $this->category = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getSort(): ?int
    {
        return $this->sort;
    }

    public function setSort(int $sort): self
    {
        $this->sort = $sort;

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

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getTitleDetail(): ?string
    {
        return $this->titleDetail;
    }

    public function setTitleDetail(?string $titleDetail): self
    {
        $this->titleDetail = $titleDetail;

        return $this;
    }

    public function getImageForList(): ?string
    {
        return $this->imageForList;
    }

    public function setImageForList(?string $imageForList): self
    {
        $this->imageForList = $imageForList;

        return $this;
    }

    public function getImageDetailBreadcrumbs(): ?string
    {
        return $this->imageDetailBreadcrumbs;
    }

    public function setImageDetailBreadcrumbs(?string $imageDetailBreadcrumbs): self
    {
        $this->imageDetailBreadcrumbs = $imageDetailBreadcrumbs;

        return $this;
    }

    public function getBreadcrumbsStyles(): ?string
    {
        return $this->breadcrumbsStyles;
    }

    public function setBreadcrumbsStyles(?string $breadcrumbsStyles): self
    {
        $this->breadcrumbsStyles = $breadcrumbsStyles;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|PortfolioCategory[]
     */
    public function getCategory(): Collection
    {
        return $this->category;
    }

    public function addCategory(PortfolioCategory $category): self
    {
        if (!$this->category->contains($category)) {
            $this->category[] = $category;
        }

        return $this;
    }

    public function removeCategory(PortfolioCategory $category): self
    {
        if ($this->category->contains($category)) {
            $this->category->removeElement($category);
        }

        return $this;
    }
}
