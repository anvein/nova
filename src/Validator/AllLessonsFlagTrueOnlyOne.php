<?php

namespace App\Validator;

use App\Entity\Course;
use Symfony\Component\Validator\Constraint;

/**
 * Ограничение, которое следит, чтобы только один курс реализовывал раздел "все уроки".
 *
 * @Annotation
 */
class AllLessonsFlagTrueOnlyOne extends Constraint
{
    /**
     * Сообщение об ошибке.
     */
    public $errorMessage = 'Только один курс должен реализовывать раздел "все уроки"';

    /**
     * {@inheritdoc}
     *
     * @return string
     */
    public function getTargets(): string
    {
        return self::CLASS_CONSTRAINT;
    }
}
