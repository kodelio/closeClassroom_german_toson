<?php


class ProfileView
{
	public function __construct()
	{
	}

	public function getView($idUser, $loginUser, $emailUser, $typeUser)
	{
		if ($typeUser == 'Admin') {
			$view = '
			<div class="container">    
				<div style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
					<div class="panel panel-primary" >
						<div class="panel-heading">
							<div class="panel-title">Informations</div>
						</div>     

						<div class="panel-body" >
							Nom d\'utilisateur : <b>'.$loginUser.'</b>    
							<br>
							Type de compte : <b>'.$typeUser.'</b> 
							<br>
							Email : <b>'.$emailUser.'</b>   
						</div>                     
					</div>
					<a style="margin-top: 10px;" href="index.php?page=user" class="btn btn-info"><span class="fa fa-user"></span> Voir les utilisateurs</a>
					<a style="margin-top: 10px;" href="index.php?page=formation" class="btn btn-info"><span class="fa fa-graduation-cap"></span> Liste des formations</a>
					<a style="margin-top: 10px;" href="index.php?page=createPractice" class="btn btn-info"><span class="fa fa-book"></span> Créer un cours</a>
					<a style="margin-top: 10px;" href="index.php?page=createModule" class="btn btn-info"><span class="fa fa-folder-open"></span> Créer un module</a>
					<a style="margin-top: 10px;" href="index.php?page=createFormation" class="btn btn-info"><span class="fa fa-plus"></span> Créer une formation</a>
				</div>
			</div>';
		} 
		else if ($typeUser == 'Professeur') {
			$view = '
			<div class="container">    
				<div style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
					<div class="panel panel-primary" >
						<div class="panel-heading">
							<div class="panel-title">Informations</div>
						</div>     

						<div class="panel-body" >
							Nom d\'utilisateur : <b>'.$loginUser.'</b>    
							<br>
							Type de compte : <b>'.$typeUser.'</b> 
							<br>
							Email : <b>'.$emailUser.'</b>   
						</div>                     
					</div>
					<a style="margin-top: 10px;" href="index.php?page=formation" class="btn btn-info"><span class="fa fa-graduation-cap"></span> Liste des formations</a>
					<a style="margin-top: 10px;" href="index.php?page=createPractice" class="btn btn-info"><span class="fa fa-book"></span> Créer un cours</a>
				</div>
			</div>';
		}
		else {
			$view = '
			<div class="container">    
				<div style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
					<div class="panel panel-primary" >
						<div class="panel-heading">
							<div class="panel-title">Informations</div>
						</div>     

						<div class="panel-body" >
							Nom d\'utilisateur : <b>'.$loginUser.'</b>    
							<br>
							Type de compte : <b>'.$typeUser.'</b> 
							<br>
							Email : <b>'.$emailUser.'</b>   
						</div>                     
					</div>
					<a style="margin-top: 10px;" href="index.php?page=formation" class="btn btn-info"><span class="fa fa-graduation-cap"></span> Liste des formations</a>
				</div>
			</div>';
		}

		return $view;
	}
}
