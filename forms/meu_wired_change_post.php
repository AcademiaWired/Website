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
		
		$acao = $_POST['meu_shop'];
		$data = date('Y-m-d H:i:s', strtotime("-5 hours"));
		$wired = $_POST['meu_wired'];
		$user = $_SESSION['nick_logado'];
		$price = $_POST['meu_price'];
		$qtd = $_POST['meu_qtd'];
		$room = $_POST['meu_room'];
		
		
			$iten = "INSERT INTO db_meu_wired (meu_wired_acao, meu_wired_data, meu_wired_name, meu_wired_user, meu_wired_price, meu_wired_qtd, meu_wired_room) VALUES ('{$acao}', '{$data}', '{$wired}', '{$user}', '{$price}', '{$qtd}', '{$room}')";
			
		
			if ($conn->query($iten) === TRUE) {
				$iten2 = "SELECT * FROM db_meu_wired WHERE meu_wired_data = '{$data}' AND meu_wired_user = '{$user}' AND meu_wired_name = '{$wired}'";
				$result2 = $conn->query($iten2);
				$linha2 = $result2->fetch_assoc();
				header("location: ../includes/meu-wired_search.php?nm_search=".$linha2['meu_wired_id']);
				
			} else {
				echo "Ocorreu um erro inesperado: '".$conn->error."'. Tente novamente:";
			}
		
//	}
	
	$conn->close();
?>