<?php 
	
	class ProfileView{
		
		function __construct(){}
		
		public function getView(){
			
			return '
				<div class="container">    
				    <div style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
				      <div class="panel panel-primary" >
				        <div class="panel-heading">
				          <div class="panel-title">Informations</div>
				        </div>     

				        <div class="panel-body" >
				        Nom d\'utilisateur : <b>' .$_SESSION['username']. '</b>      
				        </div>                     
				      </div>
				      <a href="index.php?page=practice" class="btn btn-info">Voir les bonnes pratiques de la programmation web</a>  
				      <br>
				      <a style="margin-top: 10px;" href="index.php?page=upload" class="btn btn-info">Upload / Download de fichiers</a>
				    </div>
				  </div>
			';			
		}
	}
	
	
	
	
?>