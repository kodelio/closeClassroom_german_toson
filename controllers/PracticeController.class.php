<?php 

static $_dossier;
static $_fichier;
static $_taille_maxi;
static $_taille;
static $_extensions;
static $_extension;

final class PracticeController
{

	function __construct() {
	}

		//instanciation du singleton pas cinglé
	public static function Instance()
	{
		static $inst = null;
		if ($inst === null) {
			$inst = new PracticeController();
		}
		return $inst;
	}

	public function uploadFile($namePractice, $descriptionPractice)
	{
		$getDoublonByName = new PracticeDAO();
		$doublon = $getDoublonByName->getDoublonByName($namePractice);

		if($doublon)
		{
			$_SESSION['error'] = 'Un cours avec le même nom existe déjà !';
			$_SESSION['display_msg_error'] = true;
		}
		else
		{
			$_fichier = basename($_FILES['fichierUp']['name']);
			$_taille = filesize($_FILES['fichierUp']['tmp_name']);
			$_extension = strrchr($_FILES['fichierUp']['name'], '.');
			$_extensions = array('.png', '.gif', '.jpg', '.jpeg', '.pdf', '.docx', '.txt'); //On choisi les extensions de fichiers autorisées
			$_dossier = 'practices/';
			$_taille_maxi = 10000000; //10Mo

			if(!in_array($_extension, $_extensions)) // On teste si le fichier a la bonne extension 
			{
				$_SESSION['error'] = 'Vous devez uploader un fichier de type png, gif, jpg, jpeg, pdf, txt ou doc...';
				$_SESSION['display_msg_error'] = true;
			}
			if($_taille>$_taille_maxi) // On teste la taille du fichier avec la taille maximale autorisée
			{
				$_SESSION['error'] = 'Le fichier est trop gros...';
				$_SESSION['display_msg_error'] = true;
			}
			if(!(isset($_SESSION['error']) AND $_SESSION['error'] != null AND isset($_SESSION['display_msg_error']) AND $_SESSION['display_msg_error']))
			{   
				// On vérifie le nom du fichier (s'il ne contient pas de caractères spéciaux)
				$_fichier = strtr($_fichier, 
					'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
					'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
				$_fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $_fichier);

			// On ajoute la date et le l'user au nom du fichier
				$date = new DateTime(date("d-m-Y"));
				$result = $date->format('d-m-Y');
				$_fichier = ''.pathinfo($_fichier, PATHINFO_FILENAME).'_'.$result.'_'.$_SESSION['username'].$_extension.'';

				if(move_uploaded_file($_FILES['fichierUp']['tmp_name'], $_dossier . $_fichier)) 
				{
					$createPractice = new PracticeDAO();
					$createPractice->createPractice($namePractice, $_dossier, $_fichier, $descriptionPractice, $result);
					$_SESSION['success'] = 'Le cours <b>'.$namePractice.'</b> a été crée.';
					$_SESSION['display_msg_success'] = true;
				}
				else 
				{
					$_SESSION['error'] = 'Le cours n\'a pas été crée';
					$_SESSION['display_msg_error'] = true;
				}
			}	
		}		
	}

	public function updateFile($namePractice, $descriptionPractice, $idPractice, $newFile)
	{
		if (!$newFile)
		{
			if(!(isset($_SESSION['error']) AND $_SESSION['error'] != null AND isset($_SESSION['display_msg_error']) AND $_SESSION['display_msg_error']))
			{   
				$updatePracticeOldFile = new PracticeDAO();
				$updatePracticeOldFile->updatePracticeOldFile($idPractice, $namePractice, $descriptionPractice);
				$_SESSION['success'] = 'Le cours <b>'.$namePractice.'</b> a été mis à jour';
				$_SESSION['display_msg_success'] = true;
			}
			else 
			{
				$_SESSION['error'] = 'Le cours n\'a pas été mis à jour';
				$_SESSION['display_msg_error'] = true;
			}
		}
		else 
		{
			$_fichier = basename($_FILES['fichierUp']['name']);
			$_taille = filesize($_FILES['fichierUp']['tmp_name']);
			$_extension = strrchr($_FILES['fichierUp']['name'], '.');
			$_extensions = array('.png', '.gif', '.jpg', '.jpeg', '.pdf', '.docx', '.txt'); // On choisi les extensions de fichiers autorisées
			$_dossier = 'practices/';
			$_taille_maxi = 10000000;//10Mo

			if(!in_array($_extension, $_extensions)) // On teste si le fichier a la bonne extension 
			{
				$_SESSION['error'] = 'Vous devez uploader un fichier de type png, gif, jpg, jpeg, pdf, txt ou doc...';
				$_SESSION['display_msg_error'] = true;
			}
			if($_taille>$_taille_maxi) // On teste la taille du fichier avec la taille maximale autorisée
			{
				$_SESSION['error'] = 'Le fichier est trop gros...';
				$_SESSION['display_msg_error'] = true;
			}
			if(!(isset($_SESSION['error']) AND $_SESSION['error'] != null AND isset($_SESSION['display_msg_error']) AND $_SESSION['display_msg_error']))
			{   
				// On vérifie le nom du fichier (s'il ne contient pas de caractères spéciaux)
				$_fichier = strtr($_fichier, 
					'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
					'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
				$_fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $_fichier);

				// On ajoute la date et le l'user au nom du fichier
				$date = new DateTime(date("d-m-Y"));
				$result = $date->format('d-m-Y');
				$_fichier = ''.pathinfo($_fichier, PATHINFO_FILENAME).'_'.$result.'_'.$_SESSION['username'].$_extension.'';

				if(move_uploaded_file($_FILES['fichierUp']['tmp_name'], $_dossier . $_fichier)) 
				{
					$updatePracticeNewFile = new PracticeDAO();
					$updatePracticeNewFile->updatePracticeNewFile($idPractice, $namePractice, $_dossier, $_fichier, $descriptionPractice);
					$_SESSION['success'] = 'Le cours <b>'.$namePractice.'</b> a été mis à jour';
					$_SESSION['display_msg_success'] = true;
				}
				else 
				{
					$_SESSION['error'] = 'Le cours n\'a pas été mis à jour';
					$_SESSION['display_msg_error'] = true;
				}
			}
		}				
	}

	public function deleteFile($idPractice)
	{
		$managerPractice = new PracticeDAO();
		$managerPractice->deletePractice($idPractice);	
	}
}
?>