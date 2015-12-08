<?php
	session_start(); //On initialise la session

	include('controllers/MainController.class.php');

	?>

	<!DOCTYPE html>
	<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>CloseClassroom - TOSON/GERMAN</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<link href="//fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
		<link rel="shortcut icon" href="img/favicon.ico" />
		<link href="style/css/bootstrapM.css" type="text/css" rel="stylesheet" media="all"  />
		<link href="style/font-awesome-4.5.0/css/font-awesome.css" rel="stylesheet">
	</head>
	<body>
		<?php
		$controller = new MainController();
		?>

		<script src="style/js/jquery-1.7.2.min.js"></script>
		<script src="style/js/bootstrap.js"></script>

	</body>
	</html>

	<script>
		setTimeout(function() {
			$('#alert').fadeOut('fast');
		}, 3000);
	</script>
