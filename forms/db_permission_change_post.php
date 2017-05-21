<?php
	session_start();

	if(isset($_SESSION['permissao_13']) == false){
		header("location: ../../academia-wired/");
	}

	include "../includes/conn.php";
	
	$tarefa = $_POST['nm_tarefa'];
	
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
					echo "<li>wired_body_tutor: ".$linha['permissao_descr']."</li></ul></li>";
				}
				echo "</ol>";
			}
		} 
		if($tarefa == "mod") {
			if($descr != ""){
				$item = $item."permissao_descr='{$descr}', ";
			}
			$item = $item."permissao_value ='{$value}' WHERE wired_id='{$id}'";
		}
	}
	
	if ($conn->query($item) === TRUE) {
		header("location: ../painel?change=user_permission");
	} else {
		echo "Ocorreu um erro inesperado: '".$conn->error."'. Tente novamente.";
	}
	
	$conn->close();
	
?>