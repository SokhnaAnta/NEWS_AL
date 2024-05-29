<?php
require_once(__DIR__ . '/../modele/domaine/Article.php');
require_once(__DIR__ . '/../modele/domaine/Categorie.php');
require_once(__DIR__ . '/../modele/dao/ArticleDao.php');
require_once(__DIR__ . '/../modele/dao/CategorieDao.php');



class Controller{
    function __construct(){
        

    }

    public function accueil(){
        $articleDao = new ArticleDAO();
        $categorieDao = new CategorieDAO();
        $articles = $articleDao->getList();
        $categories = $categorieDao->getList();
        require_once __DIR__ . '/../vue/acceuil.php';
        return ;
    }

    public function article($id){
        $articleDao = new ArticleDAO();
        $categorieDao = new CategorieDAO();
        $categories = $categorieDao->getList();
        $article =$articleDao->getArticleById($id) ;
        require_once __DIR__ . '/../vue/article.php' ;
        return ;

    }

    public function categorie($id){
        $articleDao = new ArticleDAO();
        $categorieDao = new CategorieDAO();
        $categories = $categorieDao->getList();
        $articles = $articleDao->getArticleByCategorie($id) ;
        require_once __DIR__ . '/../vue/articlebycategorie.php' ;
        return ;


    }

    
    public function ShowErrorPage(){
            require_once __DIR__ . '/../vue/error.php';
            return ;

    }

    

}