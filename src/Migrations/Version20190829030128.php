<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Создает таблицы "Элемент портфолио" и "Категория портфолио".
 */
final class Version20190829030128 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE portfolio_element (id INT AUTO_INCREMENT NOT NULL, active TINYINT(1) NOT NULL, sort INT NOT NULL, slug VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, title_detail VARCHAR(255) DEFAULT NULL, image_for_list_filename VARCHAR(255) DEFAULT NULL, image_breadcrumbs_filename VARCHAR(255) DEFAULT NULL, breadcrumbs_styles LONGTEXT DEFAULT NULL, description LONGTEXT DEFAULT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE portfolio_element_portfolio_category (portfolio_element_id INT NOT NULL, portfolio_category_id INT NOT NULL, INDEX IDX_6593FBEF2D39EE56 (portfolio_element_id), INDEX IDX_6593FBEFAC7FAB36 (portfolio_category_id), PRIMARY KEY(portfolio_element_id, portfolio_category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE portfolio_category (id INT AUTO_INCREMENT NOT NULL, active TINYINT(1) NOT NULL, sort INT NOT NULL, slug VARCHAR(255) NOT NULL, short_title VARCHAR(255) NOT NULL, title_detail VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE portfolio_element_portfolio_category ADD CONSTRAINT FK_6593FBEF2D39EE56 FOREIGN KEY (portfolio_element_id) REFERENCES portfolio_element (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE portfolio_element_portfolio_category ADD CONSTRAINT FK_6593FBEFAC7FAB36 FOREIGN KEY (portfolio_category_id) REFERENCES portfolio_category (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE portfolio_element_portfolio_category DROP FOREIGN KEY FK_6593FBEF2D39EE56');
        $this->addSql('ALTER TABLE portfolio_element_portfolio_category DROP FOREIGN KEY FK_6593FBEFAC7FAB36');
        $this->addSql('DROP TABLE portfolio_element');
        $this->addSql('DROP TABLE portfolio_element_portfolio_category');
        $this->addSql('DROP TABLE portfolio_category');
    }
}
