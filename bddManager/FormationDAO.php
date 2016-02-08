<?php

class FormationDAO
{
    public function __construct()
    {
        $connect = new ConnectDAO();
        $_SESSION['bdd'] = $connect->connect();
    }

    public function getFormations()
    {
        try {
            $resultat = mysqli_query($_SESSION['bdd'], 'SELECT * FROM formations');
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

    public function getFormationsByUser($idUser)
    {
        try {
            $resultat = mysqli_query($_SESSION['bdd'], "SELECT * FROM assouserformation WHERE `id_user`= '".$idUser."'");
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

    public function getNameAndDescriptionFormation($idFormation)
    {
        try {
            $resultat = mysqli_query($_SESSION['bdd'], "SELECT name, description FROM formations WHERE `id`= '".$idFormation."'");
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

    public function createFormation($nameFormation, $descriptionFormation)
    {
        try {
            mysqli_query($_SESSION['bdd'], "INSERT INTO formations (name, description) VALUES ('".$nameFormation."', '".$descriptionFormation."')");
        } catch (Exception $e) {
            $_SESSION['error'] = 'Erreur requete BDD';
            $_SESSION['display_msg_error'] = true;
        }
    }

    public function updateFormation($idFormation, $nameFormation, $descriptionFormation)
    {
        try {
            mysqli_query($_SESSION['bdd'], "UPDATE `formations` SET `name` = '".$nameFormation."', `description` = '".$descriptionFormation."' WHERE `id` = '".$idFormation."'");
        } catch (Exception $e) {
            $_SESSION['error'] = 'Erreur requete BDD';
            $_SESSION['display_msg_error'] = true;
        }
    }

    public function deleteFormation($idFormation)
    {
        try {
            mysqli_query($_SESSION['bdd'], "DELETE FROM `formations` WHERE `id` = '".$idFormation."'");
        } catch (Exception $e) {
            $_SESSION['error'] = 'Erreur requete BDD';
            $_SESSION['display_msg_error'] = true;
        }
    }

    public function verifFormation($idFormation)
    {
        try {
            $resultat = mysqli_query($_SESSION['bdd'], "SELECT * FROM formations WHERE `id`= '".$idFormation."'");
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
