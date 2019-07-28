<?php

declare(strict_types=1);

namespace App\Entity;

use App\Validator\AllLessonsFlagTrueOnlyOne;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints as AssertDoctrineBridge;
use Doctrine\ORM\Mapping as ORM;
use DateTimeInterface;
use DateTime;

/**
 * Сущность "Курс".
 *
 * @ORM\Entity(repositoryClass="App\Repository\CourseRepository")
 * @AssertDoctrineBridge\UniqueEntity("slug")
 * @AllLessonsFlagTrueOnlyOne()
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
     * @Assert\NotBlank()
     *
     * @var int
     */
    private $sort = 500;

    /**
     * Код элемента (используется в url).
     *
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank()
     * @Assert\Regex(pattern="/[a-z0-9_-]/", message="Код содержит недопустимые символы. Допустимо: a-z, 0-9, - и _")
     *
     * @var string|null
     */
    private $slug;

    /**
     * Название курса.
     *
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     *
     * @var string|null
     */
    private $title;

    /**
     * Дата выхода курса.
     *
     * @ORM\Column(type="date")
     * @Assert\NotBlank()
     *
     * @var DateTimeInterface
     */
    private $date;

    /**
     * Автор курса.
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @var string|null
     */
    private $author;

    /**
     * Описание курса.
     *
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     *
     * @var string|null
     */
    private $description;

    /**
     * Тип курса.
     *
     * @ORM\Column(type="string", length=255, nullable=false)
     * @Assert\NotBlank()
     *
     * @var string|null
     */
    private $type;

    /**
     * Название файла обложки.
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank()
     *
     * @var string|null
     */
    private $coverImage;

    /**
     * Файл обложки курса.
     *
     * @Vich\UploadableField(mapping="course_covers", fileNameProperty="coverImage")
     * @Assert\Image(maxSize="3M")
     *
     * @var File|null
     */
    private $coverImageFile;

    /**
     * Дата и время последнего обновления.
     *
     * @ORM\Column(type="datetime", options={"default" : "2019-06-01 00:00:00"})
     * @Assert\DateTime()
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

    /**
     * Название курса в хлебных крошках (если надо переопределить основное название).
     *
     * Если это поле не задано то название для хлебных крошек должно браться из поля title.
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @var string|null
     */
    private $breadcrumbsTitle;

    /**
     * Стили для хлебных крошек. (вместо картинки, например: для градиента).
     *
     * @ORM\Column(type="text", nullable=true)
     *
     * @var string|null
     */
    private $breadcrumbsStyles;

    /**
     * Курс реализует раздел "все уроки".
     *
     * Правила:
     * В нем будут выведены все уроки.
     * Только один курс может рализовывать этот раздел.
     * В списке курсов этот курс не будет выводиться.
     *
     * @ORM\Column(type="boolean")
     *
     * @var bool
     */
    private $realizeAllLessonsSection = false;

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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
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

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(?string $author): self
    {
        $this->author = $author;

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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function __toString(): string
    {
        $title = $this->getTitle();

        return !is_null($title) ? $title : '';
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

    public function getBreadcrumbsTitle(): ?string
    {
        return $this->breadcrumbsTitle;
    }

    public function setBreadcrumbsTitle(?string $breadcrumbsTitle): self
    {
        $this->breadcrumbsTitle = $breadcrumbsTitle;

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

    public function getRealizeAllLessonsSection(): bool
    {
        return $this->realizeAllLessonsSection;
    }

    public function setRealizeAllLessonsSection(bool $realizeAllLessonsSection): self
    {
        $this->realizeAllLessonsSection = $realizeAllLessonsSection;

        return $this;
    }
}
