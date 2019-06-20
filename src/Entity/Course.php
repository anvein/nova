<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use DateTimeInterface;
use DateTime;

// todo - прикрытить валидаторы

/**
 * Сущность "Курс".
 *
 * @ORM\Entity(repositoryClass="App\Repository\CourseRepository")
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
     * @ORM\Column(type="string", length=255)
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

    public function __construct()
    {
        $this->date = new DateTime;
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
}
