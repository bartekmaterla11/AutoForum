<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201207145520 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE comment_answer (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, answer_id INT DEFAULT NULL, content VARCHAR(255) NOT NULL, uploaded_at DATETIME NOT NULL, like_up INT NOT NULL, INDEX IDX_10CE1237A76ED395 (user_id), INDEX IDX_10CE1237AA334807 (answer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comment_answer ADD CONSTRAINT FK_10CE1237A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE comment_answer ADD CONSTRAINT FK_10CE1237AA334807 FOREIGN KEY (answer_id) REFERENCES answer (id)');
        $this->addSql('DROP TABLE comment');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, user_id_id INT DEFAULT NULL, answer_id_id INT NOT NULL, content VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, uploaded_at DATETIME NOT NULL, INDEX IDX_9474526C9D86650F (user_id_id), INDEX IDX_9474526CE47E7704 (answer_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CE47E7704 FOREIGN KEY (answer_id_id) REFERENCES answer (id)');
        $this->addSql('DROP TABLE comment_answer');
    }
}
