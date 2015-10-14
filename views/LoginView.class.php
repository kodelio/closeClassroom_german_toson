<?php 
	
	class LoginView{
		
		function __construct(){}
		
		public function getView(){
			
			return '
				<div class="container col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
					<div id="loginbox" style="margin-top:20px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
						<div class="panel panel-primary" >
							<div class="panel-heading">
								<div class="panel-title">Connexion</div>
							</div>     
							<div style="padding-top:30px" class="panel-body" >
								<form method="get" id="loginform" class="form-horizontal" role="form" action="index.php">
									<input type="hidden" name="page" value="login">
									<div style="margin-bottom: 25px">
										<input id="login-username" type="text" class="form-control" name="username" value="" placeholder="Nom d\'utilisateur">                                        
									</div>

									<div style="margin-bottom: 25px">
										<input id="login-password" type="password" class="form-control" name="password" placeholder="Mot de passe">
									</div>

									<div style="margin-top:10px" class="form-group">
										<div class="col-sm-12 controls">
											<button type="submit" id="send_btn" class="btn btn-success">Se connecter</button>
											<br><br>			
										</div>
									</div>
								</form>
							</div>                     
						</div>
					</div>
				</div>
				<div style="position: fixed; bottom: 0; background-color: rgba(52, 73, 94, 1.0); opacity: 0.6; margin-bottom: 0px;" class="col-md-12 alert alert-dismissible alert-success">
					<button type="button" class="close" data-dismiss="alert">×</button>
					En poursuivant votre navigation sur cette application, vous acceptez l\'installation et l\'utilisation de cookies sur votre poste, voir nos <a target="_blank" href="img/image.jpg">conditions</a>.
				</div>
			';			
		}
	}

?>
