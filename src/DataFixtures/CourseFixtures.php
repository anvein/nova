<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Course;
use DateTime;


class CourseFixtures extends Fixture
{
    public const COURSE_BITRIX = 'COURSE_BILTRIX';
    public const COURSE_TEST = 'COURSE_TEST';
    public const COURSE_ALL = 'COURSE_ALL';


    public function load(ObjectManager $manager): void
    {
        $arCourses = [
            self::COURSE_BITRIX => [
                'author' => 'Нохрин Виталий',
                'title' => 'Разработка сайта на 1C Битрикс (2019)',
                'type' => 'Видеокурс',
                'date' => new DateTime('2019-05-01'),
                'description' => 'Online курс по одной из самых популярных CMS в России с проработанной системой заданий. В курсе ты изучишь большинство необходимых инструментов для разработки сайтов и возможности зарабатывать с этого.',
                'slug' => 'bitrix',
            ],
            self::COURSE_TEST   => [
                'title' => 'Тестовый курс (2019)',
                'type' => 'Online курс',
                'date' => new DateTime('2019-05-10'),
                'description' => 'Тестовый курс...',
                'slug' => 'test',
            ],
            self::COURSE_ALL => [
                'title' => 'Вне курсов',
                'description' => 'Все уроки не вошедшие в курсы.',
                'slug' => 'other',
            ]
        ];

        foreach ($arCourses as $key => $course) {
            $courseObj  = new Course;

            $courseObj->setSlug($course['slug']);

            $courseObj->setActive($course['active'] ?? true);
            $courseObj->setSort($course['sort'] ?? 500);
            $courseObj->setAuthor($course['author'] ?? null);
            $courseObj->setTitle($course['title'] ?? null);
            $courseObj->setType($course['type'] ?? 'Тип курса');

            if (isset($course['date'])) {
                $courseObj->setDate($course['date']);
            }

            $courseObj->setDescription($course['description'] ?? null);

            $manager->persist($courseObj);

            $this->addReference($key, $courseObj);
        }

        $manager->flush();
    }
}
