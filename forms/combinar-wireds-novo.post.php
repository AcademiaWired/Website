<?php
	$ativador = $_POST['nm_ativador'];
	$efeito = $_POST['nm_efeito'];
	$condicao = $_POST['nm_condicao'];
	$extra = $_POST['nm_extra'];

	if (isset($ativador[0]) OR isset($efeito[0]) OR isset($condicao[0]) OR isset($extra[0])) {

		include "../includes/conn.php";
		
		
		
	}
?>