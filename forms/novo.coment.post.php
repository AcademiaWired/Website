<?php

ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
error_reporting(E_ALL);

	include "../includes/conn.php";

	session_start();
	$user = $_SESSION['nick_logado'];
	$coment_body = $_POST['nm_coment'];
	$date = date('Y-m-d H:i:s', strtotime("-5 hours"));
	$post_id = $_GET['id'];

	$item = "INSERT INTO db_posts_coments (coment_user, coment_body, coment_data, coment_post_id, coment_child_of) VALUES ('{$user}', '{$coment_body}', '{$date}', '{$post_id}', ";
	if(isset($_GET['c'])){
		$item .= $_GET['c'];
	} else {
		$item .= 0;
	}
	$item .= ")";
	$result = $conn->query($item);

	$sql_busca_tutor = "SELECT post_url FROM db_posts WHERE post_id = '{$post_id}'";
	$result_busca_tutor = $conn->query($sql_busca_tutor);
	$linha_busca_tutor = $result_busca_tutor->fetch_assoc();
	header("location: ../tutoriais.php?url=".$linha_busca_tutor['post_url']);
	echo $linha_busca_tutor['post_url'];
?>