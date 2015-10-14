<?php 
class Utilisateur {
	private $_login;
	private $_password;


	function __construct($login, $password) {
		$usernames = array('admin' => 'toto', 'Laurent' => 'tata', 'Arnaud' => 'titi');

		if(!empty($login) AND !empty($password)) // On teste si les champs sont vides
		{
			if(array_key_exists($login, $usernames)) // On teste si le nom d'utilisateur entré par le visiteur existe dans le tableau
			{
				if ($usernames[$login] == $password) // On compare ensuite si le mot de passe entré correspond au nom d'utilisateur entré par le visiteur
				{					
					$this->_login = $login;
					$_SESSION['username'] = $login;
					
					$this->_password = $password;
					
					$_SESSION['isLogged'] = true;					
					
					$cookie_value = $login.' '.$password;
					setcookie("moncookie", $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 jour
				}
				else
				{
					$_SESSION['error'] = 'Mot de passe incorrect';
					$_SESSION['display_msg_error'] = true;
				}
			}
			else
			{
				$_SESSION['error'] = 'Utilisateur incorrect';
				$_SESSION['display_msg_error'] = true;
			}
		}
	}
	
	// public function getLogin()
	// {
		// return $this->_login;
	// }


	// private function setLogin($login)
	// {
		// $this->_login = $login;
	// }


	// public function getPassword()
	// {
		// return $this->_password;
	// }


	// private function setPassword($password)
	// {
		// $this->_password = $password;
	// }
	
}

?>