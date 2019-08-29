<?php

namespace App\DataFixtures;

use App\Entity\PortfolioElement;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use App\DataFixtures\Support\FixturesObjectProvider;

class PortfolioElementFixtures extends Fixture implements DependentFixtureInterface
{

    use FixturesObjectProvider;

    public const NOVA = 'PORTFOLIO_ELEMENT_NOVA';
    public const YACODER = 'PORTFOLIO_ELEMENT_YACODER';
    public const NPF65PLUS = 'PORTFOLIO_ELEMENT_NPF65PLUS';
    public const WILLZ = 'PORTFOLIO_ELEMENT_WILLZ';
    public const YOUTOOL = 'PORTFOLIO_ELEMENT_YOUTOOL';
    public const BITRIX_COURSE = 'PORTFOLIO_ELEMENT_BITRIX_COURSE';

    public function load(ObjectManager $manager): void
    {
        $defaultParams = [
            'active' => true,
            'sort' => 500,
            'description' => 'Длинный текст...',
            'categories' => [
                PortfolioCategoryFixtures::OTHER,
            ]
        ];

        $arItems = [
            self::NOVA => [
                'title' => 'Сайт web-студии Nova',
                'slug' => 'nova',
                'breadcrumbsStyles' => 'background-image: linear-gradient( 90.6deg,  rgba(59,158,255,1) -1.2%, rgba(246,135,255,1) 91.6% );',
                'categories' => [
                    PortfolioCategoryFixtures::CORPORATE,
                ],
            ],
            self::YACODER => [
                'title' => 'Лендинг курса по Bitrix',
                'titleDetail' => 'Лендинг для записи на курс по Bitrix',
                'slug' => 'yacoder',
                'breadcrumbsStyles' => 'background-image: linear-gradient( 113.7deg,  rgba(232,166,166,1) 9%, rgba(178,92,249,1) 114.7% );',
                'categories' => [
                    PortfolioCategoryFixtures::LANDING,
                ],
            ],
            self::NPF65PLUS => [
                'title' => 'НПФ Сбербанка: 65+',
                'titleDetail' => 'НПФ Сбербанка: 65+',
                'slug' => 'yacoder',
                'breadcrumbsStyles' => 'background-image: radial-gradient( circle farthest-corner at 10% 20%,  rgba(0,33,71,1) 0%, rgba(47,183,186,1) 90% );',
                'categories' => [
                    PortfolioCategoryFixtures::CORPORATE,
                ],
            ],
            self::WILLZ => [
                'title' => 'CRM каршеринга Willz',
                'slug' => 'willz_crm',
                'breadcrumbsStyles' => 'background-image: radial-gradient( circle 314px at 95.1% 37.9%,  rgba(255,246,78,1) 1.4%, rgba(242,252,186,1) 100.7% );',
                'categories' => [
                    PortfolioCategoryFixtures::OTHER,
                ],
            ],
            self::YOUTOOL => [
                'title' => 'API для YouTool',
                'titleDetail' => 'API и Back-end для мобильного приложения YouTool',
                'slug' => 'youtool_api',
                'breadcrumbsStyles' => 'background-image: linear-gradient(120deg, #84fab0 0%, #8fd3f4 100%);',
                'categories' => [
                    PortfolioCategoryFixtures::OTHER,
                ],
            ],
            self::BITRIX_COURSE => [
                'title' => 'Сайт для курса по Bitrix',
                'slug' => 'bitrix_course',
                'breadcrumbsStyles' => 'background-image: linear-gradient(120deg, #89f7fe 0%, #66a6ff 100%);',
                'category' => [
                    PortfolioCategoryFixtures::CORPORATE,
                ],
            ],
        ];

        foreach ($arItems as $key => $item) {
            $itemObj = new PortfolioElement();

            $itemObj->setTitle($item['title']);
            $itemObj->setActive($item['active'] ?? $defaultParams['active'] ?? true);
            $itemObj->setSlug($item['slug']);
            $itemObj->setDescription($item['description'] ?? $defaultParams['description']);
            $itemObj->setSort($item['sort'] ?? $defaultParams['sort']);
            //$itemObj->setUpdatedAt();
            $itemObj->setBreadcrumbsStyles($item['breadcrumbsStyles'] ?? $defaultParams['breadcrumbsStyles']);
            //$itemObj->setImageBreadcrumbsFile();
            //$itemObj->setImageBreadcrumbsFilename();
            //$itemObj->setImageForListFile();
            //$itemObj->setImageForListFilename();
            $itemObj->setTitleDetail($item['titleDetail'] ?? '');

            if (!empty($item['categories'])) {
                foreach ($item['categories'] as $categoryRef) {
                    $itemObj->addCategory($this->getPortfolioCategoryByRef($categoryRef));
                }
            }

            $manager->persist($itemObj);
            $this->addReference($key, $itemObj);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            PortfolioCategoryFixtures::class,
        ];
    }
}
