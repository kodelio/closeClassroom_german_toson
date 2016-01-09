<?php 

class ProfileView{
	
	function __construct(){}
	
	public function getView($idUser, $loginUser, $emailUser, $typeUser){
		
		if ($typeUser == "Admin")
		{
			$view = '
			<div class="container">    
				<div style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
					<div class="panel panel-primary" >
						<div class="panel-heading">
							<div class="panel-title">Informations</div>
						</div>     

						<div class="panel-body" >
							Nom d\'utilisateur : <b>' .$loginUser. '</b>    
							<br>
							Type de compte : <b>' .$typeUser. '</b> 
							<br>
							Email : <b>' .$emailUser. '</b>   
						</div>                     
					</div>
					<a href="index.php?page=user" class="btn btn-info"><span class="fa fa-user"></span> Voir les utilisateurs</a>
					<a href="index.php?page=practice" class="btn btn-info"><span class="fa fa-book"></span> Voir les cours</a>
				</div>
			</div>';	
		}

		else
		{
			$view = '
			<div class="container">    
				<div style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
					<div class="panel panel-primary" >
						<div class="panel-heading">
							<div class="panel-title">Informations</div>
						</div>     

						<div class="panel-body" >
							Nom d\'utilisateur : <b>' .$loginUser. '</b>    
							<br>
							Type de compte : <b>' .$typeUser. '</b> 
							<br>
							Email : <b>' .$emailUser. '</b>   
						</div>                     
					</div>
					<a href="index.php?page=practice" class="btn btn-info"><span class="fa fa-book"></span> Voir les cours</a>
				</div>
			</div>';	
		}

		return $view;		
	}
}




?>