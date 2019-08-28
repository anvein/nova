<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Сущность "Каткгория портфолио".
 *
 * @ORM\Entity(repositoryClass="App\Repository\PortfolioCategoryRepository")
 */
class PortfolioCategory
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
     * Активность категории.
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
     * @var string|null
     */
    private $slug;

    /**
     * Короткое название.
     *
     * @ORM\Column(type="string", length=255)
     *
     * @var string|null
     */
    private $shortTitle;

    /**
     * Длинное название.
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @var string|null
     */
    private $titleDetail;

    public function __construct()
    {
        $this->active = true;
        $this->sort = 500;
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

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getShortTitle(): ?string
    {
        return $this->shortTitle;
    }

    public function setShortTitle(string $shortTitle): self
    {
        $this->shortTitle = $shortTitle;

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
}
