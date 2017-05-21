<?php
	if(isset($_POST['nm_email'])){
		include "../includes/conn.php";

		session_start();
		$nick = $_SESSION['nick_logado'];
		$email = $_POST['nm_email'];
		$old_senha = htmlspecialchars(strip_tags($_POST['nm_old_pass']));
		$new_senha = $_POST['nm_new_pass'];
		$new_senha_again = $_POST['nm_new_pass_again'];

		$verifica_login = "SELECT * FROM db_users WHERE user_email = '{$email}' AND user_nick = '{$nick}'";
		$result_login = $conn->query($verifica_login);
		$linha_login = $result_login->fetch_assoc();

		if($result_login->num_rows > 0){
			if(crypt($old_senha,$linha_login['user_pass']) == $linha_login['user_pass']){
				$new_senha = crypt($new_senha);
				$atualiza_senha = "UPDATE db_users SET user_pass = '{$new_senha}' WHERE user_email = '{$email}'";
				if($result_senha = $conn->query($atualiza_senha) == true){
					header("location: ../painel.php?done=1");
				}

			} else {
				header("location: ../painel.php?erro=1");
			}
		} else {
			header("location: ../painel.php?erro=1");
		}
	} else {
		header("location:..");
	}





?>