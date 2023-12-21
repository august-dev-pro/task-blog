<?php

namespace August\Controllers;

use August\Entitys\UserEntity;
use August\Services\CommentaryService;
use August\Services\UserService;
use August\Entitys\ArticleEntity;
use August\Entitys\CategorieEntity;
use August\Services\ArticleService;
use August\Services\CategorieService;
use August\Controllers\AbstractController;

class AdministratorController extends AbstractController
{
    protected $articleService;
    protected $categorieService;
    protected $userService;
    protected $commentaryService;
    private $messages;

    public function __construct()
    {
        $this->articleService = new ArticleService;
        $this->categorieService = new CategorieService;
        $this->userService = new UserService;
        $this->commentaryService = new CommentaryService;
    }

    public function login()
    {
        if ($this->loged("admin")) {
            $this->redirect("/administration");
        }

        if ($this->hasPosted()) {
            $email = $_POST["email"];
            $password = $_POST["password"];
            $admin = new UserEntity();
            $admin->setEmail($email)->setPassword($password);
            $newUser = $this->userService->authentificateUser($admin);
            if ($newUser instanceof UserEntity) {
                if (
                    $newUser->getRole() == "admin" or
                    $newUser->getRole() == "super_admin"
                ) {
                    $_SESSION["user"] = ["id" => $newUser->getId(), "role" => $newUser->getRole()];
                    $this->redirect("/administration");
                    exit(502);
                } else {
                    $_SESSION["user"] = ["id" => $newUser->getId(), "role" => $newUser->getRole()];
                    header("Location:/");
                    exit(502);
                }
            } else {
                $this->messages["error"] = "Verifier vos informations ";
            }

            $data = [
                "error" => $this->messages["error"] ?? "",
                "succes" => $this->messages["succes"] ?? ""
            ];

            return $this->renderView("/administrator/admin-login", $data);
        }

        $data = [
            "error" => $this->messages["error"] ?? "",
            "succes" => $this->messages["succes"] ?? ""
        ];

        $this->renderView("/administrator/admin-login", $data);
    }

    public function dashboard()
    {
        if (!$this->loged("admin")) {

            $this->redirect("/admin-login");
        }


        //recuperation des données necessaires pour la page admin
        $articles = $this->articleService->getAllArticles();
        $categories = $this->categorieService->getAllCategories();

        $data = [
            "articles" => $articles,
            "categories" => $categories
        ];

        //chargement de la vue aproprié
        $this->renderView("/administrator/administrator-interface", $data);
    }

    public function addCategorie()
    {
        if (!$this->loged("admin")) {
            $this->redirect("/admin-login");
        }

        if ($this->hasPosted()) {
            $categorieName = $_POST["name"];

            $categorie = new CategorieEntity();
            $categorie->setName($categorieName);

            $resultat = $this->categorieService->addCategorie($categorie);

            if ($resultat) {
                $this->messages["succes"] = "categorie bien enrgistrer";
            } else {
                $this->messages["error"] = "erreur categorie non enregitrer";
            }

            $data = [
                "error" => $this->messages["error"] ?? "",
                "succes" => $this->messages["succes"] ?? ""
            ];

            return  $this->renderView("/administrator/add-category", $data);
        }

        $data = [
            "error" => $this->messages["error"] ?? "",
            "succes" => $this->messages["succes"] ?? ""
        ];

        $this->renderView("/administrator/add-category", $data);
    }

    public function addArticle()
    {
        if (!$this->loged("admin")) {
            $this->redirect("/admin-login");
        }

        if ($this->hasPosted()) {
            //recuperation des données soumis par l'utilisateur
            $fileInfo = $_FILES["file"];
            $title = $_POST["title"];
            $description = $_POST["excerpt"];
            $content = $_POST["content"];
            $published = 0;
            $categorie_id = $_POST["categorie_id"];
            $author_id = $_POST["author_id"];

            $file = $this->imageUploaded($fileInfo);

            if (isset($_POST["published"])) {
                $published = 1;
            }

            //Enrgistrement des données du formulaire dans le model Article
            $article = new ArticleEntity();
            $article->setTitle($title)
                ->setDescription($description)
                ->setContent($content)
                ->setFiles($file)
                ->setAuthorId($author_id)
                ->setCategorieId($categorie_id)
                ->setPublished($published)
                ->setPublishDate(date("d-m-y"))
                ->setUpdatedDate(date("d-m-y"));


            //appel du service Article pour le trandfert des données
            $resultat = $this->articleService->addArticle($article);

            //message a affiché par condition
            if ($resultat) {
                $this->messages["succes"] = "l'article a bien ete ajouter";
            } else {
                $this->messages["error"] = "erreur lors de l'enregistrement de l'article";
            }
            $categories = $this->categorieService->getAllCategories();

            $data = [
                "error" => $this->messages["error"] ?? "",
                "succes" => $this->messages["succes"] ?? "",
                "categories" => $categories
            ];

            $this->renderView("/administrator/add-article", $data);
        }
        $categories = $this->categorieService->getAllCategories();

        $data = [
            "error" => $this->messages["error"] ?? "",
            "succes" => $this->messages["succes"] ?? "",
            "categories" => $categories
        ];
        $this->renderView("/administrator/add-article", $data);
    }

    public function addAdmin()
    {
        if (!$this->loged("super-admin")) {
            $this->redirect("/");
            exit(502);
        }

        if ($this->hasPosted()) {
            /* recuperation des données saisie */
            $name = $_POST["name"];
            $surname = $_POST["surname"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $confirm_password = $_POST["confirm_password"];
            $role = $_POST["role"];

            /* enregistrement des données saisi */
            $admin = new UserEntity();
            $admin->setName($name)
                ->setSurname($surname)
                ->setEmail($email)
                ->setPassword($password)
                ->setRole($role);

            /* verification des mot de passe saisie */
            if ($password != $confirm_password) {
                $this->messages["error"] = "mot de pass non identique";
                $data = [
                    "error" => $this->messages["error"]
                ];
                return $this->renderView("/administrator/add-admin", $data);
            }

            //cryptage mot de pass
            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            /* insertion du mot de passe */
            $admin->setPassword($password_hash);

            /* apel du service d'insertion */
            $resultat = $this->userService->registerUser($admin);

            //message a affiché par condition
            if ($resultat) {
                $this->messages["succes"] = "l'Administrateur a bien ete ajouter";
            } else {
                $this->messages["error"] = "erreur lors de l'enregistrement de l'Administrateur";
            }
            $categories = $this->categorieService->getAllCategories();

            $data = [
                "error" => $this->messages["error"] ?? "",
                "succes" => $this->messages["succes"] ?? "",
                "categories" => $categories
            ];

            $this->renderView("/administrator/add-admin", $data);
        }

        $this->renderView("/administrator/add-admin");
    }
    protected function slice_array($array)
    {
        return array_slice($array, 0,  count($array) - 1);
    }


    /* image upload */
    public function exempleUpload()
    {

        if ($this->hasPosted()) {
            $image = $_FILES["image"];

            $fileName = $this->imageUploaded($image);

            if ($fileName) {
                /*  $uploadPath = '../../public/images/'; // Chemin vers le dossier "MonProjet/public/images"
                // generer un nom
                $fileNewName = $this->createFileName($image["name"]);


                $destination = __DIR__ . '../../images/' . $fileNewName; */
                $this->messages["succes"] = "Fichier bien téléchargé";
            } else {
                $this->messages["error"] = "Erreur de l'enregistrement";
            }
        }


        $data = [
            "error" => $this->messages["error"] ?? "",
            "succes" => $this->messages["succes"] ?? ""
        ];




        $this->renderView("image_uploaded", $data);
    }

    public function createFileName($OriginaleFileName)
    {
        // Utilisez pathinfo pour obtenir des informations sur le fichier
        $fileInfo = pathinfo($OriginaleFileName);

        // Obtenez le nom du fichier (sans extension)
        $fileName = $fileInfo['filename'];

        // Obtenez l'extension du nom du fichier
        $fileExtention = $fileInfo['extension'];

        //nom Aleatoire du fichier
        if (mb_strlen($fileName) > 5) {
            $smallName = mb_substr($fileName, 0, 5);
        } else {
            $smallName = $fileName;
        }
        //creation d 'un id
        $id = date("d-m-y-h-i");

        // concatener pour avoir un nom unique et cour
        $fileNewName = $smallName . $id . '.' . $fileExtention;

        return $fileNewName;
    }
}
