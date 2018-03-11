<?php
namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

class Version20180311181914 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        //Create authors table
        $table = $schema->createTable('authors');
        $table->addColumn('id', 'integer', ['autoincrement'=>true]);
        $table->addColumn('name', 'text', ['notnull'=>true]);
        $table->setPrimaryKey(['id']);
        $table->addOption('engine' , 'InnoDB');

        //Create books table
        $table = $schema->createTable('books');
        $table->addColumn('id', 'integer', ['autoincrement'=>true]);
        $table->addColumn('author_id', 'integer');
        $table->addColumn('title', 'text', ['notnull'=>true]);
        $table->setPrimaryKey(['id']);
        $table->addOption('engine' , 'InnoDB');
        $table->addForeignKeyConstraint('authors', ['author_id'], ['id'], [], 'author_author_id_fk');
    }

    public function postUp(Schema $schema)
    {
        //Insert default content to table authors
        $sql = "INSERT INTO authors
          (`name`)
          VALUES
          ('George Orwell'),
          ('Mark Twain'),
          ('Ernest Miller Hemingway'),
          ('Franz Kafka'),
          ('Charles Dickens')";
        $this->connection->executeQuery($sql);

        //Insert default content to table books
        $sql = "INSERT INTO books
          (`author_id`, `title`)
          VALUES
          (1,'Down and Out in Paris and London'),
          (1,'Burmese Days'),
          (1,'A Clergyman`s Daughter'),
          (1,'Keep the Aspidistra Flying'),
          (1,'The Road to Wigan Pier'),
          (2,'Roughing It'),
          (2,'The Gilded Age'),
          (2,'Following the Equator'),
          (2,'The Adventures of Tom Sawyer'),
          (2,' The Adventures of Huckleberry Finn'),
          (3,'Indian Camp'),
          (3,'Fiesta. The Sun Also Rises'),
          (3,'The Short Happy Life of Francis Macomber'),
          (3,'For Whom the Bell Tolls'),
          (3,'The Old Man and the Sea'),
          (4,'Beschreibung eines Kampfes'),
          (4,'Hochzeitsvorbereitungen auf dem Lande'),
          (4,'Die Verwandlung'),
          (4,'Blumfeld, ein älterer Junggeselle'),
          (4,'Ein Landarzt'),
          (5,'Oliver Twist'),
          (5,'Bleak House'),
          (5,'Hard Times'),
          (5,'Little Dorrit'),
          (5,'A Christmas Carol')";
        $this->connection->executeQuery($sql);
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $schema->getTable('books')->removeForeignKey('author_author_id_fk');

        $schema->dropTable('books');
        $schema->dropTable('authors');

    }
}
