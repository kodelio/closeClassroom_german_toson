<?php


class FormPracticeView
{
	public function __construct()
	{
	}

	public function getViewInsert($mesModules)
	{
		$view = '';
		if (!$mesModules) {
			$view = $view.'<div class="container">
			<div class="panel panel-info" style="margin-top: 20px;">
				<div class="panel-heading">
					<h3 class="panel-title">Aucun module</h3>
				</div>
				<div class="panel-body">
					Il n\'y a aucun modules dans la base de données ! Créez en un avant d\'ajouter un cours</div>
				</div>
			</div>';
		} else {
			$view = '<script>document.getElementById("tabFormation").className = "active";</script>
			<div class="container"> 
				<div id="alert">  
				</div>
				<div style="margin-top:20px;" class="col-md-12">                    
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
									Cours :<br> <textarea class="htmlPractice" class="form-control" name="htmlPractice" style="width: 100%; height: 200px; border: #b4bcc2 1px solid;"></textarea>                            
								</div>
								<script>
									$(\'.htmlPractice\').wysihtml5({
										toolbar: {
											"font-styles": true, //Font styling, e.g. h1, h2, etc. Default true
											"emphasis": true, //Italics, bold, etc. Default true
											"lists": true, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
											"html": true, //Button which allows you to edit the generated HTML. Default false
											"link": true, //Button to insert a link. Default true
											"image": true, //Button to insert an image. Default true,
											"color": false, //Button to change color of font  
											"blockquote": true //Blockquote  
										}
									});
								</script>

								<textarea style="display:none;" id="hidden-editor" class="htmlPractice" class="form-control" name="postHtml"></textarea> 

								<div style="margin-bottom: 25px">
									<input type="hidden" name="MAX_FILE_SIZE" value="10000000">
									Fichier (<b>Obligatoire</b>) : <input type="file" name="fichierUp" size="50" required>                                       
								</div>

								<div style="margin-bottom: 25px;">
									Module : 
									<div class="form-group">
										<div class="col-lg-12">
											<select class="form-control" name="idModule" required>
												<option value="">Séléctionnez le module</option>
												';
												foreach ($mesModules as &$module) {
													$view=$view.'<option value="'.$module['id'].'">'.$module['name'].'</option>';
												}
												$view = $view.'</select>
											</div>
										</div>                                     
									</div>

									<div style="margin-top:10px" class="form-group">
										<div class="col-sm-12 controls">
											<input onclick="$(\'#hidden-editor\').html($(\'.htmlPractice\').val());" style="margin-top: 10px;" type="submit" name="envoyer" class="btn btn-success" value="Créer le cours">
											<a style="margin-top: 10px;" class="btn btn-warning" href="javascript:history.go(-1)">Annuler</a>
										</div>
									</div>
								</form>     
							</div>                     
						</div>  
					</div>
				</div>';
				return $view;
			}
		}

		public function getViewUpdate($idPractice, $name, $description, $file, $path, $editor)
		{
			return '
			<script>document.getElementById("tabFormation").className = "active";</script>
			<div class="container"> 
				<div id="alert">  
				</div>
				<div style="margin-top:20px;" class="col-md-12">                    
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
									Cours :<br> <textarea class="htmlPractice" class="form-control" name="htmlPractice" style="width: 100%; height: 200px; border: #b4bcc2 1px solid;">'.$editor.'</textarea>                            
								</div>
								<script>
									$(\'.htmlPractice\').wysihtml5({
										toolbar: {
											"font-styles": true, //Font styling, e.g. h1, h2, etc. Default true
											"emphasis": true, //Italics, bold, etc. Default true
											"lists": true, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
											"html": true, //Button which allows you to edit the generated HTML. Default false
											"link": true, //Button to insert a link. Default true
											"image": true, //Button to insert an image. Default true,
											"color": false, //Button to change color of font  
											"blockquote": true //Blockquote  
										}
									});
								</script>

								<textarea style="display:none;" id="hidden-editor" class="htmlPractice" class="form-control" name="postHtml"></textarea>

								<div style="margin-bottom: 25px">
									Fichier actuel : <b>'.$file.'</b><a style="margin-left: 10px;" class="text-primary" download target="_blank" href="/'.$path.'"><i class="fa fa-download"></i></a><br /><br />
									<input type="hidden" name="MAX_FILE_SIZE" value="10000000">
									Fichier (ne renvoyez pas de fichier si vous souhaitez garder le cours actuel) : <input type="file" name="fichierUp" size="50">                                       
								</div>

								<div style="margin-top:10px" class="form-group">
									<div class="col-sm-12 controls">
										<input onclick="$(\'#hidden-editor\').html($(\'.htmlPractice\').val());" style="margin-top: 10px;" style="margin-top: 10px;" type="submit" name="envoyer" class="btn btn-success" value="Mettre à jour">
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
