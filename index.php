<?php
require_once 'controller/Controller.php';
require_once 'controller/AuthController.php';
require_once 'controller/ArticleController.php';
require_once 'controller/CategorieController.php';

session_start(); 
$controller = new Controller();
$authController = new AuthController();
$articleController = new ArticleController() ;
$action = isset($_GET['action']) ? strtolower($_GET['action']) : '';
$categorieController = new CategorieController() ;

switch ($action) {
    case '':
        $controller->accueil();
        break;
    case 'article':
        if (isset($_GET['id'])) {
            $controller->article($_GET['id']);
        } else {
            $controller->showErrorPage();
        }
        break;
    case 'categorie':
        if (isset($_GET['id'])) {
            $controller->categorie($_GET['id']);
        } else {
            $controller->showErrorPage();
        }
        break;
    case 'login':
        $authController->login();
        break;
    case 'authenticate':
        $authController->authenticate();
        break;
    case 'logout':
        $authController->logout();
        break;
    case 'list_articles':
        $articleController->listArticles();
        break ;
    case 'add_article':
        $articleController->addArticle();
        break ;
     case 'update_article':
        $articleController->editArticle($_REQUEST['id']);
        break ;
     case 'delete_article':
        $articleController->deleteArticle($_REQUEST['id']);
        break ;
    case 'list_categories':
        $categorieController->listCategories();
        break ;
    case 'add_categorie':
        $categorieController->addcategorie();
        break ;
    case 'edit_categorie':
        $categorieController->editcategorie($_REQUEST['id']);
        break ;
    case 'delete_categorie':
        $categorieController->deletecategorie($_REQUEST['id']);
        break ;
        case 'list_utilisateurs':
            $authController->listUtilisateurs();
            break ;
        case 'add_utilisateur':
            $authController->addUtilisateur();
            break ;
        case 'edit_utilisateur':
            $authController->editUtilisateur($_REQUEST['id']);
            break ;
        case 'delete_utilisateur':
            $authController->deleteUtilisateur($_REQUEST['id']);
            break ;
    default:
        $controller->ShowErrorPage();
        break;
}

