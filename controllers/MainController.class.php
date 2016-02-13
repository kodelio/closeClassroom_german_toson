<?php

// views
include 'views/NavBarView.class.php';
include 'views/LoginView.class.php';
include 'views/ProfileView.class.php';
include 'views/FormPracticeView.class.php';
include 'views/PracticeView.class.php';
include 'views/UserView.class.php';
include 'views/FormUserView.class.php';
include 'views/FormRegisterView.class.php';
include 'views/FormModuleView.class.php';
include 'views/ModuleView.class.php';
include 'views/FormFormationView.class.php';
include 'views/FormationView.class.php';

// models
include 'models/User.class.php';
include 'models/Practice.class.php';
include 'models/Module.class.php';
include 'models/Formation.class.php';

//controllers
include 'controllers/PracticeController.class.php';
include 'controllers/UserController.class.php';
include 'controllers/ModuleController.class.php';
include 'controllers/FormationController.class.php';

//managers
include 'bddManager/ConnectDAO.php';
include 'bddManager/UserDAO.php';
include 'bddManager/PracticeDAO.php';
include 'bddManager/ModuleDAO.php';
include 'bddManager/FormationDAO.php';

class MainController
{
	public function __construct()
	{
        //charge la session si cookie présent
		if (!$this->isLogged() && isset($_COOKIE['nougatine'])) {
			$username_cookie = substr($_COOKIE['nougatine'], 0, strrpos($_COOKIE['nougatine'], ' '));
			$username_cookie = substr($_COOKIE['nougatine'], strrpos($_COOKIE['nougatine'], ' ') + 1);
			$login = new UserDAO();
			$login->getUserByLoginAndPassword($username_cookie, $username_cookie, true);
		}
		
        //insertion de la navbar
		$this->navBar();
		
        //choix de la page
		if ($this->isLogged()) {
			if (isset($_GET['page'])) {
				switch ($_GET['page']) {
					case 'login':
					$this->login();
					break;
					
					case 'logout':
					$this->logout();
					break;
					
					case 'createPractice':
					$this->createPractice();
					break;
					
					case 'updatePractice':
					$this->updatePractice();
					break;
					
					case 'deletePractice':
					$this->deletePractice();
					break;
					
					case 'createModule':
					$this->createModule();
					break;
					
					case 'updateModule':
					$this->updateModule();
					break;
					
					case 'showModule':
					$this->showModule();
					break;
					
					case 'deleteModule':
					$this->deleteModule();
					break;
					
					case 'formation':
					$this->formation();
					break;
					
					case 'createFormation':
					$this->createFormation();
					break;
					
					case 'updateFormation':
					$this->updateFormation();
					break;
					
					case 'showFormation':
					$this->showFormation();
					break;
					
					case 'deleteFormation':
					$this->deleteFormation();
					break;
					
					case 'user':
					$this->user();
					break;
					
					case 'createUser':
					$this->createProfesseur();
					break;
					
					case 'updateUser':
					$this->updateUser();
					break;
					
					case 'deleteUser':
					$this->deleteUser();
					break;
					
					case 'register':
					$_SESSION['error'] = 'Vous ne pouvez pas vous inscrire en étant connecté';
					$_SESSION['display_msg_error'] = true;
					$this->profile();
					break;
					
					default:
					$_SESSION['error'] = '[1] La page n\'existe pas';
					$_SESSION['display_msg_error'] = true;
					$this->profile();
					break;
				}
			} else {
				$this->profile();
			}
		} elseif ((isset($_GET['page'])) && ($_GET['page'] == 'register')) {
			$this->register();
		} else {
			$this->login();
		}
		
        //popup d'erreur
		if (isset($_SESSION['error']) and $_SESSION['error'] != null and isset($_SESSION['display_msg_error']) and $_SESSION['display_msg_error']) {
			include 'include/ErrorModal.php';
			$_SESSION['display_msg_error'] = false;
		}
        //popup de succès
		if (isset($_SESSION['success']) and $_SESSION['success'] != null and isset($_SESSION['display_msg_success']) and $_SESSION['display_msg_success']) {
			include 'include/SuccessModal.php';
			$_SESSION['display_msg_success'] = false;
		}
	}
	
    //insertion de la navbar
	public function navBar()
	{
		$navBarView = new navBarView();
		
		if ($this->isLogged()) {
			$infosUser = new UserDAO();
			$infos = $infosUser->getInfoUser($_SESSION['idUser']);
			echo $navBarView->getViewLogged($infos['first_name'], $infos['type']);
		} else {
			echo $navBarView->getViewLogout();
		}
	}
	
    //teste si l'utilisateur est connecté
	public function isLogged()
	{
		if (isset($_SESSION['isLogged']) and $_SESSION['isLogged'] == true) {
			return true;
		} else {
			return false;
		}
	}
	
    //charge la page de login
	public function login()
	{
		$managerUser = new UserDAO();
		if (isset($_GET['username']) && isset($_GET['password'])) {
			$managerUser->getUserByLoginAndPassword($_GET['username'], $_GET['password'], $_GET['chocolat']);
		} else {
			$_SESSION['isLogged'] = false;
		}
		
		if (!$this->isLogged()) {
			$_SESSION['isLogged'] = false;
			$loginView = new loginView();
			echo $loginView->getView();
		} else {
			$profileView = new ProfileView();
			echo $profileView->getView();
		}
	}
	
    //charge la page de déconnexion
	public function logout()
	{
		if (isset($_COOKIE['nougatine'])) {
			unset($_COOKIE['nougatine']);
			setcookie('nougatine', '', time() - 3600, '/closeClassroom_german_toson/');
		}
		session_unset();
		session_destroy();
		header('Location: /closeClassroom_german_toson/');
	}
	
    //charge la page createPractice
	public function createPractice()
	{
		$infosUser = new UserDAO();
		$infos = $infosUser->getInfoUser($_SESSION['idUser']);
		if ($infos['type'] != 'Etudiant') {
			if (isset($_POST['namePractice']) && isset($_POST['idModule']) && $_POST['idModule'] != null && isset($_FILES['fichierUp']['name']) and $_FILES['fichierUp']['name'] != null) {
				$uploader = PracticeController::Instance();
				$uploader->uploadFile($_POST['namePractice'], $_POST['descriptionPractice'], $_POST['idModule']);
			} else if (isset($_POST['idModule']) && $_POST['idModule'] == null) {
				$_SESSION['error'] = 'Erreur avec le module';
				$_SESSION['display_msg_error'] = true;
			}
			$managerFormation = new FormationDAO();
			$managerModule = new ModuleDAO();
			if ($infos['type'] == 'Professeur'){
				$formations = $managerFormation->getFormationsByUser($infos['id']);
				$mesModulesOld = array();
				foreach ($formations as $formation) {
					array_push($mesModulesOld, $managerModule->getModulesByFormation($formation['id_formation']));
				}	
				$mesModules = array();
				foreach ($mesModulesOld as $formation) {
					foreach ($formation as $module) {
						if (!array_key_exists($module['id'], $mesModules)){
							array_push($mesModules, $module);
						}
					}
				}
			}
			else {
				$mesModules = $managerModule->getModules();
			}
			$formPracticeView = new FormPracticeView();
			echo $formPracticeView->getViewInsert($mesModules);
		} else {
			$_SESSION['error'] = 'Vous n\'avez pas les droits requis pour accéder à cette page';
			$_SESSION['display_msg_error'] = true;
			$this->profile();
		}
	}
	
    //charge la page mise à jour cours
	public function updatePractice()
	{
		if (isset($_GET['idPractice'])) {
			$infosUser = new UserDAO();
			$managerPractice = new PracticeDAO();
			$infos = $infosUser->getInfoUser($_SESSION['idUser']);
			$haveRight = false;
			if ($infos['type'] == 'Professeur'){
				$practices = $managerPractice->getPracticesByUser($infos['id']);
				if ($practices){
					foreach ($practices as $practice) {
						if ($practice['user'] == $infos['id']){
							$haveRight = true;
						}
					}
				}
			}
			if ($infos['type'] == 'Admin' || $haveRight) {
				$isPracticeExist = $managerPractice->verifPractice($_GET['idPractice']);
				if (!$isPracticeExist) {
					$_SESSION['error'] = 'Le cours n\'existe pas';
					$_SESSION['display_msg_error'] = true;
					$this->profile();
				} else {
					if (isset($_POST['namePractice'])) {
						$newFile = false;
						if (isset($_FILES['fichierUp']['name']) and $_FILES['fichierUp']['name'] != null) {
							$infos = $managerPractice->getFile($_GET['idPractice']);
							unlink($_SERVER['DOCUMENT_ROOT'] . $infos['path']);
							
							$newFile = true;
							$uploader = PracticeController::Instance();
							$uploader->updateFile($_POST['namePractice'], $_POST['descriptionPractice'], $_GET['idPractice'], $newFile);
						} else {
							$uploader = PracticeController::Instance();
							$uploader->updateFile($_POST['namePractice'], $_POST['descriptionPractice'], $_GET['idPractice'], $newFile);
						}
					}
					$infos = $managerPractice->getNameAndDescriptionPractice($_GET['idPractice']);
					$file = $managerPractice->getFile($_GET['idPractice']);
					$formPracticeView = new FormPracticeView();
					echo $formPracticeView->getViewUpdate($_GET['idPractice'], $infos['name'], $infos['description'], $file['file'], $file['path']);
				}
			} else {
				$_SESSION['error'] = 'Vous n\'avez pas les droits requis pour accéder à cette page';
				$_SESSION['display_msg_error'] = true;
				$this->profile();
			}
		} else {
			$_SESSION['error'] = '[2] La page n\'existe pas';
			$_SESSION['display_msg_error'] = true;
			$this->profile();
		}
	}
	
    //charge la page delete practice
	public function deletePractice()
	{
		if (isset($_GET['idPractice'])) {
			$infosUser = new UserDAO();
			$managerPractice = new PracticeDAO();
			$infos = $infosUser->getInfoUser($_SESSION['idUser']);
			$haveRight = false;
			if ($infos['type'] == 'Professeur'){
				$practices = $managerPractice->getPracticesByUser($infos['id']);
				if ($practices){
					foreach ($practices as $practice) {
						if ($practice['user'] == $infos['id']){
							$haveRight = true;
						}
					}
				}
			}
			if ($infos['type'] == 'Admin' || $haveRight) {
				$uploader = PracticeController::Instance();
				$uploader->deleteFile($_GET['idPractice']);
				$_SESSION['success'] = 'Le cours a bien été supprimé';
				$_SESSION['display_msg_success'] = true;
				$this->profile();
			} else {
				$_SESSION['error'] = 'Vous n\'avez pas les droits requis pour accéder à cette page';
				$_SESSION['display_msg_error'] = true;
				$this->profile();
			}
		} else {
			$_SESSION['error'] = '[3] La page n\'existe pas';
			$_SESSION['display_msg_error'] = true;
			$this->profile();
		}
	}
	
	
	
    //charge la page user
	public function user()
	{
		$infosUser = new UserDAO();
		$infos = $infosUser->getInfoUser($_SESSION['idUser']);
		if ($infos['type'] == 'Admin') {
			$userView = new UserView();
			echo $userView->getView($infos['type']);
		} elseif ($infos['type'] == 'Professeur') {
			$userView = new UserView();
			echo $userView->getView($infos['type']);
		} else {
			$_SESSION['error'] = 'Vous n\'avez pas les droits requis pour accéder à cette page';
			$_SESSION['display_msg_error'] = true;
			$this->profile();
		}
	}
	
    //charge la page createProfesseur
	public function createProfesseur()
	{
		$infosUser = new UserDAO();
		$infos = $infosUser->getInfoUser($_SESSION['idUser']);
		if ($infos['type'] == 'Admin') {
			if (isset($_POST['loginUser']) && isset($_POST['passwordUser']) && isset($_POST['emailUser']) && isset($_POST['formations']) && $_POST['formations'] != null) {
				$userController = new UserController();
				$professeur = "Professeur";
				$createProfesseur = $userController->createProfesseur($_POST['loginUser'], $_POST['passwordUser'], $_POST['emailUser'], $professeur, $_POST['nameUser'], $_POST['firstNameUser'], $_POST['formations']);
			}
			else if (isset($_POST['loginUser']) && isset($_POST['passwordUser']) && isset($_POST['emailUser']) && empty($_POST['formations'])) {
				$_SESSION['error'] = 'Vous devez choisir une formation';
				$_SESSION['display_msg_error'] = true;
			}
			$managerFormation = new FormationDAO();
			$mesFormations = $managerFormation->getFormations();
			$userView = new FormUserView();
			echo $userView->getViewInsert($mesFormations);
		} else {
			$_SESSION['error'] = 'Vous n\'avez pas les droits requis pour accéder à cette page';
			$_SESSION['display_msg_error'] = true;
			$this->profile();
		}
	}
	
    //charge la page mise à jour user
	public function updateUser()
	{
		if (isset($_GET['idUser'])) {
			$infosUser = new UserDAO();
			$infos = $infosUser->getInfoUser($_SESSION['idUser']);
			if ($infos['type'] == 'Admin') {
				$verifUser = new UserDAO();
				$isUserExist = $verifUser->verifUser($_GET['idUser']);
				if (!$isUserExist) {
					$_SESSION['error'] = 'L\'utilisateur n\'existe pas';
					$_SESSION['display_msg_error'] = true;
					$this->user();
				} else {
					if (isset($_POST['loginUser']) && isset($_POST['passwordUser']) && isset($_POST['emailUser']) && isset($_POST['typeUser'])) {
						if ($_POST['typeUser'] == '') {
							$_SESSION['error'] = 'Vous devez renseigner le type d\'utilisateur';
							$_SESSION['display_msg_error'] = true;
						} else {
							$userController = new UserController();
							$updateUser = $userController->updateUser($_POST['loginUser'], $_POST['passwordUser'], $_POST['emailUser'], $_POST['typeUser'], $_GET['idUser'], $_POST['nameUser'], $_POST['firstNameUser']);
						}
					}
					$managerUser = new UserDAO();
					$infos = $managerUser->getInfoUser($_GET['idUser']);
					$userView = new FormUserView();
					echo $userView->getViewUpdate($_GET['idUser'], $infos['login'], $infos['password'], $infos['email'], $infos['type'], $infos['name'], $infos['first_name']);
				}
			} else {
				$_SESSION['error'] = 'Vous n\'avez pas les droits requis pour accéder à cette page';
				$_SESSION['display_msg_error'] = true;
				$this->profile();
			}
		} else {
			$_SESSION['error'] = '[4] La page n\'existe pas';
			$_SESSION['display_msg_error'] = true;
			$this->profile();
		}
	}
	
    //charge la page delete user
	public function deleteUser()
	{
		if (isset($_GET['idUser'])) {
			$infosUser = new UserDAO();
			$infos = $infosUser->getInfoUser($_SESSION['idUser']);
			if ($infos['type'] == 'Admin') {
				$userController = new UserController();
				$deleteUser = $userController->deleteUser($_GET['idUser']);
				$_SESSION['success'] = 'L\'utilisateur a bien été supprimé';
				$_SESSION['display_msg_success'] = true;
				$this->user();
			} else {
				$_SESSION['error'] = 'Vous n\'avez pas les droits requis pour accéder à cette page';
				$_SESSION['display_msg_error'] = true;
				$this->profile();
			}
		} else {
			$_SESSION['error'] = '[5] La page n\'existe pas';
			$_SESSION['display_msg_error'] = true;
			$this->profile();
		}
	}
	
    //charge la page profile
	public function profile()
	{
		$infosUser = new UserDAO();
		$infos = $infosUser->getInfoUser($_SESSION['idUser']);
		$profileView = new ProfileView();
		echo $profileView->getView($infos['id'], $infos['login'], $infos['email'], $infos['type']);
	}
	
    //charge la page d'inscription
	public function register()
	{
		if (isset($_POST['loginUser']) && isset($_POST['passwordUser']) && isset($_POST['emailUser']) && isset($_POST['idFormation']) && $_POST['idFormation'] != null) {
			if ($_POST['passwordUser'] != $_POST['passwordUserCheck']) {
				$_SESSION['error'] = 'Les mots de passe ne sont pas identiques';
				$_SESSION['display_msg_error'] = true;
			} 
			else if (isset($_POST['idFormation']) && $_POST['idFormation'] == null) {
				$_SESSION['error'] = 'Erreur avec la formation';
				$_SESSION['display_msg_error'] = true;
			}
			else {
				$userController = new UserController();
				$createUser = $userController->register($_POST['loginUser'], $_POST['passwordUser'], $_POST['emailUser'], $_POST['nameUser'], $_POST['firstNameUser'], $_POST['idFormation']);
			}
		}
		$managerFormation = new FormationDAO();
		$mesFormations = $managerFormation->getFormations();
		$registerView = new FormRegisterView();
		echo $registerView->getView($mesFormations);
	}
	
	
    //charge la page createModule
	public function createModule()
	{
		$infosUser = new UserDAO();
		$infos = $infosUser->getInfoUser($_SESSION['idUser']);
		if ($infos['type'] == 'Admin') {
			if (isset($_POST['nameModule']) && isset($_POST['formations']) && $_POST['formations'] != null) {
				$moduleController = new ModuleController();
				$moduleController->createModule($_POST['nameModule'], $_POST['formations']);
			}
			else if (isset($_POST['nameModule']) && empty($_POST['formations'])) {
				$_SESSION['error'] = 'Vous devez choisir une formation';
				$_SESSION['display_msg_error'] = true;
			}
			$managerFormation = new FormationDAO();
			$mesFormations = $managerFormation->getFormations();
			$formModuleView = new FormModuleView();
			echo $formModuleView->getViewInsert($mesFormations);
		} else {
			$_SESSION['error'] = 'Vous n\'avez pas les droits requis pour accéder à cette page';
			$_SESSION['display_msg_error'] = true;
			$this->profile();
		}
	}
	
    //charge la page mise à jour module
	public function updateModule()
	{
		if (isset($_GET['idModule'])) {
			$infosUser = new UserDAO();
			$infos = $infosUser->getInfoUser($_SESSION['idUser']);
			if ($infos['type'] == 'Admin') {
				$verifModule = new ModuleDAO();
				$isModuleExist = $verifModule->verifModule($_GET['idModule']);
				if (!$isModuleExist) {
					$_SESSION['error'] = 'Le module n\'existe pas';
					$_SESSION['display_msg_error'] = true;
					$this->profile();
				} else {
					if (isset($_POST['nameModule'])) {
						$moduleController = new ModuleController();
						$moduleController->updateModule($_POST['nameModule'], $_GET['idModule']);
					}
					
					$managerModule = new ModuleDAO();
					$infos = $managerModule->getNameModule($_GET['idModule']);
					$formModuleView = new FormModuleView();
					echo $formModuleView->getViewUpdate($_GET['idModule'], $infos['name']);
				}
			} else {
				$_SESSION['error'] = 'Vous n\'avez pas les droits requis pour accéder à cette page';
				$_SESSION['display_msg_error'] = true;
				$this->profile();
			}
		} else {
			$_SESSION['error'] = '[6] La page n\'existe pas';
			$_SESSION['display_msg_error'] = true;
			$this->profile();
		}
	}
	
    //charge la page delete module
	public function deleteModule()
	{
		if (isset($_GET['idModule'])) {
			$infosUser = new UserDAO();
			$infos = $infosUser->getInfoUser($_SESSION['idUser']);
			if ($infos['type'] == 'Admin') {
				$moduleController = new ModuleController();
				$moduleController->deleteModule($_GET['idModule']);
				$_SESSION['success'] = 'Le module a bien été supprimé';
				$_SESSION['display_msg_success'] = true;
				$this->profile();
			} else {
				$_SESSION['error'] = 'Vous n\'avez pas les droits requis pour accéder à cette page';
				$_SESSION['display_msg_error'] = true;
				$this->profile();
			}
		} else {
			$_SESSION['error'] = '[7] La page n\'existe pas';
			$_SESSION['display_msg_error'] = true;
			$this->profile();
		}
	}
	
    //charge la page formation
	public function formation()
	{
		$infosUser = new UserDAO();
		$infos = $infosUser->getInfoUser($_SESSION['idUser']);
		$managerFormation = new FormationDAO();
		if ($infos['type'] == 'Admin'){
			$mesFormations = $managerFormation->getFormations();
		}
		else {
			$mesFormations = $managerFormation->getFormationsByUser($infos['id']);
		}
		$formationView = new FormationView();
		echo $formationView->getView($mesFormations, $infos['type']);
	}
	
    //charge la page createFormation
	public function createFormation()
	{
		$infosUser = new UserDAO();
		$infos = $infosUser->getInfoUser($_SESSION['idUser']);
		if ($infos['type'] == 'Admin') {
			if (isset($_POST['nameFormation'])) {
				$formationController = new FormationController();
				$formationController->createFormation($_POST['nameFormation'], $_POST['descriptionFormation']);
			}
			$formFormationView = new FormFormationView();
			echo $formFormationView->getViewInsert();
		} else {
			$_SESSION['error'] = 'Vous n\'avez pas les droits requis pour accéder à cette page';
			$_SESSION['display_msg_error'] = true;
			$this->profile();
		}
	}
	
    //charge la page mise à jour formation
	public function updateFormation()
	{
		if (isset($_GET['idFormation'])) {
			$infosUser = new UserDAO();
			$infos = $infosUser->getInfoUser($_SESSION['idUser']);
			if ($infos['type'] == 'Admin') {
				$verifFormation = new FormationDAO();
				$isFormationExist = $verifFormation->verifFormation($_GET['idFormation']);
				if (!$isFormationExist) {
					$_SESSION['error'] = 'La formation n\'existe pas';
					$_SESSION['display_msg_error'] = true;
					$this->profile();
				} else {
					if (isset($_POST['nameFormation'])) {
						$formationController = new FormationController();
						$formationController->updateFormation($_POST['nameFormation'], $_POST['descriptionFormation'], $_GET['idFormation']);
					}
					
					$managerFormation = new FormationDAO();
					$infos = $managerFormation->getNameAndDescriptionFormation($_GET['idFormation']);
					$formFormationView = new FormFormationView();
					echo $formFormationView->getViewUpdate($_GET['idFormation'], $infos['name'], $infos['description']);
				}
			} else {
				$_SESSION['error'] = 'Vous n\'avez pas les droits requis pour accéder à cette page';
				$_SESSION['display_msg_error'] = true;
				$this->profile();
			}
		} else {
			$_SESSION['error'] = '[8] La page n\'existe pas';
			$_SESSION['display_msg_error'] = true;
			$this->profile();
		}
	}
	
    //charge la page delete formation
	public function deleteFormation()
	{
		if (isset($_GET['idFormation'])) {
			$infosUser = new UserDAO();
			$infos = $infosUser->getInfoUser($_SESSION['idUser']);
			if ($infos['type'] == 'Admin') {
				$formationController = new FormationController();
				$formationController->deleteFormation($_GET['idFormation']);
				$_SESSION['success'] = 'La formation a bien été supprimée';
				$_SESSION['display_msg_success'] = true;
				$this->profile();
			} else {
				$_SESSION['error'] = 'Vous n\'avez pas les droits requis pour accéder à cette page';
				$_SESSION['display_msg_error'] = true;
				$this->profile();
			}
		} else {
			$_SESSION['error'] = '[9] La page n\'existe pas';
			$_SESSION['display_msg_error'] = true;
			$this->profile();
		}
	}
	
    //charge la page show module
	public function showModule()
	{
		if (isset($_GET['idModule'])) {
			$infosUser = new UserDAO();
			$infos = $infosUser->getInfoUser($_SESSION['idUser']);
			$managerFormation = new FormationDAO();
			$managerModule = new ModuleDAO();
			$haveRight = false;

			if ($infos['type'] != 'Admin'){
				$formations = $managerFormation->getFormationsByUser($infos['id']);		
				$mesModules = array();
				foreach ($formations as $formation) {
					array_push($mesModules, $managerModule->getModulesByFormation($formation['id']));
				}
				foreach ($mesModules as $formation) {
					foreach ($formation as $module) {
						if ($module['id'] == $_GET['idModule']){
							$haveRight = true;
						}
					}
				}
			}
			if ($haveRight || $infos['type'] == 'Admin') {
				$isModuleExist = $managerModule->verifModule($_GET['idModule']);
				if (!$isModuleExist) {
					$_SESSION['error'] = 'Le module n\'existe pas';
					$_SESSION['display_msg_error'] = true;
					$this->profile();
				} else {
					$managerPractice = new PracticeDAO();
					$mesCours = $managerPractice->getPracticesByModule($_GET['idModule']);
					if ($mesCours) {
						foreach ($mesCours as &$cours) {
							$idUserForPractice = $cours['user'];
							$getInfoUser = $infosUser->getInfoUser($idUserForPractice);
							$cours['user'] = $getInfoUser['login'];
						}
					}
					$infosModule = $managerModule->getNameModule($_GET['idModule']);
					$practiceView = new PracticeView();
					echo $practiceView->getView($mesCours, $infos['type'], $infosModule['name']);
				}
			} else {
				$_SESSION['error'] = 'Vous n\'avez pas les droits requis pour accéder à cette page';
				$_SESSION['display_msg_error'] = true;
				$this->profile();
			}
		} else {
			$_SESSION['error'] = '[10] La page n\'existe pas';
			$_SESSION['display_msg_error'] = true;
			$this->profile();
		}
	}
	
    //charge la page show formation
	public function showFormation()
	{
		if (isset($_GET['idFormation'])) {
			$infosUser = new UserDAO();
			$infos = $infosUser->getInfoUser($_SESSION['idUser']);
			$managerFormation = new FormationDAO();
			$haveRight = false;
			if ($infos['type'] != 'Admin'){
				$formations = $managerFormation->getFormationsByUser($infos['id']);

				foreach ($formations as $formation) {
					if ($formation['id'] == $_GET['idFormation']){
						$haveRight = true;
					}
				}
			}
			if ($haveRight || $infos['type'] == 'Admin') {
				$verifFormation = new FormationDAO();
				$isFormationExist = $verifFormation->verifFormation($_GET['idFormation']);
				if (!$isFormationExist) {
					$_SESSION['error'] = 'La formation n\'existe pas';
					$_SESSION['display_msg_error'] = true;
					$this->profile();
				} else {
					$managerModule = new ModuleDAO();
					$mesModules = $managerModule->getModulesByFormation($_GET['idFormation']);

					$infosFormation = $managerFormation->getNameAndDescriptionFormation($_GET['idFormation']);
					$moduleView = new ModuleView();
					echo $moduleView->getView($mesModules, $infos['type'], $infosFormation['name']);
				}
			} else {
				$_SESSION['error'] = 'Vous n\'avez pas les droits requis pour accéder à cette page';
				$_SESSION['display_msg_error'] = true;
				$this->profile();
			}
		} else {
			$_SESSION['error'] = '[11] La page n\'existe pas';
			$_SESSION['display_msg_error'] = true;
			$this->profile();
		}
	}
}
