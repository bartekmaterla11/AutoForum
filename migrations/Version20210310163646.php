<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210310163646 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE attribute_value CHANGE value value VARCHAR(2000) NOT NULL');
        $this->addSql('ALTER TABLE photo_files_for_offer DROP FOREIGN KEY FK_C4502C1053C674EE');
        $this->addSql('ALTER TABLE photo_files_for_offer ADD CONSTRAINT FK_C4502C1053C674EE FOREIGN KEY (offer_id) REFERENCES offer (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE attribute_value CHANGE value value VARCHAR(5000) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE photo_files_for_offer DROP FOREIGN KEY FK_C4502C1053C674EE');
        $this->addSql('ALTER TABLE photo_files_for_offer ADD CONSTRAINT FK_C4502C1053C674EE FOREIGN KEY (offer_id) REFERENCES offer (id)');
    }
}
