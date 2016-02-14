<?php

class PracticeDAO
{
    public function __construct()
    {
        $connect = new ConnectDAO();
        $_SESSION['bdd'] = $connect->connect();
    }
    
    public function getPractices()
    {
        try {
            $resultat = mysqli_query($_SESSION['bdd'], 'SELECT * FROM practices');
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
    
    public function getPracticesByUser($idUser)
    {
        try {
            $resultat = mysqli_query($_SESSION['bdd'], "SELECT * FROM practices WHERE `user`= '" . $idUser . "'");
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
    
    public function getNameAndDescriptionPractice($idPractice)
    {
        try {
            $resultat = mysqli_query($_SESSION['bdd'], "SELECT name, description, editor FROM practices WHERE `id`= '" . $idPractice . "'");
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
    
    public function getDoublonByName($namePractice, $idPractice)
    {
        try {
            $resultat = mysqli_query($_SESSION['bdd'], "SELECT * FROM practices WHERE `name`= '" . addslashes($namePractice) . "' and `id` != '" . $idPractice . "' ");
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
    
    public function createPractice($namePractice, $_dossier, $_fichier, $descriptionPractice, $result, $idModule, $postHtml)
    {
        try {
            mysqli_query($_SESSION['bdd'], "INSERT INTO practices (name, path, file, user, description, date, id_module, editor) VALUES ('" . addslashes(utf8_decode($namePractice)) . "', 'closeClassroom_german_toson/" . $_dossier . $_fichier . "', '" . $_fichier . "', '" . $_SESSION['idUser'] . "', '" . addslashes(utf8_decode($descriptionPractice)) . "', '" . $result . "', '" . $idModule . "', '" . addslashes(utf8_decode($postHtml)) . "')");
        }
        catch (Exception $e) {
            $_SESSION['error'] = 'Erreur requete BDD';
            $_SESSION['display_msg_error'] = true;
        }
    }
    
    public function updatePracticeNewFile($idPractice, $namePractice, $_dossier, $_fichier, $descriptionPractice, $postHtml)
    {
        try {
            mysqli_query($_SESSION['bdd'], "UPDATE `practices` SET `name` = '" . addslashes(utf8_decode($namePractice)) . "', `path` = 'closeClassroom_german_toson/" . $_dossier . $_fichier . "', `file` = '" . $_fichier . "', `description` = '" . addslashes(utf8_decode($descriptionPractice)) . "', `editor` = '" . addslashes(utf8_decode($postHtml)) . "' WHERE `id` = '" . $idPractice . "'");
        }
        catch (Exception $e) {
            $_SESSION['error'] = 'Erreur requete BDD';
            $_SESSION['display_msg_error'] = true;
        }
    }
    
    public function updatePracticeOldFile($idPractice, $namePractice, $descriptionPractice, $postHtml)
    {
        try {
            mysqli_query($_SESSION['bdd'], "UPDATE `practices` SET `name` = '" . addslashes(utf8_decode($namePractice)) . "', `description` = '" . addslashes(utf8_decode($descriptionPractice)) . "', `editor` = '" . addslashes(utf8_decode($postHtml)) . "' WHERE `id` = '" . $idPractice . "'");
        }
        catch (Exception $e) {
            $_SESSION['error'] = 'Erreur requete BDD';
            $_SESSION['display_msg_error'] = true;
        }
    }
    
    public function getFile($idPractice)
    {
        try {
            $resultat = mysqli_query($_SESSION['bdd'], "SELECT file, path FROM practices WHERE `id`= '" . $idPractice . "'");
            if (mysqli_num_rows($resultat) != '0') {
                $tab[0] = mysqli_fetch_assoc($resultat);
            }
            
            return $tab[0];
        }
        catch (Exception $e) {
            $_SESSION['error'] = 'Erreur requete BDD';
            $_SESSION['display_msg_error'] = true;
        }
    }
    
    public function deletePractice($idPractice)
    {
        try {
            $infos = $this->getFile($idPractice);
            unlink($_SERVER['DOCUMENT_ROOT'] . $infos['path']);
            mysqli_query($_SESSION['bdd'], "DELETE FROM `practices` WHERE `id` = '" . $idPractice . "'");
        }
        catch (Exception $e) {
            $_SESSION['error'] = 'Erreur requete BDD';
            $_SESSION['display_msg_error'] = true;
        }
    }
    
    public function verifPractice($idPractice)
    {
        try {
            $resultat = mysqli_query($_SESSION['bdd'], "SELECT * FROM practices WHERE `id`= '" . $idPractice . "'");
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
    
    public function getPracticesByModule($idModule)
    {
        try {
            $resultat = mysqli_query($_SESSION['bdd'], "SELECT * FROM practices WHERE `id_module`= '" . $idModule . "'");
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
}
