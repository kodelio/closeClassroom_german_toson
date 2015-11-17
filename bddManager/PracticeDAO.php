<?php
class PracticeDAO
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

	function getPractices() {
		try
		{
			$resultat = mysqli_query($_SESSION['bdd'], 'SELECT * FROM practices');
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
				return null;
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