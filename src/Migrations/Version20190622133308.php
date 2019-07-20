<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Создание таблицы "Уроки" (уроки курсов).
 */
final class Version20190622133308 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE course_lesson (id INT AUTO_INCREMENT NOT NULL, course_id INT DEFAULT NULL, next_lesson_id INT DEFAULT NULL, active TINYINT(1) NOT NULL, sort INT NOT NULL, slug VARCHAR(255) NOT NULL, video_link VARCHAR(255) DEFAULT NULL, description_detail LONGTEXT DEFAULT NULL, description_preview LONGTEXT NOT NULL, date DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_564CB5BE989D9B62 (slug), INDEX IDX_564CB5BE591CC992 (course_id), UNIQUE INDEX UNIQ_564CB5BE8A72D4A5 (next_lesson_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE course_lesson ADD CONSTRAINT FK_564CB5BE591CC992 FOREIGN KEY (course_id) REFERENCES course (id)');
        $this->addSql('ALTER TABLE course_lesson ADD CONSTRAINT FK_564CB5BE8A72D4A5 FOREIGN KEY (next_lesson_id) REFERENCES course_lesson (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_169E6FB9989D9B62 ON course (slug)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE course_lesson DROP FOREIGN KEY FK_564CB5BE8A72D4A5');
        $this->addSql('DROP TABLE course_lesson');
        $this->addSql('DROP INDEX UNIQ_169E6FB9989D9B62 ON course');
    }
}
