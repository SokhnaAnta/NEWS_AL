<?php
require_once 'modele/domaine/Article.php';
require_once 'modele/domaine/Categorie.php';
require_once 'modele/dao/ArticleDao.php';
require_once 'modele/dao/CategorieDao.php';



class Controller{
    function __construct(){
        

    }

    public function accueil(){
        $articleDao = new ArticleDAO();
        $articlesPerPage = 5; 
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1; 
        $offset = ($currentPage - 1) * $articlesPerPage; 

        $articles = $articleDao->getListbyDC($offset, $articlesPerPage);

        $totalArticles = $articleDao->getTotalCount();
        $totalPages = ceil($totalArticles / $articlesPerPage);

        $categorieDao = new CategorieDAO();
        $categories = $categorieDao->getList();

        require_once __DIR__ . '/../vue/inc/header.php';
        require_once __DIR__ . '/../vue/acceuil.php';
        require_once __DIR__ . '/../vue/inc/footer.php';
        return ;

    }
    public function accueilAdmin(){
        $articleDao = new ArticleDAO();
        $categorieDao = new CategorieDAO();
        $articles = $articleDao->getList();
        $categories = $categorieDao->getList();
        require_once __DIR__ . '/../vue/inc/header.php';
        require_once __DIR__ . '/../vue/acceuil.php';
        require_once __DIR__ . '/../vue/inc/footer.php';
        return ;
    }

    public function article($id){
        $articleDao = new ArticleDAO();
        $categorieDao = new CategorieDAO();
        $categories = $categorieDao->getList();
        $article =$articleDao->getArticleById($id) ;
        require_once __DIR__ . '/../vue/inc/header.php';
        require_once __DIR__ . '/../vue/Articles/article.php' ;
        require_once __DIR__ . '/../vue/inc/footer.php';

        return ;

    }

    public function categorie($id){
        $articleDao = new ArticleDAO();
        $categorieDao = new CategorieDAO();
        $categories = $categorieDao->getList();
        $articles = $articleDao->getArticleByCategorie($id) ;
        require_once __DIR__ . '/../vue/inc/header.php';
        require_once __DIR__ . '/../vue/Articles/articlebycategorie.php' ;
        require_once __DIR__ . '/../vue/inc/footer.php';
        return ;

    }

    
    public function ShowErrorPage(){
            require_once __DIR__ . '/../vue/inc/header.php';
            require_once __DIR__ . '/../vue/error.php';
            require_once __DIR__ . '/../vue/inc/footer.php';
            return ;

    }

    

}