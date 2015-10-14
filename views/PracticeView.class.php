<?php 
	
	class PracticeView{
		
		function __construct(){}
		
		public function getView(){
			
			return '
				<ul class="breadcrumb col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
				  <li>Connecté en tant que : <b>' .$_SESSION['username']. '</b></li>
				</ul>
				<div class="container">  
				  <div class="panel panel-default" style="margin-top:60px;">
				  	<div class="panel-body" style="padding-top: 0px;">  
						<h3>Les bonnes pratiques :</h3>
						<div class="list-group">
						  <div class="list-group-item">
						    <h4 class="text-primary">Un serveur ne se fie jamais à son client</h4>
						    <p>En effet même s\'il est conseillé de controler la validité d\'un formulaire directement dans le navigateur 
								(côté client) via des fonctions JavaScript, il est impératif d\'effectuer aussi ce contrôle côté serveur 
								car de manière intentionnelle ou non, les fonctions JavaScript peuvent être contournées.</p>
						  </div>
						  <div class="list-group-item">
						    <h4 class="text-primary">Respecter les recommandations W3C</h4>
						    <p>Pour une bonne accessibilité, une meilleure expérience utilisateur mais aussi un bon référencement, il est 
								conseillé de suivre les recommandations W3C comme par exemple renseigner la légende d\'une image.</p>
						  </div>
						  <div class="list-group-item">
						    <h4 class="text-primary">Bien coder, c\'est gagner du temps en maintenance</h4>
						    <p>En effet il est préférable de présenter les conditions comme suit :<br>
								<i>if (expression)<br>
								{<br>
						    	&emsp; instruction;<br>
								}</i><br>
								Evitez les expressions "ternaire : expression ? instruction : instruction;" car peu lisibles.<br>
								Les acolades sont alignées et une bonne indentation du code est importante pour la lisibilité du code.<br>
								Il est aussi intéressant de normaliser les noms de variables et de fonctions comme par exemple en écriture "camelcase"</p>
						  </div>
						  <div class="list-group-item">
						    <h4 class="text-primary">Les noms de fichiers à ne pas négliger</h4>
						    <p>En effet, il est récurent qu\'en développement web, un nom de fichier avec des caractères spéciaux ou des espaces soit la source de bugs ! Remplacez les espaces par des "underscore" par exemple et normalisez vos noms de fichiers.</p>
						  </div>
						  <div class="list-group-item">
						    <h4 class="text-primary">Les bonnes pratiques servent aussi à améliorer la visibilité du code</h4>
						    <p>
								<i>$mavariable = «informatique»;<br>
								echo \'Ma valeur est \'.$mavariable.\'.\';<br>
								echo «Ma valeur est $mavariable.»;</i><br>
								Au premier coup d\'oeil, ces deux lignes en PHP sont les mêmes. Effectivement, le résultat sera le même, mais imaginez cette ligne noyée avec des milliers d\'autres lignes ! La première solution est la meilleure en terme de lisibilité et d\'interprétation du code, elle vous permettra de reconnaître qu\'il s\'agit d\'une chaîne de caractères concaténée avec une variable.
							</p>
						  </div>
						</div>
					</div>
				</div>
			  </div>
			';			
		}
	}
	
	
	
	
?>