<div id="login-fail">
	<h3>Você não está logado!</h3>
	<div class="create-account">
		<h4>Criar uma conta</h4>
		<form method="post" action="includes/painel/creating-account.php<?php if(isset($_GET['backto'])){ echo "?backto=".$_GET['backto'];} ?>">
			<label for="create-email"><span><i class="fa fa-envelope"></i></span></label><input name="nm_create_email" id="create-email" type="email" placeholder="E-mail" required><br>
			<label for="create-nick"><span><i class="fa fa-child"></i></span></label><input name="nm_create_nick" id="create-nick" type="text" placeholder="Nick do Habbo" required><br>
			<label for="create-pass"><span><i class="fa fa-key"></i></span></label><input name="nm_create_pass" id="create-pass" type="password" placeholder="Senha" required><br>
			<div class="g-recaptcha" data-sitekey="6LcEfAkTAAAAAObHLBrn5wTK2xI1BhhW8vC-nAEO"></div>
			<input type="submit" value="Criar">
		</form>
	</div>
	<div class="login">
		<h4>Fazer login</h4>
		<form method="post" action="includes/painel/login.php<?php if(isset($_GET['backto'])){ echo "?backto=".$_GET['backto'];} ?>">
			<label for="login-user"><span><i class="fa fa-child"></i></span></label><input name="nm_login_user" id="login-user" type="text" placeholder="Nick ou e-mail" required><br>
			<label for="login-pass"><span><i class="fa fa-key"></i></span></label><input name="nm_login_pass" id="login-pass" type="password" placeholder="Senha" required><br>
			<input type="submit" value="Entrar">
		</form>
	</div>
</div>