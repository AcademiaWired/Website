<?php

	include "../includes/conn.php";

	if(isset($_POST['nm_id']) OR isset($_POST['nm_data']) OR isset($_POST['nm_nick']) OR isset($_POST['nm_nick_active']) OR isset($_POST['nm_email']) OR isset($_POST['nm_email_active']) OR isset($_POST['nm_pass'])){
		if ($_POST['nm_id'] == ""){
			$tarefa = "add";
		} elseif ($_POST['nm_id'] != ""){
			if($_POST['nm_data'] == "" AND $_POST['nm_nick'] == "" AND $_POST['nm_nick_active'] == "" AND $_POST['nm_email'] == "" AND $_POST['nm_email_active'] == "" AND $_POST['nm_pass'] == ""){
				$tarefa = "exc";
			} elseif ($_POST['nm_data'] != "" OR $_POST['nm_nick'] != "" OR $_POST['nm_nick_active'] != "" OR $_POST['nm_email'] != "" OR $_POST['nm_email_active'] != "" OR $_POST['nm_pass'] != ""){
				$tarefa = "mod";
			}
		}



		if($tarefa == "exc"){
			$id = $_POST['nm_id'];
			$item = "DELETE FROM db_users WHERE user_id = '{$id}'";
		} else {


			function verifica($randon_inicio, $randon_fim, $randon_type, $randon_no_type){
				$conn = new mysqli('localhost','root','','db_academia_wired');
				if ($conn->connect_error) {
				    die("Connection failed: " . $conn->connect_error);
				}
			
				$conn->query("SET NAMES 'utf8'");
				$conn->query('SET character_set_connection=utf8');
				$conn->query('SET character_set_client=utf8');
				$conn->query('SET character_set_results=utf8');
				
				$randon_number = mt_rand($randon_inicio, $randon_fim);
				$db_select = "SELECT * FROM db_users WHERE '{$randon_type}' = '{$randon_number}' OR '{$randon_no_type}' = '{$randon_number}'";
				$result = $conn->query($db_select);
				
				if ($result->num_rows > 0) {
					verifica($randon_inicio, $randon_fim, $randon_type);
				}
				return $randon_number;
			}


			$data = $_POST['nm_data'];
			$nick = $_POST['nm_nick'];
			$nick_active = $_POST['nm_nick_active'];
			$email = $_POST['nm_email'];
			$email_active = $_POST['nm_email_active'];
			$senha = crypt(htmlspecialchars(strip_tags($_POST['nm_pass'])));
			if($tarefa == "add"){
				$verifica_nick_repe = "SELECT * FROM db_users WHERE user_nick = '{$nick}'";
				$resultado_nick_repe = $conn->query($verifica_nick_repe);
				$verifica_email_repe = "SELECT * FROM db_users WHERE user_email = '{$email}'";
				$resultado_email_repe = $conn->query($verifica_email_repe);
				if(($nick == "" OR $resultado_nick_repe->num_rows == 0) AND ($email == "" OR $resultado_email_repe->num_rows == 0)){
					$nick_active = verifica("100000", "499999", "user_nick_active", "user_email_active");
					$email_active = verifica("500000", "999999", "user_email_active", "user_nick_active");
					$item = "INSERT INTO db_users (user_data, user_nick, user_nick_active, user_email, user_email_active, user_pass, user_permissao) VALUES ('{$data}', '{$nick}', '{$nick_active}', '{$email}', '{$email_active}', '{$senha}', 1)";
				} else {
					echo "já existe um usuário com este nick e/ou email";
				}
			} elseif($tarefa == "mod"){
				$id = $_POST['nm_id'];
				$item = "UPDATE db_users SET ";
				if($data != ""){
					$item .= "user_data = '{$data}'";
					$k = 1;
				}
				if($nick != ""){
					if($k == 1){
						$item .= ", ";
						$k = 0;
					}
					$item .= "user_nick = '{$nick}'";
					$k = 1;
				}
				if($nick_active != ""){
					if($k == 1){
						$item .= ", ";
						$k = 0;
					}
					$item .= "user_nick_active = '{$nick_active}'";
					$k = 1;
				}
				if($email != ""){
					if($k == 1){
						$item .= ", ";
						$k = 0;
					}
					$item .= "user_email = '{$email}'";
					$k = 1;
				}
				if($email_active != ""){
					if($k == 1){
						$item .= ", ";
						$k = 0;
					}
					$item .= "user_email_active = '{$email_active}'";
					$k = 1;
				}
				if($senha != ""){
					if($k == 1){
						$item .= ", ";
						$k = 0;
					}
					$item .= "user_pass = '{$senha}'";
				}
				$item .= " WHERE user_id = '{$id}'";
			}
		}
		if($conn->query($item) === TRUE){
			echo "FUNCIONOOOOU";
		} else {
			echo "Ocorreu um erro inesperado: '".$conn->error."'. Tente novamente.";
		}


	}

?>