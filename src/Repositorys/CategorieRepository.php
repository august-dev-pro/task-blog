<?php

namespace August\Repositorys;

use August\Entitys\CategorieEntity;
use August\Repositorys\AbstractRepository;

class CategorieRepository extends AbstractRepository
{
    //methode charger de l'enregistrement d'une categorie dans la BD
    public function addCategorie(CategorieEntity $categorie)
    {
        $query = "INSERT INTO categories (name) VALUES (:name)";

        $statment = $this->connection->prepare($query);
        $params = [
            "name" =>  $categorie->getName()
        ];

        $resultat = $statment->execute($params);
        return $resultat;
    }

    //methode charger de la recuperation des categories
    public function getAllCategories()
    {
        $sql = "SELECT * FROM categories";

        $resultat = $this->connection->query($sql);

        $categories = [];
        foreach ($resultat as $value) {
            $categorie = new CategorieEntity;
            $categorie->setId($value["id"])
                ->setName($value["name"]);
            $categories[] = $categorie;
        }

        return $categories;
    }
}
