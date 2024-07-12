<?php
require_once(__DIR__ .'/../../modele/domaine/User.php');
require_once(__DIR__ .'/../../modele/dao/UserDAO.php');

class SoapService {
    private $userDao;

    public function __construct() {
        $this->userDao = new UserDAO();
    }

    // Authentification basée sur le token
    private function authenticate($token) {
        $user = $this->userDao->getUserByToken($token);
        if (!$user) {
            throw new SoapFault("Server", "Invalid authentication token");
        }
    }

    // Liste des utilisateurs
    public function listUsers($token) {
        $this->authenticate($token);
        $users = $this->userDao->getList();

        $userArray = array();
        foreach ($users as $user) {
            $userArray[] = array(
                'id' => $user->id,
                'nom' => $user->nom,
                'email' => $user->email,
                'role' => $user->role
            );
        }

        return json_encode($userArray);
    }

    // Ajouter un utilisateur
    public function addUser($token, $nom, $email, $mot_de_passe, $role) {
        $this->authenticate($token);
        $user = new User();
        $user->nom = $nom;
        $user->email = $email;
        $user->mot_de_passe = hash('sha256', $mot_de_passe);
        if ((strcmp($role, 'editeur')!= 0)&&(strcmp($role, 'administrateur')!= 0)) {
            $role = 'editeur';
        }
        $user->role = $role;
        $user->token = null;
        $this->userDao->addUser($user);

        $addedUser = $this->userDao->getUserByEmail($email); 

        return json_encode(array(
            'response'=> "successfully",
            'id' => $addedUser->id,
            'nom' => $addedUser->nom,
            'email' => $addedUser->email,
            'role' => $addedUser->role
        ));
    }

    // Supprimer un utilisateur par email
    public function deleteUser($token, $email) {
        $this->authenticate($token);
        $user = $this->userDao->getUserByEmail($email);
        if ($user) {
            $this->userDao->deleteUser($user->id);
            return json_encode(["response" => "User deleted successfully."]);
        } else {
            throw new SoapFault("Server", "User not found");
        }
    }

    // Mettre à jour un utilisateur par email
    public function updateUser($token, $email, $nom, $new_email, $mot_de_passe, $role) {
        $this->authenticate($token);
        $user = $this->userDao->getUserByEmail($email);
        if ($user) {
            $user->nom = $nom;
            $user->email = $new_email;
            if(strcmp($mot_de_passe,"null")!=0) $user->mot_de_passe = hash('sha256', $mot_de_passe);
            if ((strcmp($role, 'editeur')!= 0)&&(strcmp($role, 'administrateur')!= 0)) {
                $role = $user->$role;
            }
            $user->$role = $role ;
            $this->userDao->updateUser($user);

            $updatedUser = $this->userDao->getUserByEmail($new_email);

            return json_encode(array(
                'response'=> "successfully",
                'id' => $updatedUser->id,
                'nom' => $updatedUser->nom,
                'email' => $updatedUser->email,
                'role' => $updatedUser->role
            ));
        } else {
            throw new SoapFault("Server", "User not found");
        }
    }

    // Authentification d'un utilisateur
    public function authenticateUser($email, $password) {
        $user = $this->userDao->getUserByEmail($email);
        if ($user && hash('sha256', $password) === $user->mot_de_passe) {
            return json_encode(array(
                'id' => $user->id,
                'nom' => $user->nom,
                'email' => $user->email,
                'role' => $user->role,
                'token' => $user->token
            ));
        } else {
            throw new SoapFault("Server", "User not found");
        }
    }
    public function getUserInfo($token, $email) {
        $this->authenticate($token);
        $user = $this->userDao->getUserByEmail($email);
        if($user){
            return json_encode(array(
                'id' => $user->id,
                'nom' => $user->nom,
                'email' => $user->email,
                'role' => $user->role,
                'token' => $user->token
            ));
        } else {
            throw new SoapFault("Server", "User not found");
        }
}

}