<?php

declare(strict_types=1);

namespace App\DataFixtures\Support;

use App\Entity\Course;
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
}