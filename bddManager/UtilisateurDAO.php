<?php
class UtilisateurDAO
{
	function __construct() {
		try {
			$_SESSION['bdd'] = mysqli_connect('localhost', 'root', '', 'german_toson_webserv');
		}
		catch(Exception $e) {
			$_SESSION['error'] = 'Erreur BDD';
			$_SESSION['display_msg_error'] = true;
		}
	}

	function getUserByLoginAndPassword($login, $password) {
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
			return null;
		}
		else
		{//logger ici le user
			if($password == $log['password'])
			{
				$_SESSION['isLogged'] = true;
				$_SESSION['username'] = $login;
				$cookie_value = $login.' '.$password;
				setcookie("moncookie", $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 jour
				new Utilisateur($login, $password);
			}
			else
			{
				$_SESSION['error'] = 'Mauvais mot de passe';
				$_SESSION['display_msg_error'] = true;
			} 
		}
	}
}
?>