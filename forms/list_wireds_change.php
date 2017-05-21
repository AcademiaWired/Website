<?php
	if(isset($_SESSION['permissao_11']) == false){
		header("location: ../academia-wired/");
	}
?>
<h3 class="art-postheader">Modificar a lista de Wireds</h3>
<style>
	form#send_wired span {
		line-height:35px;
	}
	form#send_wired input, form#send_wired textarea, form#send_wired select, .all {
		background: #FFFFFF;
		border-radius: 2px;
		-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
		box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
		border: 1px solid #cccccc !important;
		padding:4px !important;
		height: 30px;
		-webkit-box-sizing: border-box;
		-moz-box-sizing: border-box;
		box-sizing: border-box;
		color: #1D2762 !important;
		font-size: 13px;
		font-family: Verdana, Geneva, Arial, Helvetica, Sans-Serif;
		font-weight: normal;
		font-style: normal;
	}
	form#send_wired input[type="text"], form#send_wired input[type="date"] {
		max-width: 200px !important;
		text-transform: none;
	}
	form#send_wired input[type="number"] {
		max-width: 80px !important;
		text-transform: none;
	}
	form#send_wired select {
		max-width:121px
	}
	form#send_wired input[type="submit"], form#send_wired div.g-recaptcha, .all {
		margin: 10px;
	}
	form#send_wired input[disabled], form#send_wired textarea[disabled], form#send_wired select[disabled], [disabled].all {
		color:rgba(153,153,153,1) !important;
		background:rgba(204,204,204,1)
	}
	form#send_wired input[required], form#send_wired textarea[required] {
		border-color:rgba(136,0,0,1) !important
	}
	form#send_wired input[type="number"]:valid, form#send_wired textarea:valid, form#send_wired input[type="url"]:valid, form#send_wired input[type="text"]:valid, form#send_wired input[type="date"]:valid, form#send_wired select:valid {
		border-color:rgba(0,153,0,1) !important
	}
	form#send_wired input[type="submit"]:hover, :enabled.all:hover {
		cursor:pointer;
		background:#1D2762;
		color: #FFF !important;
		border: 1px solid #3244AB !important;
	}
	form#send_wired b {
		line-height:normal;
	}
	table.registros td {
		max-width: 50px;
	}
</style>
<div class="overflow-auto">
	<form id="send_wired" action="forms/list_wireds_change_post.php" method="post">
		<fieldset>
			<legend>Formulário</legend>
			<label for="select_tarefa"><span>Tarefa: </span></label>
			<select name="nm_tarefa" id="select_tarefa" onChange="change_type()">
				<optgroup label="Tarefa a ser executada">
					<option value="add" selected>Adicionar</option>
					<option value="mod">Modificar</option>
					<option value="exc">Excluir</option>
				</optgroup>
			</select>
			<br>
			<label for="input_id"><span>Id: </span></label>
			<input name="nm_id" id="input_id" type="number" min="1" disabled>
            <br>
			<label for="input_sigla"><span>Sigla do Wired: </span></label>
            <input name="nm_sigla" id="input_sigla" type="text" required>
			<br>
			<label for="select_type"><span>Tipo: </span></label>
            <select name="nm_type" id="select_type">
				<?php
					include "includes/conn.php";
					
					$select_wireds_group = "SELECT * FROM db_wireds_group";
					$result_wireds_group = $conn->query($select_wireds_group);
					while($linha_group = $result_wireds_group->fetch_assoc()) {
						echo "<option value='".$linha_group['wired_group_id']."'>".$linha_group['wired_group_name']."</option>";
					}
					unset($select_wireds_group);
					unset($result_wireds_group);
					unset($linha_group);
					$conn->close();
				?>
			</select>
			<br>
			<label for="input_name"><span>Nome: </span></label>
			<input name="nm_name" id="input_name" type="text" required>
			<br>
			<label for="input_ico"><span>Imagem do ícone: </span></label><br>
			<input name="nm_ico" id="input_ico" type="url" required>
			<br>
			<label for="input_mobi_png"><span>Imagem da mobília: </span></label><br>
			<input name="nm_mobi_png" id="input_mobi_png" type="url">
			<br>
			<label for="input_mobi_gif"><span>GIF da mobília: </span></label><br>
			<input name="nm_mobi_gif" id="input_mobi_gif" type="url">
			<br>
			<label for="input_menu_web"><span>GIF do menu na WEB: </span></label><br>
			<input name="nm_menu_web" id="input_menu_web" type="url">
			<br>
			<label for="input_menu_app"><span>GIF do menu no APP: </span></label><br>
			<input name="nm_menu_app" id="input_menu_app" type="url">
			<br>
			<label for="input_descricao"><span>Descrição: </span></label><br>
			<input name="nm_descricao" id="input_descricao" type="text" required>
			<br>
			<label for="input_price_official"><span>Preço oficial: </span></label><br>
			<input name="nm_price_official" id="input_price_official" type="number" min="1" required>
			<br>
			<label for="textarea_body"><span>Texto para o tutorial: </span></label><br>
			<textarea name="nm_body" id="textarea_body"></textarea>
			<br>
			<div class="g-recaptcha" data-sitekey="6LcEfAkTAAAAAObHLBrn5wTK2xI1BhhW8vC-nAEO"></div>
			<input type="submit" value="Enviar">
		</fieldset>
	</form>
</div>
<script>
	function change_type() {
		var type = document.getElementById('select_tarefa').value;
		if (type == "add"){
			document.getElementById('input_id').required = false;
			document.getElementById('input_id').disabled = true;
			document.getElementById('input_sigla').required = true;
			document.getElementById('input_sigla').disabled = false;
			document.getElementById('select_type').required = true;
			document.getElementById('select_type').disabled = false;
			document.getElementById('input_name').required = true;
			document.getElementById('input_name').disabled = false;
			document.getElementById('input_ico').required = true;
			document.getElementById('input_ico').disabled = false;
			document.getElementById('input_mobi_png').required = false;
			document.getElementById('input_mobi_png').disabled = false;
			document.getElementById('input_mobi_gif').required = false;
			document.getElementById('input_mobi_gif').disabled = false;
			document.getElementById('input_menu_web').required = false;
			document.getElementById('input_menu_web').disabled = false;
			document.getElementById('input_menu_app').required = false;
			document.getElementById('input_menu_app').disabled = false;
			document.getElementById('input_descricao').required = true;
			document.getElementById('input_descricao').disabled = false;
			document.getElementById('input_price_official').required = true;
			document.getElementById('input_price_official').disabled = false;
			document.getElementById('textarea_body').required = false;
			document.getElementById('textarea_body').disabled = false;
		}
		if (type == "mod"){
			document.getElementById('input_id').required = true;
			document.getElementById('input_id').disabled = false;
			document.getElementById('input_sigla').required = true;
			document.getElementById('input_sigla').disabled = false;
			document.getElementById('select_type').required = false;
			document.getElementById('select_type').disabled = false;
			document.getElementById('input_name').required = false;
			document.getElementById('input_name').disabled = false;
			document.getElementById('input_ico').required = false;
			document.getElementById('input_ico').disabled = false;
			document.getElementById('input_mobi_png').required = false;
			document.getElementById('input_mobi_png').disabled = false;
			document.getElementById('input_mobi_gif').required = false;
			document.getElementById('input_mobi_gif').disabled = false;
			document.getElementById('input_menu_web').required = false;
			document.getElementById('input_menu_web').disabled = false;
			document.getElementById('input_menu_app').required = false;
			document.getElementById('input_menu_app').disabled = false;
			document.getElementById('input_descricao').required = false;
			document.getElementById('input_descricao').disabled = false;
			document.getElementById('input_price_official').required = false;
			document.getElementById('input_price_official').disabled = false;
			document.getElementById('textarea_body').required = false;
			document.getElementById('textarea_body').disabled = false;
		}
		if (type == "exc"){
			document.getElementById('input_id').required = true;
			document.getElementById('input_id').disabled = false;
			document.getElementById('input_sigla').required = false;
			document.getElementById('input_sigla').disabled = true;
			document.getElementById('select_type').required = false;
			document.getElementById('select_type').disabled = true;
			document.getElementById('input_name').required = false;
			document.getElementById('input_name').disabled = true;
			document.getElementById('input_ico').required = false;
			document.getElementById('input_ico').disabled = true;
			document.getElementById('input_mobi_png').required = false;
			document.getElementById('input_mobi_png').disabled = true;
			document.getElementById('input_mobi_gif').required = false;
			document.getElementById('input_mobi_gif').disabled = true;
			document.getElementById('input_menu_web').required = false;
			document.getElementById('input_menu_web').disabled = true;
			document.getElementById('input_menu_app').required = false;
			document.getElementById('input_menu_app').disabled = true;
			document.getElementById('input_descricao').required = false;
			document.getElementById('input_descricao').disabled = true;
			document.getElementById('input_price_official').required = false;
			document.getElementById('input_price_official').disabled = true;
			document.getElementById('textarea_body').required = false;
			document.getElementById('textarea_body').disabled = true;
		}
	}
</script>
<br>
<div class="overflow-auto">
	<table class="registros" style="width:100%">
		<tr>
			<th>*id</th>
			<th>*id_name</th>
			<th>*group_id</th>
			<th>*name</th>
			<th>*ico</th>
			<th>*mobi_png</th>
			<th>*mobi_gif</th>
			<th>*menu_web</th>
			<th>*menu_app</th>
			<th>*descricao</th>
			<th>*official_price</th>
			<th>*aw_price_medio</th>
			<th>*body_tutor</th>
		</tr>
		<?php
			include "includes/conn.php";
			$selecao = "SELECT * FROM db_wireds";
			$result = $conn->query($selecao);
			
			if ($result->num_rows > 0) {
				while($linha = $result->fetch_assoc()) {
					echo "<tr><td>".$linha['wired_id']."</td>";
					echo "<td>".$linha['wired_id_name']."</td>";
					echo "<td>".$linha['wired_group_id']."</td>";
					echo "<td>".$linha['wired_name']."</td>";
					echo "<td>".$linha['wired_ico']."</td>";
					echo "<td>".$linha['wired_mobi_png']."</td>";
					echo "<td>".$linha['wired_mobi_gif']."</td>";
					echo "<td>".$linha['wired_menu_web']."</td>";
					echo "<td>".$linha['wired_menu_app']."</td>";
					echo "<td>".$linha['wired_descricao']."</td>";
					echo "<td>".$linha['wired_official_price']."</td>";
					echo "<td>".$linha['wired_aw_price_medio']."</td>";
					echo "<td>".$linha['wired_body_tutor']."</td></tr>";
				}
			}
			$conn->close();
		?>
	</table>
</div>