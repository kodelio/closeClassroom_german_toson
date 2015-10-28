<?php

include('include/connect.php');

class Utilisateur {
	private $_login;
	private $_password;


	function __construct($login, $password) {
		if(!empty($login) AND !empty($password)) // On teste si les champs sont vides
		{
			try
			{
				$resultat = mysqli_query($_SESSION['bdd'], 'SELECT * FROM users WHERE login=\'' .$login. '\'');
				$log = mysqli_fetch_assoc($resultat);
			}

			catch(Exception $e)
			{
				$_SESSION['error'] = 'Erreur requete BDD';
				$_SESSION['display_msg_error'] = true;
			}

			if(mysqli_num_rows($resultat) == '0')
			{
				$_SESSION['error'] = 'Login inconnu';
				$_SESSION['display_msg_error'] = true;
			}
			else
			{
				if($password == $log['password'])
				{
					$this->_login = $login;
					$_SESSION['username'] = $login;
					$this->_password = $password;

					$_SESSION['isLogged'] = true;

					$cookie_value = $login.' '.$password;
					setcookie("moncookie", $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 jour
				}
				else{
					$_SESSION['error'] = 'Mauvais mot de passe';
					$_SESSION['display_msg_error'] = true;
				}
			}
		}
		else {
			$_SESSION['error'] = 'Formulaire vide';
			$_SESSION['display_msg_error'] = true;
		}
	}

}

?>
