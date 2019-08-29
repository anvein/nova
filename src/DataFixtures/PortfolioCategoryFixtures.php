<?php

namespace App\DataFixtures;

use App\Entity\PortfolioCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class PortfolioCategoryFixtures extends Fixture
{
    public const LANDING = 'PORTFOLIO_CATEGORY_LANDING';
    public const INTERNET_SHOP = 'PORTFOLIO_CATEGORY_INTERNET_SHOP';
    public const CORPORATE = 'PORTFOLIO_CATEGORY_CORPORATE';
    public const INACTIVE = 'PORTFOLIO_CATEGORY_INACTIVE';
    public const OTHER = 'PORTFOLIO_CATEGORY_OTHER';

    public function load(ObjectManager $manager): void
    {
        $defaultParsms = [
            'active' => true,
            'sort' => 500,
        ];

        $arItems = [
            self::LANDING                          => [
                'slug' => 'landing',
                'shortTitle' => 'Лендинг',
            ],
            self::INTERNET_SHOP => [
                'slug' => 'internet-shop',
                'shortTitle' => 'Интернет магазин',
                'titleDetail' => 'Интернет магазины',
            ],
            self::CORPORATE     => [
                'slug' => 'corporate',
                'shortTitle' => 'Корпоративный сайт',
            ],
            self::INACTIVE      => [
                'slug' => 'inactive',
                'shortTitle' => 'Неактивная категория',
            ],
            self::OTHER => [
                'slug' => 'other',
                'shortTitle' => 'Прочее',
                'sort' => 900,
            ],
        ];

        foreach ($arItems as $key => $item) {
            $itemObj = new PortfolioCategory();

            $itemObj->setActive($item['active'] ?? $defaultParsms['active'] ?? true);
            $itemObj->setSlug($item['slug']);
            $itemObj->setSort($item['sort'] ?? $defaultParsms['sort'] ?? 500);
            $itemObj->setShortTitle($item['shortTitle'] ?? '');
            $itemObj->setTitleDetail($item['titleDetail'] ?? null);

            $manager->persist($itemObj);
            $this->addReference($key, $itemObj);
        }

        $manager->flush();
    }
}
