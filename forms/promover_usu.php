<?php

	echo "<div class='conteudo mdl-shadow--2dp'><h1>Promover usuários</h1>";
	include "includes/conn.php";

	// FORMULÁRIO DE USUÁRIOS COM PERMISSÃO


	echo "<form method='post' action='forms/promover.usu.post.php'><fieldset><legend>Formulário de promoção/rebaixamento de usuários</legend><select name='nm_user' id='select_user' class='mdl-button mdl-button--primary'>";
	
	$busca = "SELECT * FROM db_users ORDER BY user_nick ASC";
	$resposta = $conn->query($busca);
	while($linha_busca = $resposta->fetch_assoc()){
		echo "<option value='".$linha_busca['user_id']."'>".$linha_busca['user_nick']."</option>";
	}
	echo "</select>";
	$busca_perm = "SELECT * FROM db_permissoes ORDER BY permissao_value ASC";
	$respota_perm = $conn->query($busca_perm);
	while($linha_perm = $respota_perm->fetch_assoc()){
		echo "<br><label class='mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect' for='checkbox_".$linha_perm['permissao_id']."'><input class='mdl-checkbox__input' name='nm_perm[]' value='".$linha_perm['permissao_value']."' id='checkbox_".$linha_perm['permissao_id']."' type='checkbox'><span class='mdl-checkbox__label'>".$linha_perm['permissao_descr']."</span></label>";
	}
	echo "<br><button class='mdl-button mdl-button--raised mdl-js-button mdl-button--primary mdl-js-ripple-effect'>Enviar</button></fieldset></form>";


	// DADOS DE USUÁRIOS COM PERMISSÃO


	
	echo "<div style='overflow: auto'><table class='mdl-data-table mdl-js-data-table mdl-shadow--3dp'><thead><tr><th>*id</th><th class='mdl-data-table__cell--non-numeric'>*nick</th><th>*permissao</th></tr></thead><tbody>";
	$selecao = "SELECT * FROM db_users ORDER BY user_permissao DESC";
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
			echo "<td class='mdl-data-table__cell--non-numeric'>".$linha['user_nick']."</td>";
			echo "<td>1";
			if($resposta[0] != 1){
				for($i = 0; $i < count($resposta); $i++){
					echo " &#215; ".$resposta[$i];
				}
			}
			echo " &#61; <b>".$linha['user_permissao']."</b></td></tr>";
		}
	}
	unset($selecao);
	echo "</tbody></table></div></div>";


	// FORMULÁRIO DAS PERMISSÕES NO BANCO DE DADOS


	echo "<div class='conteudo mdl-shadow--2dp' style='overflow: auto'><h1>Permissões existentes</h1>
		<form method='post' action='forms/promover.usu.post.php'>
			<fieldset>
				<legend>Formulário para adicionar/editar/excluir permissões</legend>
				<div class='mdl-textfield mdl-js-textfield mdl-textfield--floating-label'>
					<input class='mdl-textfield__input' type='number' name='nm_id' id='input_id' min='1'/>
					<label class='mdl-textfield__label' for='input_id'>ID</label>
				</div>
	            <br>
				<div class='mdl-textfield mdl-js-textfield mdl-textfield--floating-label'>
					<input class='mdl-textfield__input' type='number' name='nm_value' id='input_value' min='1'/>
					<label class='mdl-textfield__label' for='input_value'>Um número primo</label>
				</div>
				<br>
				<div class='mdl-textfield mdl-js-textfield mdl-textfield--floating-label'>
					<input class='mdl-textfield__input' type='text' name='nm_descr' id='input_descr'/>
					<label class='mdl-textfield__label' for='input_descr'>Descrição</label>
				</div>
				<br>
				<button class='mdl-button mdl-button--raised mdl-js-button mdl-button--primary mdl-js-ripple-effect'>Enviar</button>
			</fieldset>
		</form>";


	// DADOS DAS PERMISSÕES NO BANCO DE DADOS


	echo "<div style='overflow: auto'><table  class='mdl-data-table mdl-js-data-table mdl-shadow--3dp'><thead><tr><th>*id</th><th>*value</th><th class='mdl-data-table__cell--non-numeric'>*descr</th></tr></thead><tbody>";
	$selecao_perm = "SELECT * FROM db_permissoes ORDER BY permissao_value ASC";
	$result_perm = $conn->query($selecao_perm);
	
	if ($result_perm->num_rows > 0) {
		while($linha_perm = $result_perm->fetch_assoc()) {
			echo "<tr><td>".$linha_perm['permissao_id']."</td>";
			echo "<td>".$linha_perm['permissao_value']."</td>";
			echo "<td class='mdl-data-table__cell--non-numeric'>".$linha_perm['permissao_descr']."</td></tr>";
		}
	}
	$conn->close();
	echo "</tbody></table></div></div>";


	// FORMULÁRIO PARA CALCULAR UM NÚMERO PRIMO


	echo "<div class='conteudo mdl-shadow--2dp'>
		<h1>Números primos</h1>
		<form method='get'>
			<fieldset>
				<legend>Formulário para calcular números primos</legend>
				<div class='mdl-textfield mdl-js-textfield mdl-textfield--floating-label'>
					<input class='mdl-textfield__input' type='number' name='primo' id='id_primo' min='3'/>
					<label class='mdl-textfield__label' for='id_primo'>Valor máximo</label>
				</div>
				<br>
				<div class='mdl-layout-spacer'></div>
				<button class='mdl-button mdl-button--raised mdl-js-button mdl-button--primary mdl-js-ripple-effect'>Calcular</button>
			</fieldset>
		</form>";


	// CÓDIGOS GET PARA CALCULAR UM NÚMERO PRIMO


	if(isset($_GET['primo'])){
		if($_GET['primo'] < 1000){
			echo "<table class='mdl-data-table mdl-js-data-table mdl-shadow--3dp is-upgraded'><thead><tr><th>Ordem</th><th>Número primo</th></tr></thead><tbody><tr><td>1º</td><td>2</td></tr>";
			$k = 2;
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
					echo "<tr><td>".$k."º</td><td>".$n."</td></tr>";
					$k++;
				}
			}
			echo "</table>";
		} else {
			echo "Você realmente precisa disso tudo? :O";
		}
	}

	echo "</div>";
?>