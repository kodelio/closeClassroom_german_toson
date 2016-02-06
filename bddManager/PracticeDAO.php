<?php

class PracticeDAO
{
    public function __construct()
    {
        try {
            $_SESSION['bdd'] = mysqli_connect('localhost', 'root', '', 'german_toson_webserv');
        } catch (Exception $e) {
            $_SESSION['error'] = 'Erreur BDD';
            $_SESSION['display_msg_error'] = true;
        }
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
        } catch (Exception $e) {
            $_SESSION['error'] = 'Erreur requete BDD';
            $_SESSION['display_msg_error'] = true;
        }
    }

    public function getPracticesByUser($idUser)
    {
        try {
            $resultat = mysqli_query($_SESSION['bdd'], "SELECT * FROM practices WHERE `user`= '".$idUser."'");
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
        } catch (Exception $e) {
            $_SESSION['error'] = 'Erreur requete BDD';
            $_SESSION['display_msg_error'] = true;
        }
    }

    public function getNameAndDescriptionPractice($idPractice)
    {
        try {
            $resultat = mysqli_query($_SESSION['bdd'], "SELECT name, description FROM practices WHERE `id`= '".$idPractice."'");
            if (mysqli_num_rows($resultat) != '0') {
                $tab[0] = mysqli_fetch_assoc($resultat);

                return $tab[0];
            } else {
                return;
            }
        } catch (Exception $e) {
            $_SESSION['error'] = 'Erreur requete BDD';
            $_SESSION['display_msg_error'] = true;
        }
    }

    public function getDoublonByName($namePractice, $idPractice)
    {
        try {
            $resultat = mysqli_query($_SESSION['bdd'], "SELECT * FROM practices WHERE `name`= '".$namePractice."' and `id` != '".$idPractice."' ");
            if (mysqli_num_rows($resultat) != '0') {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            $_SESSION['error'] = 'Erreur requete BDD';
            $_SESSION['display_msg_error'] = true;
        }
    }

    public function createPractice($namePractice, $_dossier, $_fichier, $descriptionPractice, $result)
    {
        try {
            mysqli_query($_SESSION['bdd'], "INSERT INTO practices (name, path, file, user, description, date) VALUES ('".$namePractice."', 'webserv/".$_dossier.$_fichier."', '".$_fichier."', '".$_SESSION['idUser']."', '".$descriptionPractice."', '".$result."')");
        } catch (Exception $e) {
            $_SESSION['error'] = 'Erreur requete BDD';
            $_SESSION['display_msg_error'] = true;
        }
    }

    public function updatePracticeNewFile($idPractice, $namePractice, $_dossier, $_fichier, $descriptionPractice)
    {
        try {
            mysqli_query($_SESSION['bdd'], "UPDATE `practices` SET `name` = '".$namePractice."', `path` = 'webserv/".$_dossier.$_fichier."', `file` = '".$_fichier."', `description` = '".$descriptionPractice."' WHERE `id` = '".$idPractice."'");
        } catch (Exception $e) {
            $_SESSION['error'] = 'Erreur requete BDD';
            $_SESSION['display_msg_error'] = true;
        }
    }

    public function updatePracticeOldFile($idPractice, $namePractice, $descriptionPractice)
    {
        try {
            mysqli_query($_SESSION['bdd'], "UPDATE `practices` SET `name` = '".$namePractice."', `description` = '".$descriptionPractice."' WHERE `id` = '".$idPractice."'");
        } catch (Exception $e) {
            $_SESSION['error'] = 'Erreur requete BDD';
            $_SESSION['display_msg_error'] = true;
        }
    }

    public function getFile($idPractice)
    {
        try {
            $resultat = mysqli_query($_SESSION['bdd'], "SELECT file, path FROM practices WHERE `id`= '".$idPractice."'");
            if (mysqli_num_rows($resultat) != '0') {
                $tab[0] = mysqli_fetch_assoc($resultat);
            }

            return $tab[0];
        } catch (Exception $e) {
            $_SESSION['error'] = 'Erreur requete BDD';
            $_SESSION['display_msg_error'] = true;
        }
    }

    public function deletePractice($idPractice)
    {
        try {
            $infos = $this->getFile($idPractice);
            unlink($_SERVER['DOCUMENT_ROOT'].$infos['path']);
            mysqli_query($_SESSION['bdd'], "DELETE FROM `practices` WHERE `id` = '".$idPractice."'");
        } catch (Exception $e) {
            $_SESSION['error'] = 'Erreur requete BDD';
            $_SESSION['display_msg_error'] = true;
        }
    }

    public function verifPractice($idPractice)
    {
        try {
            $resultat = mysqli_query($_SESSION['bdd'], "SELECT * FROM practices WHERE `id`= '".$idPractice."'");
            if (mysqli_num_rows($resultat) != '0') {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            $_SESSION['error'] = 'Erreur requete BDD';
            $_SESSION['display_msg_error'] = true;
        }
    }
}
