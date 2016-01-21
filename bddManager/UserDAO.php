<?php
class UserDAO
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
				$_SESSION['idUser'] = $log['id'];
				$_SESSION['type'] = $log['type'];
				$_SESSION['email'] = $log['email'];
				$cookie_value = $login.' '.$password;
				setcookie("moncookie", $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 jour
				new User($login, $password);
				header('Location: /webserv/');
			}
			else
			{
				$_SESSION['error'] = 'Mauvais mot de passe';
				$_SESSION['display_msg_error'] = true;
			} 
		}
	}

	function getUsers() {
		try
		{
			$resultat = mysqli_query($_SESSION['bdd'], 'SELECT * FROM users');
			if (mysqli_num_rows($resultat) != '0')
			{
				$tab[0] = mysqli_fetch_assoc($resultat);
				if (mysqli_num_rows($resultat) > '0')
				{
					for ($i=1; $i<mysqli_num_rows($resultat); $i++)
					{
						array_push($tab, mysqli_fetch_assoc($resultat));
					}
				}
				return $tab;
			}
			else
			{
				return false;
			}
		}
		catch(Exception $e)
		{
			$_SESSION['error'] = 'Erreur requete BDD';
			$_SESSION['display_msg_error'] = true;
		}
	}

	function getEtudiants() {
		try
		{
			$resultat = mysqli_query($_SESSION['bdd'], "SELECT * FROM users WHERE `type`= 'Etudiant'");
			if (mysqli_num_rows($resultat) != '0')
			{
				$tab[0] = mysqli_fetch_assoc($resultat);
				if (mysqli_num_rows($resultat) > '0')
				{
					for ($i=1; $i<mysqli_num_rows($resultat); $i++)
					{
						array_push($tab, mysqli_fetch_assoc($resultat));
					}
				}
				return $tab;
			}
			else
			{
				return false;
			}
		}
		catch(Exception $e)
		{
			$_SESSION['error'] = 'Erreur requete BDD';
			$_SESSION['display_msg_error'] = true;
		}
	}

	function getInfoUser($idUser) {
		try
		{
			$resultat = mysqli_query($_SESSION['bdd'], "SELECT id, login, email, password, type FROM users WHERE `id`= '".$idUser."'");
			if (mysqli_num_rows($resultat) != '0')
			{
				$tab[0] = mysqli_fetch_assoc($resultat);
				return $tab[0];
			}
			else
			{
				return null;
			}
		}
		catch(Exception $e)
		{
			$_SESSION['error'] = 'Erreur requete BDD';
			$_SESSION['display_msg_error'] = true;
		}
	}

	function getDoublonByEmail($emailUser, $idUser) {
		try
		{
			$resultat = mysqli_query($_SESSION['bdd'], "SELECT * FROM users WHERE `email`= '".$emailUser."' and `id` != '".$idUser."' ");
			if (mysqli_num_rows($resultat) != '0')
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		catch(Exception $e)
		{
			$_SESSION['error'] = 'Erreur requete BDD';
			$_SESSION['display_msg_error'] = true;
		}
	}

	function getDoublonByLogin($loginUser, $idUser) {
		try
		{
			$resultat = mysqli_query($_SESSION['bdd'], "SELECT * FROM users WHERE `login`= '".$loginUser."' and `id` != '".$idUser."' ");
			if (mysqli_num_rows($resultat) != '0')
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		catch(Exception $e)
		{
			$_SESSION['error'] = 'Erreur requete BDD';
			$_SESSION['display_msg_error'] = true;
		}
	}

	function createUser($loginUser, $passwordUser, $emailUser, $typeUser) {
		try
		{
			mysqli_query($_SESSION['bdd'], "INSERT INTO users (type, login, password, email) VALUES ('".$typeUser."', '".$loginUser."', '".$passwordUser."', '".$emailUser."')");
		}
		catch(Exception $e)
		{
			$_SESSION['error'] = 'Erreur requete BDD';
			$_SESSION['display_msg_error'] = true;
		}
	}

	function updateUser($idUser, $loginUser, $passwordUser, $emailUser, $typeUser) {
		try
		{
			mysqli_query($_SESSION['bdd'], "UPDATE `users` SET `type` = '".$typeUser."', `login` = '".$loginUser."', `password` = '".$passwordUser."', `email` = '".$emailUser."' WHERE `id` = '".$idUser."'");
		}
		catch(Exception $e)
		{
			$_SESSION['error'] = 'Erreur requete BDD';
			$_SESSION['display_msg_error'] = true;
		}
	}

	function deleteUser($idUser) {
		try
		{
			mysqli_query($_SESSION['bdd'], "DELETE FROM `users` WHERE `id` = '".$idUser."'");
		}
		catch(Exception $e)
		{
			$_SESSION['error'] = 'Erreur requete BDD';
			$_SESSION['display_msg_error'] = true;
		}
	}

	function verifUser($idUser) {
		try
		{
			$resultat = mysqli_query($_SESSION['bdd'], "SELECT * FROM users WHERE `id`= '".$idUser."'");
			if (mysqli_num_rows($resultat) != '0')
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		catch(Exception $e)
		{
			$_SESSION['error'] = 'Erreur requete BDD';
			$_SESSION['display_msg_error'] = true;
		}
	}
}
?>