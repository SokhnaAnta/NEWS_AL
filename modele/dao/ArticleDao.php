<?php

require_once 'Connexion.php';
require_once(__DIR__ . '/../domaine/Article.php');

class ArticleDAO {
    private $conn;

    public function __construct() {
        $this->conn = Connexion::getConnection();
    }

    public function getList() {
        $stmt = $this->conn->prepare("SELECT * FROM Article");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Article');
    }

    public function getArticleById($id){
        $stmt = $this->conn->prepare("SELECT * FROM Article WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function getArticleByCategorie($categorieId) {
        $stmt = $this->conn->prepare("SELECT * FROM Article WHERE categorie = :categorieId");
        $stmt->execute(['categorieId' => $categorieId]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Article');
    }
}
