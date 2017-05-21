<?php

	include "../includes/conn.php";

	// CÓDIGOS POST PARA RECEBER OS USUÁRIOS COM PERMISSÃO


	if(isset($_POST['nm_user'])){

		$user = $_POST['nm_user'];
		if(isset($_POST['nm_perm'])){
			$new_perm = array_product($_POST['nm_perm']);
		} else {
			$new_perm = 1;
		}
		
		$item = "UPDATE db_users SET user_permissao = '{$new_perm}' WHERE user_id = '{$user}'";
	
		if ($conn->query($item) === TRUE) {
			header("location: ../painel.php");
		} else {
			echo "Ocorreu um erro inesperado: '".$conn->error."'. Tente novamente.";
		}
	}


	// CÓDIGOS POST PARA RECEBER AS NOVAS PERMISSÕES


	if(isset($_POST['nm_id']) OR isset($_POST['nm_value']) OR isset($_POST['nm_descr'])){
		if ($_POST['nm_id'] == ""){
			$tarefa = "add";
		} elseif ($_POST['nm_id'] != ""){
			if($_POST['nm_value'] == "" AND $_POST['nm_descr'] == ""){
				$tarefa = "exc";
			} elseif ($_POST['nm_value'] != "" OR $_POST['nm_descr'] != ""){
				$tarefa = "mod";
			}
		}

		if($tarefa == "exc"){
			$id = $_POST['nm_id'];
			$item = "DELETE FROM db_permissoes WHERE permissao_id='{$id}'";
		} else {
			$value = $_POST['nm_value'];
			$descr = $_POST['nm_descr'];
			if($tarefa == "add"){
				$verifica = "SELECT * FROM db_permissoes WHERE permissao_value = '{$value}'";
				$resultado = $conn->query($verifica);
				if($resultado->num_rows == 0){
					$item = "INSERT INTO db_permissoes (permissao_value, permissao_descr) VALUES ('{$value}', '{$descr}')";
				} else {
					echo "Você inseriu um número primo que já está sendo usado para alguma permissão: '".$value."'!";
					echo "<ol> Atualmente no banco de dados:";
					while($linha = $resultado->fetch_assoc()) {
						echo "<li><ul><li>permissao_id: ".$linha['permissao_id']."</li>";
						echo "<li>permissao_value: ".$linha['permissao_value']."</li>";
						echo "<li>permissao_descr: ".$linha['permissao_descr']."</li></ul></li>";
					}
					echo "</ol>";
					$erro = 1;
				}
			} 
			if($tarefa == "mod") {
				$id = $_POST['nm_id'];
				$item = "UPDATE db_permissoes SET ";
				if($descr != ""){
					$item = $item."permissao_descr = '{$descr}'";
				}
				if($value != ""){
					if($descr != ""){
						$item = $item.", ";
					}
					$item = $item."permissao_value ='{$value}'";
				} elseif($descr == "" AND $value == "") {
					echo "Você não modificiou nenhuma informação";
					$erro = 1;
				}
				$item = $item." WHERE permissao_id = '{$id}'";
			}
		}
		if(!isset($erro)){
			if ($conn->query($item) === TRUE) {
				header("location: ../painel.php");
			} else {
				echo "Ocorreu um erro inesperado: '".$conn->error."'. Tente novamente.";
			}
		}
	}
?>