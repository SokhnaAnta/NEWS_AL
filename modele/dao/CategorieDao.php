<?php

require_once 'Connexion.php';
require_once(__DIR__ . '/../domaine/Categorie.php');

class CategorieDAO {
    private $conn;

    public function __construct() {
        $this->conn = Connexion::getConnection();
    }

    public function getList() {
       $data = $this->conn->query("SELECT * FROM Categorie") ;
       return $data->fetchAll(PDO::FETCH_CLASS,'Categorie') ;
    }

    public function getById($id){
        $data = $this->conn->query("SELECT * FROM Categorie WHERE id =". $id);
        return $data->fetch(PDO::FETCH_OBJ) ;
    }

    public function addCategorie($categorie) {
        $stmt = $this->conn->prepare("INSERT INTO Categorie (libelle) VALUES (?)");
        $stmt->execute([$categorie->libelle]);
    }

    public function updateCategorie($categorie) {
        $stmt = $this->conn->prepare("UPDATE Categorie SET libelle = ? WHERE id = ?");
        $stmt->execute([$categorie->libelle, $categorie->id]);
    }

    public function deleteCategorie($id) {
        $stmt = $this->conn->prepare("DELETE FROM Categorie WHERE id = ?");
        $stmt->execute([$id]);
    }
}

