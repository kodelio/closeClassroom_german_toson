<?php 

class UserController
{

	function __construct() {
	}

	public function createUser($nameUser, $passwordUser, $emailUser)
	{
		$getDoublonByEmail = new UserDAO();
		$doublon = $getDoublonByEmail->getDoublonByEmail($emailUser);

		if($doublon)
		{
			$_SESSION['error'] = 'Un utilisateur avec le même email existe déjà !';
			$_SESSION['display_msg_error'] = true;
		}
		else
		{
			if(!(isset($_SESSION['error']) AND $_SESSION['error'] != null AND isset($_SESSION['display_msg_error']) AND $_SESSION['display_msg_error']))
			{   
				$createUser = new UserDAO();
				$createUser->createUser($nameUser, $passwordUser, $emailUser);
				$_SESSION['success'] = 'L\'utilisateur <b>'.$nameUser.'</b> ('.$emailUser.') a été crée.';
				$_SESSION['display_msg_success'] = true;
			}
			else 
			{
				$_SESSION['error'] = 'L\'utilisateur n\'a pas été crée';
				$_SESSION['display_msg_error'] = true;
			}

		}		
	}

	public function updateUser($nameUser, $passwordUser, $emailUser, $idUser)
	{
		$getDoublonByEmail = new UserDAO();
		$doublon = $getDoublonByEmail->getDoublonByEmail($emailUser);

		if($doublon)
		{
			$_SESSION['error'] = 'Un utilisateur avec le même email existe déjà !';
			$_SESSION['display_msg_error'] = true;
		}
		else
		{
			if(!(isset($_SESSION['error']) AND $_SESSION['error'] != null AND isset($_SESSION['display_msg_error']) AND $_SESSION['display_msg_error']))
			{   
				$updateUser = new PracticeDAO();
				$updateUser->updateUser($idUser, $nameUser, $passwordUser, $emailUser);
				$_SESSION['success'] = 'L\'utilisateur <b>'.$nameUser.'</b> ('.$emailUser.') a été mis à jour';
				$_SESSION['display_msg_success'] = true;
			}
			else 
			{
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
}
?>