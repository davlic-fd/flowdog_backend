<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241203094049 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE event (id SERIAL NOT NULL, device_id VARCHAR(255) NOT NULL, event_date INT NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE event_device_malfunction (id INT NOT NULL, reason_code INT NOT NULL, reason_text VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE event_door_unlocked (id INT NOT NULL, unlock_date INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE event_temperature_exceeded (id INT NOT NULL, temp DOUBLE PRECISION NOT NULL, treshold DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE event_device_malfunction ADD CONSTRAINT FK_9399222BBF396750 FOREIGN KEY (id) REFERENCES event (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE event_door_unlocked ADD CONSTRAINT FK_47F3CD1DBF396750 FOREIGN KEY (id) REFERENCES event (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE event_temperature_exceeded ADD CONSTRAINT FK_A4283E8EBF396750 FOREIGN KEY (id) REFERENCES event (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE event_device_malfunction DROP CONSTRAINT FK_9399222BBF396750');
        $this->addSql('ALTER TABLE event_door_unlocked DROP CONSTRAINT FK_47F3CD1DBF396750');
        $this->addSql('ALTER TABLE event_temperature_exceeded DROP CONSTRAINT FK_A4283E8EBF396750');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE event_device_malfunction');
        $this->addSql('DROP TABLE event_door_unlocked');
        $this->addSql('DROP TABLE event_temperature_exceeded');
    }
}
