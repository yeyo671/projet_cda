<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231112235000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment ADD paint_id INT DEFAULT NULL, ADD blogpost_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C9017B5FF FOREIGN KEY (paint_id) REFERENCES paint (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C27F5416E FOREIGN KEY (blogpost_id) REFERENCES blogpost (id)');
        $this->addSql('CREATE INDEX IDX_9474526C9017B5FF ON comment (paint_id)');
        $this->addSql('CREATE INDEX IDX_9474526C27F5416E ON comment (blogpost_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C9017B5FF');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C27F5416E');
        $this->addSql('DROP INDEX IDX_9474526C9017B5FF ON comment');
        $this->addSql('DROP INDEX IDX_9474526C27F5416E ON comment');
        $this->addSql('ALTER TABLE comment DROP paint_id, DROP blogpost_id');
    }
}
