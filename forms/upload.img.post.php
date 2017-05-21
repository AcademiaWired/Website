<?php
	session_start();
	if(isset($_SESSION['permissao_7'])){
		if (isset($_POST['nm_ui_dir'])) {
			if ($_POST['nm_ui_dir'] == 0) {
				$uploaddir = '../img/';
			} elseif ($_POST['nm_ui_dir'] == 1) {
				$uploaddir = '../img/posts/';
			}
		} else {
			$uploaddir = '../img/users/';
		}
		$file = pathinfo(basename($_FILES['nm_ui_img']['name']));
		$uploadfile = $uploaddir.$_SESSION['nick_logado']."&".date("Y.m.d-H.i.s")."&".$file['basename'];

		// Verifica se o mime-type do arquivo é de imagem
		if (!preg_match("/^image\/(pjpeg|jpeg|png|gif|bmp)$/", $_FILES['nm_ui_img']['type'])) {
			echo "Arquivo em formato inválido! A imagem deve ser jpg, jpeg, bmp, gif ou png. Envie outro arquivo";
		} elseif (move_uploaded_file($_FILES['nm_ui_img']['tmp_name'], $uploadfile)) {
		    echo "Arquivo válido e enviado com sucesso.\n";
		} else {
		    echo "Possível ataque de upload de arquivo!\n";
		}


		echo '<pre>';
		echo 'Aqui está mais informações de debug:';
		print_r($_FILES);

		print "</pre>";
	}