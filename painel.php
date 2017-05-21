<?php session_start(); ?>
<!DOCTYPE html>
<html dir="ltr" lang="pt-BR">
	<head>
		<meta charset="utf-8">
		<title>Painel de controle - Academia Wired</title>
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
		<meta name="viewport" content="initial-scale = 1.0, maximum-scale = 1.0, user-scalable = no, width = device-width">
		
		<link rel="stylesheet" href="css/style.css" media="screen">
		<link rel="stylesheet" href="css/style.livros.abas.css">
		<link rel="stylesheet" href="css/style.painel.css" media="all">
		<link rel="stylesheet" href="css/style.responsive.css" media="all">

		<link rel="stylesheet" href="css/font-awesome.min.css">
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
		<link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
		
		<script src='https://www.google.com/recaptcha/api.js'></script>
<script src="js/jquery.js"></script>
		<script src="js/script.js"></script>
		<script src="js/script.responsive.js"></script>
		<script src="js/script.livros.abas.js"></script>
	</head>
	<body id="painel">

		<?php include 'includes/header.php';?>
		<article class='art-post art-article'>
			<h2 class="art-postheader">Painel de controle</h2>
			<div class="art-postcontent art-postcontent-0 clearfix">
				<?php
					if(isset($_GET['erro'])){
						if(isset($_SESSION['logado']) == false and $_GET['erro'] ==="login") {
							echo "<div class='erro'><h3>Erro no login</h3>Login e/ou senha não confere(m).</div>";
						}
						if(isset($_SESSION['logado']) == false and $_GET['erro'] ==="existe") {
							echo "<div class='erro'><h3>Conta existente</h3>Você tentou criar uma conta onde o email ou o personagem já está/estão vinculado(s) à uma conta.</div>";
						}
					}
				?>
				<?php if(isset($_SESSION['logado']) == true): ?>
				<div id="login-true">
					<?php
						echo "<br><nav id='menu' class='menu_painel'><ul>";
						echo "<a><li>Dados de acesso</li></a>";
						if(isset($_SESSION['permissao_2'])){
							echo "<a href='?change=ouvir_juke'><li";
							if(isset($_GET['change'])){
								if($_GET['change'] == "ouvir_juke"){
									echo " style='border-bottom:3px solid red;'";
								}
							}
							echo ">Ouvir jukebox</li></a>";
						}
						if(isset($_SESSION['permissao_3'])){
echo "<a href='?change=next_tutors'><li";
							if(isset($_GET['change'])){
								if($_GET['change'] == "next_tutors"){
									echo " style='border-bottom:3px solid red;'";
								}
							}
							echo ">Gedget de próx. tutor.</li></a>";
						}
						if(isset($_SESSION['permissao_5'])){
echo "<a href='?change=blog_posts'><li";
							if(isset($_GET['change'])){
								if($_GET['change'] == "blog_posts"){
									echo " style='border-bottom:3px solid red;'";
								}
							}
							echo ">Postagens no Blog</li></a>";
						}
						if(isset($_SESSION['permissao_7'])){
echo "<a href='?change=meu_wired'><li";
							if(isset($_GET['change'])){
								if($_GET['change'] == "meu_wired"){
									echo " style='border-bottom:3px solid red;'";
								}
							}
							echo ">Publicar Meu Wired</li></a>";
						}
						if(isset($_SESSION['permissao_11'])){
echo "<a href='?change=list_wireds'><li";
							if(isset($_GET['change'])){
								if($_GET['change'] == "list_wireds"){
									echo " style='border-bottom:3px solid red;'";
								}
							}
							echo ">Lista de Wireds</li></a>";
						}
						if(isset($_SESSION['permissao_13'])){
							echo "<a href='?change=user_permission'><li";
							if(isset($_GET['change'])){
								if($_GET['change'] == "user_permission"){
									echo " style='border-bottom:3px solid red;'";
								}
							}
							echo ">Permissão dos usuários</li></a>";
						}
						echo "</ul></nav>";
						
						include "includes/conn.php";

						$seleciona = "SELECT * FROM db_users WHERE user_nick = '{$_SESSION['nick_logado']}'";
						$resultado = $conn->query($seleciona);
						$coluna = $resultado->fetch_assoc();
						
						if($coluna['user_nick_active'] > 1){
							if (isset($_SESSION['unchecked_nick'])){
								$fatal = " fatal";
							} else {
								$fatal = "";
							}
							$dias_nick = date('d/m/Y', strtotime($coluna['user_data']. ' + 7 days'));
							echo "<div class='alert".$fatal."'><h3>Personagem não confirmado</h3>Mude a missão do personagem <b>".$coluna['user_nick']."</b> para <b>".$coluna['user_nick_active']."</b> para confirmar que ele é realmente seu ou o dono lhe deu permissão para usá-lo. Você tem até o dia <b>".$dias_nick."</b> para tal tarefa até que sua conta seja <b>bloqueada</b>. Não recomendamos você confirmar em cima da hora, por conta da diferença de horário que pode existir do servidor onde o site está hospedado e o seu horário local.</div>";
unset($fatal);
						}
						if($coluna['user_email_active'] > 1){
							if (isset($_SESSION['unchecked_email'])){
								$fatal = " fatal";
							} else {
								$fatal = "";
							}
							$dias_email = date('d/m/Y', strtotime($coluna['user_data']. ' + 30 days'));
							echo "<div class='alert".$fatal."'><h3>Email não confirmado</h3>Um email de ativação da conta foi enviado para o endereço <b>".$coluna['user_email']."</b> (favor checar sua caixa de entrada e SPAN). Você tem até o dia <b>".$dias_email."</b> às <b>13 horas</b> para tal tarefa até que sua conta seja <b>bloqueada</b>. Não recomendamos você confirmar em cima da hora, por conta da diferença de horário que pode existir do servidor onde o site está hospedado e o seu horário local. <a>Enviar outro email de ativação</a>.</div>";
						}
						if(isset($_GET['backto'])){
							echo "<div class='conclu'><h3>Você está logado</h3>Você estava em outra página antes de fazer o login, se desejar voltar para lá basta <a href='".$_GET['backto']."'>clicar aqui</a>. Para visitar este Painel de Controle basta clicar no segundo ícone presente no menu flutuante. O primeiro deles serve para acessar o seu perfil aqui na Academia Wired. Já o terceiro ícone faz logout da conta.</div>";
						}

						unset($seleciona);
						unset($resultado);
						unset($coluna);
						unset($dias_nick);
						unset($dias_email);
						$conn->close();
						
						if(!isset($_GET['change'])){
							echo "<div class='painel'>";

							/*include 'includes/painel/change_pass.php';
							include 'includes/painel/change_email.php';
							if(isset($_SESSION['permissao_2'])){
								include 'includes/painel/jukebox.php';
							}
							if(isset($_SESSION['permissao_3'])){
								include 'includes/painel/link_next_tutors.php';
							}
							if(isset($_SESSION['permissao_5'])){
								include 'includes/painel/link_blog_change.php';
							}
							if(isset($_SESSION['permissao_7'])){
								include 'includes/painel/link_meu_wired_change.php';
							}
							if(isset($_SESSION['permissao_11'])){
								include 'includes/painel/link_wireds_change.php';
							}
							if(isset($_SESSION['permissao_13'])){
								include 'includes/painel/link_user_permission_change.php';
							}*/
							
							
							
							
							
							echo "</div>";
						} elseif(isset($_GET['change'])){
							if($_GET['change'] == "ouvir_juke"){
								include 'includes/painel/jukebox.php';
							}
							if($_GET['change'] == "next_tutors"){
								include 'forms/next-tutors.php';
							}
							if($_GET['change'] == "blog_posts"){
								include 'forms/blog_change.php';
							}
							if($_GET['change'] == "meu_wired"){
								include 'forms/meu_wired_change.php';
							}
							if($_GET['change'] == "list_wireds"){
								include 'forms/list_wireds_change.php';
							}
							if($_GET['change'] == "user_permission"){
								include 'forms/user_permission_change.php';
							}
						}
					?>
				</div>
				<?php else: ?>
				<?php include 'includes/painel/login-fail.php'; ?>
				<?php endif ?>
			</div>
		</article>
		<?php include 'includes/footer.php';?>
	</body>
</html>