<?php


class UserView
{
	public function __construct()
	{
	}

	public function getViewTop()
	{
		return '
		<script>document.getElementById("tabUser").className = "active";</script>
		<div class="container">  
			<div class="panel panel-default">
				<div class="panel-body" style="padding-top: 0px;">  
					<h3>Utilisateurs :</h3>
					<div class="list-group">';
					}

					public function getViewBottom()
					{
						return '
					</div>
				</div>
			</div>
		</div>
		';
	}

	public function getView($mesUtilisateurs)
	{
		$view = ''.$this->getViewTop().$this->getListe($mesUtilisateurs).$this->getViewBottom();

		return $view;
	}

	public function getListe($mesUtilisateurs)
	{
		$view = '<a style="margin-bottom: 20px;" href="index.php?page=createUser" class="btn btn-info"><span class="fa fa-plus"></span> Créer un professeur</a><br /><div class="btn-group btn-group-justified">
		<a href="index.php?page=user" class="btn btn-primary">Afficher tous les utilisateurs</a>
		<a href="index.php?page=user&tri=Admin" class="btn btn-primary">Trier par Admin</a>
		<a href="index.php?page=user&tri=Professeur" class="btn btn-primary">Trier par Professeur</a>
		<a href="index.php?page=user&tri=Etudiant" class="btn btn-primary">Trier par Etudiant</a>
	</div><br />';
	if (!$mesUtilisateurs) {
		$view = $view.'<div class="panel panel-info" style="margin-top: 20px;">
		<div class="panel-heading">
			<h3 class="panel-title">Aucun utilisateur</h3>
		</div>
		<div class="panel-body">
			Il n\'y a aucun utilisateur dans la base de données !</div>
		</div>';
	} else {
		foreach ($mesUtilisateurs as &$utilisateur) {
			$managerFormation = new FormationDAO();
			$formations = $managerFormation->getFormationsByUser($utilisateur['id']);
			$view = $view.'<div class="list-group-item">
			<form method="POST" action="index.php?page=deleteUser&idUser='.$utilisateur['id'].'" accept-charset="UTF-8" class="form-inline"><input name="_method" type="hidden" value="DELETE">
				<a style="float: right; margin-left: 5px;" data-toggle="modal" href="#deleteUsers'.$utilisateur['id'].'" role="button" class="btn btn-danger"><i class="fa fa-trash"></i></a>
				<div id="deleteUsers'.$utilisateur['id'].'" class="modal" style="display: none;">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
								<h4 class="modal-title">Suppression d\'utilisateur</h4>
							</div>
							<div class="modal-body">
								<p>Voulez-vous vraiment supprimer l\'utilisateur <b>'.$utilisateur['login'].'</b> ? <br/>Cela supprimera les cours qui lui sont associés.</p>
							</div>
							<div class="modal-footer">
								<button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
								<input class="btn btn-primary" type="submit" value="Oui">
							</div>
						</div>
					</div>
				</div>
			</form>
			<a style="float: right;" href="index.php?page=updateUser&idUser='.$utilisateur['id'].'" role="button" class="btn btn-info"><i class="fa fa-edit"></i></a>
			<h4>'.$utilisateur['login'].' ('.utf8_encode($utilisateur['first_name']).' '.utf8_encode($utilisateur['name']).')</h4>
			<p class="list-group-item-text">'.$utilisateur['email'].'</p>
			<p>Type : <b>'.$utilisateur['type'].'</b></p>';
			if ($formations != null){
				$view = $view.'<p>Formations : ';
				foreach ($formations as &$formation) {
					$view = $view.'<span class="label label-primary">'.utf8_encode($formation['name']).'</span>&nbsp;&nbsp;';
				}
			}
			$view = $view.'</p>
		</div>';
	}
}

return $view;
}
}
