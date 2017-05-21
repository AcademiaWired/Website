<?php 

//ini_set('display_errors', 1);
//ini_set('log_errors', 1);
//ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
//error_reporting(E_ALL);

	if(isset($_GET['nm_search'])) {
		header('location: busca.php?nm_search='.$_GET['nm_search']);
	}

	session_start();
	
	if(!isset($_SESSION['view_meu_wired'])){
		$_SESSION['view_meu_wired'] = 0;
	}

	
?>
<!DOCTYPE html>
<html lang="pt-BR">
	<head>
		<meta charset="UTF-8">
		<title>A comunidade da Academia Wired</title>
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
	    <meta name="viewport" content="initial-scale = 1.0, maximum-scale = 1.0, user-scalable = no, width = device-width">
		<meta name="theme-color" content="rgb(63,81,181)">
		<link rel="icon" sizes="192x192" href="favicon.png">
		
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
	<body id="pg_co">
		<?php include "includes/header.php" ?>
				<main>
					<section class="mdl-cell mdl-cell--3-col mdl-shadow--2dp">
						<h4>Mudar senha</h4>
						<form action="">
							<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
							    <input class="mdl-textfield__input" type="text" id="sample3" />
							    <label class="mdl-textfield__label" for="sample3">E-mail atual</label>
							</div>
							<br>
							<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
							    <input class="mdl-textfield__input" type="text" id="sample3" />
							    <label class="mdl-textfield__label" for="sample3">Senha atual</label>
							</div>
							<br>
							<label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="checkbox-1">
								<input type="checkbox" id="checkbox-1" class="mdl-checkbox__input"/>
								<span class="mdl-checkbox__label">Mudar e-mail</span>
							</label>
							<label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="checkbox-2">
								<input type="checkbox" id="checkbox-2" class="mdl-checkbox__input" />
								<span class="mdl-checkbox__label">Mudar senha</span>
							</label>
							<br>
							<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
							    <input class="mdl-textfield__input" type="text" id="sample3" />
							    <label class="mdl-textfield__label" for="sample3">Novo e-mail</label>
							</div>
							<br>
							<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
							    <input class="mdl-textfield__input" type="text" id="sample3" />
							    <label class="mdl-textfield__label" for="sample3">Novo e-mail novamente</label>
							</div>
							<br>
							<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
							    <input class="mdl-textfield__input" type="text" id="sample3" />
							    <label class="mdl-textfield__label" for="sample3">Nova senha</label>
							</div>
							<br>
							<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
							    <input class="mdl-textfield__input" type="text" id="sample3" />
							    <label class="mdl-textfield__label" for="sample3">Nova senha novamente</label>
							</div>
						</form>
					</section>
					<div class="mdl-grid">
						<section class="mdl-cell mdl-cell--12-colmdl-shadow--2dp">
							<h4>Últimos usuários criados</h4>
							<?php
								include "includes/conn.php";

								$sql_ultimos_criados = "SELECT * FROM db_users ORDER BY user_id DESC LIMIT 20";
								$result_ultimos_criados = $conn->query($sql_ultimos_criados);
								echo "<div style='display: flex;overflow: hidden;'>";
								while ($linha_ultimos_criados = $result_ultimos_criados->fetch_assoc()) {
									echo "<img src='https://www.habbo.com.br/habbo-imaging/avatarimage?user=".$linha_ultimos_criados['user_nick']."&action=sit&direction=2&head_direction=2&img_format=png&gesture=sml' title='".$linha_ultimos_criados['user_nick']."' />";
								}
								echo "</div>";
							?>
						</section>
						<section class="mdl-cell mdl-cell--12-col mdl-shadow--2dp"></section>
						<section class="mdl-cell mdl-cell--12-col mdl-shadow--2dp"></section>
					</div>
				</main>
		<?php include "includes/footer.php" ?>
	</body>
</html>	