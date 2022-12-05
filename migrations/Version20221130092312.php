<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221130092312 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE answer (id INT AUTO_INCREMENT NOT NULL, content VARCHAR(255) NOT NULL, created_at DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, created_at DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE level (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE question (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, content LONGTEXT NOT NULL, created_at DATE NOT NULL, updated_at DATE DEFAULT NULL, INDEX IDX_B6F7494E12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE question_level (question_id INT NOT NULL, level_id INT NOT NULL, INDEX IDX_AA01DD171E27F6BF (question_id), INDEX IDX_AA01DD175FB14BA7 (level_id), PRIMARY KEY(question_id, level_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE question_game (question_id INT NOT NULL, game_id INT NOT NULL, INDEX IDX_7DC5DC631E27F6BF (question_id), INDEX IDX_7DC5DC63E48FD905 (game_id), PRIMARY KEY(question_id, game_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE question_answer (id INT AUTO_INCREMENT NOT NULL, answer_id INT NOT NULL, question_id INT NOT NULL, is_good TINYINT(1) NOT NULL, INDEX IDX_DD80652DAA334807 (answer_id), INDEX IDX_DD80652D1E27F6BF (question_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, pseudo VARCHAR(255) NOT NULL, total_score INT DEFAULT NULL, created_at DATE NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_game (user_id INT NOT NULL, game_id INT NOT NULL, INDEX IDX_59AA7D45A76ED395 (user_id), INDEX IDX_59AA7D45E48FD905 (game_id), PRIMARY KEY(user_id, game_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_game_answer (id INT AUTO_INCREMENT NOT NULL, answer_id INT NOT NULL, game_id INT NOT NULL, user_id INT NOT NULL, good TINYINT(1) NOT NULL, delay_answer NUMERIC(10, 2) NOT NULL, INDEX IDX_EF32E78AA334807 (answer_id), INDEX IDX_EF32E78E48FD905 (game_id), INDEX IDX_EF32E78A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494E12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE question_level ADD CONSTRAINT FK_AA01DD171E27F6BF FOREIGN KEY (question_id) REFERENCES question (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE question_level ADD CONSTRAINT FK_AA01DD175FB14BA7 FOREIGN KEY (level_id) REFERENCES level (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE question_game ADD CONSTRAINT FK_7DC5DC631E27F6BF FOREIGN KEY (question_id) REFERENCES question (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE question_game ADD CONSTRAINT FK_7DC5DC63E48FD905 FOREIGN KEY (game_id) REFERENCES game (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE question_answer ADD CONSTRAINT FK_DD80652DAA334807 FOREIGN KEY (answer_id) REFERENCES answer (id)');
        $this->addSql('ALTER TABLE question_answer ADD CONSTRAINT FK_DD80652D1E27F6BF FOREIGN KEY (question_id) REFERENCES question (id)');
        $this->addSql('ALTER TABLE user_game ADD CONSTRAINT FK_59AA7D45A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_game ADD CONSTRAINT FK_59AA7D45E48FD905 FOREIGN KEY (game_id) REFERENCES game (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_game_answer ADD CONSTRAINT FK_EF32E78AA334807 FOREIGN KEY (answer_id) REFERENCES answer (id)');
        $this->addSql('ALTER TABLE user_game_answer ADD CONSTRAINT FK_EF32E78E48FD905 FOREIGN KEY (game_id) REFERENCES game (id)');
        $this->addSql('ALTER TABLE user_game_answer ADD CONSTRAINT FK_EF32E78A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494E12469DE2');
        $this->addSql('ALTER TABLE question_level DROP FOREIGN KEY FK_AA01DD171E27F6BF');
        $this->addSql('ALTER TABLE question_level DROP FOREIGN KEY FK_AA01DD175FB14BA7');
        $this->addSql('ALTER TABLE question_game DROP FOREIGN KEY FK_7DC5DC631E27F6BF');
        $this->addSql('ALTER TABLE question_game DROP FOREIGN KEY FK_7DC5DC63E48FD905');
        $this->addSql('ALTER TABLE question_answer DROP FOREIGN KEY FK_DD80652DAA334807');
        $this->addSql('ALTER TABLE question_answer DROP FOREIGN KEY FK_DD80652D1E27F6BF');
        $this->addSql('ALTER TABLE user_game DROP FOREIGN KEY FK_59AA7D45A76ED395');
        $this->addSql('ALTER TABLE user_game DROP FOREIGN KEY FK_59AA7D45E48FD905');
        $this->addSql('ALTER TABLE user_game_answer DROP FOREIGN KEY FK_EF32E78AA334807');
        $this->addSql('ALTER TABLE user_game_answer DROP FOREIGN KEY FK_EF32E78E48FD905');
        $this->addSql('ALTER TABLE user_game_answer DROP FOREIGN KEY FK_EF32E78A76ED395');
        $this->addSql('DROP TABLE answer');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE game');
        $this->addSql('DROP TABLE level');
        $this->addSql('DROP TABLE question');
        $this->addSql('DROP TABLE question_level');
        $this->addSql('DROP TABLE question_game');
        $this->addSql('DROP TABLE question_answer');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_game');
        $this->addSql('DROP TABLE user_game_answer');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
