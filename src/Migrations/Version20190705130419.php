<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Добавляет поля в сущность "Курс": "Реализует раздел "Все курсы"", "Стили для хлебных крошек" и "Заголовок для хлебных крошек".
 */
final class Version20190705130419 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE course ADD breadcrumbs_title VARCHAR(255) DEFAULT NULL, ADD breadcrumbs_styles LONGTEXT DEFAULT NULL, ADD realize_all_lessons_section TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE course DROP breadcrumbs_title, DROP breadcrumbs_styles, DROP realize_all_lessons_section');
    }
}
