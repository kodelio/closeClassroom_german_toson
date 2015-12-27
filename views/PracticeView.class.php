<?php 

class PracticeView{

	function __construct(){}

	public function getViewTop(){

		return '
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
			<h4><a class="text-primary" target="_blank" href="'.$cours['path'].'"><i class="fa fa-download"></i> '.$cours['name'].'</a></h4>
			<p class="list-group-item-text">'.$cours['description'].'</p>
			<p>Crée le '.$cours['date'].' par '.$cours['user'].'</p>
		</div>';
	}
	return $view;
}
}




?>