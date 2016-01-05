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
				if ($log['type'] == 1) {
					$typeUser = "Administrateur";
				}
				elseif ($log['type'] == 2) {
					$typeUser = "Professeur";
				}
				elseif ($log['type'] == 3) {
					$typeUser = "Étudiant";
				}
				else {
					$typeUser = "Invité";
				}
				$_SESSION['type'] = $typeUser;
				$_SESSION['email'] = $log['email'];
				$cookie_value = $login.' '.$password;
				setcookie("moncookie", $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 jour
				new Utilisateur($login, $password);
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

	function getInfoUser($idPractice) {
		try
		{
			$resultat = mysqli_query($_SESSION['bdd'], "SELECT login, email, password FROM users WHERE `id`= '".$_GET['idUser']."'");
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

	function getDoublonByName($nameUser) {
		try
		{
			$resultat = mysqli_query($_SESSION['bdd'], "SELECT * FROM users WHERE `login`= '".$nameUser."'");
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

	function createPractice($nameUser, $passwordUser, $emailUser) {
		try
		{
			mysqli_query($_SESSION['bdd'], "INSERT INTO users (login, password, email) VALUES ('".$nameUser."', '".$passwordUser."', '".$emailUser."')");
		}
		catch(Exception $e)
		{
			$_SESSION['error'] = 'Erreur requete BDD';
			$_SESSION['display_msg_error'] = true;
		}
	}

	function updateUser($idUser, $nameUser, $passwordUser, $emailUser) {
		try
		{
			mysqli_query($_SESSION['bdd'], "UPDATE `users` SET `login` = '".$nameUser."', `password` = '".$passwordUser."', `email` = '".$emailUser."' WHERE `id` = '".$idUser."'");
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