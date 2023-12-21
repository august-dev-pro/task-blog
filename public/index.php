<?php
session_start();

use August\Helpers\Router;
use August\Entitys\CategorieEntity;
use August\Controllers\HomeController;
use August\Controllers\UserController;
use August\Controllers\SearchController;
use August\Controllers\ArticleController;
use August\Controllers\CategorieController;
use August\Controllers\CommentaryController;
use August\Controllers\AdministratorController;

require_once '../vendor/autoload.php';

$chemin = new Router;
$chemin->addRoute("/", HomeController::class, "index");

//text
$chemin->addRoute("/image_uploaded", AdministratorController::class, "exempleUpload");

/* administration */
$chemin->addRoute("/administration", AdministratorController::class, "dashboard");
$chemin->addRoute("/admin-login", AdministratorController::class, "login");
$chemin->addRoute("/administration/add-article", AdministratorController::class, "addArticle");
$chemin->addRoute("/administration/add-categorie", AdministratorController::class, "addCategorie");
$chemin->addRoute("/administration/add-admin", AdministratorController::class, "addAdmin");
$chemin->addRoute("/administration/articles", AdministratorController::class, "showArticles");

/* user */
$chemin->addRoute("/register", UserController::class, "registerUser");
$chemin->addRoute("/login", UserController::class, "loginUser");
$chemin->addRoute("/logout", UserController::class, "logout");

/* article */
$chemin->addRoute("/article/{id}", ArticleController::class, "show");
$chemin->addRoute("/search", HomeController::class, "search");
/* categorie routes */
$chemin->addRoute("/categorie/{id}", CategorieController::class, "index");

$chemin->addRoute("nav-bar", CategorieController::class, "");
$chemin->addRoute("bar-nar-header", AdministratorController::class, "");


$chemin->route();
