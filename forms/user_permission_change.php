<?php
	if(isset($_SESSION['permissao_13']) == false){
		header("location: ../academia-wired/");
	}
?>
<style>
	form#user_permission span {
		line-height:35px;
	}
	form#user_permission input, form#user_permission textarea, form#user_permission select, .all {
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
	form#user_permission input[type="text"], form#user_permission input[type="date"] {
		max-width: 200px !important;
		text-transform: none;
	}
	form#user_permission input[type="number"] {
		max-width: 80px !important;
		text-transform: none;
	}
	form#user_permission select {
		max-width:121px
	}
	form#user_permission input[type="submit"], form#user_permission div.g-recaptcha, .all {
		margin: 10px;
	}
	form#user_permission input[disabled], form#user_permission textarea[disabled], form#user_permission select[disabled], [disabled].all {
		color:rgba(153,153,153,1) !important;
		background:rgba(204,204,204,1)
	}
	form#user_permission input[required], form#user_permission textarea[required] {
		border-color:rgba(136,0,0,1) !important
	}
	form#user_permission input[type="number"]:valid, form#user_permission textarea:valid, form#user_permission input[type="url"]:valid, form#user_permission input[type="text"]:valid, form#user_permission input[type="date"]:valid, form#user_permission select:valid {
		border-color:rgba(0,153,0,1) !important
	}
	form#user_permission input[type="submit"]:hover, :enabled.all:hover {
		cursor:pointer;
		background:#1D2762;
		color: #FFF !important;
		border: 1px solid #3244AB !important;
	}
	form#user_permission b {
		line-height:normal;
	}
	table.registros td {
		max-width: 50px;
	}
</style>
<h3 class="art-postheader">Modificar as permissões dos usuários</h3>
<div class="overflow-auto">
	<form id="user_permission" action="forms/user_permission_change_post.php" method="post">
		<fieldset>
			<legend>Formulário</legend>
			<label for="select_user"><span>Usuário: </span></label>
			<select name="nm_user" id="select_user">
				<?php
					include "includes/conn.php";
					
					$busca = "SELECT * FROM db_users ORDER BY user_nick ASC";
					$resposta = $conn->query($busca);
					while($linha_busca = $resposta->fetch_assoc()){
						echo "<option value='".$linha_busca['user_id']."'>".$linha_busca['user_nick']."</option>";
					}
					$conn->close();
				?>
			</select>
            <?php
				include "includes/conn.php";
				$busca_perm = "SELECT * FROM db_permissoes ORDER BY permissao_value ASC";
				$respota_perm = $conn->query($busca_perm);
				while($linha_perm = $respota_perm->fetch_assoc()){
					echo "<br><input name='nm_perm[]' value='".$linha_perm['permissao_value']."' id='checkbox_".$linha_perm['permissao_id']."' type='checkbox'><label for='checkbox_".$linha_perm['permissao_id']."'><span> ".$linha_perm['permissao_descr']."</span></label>";
				}
				$conn->close();
			?>
            <br>
			<div class="g-recaptcha" data-sitekey="6LcEfAkTAAAAAObHLBrn5wTK2xI1BhhW8vC-nAEO"></div>
			<input type="submit" value="Enviar">
		</fieldset>
	</form>
</div>
<br>
<div class="overflow-auto">
	<table class="registros" style="width:100%">
		<tr>
			<th>*id</th>
			<th>*nick</th>
			<th>*permissao</th>
		</tr>
		<?php
			include "includes/conn.php";
			$selecao = "SELECT * FROM db_users";
			$result = $conn->query($selecao);
			
			if ($result->num_rows > 0) {
				function fatorarando($numero) {  
					// $numero > 2
				    $x=2 ;
					if($numero == 1){
						return "1";
					}
				    while($numero != 1) {
				        if($numero % $x == 0) {
							// Vetor recebendo a variavel $x
							$vet[] = $x;
							$numero = $numero/$x;
						} else {
							$x++;
						}
					}
					return $vet;
				}
				while($linha = $result->fetch_assoc()) {
					$num = $linha['user_permissao'];
					$resposta = fatorarando($num);
					echo "<tr><td>".$linha['user_id']."</td>";
					echo "<td>".$linha['user_nick']."</td>";
					echo "<td>1 ";
					for($i = 0; $i < count($resposta); $i++){
						echo " &#215; ".$resposta[$i];
					}
					echo " &#61; <b>".$linha['user_permissao']."</b></td></tr>";
				}
			}
			unset($selecao);
			$conn->close();
		?>
	</table>
</div>






<h3 class="art-postheader">Modificar as permissões do banco de dados</h3>
<div class="overflow-auto">
	<form id="user_permission" action="forms/db_permission_change_post.php" method="post">
		<fieldset>
			<legend>Formulário</legend>
			<label for="select_tarefa"><span>Tarefa: </span></label>
			<select name="nm_tarefa" id="select_tarefa" onChange="change_type()">
				<optgroup label="Tarefa a ser executada">
					<option value="add">Adicionar</option>
					<option value="mod">Modificar</option>
					<option value="exc">Excluir</option>
				</optgroup>
			</select>
			<br>
			<label for="input_id"><span>Id: </span></label>
			<input name="nm_id" id="input_id" type="number" min="1" disabled>
            <br>
			<label for="input_value"><span>Valor (apenas números primos): </span></label>
            <input name="nm_value" id="input_value" type="number" required>
			<br>
			<label for="input_descr"><span>Descrição (o que aparece ali em cima no outro formulário): </span></label>
			<input name="nm_descr" id="input_descr" type="text" required>
			<br>
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
			document.getElementById('input_value').required = true;
			document.getElementById('input_value').disabled = false;
			document.getElementById('input_descr').required = true;
			document.getElementById('input_descr').disabled = false;
		}
		if (type == "mod"){
			document.getElementById('input_id').required = true;
			document.getElementById('input_id').disabled = false;
			document.getElementById('input_value').required = false;
			document.getElementById('input_value').disabled = true;
			document.getElementById('input_descr').required = false;
			document.getElementById('input_descr').disabled = false;
		}
		if (type == "exc"){
			document.getElementById('input_id').required = true;
			document.getElementById('input_id').disabled = false;
			document.getElementById('input_value').required = false;
			document.getElementById('input_value').disabled = true;
			document.getElementById('input_descr').required = false;
			document.getElementById('input_descr').disabled = true;
		}
	}
</script>
<br>
<div class="overflow-auto">
	<table class="registros" style="width:100%">
		<tr>
			<th>*id</th>
			<th>*value</th>
			<th>*descr</th>
		</tr>
		<?php
			include "includes/conn.php";
			$selecao_perm = "SELECT * FROM db_permissoes ORDER BY permissao_value ASC";
			$result_perm = $conn->query($selecao_perm);
			
			if ($result_perm->num_rows > 0) {
				while($linha_perm = $result_perm->fetch_assoc()) {
					echo "<tr><td>".$linha_perm['permissao_id']."</td>";
					echo "<td>".$linha_perm['permissao_value']."</td>";
					echo "<td>".$linha_perm['permissao_descr']."</td></tr>";
				}
			}
			$conn->close();
		?>
	</table>
</div>
<form action="" method="get"><label for="id_primo">Calcular número primo até: </label><input type="text" name="change" value="user_permission" style="display:none" /><input name="primo" id="id_primo" type="number" min="3" style="width:100px" /><input type="submit" value="Calcular" /></form>
<?php
if(isset($_GET['primo'])){
	if($_GET['primo'] < 1000){
		echo "<ol><li>2</li>";
		for ($n = 3; $n <= $_GET['primo']; ($n = $n + 2)) { 
			$rut = sqrt($n);
			$primo = true;
			for ($x = 3; $x <= $rut; ($x = $x + 2)) { 
				if ($n % $x == 0) { 
		//			echo " rut " . $rut . " x " . $x . " n " . $n; 
					$primo = false;
					break;
				}
			}
			if ($primo) {
				echo "<li>".$n."</li>";
			}
		}
		echo "</ol>";
	} else {
		echo "Você realmente precisa disso tudo? :O";
	}
}
?>