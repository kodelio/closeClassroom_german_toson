<?php 

class FormPracticeView{

	function __construct(){}

	public function getViewInsert(){

		return '
		<script>document.getElementById("tabPractice").className = "active";</script>
		<div class="container"> 
			<div id="alert">  
			</div>
			<div style="margin-top:20px;" class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
				<div class="panel panel-primary" >
					<div class="panel-heading">
						<div class="panel-title">Création de cours</div>
					</div>     

					<div style="padding-top:30px" class="panel-body" >

						<form method="post" class="form-horizontal" role="form" action="index.php?page=createPractice" enctype="multipart/form-data">

							<div style="margin-bottom: 25px">
								Nom du cours :<br> <input type="text" class="form-control" name="namePractice" placeholder="Entrez le titre du cours" required>                                      
							</div>

							<div style="margin-bottom: 25px">
								Description du cours :<br> <textarea class="form-control" name="descriptionPractice" cols="0" rows="0" placeholder="Entrez la description du cours" required></textarea>                            
							</div>

							<div style="margin-bottom: 25px">
								<input type="hidden" name="MAX_FILE_SIZE" value="10000000">
								Fichier : <input type="file" name="fichierUp" size="50" required>                                       
							</div>

							<div style="margin-top:10px" class="form-group">
								<div class="col-sm-12 controls">
									<input style="margin-top: 10px;" type="submit" name="envoyer" class="btn btn-success" value="Créer le cours">
									<a style="margin-top: 10px;" class="btn btn-warning" href="index.php?page=practice">Annuler</a>
								</div>
							</div>
						</form>     
					</div>                     
				</div>  
			</div>
		</div>
		';			
	}

	public function getViewUpdate($idPractice, $name, $description, $file, $path){

		return '
		<script>document.getElementById("tabPractice").className = "active";</script>
		<div class="container"> 
			<div id="alert">  
			</div>
			<div style="margin-top:20px;" class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
				<div class="panel panel-primary" >
					<div class="panel-heading">
						<div class="panel-title">Mise à jour du cours <b>'.$name.'</b></div>
					</div>     

					<div style="padding-top:30px" class="panel-body" >

						<form method="post" class="form-horizontal" role="form" action="index.php?page=updatePractice&idPractice='.$idPractice.'" enctype="multipart/form-data">

							<div style="margin-bottom: 25px">
								Nom du cours :<br> <input type="text" class="form-control" name="namePractice" value="'.$name.'" required>                                      
							</div>

							<div style="margin-bottom: 25px">
								Description du cours :<br> <textarea class="form-control" name="descriptionPractice" cols="0" rows="0" required>'.$description.'</textarea>                            
							</div>

							<div style="margin-bottom: 25px">
								Fichier actuel : <b>'.$file.'</b><a style="margin-left: 10px;" class="text-primary" download target="_blank" href="/'.$path.'"><i class="fa fa-download"></i></a><br /><br />
								<input type="hidden" name="MAX_FILE_SIZE" value="10000000">
								Fichier (ne renvoyez pas de fichier si vous souhaitez garder le cours actuel) : <input type="file" name="fichierUp" size="50">                                       
							</div>

							<div style="margin-top:10px" class="form-group">
								<div class="col-sm-12 controls">
									<input style="margin-top: 10px;" type="submit" name="envoyer" class="btn btn-success" value="Mettre à jour">
									<a style="margin-top: 10px;" class="btn btn-warning" href="index.php?page=practice">Annuler</a>
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

?>