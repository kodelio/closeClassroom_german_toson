<?php 
	
	class navBarView{
		
		function __construct(){}
		
		public function getView(){
			
			return '
				<nav class="navbar navbar-inverse">
				  <div class="container-fluid">
					<div class="navbar-header">
					  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					  </button>
					  <a class="navbar-brand" href="index.php">TP3 - WebServ</a>
					</div>

					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
					  <ul class="nav navbar-nav">
						<li class="dropdown">
						  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Fonctionnalités <span class="caret"></span></a>
						  <ul class="dropdown-menu" role="menu">
							<li><a href="index.php">Informations</a></li>
							<li><a href="index.php?page=upload">Upload / Download de fichiers</a></li>
							<li><a href="index.php?page=practice">Les bonnes pratiques en PHP</a></li>
						  </ul>			  
						</li>
					  </ul>
					  <ul class="nav navbar-nav navbar-right">
						<li><a href="index.php">Retour</a></li>
						<li><a href="index.php?page=logout">Se déconnecter</a></li>
					  </ul>
					</div>
				  </div>
				</nav>						
			';			
		}
	}
	
	
	
	
?>