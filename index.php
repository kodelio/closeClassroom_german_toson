<?php
	session_start(); //On initialise la session

	include('controllers/MainController.class.php');

?>

<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>TP3 - Connexion - TOSON/GERMAN</title>
		<link rel="shortcut icon" href="img/favicon.ico" />
		<link href="css/bootstrapM.css" type="text/css" rel="stylesheet" media="all"  />
		<script src="js/jquery-1.7.2.min.js"></script>
		<script src="js/bootstrap.js"></script>
	</head>
	<body>
		<?php

			$controller = new MainControleur();

		?>
	</body>
</html>

<script>
	setTimeout(function() {
	  $('#alert').fadeOut('fast');
	}, 3000);
</script>
