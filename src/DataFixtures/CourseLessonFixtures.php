<?php

namespace App\DataFixtures;

use App\DataFixtures\Support\FixturesObjectProvider;
use App\Entity\CourseLesson;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use DateTime;

class CourseLessonFixtures extends Fixture implements DependentFixtureInterface
{
    use FixturesObjectProvider;

    public const LESSON_BITRIX_1 = 'LESSON_BITRIX_1';
    public const LESSON_BITRIX_2 = 'LESSON_BITRIX_2';
    public const LESSON_BITRIX_3 = 'LESSON_BITRIX_3';
    public const LESSON_OTHER_1 = 'LESSON_OTHER_1';


    public function load(ObjectManager $manager): void
    {
        $lessons = [
            self::LESSON_BITRIX_1 => [
                'active' => true,
                'sort' => 500,
                'slug' => 'vstuplenie',
                'title' => 'Вступление',
                'courseRef' => CourseFixtures::COURSE_BITRIX,
                'videoLink' => 'https://www.youtube.com/embed/KajzW-luaeY',
                'descriptionDetail' => '<p>Детальное описание вступления</p>',
                'descriptionPreview' => 'Вступительное видело в котором я расскажу, как проходить курс и будет рассмотрен курс в целом...',
                'date' => new DateTime('2019-06-01'),
                // 'nextLesson' => '',
                'number' => 1,
                // 'coverFileName' => '',
                'viewCoverInDetail' => true,
            ],
            self::LESSON_BITRIX_2 => [
                'active' => true,
                'sort' => 500,
                'slug' => 'install-for-development',
                'title' => 'Установка Bitrix для разработки (теория)',
                'courseRef' => CourseFixtures::COURSE_BITRIX,
                'videoLink' => 'https://www.youtube.com/embed/wKedPcDxI2U',
                'descriptionDetail' => '',
                'descriptionPreview' => 'Превью второго видео...',
                'date' => new DateTime('2019-06-05'),
                // 'nextLesson' => '',
                'number' => 2,
                // 'coverFileName' => '',
                'viewCoverInDetail' => false,
            ],
            self::LESSON_BITRIX_3 => [
                'active' => true,
                'sort' => 500,
                'slug' => 'install-local',
                'title' => 'Установка Bitrix локально',
                'courseRef' => CourseFixtures::COURSE_BITRIX,
                'videoLink' => 'https://www.youtube.com/embed/hYjUB0vrJo0',
                'descriptionDetail' => '',
                'descriptionPreview' => 'Превью третьего видео...',
                'date' => new DateTime('2019-06-10'),
                // 'nextLesson' => '',
                'number' => 3,
                // 'coverFileName' => '',
                'viewCoverInDetail' => false,
            ],
            self::LESSON_OTHER_1 => [
                'active' => true,
                'sort' => 500,
                'slug' => 'other-1',
                'title' => 'Урок 1 вне курса',
                'courseRef' => CourseFixtures::COURSE_ALL,
                'videoLink' => 'https://www.youtube.com/embed/hYjUB0vrJo0',
                'descriptionDetail' => '',
                'descriptionPreview' => 'Урок вне курса...',
                'date' => new DateTime('2019-06-20'),
                // 'nextLesson' => '',
                'number' => null,
                // 'coverFileName' => '',
                'viewCoverInDetail' => false,
            ],
        ];

        foreach ($lessons as $key => $lesson) {
            $lessonObj = new CourseLesson;
            $lessonObj->setActive($lesson['active'] ?? true);
            $lessonObj->setSort($lesson['sort'] ?? 500);
            $lessonObj->setSlug($lesson['slug']);
            $lessonObj->setTitle($lesson['title']);
            $lessonObj->setCourse($this->getCourseByRef($lesson['courseRef']));
            $lessonObj->setVideoLink($lesson['videoLink'] ?? null);
            $lessonObj->setDescriptionPreview($lesson['descriptionPreview']);
            $lessonObj->setDescriptionDetail($lesson['descriptionDetail'] ?? null);
            $lessonObj->setDate($lesson['date'] ?? null);
            $lessonObj->setNumber($lesson['number'] ?? null);

            $manager->persist($lessonObj);
            $this->addReference($key, $lessonObj);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            CourseFixtures::class,
        ];
    }
}
