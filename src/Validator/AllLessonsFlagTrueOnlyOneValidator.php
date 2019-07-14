<?php

namespace App\Validator;

use App\Entity\Course;
use App\Repository\CourseRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

/**
 * Валидатор для ограничения AllLessonsFlagTrueOnlyOne.
 */
class AllLessonsFlagTrueOnlyOneValidator extends ConstraintValidator
{

    /**
     * @var CourseRepository
     */
    protected $courseRepository;

    public function __construct(CourseRepository $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    /**
     * @inheritdoc
     */
    public function validate($value, Constraint $constraint): void
    {
        if (!$constraint instanceof AllLessonsFlagTrueOnlyOne) {
            throw new UnexpectedTypeException($constraint, AllLessonsFlagTrueOnlyOne::class);
        }

        /* @var $constraint \App\Validator\AllLessonsFlagTrueOnlyOne */
        $course = $this->context->getObject();
        if (!$course instanceof Course) {
            throw new UnexpectedTypeException($course, Course::class);
        }

        $isRealizedAllLesson = $course->getRealizeAllLessonsSection();
        if ($isRealizedAllLesson) {
            $coursesRealized = $this->courseRepository->getCoursesRealizedAllLessonsSection();

            if (!empty($coursesRealized)) {
                $this->context->buildViolation($constraint->errorMessage)
                    ->addViolation();
            }
        }
    }

}
