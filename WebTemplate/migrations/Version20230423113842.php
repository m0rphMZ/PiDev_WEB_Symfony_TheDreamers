<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230423113842 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY fk_user_com');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY fk_user_event');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY fk_locid');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY host_fk');
        $this->addSql('ALTER TABLE eventreaction DROP FOREIGN KEY user_id_fk');
        $this->addSql('ALTER TABLE eventreaction DROP FOREIGN KEY event_id_fk');
        $this->addSql('ALTER TABLE invite DROP FOREIGN KEY fk_inviter');
        $this->addSql('ALTER TABLE invite DROP FOREIGN KEY fk_artiste');
        $this->addSql('ALTER TABLE invite DROP FOREIGN KEY fk_event_in');
        $this->addSql('ALTER TABLE like_comment DROP FOREIGN KEY fk_id_com');
        $this->addSql('ALTER TABLE like_comment DROP FOREIGN KEY fk_iduser');
        $this->addSql('ALTER TABLE location DROP FOREIGN KEY fk_codeC');
        $this->addSql('ALTER TABLE reclamation DROP FOREIGN KEY fk_user_rec');
        $this->addSql('ALTER TABLE reclamation DROP FOREIGN KEY fk_reclamation_user_id');
        $this->addSql('ALTER TABLE reponses DROP FOREIGN KEY reponses_ibfk_3');
        $this->addSql('ALTER TABLE reponses DROP FOREIGN KEY reponses_ibfk_1');
        $this->addSql('ALTER TABLE reponses DROP FOREIGN KEY reponses_ibfk_4');
        $this->addSql('ALTER TABLE reponses DROP FOREIGN KEY reponses_ibfk_2');
        $this->addSql('ALTER TABLE reponses DROP FOREIGN KEY reponses_ibfk_5');
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY event_fk');
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY iduser_foreign');
        $this->addSql('DROP TABLE avis');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE categorie_loc');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE eventreaction');
        $this->addSql('DROP TABLE invite');
        $this->addSql('DROP TABLE like_comment');
        $this->addSql('DROP TABLE location');
        $this->addSql('DROP TABLE reclamation');
        $this->addSql('DROP TABLE redection');
        $this->addSql('DROP TABLE reponses');
        $this->addSql('DROP TABLE ticket');
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE livraison ADD numtel VARCHAR(8) NOT NULL');
        $this->addSql('ALTER TABLE messenger_messages CHANGE delivered_at delivered_at DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE avis (idAvis INT AUTO_INCREMENT NOT NULL, idProduit INT NOT NULL, contenu VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, INDEX fk_idProduit (idProduit), PRIMARY KEY(idAvis)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE categorie (idCategorie INT AUTO_INCREMENT NOT NULL, libcategorie VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, PRIMARY KEY(idCategorie)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE categorie_loc (codeC_loc INT NOT NULL, libelleC_loc VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, PRIMARY KEY(codeC_loc)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE commentaire (id_com INT AUTO_INCREMENT NOT NULL, id_user INT NOT NULL, id_event INT NOT NULL, commentaire VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, LikeCount INT DEFAULT 0 NOT NULL, INDEX fk_user_com (id_user), INDEX fk_user_event (id_event), PRIMARY KEY(id_com)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE event (event_id INT AUTO_INCREMENT NOT NULL, host_id INT NOT NULL, location_id INT NOT NULL, title VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, type VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, description TEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, startDate DATE NOT NULL, endDate DATE NOT NULL, ticketCount INT NOT NULL, affiche VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, ticketPrice DOUBLE PRECISION NOT NULL, INDEX host_fk (host_id), INDEX fk_locid (location_id), PRIMARY KEY(event_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE eventreaction (event_id INT NOT NULL, user_id INT NOT NULL, reaction VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, INDEX user_id_fk (user_id), INDEX IDX_55C84F2571F7E88B (event_id), PRIMARY KEY(event_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE invite (inv_id INT AUTO_INCREMENT NOT NULL, event_id INT NOT NULL, inviter_id INT NOT NULL, artiste_id INT NOT NULL, status VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, INDEX fk_event_in (event_id), INDEX fk_inviter (inviter_id), INDEX fk_artiste (artiste_id), PRIMARY KEY(inv_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'table_invitation \' ');
        $this->addSql('CREATE TABLE like_comment (id_like INT AUTO_INCREMENT NOT NULL, id_com INT NOT NULL, id_user INT NOT NULL, etat TINYINT(1) NOT NULL, INDEX fk_iduser (id_user), INDEX fk_id_com (id_com), PRIMARY KEY(id_like)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE location (num_loc INT AUTO_INCREMENT NOT NULL, code_catg INT NOT NULL, descipt_loc VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, lieu_loc VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, surface_loc DOUBLE PRECISION NOT NULL, nb_pers_loc INT NOT NULL, image LONGBLOB NOT NULL, INDEX fk_codeC (code_catg), PRIMARY KEY(num_loc)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE reclamation (rec_id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, titre_rec VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, type VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, description TEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, date-creation DATE NOT NULL, date_fin DATE DEFAULT \'NULL\', status VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'\'\'Open\'\'\' NOT NULL COLLATE `utf8mb4_general_ci`, INDEX idx_user_id (user_id), PRIMARY KEY(rec_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE redection (coder VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, valr DOUBLE PRECISION NOT NULL, PRIMARY KEY(coder)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE reponses (rep_id INT AUTO_INCREMENT NOT NULL, rec_id INT NOT NULL, user_id INT NOT NULL, admin_id INT DEFAULT NULL, rep_description LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, date_rep DATE DEFAULT \'current_timestamp()\' NOT NULL, INDEX idx_rec_id (rec_id), INDEX idx_user_id (user_id), PRIMARY KEY(rep_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE ticket (ticket_id INT AUTO_INCREMENT NOT NULL, event_id INT NOT NULL, user_id INT NOT NULL, price DOUBLE PRECISION NOT NULL, qrCodeImg VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, INDEX iduser_foreign (user_id), INDEX event_fk (event_id), PRIMARY KEY(ticket_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'table_ticket\' ');
        $this->addSql('CREATE TABLE user (id_user INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, prenom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, email VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, mdp VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, tel INT NOT NULL, image LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, role VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, PRIMARY KEY(id_user)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'table utilisateur\' ');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT fk_user_com FOREIGN KEY (id_user) REFERENCES user (id_user) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT fk_user_event FOREIGN KEY (id_event) REFERENCES event (event_id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT fk_locid FOREIGN KEY (location_id) REFERENCES location (num_loc) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT host_fk FOREIGN KEY (host_id) REFERENCES user (id_user) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE eventreaction ADD CONSTRAINT user_id_fk FOREIGN KEY (user_id) REFERENCES user (id_user) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE eventreaction ADD CONSTRAINT event_id_fk FOREIGN KEY (event_id) REFERENCES event (event_id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE invite ADD CONSTRAINT fk_inviter FOREIGN KEY (inviter_id) REFERENCES user (id_user) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE invite ADD CONSTRAINT fk_artiste FOREIGN KEY (artiste_id) REFERENCES user (id_user) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE invite ADD CONSTRAINT fk_event_in FOREIGN KEY (event_id) REFERENCES event (event_id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE like_comment ADD CONSTRAINT fk_id_com FOREIGN KEY (id_com) REFERENCES commentaire (id_com) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE like_comment ADD CONSTRAINT fk_iduser FOREIGN KEY (id_user) REFERENCES user (id_user) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE location ADD CONSTRAINT fk_codeC FOREIGN KEY (code_catg) REFERENCES categorie_loc (codeC_loc)');
        $this->addSql('ALTER TABLE reclamation ADD CONSTRAINT fk_user_rec FOREIGN KEY (user_id) REFERENCES user (id_user) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reclamation ADD CONSTRAINT fk_reclamation_user_id FOREIGN KEY (user_id) REFERENCES user (id_user)');
        $this->addSql('ALTER TABLE reponses ADD CONSTRAINT reponses_ibfk_3 FOREIGN KEY (rec_id) REFERENCES reclamation (rec_id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reponses ADD CONSTRAINT reponses_ibfk_1 FOREIGN KEY (rec_id) REFERENCES reclamation (rec_id)');
        $this->addSql('ALTER TABLE reponses ADD CONSTRAINT reponses_ibfk_4 FOREIGN KEY (user_id) REFERENCES user (id_user) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reponses ADD CONSTRAINT reponses_ibfk_2 FOREIGN KEY (user_id) REFERENCES user (id_user)');
        $this->addSql('ALTER TABLE reponses ADD CONSTRAINT reponses_ibfk_5 FOREIGN KEY (user_id) REFERENCES user (id_user) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT event_fk FOREIGN KEY (event_id) REFERENCES event (event_id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT iduser_foreign FOREIGN KEY (user_id) REFERENCES user (id_user) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE livraison DROP numtel');
        $this->addSql('ALTER TABLE messenger_messages CHANGE delivered_at delivered_at DATETIME DEFAULT \'NULL\'');
    }
}
