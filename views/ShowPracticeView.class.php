<?php


class ShowPracticeView
{
	public function __construct()
	{
	}

	public function getView($idPractice, $name, $description, $file, $path, $editor)
	{
		return '
		<script>document.getElementById("tabFormation").className = "active";</script>
		<div class="container"> 
			<div id="alert">  
			</div>
			<div style="margin-top:20px;" class="col-md-12">                    
				<div class="panel panel-primary" >
					<div class="panel-heading">
						<div class="panel-title">Cours <b>'.utf8_encode($name).'</b></div>
					</div>     

					<div style="padding-top:10px" class="panel-body" >
						<h4>'.utf8_encode($name).'</a><a style="margin-left: 10px;" class="text-primary" download target="_blank" href="/'.$path.'"><i class="fa fa-download"></i></a></h4>
						<p class="list-group-item-text">'.utf8_encode($description).'</p>
						<div style="margin-top: 20px;">'.utf8_encode($editor).'</div>  
					</div>                     
				</div>  
			</div>
		</div>
		';
	}
}
