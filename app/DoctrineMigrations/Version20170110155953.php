<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170110155953 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE s_user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, email VARCHAR(255) DEFAULT NULL, facebook_id VARCHAR(32) DEFAULT NULL, facebook_access_token VARCHAR(255) DEFAULT NULL, google_id VARCHAR(32) DEFAULT NULL, google_access_token VARCHAR(255) DEFAULT NULL, linkedin_id VARCHAR(32) DEFAULT NULL, linkedin_access_token VARCHAR(255) DEFAULT NULL, bitbucket_id VARCHAR(32) DEFAULT NULL, bitbucket_access_token VARCHAR(255) DEFAULT NULL, github_id VARCHAR(32) DEFAULT NULL, github_access_token VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_2AE08F839BE8FD98 (facebook_id), UNIQUE INDEX UNIQ_2AE08F8376F5C865 (google_id), UNIQUE INDEX UNIQ_2AE08F8399ABDB52 (linkedin_id), UNIQUE INDEX UNIQ_2AE08F83940F544 (bitbucket_id), UNIQUE INDEX UNIQ_2AE08F83D4327649 (github_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE s_skill_synonym (id INT AUTO_INCREMENT NOT NULL, alias VARCHAR(255) NOT NULL, synonym VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQUE_SYNONYM_ALIAS (alias, synonym), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE s_city (id INT AUTO_INCREMENT NOT NULL, alias VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQUE_ALIAS (alias), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE s_skill_priority (id INT AUTO_INCREMENT NOT NULL, alias VARCHAR(255) NOT NULL, priority INT NOT NULL, UNIQUE INDEX UNIQUE_ALIAS (alias), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE s_user');
        $this->addSql('DROP TABLE s_skill_synonym');
        $this->addSql('DROP TABLE s_city');
        $this->addSql('DROP TABLE s_skill_priority');
    }
}
