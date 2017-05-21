<?php
	session_start();

	if(isset($_SESSION['permissao_13']) == false){
		header("location: ../../academia-wired/");
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
	if($response["success"] === true){
*/
		$user = $_POST['nm_user'];
		$new_perm = array_product($_POST['nm_perm']);
		
		$item = "UPDATE db_users SET user_permissao = '{$new_perm}' WHERE user_id = '{$user}'";
			
//	}
	
	if ($conn->query($item) === TRUE) {
		header("location: ../painel?change=user_permission");
	} else {
		echo "Ocorreu um erro inesperado: '".$conn->error."'. Tente novamente.";
	}
	
	$conn->close();
	
?>