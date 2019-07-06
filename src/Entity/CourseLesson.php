<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use DateTimeInterface;
use DateTime;

/**
 * Сущность "Урок".
 *
 * @ORM\Entity(repositoryClass="App\Repository\CourseLessonRepository")
 * @ORM\HasLifecycleCallbacks
 * @Vich\Uploadable
 */
class CourseLesson
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
     * @var string|null
     */
    private $slug;

    /**
     * Название урока.
     *
     * @ORM\Column(type="string", length=255)
     *
     * @var string|null
     */
    private $title;

    /**
     * Курс к которому относится лекция.
     *
     * @Assert\NotBlank()
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Course")
     * @ORM\JoinColumn(nullable=false)
     *
     * @var Course|null
     */
    private $course;

    /**
     * Ссылка на видео (youtube), если нужно вывести видео.
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @var string|null
     */
    private $videoLink;

    /**
     * Описание для детальной страницы.
     *
     * @ORM\Column(type="text", nullable=true)
     *
     * @var string|null
     */
    private $descriptionDetail;

    /**
     * Описание для списка.
     *
     * @ORM\Column(type="text")
     *
     * @var string|null
     */
    private $descriptionPreview;

    /**
     * Дата выхода урока.
     *
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @var DateTimeInterface|null
     */
    private $date;

    /**
     * Следующий урок.
     *
     * @ORM\OneToOne(targetEntity="App\Entity\CourseLesson", inversedBy="prevLesson", cascade={"persist", "remove"})
     *
     * @var CourseLesson|null
     */
    private $nextLesson;

    /**
     * Предыдущий урок.
     *
     * @ORM\OneToOne(targetEntity="App\Entity\CourseLesson", mappedBy="nextLesson", cascade={"persist", "remove"})
     *
     * @var CourseLesson|null
     */
    private $prevLesson;

    /**
     * Номер урока (если он входит в курс).
     *
     * @ORM\Column(type="integer", nullable=true)
     *
     * @var int|null
     */
    private $number;

    /**
     * Название файла обложки.
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @var string|null
     */
    private $coverFileName;

    /**
     * Файл обложки.
     *
     * @Vich\UploadableField(mapping="course_lesson_covers", fileNameProperty="coverFileName")
     * @Assert\Image()
     *
     * @var File|null
     */
    private $coverFile;

    /**
     * Выводить ли обложку на деталке.
     *
     * @ORM\Column(type="boolean")
     *
     * @var bool
     */
    private $viewCoverInDetail = false;

    /**
     * Дата и время последнего обновления.
     *
     * @ORM\Column(type="datetime", options={"default" : "2019-06-01 00:00:00"})
     *
     * @var DateTimeInterface
     */
    private $updatedAt;

    public function __construct()
    {
        $this->updateUpdatedAt();
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

    public function getCourse(): ?Course
    {
        return $this->course;
    }

    public function setCourse(?Course $course): self
    {
        $this->course = $course;

        return $this;
    }

    public function getVideoLink(): ?string
    {
        return $this->videoLink;
    }

    public function setVideoLink(?string $videoLink): self
    {
        $this->videoLink = $videoLink;

        return $this;
    }

    public function getDescriptionDetail(): ?string
    {
        return $this->descriptionDetail;
    }

    public function setDescriptionDetail(?string $descriptionDetail): self
    {
        $this->descriptionDetail = $descriptionDetail;

        return $this;
    }

    public function getDescriptionPreview(): ?string
    {
        return $this->descriptionPreview;
    }

    public function setDescriptionPreview(?string $descriptionPreview): self
    {
        $this->descriptionPreview = $descriptionPreview;

        return $this;
    }

    public function getDate(): ?DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getNextLesson(): ?self
    {
        return $this->nextLesson;
    }

    public function setNextLesson(?self $nextLesson): self
    {
        $this->nextLesson = $nextLesson;

        return $this;
    }

    public function getPrevLesson(): ?self
    {
        return $this->prevLesson;
    }

    public function setPrevLesson(?self $prevLesson): self
    {
        $this->prevLesson = $prevLesson;

        // set (or unset) the owning side of the relation if necessary
        $newNextLesson = ($prevLesson === null) ? null : $this;
        if ($newNextLesson !== $prevLesson->getNextLesson()) {
            $prevLesson->setNextLesson($newNextLesson);
        }

        return $this;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(?int $number): self
    {
        $this->number = $number;

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

    public function __toString(): string
    {
        $number = $this->getNumber() ? "{$this->getNumber()}#" : '';

        $course = $this->getCourse();
        $courseTitle = !is_null($course)
            ? "{$course->getTitle()}"
            : 'вне курса';

        return "{$number} {$this->getTitle()} ({$courseTitle})";
    }

    public function getCoverFileName(): ?string
    {
        return $this->coverFileName;
    }

    public function setCoverFileName(?string $coverFileName): self
    {
        $this->coverFileName = $coverFileName;

        return $this;
    }

    public function getCoverFile(): ?File
    {
        return $this->coverFile;
    }

    public function setCoverFile(?File $coverFile): self
    {
        $this->coverFile = $coverFile;
        if ($coverFile) {
            $this->updateUpdatedAt();
        }

        return $this;
    }

    public function getViewCoverInDetail(): bool
    {
        return $this->viewCoverInDetail;
    }

    public function setViewCoverInDetail(bool $viewCoverInDetail): self
    {
        $this->viewCoverInDetail = $viewCoverInDetail;

        return $this;
    }


    public function getUpdatedAt(): DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(DateTimeInterface $dateUpdate): self
    {
        $this->updatedAt = $dateUpdate;

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
