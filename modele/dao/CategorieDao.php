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
}

