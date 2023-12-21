<?php

namespace August\Repositorys;

use August\Entitys\CommentaryEntity;
use August\Repositorys\AbstractRepository;

class CommentaryRepository extends AbstractRepository
{
    //methode charger de l'enregistrement d'un commentaire dans la BD
    public function addCommentary(CommentaryEntity $commentary)
    {
        $query = "INSERT INTO commentaries (content, publish_date, author_id, article_id) VALUES (:content, :publish_date, :author_id, :article_id)";

        $statment = $this->connection->prepare($query);

        //recuperation de la date local automatiquement
        $autoPublishDate = date('d-m-y');

        $params = [
            "content" =>  $commentary->getContent(),
            "publish_date" => $autoPublishDate,
            "author_id" => $commentary->getAuthorId(),
            "article_id" => $commentary->getArticleId()
        ];

        $resultat = $statment->execute($params);
        return $resultat;
    }

    //recuperation des commentaire d'un article
    public function getCommentariesForArticle($article_id)
    {
        $sql = "SELECT * FROM commentaries WHERE article_id = $article_id";
        $resultat = $this->connection->query($sql);

        $commentaries = [];

        foreach ($resultat as $value) {
            $commentary = new CommentaryEntity;
            $commentary->setId($value["id"])
                ->setContent($value["content"])
                ->setPublishDate($value["publish_date"])
                ->setAuthorId($value["author_id"])
                ->setArticleId($value["article_id"]);
            $commentaries[] = $commentary;
        }

        return $commentaries;
    }

    public function deleteCommentariesForArticle($article_id)
    {
        $sql = "DELETE FROM commentaries WHERE article_id = :article_id";
        $stmt = $this->connection->prepare($sql);

        $params = [
            "article_id" => $article_id
        ];

        $resultat = $stmt->execute($params);

        return $resultat;
    }

    public function deleteCommentary($commentaryId)
    {
        $sql = "DELETE FROM commentaries WHERE id = :commentary_id";

        $stmt = $this->connection->prepare($sql);

        $params = [
            "commentary_id" => $commentaryId
        ];

        $resultat = $stmt->execute($params);

        return $resultat;
    }
}
