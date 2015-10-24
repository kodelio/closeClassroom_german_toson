<?php

	// views
	include('views/NavBarView.class.php');
	include('views/LoginView.class.php');
	include('views/ProfileView.class.php');
	include('views/UploadView.class.php');
	include('views/PracticeView.class.php');

	// models
	include('models/Utilisateur.class.php');

	//controllers
	include('controllers/UploadController.class.php');

	function isLogged() {
		if (!isset($_SESSION['isLogged']) OR (isset($_SESSION['isLogged']) AND $_SESSION['isLogged'] == false))
		{
			return true;
		}
		else {
			return false;
		}
	}

	function navBar(){
		$navBarView = new navBarView();
		echo $navBarView->getView();
	}

	function login(){
		$login = new Utilisateur($_GET['username'],$_GET['password']);
		if (isLogged())
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

	function logout(){
		if (isset($_COOKIE['moncookie']))
		{
			unset($_COOKIE['moncookie']);
			setcookie('moncookie', '', time() - 3600, '/');
		}
		session_unset();
		session_destroy();
		$loginView = new loginView();
		echo $loginView->getView();
	}

	function practice(){
		if (isLogged())
		{
			$_SESSION['isLogged'] = false;
			$loginView = new loginView();
			echo $loginView->getView();
		}
		else
		{
			$practiceView = new PracticeView();
			echo $practiceView->getView();
		}

	}

	function upload(){
		if (isLogged())
		{
			$_SESSION['isLogged'] = false;
			$loginView = new loginView();
			echo $loginView->getView();
		}
		else
		{
			if (isset($_FILES['fichierUp']['name']) AND $_FILES['fichierUp']['name'] != null)
			{
				$uploader = UploadController::Instance();
				$uploader->UploadFile();
			}
			$uploadView = new UploadView();
			echo $uploadView->getView();
		}
	}


	function newLogin(){
		if (isLogged())
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

	class MainControleur {

		function __construct() {

			if(isset($_COOKIE["moncookie"])) {
				$username_cookie = substr($_COOKIE["moncookie"], 0, strrpos($_COOKIE["moncookie"], " "));
				$password_cookie = substr($_COOKIE["moncookie"], strrpos($_COOKIE["moncookie"], " ")+1);
				$login = new Utilisateur($username_cookie, $password_cookie);
			}

			navBar();

			if (isset($_GET['page']))
			{
				switch ($_GET['page'])
				{
					case 'login':
						login();
						break;

					case 'logout':
						logout();
						break;

					case 'practice':
						practice();
						break;

					case 'upload':
						upload();
						break;

					default: //404

						break;
				}
			}
			else
			{
				newLogin();
			}

			if(isset($_SESSION['error']) AND $_SESSION['error'] != null AND isset($_SESSION['display_msg_error']) AND $_SESSION['display_msg_error'])
			{
				include('include/ErrorModal.php');
				$_SESSION['display_msg_error'] = false;
			}
			if(isset($_SESSION['success']) AND $_SESSION['success'] != null AND isset($_SESSION['display_msg_success']) AND $_SESSION['display_msg_success'])
			{
				include('include/SuccessModal.php');
				$_SESSION['display_msg_success'] = false;
			}
		}
	}
?>
