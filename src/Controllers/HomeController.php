<?php

namespace August\Controllers;

use August\Controllers\AbstractController;
use August\Entitys\ArticleEntity;
use August\Entitys\CategorieEntity;
use August\Entitys\CommentaryEntity;
use August\Services\ArticleService;
use August\Services\CategorieService;
use August\Services\CommentaryService;

class HomeController extends AbstractController
{
    private ArticleService  $articleService;
    private CategorieService $categorieService;

    public function __construct()
    {
        $this->articleService = new ArticleService();
        $this->categorieService = new CategorieService();
    }


    public function index()
    {
        $categosies = $this->categorieService->getAllCategories();
        $articles = $this->articleService->getAllArticles();

        foreach ($articles as $value) {

            $articleId = $value->getId();
            $commentary = new CommentaryService();

            //recuperation des commentaires
            $commentaries = $commentary->getCommentariesForArticle($articleId);

            //comptage du nombre
            $commentariesNuber = \count($commentaries);

            $allarticleCommentariesNumber["$articleId"] = $commentariesNuber;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $articleId = $_POST["article_id"];

            $newArticle = $this->articleService->getArticleById($articleId);

            if ($newArticle) {
                $data = [
                    "article" => $newArticle
                ];

                $this->renderView("/article/show-by-id", $data);
            }
        } else {
            $data = [
                "categories" => $categosies,
                "articles" => $articles,
                "number" => $allarticleCommentariesNumber
            ];
            $this->renderView("/home", $data);
        }
    }

    public function search($q)
    {
        $articles = $this->articleService->searchArticles($q);
        $data = ["articles" => $articles];
        $this->renderView("home", $data);
    }
}
