<?php
	if(isset($_SESSION['permissao_7']) == false){
		header("location: ../academia-wired/");
	}
?>
<h3 class="art-postheader">Adicionar uma oferta</h3>
<style>
	form#send_meu_wired span {
		line-height:35px;
	}
	form#send_meu_wired input, form#send_meu_wired select, .all {
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
	form#send_meu_wired input[type="text"], form#send_meu_wired input[type="date"] {
		max-width: 200px !important;
		text-transform: none;
	}
	form#send_meu_wired input[type="number"] {
		max-width: 80px !important;
		text-transform: none;
	}
	form#send_meu_wired select {
		max-width:121px
	}
	form#send_meu_wired input[type="submit"], form#send_meu_wired div.g-recaptcha, .all {
		margin: 10px;
	}
	form#send_meu_wired input[disabled], form#send_meu_wired select[disabled], [disabled].all {
		color:rgba(153,153,153,1) !important;
		background:rgba(204,204,204,1)
	}
	form#send_meu_wired input[required] {
		border-color:rgba(136,0,0,1) !important
	}
	form#send_meu_wired input[type="number"]:valid, form#send_meu_wired input[type="url"]:valid, form#send_meu_wired input[type="text"]:valid, form#send_meu_wired input[type="date"]:valid, form#send_meu_wired select:valid {
		border-color:rgba(0,153,0,1) !important
	}
	form#send_meu_wired input[type="submit"]:hover, :enabled.all:hover {
		cursor:pointer;
		background:#1D2762;
		color: #FFF !important;
		border: 1px solid #3244AB !important;
	}
	form#send_meu_wired b {
		line-height:normal;
	}
	table.registros td {
		max-width: 50px;
	}
</style>
<div class="overflow-auto">
	<form id="send_meu_wired" action="forms/meu_wired_change_post.php" method="post">
		<fieldset>
			<legend>Formulário</legend>
			<label for="select_tarefa"><span>Tarefa: </span></label>
			<select name="nm_tarefa" id="select_tarefa" onChange="change_type()">
				<optgroup label="Tarefa a ser executada">
					<option value="add" selected>Adicionar</option>
					<option value="mod">Modificar</option>
				</optgroup>
			</select>
			<br>
			<label for="input_id"><span>Id: </span></label>
			<input name="nm_id" id="input_id" type="number" disabled>
			<fieldset style="width:100px">
				<legend>Eu quero...</legend>
				<input id="input_selling" name="nm_shop" value="1" type="radio" required><label for="input_selling">vender</label><br>
				<input id="input_shopping" name="nm_shop" value="2" type="radio" required><label for="input_shopping">comprar</label>
			</fieldset>
			<label for="select_wired"><span>Wired: </span></label>
			<select name="nm_wired" id="select_wired">
				<?php
					include "includes/conn.php";
					
					$select_wireds_group = "SELECT * FROM db_wireds_group";
					$result_wireds_group = $conn->query($select_wireds_group);
					while($linha_group = $result_wireds_group->fetch_assoc()) {
						echo "<optgroup label='".$linha_group['wired_group_name']."'>";
						$grupo_id = $linha_group['wired_group_id'];
						$select_group_wireds = "SELECT * FROM db_wireds WHERE wired_group_id = '{$grupo_id}' ORDER BY wired_name ASC";
						$result_group_wireds = $conn->query($select_group_wireds);
						while($linha_wired = $result_group_wireds->fetch_assoc()){
							echo"<option value='".$linha_wired['wired_id_name']."'>".$linha_wired['wired_name']."</option>";
						}
						echo "</optgroup>";
					}
					unset($select_wireds_group);
					unset($result_wireds_group);
					unset($linha_group);
					unset($select_group_wireds);
					unset($result_group_wireds);
					unset($linha_wired);
					$conn->close();
				?>
			</select>
			<br>
			<label for="input_price"><span>Preço: </span></label>
			<input name="nm_price" id="input_price" type="number" min="1" required> câmbio(s)
			<br>
			<label for="input_qtd"><span>Quantidade: </span></label>
			<input name="nm_qtd" id="input_qtd" type="number" min="1" required> unidade(s)
			<br>
			<label for="input_room"><span>Quarto para efetuar a venda: </span></label><br>
			<input name="nm_room" id="input_room" type="url" required>
			<br>
			<input name="nm_sold" id="input_sold" type="checkbox" disabled>
			<label for="input_sold"><span>Vendido</span></label>
			<br>
			<p>
				<b>A oferta apenas será visível pelos próximos DOIS dias. Para renovar, volte nesta página, selecione a tarefa "MODIFICAR", insira o ID da oferta (das listadas a baixo) a ser atualizada e envie o formulário. Caso não queira mudar nenhuma informação, basta deixar os outros campos em branco.</b>
			</p>
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
			document.getElementById('input_selling').required = true;
			document.getElementById('input_shopping').required = true;
			document.getElementById('select_wired').required = true;
			document.getElementById('select_wired').disabled = false;
			document.getElementById('input_price').required = true;
			document.getElementById('input_price').disabled = false;
			document.getElementById('input_qtd').required = true;
			document.getElementById('input_qtd').disabled = false;
			document.getElementById('input_room').required = true;
			document.getElementById('input_room').disabled = false;
			document.getElementById('input_sold').required = false;
			document.getElementById('input_sold').disabled = true;
		}
		if (type == "mod"){
			document.getElementById('input_id').required = true;
			document.getElementById('input_id').disabled = false;
			document.getElementById('input_selling').required = false;
			document.getElementById('input_shopping').required = false;
			document.getElementById('select_wired').required = false;
			document.getElementById('select_wired').disabled = true;
			document.getElementById('input_price').required = false;
			document.getElementById('input_price').disabled = false;
			document.getElementById('input_qtd').required = false;
			document.getElementById('input_qtd').disabled = false;
			document.getElementById('input_room').required = false;
			document.getElementById('input_room').disabled = false;
			document.getElementById('input_sold').required = false;
			document.getElementById('input_sold').disabled = false;
		}
	}
</script>
<br>
<div class="overflow-auto" style="text-align: center;">
	<input class="all" type="button" id="input_onlyvisible-0" value="Mostrar todos os registros" onclick="window.location='?change=meu_wired'" style="display:inline-table" disabled>
	<input class="all" type="button" id="input_onlyvisible-1" value="Mostrar apenas os registros visíveis" onclick="window.location='?change=meu_wired&onlyvisible=visiveis'" style="display:inline-table">
	<input class="all" type="button" id="input_onlyvisible-2" value="Mostrar apenas os registros NÃO visíveis" onclick="window.location='?change=meu_wired&onlyvisible=invisiveis'" style="display:inline-table">
</div>
<br>
<div class="overflow-auto">
	<table class="registros" style="width:100%">
		<tr>
			<th>ID</th>
			<th>Eu quero...</th>
			<th>Data postado</th>
			<th>Wired</th>
			<th>Preço (em câmbios)</th>
			<th>Quantidade</th>
			<th>Quarto</th>
			<th>Vendido</th>
		</tr>
		<?php
			include "includes/conn.php";
			$nick = $_SESSION['nick_logado'];
			$selecao = "SELECT * FROM db_meu_wired WHERE meu_wired_user = '{$nick}'";
			if (isset($_GET['onlyvisible'])){
				$data_limite = date('Y-m-d H:i', strtotime("-2 day", strtotime(date('Y-m-d H:i', strtotime("-5 hours")))));
				if ($_GET['onlyvisible'] == "visiveis"){
					$selecao .= " AND meu_wired_data >= '{$data_limite}'";
					echo "<script>document.getElementById('input_onlyvisible-0').disabled = false; document.getElementById('input_onlyvisible-1').disabled = true; document.getElementById('input_onlyvisible-2').disabled = false;</script>";
				}
				if ($_GET['onlyvisible'] == "invisiveis"){
					$selecao .= " AND meu_wired_data <= '{$data_limite}'";
					echo "<script>document.getElementById('input_onlyvisible-0').disabled = false; document.getElementById('input_onlyvisible-1').disabled = false; document.getElementById('input_onlyvisible-2').disabled = true;</script>";
				}
			}
			$result = $conn->query($selecao);
			
			if ($result->num_rows > 0) {
				while($linha = $result->fetch_assoc()) {
					echo "<tr><td>".$linha['meu_wired_id']."</td>";
					echo "<td>".$linha['meu_wired_acao']."</td>";
					echo "<td>".date('d/m/Y H:i:s', strtotime($linha['meu_wired_data']))."</td>";
					echo "<td>".$linha['meu_wired_name']."</td>";
					echo "<td>".$linha['meu_wired_price']."</td>";
					echo "<td>".$linha['meu_wired_qtd']."</td>";
					echo "<td>".$linha['meu_wired_room']."</td>";
					echo "<td>".$linha['meu_wired_sold']."</td></tr>";
				}
			}
			$conn->close();
		?>
	</table>
</div>
<ul>
	Eu quero...:
	<li>1 = vender</li>
	<li>2 = comprar</li>
	Wired: sigla composta por TODAS as primeiras letras de cada palavra do nome do Wired. Exemplos:<br>
	<?php
		include "includes/conn.php";
		
		$select = "SELECT *, rand() FROM db_wireds ORDER BY rand() LIMIT 5";
		$resultado = $conn->query($select);
		while($line = $resultado->fetch_assoc()){
			echo "<li>".$line['wired_id_name']." = ".$line['wired_name']."</li>";
		}
		
		$conn->close();
	?>
	Vendido:
	<li>0 = não vendido</li>
	<li>1 = vendido</li>
</ul>