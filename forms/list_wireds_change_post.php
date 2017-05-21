<?php
	session_start();

	if(isset($_SESSION['permissao_11']) == false){
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
*/		$tarefa = $_POST['nm_tarefa'];
		
		if($tarefa == "exc"){
			$id = $_POST['nm_id'];
			$item = "DELETE FROM db_wireds WHERE wired_id='{$id}'";
		} else {
			$sigla = $_POST['nm_sigla'];
			$type = $_POST['nm_type'];
			$name = $_POST['nm_name'];
			$ico = $_POST['nm_ico'];
			$mobi_png = $_POST['nm_mobi_png'];
			$mobi_gif = $_POST['nm_mobi_gif'];
			$menu_web = $_POST['nm_menu_web'];
			$menu_app = $_POST['nm_menu_app'];
			$descricao = $_POST['nm_descricao'];
			$price_official = $_POST['nm_price_official'];
			$body = $_POST['nm_body'];
			if($tarefa == "add"){
				$verifica = "SELECT * FROM db_wireds WHERE wired_id_name = '{$sigla}'";
				$resultado = $conn->query($verifica);
				if($resultado->num_rows == 0){
					$item = "INSERT INTO db_wireds (wired_id_name, wired_group_id, wired_name, wired_ico, wired_mobi_png, wired_mobi_gif, wired_menu_web, wired_menu_app, wired_descricao, wired_official_price, wired_body_tutor) VALUES ('{$sigla}', '{$type}', '{$name}', '{$ico}', '{$mobi_png}', '{$mobi_gif}', '{$menu_web}', '{$menu_app}', '{$descricao}', '{$price_official}', '{$body}')";
				} else {
					echo "Você inseriu uma sigla já existente: '".$sigla."'!";
					echo "<ol>";
					while($linha = $resultado->fetch_assoc()) {
						echo "<li><ul><li>wired_id: ".$linha['wired_id']."</li>";
						echo "<li>wired_id_name: ".$linha['wired_id_name']."</li>";
						echo "<li>wired_group_id: ".$linha['wired_group_id']."</li>";
						echo "<li>wired_name: ".$linha['wired_name']."</li>";
						echo "<li>wired_ico: ".$linha['wired_ico']."</li>";
						echo "<li>wired_mobi_png: ".$linha['wired_mobi_png']."</li>";
						echo "<li>wired_mobi_gif: ".$linha['wired_mobi_gif']."</li>";
						echo "<li>wired_menu_web: ".$linha['wired_menu_web']."</li>";
						echo "<li>wired_menu_app: ".$linha['wired_menu_app']."</li>";
						echo "<li>wired_descricao: ".$linha['wired_descricao']."</li>";
						echo "<li>wired_official_price: ".$linha['wired_official_price']."</li>";
						echo "<li>wired_aw_price_medio: ".$linha['wired_aw_price_medio']."</li>";
						echo "<li>wired_body_tutor: ".$linha['wired_body_tutor']."</li></ul></li>";
					}
					echo "</ol>";
				}
			} 
			if($tarefa == "mod") {
				$id = $_POST['nm_id'];
				$item = "UPDATE db_posts SET ";
				if($type != ""){
					$item = $item."wired_group_id='{$type}', ";
				}
				if($name != ""){
					$item = $item."wired_name='{$name}', ";
				}
				if($ico != ""){
					$item = $item."wired_ico='{$ico}', ";
				}
				if($mobi_png != ""){
					$item = $item."wired_mobi_png='{$mobi_png}', ";
				}
				if($mobi_gif != ""){
					$item = $item."wired_mobi_gif='{$mobi_gif}', ";
				}
				if($menu_web != ""){
					$item = $item."wired_menu_web='{$menu_web}', ";
				}
				if($menu_app != ""){
					$item = $item."wired_menu_app='{$menu_app}', ";
				}
				if($descricao != ""){
					$item = $item."wired_descricao='{$descricao}', ";
				}
				if($price_official != ""){
					$item = $item."wired_official_price='{$price_official}', ";
				}
				if($body != ""){
					$item = $item."wired_body_tutor='{$body}', ";
				}
				$item = $item."wired_id_name='{$sigla}' WHERE wired_id='{$id}'";
			}
		}
//	}
	
	if ($conn->query($item) === TRUE) {
		header("location: ../painel?change=list_wireds");
	} else {
		echo "Ocorreu um erro inesperado: '".$conn->error."'. Tente novamente.";
	}
	
	$conn->close();
	
?>