<?php
require_once 'controller/Controller.php';

$controller = new Controller();

if (!isset($_GET['action'])) {
    $controller->accueil();
} else {
    $action = strtolower($_GET['action']);
    if ($action === 'article') {
        if (isset($_GET['id'])) {
            $controller->article($_GET['id']);
        } else {
            $controller->showErrorPage();
        }
    } elseif ($action === 'categorie') {
        if (isset($_GET['id'])) {
            $controller->categorie($_GET['id']);
        } else {
            $controller->showErrorPage();
        }
    } else {
        $controller->accueil();
    }
}
?>
