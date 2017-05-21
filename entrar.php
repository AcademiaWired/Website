<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-BR">
	<head>
		<meta charset="UTF-8">
		<title>Página de login da Academia Wired</title>
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
	    <meta name="viewport" content="initial-scale = 1.0, maximum-scale = 1.0, user-scalable = no, width = device-width">
		<meta name="theme-color" content="rgb(63,81,181)">
		<link rel="icon" sizes="192x192" href="favicon.png">
		
		<link rel="stylesheet" href="css/style.css" />
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
	<body>
		<?php include "includes/header.php" ?>
			<?php if(isset($_SESSION['logado']) != true): ?>
			<main style='padding:8px'>
				<div class="tabs-login mdl-tabs mdl-js-tabs mdl-js-ripple-effect mdl-shadow--2dp">
					<div class="mdl-tabs__tab-bar tab-bar">
						<a href="#scroll-tab-1" class="mdl-tabs__tab layout-tab is-active" id="tab-1">Logar</a>
						<a href="#scroll-tab-2" class="mdl-tabs__tab layout-tab" id="tab-2">Cadastrar</a>
					</div>
					<section class="mdl-tabs__panel tab-panel is-active" id="scroll-tab-1">
						<form method="post" action="includes/entrar.php">
							<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
								<input name="nm_login_email" class="mdl-textfield__input" type="email" id="login-user" required />
								<label class="mdl-textfield__label" for="login-user">Email</label>
							</div>
							<div class=" mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
								<input name="nm_login_pass" class="mdl-textfield__input" type="pass" id="login-pass" title="De 5 a 40 caract.: A-Z a-z 0-9 ! @ - _ = : , ." pattern="[A-Z,a-z,0-9,!,@,-,_,=,:,.]{3,40}" required autocomplete="off" />
								<label class="mdl-textfield__label" for="login-pass">Senha</label>
							</div>
							<input type="submit" class="mdl-button mdl-button--raised mdl-js-button mdl-button--primary mdl-js-ripple-effect" value="Entrar" style="margin: 10px 103.5px 0 103.5px;">
						</form>
					</section>
					<section class="mdl-tabs__panel tab-panel" id="scroll-tab-2" onblur="tab_panel_change()">
						<form method="post" action="includes/creating-account.php<?php if(isset($_GET['backto'])){ echo "&backto=".$_GET['backto'];} ?>">
							<div class=" mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
								<input class="mdl-textfield__input" type="text" name="nm_create_email" id="create-email" required/>
								<label class="mdl-textfield__label" for="create-email">Email</label>
								<span class="mdl-textfield__error">Insira um e-mail válido</span>
							</div>
							<div class=" mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
								<input class="mdl-textfield__input" type="text" name="nm_create_nick" id="create-nick" pattern="[A-Z,a-z,0-9,!,@,-,_,=,:,.]{3,15}" required/>
								<label class="mdl-textfield__label" for="create-nick">Usuário do HABBO HOTEL&#174; BR/PT</label>
								<span class="mdl-textfield__error">De 3 a 15 caract.: A-Z a-z 0-9 ! @ - _ = : , .</span>
							</div>
							<div class=" mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
								<input class="mdl-textfield__input" type="password"name="nm_create_pass" id="create-pass" pattern="[A-Z,a-z,0-9,!,@,-,_,=,:,.]{5,40}" onkeyup="verSenhas()" required/>
								<label class="mdl-textfield__label" for="create-pass">Senha</label>
								<span class="mdl-textfield__error">De 5 a 40 caract.: A-Z a-z 0-9 ! @ - _ = : , .</span>
							</div>
							<div class=" mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
								<input class="mdl-textfield__input" type="password" id="create-pass-again" onkeyup="verSenhas()" title="As senhas devem corresponderem"/>
								<label class="mdl-textfield__label" for="sample5">Repita a senha</label>
								<span class="mdl-textfield__error">As senhas não correspondem</span>
							</div>
							<script>
								function verSenhas() {
									var x = document.getElementById('create-pass').value;
									var y = document.getElementById('create-pass-again').value;
									if(x == y){
										document.getElementById('create-pass-again').novalidate = true;
										document.getElementById('create-pass-again').required = false;
									} else {
										document.getElementById('create-pass-again').pattern = x;
										document.getElementById('create-pass-again').novalidate = false;
										document.getElementById('create-pass-again').required = true;
									}
								}
							</script>
							<?php
								if(isset($_GET['erro'])) {
									if($_GET['erro'] == "existe"):
							?>
										<div class="erro">
											Já existe uma conta usando este e-mail e/ou nick.
										</div>
							<?php
									endif;
									if($_GET['erro'] == "no_user"):
							?>
										<div class="erro">
											Este usuário não existe no hotel BR/PT.
										</div>
							<?php
									endif;
								}
							?>
							<input type="submit" class="mdl-button mdl-button--raised mdl-js-button mdl-button--primary mdl-js-ripple-effect" value="Participar" style="margin: 10px 90.5px 0 90.5px;">
						</form>
					</section>
				</div>
			</main>
			<?php
				if(isset($_GET['form'])){
					if($_GET['form'] == "login" && isset($_POST['nm_login_user']) && isset($_POST['nm_login_pass'])){
						include $_SERVER['DOCUMENT_ROOT']."/includes/entrar.php";
					} elseif ($_GET['form'] == "create" && isset($_POST['nm_create_email']) && isset($_POST['nm_create_nick']) && isset($_POST['nm_create_pass'])){
						include $_SERVER['DOCUMENT_ROOT']."/includes/creating-account.php";
					}
				}
			?>
		<?php else: ?>
			<script>history.go(-1)</script>
		<?php endif ?>
		<?php include "includes/footer.php" ?>
	</body>
</html>