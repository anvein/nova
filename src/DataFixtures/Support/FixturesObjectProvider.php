<?php

declare(strict_types=1);

namespace App\DataFixtures\Support;

use App\Entity\Course;
use App\Entity\PortfolioCategory;
use UnexpectedValueException;

/**
 * Класс с методами для поиска объектов внутри хранилища фикстур.
 */
trait FixturesObjectProvider
{
    /**
     * Возвращает курс по коду-ссылке.
     *
     * @param string $ref
     *
     * @return Course
     *
     * @throws UnexpectedValueException
     */
    private function getCourseByRef(string $ref): Course
    {
        $item = $this->getReference($ref);

        if ($item instanceof Course) {
            return $item;
        }

        throw new UnexpectedValueException("Курс с кодом {$ref} не создан");
    }

    /**
     * Возвращает категорию портфолио коду-ссылке.
     *
     * @param string $ref
     *
     * @return PortfolioCategory
     *
     * @throws UnexpectedValueException
     */
    private function getPortfolioCategoryByRef(string $ref): PortfolioCategory
    {
        $item = $this->getReference($ref);

        if ($item instanceof PortfolioCategory) {
            return $item;
        }

        throw new UnexpectedValueException("Категория портфолио с кодом {$ref} не создана");
    }
}
