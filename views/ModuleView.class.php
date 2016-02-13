<?php


class ModuleView
{
	public function __construct()
	{
	}

	public function getViewTop($nameFormation)
	{
		return '
		<script>document.getElementById("tabFormation").className = "active";</script>
		<div class="container">  
			<div class="panel panel-default">
				<div class="panel-body" style="padding-top: 0px;">  
					<h3>Modules de la formation '.$nameFormation.' :</h3>
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

	public function getView($mesModules, $typeUser, $nameFormation)
	{
		$view = ''.$this->getViewTop($nameFormation).$this->getListe($mesModules, $typeUser).$this->getViewBottom();

		return $view;
	}

	public function getListe($mesModules, $typeUser)
	{
		if ($typeUser == 'Admin') {
			$view = '<a style="margin-bottom: 20px;" href="index.php?page=createModule" class="btn btn-info"><span class="fa fa-plus"></span> Créer un module</a>';
		} else {
			$view = '';
		}
		if (!$mesModules) {
			$view = $view.'<div class="panel panel-info" style="margin-top: 20px;">
			<div class="panel-heading">
				<h3 class="panel-title">Aucun module</h3>
			</div>
			<div class="panel-body">
				Il n\'y a aucun module dans la base de données !</div>
			</div>';
		} else {
			foreach ($mesModules as &$module) {
				$modif = '';
				if ($typeUser == 'Admin') {
					$modif = '<form method="POST" action="index.php?page=deleteModule&idModule='.$module['id'].'" accept-charset="UTF-8" class="form-inline"><input name="_method" type="hidden" value="DELETE">
					<a style="float: right; margin-left: 5px;" data-toggle="modal" href="#deleteModule'.$module['id'].'" role="button" class="btn btn-danger"><i class="fa fa-trash"></i></a>
					<div id="deleteModule'.$module['id'].'" class="modal" style="display: none;">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
									<h4 class="modal-title">Suppression de module</h4>
								</div>
								<div class="modal-body">
									<p>Voulez-vous vraiment supprimer le module <b>'.$module['name'].'</b> ?</p>
								</div>
								<div class="modal-footer">
									<button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
									<input class="btn btn-primary" type="submit" value="Oui">
								</div>
							</div>
						</div>
					</div>
				</form>
				<a style="float: right;" href="index.php?page=updateModule&idModule='.$module['id'].'" role="button" class="btn btn-info"><i class="fa fa-edit"></i></a>';
			}
			$view = $view.'<div class="list-group-item">'.$modif.'
			<h4><a href="index.php?page=showModule&idModule='.$module['id'].'">'.$module['name'].'</a></h4>
		</div>';
	}
}

return $view;
}
}
