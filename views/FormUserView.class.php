<?php


class FormUserView
{
    public function __construct()
    {
    }

    public function getViewInsert()
    {
        return '
		<script>document.getElementById("tabUser").className = "active";</script>
		<div class="container"> 
			<div id="alert">  
			</div>
			<div style="margin-top:20px;" class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
				<div class="panel panel-primary" >
					<div class="panel-heading">
						<div class="panel-title">Création d\'un utilisateur</div>
					</div>     

					<div style="padding-top:30px" class="panel-body" >

						<form method="post" class="form-horizontal" role="form" action="index.php?page=createUser" enctype="multipart/form-data">

							<div style="margin-bottom: 25px">
								Login :<br> <input type="text" class="form-control" name="loginUser" placeholder="Entrez le login" required>                                      
							</div>

							<div style="margin-bottom: 25px">
								Email :<br> <input type="email" class="form-control" name="emailUser" placeholder="Entrez l\'email" required>                                      
							</div>

							<div style="margin-bottom: 25px">
								Mot de passe :<br> <input type="password" class="form-control" name="passwordUser" placeholder="Entrez le mot de passe" required>                                      
							</div>

							<div style="margin-bottom: 25px">
								Type : 
								<div class="form-group">
									<div class="col-lg-6">
										<select class="form-control" name="typeUser">
											<option value="">Séléctionnez le type</option>
											<option value="Etudiant">Etudiant</option>
											<option value="Professeur">Professeur</option>
											<option value="Admin">Admin</option>
										</select>
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
		</div>
		';
    }

    public function getViewUpdate($idUser, $loginUser, $passwordUser, $emailUser, $typeUser)
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
						<div class="panel-title">Mise à jour de l\'utilisateur <b>'.$loginUser.'</b></div>
					</div>     

					<div style="padding-top:30px" class="panel-body" >

						<form method="post" class="form-horizontal" role="form" action="index.php?page=updateUser&idUser='.$idUser.'" enctype="multipart/form-data">

							<div style="margin-bottom: 25px">
								Login :<br> <input type="text" class="form-control" value="'.$loginUser.'" name="loginUser" placeholder="Entrez le login" required>                                      
							</div>

							<div style="margin-bottom: 25px">
								Email :<br> <input type="email" class="form-control" value="'.$emailUser.'" name="emailUser" placeholder="Entrez l\'email" required>                                      
							</div>

							<div style="margin-bottom: 25px">
								Mot de passe :<br> <input type="password" class="form-control" value="'.$passwordUser.'" name="passwordUser" placeholder="Entrez le mot de passe" required>                                      
							</div>

							<div style="margin-bottom: 25px">
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
