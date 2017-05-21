<?php
	include "../includes/conn.php";

	if (isset($_POST['nm_gb_id']) OR isset($_POST['nm_gb_title']) OR isset($_POST['nm_gb_url']) OR isset($_POST['nm_gb_descricao']) OR isset($_POST['nm_gb_capa']) OR isset($_POST['nm_gb_catg']) OR isset($_POST['nm_gb_tags']) OR isset($_POST['nm_gb_date']) OR isset($_POST['nm_gb_body']) OR isset($_POST['nm_gb_embed'])){
		if ($_POST['nm_gb_id'] == ""){
			$tarefa = "add";
		} elseif ($_POST['nm_gb_id'] != ""){
			if($_POST['nm_gb_title'] == "" AND $_POST['nm_gb_url'] == "" AND $_POST['nm_gb_descricao'] == "" AND $_POST['nm_gb_capa'] == "" AND $_POST['nm_gb_catg'] == "" AND $_POST['nm_gb_tags'] == "" AND $_POST['nm_gb_date'] == "" AND $_POST['nm_gb_body'] == "" AND $_POST['nm_gb_embed'] == ""){
				$tarefa = "exc";
			} elseif ($_POST['nm_gb_title'] != "" OR $_POST['nm_gb_url'] != "" OR $_POST['nm_gb_descricao'] != "" OR $_POST['nm_gb_capa'] != "" OR $_POST['nm_gb_catg'] != "" OR $_POST['nm_gb_tags'] != "" OR $_POST['nm_gb_date'] != "" OR $_POST['nm_gb_body'] != "" OR $_POST['nm_gb_embed'] != "") {
				$tarefa = "mod";
			}
		}

		if($tarefa == "exc"){
			$id = $_POST['nm_gb_id'];
			$item = "DELETE FROM db_posts WHERE post_id = '{$id}'";
			$item2 = "DELETE FROM db_posts_tags WHERE post_tag_id = '{$id}'";
		} elseif ($tarefa != "exc") {
			session_start();
			$user_post = $_SESSION['nick_logado'];
			$title = $_POST['nm_gb_title'];
			$url = $_POST['nm_gb_url'];
			$descricao = $_POST['nm_gb_descricao'];
			$capa = $_POST['nm_gb_capa'];
			$catg = $_POST['nm_gb_catg'];
			$tags = explode(',', $_POST['nm_gb_tags']);
			$data = $_POST['nm_gb_date'];
			$embed = $_POST['nm_gb_embed'];
			$body = str_replace("
", "", $_POST['nm_gb_body']);
			if($tarefa == "add"){
				$item = "INSERT INTO db_posts (post_title, post_url, post_descricao, post_user_post, post_capa, post_embed, post_body, post_categoria, post_data_postado) VALUES ('{$title}', '{$url}', '{$descricao}', '{$user_post}', '{$capa}', '{$embed}', '{$body}', '{$catg}', '{$data}')";
			}
			if($tarefa == "mod") {
				$id = $_POST['nm_gb_id'];
				$user_edit = $_SESSION['nick_logado'];
				$data_edit = date('Y-m-d H:i:s', strtotime("-5 hours"));
				$item = "UPDATE db_posts SET ";
				if($title != ""){
					$item = $item."post_title='{$title}', ";
				}
				if($url != ""){
					$item = $item."post_url='{$url}', ";
				}
				if($descricao != ""){
					$item = $item."post_descricao='{$descricao}', ";
				}
				if($capa != ""){
					$item = $item."post_capa='{$capa}', ";
				}
				if($embed != ""){
					$item = $item."post_embed='{$embed}', ";
				}
				if($body != ""){
					$item = $item."post_body='{$body}', ";
				}
				if($catg != ""){
					$item = $item."post_categoria='{$catg}', ";
				}
				if($data != " 12:00:00"){
					$item = $item."post_data_postado='{$data}', ";
				}
				$item = $item."post_user_edit='{$user_edit}', post_data_editado='{$data_edit}' WHERE post_id='{$id}'";
			}
		}

		if ($conn->query($item) === true) {
			if ($tarefa != "exc" AND $tags != "") {
				if ($tarefa == "add") {
					$busca = "SELECT * FROM db_posts WHERE post_title = '{$title}' AND post_url = '{$url}' AND post_capa = '{$capa}'";
					$resultado = $conn->query($busca);
					$linha = $resultado->fetch_assoc();
					$busca_post_id = $linha['post_id'];
				} elseif ($tarefa == "mod") {
					$busca_post_id = $id;
					$delet = "DELETE FROM db_posts_tags WHERE post_tag_id = '{$busca_post_id}'";
					$result = $conn->query($delet);
				}
				for ($i = 0; $i < count($tags); $i++){
					$insere = "INSERT INTO db_posts_tags (post_tag_id, post_tag_name) VALUES ('{$busca_post_id}', '{$tags[$i]}')";
					$result_insere = $conn->query($insere);
				}
			} elseif ($tarefa == "exc") {
				$conn->query($item2);
			}
			header("location: ../tutoriais.php");
		} else {
			echo "Ocorreu um erro inesperado: '".$conn->error."'. Tente novamente:";
		}

		$conn->close();

	} elseif (isset($_GET['catg'])) {
		if ($_POST['nm_gb_catg_id'] == ""){
			$tarefa = "add";
		} elseif ($_POST['nm_gb_catg_id'] != ""){
			if($_POST['nm_gb_catg_nome'] == "" AND $_POST['nm_gb_catg_ico'] == ""){
				$tarefa = "exc";
			} elseif ($_POST['nm_gb_catg_nome'] != "" OR $_POST['nm_gb_catg_ico'] != "") {
				$tarefa = "mod";
			}
		}

		if ($tarefa == "exc") {
			$id = $_POST['nm_gb_catg_id'];
			$item = "DELETE FROM db_posts_categorias WHERE categoria_id = '{$id}'";
		} elseif ($tarefa != "exc") {
			$nome = $_POST['nm_gb_catg_nome'];
			$ico = $_POST['nm_gb_catg_ico'];
			if ($tarefa == "add") {
				$item = "INSERT INTO db_posts_categorias (categoria_nome, categoria_ico) VALUES ('{$nome}', '{$ico}')";
			} elseif ($tarefa == "mod") {
				$id = $_POST['nm_gb_catg_id'];
				$item = "UPDATE db_posts_categorias SET ";
				if($nome != ""){
					$item = $item."categoria_nome='{$nome}'";
					$a++;
				}
				if($ico != ""){
					if (isset($a)) {
						$item = $item.", ";
					}
					$item = $item."categoria_ico='{$ico}'";
				}
				$item = $item." WHERE categoria_id='{$id}'";
			}
		}
		if ($conn->query($item) === true) {
			header("location: ../tutoriais.php");
		} else {
			echo "Ocorreu um erro inesperado: '".$conn->error."'. Tente novamente:";
		}
	} else {
		header('location: ..');
	}
?>