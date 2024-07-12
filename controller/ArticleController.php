<?php

require_once(__DIR__ . '/../modele/domaine/Article.php');
require_once(__DIR__ . '/../modele/domaine/Categorie.php');
require_once(__DIR__ . '/../modele/dao/ArticleDao.php');
require_once(__DIR__ . '/../modele/dao/CategorieDao.php');


class ArticleController {
    private $dao;

    public function __construct() {
        $this->dao = new ArticleDAO();
    }

    public function listArticles() {
        $articles = $this->dao->getList();
        $categorieDao = new CategorieDAO();
        $categories = $categorieDao->getList();
        include_once 'vue/inc/header.php';
        include_once 'vue/Articles/list.php';
    }

    public function addArticle() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $article = new Article();
            $article->titre = $_POST['titre'];
            $article->contenu = $_POST['contenu'];
            $article->categorie = $_POST['categorie'];
            $article->utilisateur_id = $_SESSION['user_id'];
            $this->dao->addArticle($article);
            header('Location: index.php?action=list_articles');
        } else {
            $categorieDao = new CategorieDAO();
            $categories = $categorieDao->getList();
            require_once __DIR__ . '/../vue/inc/header.php';
            include(__DIR__ . '/../vue/Articles/add.php');
        }
    }

    public function editArticle($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $article = new Article();
            $article->id = $id;
            $article->titre = $_POST['titre'];
            $article->contenu = $_POST['contenu'];
            $article->categorie = $_POST['categorie'];
            $article->utilisateur_id = $_POST['utilisateur_id'];
            $this->dao->updateArticle($article);
            header('Location: index.php?action=list_articles');
        } else {
            $categorieDao = new CategorieDAO();
            $categories = $categorieDao->getList();
            $article = $this->dao->getArticleById($id);
            require_once __DIR__ . '/../vue/inc/header.php';
            include(__DIR__ . '/../vue/Articles/edit.php');
        }
    }

    public function deleteArticle($id) {
        $this->dao->deleteArticle($id);
        header('Location: index.php?action=list_articles');
    }
}
?>
