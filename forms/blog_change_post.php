<?php
	session_start();

	if(isset($_SESSION['permissao_5']) == false){
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
			$item = "DELETE FROM db_posts WHERE post_id='{$id}'";
		} else {
			$title = $_POST['nm_title'];
			$url = $_POST['nm_url'];
			$user_post = $_SESSION['nick_logado'];
			$capa = $_POST['nm_capa'];
			$corpo = $_POST['nm_corpo'];
			$categoria = $_POST['nm_categoria'];
			$tags = explode(',', $_POST['nm_tags']);
			$data_post = $_POST['nm_data_post']." 12:00:00";
			if($tarefa == "add"){
				$item = "INSERT INTO db_posts (post_title, post_url, post_user_post, post_capa, post_body, post_categoria, post_data_postado) VALUES ('{$title}', '{$url}', '{$user_post}', '{$capa}', '{$corpo}', '{$categoria}', '{$data_post}')";
			} 
			if($tarefa == "mod") {
				$id = $_POST['nm_id'];
				$user_edit = $_SESSION['nick_logado'];
				$data_edit = date('Y-m-d H:i', strtotime("-5 hours"))/*$_POST['nm_data_edit']*/;
				$item = "UPDATE db_posts SET ";
				if($title != ""){
					$item = $item."post_title='{$title}', ";
				}
				if($url != ""){
					$item = $item."post_url='{$url}', ";
				}
				if($capa != ""){
					$item = $item."post_capa='{$capa}', ";
				}
				if($corpo != ""){
					$item = $item."post_body='{$corpo}', ";
				}
				if($categoria != ""){
					$item = $item."post_categoria='{$categoria}', ";
				}
				if($tags != ""){
					$item = $item."post_tags='{$tags}', ";
				}
				$item = $item."post_user_edit='{$user_edit}', post_data_editado='{$data_edit}' WHERE post_id='{$id}'";
			}
		}
//	}
	
	if ($conn->query($item) === TRUE) {
		
		$busca = "SELECT * FROM db_posts WHERE post_title = '{$title}' AND post_url = '{$url}' AND post_capa = '{$capa}' AND post_body = '{$corpo}' AND post_categoria = '{$categoria}'";
		$resultado = $conn->query($busca);
		$linha = $resultado->fetch_assoc();
		$busca_post_id = $linha['post_id'];
		for ($i = 0; $i < count($tags); $i++){
			$insere = "INSERT INTO db_posts_tags (post_tag_id, post_tag_name) VALUES ('{$busca_post_id}', '{$tags[$i]}')";
			$result_insere = $conn->query($insere);
		}
		
		header("location: ../painel?change=blog_posts");
	} else {
		echo "Ocorreu um erro inesperado: '".$conn->error."'. Tente novamente:";
	}
	
	$conn->close();
	
?>