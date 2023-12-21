<?php

namespace August\Controllers;

use August\Services\ArticleService;
use August\Services\CategorieService;
use August\Services\CommentaryService;
use August\Controllers\AbstractController;

class CategorieController extends AbstractController
{
    protected CategorieService $categorieService;
    private ArticleService  $articleService;

    public function __construct()
    {
        $this->categorieService = new CategorieService;


        $this->articleService = new ArticleService();
    }

    public function index($id)
    {

        $categosies = $this->categorieService->getAllCategories();

        $resultats = $this->articleService->getArticlesByCategorie($id);

        $categoryArticles = \count($resultats);

        if ($categoryArticles > 0) {
            $articles = $resultats;

            foreach ($articles as $value) {

                $articleId = $value->getId();
                $commentary = new CommentaryService();

                //recuperation des commentaires
                $commentaries = $commentary->getCommentariesForArticle($articleId);

                //comptage du nombre
                $commentariesNuber = \count($commentaries);

                $allarticleCommentariesNumber["$articleId"] = $commentariesNuber;
            }
        } else {
            //  $articles = $this->articleService->getAllArticles();
            $articles = [];

            foreach ($articles as $value) {

                $articleId = $value->getId();
                $commentary = new CommentaryService();

                //recuperation des commentaires
                $commentaries = $commentary->getCommentariesForArticle($articleId);

                //comptage du nombre
                $commentariesNuber = \count($commentaries);

                $allarticleCommentariesNumber["$articleId"] = $commentariesNuber;
            }
        }



        $data = [
            "categories" => $categosies,
            "articles" => $articles,
            "number" => $allarticleCommentariesNumber
        ];
        $this->renderView("/home", $data);
    }

    public function getAllCategories()
    {
        $categories = $this->categorieService->getAllCategories();
        $data = [
            "categories" => $categories
        ];

        $this->renderView("nav-bar", $data);
    }
}
