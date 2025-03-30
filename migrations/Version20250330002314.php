<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250330002314 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE book (id BINARY(16) NOT NULL COMMENT '(DC2Type:uuid)', created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', updated_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', is_actif TINYINT(1) NOT NULL, deleted_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', title VARCHAR(255) NOT NULL, author VARCHAR(255) NOT NULL, isbn VARCHAR(255) NOT NULL, category VARCHAR(255) NOT NULL, added_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', UNIQUE INDEX UNIQ_CBE5A331CC1CF4E6 (isbn), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE borrowing (id BINARY(16) NOT NULL COMMENT '(DC2Type:uuid)', user_id BINARY(16) DEFAULT NULL COMMENT '(DC2Type:uuid)', library_id BINARY(16) DEFAULT NULL COMMENT '(DC2Type:uuid)', book_id BINARY(16) DEFAULT NULL COMMENT '(DC2Type:uuid)', created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', updated_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', is_actif TINYINT(1) NOT NULL, deleted_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', borrow_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', due_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', return_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', status INT NOT NULL, INDEX IDX_226E5897A76ED395 (user_id), INDEX IDX_226E5897FE2541D7 (library_id), INDEX IDX_226E589716A2B381 (book_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE library (id BINARY(16) NOT NULL COMMENT '(DC2Type:uuid)', created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', updated_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', is_actif TINYINT(1) NOT NULL, deleted_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', name VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, address LONGTEXT NOT NULL, phone VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE library_book (id BINARY(16) NOT NULL COMMENT '(DC2Type:uuid)', library_id BINARY(16) DEFAULT NULL COMMENT '(DC2Type:uuid)', book_id BINARY(16) DEFAULT NULL COMMENT '(DC2Type:uuid)', created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', updated_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', is_actif TINYINT(1) NOT NULL, deleted_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', available_stock INT NOT NULL, total_stock INT NOT NULL, INDEX IDX_6D2A695CFE2541D7 (library_id), INDEX IDX_6D2A695C16A2B381 (book_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE reservation (id BINARY(16) NOT NULL COMMENT '(DC2Type:uuid)', user_id BINARY(16) DEFAULT NULL COMMENT '(DC2Type:uuid)', book_id BINARY(16) DEFAULT NULL COMMENT '(DC2Type:uuid)', library_id BINARY(16) DEFAULT NULL COMMENT '(DC2Type:uuid)', created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', updated_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', is_actif TINYINT(1) NOT NULL, deleted_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', reservation_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', status INT NOT NULL, INDEX IDX_42C84955A76ED395 (user_id), INDEX IDX_42C8495516A2B381 (book_id), INDEX IDX_42C84955FE2541D7 (library_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE user_library (id BINARY(16) NOT NULL COMMENT '(DC2Type:uuid)', user_id BINARY(16) DEFAULT NULL COMMENT '(DC2Type:uuid)', library_id BINARY(16) DEFAULT NULL COMMENT '(DC2Type:uuid)', created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', updated_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', is_actif TINYINT(1) NOT NULL, deleted_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', registration_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', INDEX IDX_F98D86B6A76ED395 (user_id), INDEX IDX_F98D86B6FE2541D7 (library_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE borrowing ADD CONSTRAINT FK_226E5897A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE borrowing ADD CONSTRAINT FK_226E5897FE2541D7 FOREIGN KEY (library_id) REFERENCES library (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE borrowing ADD CONSTRAINT FK_226E589716A2B381 FOREIGN KEY (book_id) REFERENCES book (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE library_book ADD CONSTRAINT FK_6D2A695CFE2541D7 FOREIGN KEY (library_id) REFERENCES library (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE library_book ADD CONSTRAINT FK_6D2A695C16A2B381 FOREIGN KEY (book_id) REFERENCES book (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation ADD CONSTRAINT FK_42C84955A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation ADD CONSTRAINT FK_42C8495516A2B381 FOREIGN KEY (book_id) REFERENCES book (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation ADD CONSTRAINT FK_42C84955FE2541D7 FOREIGN KEY (library_id) REFERENCES library (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user_library ADD CONSTRAINT FK_F98D86B6A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user_library ADD CONSTRAINT FK_F98D86B6FE2541D7 FOREIGN KEY (library_id) REFERENCES library (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE borrowing DROP FOREIGN KEY FK_226E5897A76ED395
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE borrowing DROP FOREIGN KEY FK_226E5897FE2541D7
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE borrowing DROP FOREIGN KEY FK_226E589716A2B381
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE library_book DROP FOREIGN KEY FK_6D2A695CFE2541D7
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE library_book DROP FOREIGN KEY FK_6D2A695C16A2B381
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955A76ED395
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation DROP FOREIGN KEY FK_42C8495516A2B381
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955FE2541D7
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user_library DROP FOREIGN KEY FK_F98D86B6A76ED395
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user_library DROP FOREIGN KEY FK_F98D86B6FE2541D7
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE book
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE borrowing
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE library
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE library_book
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE reservation
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE user_library
        SQL);
    }
}
