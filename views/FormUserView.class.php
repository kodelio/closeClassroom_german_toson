<?php


class FormUserView
{
	public function __construct()
	{
	}

	public function getViewInsert($mesFormations)
	{
		$view = '';
		if (!$mesFormations) {
			$view = $view.'<div class="container">
			<div class="panel panel-info" style="margin-top: 20px;">
				<div class="panel-heading">
					<h3 class="panel-title">Aucune formation</h3>
				</div>
				<div class="panel-body">
					Il n\'y a aucune formations dans la base de données ! Vous ne pouvez pas créer de professeur !</div>
				</div>
			</div>';
		} else {
			$view = '<script>document.getElementById("tabUser").className = "active";</script>
			<div class="container"> 
				<div id="alert">  
				</div>
				<div style="margin-top:20px;" class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
					<div class="panel panel-primary" >
						<div class="panel-heading">
							<div class="panel-title">Création d\'un professeur</div>
						</div>     

						<div style="padding-top:30px" class="panel-body" >

							<form method="post" class="form-horizontal" role="form" action="index.php?page=createUser" enctype="multipart/form-data">

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

								<div style="margin-bottom: 25px;">
									Formations : 
									<div class="form-group">
										<div class="col-lg-12">';
											foreach ($mesFormations as &$formation) {
												$view=$view.'<input type="checkbox" name="formations[]" value="'.$formation['id'].'" />'.utf8_encode($formation['name']).'&nbsp;&nbsp;&nbsp;';
											}
											$view = $view.'
										</div>
									</div>                                     
								</div>

								<div style="margin-top:10px" class="form-group">
									<div class="col-sm-12 controls">
										<input style="margin-top: 10px;" type="submit" name="envoyer" class="btn btn-success" value="Créer l\'utilisateur">
										<a style="margin-top: 10px;" class="btn btn-warning" href="index.php?page=user">Annuler</a>
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

	public function getViewUpdate($idUser, $loginUser, $passwordUser, $emailUser, $typeUser, $nameUser, $firstNameUser)
	{
		if ($typeUser == 'Etudiant') {
			$typeEtudiant = 'selected';
			$typeProfesseur = '';
			$typeAdmin = '';
		} elseif ($typeUser == 'Professeur') {
			$typeEtudiant = '';
			$typeProfesseur = 'selected';
			$typeAdmin = '';
		} elseif ($typeUser == 'Admin') {
			$typeEtudiant = '';
			$typeProfesseur = '';
			$typeAdmin = 'selected';
		}
		$form = '
		<script>document.getElementById("tabUser").className = "active";</script>
		<div class="container"> 
			<div id="alert">  
			</div>
			<div style="margin-top:20px;" class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
				<div class="panel panel-primary" >
					<div class="panel-heading">
						<div class="panel-title">Mise à jour de l\'utilisateur <b>'.utf8_encode($loginUser).'</b></div>
					</div>     

					<div style="padding-top:30px" class="panel-body" >

						<form method="post" class="form-horizontal" role="form" action="index.php?page=updateUser&idUser='.$idUser.'" enctype="multipart/form-data">

							<div style="margin-bottom: 25px">
								Login :<br> <input type="text" class="form-control" value="'.utf8_encode($loginUser).'" name="loginUser" placeholder="Entrez le login" required>                                      
							</div>

							<div style="margin-bottom: 25px">
								Nom :<br> <input type="text" class="form-control" value="'.utf8_encode($nameUser).'" name="nameUser" placeholder="Entrez le nom" required>                                      
							</div>

							<div style="margin-bottom: 25px">
								Prénom :<br> <input type="text" class="form-control" value="'.utf8_encode($firstNameUser).'" name="firstNameUser" placeholder="Entrez le prénom" required>                                      
							</div>

							<div style="margin-bottom: 25px">
								Email :<br> <input type="email" class="form-control" value="'.utf8_encode($emailUser).'" name="emailUser" placeholder="Entrez l\'email" required>                                      
							</div>

							<div style="margin-bottom: 25px">
								Mot de passe :<br> <input type="password" class="form-control" value="'.$passwordUser.'" name="passwordUser" placeholder="Entrez le mot de passe" required>                                      
							</div>';

							if ($typeUser == 'Etudiant') {
								$managerFormation = new FormationDAO();
								$mesFormations = $managerFormation->getFormations();
								$maFormation = $managerFormation->getFormationsByUser($idUser);

								$form = $form.'<div style="margin-bottom: 25px;">
								Formation : 
								<div class="form-group">
									<div class="col-lg-12">
										<select class="form-control" name="idFormation" required>
											<option value="">Séléctionnez la formation</option>
											';
											foreach ($mesFormations as $formation) {
												$form=$form.'<option'; if($formation['id'] == $maFormation[0]['id']){ $form = $form.' selected';} $form = $form.' value="'.$formation['id'].'">'.utf8_encode($formation['name']).' ('.utf8_encode($formation['description']).')</option>';
											}
											$form = $form.'</select>
										</div>
									</div>                                     
								</div>';
							}

							else if ($typeUser == 'Professeur') {
								$managerFormation = new FormationDAO();
								$mesFormations = $managerFormation->getFormations();
								$listeFormations = $managerFormation->getFormationsByUser($idUser);

								$form = $form.'<div style="margin-bottom: 25px;">
								Formation : 
								<div class="form-group">
									<div class="col-lg-12">';
										foreach ($mesFormations as &$formation) {
											$form=$form.'<input type="checkbox"'; 

											foreach ($listeFormations as $maFormation) {
												if ($maFormation['id'] == $formation['id']){
													$form = $form.' checked';
												}
											}

											$form = $form.' name="formations[]" value="'.$formation['id'].'" />'.utf8_encode($formation['name']).'&nbsp;&nbsp;&nbsp;';
										}
										$form = $form.'
									</div>
								</div>                                     
							</div>';
						}

						$form = $form.'<div style="margin-bottom: 25px; display: none;">
						Type : 
						<div class="form-group">
							<div class="col-lg-6">
								<select class="form-control" name="typeUser">
									<option value="">Séléctionnez le type</option>
									<option value="Etudiant"'.$typeEtudiant.'>Etudiant</option>
									<option value="Professeur"'.$typeProfesseur.'>Professeur</option>
									<option value="Admin"'.$typeAdmin.'>Admin</option>
								</select>
							</div>
						</div>                                     
					</div>

					<div style="margin-top:10px" class="form-group">
						<div class="col-sm-12 controls">
							<input style="margin-top: 10px;" type="submit" name="envoyer" class="btn btn-success" value="Mettre à jour">
							<a style="margin-top: 10px;" class="btn btn-warning" href="index.php?page=user">Annuler</a>
						</div>
					</div>
				</form>     
			</div>                     
		</div>  
	</div>
</div>
';

return $form;
}
}
