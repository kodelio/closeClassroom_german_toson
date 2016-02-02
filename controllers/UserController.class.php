<?php


class UserController
{
    public function __construct()
    {
    }

    public function createUser($loginUser, $passwordUser, $emailUser, $typeUser)
    {
        $getDoublon = new UserDAO();
        $doublonEmail = $getDoublon->getDoublonByEmail($emailUser, '');
        $doublonLogin = $getDoublon->getDoublonByLogin($loginUser, '');

        if ($doublonEmail) {
            $_SESSION['error'] = 'Un utilisateur avec le même email existe déjà !';
            $_SESSION['display_msg_error'] = true;
        } elseif ($doublonLogin) {
            $_SESSION['error'] = 'Un utilisateur avec le même login existe déjà !';
            $_SESSION['display_msg_error'] = true;
        } else {
            if (!(isset($_SESSION['error']) and $_SESSION['error'] != null and isset($_SESSION['display_msg_error']) and $_SESSION['display_msg_error'])) {
                $createUser = new UserDAO();
                $createUser->createUser($loginUser, $passwordUser, $emailUser, $typeUser);
                $_SESSION['success'] = 'L\'utilisateur <b>'.$loginUser.'</b> ('.$emailUser.') a été crée.';
                $_SESSION['display_msg_success'] = true;
            } else {
                $_SESSION['error'] = 'L\'utilisateur n\'a pas été crée';
                $_SESSION['display_msg_error'] = true;
            }
        }
    }

    public function updateUser($loginUser, $passwordUser, $emailUser, $typeUser, $idUser)
    {
        $getDoublon = new UserDAO();
        $doublonEmail = $getDoublon->getDoublonByEmail($emailUser, $idUser);
        $doublonLogin = $getDoublon->getDoublonByLogin($loginUser, $idUser);

        if ($doublonEmail) {
            $_SESSION['error'] = 'Un utilisateur avec le même email existe déjà !';
            $_SESSION['display_msg_error'] = true;
        } elseif ($doublonLogin) {
            $_SESSION['error'] = 'Un utilisateur avec le même login existe déjà !';
            $_SESSION['display_msg_error'] = true;
        } else {
            if (!(isset($_SESSION['error']) and $_SESSION['error'] != null and isset($_SESSION['display_msg_error']) and $_SESSION['display_msg_error'])) {
                $updateUser = new UserDAO();
                $updateUser->updateUser($idUser, $loginUser, $passwordUser, $emailUser, $typeUser);
                $_SESSION['success'] = 'L\'utilisateur <b>'.$loginUser.'</b> ('.$emailUser.') a été mis à jour';
                $_SESSION['display_msg_success'] = true;
            } else {
                $_SESSION['error'] = 'L\'utilisateur n\'a pas été mis à jour';
                $_SESSION['display_msg_error'] = true;
            }
        }
    }

    public function deleteUser($idUser)
    {
        $managerUser = new UserDAO();
        $managerUser->deleteUser($idUser);
    }

    public function register($loginUser, $passwordUser, $emailUser)
    {
        $getDoublon = new UserDAO();
        $doublonEmail = $getDoublon->getDoublonByEmail($emailUser, '');
        $doublonLogin = $getDoublon->getDoublonByLogin($loginUser, '');

        if ($doublonEmail) {
            $_SESSION['error'] = 'Un utilisateur avec le même email existe déjà !';
            $_SESSION['display_msg_error'] = true;
        } elseif ($doublonLogin) {
            $_SESSION['error'] = 'Un utilisateur avec le même login existe déjà !';
            $_SESSION['display_msg_error'] = true;
        } else {
            if (!(isset($_SESSION['error']) and $_SESSION['error'] != null and isset($_SESSION['display_msg_error']) and $_SESSION['display_msg_error'])) {
                $registerUser = new UserDAO();
                $registerUser->register($loginUser, $passwordUser, $emailUser);
                //TODO mail d'inscription
                $_SESSION['success'] = 'Votre compte <b>'.$loginUser.'</b> ('.$emailUser.') a été crée. Vous allez reçevoir un mail avec vos infos.';
                $_SESSION['display_msg_success'] = true;
            } else {
                $_SESSION['error'] = 'L\'inscription n\'a pas été réalisée';
                $_SESSION['display_msg_error'] = true;
            }
        }
    }
}
