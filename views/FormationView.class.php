<?php


class FormationView
{
	public function __construct()
	{
	}

	public function getViewTop()
	{
		return '
		<script>document.getElementById("tabFormation").className = "active";</script>
		<div class="container">  
			<div class="panel panel-default">
				<div class="panel-body" style="padding-top: 0px;">  
					<h3>Formations :</h3>
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

	public function getView($mesFormations, $typeUser)
	{
		$view = ''.$this->getViewTop().$this->getListe($mesFormations, $typeUser).$this->getViewBottom();

		return $view;
	}

	public function getListe($mesFormations, $typeUser)
	{
		if ($typeUser == 'Admin') {
			$view = '<a style="margin-bottom: 20px;" href="index.php?page=createFormation" class="btn btn-info"><span class="fa fa-plus"></span> Créer une formation</a>';
		} else {
			$view = '';
		}
		if (!$mesFormations) {
			$view = $view.'<div class="panel panel-info" style="margin-top: 20px;">
			<div class="panel-heading">
				<h3 class="panel-title">Aucune formation</h3>
			</div>
			<div class="panel-body">
				Il n\'y a aucune formation dans la base de données !</div>
			</div>';
		} else {
			foreach ($mesFormations as &$formation) {
				$modif = '';
				if ($typeUser == 'Admin') {
					$modif = '<form method="POST" action="index.php?page=deleteFormation&idFormation='.$formation['id'].'" accept-charset="UTF-8" class="form-inline"><input name="_method" type="hidden" value="DELETE">
					<a style="float: right; margin-left: 5px;" data-toggle="modal" href="#deleteFormation'.$formation['id'].'" role="button" class="btn btn-danger"><i class="fa fa-trash"></i></a>
					<div id="deleteFormation'.$formation['id'].'" class="modal" style="display: none;">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
									<h4 class="modal-title">Suppression de formation</h4>
								</div>
								<div class="modal-body">
									<p>Voulez-vous vraiment supprimer la formation <b>'.$formation['name'].'</b> ?</p>
								</div>
								<div class="modal-footer">
									<button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
									<input class="btn btn-primary" type="submit" value="Oui">
								</div>
							</div>
						</div>
					</div>
				</form>
				<a style="float: right;" href="index.php?page=updateFormation&idFormation='.$formation['id'].'" role="button" class="btn btn-info"><i class="fa fa-edit"></i></a>';
			}
			$view = $view.'<div class="list-group-item">'.$modif.'
			<h4>'.$formation['name'].'</h4>
			<p class="list-group-item-text">'.$formation['description'].'</p>
		</div>';
	}
}

return $view;
}
}
