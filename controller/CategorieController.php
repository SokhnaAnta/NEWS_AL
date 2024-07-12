<?php

require_once 'modele/domaine/Categorie.php';
require_once 'modele/dao/CategorieDAO.php';

class CategorieController {
    private $dao;

    public function __construct() {
        $this->dao = new CategorieDAO();
    }

    public function listCategories() {
        $categories = $this->dao->getList();
        include_once 'vue/inc/header.php';
        include(__DIR__ . '/../vue/categories/list.php');
    }

    public function addCategorie() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $categorie = new Categorie();
            $categorie->libelle = $_POST['libelle'];
            $this->dao->addCategorie($categorie);
            header('Location: index.php?action=list_categories');
        } else {
            include_once 'vue/inc/header.php';
            include(__DIR__ . '/../vue/categories/add.php');
        }
    }

    public function editCategorie($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $categorie = new Categorie();
            $categorie->id = $id;
            $categorie->libelle = $_POST['libelle'];
            $this->dao->updateCategorie($categorie);
            header('Location: index.php?action=list_categories');
        } else {
            $categorie = $this->dao->getById($id);
            include_once 'vue/inc/header.php';
            include(__DIR__ . '/../vue/categories/edit.php');
        }
    }

    public function deleteCategorie($id) {
        $this->dao->deleteCategorie($id);
        header('Location: index.php?action=list_categories');
    }
}
?>
