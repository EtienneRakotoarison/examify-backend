<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241004202526 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE answer (id INT AUTO_INCREMENT NOT NULL, student_id INT NOT NULL, exam_id INT NOT NULL, response INT DEFAULT NULL, score INT DEFAULT NULL, INDEX IDX_DADD4A25CB944F1A (student_id), INDEX IDX_DADD4A25578D5E91 (exam_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE question (id INT AUTO_INCREMENT NOT NULL, question_text VARCHAR(255) DEFAULT NULL, choices JSON DEFAULT NULL COMMENT \'(DC2Type:json)\', correct_answer_index INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT FK_DADD4A25CB944F1A FOREIGN KEY (student_id) REFERENCES student (id)');
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT FK_DADD4A25578D5E91 FOREIGN KEY (exam_id) REFERENCES exam (id)');
        $this->addSql('ALTER TABLE exam ADD subject_id INT NOT NULL, ADD status INT DEFAULT NULL');
        $this->addSql('ALTER TABLE exam ADD CONSTRAINT FK_38BBA6C623EDC87 FOREIGN KEY (subject_id) REFERENCES subject (id)');
        $this->addSql('CREATE INDEX IDX_38BBA6C623EDC87 ON exam (subject_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE answer DROP FOREIGN KEY FK_DADD4A25CB944F1A');
        $this->addSql('ALTER TABLE answer DROP FOREIGN KEY FK_DADD4A25578D5E91');
        $this->addSql('DROP TABLE answer');
        $this->addSql('DROP TABLE question');
        $this->addSql('ALTER TABLE exam DROP FOREIGN KEY FK_38BBA6C623EDC87');
        $this->addSql('DROP INDEX IDX_38BBA6C623EDC87 ON exam');
        $this->addSql('ALTER TABLE exam DROP subject_id, DROP status');
    }
}
