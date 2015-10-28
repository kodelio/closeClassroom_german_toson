<?php 
try {
	$_SESSION['bdd'] = mysqli_connect('localhost', 'root', '', 'german_toson_webserv');
}
catch(Exception $e) {
	$_SESSION['error'] = 'Erreur BDD';
	$_SESSION['display_msg_error'] = true;
}
?>