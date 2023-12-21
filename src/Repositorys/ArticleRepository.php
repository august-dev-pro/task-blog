<?php

namespace August\Repositorys;

use August\Entitys\ArticleEntity;

class ArticleRepository extends AbstractRepository
{
    //methode charger de l'enregistrement d'un article dans la BD
    public function addArticle(ArticleEntity $article)
    {
        $query = "INSERT INTO articles (title, excerpt, content, publish_date, updated_date, image, author_id, categorie_id, published) VALUES (:title, :excerpt,
        :content, :publish_date, :updated_date, :image, :author_id, :categorie_id, :published)";

        $statment = $this->connection->prepare($query);
        $params = [
            "title" => $article->getTitle(),
            "excerpt" => $article->getDescription(),
            "content" => $article->getContent(),
            "publish_date" => $article->getPublishDate(),
            "updated_date" => $article->getUpdatedDate(),
            "image" => $article->getFiles(),
            "author_id" => $article->getAuthorId(),
            "categorie_id" => $article->getCategorieId(),
            "published" => $article->getPublished()
        ];

        $resultat = $statment->execute($params);
        return $resultat;
    }

    //methode chargée de la recuperation de tous les articles de la BD
    public function getAllArticles()
    {
        $sql = "SELECT * FROM articles";

        $resultat = $this->connection->query($sql);

        $articles = [];
        foreach ($resultat as $value) {
            $article = new ArticleEntity;
            $article->setId($value["id"])
                ->setTitle($value["title"])
                ->setDescription($value["excerpt"])
                ->setContent($value["content"])
                ->setFiles($value["image"])
                ->setPublishDate($value["publish_date"])
                ->setUpdatedDate($value["updated_date"])
                ->setAuthorId($value["author_id"])
                ->setCategorieId($value["categorie_id"]);
            $articles[] = $article;
        }

        return $articles;
    }


    public function getArticlesByCategorie($categorie_id)
    {
        $sql = "SELECT * FROM articles WHERE categorie_id = :categorie_id";
        $stmt = $this->connection->prepare($sql);

        $params = [
            "categorie_id" => $categorie_id
        ];

        $resultat = $stmt->execute($params);

        if ($resultat) {
            $resultat = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        $articles = [];

        foreach ($resultat as $value) {
            $article = new ArticleEntity;
            $article->setId($value["id"])
                ->setTitle($value["title"])
                ->setDescription($value["description"])
                ->setPublishDate($value["publish_date"])
                ->setAuthorId($value["author_id"])
                ->setCategorieId($value["categorie_id"]);
            $articles[] = $article;
        }

        return $articles;
    }

    //methode chargée de la recuperation d'un article
    public function getArticleById($id)
    {
        $sql = "SELECT * FROM articles WHERE id = :id";
        $statment = $this->connection->prepare($sql);
        $params = ["id" => $id];
        $article = $statment->execute($params);
        $article = $statment->fetch(\PDO::FETCH_ASSOC);
        $newArticle = new ArticleEntity;
        $newArticle->setId($article["id"])
            ->setTitle($article["title"])
            ->setDescription($article["content"])
            ->setPublishDate($article["publish_date"])
            ->setAuthorId($article["author_id"])
            ->setCategorieId($article["categorie_id"]);
        return $newArticle;
    }


    //methode chargée de la suppression  d'un article
    public function deleteArticleById($id)
    {
        $sql = "DELETE FROM article WHERE  id = $id";
        $resultat = $this->connection->query($sql);
        return $resultat;
    }

    //methode chargée de la suppression de tous les article
    public function deletedAllArticles()
    {
        $sql = "DELETE FROM article";
        $resultat = $this->connection->query($sql);
        return $resultat;
    }

    //methode chargée de la modifacation d'un article


    // methode de recherche d'articles
    public function searchArticles($searchTerm)
    {
        // requete pour rechercher des articles en fonction du terme de recherche
        $query = "SELECT * FROM article WHERE title LIKE :searchTerm OR description LIKE :searchTerm";

        $stmt = $this->connection->prepare($query);

        // params
        $params = [
            "searchTerm" => "%" . $searchTerm . "%"
        ];

        // Exécution de la requête
        $stmt->execute($params);

        // Associer les resultats en un tableau
        $resultats = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $articles = [];
        foreach ($resultats as $value) {
            $article = new ArticleEntity;
            $article->setId($value["id"])
                ->setTitle($value["title"])
                ->setDescription($value["description"])
                ->setPublishDate($value["publish_date"])
                ->setAuthorId($value["author_id"])
                ->setCategorieId($value["categorie_id"]);
            $articles[] = $article;
        }

        return $articles;
    }
    public function articleResultatSetter(
        $id_value,
        $title_value,
        $description_value,
        $publish_date_value,
        $author_id_value,
        $categorie_id_value
    ) {
        $article = new ArticleEntity;
        $article->setId($id_value)
            ->setTitle($title_value)
            ->setDescription($description_value)
            ->setPublishDate($publish_date_value)
            ->setAuthorId($author_id_value)
            ->setCategorieId($categorie_id_value);
        return $article;
    }
}
