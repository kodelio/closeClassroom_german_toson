<?php


class ModuleController
{
    public function __construct()
    {
    }
    
    public function createModule($nameModule, $formations)
    {
        $getDoublon = new ModuleDAO();
        $doublon = $getDoublon->getDoublonByName($nameModule, '');

        if ($doublon) {
            $_SESSION['error'] = 'Un module avec le même nom existe déjà !';
            $_SESSION['display_msg_error'] = true;
        }
        else {
            if (!(isset($_SESSION['error']) and $_SESSION['error'] != null and isset($_SESSION['display_msg_error']) and $_SESSION['display_msg_error'])) {
                $createModule = new ModuleDAO();
                $createModule->createModule($nameModule, $formations);
                $_SESSION['success'] = 'Le module <b>' . $nameModule . '</b> a été crée.';
                $_SESSION['display_msg_success'] = true;
            } else {
                $_SESSION['error'] = 'Le module n\'a pas été crée';
                $_SESSION['display_msg_error'] = true;
            }
        }
    }
    
    public function updateModule($nameModule, $idModule)
    {
        $getDoublon = new ModuleDAO();
        $doublon = $getDoublon->getDoublonByName($nameModule, $idModule);

        if ($doublon) {
            $_SESSION['error'] = 'Un module avec le même nom existe déjà !';
            $_SESSION['display_msg_error'] = true;
        }
        else {
            if (!(isset($_SESSION['error']) and $_SESSION['error'] != null and isset($_SESSION['display_msg_error']) and $_SESSION['display_msg_error'])) {
                $updateModule = new ModuleDAO();
                $updateModule->updateModule($idModule, $nameModule);
                $_SESSION['success'] = 'Le module <b>' . $nameModule . '</b> a été mis à jour';
                $_SESSION['display_msg_success'] = true;
            } else {
                $_SESSION['error'] = 'Le module n\'a pas été mis à jour';
                $_SESSION['display_msg_error'] = true;
            }
        }
    }
    
    public function deleteModule($idModule)
    {
        $managerModule = new ModuleDAO();
        $managerModule->deleteModule($idModule);
    }
}
