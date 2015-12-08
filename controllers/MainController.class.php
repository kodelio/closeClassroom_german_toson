<?php

	// views
include('views/NavBarView.class.php');
include('views/LoginView.class.php');
include('views/ProfileView.class.php');
include('views/UploadView.class.php');
include('views/PracticeView.class.php');

	// models
include('models/Utilisateur.class.php');
include('models/Practice.class.php');

	//controllers
include('controllers/UploadController.class.php');

	//managers
include('bddManager/UtilisateurDAO.php');
include('bddManager/PracticeDAO.php');

class MainController {

	function __construct() {

			//charge la session si cookie présent
		if(!$this->isLogged() && isset($_COOKIE["moncookie"])) {
			$username_cookie = substr($_COOKIE["moncookie"], 0, strrpos($_COOKIE["moncookie"], " "));
			$password_cookie = substr($_COOKIE["moncookie"], strrpos($_COOKIE["moncookie"], " ")+1);
			$login = new Utilisateur($username_cookie, $password_cookie);
		}

			//insertion de la navbar
		$this->navBar();

			//choix de la page
		if ($this->isLogged())
		{
			if (isset($_GET['page']))
			{
				switch ($_GET['page'])
				{
					case 'login':
					$this->login();
					break;

					case 'logout':
					$this->logout();
					break;

					case 'practice':
					$this->practice();
					break;

					case 'upload':
					$this->upload();
					break;

						default: //404
						break;
					}
				}
				else
				{
					$this->profile();
				}			
			}
			else
			{
				$this->login();
			}
			
			//popup d'erreur
			if(isset($_SESSION['error']) AND $_SESSION['error'] != null AND isset($_SESSION['display_msg_error']) AND $_SESSION['display_msg_error'])
			{
				include('include/ErrorModal.php');
				$_SESSION['display_msg_error'] = false;
			}
			//popup de succès
			if(isset($_SESSION['success']) AND $_SESSION['success'] != null AND isset($_SESSION['display_msg_success']) AND $_SESSION['display_msg_success'])
			{
				include('include/SuccessModal.php');
				$_SESSION['display_msg_success'] = false;
			}
		}
		
		//insertion de la navbar
		function navBar() {
			$navBarView = new navBarView();
			
			if ($this->isLogged())
			{
				echo $navBarView->getViewLogged();
			}
			else
			{
				echo $navBarView->getViewLogout();
			}
		}
		
		//teste si l'utilisateur est connecté
		function isLogged() {
			if (isset($_SESSION['isLogged']) AND $_SESSION['isLogged'] == true)
			{
				return true;
			}
			else
			{
				return false;
			}
		}

		//charge la page de login
		function login() {
			$managerUser = new UtilisateurDAO();
			if (isset($_GET['username']) && isset($_GET['password']))
			{
				$managerUser->getUserByLoginAndPassword($_GET['username'],$_GET['password']);
			}
			else
			{
				$_SESSION['isLogged'] = false;				
			}
			

			//$login = new Utilisateur($_GET['username'],$_GET['password']);

			if (!$this->isLogged())
			{
				$_SESSION['isLogged'] = false;
				$loginView = new loginView();
				echo $loginView->getView();
			}
			else
			{
				$profileView = new ProfileView();
				echo $profileView->getView();
			}
		}

		//charge la page de déconnection
		function logout() {
			if (isset($_COOKIE['moncookie']))
			{
				unset($_COOKIE['moncookie']);
				setcookie('moncookie', '', time() - 3600, '/');
			}
			session_unset();
			session_destroy();
			header('Location: /webserv/');
		}

		//charge la page practice
		function practice() {

			$practiceView = new PracticeView();
			echo $practiceView->getView();
		}

		//charge la page upload
		function upload() {
			if (isset($_POST['namePractice']) && isset($_FILES['fichierUp']['name']) AND $_FILES['fichierUp']['name'] != null)
			{
				$uploader = UploadController::Instance();
				$uploader->UploadFile($_POST['namePractice']);
			}
			$uploadView = new UploadView();
			echo $uploadView->getView();
		}

		//charge la page profile
		function profile() {
			$profileView = new ProfileView();
			echo $profileView->getView();
		}
	}
	?>
