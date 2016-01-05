<?php 

class navBarView{

	function __construct(){}

	public function getViewLogged(){
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
					<a class="navbar-brand" href="index.php">CloseClassroom</a>
				</div>

				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
					<ul class="nav navbar-nav">
						<li><a href="index.php?page=user">Administration Utilisateurs</a></li>
						<li><a href="index.php?page=practice">Cours</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="index.php" style="font-size: 13px;"> Bonjour, <strong>'.$_SESSION['username'].'</strong> </a>
							<li><a href="index.php?page=logout">Se déconnecter</a></li>
						</ul>
					</div>
				</div>
			</nav>						
			';	
		}	

		public function getViewLogout(){
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
						<a class="navbar-brand" href="index.php">CloseClassroom</a>
					</div>

					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
						<ul class="nav navbar-nav">
							<li><a href="index.php?page=user">Administration Utilisateurs</a></li>
							<li><a href="index.php?page=practice">Cours</a></li>
						</ul>
					</div>
				</div>
			</nav>						
			';	
		}	
	}





	?>