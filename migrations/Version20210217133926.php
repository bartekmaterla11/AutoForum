<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210217133926 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE attribute_value ADD offer_id INT DEFAULT NULL, CHANGE name value VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE attribute_value ADD CONSTRAINT FK_FE4FBB8253C674EE FOREIGN KEY (offer_id) REFERENCES offer (id)');
        $this->addSql('CREATE INDEX IDX_FE4FBB8253C674EE ON attribute_value (offer_id)');
        $this->addSql('ALTER TABLE template ADD category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE template ADD CONSTRAINT FK_97601F8312469DE2 FOREIGN KEY (category_id) REFERENCES main_category (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_97601F8312469DE2 ON template (category_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE attribute_value DROP FOREIGN KEY FK_FE4FBB8253C674EE');
        $this->addSql('DROP INDEX IDX_FE4FBB8253C674EE ON attribute_value');
        $this->addSql('ALTER TABLE attribute_value DROP offer_id, CHANGE value name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE template DROP FOREIGN KEY FK_97601F8312469DE2');
        $this->addSql('DROP INDEX UNIQ_97601F8312469DE2 ON template');
        $this->addSql('ALTER TABLE template DROP category_id');
    }
}
