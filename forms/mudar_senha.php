<?php
	echo "<h1>Mudar senha</h1>";

	echo "<form action='forms/mudar.senha.post.php' method='post'>";
	if(isset($_GET['erro'])){
		if($_GET['erro'] == 1){
			echo "<p class='erro'>Os dados atuais são inválidos</p>";
		}
	}
	echo "<div class='mdl-textfield mdl-js-textfield mdl-textfield--floating-label'>
			<input class='mdl-textfield__input' type='email' name='nm_email' id='input_email' required/>
			<label class='mdl-textfield__label' for='input_email'>E-mail</label>
		</div>
		<br>
		<div class='mdl-textfield mdl-js-textfield mdl-textfield--floating-label'>
			<input class='mdl-textfield__input' type='password' name='nm_old_pass' id='input_old_pass' required/>
			<label class='mdl-textfield__label' for='input_old_pass'>Senha atual</label>
		</div>
		<br>
		<div class='mdl-textfield mdl-js-textfield mdl-textfield--floating-label'>
			<input class='mdl-textfield__input' type='password' name='nm_new_pass' id='input_new_pass' onkeyup='verSenhas()' required/>
			<label class='mdl-textfield__label' for='input_new_pass'>Nova senha</label>
		</div>
		<br>
		<div class='mdl-textfield mdl-js-textfield mdl-textfield--floating-label'>
			<input class='mdl-textfield__input' type='password' name='nm_new_pass_again' id='input_new_pass_again' onkeyup='verSenhas()' title='As senhas devem corresponderem'/>
			<label class='mdl-textfield__label' for='input_new_pass_again'>Repita a nova senha</label>
			<span class='mdl-textfield__error'>As senhas não correspondem</span>
		</div>
		<br>
		<button class='mdl-button mdl-button--raised mdl-js-button mdl-button--primary mdl-js-ripple-effect'>Mudar</button>
		</form>
		<script>
			function verSenhas() {
				var x = document.getElementById('input_new_pass').value;
				var y = document.getElementById('input_new_pass_again').value;
				if(x == y){
					document.getElementById('input_new_pass_again').novalidate = true;
					document.getElementById('input_new_pass_again').required = false;
				} else {
					document.getElementById('input_new_pass_again').pattern = x;
					document.getElementById('input_new_pass_again').novalidate = false;
					document.getElementById('input_new_pass_again').required = true;
				}
			}
		</script>";
	if(isset($_GET['done'])){
		if($_GET['done'] == 1){
			echo "<br><br><p class='done'>Senha alterada com sucesso!</p>";
		}
	}



?>