<?php

class ModuleDAO
{
    public function __construct()
    {
        $connect = new ConnectDAO();
        $_SESSION['bdd'] = $connect->connect();
    }

    public function getModules()
    {
        try {
            $resultat = mysqli_query($_SESSION['bdd'], 'SELECT * FROM modules');
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

    public function getModulesByFormation($idFormation)
    {
        // a partir la liste d'id des modules, récupérer les infos des modules
        try {
            $resultat = mysqli_query($_SESSION['bdd'], "SELECT * from modules WHERE id IN (SELECT id_module from assomoduleformation where id_formation = '".$idFormation."');");
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

    public function getNameModule($idModule)
    {
        try {
            $resultat = mysqli_query($_SESSION['bdd'], "SELECT name FROM modules WHERE `id`= '".$idModule."'");
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

    public function createModule($nameModule)
    {
        try {
            mysqli_query($_SESSION['bdd'], "INSERT INTO modules (name) VALUES ('".$nameModule."')");
        } catch (Exception $e) {
            $_SESSION['error'] = 'Erreur requete BDD';
            $_SESSION['display_msg_error'] = true;
        }
    }

    public function updateModule($idModule, $nameModule)
    {
        try {
            mysqli_query($_SESSION['bdd'], "UPDATE `modules` SET `name` = '".$nameModule."' WHERE `id` = '".$idModule."'");
        } catch (Exception $e) {
            $_SESSION['error'] = 'Erreur requete BDD';
            $_SESSION['display_msg_error'] = true;
        }
    }

    public function deleteModule($idModule)
    {
        try {
            mysqli_query($_SESSION['bdd'], "DELETE FROM `modules` WHERE `id` = '".$idModule."'");
        } catch (Exception $e) {
            $_SESSION['error'] = 'Erreur requete BDD';
            $_SESSION['display_msg_error'] = true;
        }
    }

    public function verifModule($idModule)
    {
        try {
            $resultat = mysqli_query($_SESSION['bdd'], "SELECT * FROM modules WHERE `id`= '".$idModule."'");
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
