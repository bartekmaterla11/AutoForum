<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210131201700 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE attribute (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE attribute_value (id INT AUTO_INCREMENT NOT NULL, attribute_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_FE4FBB82B6E62EFA (attribute_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fuel (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mark_of_cars (id INT AUTO_INCREMENT NOT NULL, template_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_516D039E5DA0FB8 (template_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE model_of_cars (id INT AUTO_INCREMENT NOT NULL, mark_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_506CFCD64290F12B (mark_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offer (id INT AUTO_INCREMENT NOT NULL, template_id INT DEFAULT NULL, category_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, INDEX IDX_29D6873E5DA0FB8 (template_id), INDEX IDX_29D6873E12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE template (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE template_attribute (template_id INT NOT NULL, attribute_id INT NOT NULL, INDEX IDX_3329994D5DA0FB8 (template_id), INDEX IDX_3329994DB6E62EFA (attribute_id), PRIMARY KEY(template_id, attribute_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE attribute_value ADD CONSTRAINT FK_FE4FBB82B6E62EFA FOREIGN KEY (attribute_id) REFERENCES attribute (id)');
        $this->addSql('ALTER TABLE mark_of_cars ADD CONSTRAINT FK_516D039E5DA0FB8 FOREIGN KEY (template_id) REFERENCES template (id)');
        $this->addSql('ALTER TABLE model_of_cars ADD CONSTRAINT FK_506CFCD64290F12B FOREIGN KEY (mark_id) REFERENCES mark_of_cars (id)');
        $this->addSql('ALTER TABLE offer ADD CONSTRAINT FK_29D6873E5DA0FB8 FOREIGN KEY (template_id) REFERENCES template (id)');
        $this->addSql('ALTER TABLE offer ADD CONSTRAINT FK_29D6873E12469DE2 FOREIGN KEY (category_id) REFERENCES main_category (id)');
        $this->addSql('ALTER TABLE template_attribute ADD CONSTRAINT FK_3329994D5DA0FB8 FOREIGN KEY (template_id) REFERENCES template (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE template_attribute ADD CONSTRAINT FK_3329994DB6E62EFA FOREIGN KEY (attribute_id) REFERENCES attribute (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE children_category CHANGE parent_category_id parent_category_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE attribute_value DROP FOREIGN KEY FK_FE4FBB82B6E62EFA');
        $this->addSql('ALTER TABLE template_attribute DROP FOREIGN KEY FK_3329994DB6E62EFA');
        $this->addSql('ALTER TABLE model_of_cars DROP FOREIGN KEY FK_506CFCD64290F12B');
        $this->addSql('ALTER TABLE mark_of_cars DROP FOREIGN KEY FK_516D039E5DA0FB8');
        $this->addSql('ALTER TABLE offer DROP FOREIGN KEY FK_29D6873E5DA0FB8');
        $this->addSql('ALTER TABLE template_attribute DROP FOREIGN KEY FK_3329994D5DA0FB8');
        $this->addSql('DROP TABLE attribute');
        $this->addSql('DROP TABLE attribute_value');
        $this->addSql('DROP TABLE fuel');
        $this->addSql('DROP TABLE mark_of_cars');
        $this->addSql('DROP TABLE model_of_cars');
        $this->addSql('DROP TABLE offer');
        $this->addSql('DROP TABLE template');
        $this->addSql('DROP TABLE template_attribute');
        $this->addSql('ALTER TABLE children_category CHANGE parent_category_id parent_category_id INT NOT NULL');
    }
}
