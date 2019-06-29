<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 *  Делает у сущности "урок" поле "курс" обязательным.
 */
final class Version20190629133440 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE course_lesson DROP FOREIGN KEY FK_564CB5BE591CC992');
        $this->addSql('ALTER TABLE course_lesson CHANGE course_id course_id INT NOT NULL');
        $this->addSql('ALTER TABLE course_lesson ADD CONSTRAINT FK_564CB5BE591CC992 FOREIGN KEY (course_id) REFERENCES course (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE course_lesson DROP FOREIGN KEY FK_564CB5BE591CC992');
        $this->addSql('ALTER TABLE course_lesson CHANGE course_id course_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE course_lesson ADD CONSTRAINT FK_564CB5BE591CC992 FOREIGN KEY (course_id) REFERENCES course (id) ON DELETE SET NULL');
    }
}
