<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210102211835 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE answer DROP FOREIGN KEY FK_DADD4A254B89032C');
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT FK_DADD4A254B89032C FOREIGN KEY (post_id) REFERENCES post (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE comment_answer DROP FOREIGN KEY FK_10CE1237AA334807');
        $this->addSql('ALTER TABLE comment_answer ADD CONSTRAINT FK_10CE1237AA334807 FOREIGN KEY (answer_id) REFERENCES answer (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE answer DROP FOREIGN KEY FK_DADD4A254B89032C');
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT FK_DADD4A254B89032C FOREIGN KEY (post_id) REFERENCES post (id)');
        $this->addSql('ALTER TABLE comment_answer DROP FOREIGN KEY FK_10CE1237AA334807');
        $this->addSql('ALTER TABLE comment_answer ADD CONSTRAINT FK_10CE1237AA334807 FOREIGN KEY (answer_id) REFERENCES answer (id)');
    }
}
