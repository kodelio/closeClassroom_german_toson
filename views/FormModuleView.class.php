<?php


class FormModuleView
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
					Il n\'y a aucune formations dans la base de données ! Vous ne pouvez pas créer de module !</div>
				</div>
			</div>';
		} else {
			$view = '<script>document.getElementById("tabFormation").className = "active";</script>
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

								<div style="margin-bottom: 25px;">
									Formations : 
									<div class="form-group">
										<div class="col-lg-12">';
											foreach ($mesFormations as &$formation) {
												$view=$view.'<input type="checkbox" name="formations[]" value="'.$formation['id'].'" />'.$formation['name'].'&nbsp;&nbsp;&nbsp;';
											}
											$view = $view.'
										</div>
									</div>                                     
								</div>

								<div style="margin-top:10px" class="form-group">
									<div class="col-sm-12 controls">
										<input style="margin-top: 10px;" type="submit" name="envoyer" class="btn btn-success" value="Créer le module">
										<a style="margin-top: 10px;" class="btn btn-warning" href="javascript:history.go(-1)">Annuler</a>
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

	public function getViewUpdate($idModule, $name)
	{
		return '
		<script>document.getElementById("tabFormation").className = "active";</script>
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
									<a style="margin-top: 10px;" class="btn btn-warning" href="javascript:history.go(-1)">Annuler</a>
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
