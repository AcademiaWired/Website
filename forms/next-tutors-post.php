<?php
	session_start();
	if(isset($_SESSION['permissao_3']) == false){
		header("location: ../academia-wired/");
	}

	$conn = new mysqli('localhost','root','','db_academia_wired');
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	$conn->query("SET NAMES 'utf8'");
	$conn->query('SET character_set_connection=utf8');
	$conn->query('SET character_set_client=utf8');
	$conn->query('SET character_set_results=utf8');
	
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
		
		if($tarefa == "exc"){
			$id = $_POST['nm_id'];
			$item = "DELETE FROM db_next_tutors WHERE next_tutor_id='{$id}'";
		} else {
			$title = $_POST['nm_title'];
			$sugerido = $_POST['nm_sugerido'];
			$progresso = $_POST['nm_progresso'];
			$atualizado = date('Y-m-d H:i:s', strtotime($_POST['nm_atualizado'].date('H:i:s', strtotime('-5 hours'))));
			$display = $_POST['nm_display'];
			$user = $_SESSION['nick_logado'];
			if($tarefa == "add"){
				$item = "INSERT INTO db_next_tutors (next_tutor_title, next_tutor_sugerido, next_tutor_progresso, next_tutor_display, next_tutor_atualizado, next_tutor_user) VALUES ('{$title}', '{$sugerido}', '{$progresso}', '{$display}', '{$atualizado}', '{$user}')";
			} 
			if($tarefa == "mod") {
				$id = $_POST['nm_id'];
				$item = "UPDATE db_next_tutors SET ";
				if($title != ""){
					$item = $item."next_tutor_title='{$title}', ";
				}
				if($sugerido != ""){
					$item = $item."next_tutor_sugerido='{$sugerido}', ";
				}
				if($progresso != ""){
					$item = $item."next_tutor_progresso='{$progresso}', ";
				}
				$item = $item."next_tutor_atualizado='{$atualizado}', next_tutor_display='{$display}', next_tutor_user='{$user}'date WHERE next_tutor_id='{$id}'";
			}
		}
//	}
	
	if ($conn->query($item) === TRUE) {
		header("location: ../painel?change=next_tutors");
		echo "<h3>Manipulação feita com sucesso!</h3>Volte para ver o resultado:";
	} else {
		echo "Ocorreu um erro inesperado: '".$conn->error."'. Tente novamente:";
	}
	
	$conn->close();
	
	echo " <a href='next-tutors.php'>adicionar outro</a>";
?>