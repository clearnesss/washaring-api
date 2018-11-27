<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181126155444 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE reservation (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, customer_id INTEGER DEFAULT NULL, created_at DATETIME NOT NULL)');
        $this->addSql('CREATE INDEX IDX_42C849559395C3F3 ON reservation (customer_id)');
        $this->addSql('CREATE TABLE reservations_users_services (reservation_id INTEGER NOT NULL, users_services_id INTEGER NOT NULL, PRIMARY KEY(reservation_id, users_services_id))');
        $this->addSql('CREATE INDEX IDX_3B0783C0B83297E7 ON reservations_users_services (reservation_id)');
        $this->addSql('CREATE INDEX IDX_3B0783C059409A33 ON reservations_users_services (users_services_id)');
        $this->addSql('CREATE TABLE address (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER DEFAULT NULL, street CLOB NOT NULL, city VARCHAR(255) NOT NULL, zip_code VARCHAR(5) NOT NULL, country VARCHAR(50) NOT NULL, is_default BOOLEAN NOT NULL)');
        $this->addSql('CREATE INDEX IDX_D4E6F81A76ED395 ON address (user_id)');
        $this->addSql('CREATE TABLE service (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description CLOB DEFAULT NULL, suggested_price NUMERIC(10, 2) DEFAULT NULL)');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(255) NOT NULL, phone VARCHAR(12) NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, roles CLOB DEFAULT NULL --(DC2Type:json)
        )');
        $this->addSql('CREATE TABLE users_services (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER DEFAULT NULL, service_id INTEGER DEFAULT NULL, price NUMERIC(10, 2) NOT NULL, further_information CLOB DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_873CAB3A76ED395 ON users_services (user_id)');
        $this->addSql('CREATE INDEX IDX_873CAB3ED5CA9E6 ON users_services (service_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE reservations_users_services');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE users_services');
    }
}
