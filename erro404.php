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
		<title>Academia Wired</title>
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
	    <meta name="viewport" content="initial-scale = 1.0, maximum-scale = 1.0, user-scalable = no, width = device-width">
		<meta name="theme-color" content="rgb(63,81,181)">
		<link rel="icon" sizes="192x192" href="favicon.png">
		
		<link rel="stylesheet" href="/css/style.css" />
		<link rel="stylesheet" href="/css/emojis.css" />
	    <script src="/js/script.js"></script>
		
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
					Esta página não foi encontrada, deseja reportar esse erro? Erro: 4044
				</main>
		<?php include "includes/footer.php" ?>
	</body>
</html>