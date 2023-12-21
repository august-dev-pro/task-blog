<?php

namespace August\Controllers;

class AbstractController
{
    protected $templatePath = "/templates/";
    public function renderView($viewPath, $data = [])
    {
        $relativePath = dirname(__DIR__, 2) . $this->templatePath;
        $this->templatePath;
        if (file_exists($relativePath . $viewPath . ".php")) {

            extract($data);

            ob_start();
            //on inclu l'enfant
            include $relativePath . $viewPath . ".php";
            $content = ob_get_clean();
            //on inclu le parent
            include $relativePath . "template.php";
        } else {
            $content = "<h1>la view: $viewPath n'existe pas dans le dossier templates</h1>";
            include $relativePath . "template.php";
        }
    }

    public function redirect($path, $status = null)
    {
        header("Location: $path");
        exit();
    }

    public function loged($role): bool
    {
        if ((isset($_SESSION["user"]) and isset($_SESSION["user"]["role"])) and ($_SESSION["user"]["role"] == "super_admin" or $_SESSION["user"]["role"] == $role)) {
            return true;
        }
        return false;
    }
    //Il verifie si le formulaire a ete soumis
    public function hasPosted()
    {
        return $_SERVER["REQUEST_METHOD"] == "POST";
    }


    public function hasIsset(string $nameOfForm)
    {
        return isset($_POST[$nameOfForm]);
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

    public function imageUploaded($image)
    {
        if (
            (is_uploaded_file($image["tmp_name"]) && getimagesize($image["tmp_name"])) and
            ($fileNewName = $this->createFileName($image["name"])) and
            move_uploaded_file($image["tmp_name"], __DIR__ . '../../../public/images/' . $fileNewName)
        ) {
            return $fileNewName;
        } else {

            return false;
        }
    }


    protected function uploadImage($image, $destinationDirectory)
    {
        // Vérifie que le dossier de destination existe et est accessible en écriture
        if (!is_dir($destinationDirectory) || !is_writable($destinationDirectory)) {
            return false; // Erreur : le dossier de destination n'existe pas ou n'est pas accessible en écriture.
        }

        // Vérifie si le fichier est valide et une image
        if (is_uploaded_file($image["tmp_name"]) && getimagesize($image["tmp_name"])) {
            $fileNewName = $this->createFileName($image["name"]);
            $destination = $destinationDirectory . $fileNewName;

            // Tente de déplacer le fichier
            if (move_uploaded_file($image["tmp_name"], $destination)) {
                return $fileNewName; // Succès : retourne le nom du fichier généré
            }
        }

        return false; // Erreur : fichier invalide ou non une image, ou impossible de déplacer le fichier.
    }
}
