<?php
	session_start();

	$data_limite = date('Y-m-d H:i:s', strtotime("+2 minutes", strtotime($_SESSION['pedido_data'])));
	$data_atual = date('Y-m-d H:i:s', strtotime("-5 hours"));

	if ($data_limite < $data_atual) {
		$ativador = $_POST['nm_ativador'];
		$efeito = $_POST['nm_efeito'];
		$condicao = $_POST['nm_condicao'];
		$extra = $_POST['nm_extra'];
		if(isset($_SESSION['nick_logado'])) {
			$usuario = $_SESSION['nick_logado'];
		} else {
			$usuario = "";
		}

		

		include "../includes/conn.php";
		
		$j = 0;
		$insere_pedido = "INSERT INTO db_wireds_combinacoes_pedidos (wireds_combinacoes_pedido_usuario, ";
		if (isset($ativador[0])) {
			$insere_pedido .= "wireds_combinacoes_pedido_ativadores";
			$j++;
		}
		if (isset($efeito[0])) {
			if ($j > 0) {
				$insere_pedido .= ", ";
				$j--;
			}
			$insere_pedido .= "wireds_combinacoes_pedido_efeitos";
			$j++;
		}
		if (isset($condicao[0])) {
			if ($j > 0) {
				$insere_pedido .= ", ";
				$j--;
			}
			$insere_pedido .= "wireds_combinacoes_pedido_condicoes";
			$j++;
		}
		if (isset($extra[0])) {
			if ($j > 0) {
				$insere_pedido .= ", ";
				$j--;
			}
			$insere_pedido .= "wireds_combinacoes_pedido_extras";
			$j++;
		}

		$insere_pedido .= ") VALUES ('{$usuario}', ";

		$j = 0;
		if (isset($ativador[0])) {
			if ($j > 0) {
				$insere_pedido .= ", ";
				$j--;
			}
			$insere_pedido .= "'";
			for ($i = 0; $i < count($ativador); $i++) {
				if ($i > 0) {
					$insere_pedido .= ",";
				}
				$insere_pedido .= $ativador[$i];
			}
			$insere_pedido .= "'";
			$j++;
		}
		if (isset($efeito[0]))  {
			if ($j > 0) {
				$insere_pedido .= ", ";
				$j--;
			}
			$insere_pedido .= "'";
			for ($i = 0; $i < count($efeito); $i++) {
				if ($i > 0) {
					$insere_pedido .= ",";
				}
				$insere_pedido .= $efeito[$i];
			}
			$insere_pedido .= "'";
			$j++;
		}
		if (isset($condicao[0])) {
			if ($j > 0) {
				$insere_pedido .= ", ";
				$j--;
			}
			$insere_pedido .= "'";
			for ($i = 0; $i < count($condicao); $i++) {
				if ($i > 0) {
					$insere_pedido .= ",";
				}
				$insere_pedido .= $condicao[$i];
			}
			$insere_pedido .= "'";
			$j++;
		}
		if (isset($extra[0])) {
			if ($j > 0) {
				$insere_pedido .= ", ";
				$j--;
			}
			$insere_pedido .= "'";
			for ($i = 0; $i < count($extra); $i++) {
				if ($i > 0) {
					$insere_pedido .= ",";
				}
				$insere_pedido .= $extra[$i];
			}
			$insere_pedido .= "'";
			$j++;
		}
		$insere_pedido .= ")";

		$result_pedido = $conn->query($insere_pedido);



		$_SESSION['pedido_data'] = date('Y-m-d H:i:s', strtotime("-5 hours"));
		echo "1";

	} else {
		echo "0";
	}
?>