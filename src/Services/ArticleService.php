<?php

namespace August\Services;

use August\Repositorys\ArticleRepository;

class ArticleService
{
    public $articleRepository;
    public function __construct()
    {
        $this->articleRepository = new ArticleRepository;
    }

    //methode-service chargé de l'apel du ripo chargé de la recuperation de tpus les articles
    public function getAllArticles()
    {
        $resultat = $this->articleRepository->getAllArticles();
        return $resultat;
    }

    //methode-service chargé de l'apel du ripo chargé de la recuperation de tpus les articles
    public function getArticleById($id)
    {
        $resultat = $this->articleRepository->getArticleById($id);
        return $resultat;
    }

    //methode-service chargé de l'apel du ripo chargé de l'enregistrement d'un article
    public function addArticle($article)
    {
        //Appel du Repository et la methode chargé l'enregistrement des articles
        $resultat = $this->articleRepository->addArticle($article);
        return $resultat;
    }

    //methode-service chargé de l'apel du ripo chargé de la suppression d'un article
    public function deleteArticleById($id)
    {
        $resultat = $this->articleRepository->deleteArticleById($id);
        return $resultat;
    }

    //fonction de recherche
    public function searchArticles($searchTerm)
    {
        $resultat = $this->articleRepository->searchArticles($searchTerm);
        return $resultat;
    }

    //categorie article

    public function getArticlesByCategorie($categorie_id)
    {
        $resultat = $this->articleRepository->getArticlesByCategorie($categorie_id);
        return $resultat;
    }
}
