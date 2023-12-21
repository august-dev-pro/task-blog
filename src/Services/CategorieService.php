<?php

namespace August\Services;

use August\Repositorys\CategorieRepository;

class CategorieService
{
    private $categoryRepository;

    public function __construct()
    {
        $this->categoryRepository = new CategorieRepository();
    }

    //methode service chargée de de l'apel du ripo chargé de l'enregistrement d'une categorie
    public function addCategorie($categorie)
    {
        //Appel du Repository et la methode chargé l'enregistrement des categories
        $resultat = $this->categoryRepository->addCategorie($categorie);
        return $resultat;
    }

    //methode service chargée de de l'apel du ripo chargé de l'enregistrement d'une categorie
    public function getAllCategories()
    {
        $resultat = $this->categoryRepository->getAllCategories();
        return $resultat;
    }

    public function deleteCategorieById($categorie_id)
    {
        return "";
    }
    public function  deleteAllCategories()
    {
        return "";
    }
}
