<?php

namespace August\Migration;

use August\Helpers\Connexion;

class Migration
{
    protected $connexion;
    public function __construct()
    {
        $dbconnexion = new connexion();
        $this->connexion = $dbconnexion->getConnection();
    }
    public function createTable()
    {
        $ARTICLE = "CREATE TABLE ARTICLES (
            id INT AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR (150) NOT NULL,
            content TEXT NOT NULL,
            published BOOLEAN DEFAULT 0,
            updated_date DATE NOT NULL,
            excerpt VARCHAR(255) NOT NULL,
            publish_date DATE NOT NULL,
            author_id INT NOT NULL,
            categorie_id INT NOT NULL,
            image TEXT NOT NULL,
            FOREIGN KEY (categorie_id) REFERENCES CATEGORIES(id),
            FOREIGN KEY (author_id) REFERENCES USERS(id)

        )";

        $CATEGORIE = "CREATE TABLE CATEGORIES (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR (150) NOT NULL
        )";

        $USER = "CREATE TABLE USERS (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR (255) NOT NULL,
            surname VARCHAR (255) NOT NULL,
            email VARCHAR (255) NOT NULL,
            password VARCHAR (255) NOT NULL,
            role ENUM('user', 'admin','super_admin' ) NOT NULL DEFAULT 'user'
        )";

        $COMMENTARY = "CREATE TABLE COMMENTARIES (
            id INT AUTO_INCREMENT PRIMARY KEY,
            content TEXT NOT NULL,
            publish_date DATE,
            author_id INT NOT NULL,
            article_id INT NOT NULL,
            FOREIGN KEY (article_id) REFERENCES ARTICLES(id),
            FOREIGN KEY (author_id) REFERENCES USERS(id)
        )";


        try {

            $this->connexion->exec($ARTICLE);
            $this->connexion->exec($CATEGORIE);
            $this->connexion->exec($COMMENTARY);
            $this->connexion->exec($USER);

            echo "Tables créées avec succès!";
        } catch (\PDOException $e) {
            echo "Erreur lors de la création des tables : " . $e->getMessage();
        }
    }
}
