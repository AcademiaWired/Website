<?php
	session_start();
	if(isset($_SESSION['permissao_7']) == false){
		header("location: ../academia-wired/");
	}
	include "../includes/conn.php";
	
/*	if(isset($_POST['g-recaptcha-response'])){
		$captcha=$_POST['g-recaptcha-response'];
	}
	if(!$captcha){
		echo "<h2>Por favor, confira o captcha e tente novamente: <a href='next-tutors.php'>adicionar outro</a>.</h2>";
		exit;
	}
	$recaptcha_secret = "6LcEfAkTAAAAAAUFfTsyq4k1mvLzsCEMiX9zMyDc";
	$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$recaptcha_secret."&response=".$_POST['g-recaptcha-response']);
	$response = json_decode($response, true);
	if($response["success"] === true){*/
		
		$tarefa = $_POST['nm_tarefa'];
		$acao = $_POST['nm_shop'];
		$data = date('Y-m-d H:i:s', strtotime("-5 hours"));
		if(isset($_POST['nm_wired'])){
			$wired = $_POST['nm_wired'];
		}
		$user = $_SESSION['nick_logado'];
		$price = $_POST['nm_price'];
		$qtd = $_POST['nm_qtd'];
		$room = $_POST['nm_room'];
		
		if($tarefa == "add"){
			$iten = "INSERT INTO db_meu_wired (meu_wired_acao, meu_wired_data, meu_wired_name, meu_wired_user, meu_wired_price, meu_wired_qtd, meu_wired_room) VALUES ('{$acao}', '{$data}', '{$wired}', '{$user}', '{$price}', '{$qtd}', '{$room}')";
			
		
			if ($conn->query($iten) === TRUE) {
				header("location: ../painel?change=meu_wired");
			} else {
				echo "Ocorreu um erro inesperado: '".$conn->error."'. Tente novamente:";
			}
		} elseif ($tarefa == "mod") {
			$id = $_POST['nm_id'];
			$iten = "";
			$verifica = "SELECT * FROM db_meu_wired WHERE meu_wired_id = '{$id}' AND meu_wired_user = '{$user}'";
			$verifica_result = $conn->query($verifica);
			if($verifica_result->num_rows > 0) {
				$iten = "UPDATE db_meu_wired SET ";
				if($acao != "") {
					$iten .= "meu_wired_acao = '{$acao}', ";
				}
				if($wired != "") {
					$iten .= "meu_wired_name = '{$wired}', ";
				}
				if($price != "") {
					$iten .= "meu_wired_price = '{$price}', ";
				}
				if($qtd != "") {
					$iten .= "meu_wired_qtd = '{$qtd}', ";
				}
				if($room != "") {
					$iten .= "meu_wired_room = '{$room}', ";
				}
				$iten .= "meu_wired_data = '{$data} WHERE meu_wired_id = '{$id}''";
		
				if ($conn->query($iten) === TRUE) {
					header("location: ../painel?change=meu_wired");
				} else {
					echo "Ocorreu um erro inesperado: '".$conn->error."'. Tente novamente:";
				}
			} else {
				echo "Você inseriu um ID que não é de sua propriedade. <a href='../painel?change=meu_wired'>Voltar</a>";
			}
		}
//	}
	
	$conn->close();
?>