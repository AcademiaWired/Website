<?php
	if(isset($_GET['nm_search'])){
		include "conn.php";

		$conn->query("SET NAMES 'utf8'");
		$conn->query('SET character_set_connection=utf8');
		$conn->query('SET character_set_client=utf8');
		$conn->query('SET character_set_results=utf8');

		$id = $_GET['id_search'];

		$data_limite = date('Y-m-d H:i:s', strtotime("-2 day", strtotime(date('Y-m-d H:i:s', strtotime("-5 hours")))));
		//$data_limite
		$select_id = "SELECT meu_wired_user, meu_wired_name, meu_wired_acao FROM db_meu_wired WHERE meu_wired_data >= '0000-00-00 00:00:00' AND meu_wired_id = '{$id}'";
		$result_id = $conn->query($select_id);
		if($result_id->num_rows > 0){
			$linha_id = $result_id->fetch_assoc();

			header("location: ../meu-wired.php?advertiser=".$linha_id['meu_wired_user']."&wired=".$linha_id['meu_wired_name']."&shop=".$linha_id['meu_wired_acao']."#".$id);
		} else {
			header("location: ../meu-wired.php?advertiser=no&wired=no&shop=no");
		}
	} else {
		header("location: ..");
	}

?>