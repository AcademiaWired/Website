<?php 
	session_start();
	
	if(!isset($_SESSION['view_meu_wired'])){
		$_SESSION['view_meu_wired'] = 0;
	}

	if(!isset($_SESSION['logado'])){
		header("location: ..");
	}
?>
<!DOCTYPE html>
<html lang="pt-BR">
	<head>
		
		<!--
		<link rel="stylesheet" href="offline/material.min.css">
		<script src="offline/material.min.js"></script>
		-->
		<link rel="stylesheet" href="https://storage.googleapis.com/code.getmdl.io/1.0.2/material.indigo-blue.min.css" /> 
		<script src="https://storage.googleapis.com/code.getmdl.io/1.0.2/material.min.js"></script>
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">


		<meta charset="UTF-8">
		<title>Painel da Academia Wired</title>
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
	    <meta name="viewport" content="initial-scale = 1.0, maximum-scale = 1.0, user-scalable = no, width = device-width">
		<meta name="theme-color" content="rgb(63,81,181)">
		<link rel="icon" sizes="192x192" href="favicon.png">
		
		<link rel="stylesheet" href="css/style.css" />
		<link rel="stylesheet" href="css/abas.painel.css" />
	    <script src="js/script.js"></script>
		
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	</head>
	<body>
		<?php include "includes/header.php" ?>
				<main class="mdl-grid">
					<div class='lista-abas amimacao-flip mdl-cell mdl-cell--4-col'>
						<?php
							echo "<input type='radio' name='lista-abas' id='aba-1' class='aba-1' ";
							if (!isset($_GET['aba'])) {
								echo "checked";
							}
							echo "><label id='label-1' class='mdl-button mdl-button--raised mdl-js-button mdl-button--primary mdl-js-ripple-effect abas' for='aba-1'><span><span>Mudar senha</span></span></label>";
							$i = 2;
							if(isset($_SESSION['permissao_2'])){
								echo "<input type='radio' name='lista-abas' id='aba-".$i."' class='aba-".$i."' ";
								if (isset($_GET['aba'])) {
									if ($_GET['aba'] == "promover_usuarios") {
										echo "checked";
									}
								}
								echo "><label id='label-".$i."' class='mdl-button mdl-button--raised mdl-js-button mdl-button--primary mdl-js-ripple-effect abas' for='aba-".$i."'><span><span>Promover usuários</span></span></label>";
								$i++;
							}
							if(isset($_SESSION['permissao_3'])){
								echo "<input type='radio' name='lista-abas' id='aba-".$i."' class='aba-".$i."' ";
								if (isset($_GET['aba'])) {
									if ($_GET['aba'] == "gerenciador_de_contas") {
										echo "checked";
									}
								}
								echo "><label id='label-".$i."' class='mdl-button mdl-button--raised mdl-js-button mdl-button--primary mdl-js-ripple-effect abas' for='aba-".$i."'><span><span>Gerenciador de contas</span></span></label>";
								$i++;
							}
							if(isset($_SESSION['permissao_5'])){
								echo "<input type='radio' name='lista-abas' id='aba-".$i."' class='aba-".$i."' ";
								if (isset($_GET['aba'])) {
									if ($_GET['aba'] == "gerenciador_de_postagens") {
										echo "checked";
									}
								}
								echo "><label id='label-".$i."' class='mdl-button mdl-button--raised mdl-js-button mdl-button--primary mdl-js-ripple-effect abas' for='aba-".$i."'><span><span>Gerenciador de postagens</span></span></label>";
								$i++;
							}

							function marca_aba(){

							}
						?>

						<ul>
							<?php
								echo "<li class='aba-1'><div class='conteudo mdl-shadow--2dp'>";

								include "forms/mudar_senha.php";

								echo "</div></li>";
								$j = 2;
								if(isset($_SESSION['permissao_2'])){
									echo "<li class='aba-".$j."'>";

									include "forms/promover_usu.php";

									echo "</li>";
									$j++;
								}
								if(isset($_SESSION['permissao_3'])){
									echo "<li class='aba-".$j."'>";

									include "forms/gerencia_cont.php";

									echo "</li>";
									$j++;
								}
								if(isset($_SESSION['permissao_5'])){
									echo "<li class='aba-".$j."'>";

									include "forms/gerencia_blog.php";

									echo "</li>";
									$j++;
								}
							?>
							<!--<li class='aba-2'>
								<div class="conteudo">abc2</div>
							</li>
							<li class='aba-3'>
								<div class="conteudo">abc3</div>
							</li>
							<li class='aba-4'>
								<div class="conteudo">abc4</div>
							</li>-->
						</ul>
					</div>
				</main>
		<?php include "includes/footer.php" ?>
	</body>
</html>