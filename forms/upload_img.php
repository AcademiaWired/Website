<?php
	echo "<div class='conteudo mdl-shadow--2dp' style='overflow: auto'>
		<h1>Fazer upload de imagens</h1>
		<form method='post' action='forms/upload.img.post.php' enctype='multipart/form-data'>
			<fieldset>
				<legend>Formulário para enviar imagens ao servidor</legend>
					<select name='nm_ui_dir' id='select_dir' class='mdl-button mdl-button--primary'>
						<option value='0'>img</option>
						<option value='1'>img > posts</option>
					</select>
					<br>
					<div class='mdl-textfield mdl-js-textfield mdl-textfield--floating-label'>
					<input class='mdl-textfield__input' type='file' name='nm_ui_img' id='input_ui_img'/>
				</div>
				<br>
				<button class='mdl-button mdl-button--raised mdl-js-button mdl-button--primary mdl-js-ripple-effect'>Enviar</button>
			</fieldset>
		</form>
	</div>";
?>