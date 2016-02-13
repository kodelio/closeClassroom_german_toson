<?php

class UserDAO
{
    public function __construct()
    {
        $connect = new ConnectDAO();
        $_SESSION['bdd'] = $connect->connect();
    }
    
    public function getUserByLoginAndPassword($login, $password, $addCookie)
    {
        try {
            $resultat = mysqli_query($_SESSION['bdd'], "SELECT * FROM users WHERE `login`= '" . $login . "'");
            $log = mysqli_fetch_assoc($resultat);
        }
        catch (Exception $e) {
            $_SESSION['error'] = 'Erreur requete BDD';
            $_SESSION['display_msg_error'] = true;
        }
        
        if (mysqli_num_rows($resultat) == '0') {
            $_SESSION['error'] = 'Login inconnu';
            $_SESSION['display_msg_error'] = true;
        } else {
            if ($password == $log['password']) {
                $_SESSION['isLogged'] = true;
                $_SESSION['username'] = $login;
                $_SESSION['idUser'] = $log['id'];
                $_SESSION['type'] = $log['type'];
                $_SESSION['email'] = $log['email'];
                if ($addCookie) {
                    $cookie_value = $login . ' ' . $password;
                    setcookie('nougatine', $cookie_value, time() + (86400 * 30), '/webserv/'); // 86400 = 1 jour
                }
                new User($login, $password);
                header('Location: /webserv/');
            } else {
                $_SESSION['error'] = 'Mauvais mot de passe';
                $_SESSION['display_msg_error'] = true;
            }
        }
    }
    
    public function getUsers()
    {
        try {
            $resultat = mysqli_query($_SESSION['bdd'], 'SELECT * FROM users');
            if (mysqli_num_rows($resultat) != '0') {
                $tab[0] = mysqli_fetch_assoc($resultat);
                if (mysqli_num_rows($resultat) > '0') {
                    for ($i = 1; $i < mysqli_num_rows($resultat); $i++) {
                        array_push($tab, mysqli_fetch_assoc($resultat));
                    }
                }
                
                return $tab;
            } else {
                return false;
            }
        }
        catch (Exception $e) {
            $_SESSION['error'] = 'Erreur requete BDD';
            $_SESSION['display_msg_error'] = true;
        }
    }
    
    public function getEtudiants()
    {
        try {
            $resultat = mysqli_query($_SESSION['bdd'], "SELECT * FROM users WHERE `type`= 'Etudiant'");
            if (mysqli_num_rows($resultat) != '0') {
                $tab[0] = mysqli_fetch_assoc($resultat);
                if (mysqli_num_rows($resultat) > '0') {
                    for ($i = 1; $i < mysqli_num_rows($resultat); $i++) {
                        array_push($tab, mysqli_fetch_assoc($resultat));
                    }
                }
                
                return $tab;
            } else {
                return false;
            }
        }
        catch (Exception $e) {
            $_SESSION['error'] = 'Erreur requete BDD';
            $_SESSION['display_msg_error'] = true;
        }
    }
    
    public function getInfoUser($idUser)
    {
        try {
            $resultat = mysqli_query($_SESSION['bdd'], "SELECT id, login, email, password, type, name, first_name FROM users WHERE `id`= '" . $idUser . "'");
            if (mysqli_num_rows($resultat) != '0') {
                $tab[0] = mysqli_fetch_assoc($resultat);
                
                return $tab[0];
            } else {
                return;
            }
        }
        catch (Exception $e) {
            $_SESSION['error'] = 'Erreur requete BDD';
            $_SESSION['display_msg_error'] = true;
        }
    }
    
    public function getDoublonByEmail($emailUser, $idUser)
    {
        try {
            $resultat = mysqli_query($_SESSION['bdd'], "SELECT * FROM users WHERE `email`= '" . $emailUser . "' and `id` != '" . $idUser . "' ");
            if (mysqli_num_rows($resultat) != '0') {
                return true;
            } else {
                return false;
            }
        }
        catch (Exception $e) {
            $_SESSION['error'] = 'Erreur requete BDD';
            $_SESSION['display_msg_error'] = true;
        }
    }
    
    public function getDoublonByLogin($loginUser, $idUser)
    {
        try {
            $resultat = mysqli_query($_SESSION['bdd'], "SELECT * FROM users WHERE `login`= '" . $loginUser . "' and `id` != '" . $idUser . "' ");
            if (mysqli_num_rows($resultat) != '0') {
                return true;
            } else {
                return false;
            }
        }
        catch (Exception $e) {
            $_SESSION['error'] = 'Erreur requete BDD';
            $_SESSION['display_msg_error'] = true;
        }
    }
    
    public function createProfesseur($loginUser, $passwordUser, $emailUser, $typeUser, $nameUser, $firstNameUser)
    {
        try {
            mysqli_query($_SESSION['bdd'], "INSERT INTO users (type, login, password, email, name, first_name) VALUES ('" . $typeUser . "', '" . $loginUser . "', '" . $passwordUser . "', '" . $emailUser . "', '" . $nameUser . "', '" . $firstNameUser . "')");
        }
        catch (Exception $e) {
            $_SESSION['error'] = 'Erreur requete BDD';
            $_SESSION['display_msg_error'] = true;
        }
    }
    
    public function updateUser($idUser, $loginUser, $passwordUser, $emailUser, $typeUser, $nameUser, $firstNameUser)
    {
        try {
            mysqli_query($_SESSION['bdd'], "UPDATE `users` SET `type` = '" . $typeUser . "', `login` = '" . $loginUser . "', `password` = '" . $passwordUser . "', `email` = '" . $emailUser . "', `name` = '" . $nameUser . "', `first_name` = '" . $firstNameUser . "' WHERE `id` = '" . $idUser . "'");
        }
        catch (Exception $e) {
            $_SESSION['error'] = 'Erreur requete BDD';
            $_SESSION['display_msg_error'] = true;
        }
    }
    
    public function deleteUser($idUser)
    {
        try {
            mysqli_query($_SESSION['bdd'], "DELETE FROM `users` WHERE `id` = '" . $idUser . "'");
        }
        catch (Exception $e) {
            $_SESSION['error'] = 'Erreur requete BDD';
            $_SESSION['display_msg_error'] = true;
        }
    }
    
    public function verifUser($idUser)
    {
        try {
            $resultat = mysqli_query($_SESSION['bdd'], "SELECT * FROM users WHERE `id`= '" . $idUser . "'");
            if (mysqli_num_rows($resultat) != '0') {
                return true;
            } else {
                return false;
            }
        }
        catch (Exception $e) {
            $_SESSION['error'] = 'Erreur requete BDD';
            $_SESSION['display_msg_error'] = true;
        }
    }
    
    public function register($loginUser, $passwordUser, $emailUser, $nameUser, $firstNameUser, $idFormation)
    {
        try {
            mysqli_query($_SESSION['bdd'], "INSERT INTO users (type, login, password, email, name, first_name) VALUES ('Etudiant', '" . $loginUser . "', '" . $passwordUser . "', '" . $emailUser . "', '" . $nameUser . "', '" . $firstNameUser . "')");
            $resultat = mysqli_query($_SESSION['bdd'], "SELECT id FROM users WHERE `login` = '" . $loginUser . "'");
            $log = mysqli_fetch_assoc($resultat);
            mysqli_query($_SESSION['bdd'], "INSERT INTO assouserformation (id_user, id_formation) VALUES ('" . $log['id'] . "', '" . $idFormation . "')");
        }
        catch (Exception $e) {
            $_SESSION['error'] = 'Erreur requete BDD';
            $_SESSION['display_msg_error'] = true;
        }
    }
}
