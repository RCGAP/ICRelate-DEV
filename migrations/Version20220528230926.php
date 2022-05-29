<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220528230926 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE moderation (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, introduction LONGTEXT NOT NULL, content VARCHAR(255) NOT NULL, youtube VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE blog_post ADD created_at DATETIME NOT NULL, ADD introduction VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE post_dislike CHANGE post_id post_id INT NOT NULL, CHANGE user_id user_id INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE moderation');
        $this->addSql('ALTER TABLE blog_post DROP created_at, DROP introduction');
        $this->addSql('ALTER TABLE post_dislike CHANGE post_id post_id INT DEFAULT NULL, CHANGE user_id user_id INT DEFAULT NULL');
    }
}
