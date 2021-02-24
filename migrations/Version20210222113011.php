<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210222113011 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mark_of_vans_and_trucks ADD children_category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE mark_of_vans_and_trucks ADD CONSTRAINT FK_EC031B339C8F3AE5 FOREIGN KEY (children_category_id) REFERENCES children_category (id)');
        $this->addSql('CREATE INDEX IDX_EC031B339C8F3AE5 ON mark_of_vans_and_trucks (children_category_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mark_of_vans_and_trucks DROP FOREIGN KEY FK_EC031B339C8F3AE5');
        $this->addSql('DROP INDEX IDX_EC031B339C8F3AE5 ON mark_of_vans_and_trucks');
        $this->addSql('ALTER TABLE mark_of_vans_and_trucks DROP children_category_id');
    }
}
