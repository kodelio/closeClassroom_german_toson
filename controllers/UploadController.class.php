<?php 
	
	static $_dossier;
	static $_fichier;
	static $_taille_maxi;
	static $_taille;
	static $_extensions;
	static $_extension;
	
	final class UploadController
	{
		//instanciation du singleton pas cinglé
		public static function Instance()
		{
			static $inst = null;
			if ($inst === null) {
				$inst = new UploadController();
			}
			return $inst;
		}

		public function UploadFile()
		{
			$_fichier = basename($_FILES['fichierUp']['name']);
			$_taille = filesize($_FILES['fichierUp']['tmp_name']);
			$_extension = strrchr($_FILES['fichierUp']['name'], '.');
			$_extensions = array('.png', '.gif', '.jpg', '.jpeg', '.pdf', '.docx', '.txt'); // On choisi les extensions de fichiers autorisées
			$_dossier = 'upload/';
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
				
				if(move_uploaded_file($_FILES['fichierUp']['tmp_name'], $_dossier . $_fichier)) 
				{
					$_SESSION['success'] = 'Le fichier a été correctement envoyé';
					$_SESSION['display_msg_success'] = true;
				}
				else 
				{
					$_SESSION['error'] = 'Le fichier n\'a pas été envoyé';
					$_SESSION['display_msg_error'] = true;
				}
			}			
			
		}
		
		private function __construct()
		{
			//nothing to do here :P
		}
	}
?>