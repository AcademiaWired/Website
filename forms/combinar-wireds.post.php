<?php
	$ativador = $_POST['nm_ativador'];
	$efeito = $_POST['nm_efeito'];
	$condicao = $_POST['nm_condicao'];
	$extra = $_POST['nm_extra'];

	if (isset($ativador[0]) OR isset($efeito[0]) OR isset($condicao[0]) OR isset($extra[0])) {

		include "../includes/conn.php";
		
		$j = 0;
		$busca_combinacao = "SELECT * FROM db_wireds_combinacoes WHERE ";
		if (isset($ativador[0])) {
			$busca_combinacao .= "wireds_combinacao_ativadores = '";
			for ($i = 0; $i < count($ativador); $i++) {
				if ($i > 0) {
					$busca_combinacao .= ",";
				}
				$busca_combinacao .= $ativador[$i];
			}
			$busca_combinacao .= "'";
			$j++;
		}
		if (isset($efeito[0])) {
			if ($j > 0) {
				$busca_combinacao .= " AND ";
				$j--;
			}
			$busca_combinacao .= "wireds_combinacao_efeitos = '";
			for ($i = 0; $i < count($efeito); $i++) {
				if ($i > 0) {
					$busca_combinacao .= ",";
				}
				$busca_combinacao .= $efeito[$i];
			}
			$busca_combinacao .= "'";
			$j++;
		}
		if (isset($condicao[0])) {
			if ($j > 0) {
				$busca_combinacao .= " AND ";
				$j--;
			}
			$busca_combinacao .= "wireds_combinacao_condicoes = '";
			for ($i = 0; $i < count($condicao); $i++) {
				if ($i > 0) {
					$busca_combinacao .= ",";
				}
				$busca_combinacao .= $condicao[$i];
			}
			$busca_combinacao .= "'";
			$j++;
		}
		if (isset($extra[0])) {
			if ($j > 0) {
				$busca_combinacao .= " AND ";
				$j--;
			}
			$busca_combinacao .= "wireds_combinacao_extras = '";
			for ($i = 0; $i < count($extra); $i++) {
				if ($i > 0) {
					$busca_combinacao .= ",";
				}
				$busca_combinacao .= $extra[$i];
			}
			$busca_combinacao .= "'";
			$j++;
		}
		


		function geraMobis($wired) {
			include "../includes/conn.php";

			$busca_wired_combinacao_extra = "SELECT * FROM db_wireds WHERE wired_id_name = '{$wired}'";
			$result_wired_combinacao_extra = $conn->query($busca_wired_combinacao_extra);
			$linha_wired_combinacao_extra = $result_wired_combinacao_extra->fetch_assoc();
			$GLOBALS['div_combinacao'] .= "url(&#39;".$linha_wired_combinacao_extra['wired_mobi_png']."&#39;) center ".$GLOBALS['distancia_y']."px, ";
			$GLOBALS['distancia_y'] += $linha_wired_combinacao_extra['wired_altura'] * 32;
		}

		$result_combinacao = $conn->query($busca_combinacao);
		if ($result_combinacao->num_rows > 0){
			echo "<div class='mdl-grid'>";
			while ($linha_combinacao = $result_combinacao->fetch_assoc()) {
				





				$div_combinacao = "<div style='background: ";
				$distancia_y = 0;

				$combinacao_extras = explode(",", $linha_combinacao['wireds_combinacao_extras']);
				$combinacao_efeitos = explode(",", $linha_combinacao['wireds_combinacao_efeitos']);
				$combinacao_condicoes = explode(",", $linha_combinacao['wireds_combinacao_condicoes']);
				$combinacao_ativadores = explode(",", $linha_combinacao['wireds_combinacao_ativadores']);


				if ($combinacao_extras[0] != "") {
					for ($i_extras = 0; $i_extras < count($combinacao_extras); $i_extras++) {
						geraMobis($combinacao_extras[$i_extras]);
					}
				} if ($combinacao_efeitos[0] != "") {
					for ($i_efeitos = 0; $i_efeitos < count($combinacao_efeitos); $i_efeitos++) {
						geraMobis($combinacao_efeitos[$i_efeitos]);
					}
				} if ($combinacao_condicoes[0] != "") {
					for ($i_condicoes = 0; $i_condicoes < count($combinacao_condicoes); $i_condicoes++) {
						geraMobis($combinacao_condicoes[$i_condicoes]);
					}
				} if ($combinacao_ativadores[0] != "") {
					for ($i_ativadores = 0; $i_ativadores < count($combinacao_ativadores); $i_ativadores++) {
						geraMobis($combinacao_ativadores[$i_ativadores]);
					}
				}
				$distancia_y += 29;
				$div_combinacao .= "; height: ".$distancia_y."px; width:68px; background-repeat:no-repeat; margin: 0 auto;'></div>";

				echo "<div class='mdl-cell mdl-cell--3-col mdl-cell--4-col-tablet mdl-cell--12-col-phone mdl-card mdl-shadow--2dp'><div>#".$linha_combinacao['wireds_combinacao_id']." <span class='";
				if ($linha_combinacao['wireds_combinacao_funciona'] == 0) {
					echo "red'>NÃO funciona";
				} else {
					echo "green'>FUNCIONA";
				}
				echo "</span></div><hr>";
				echo $div_combinacao;
				echo "<p>".$linha_combinacao['wireds_combinacao_funcao']."</p></div>";






			}
			echo "</div>";
		}
	} else {
		echo "<p class='emoji e11 e-40pt text-20pt esps-110px' style='text-align: center'> Selecione a cima os Wireds que deseja combinar </p>";
	}
?>