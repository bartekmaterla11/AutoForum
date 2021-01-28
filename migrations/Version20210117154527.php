<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210117154527 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE photo_files_for_posts (id INT AUTO_INCREMENT NOT NULL, post_id INT DEFAULT NULL, filename VARCHAR(255) NOT NULL, INDEX IDX_65DB11D44B89032C (post_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE photo_files_for_posts ADD CONSTRAINT FK_65DB11D44B89032C FOREIGN KEY (post_id) REFERENCES post (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE categories');
        $this->addSql('ALTER TABLE comment_answer DROP like_up, CHANGE answer_id answer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE post DROP like_down');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, post_id INT DEFAULT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_3AF346684B89032C (post_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE categories ADD CONSTRAINT FK_3AF346684B89032C FOREIGN KEY (post_id) REFERENCES post (id)');
        $this->addSql('DROP TABLE photo_files_for_posts');
        $this->addSql('ALTER TABLE comment_answer ADD like_up INT NOT NULL, CHANGE answer_id answer_id INT NOT NULL');
        $this->addSql('ALTER TABLE post ADD like_down INT NOT NULL');
    }
}
