<?php

declare(strict_types=1);

namespace App\Entity;

use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use DateTimeInterface;
use DateTime;

// todo - прикрутить валидаторы

// todo - задать названия полям на русском в админке
// todo - объединить поля в админке по группам
// todo - переименовать сущность в админке + сменить значок
// todo - объединить сущности в группы

/**
 * Сущность "Курс".
 *
 * @ORM\Entity(repositoryClass="App\Repository\CourseRepository")
 * @Vich\Uploadable
 */
class Course
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
    private $active = true;

    /**
     * Индекс сортировки.
     *
     * @ORM\Column(type="integer")
     *
     * @var int
     */
    private $sort = 500;

    /**
     * Код элемента (используется в url).
     *
     * @ORM\Column(type="string", length=255, unique=true)
     *
     * @var string
     *
     * // todo - прикрутить валидатор
     */
    private $slug = '';

    /**
     * Название курса.
     *
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $title = '';

    /**
     * Дата выхода курса.
     *
     * @ORM\Column(type="date")
     *
     * @var DateTimeInterface
     */
    private $date;

    /**
     * Автор курса.
     *
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $author = '';

    /**
     * Описание курса.
     *
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     *
     * @var string
     */
    private $description = '';

    /**
     * Тип курса.
     *
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $type = '';

    /**
     * Название файла обложки.
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @var string|null
     */
    private $coverImage;


//* @Assert\NotBlank(message="Необходимо обязательно указать Обложку")

    /**
     * Файл обложки курса.
     *
     * @Vich\UploadableField(mapping="course_covers", fileNameProperty="coverImage")
     * @Assert\Image()
     *
     * @var File|null
     */
    private $coverImageFile;

    /**
     * Дата и время последнего обновления.
     *
     * @ORM\Column(type="datetime", options={"default" : "2019-06-01 00:00:00"})
     *
     * @var DateTimeInterface
     */
    private $updatedAt;

    /**
     * Название картинки для хлебных крошек.
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @var string|null
     */
    private $breadcrumbImageName;

    /**
     * Файл для хлебных крошек (содержимое).
     *
     * @Vich\UploadableField(mapping="course_breadcrumbs", fileNameProperty="breadcrumbImageName")
     * @Assert\Image()
     *
     * @var File|null
     */
    private $breadcrumbImageFile;

    public function __construct()
    {
        $this->date = new DateTime;
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

    public function getDate(): DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;

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

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function __toString(): string
    {
        return $this->getTitle();
    }

    public function getCoverImage(): ?string
    {
        return $this->coverImage;
    }

    public function setCoverImage(string $coverImage = null): self
    {
        $this->coverImage = $coverImage;

        return $this;
    }

    public function getCoverImageFile(): ?File
    {
        return $this->coverImageFile;
    }

    public function setCoverImageFile(?File $coverImageFile): self
    {
        $this->coverImageFile = $coverImageFile;
        if ($coverImageFile) {
            $this->updatedAt = new DateTime('now');
        }

        return $this;
    }

    public function getUpdatedAt(): DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = new DateTime;

        return $this;
    }

    public function getBreadcrumbImageName(): ?string
    {
        return $this->breadcrumbImageName;
    }

    public function setBreadcrumbImageName(?string $breadcrumbImageName): self
    {
        $this->breadcrumbImageName = $breadcrumbImageName;

        return $this;
    }

    public function getBreadcrumbImageFile(): ?File
    {
        return $this->breadcrumbImageFile;
    }

    public function setBreadcrumbImageFile(?File $breadcrumbImageFile): self
    {
        $this->breadcrumbImageFile = $breadcrumbImageFile;
        if ($breadcrumbImageFile) {
            $this->updatedAt = new DateTime('now');
        }

        return $this;
    }

}
