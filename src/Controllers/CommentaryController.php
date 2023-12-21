<?php

namespace August\Controllers;

use August\Controllers\AbstractController;

class CommentaryController extends AbstractController
{
    public function index()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            echo "le btn d'ajout de commentaire a ete soumis";
            if (isset($_SESSION['user_id'])) {
                $path = $_SESSION['user_id'];
            } elseif (isset($_SESSION['administrator_id'])) {
                $path = $_SESSION['administrator_id'];
            }
        }
    }
}
