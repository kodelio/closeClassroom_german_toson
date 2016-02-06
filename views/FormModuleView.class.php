<?php


class FormModuleView
{
	public function __construct()
	{
	}

	public function getViewInsert()
	{
		return '
		<script>document.getElementById("tabModule").className = "active";</script>
		<div class="container"> 
			<div id="alert">  
			</div>
			<div style="margin-top:20px;" class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
				<div class="panel panel-primary" >
					<div class="panel-heading">
						<div class="panel-title">Création de module</div>
					</div>     

					<div style="padding-top:30px" class="panel-body" >

						<form method="post" class="form-horizontal" role="form" action="index.php?page=createModule" enctype="multipart/form-data">

							<div style="margin-bottom: 25px">
								Nom du module :<br> <input type="text" class="form-control" name="nameModule" placeholder="Entrez le titre du module" required>                                      
							</div>

							<div style="margin-top:10px" class="form-group">
								<div class="col-sm-12 controls">
									<input style="margin-top: 10px;" type="submit" name="envoyer" class="btn btn-success" value="Créer le module">
									<a style="margin-top: 10px;" class="btn btn-warning" href="index.php?page=module">Annuler</a>
								</div>
							</div>
						</form>     
					</div>                     
				</div>  
			</div>
		</div>
		';
	}

	public function getViewUpdate($idModule, $name)
	{
		return '
		<script>document.getElementById("tabModule").className = "active";</script>
		<div class="container"> 
			<div id="alert">  
			</div>
			<div style="margin-top:20px;" class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
				<div class="panel panel-primary" >
					<div class="panel-heading">
						<div class="panel-title">Mise à jour du module <b>'.$name.'</b></div>
					</div>     

					<div style="padding-top:30px" class="panel-body" >

						<form method="post" class="form-horizontal" role="form" action="index.php?page=updateModule&idModule='.$idModule.'" enctype="multipart/form-data">

							<div style="margin-bottom: 25px">
								Nom du module :<br> <input type="text" class="form-control" name="nameModule" value="'.$name.'" required>                                      
							</div>

							<div style="margin-top:10px" class="form-group">
								<div class="col-sm-12 controls">
									<input style="margin-top: 10px;" type="submit" name="envoyer" class="btn btn-success" value="Mettre à jour">
									<a style="margin-top: 10px;" class="btn btn-warning" href="index.php?page=module">Annuler</a>
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
