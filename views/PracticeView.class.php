<?php 

class PracticeView{

	function __construct(){}

	public function getViewTop(){

		return '
		<script>document.getElementById("tabPractice").className = "active";</script>
		<div class="container">  
			<div class="panel panel-default">
				<div class="panel-body" style="padding-top: 0px;">  
					<h3>Cours :</h3>
					<div class="list-group">';			
					}

					public function getViewBottom(){

						return '
					</div>
				</div>
			</div>
		</div>
		';
	}

	public function getView($typeUser)
	{
		$view = ''.$this->getViewTop().$this->getListe($typeUser).$this->getViewBottom();
		return $view;
		
	}

	public function getListe($typeUser){
		$managerPractice = new PracticeDAO();
		$mesCours = $managerPractice->getPractices();
		if ($typeUser != "Etudiant")
		{
			$view = '<a style="margin-bottom: 20px;" href="index.php?page=createPractice" class="btn btn-info"><span class="fa fa-plus"></span> Créer un cours</a>';
		}
		else 
		{
			$view = '';
		}
		if (!$mesCours)
		{
			$view = $view.'<div class="panel panel-info" style="margin-top: 20px;">
			<div class="panel-heading">
				<h3 class="panel-title">Aucun cours</h3>
			</div>
			<div class="panel-body">
				Il n\'y a aucun cours dans la base de données !</div>
			</div>';
		}
		else 
		{
			foreach ($mesCours as &$cours) {
				$modif = '';
				if ($typeUser != "Etudiant")
				{
					$modif = '<form method="POST" action="index.php?page=deletePractice&idPractice='.$cours['id'].'" accept-charset="UTF-8" class="form-inline"><input name="_method" type="hidden" value="DELETE">
					<a style="float: right; margin-left: 5px;" data-toggle="modal" href="#deleteCours'.$cours['id'].'" role="button" class="btn btn-danger"><i class="fa fa-trash"></i></a>
					<div id="deleteCours'.$cours['id'].'" class="modal" style="display: none;">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
									<h4 class="modal-title">Suppression de cours</h4>
								</div>
								<div class="modal-body">
									<p>Voulez-vous vraiment supprimer le cours <b>'.$cours['name'].'</b> ?</p>
								</div>
								<div class="modal-footer">
									<button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
									<input class="btn btn-primary" type="submit" value="Oui">
								</div>
							</div>
						</div>
					</div>
				</form>
				<a style="float: right;" href="index.php?page=updatePractice&idPractice='.$cours['id'].'" role="button" class="btn btn-info"><i class="fa fa-edit"></i></a>';
			}
				$view = $view.'<div class="list-group-item">'.$modif.'
				<h4><a class="text-primary" target="_blank" href="/'.$cours['path'].'">'.$cours['name'].'</a><a style="margin-left: 10px;" class="text-primary" download target="_blank" href="/'.$cours['path'].'"><i class="fa fa-download"></i></a></h4>
				<p class="list-group-item-text">'.$cours['description'].'</p>
				<p>Crée le '.$cours['date'].' par <b>'.$cours['user'].'</b></p>
			</div>';
		}
	}
	return $view;
}
}




?>