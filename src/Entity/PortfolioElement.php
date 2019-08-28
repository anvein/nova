<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use DateTimeInterface;
use DateTime;

/**
 * Сущность "Элмент портфолио".
 *
 * @ORM\Entity(repositoryClass="App\Repository\PortfolioElementRepository")
 * @Vich\Uploadable
 */
class PortfolioElement
{
    /**
     * Уникальный идентификатор.
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     *
     * @var int|null
     */
    private $id;

    /**
     * Активность элемента.
     *
     * @ORM\Column(type="boolean")
     *
     * @var bool
     */
    private $active;

    /**
     * Индекс сортировки.
     *
     * @ORM\Column(type="integer")
     *
     * @var int
     */
    private $sort;

    /**
     * Символьный идентификатор.
     *
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $slug;

    /**
     * Название элемента (основное, в списке).
     *
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $title;

    /**
     * Длинное название элемента (на деталке).
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @var string
     */
    private $titleDetail;

    /**
     * Картинка для списка (название файла).
     *
     * @ORM\Column(type="string", length=255, nullable=true) // todo - узнать про nullable=true
     */
    private $imageForListFilename;

    /**
     * Картинка для списка (файл).
     *
     * @Vich\UploadableField(mapping="portfolio_element_image_for_list", fileNameProperty="imageForListFilename")
     *
     * @var File
     */
    private $imageForListFile;

    /**
     * Картинка для хлебных крошек на деталке (название файла).
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imageBreadcrumbsFilename;

    /**
     * Картинка для хлебных крошек на деталке (файл).
     *
     * @Vich\UploadableField(mapping="portfolio_element_image_breadcrumbs", fileNameProperty="imageBreadcrumbsFilename")
     *
     * @var File
     */
    private $imageBreadcrumbsFile;

    /**
     * Стили для хлебных крошек на деталке.
     *
     * @ORM\Column(type="text", nullable=true)
     *
     * @var string
     */
    private $breadcrumbsStyles;

    /**
     * Описание.
     *
     * @ORM\Column(type="text", nullable=true)
     *
     * @var string
     */
    private $description;

    /**
     * Категория к которой относится элемент.
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\PortfolioCategory")
     *
     * @var PortfolioCategory|null
     */
    private $category;

    /**
     * Дата и время последнего изменения.
     *
     * @ORM\Column(type="datetime")
     *
     * @var DateTimeInterface
     */
    private $updatedAt;

    public function __construct()
    {
        $this->category = new ArrayCollection();
        $this->updatedAt = new DateTime;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getActive(): bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getSort(): int
    {
        return $this->sort;
    }

    public function setSort(int $sort): self
    {
        $this->sort = $sort;

        return $this;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getTitleDetail(): string
    {
        return $this->titleDetail;
    }

    public function setTitleDetail(string $titleDetail): self
    {
        $this->titleDetail = $titleDetail;

        return $this;
    }

    public function getImageForListFilename(): ?string
    {
        return $this->imageForListFilename;
    }

    public function setImageForListFilename(?string $imageForListFilename): self
    {
        $this->imageForListFilename = $imageForListFilename;

        return $this;
    }

    public function getImageForListFile(): ?File
    {
        return $this->imageForListFile;
    }

    /**
     * @param mixed $imageForListFile
     *
     * @return PortfolioElement
     */
    public function setImageForListFile(?File $imageForListFile)
    {
        $this->imageForListFile = $imageForListFile;
        return $this;
    }

    public function getImageBreadcrumbsFilename(): string
    {
        return (string) $this->imageBreadcrumbsFilename;
    }

    public function setImageBreadcrumbsFilename(?string $imageBreadcrumbsFilename): self
    {
        $this->imageBreadcrumbsFilename = $imageBreadcrumbsFilename;

        return $this;
    }

    public function getImageBreadcrumbsFile(): ?File
    {
        return $this->imageBreadcrumbsFile;
    }

    public function setImageBreadcrumbsFile(?File $imageBreadcrumbsFile): self
    {
        $this->imageBreadcrumbsFile = $imageBreadcrumbsFile;

        return $this;
    }

    public function getBreadcrumbsStyles(): string
    {
        return $this->breadcrumbsStyles;
    }

    public function setBreadcrumbsStyles(string $breadcrumbsStyles): self
    {
        $this->breadcrumbsStyles = $breadcrumbsStyles;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
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

    public function getUpdatedAt(): DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @ORM\PreUpdate
     */
    public function updateUpdatedAt(): void
    {
        $this->setUpdatedAt(new DateTime('now'));
    }
}
