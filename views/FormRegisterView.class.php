<?php


class FormRegisterView
{
	public function __construct()
	{
	}

	public function getView($mesFormations)
	{
		$view = '';
		if (!$mesFormations) {
			$view = $view.'<div class="container">
			<div class="panel panel-info" style="margin-top: 20px;">
				<div class="panel-heading">
					<h3 class="panel-title">Aucune formation</h3>
				</div>
				<div class="panel-body">
					Il n\'y a aucune formations dans la base de données ! Vous ne pouvez pas vous inscrire pour le moment !</div>
				</div>
			</div>';
		} else {
			$view = '<div class="container"> 
			<div id="alert">  
			</div>
			<div style="margin-top:20px;" class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
				<div class="panel panel-primary" >
					<div class="panel-heading">
						<div class="panel-title">Formulaire d\'inscription</div>
					</div>     

					<div style="padding-top:30px" class="panel-body" >

						<form method="post" class="form-horizontal" role="form" action="index.php?page=register" enctype="multipart/form-data">

							<div style="margin-bottom: 25px">
								Login :<br> <input type="text" class="form-control" name="loginUser" placeholder="Entrez le login" required>                                      
							</div>

							<div style="margin-bottom: 25px">
								Nom :<br> <input type="text" class="form-control" name="nameUser" placeholder="Entrez le nom" required>                                      
							</div>

							<div style="margin-bottom: 25px">
								Prénom :<br> <input type="text" class="form-control" name="firstNameUser" placeholder="Entrez le prénom" required>                                      
							</div>

							<div style="margin-bottom: 25px">
								Email :<br> <input type="email" class="form-control" name="emailUser" placeholder="Entrez l\'email" required>                                      
							</div>

							<div style="margin-bottom: 25px">
								Mot de passe :<br> <input type="password" class="form-control" name="passwordUser" placeholder="Entrez le mot de passe" required>                                      
							</div>

							<div style="margin-bottom: 25px">
								Retapez votre mot de passe :<br> <input type="password" class="form-control" name="passwordUserCheck" placeholder="Entrez une deuxième fois votre mot de passe" required>                                      
							</div>

							<div style="margin-bottom: 25px;">
								Formation : 
								<div class="form-group">
									<div class="col-lg-6">
										<select class="form-control" name="idFormation" required>
											<option value="">Séléctionnez la formation</option>
											';
											foreach ($mesFormations as &$formation) {
												$view=$view.'<option value="'.$formation['id'].'">'.$formation['name'].' ('.$formation['description'].')</option>';
											}
											$view = $view.'</select>
										</div>
									</div>                                     
								</div>

								<div style="margin-top:10px" class="form-group">
									<div class="col-sm-12 controls">
										<input style="margin-top: 10px;" type="submit" name="envoyer" class="btn btn-success" value="S\'inscrire">
										<a style="margin-top: 10px;" class="btn btn-warning" href="index.php?page=login">Annuler</a>
									</div>
								</div>
							</form>     
						</div>                     
					</div>  
				</div>
			</div>';
		}

		return $view;
	}
}
