<?php

namespace August\Controllers;

use August\Entitys\ArticleEntity;
use August\Entitys\CategorieEntity;
use August\Entitys\CommentaryEntity;
use August\Services\ArticleService;
use August\Controllers\AbstractController;
use August\Services\CategorieService;
use August\Services\CommentaryService;
use August\Services\UserService;

class ArticleController extends AbstractController
{
    private $articleService;
    protected $commentaryService;
    private $userService;
    private $message;
    private $author;
    public function __construct()
    {
        $this->articleService = new ArticleService;
        $this->commentaryService = new CommentaryService;
        //  $this->userService = new UserService;
    }

    public function show($id)
    {
        $article = $this->articleService->getArticleById($id);

        // Recuperation des commentaire de l'articles
        $commentaries = $this->commentaryService->getCommentariesForArticle($id);

        //recuperation des auteurs des commentaires
        foreach ($commentaries as $value) {

            $authorId = $value->getAuthorId();

            $newUser = new UserService;

            $newUser = $newUser->getUserById($authorId);

            $authorEmail = $newUser->getEmail();

            $authors[$authorId] = $authorEmail;
        }


        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if (isset($_POST["add-commentary"])) {

                if (!isset($_SESSION['administrator_id'])) {

                    header("location: /login");
                } elseif (!isset($_SESSION['user_id'])) {

                    header("location: /login");
                }

                //recuperation des données du commentaire
                $content = $_POST["commentary"];

                //  $publish_date = $_POST["publish_date"];
                $article_id = $article->getId();

                if (isset($_SESSION['user_id'])) {

                    //recuperation de l'id si c'est un simple utilisateur
                    $author_id = $_SESSION["user_id"];
                } elseif (isset($_SESSION['administrator_id'])) {

                    //recuperation de l'id si c'est un administrateur
                    $author_id = $_SESSION["administrator_id"];
                }

                //enregistrement dans l'entité Commentary
                $commentary = new CommentaryEntity;
                $commentary->setContent($content);
                //  $commentary->setPublishDate($publish_date);
                $commentary->setAuthorId($author_id);
                $commentary->setArticleId($article_id);

                //appel du service de l'enregistrement d'un commentaire
                $resultat = $this->commentaryService->addCommentary($commentary);
                if ($resultat) {
                    header("location: /article/$article_id");
                } else {
                    echo "erreur lors du commentaire";
                }
            } elseif (isset($_POST["commentary-delete"])) {

                $commentaryId = $_POST["commentary_id"];


                $resultat = $this->commentaryService->deleteCommentary($commentaryId);

                if ($resultat) {
                    header("location: /article/$id");
                } else {
                    echo "erreur de suppression";
                }
            }
        }

        $data = [
            "article" => $article,
            "commentaries" => $commentaries,
            "authors" => $authors
            //  "commentariesNumber" => $commentariesNumber
        ];
        $this->renderView("/article/show-by-id", $data);
    }

    public function getArticlesByCategorie()
    {
        $this->renderView("");
    }
}
