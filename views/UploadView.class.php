<?php 
	
	class UploadView{
		
		function __construct(){}
		
		public function getView(){
			
			return '
				<ul class="breadcrumb col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
					<li>Connecté en tant que : <b>' .$_SESSION['username']. '</b></li>
				</ul>
				<div class="container"> 
					<div id="alert">  
					</div>
					<div style="margin-top:20px;" class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
						<div class="panel panel-primary" >
							<div class="panel-heading">
								<div class="panel-title">Upload de fichier</div>
							</div>     

							<div style="padding-top:30px" class="panel-body" >

								<form method="post" class="form-horizontal" role="form" action="index.php?page=upload" enctype="multipart/form-data">

									<div style="margin-bottom: 25px">
										<input type="hidden" name="MAX_FILE_SIZE" value="10000000">
										Fichier : <input type="file" name="fichierUp" size="50">                                       
									</div>

									<div style="margin-top:10px" class="form-group">
										<div class="col-sm-12 controls">
											<input type="submit" name="envoyer" class="btn btn-success" value="Envoyer le fichier">
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