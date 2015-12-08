<?php 

class PracticeView{

	function __construct(){}

	public function getViewTop(){

		return '
		<ul class="breadcrumb col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
			<li>Connecté en tant que ' .$_SESSION['type']. ' : <b>' .$_SESSION['username']. '</b> (' .$_SESSION['email']. ')</li>
		</ul>
		<div class="container">  
			<div class="panel panel-default" style="margin-top:60px;">
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

	public function getView()
	{
		$view = ''.$this->getViewTop().$this->getListe().$this->getViewBottom();
		return $view;
		
	}

	public function getListe(){
		$managerPractice = new PracticeDAO();
		$mesCours = $managerPractice->getPractices();
		$view = '';
		foreach ($mesCours as &$cours) {
			$view = $view.'<div class="list-group-item">
			<h4><a class="text-primary" target="_blank" href="'.$cours['path'].'">'.$cours['name'].'</a> par '.$cours['user'].'</h4>
		</div>';
	}
	return $view;
}
}




?>