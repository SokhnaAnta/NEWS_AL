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

    public function addArticle($article) {
        $stmt = $this->conn->prepare("INSERT INTO Article (titre, contenu, categorie, utilisateur_id) VALUES (?, ?, ?, ?)");
        $stmt->execute([$article->titre, $article->contenu, $article->categorie, $article->utilisateur_id]);
    }

    public function updateArticle($article) {
        $stmt = $this->conn->prepare("UPDATE Article SET titre = ?, contenu = ?, categorie = ?, utilisateur_id = ? WHERE id = ?");
        $stmt->execute([$article->titre, $article->contenu, $article->categorie, $article->utilisateur_id, $article->id]);
    }

    public function deleteArticle($id) {
        $stmt = $this->conn->prepare("DELETE FROM Article WHERE id = ?");
        $stmt->execute([$id]);
    }

    public function getArticlesGroupedByCategory() {
        $stmt = $this->conn->prepare("SELECT categorie, JSON_ARRAYAGG(JSON_OBJECT('id', id, 'titre', titre, 'contenu', contenu)) as articles FROM Article GROUP BY categorie");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getListbyDC($offset, $limit) {
        $sql = 'SELECT * FROM Article ORDER BY dateCreation DESC LIMIT :offset, :limit';
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Article');
    }

    // Méthode pour récupérer le nombre total d'articles
    public function getTotalCount() {
        $sql = 'SELECT COUNT(*) FROM Article';
        return $this->conn->query($sql)->fetchColumn();
    }
}
