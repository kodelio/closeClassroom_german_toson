<?php


class FormFormationView
{
	public function __construct()
	{
	}

	public function getViewInsert()
	{
		return '
		<script>document.getElementById("tabFormation").className = "active";</script>
		<div class="container"> 
			<div id="alert">  
			</div>
			<div style="margin-top:20px;" class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
				<div class="panel panel-primary" >
					<div class="panel-heading">
						<div class="panel-title">Création de formation</div>
					</div>     

					<div style="padding-top:30px" class="panel-body" >

						<form method="post" class="form-horizontal" role="form" action="index.php?page=createFormation" enctype="multipart/form-data">

							<div style="margin-bottom: 25px">
								Nom de la formation :<br> <input type="text" class="form-control" name="nameFormation" placeholder="Entrez le titre de la formation" required>                                      
							</div>

							<div style="margin-bottom: 25px">
								Description de la formation :<br> <textarea class="form-control" name="descriptionFormation" cols="0" rows="0" placeholder="Entrez la description de la formation" required></textarea>                            
							</div>

							<div style="margin-top:10px" class="form-group">
								<div class="col-sm-12 controls">
									<input style="margin-top: 10px;" type="submit" name="envoyer" class="btn btn-success" value="Créer la formation">
									<a style="margin-top: 10px;" class="btn btn-warning" href="index.php?page=formation">Annuler</a>
								</div>
							</div>
						</form>     
					</div>                     
				</div>  
			</div>
		</div>
		';
	}

	public function getViewUpdate($idFormation, $name, $description)
	{
		return '
		<script>document.getElementById("tabFormation").className = "active";</script>
		<div class="container"> 
			<div id="alert">  
			</div>
			<div style="margin-top:20px;" class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
				<div class="panel panel-primary" >
					<div class="panel-heading">
						<div class="panel-title">Mise à jour de la formation <b>'.utf8_encode($name).'</b></div>
					</div>     

					<div style="padding-top:30px" class="panel-body" >

						<form method="post" class="form-horizontal" role="form" action="index.php?page=updateFormation&idFormation='.$idFormation.'" enctype="multipart/form-data">

							<div style="margin-bottom: 25px">
								Nom de la formation :<br> <input type="text" class="form-control" name="nameFormation" value="'.utf8_encode($name).'" required>                                      
							</div>

							<div style="margin-bottom: 25px">
								Description de la formation :<br> <textarea class="form-control" name="descriptionFormation" cols="0" rows="0" required>'.utf8_encode($description).'</textarea>                            
							</div>

							<div style="margin-top:10px" class="form-group">
								<div class="col-sm-12 controls">
									<input style="margin-top: 10px;" type="submit" name="envoyer" class="btn btn-success" value="Mettre à jour">
									<a style="margin-top: 10px;" class="btn btn-warning" href="index.php?page=formation">Annuler</a>
								</div>
							</div>
						</form>     
					</div>                     
				</div>  
			</div>
		</div>
		';
	}
}
