<?php 
	session_start();
	
	if(!isset($_SESSION['view_meu_wired'])){
		$_SESSION['view_meu_wired'] = 0;
	}
?>
<!DOCTYPE html>
<html lang="pt-BR">
	<head>
		<meta charset="UTF-8">
		<title>Academia Wired</title>
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
	    <meta name="viewport" content="initial-scale = 1.0, maximum-scale = 1.0, user-scalable = no, width = device-width">
		<?php include "includes/color-navigator.txt" ?>
		
		<link rel="stylesheet" href="css/style.css" />
		<link rel="stylesheet" href="css/emojis.css" />
	    <script src="js/script.js"></script>
		
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
		
		<!--
		<link rel="stylesheet" href="offline/material.min.css">
		<script src="offline/material.min.js"></script>
		-->
		<link rel="stylesheet" href="https://storage.googleapis.com/code.getmdl.io/1.0.2/material.indigo-blue.min.css" /> 
		<script src="https://storage.googleapis.com/code.getmdl.io/1.0.2/material.min.js"></script>
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	</head>
	<body id="pg_pg-in">
		<?php include "includes/header.php" ?>
				<main>
					<section class="section--center">
						<span class="mdl-layout-title">Últimas atualizações</span>
						<div class="mdl-grid">
							<div class="mdl-cell mdl-cell--4-col mdl-shadow--2dp">
								<span class="mdl-layout-title">Blog</span>
							</div>
							<div class="mdl-cell mdl-cell--4-col mdl-shadow--2dp">
								<span class="mdl-layout-title">Meu Wired</span>
							</div>
							<div class="mdl-cell mdl-cell--4-col mdl-shadow--2dp">
								<span class="mdl-layout-title">Novos Wireds</span>
							</div>
						</div>
					</section>
					<div class="mdl-grid">
						<div class="mdl-cell mdl-cell--12-col"></div>
						<div class="mdl-cell">4</div>
						<div class="mdl-cell">4</div>
						<div class="mdl-cell">4</div>
						<div class="mdl-cell">4</div>
						<div class="mdl-cell">4</div>
						<div class="mdl-cell">4</div>
						<div class="mdl-cell">4</div>
						<div class="mdl-cell">4</div>
					</div>
				</main>
		<?php include "includes/footer.php" ?>
	</body>
</html>