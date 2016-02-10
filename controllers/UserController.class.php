<?php


class UserController
{
	public function __construct()
	{
	}
	
	public function createProfesseur($loginUser, $passwordUser, $emailUser, $typeUser, $nameUser, $firstNameUser)
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
				$createProfesseur = new UserDAO();
				$createProfesseur->createProfesseur($loginUser, $passwordUser, $emailUser, $typeUser, $nameUser, $firstNameUser);
				$_SESSION['success'] = 'L\'utilisateur <b>' . $loginUser . '</b> (' . $emailUser . ') a été crée.';
				$_SESSION['display_msg_success'] = true;
			} else {
				$_SESSION['error'] = 'L\'utilisateur n\'a pas été crée';
				$_SESSION['display_msg_error'] = true;
			}
		}
	}
	
	public function updateUser($loginUser, $passwordUser, $emailUser, $typeUser, $idUser, $nameUser, $firstNameUser)
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
				$updateUser->updateUser($idUser, $loginUser, $passwordUser, $emailUser, $typeUser, $nameUser, $firstNameUser);
				$_SESSION['success'] = 'L\'utilisateur <b>' . $loginUser . '</b> (' . $emailUser . ') a été mis à jour';
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
	
	public function register($loginUser, $passwordUser, $emailUser, $nameUser, $firstNameUser)
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
				$registerUser->register($loginUser, $passwordUser, $emailUser, $nameUser, $firstNameUser);
                //Mail d'inscription
				$to = $emailUser;
				$subject = "Inscription CloseClassroom";
				$message = "Bonjour " . $_POST['loginUser'] . ",\n
				Tu viens de t'inscrire sur CloseClassroom ! \n
				Voici tes identifiants : \n
				Login : " . $_POST['loginUser'] . " \n
				Adresse mail : " . $_POST['emailUser'] . "\n
				Mot de passe : " . $_POST['passwordUser'] . "
				\n";
				$headers = 'From: contact@laurent-toson.fr\n" 
				Reply-To: contact@laurent-toson.fr \n"
				X-Mailer: PHP/' . phpversion();
				
                // On n'envoie pas le mail car on est en local
                //$sendMail = mail($to, $subject, $message, $headers);
				$sendMail = true;
				if (!$sendMail) {
					$_SESSION['error'] = 'Inscription réussie mais une erreur est survenue lors d\'envoi du mail !';
					$_SESSION['display_msg_error'] = true;
				} else {
					$_SESSION['success'] = 'Votre compte <b>' . $loginUser . '</b> (' . $emailUser . ') a été crée. Vous allez reçevoir un mail avec vos infos.';
					$_SESSION['display_msg_success'] = true;
				}
			} else {
				$_SESSION['error'] = 'L\'inscription n\'a pas été réalisée';
				$_SESSION['display_msg_error'] = true;
			}
		}
	}
}
