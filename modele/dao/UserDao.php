<?php
require_once 'Connexion.php';
require_once(__DIR__ . '/../domaine/User.php');


class UserDAO {

    private $conn;

    public function __construct() {
        $this->conn = Connexion::getConnection();
    }
    public function getList() {
        $data = $this->conn->query("SELECT * FROM utilisateurs") ;
        return $data->fetchAll(PDO::FETCH_CLASS,'User') ;
    }

    public function getUserByEmail($email) {
        $stmt = $this->conn->prepare("SELECT * FROM utilisateurs WHERE email = ?");
        $stmt->execute([$email]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
        return $stmt->fetch();
    }

    public function getUserById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM utilisateurs WHERE id = ?");
        $stmt->execute([$id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
        return $stmt->fetch();
    }

    public function getUserByToken($token) {
        $stmt = $this->conn->prepare("SELECT * FROM utilisateurs WHERE token = ?");
        $stmt->execute([$token]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
        return $stmt->fetch();
    }
    

    public function addUser($user) {
        $stmt = $this->conn->prepare("INSERT INTO utilisateurs (nom, email, mot_de_passe, role,token) VALUES (?, ?, ?, ?,?)");
        $stmt->execute([$user->nom, $user->email, $user->mot_de_passe, $user->role,$user->token]);
    }

    public function updateUser($user) {
        $stmt = $this->conn->prepare("UPDATE utilisateurs SET nom = ?, email = ?, mot_de_passe = ?, role = ?,token = ? WHERE id = ?");

        $stmt->execute([$user->nom, $user->email, $user->mot_de_passe, $user->role,$user->token, $user->id]);
    }

    public function deleteUser($id) {
        $stmt = $this->conn->prepare("DELETE FROM utilisateurs WHERE id = ?");
        $stmt->execute([$id]);
    }
}

