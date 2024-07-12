<?php

require_once 'modele/domaine/User.php';
require_once 'modele/dao/UserDAO.php';


class AuthController {
    public function login() {
        include 'vue/auth/login.php';

    }

    public function authenticate() {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $userDAO = new UserDAO();
        $user = $userDAO->getUserByEmail($email);
        $hash_pwd = hash('sha256',$password);
        if ( strcasecmp($hash_pwd, $user->mot_de_passe) == 0) {
            $_SESSION['user_id'] = $user->id;
            $_SESSION['role'] = $user->role;
            header('Location: index.php');
        } else {
            $error = "Invalid email or password.";
            include 'vue/auth/login.php';
        }
    }

    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header('Location: index.php');
    }


    private $dao;

  
    public function listUtilisateurs() {
        $userDAO = new UserDAO();
        $utilisateurs =  $userDAO->getList();
        require_once 'vue/inc/header.php';
        require_once 'vue/Utilisateurs/list.php';
    }

    public function addUtilisateur() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $utilisateur = new User();
            $utilisateur->nom = $_POST['nom'];
            $utilisateur->email = $_POST['email'];
            $utilisateur->role = $_POST['role'];
            $utilisateur->mot_de_passe =  hash('sha256',$_POST['mot_de_passe']);
            $generer_token = isset($_POST['generer_token']) ? true : false;
            $token = null;
        
            if ($generer_token) {
                $utilisateur->token = bin2hex(random_bytes(16)); 
            }           
             $userDAO = new UserDAO();
            $userDAO->addUser($utilisateur);
            header('Location: index.php?action=list_utilisateurs');
        } else {
            require_once __DIR__ . '/../vue/inc/header.php';
            include(__DIR__ . '/../vue/Utilisateurs/add.php');
        }
    }

    public function editUtilisateur($id) {
        $userDAO = new UserDAO();
        $utilisateur =  $userDAO->getUserById($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST' ) {
            $utilisateur->nom = $_POST['nom'];
            $utilisateur->email = $_POST['email'];
            $utilisateur->role = $_POST['role'];
            $mdp = empty($_POST['mot_de_passe']) ? true : false;
            if (!$mdp) {
                $utilisateur->mot_de_passe =  hash('sha256',$_POST['mot_de_passe']);
            }
            $generer_token = isset($_POST['generer_token']) ? true : false;
            if ($generer_token) {
                $utilisateur->token = bin2hex(random_bytes(16)); 
            }
            $userDAO = new UserDAO();
            $userDAO->updateUser($utilisateur);
            header('Location: index.php?action=list_utilisateurs');
        } else {
            require_once __DIR__ . '/../vue/inc/header.php';
            include(__DIR__ . '/../vue/Utilisateurs/edit.php');
        }
    }

    public function deleteUtilisateur($id) {
        $userDAO = new UserDAO();
        $userDAO->deleteUser($id);
        header('Location: index.php?action=list_utilisateurs');
    }
}


