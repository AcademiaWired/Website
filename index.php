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
		
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
		
		<!--
		<link rel="stylesheet" href="offline/material.min.css">
		<script src="offline/material.min.js"></script>
		-->
		<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
		<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
		<link rel="stylesheet" href="https://storage.googleapis.com/code.getmdl.io/1.0.2/material.indigo-blue.min.css" /> 
		<script src="https://storage.googleapis.com/code.getmdl.io/1.0.2/material.min.js"></script>
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<script type="text/javascript" src="jquery.als-1.7.min/jquery.als-1.7.min.js" ></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#my-als-list").als();
			});	
		</script>
		
		<link rel="stylesheet" href="css/style.css" />
		<link rel="stylesheet" href="css/style.index.css" />
		<link rel="stylesheet" href="css/emojis.css" />
	    <script src="/js/script.js"></script>
	</head>
	<body id="pg_pg-in">
		<?php include "includes/header.php" ?>
				<main>
					<section class="section--center">
						<iframe width="560" height="315" src="https://www.youtube.com/embed/FFiYn1kzXEo?list=UUaEiYIlpjYTpp_yzwbCbrSg" frameborder="0" allowfullscreen></iframe>
						<p style="margin:13px">O YouTube foi o ponto de partida da Academia Wired. Ele era o foco deste projeto por muito tempo, por ser um meio de fácil compartilhamento e de promoção daquilo que nós desejamos passar para o próximo. Tentamos postar regularmente novos vídeos porém não é sempre que isso se concretiza por diversas razões. Juntamente com os vídeos, postamos também uma versão em texto dos tutoriais para aqueles que:</p>
						<ul>
							<li>não possuem internet boa;</li>
							<li>não entenderam algum detalhe do vídeo;</li>
							<li>não gostam de assistir aos vídeos;</li>
							<li>desejam comentar fora do YouTube;</li>
							<li>ou quaisquer outros motivos.</li>
						</ul>
					</section>

					<section>
						<a href="tutlriais.php"><button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" style="float:right;margin-right:10px">
						  Mais
						</button></a>
						<h1 class="index-title">Novos tutoriais</h1>
						<span class="index-descricao">Vídeo + texto</span>
						<div class="als-container mdl-color--blue" id="my-als-list">
							<span class="als-prev-shadow"></span>
							<span class="als-prev">
								<button class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-button--colored mdl-color--indigo">
									<i class="material-icons">navigate_before</i>
								</button>
							</span>
							<div class="als-viewport">
								<ul class="als-wrapper">
									<?php
										include "includes/conn.php";

										$data_atual = date('Y-m-d H:i', strtotime("-5 hours"));
										$sql_pega_tutors = "SELECT * FROM db_posts WHERE post_data_postado <= '{$data_atual}' ORDER BY post_data_postado DESC LIMIT 10";
										$result_pega_tutors = $conn->query($sql_pega_tutors);
										while ($linha_pega_tutors = $result_pega_tutors->fetch_assoc()) {
											echo "<li class='als-item mdl-cell'>
												<div class='mdl-card mdl-shadow--2dp' style='margin-right:auto'>
													<a href='tutoriais.php?url=".$linha_pega_tutors['post_url']."' style='text-decoration: none;'>
														<div class='mdl-card__title mdl-card--expand mdl-color-text--blue card-post' style='background-image: url(&#39;".$linha_pega_tutors['post_capa']."&#39;)'>
															<h3 class='mdl-card__title-text'>".$linha_pega_tutors['post_title']."</h3>
														</div>
													</a>
													<div class='mdl-card__supporting-text'><b>#".$linha_pega_tutors['post_id']."</b> &#187; ".$linha_pega_tutors['post_descricao']."
													</div>
												</div>
											</li>";
										}
									?>
								</ul>
							</div>
							<span class="als-next-shadow"></span>
							<span class="als-next">
								<button class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-button--colored mdl-color--indigo">
									<i class="material-icons">navigate_next</i>
								</button>
							<span>
						</div>
					</section>
					
					<section>
						<h1 class="index-title">Últimos Wireds</h1>
						<span class="index-descricao">Novos e atualizados</span>
						<ul>
						<?php
							$sql_pega_wired = "SELECT * FROM db_wireds ORDER BY wired_atualizado DESC LIMIT 5";
							$result_pega_wired = $conn->query($sql_pega_wired);
							while ($linha_pega_wired = $result_pega_wired->fetch_assoc()) {
								echo "<li>".$linha_pega_wired['wired_name']."</li>";
							}
						?>
						</ul>
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