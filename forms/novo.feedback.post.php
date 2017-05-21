<?php
	if(isset($_POST['nm_feedback-0'])) {
		if (isset($_SESSION['nick_logado'])) {
			$user = $_SESSION['nick_logado'];
		} else {
			$user = "";
		}
		$text = $_POST['nm_feedback-0'];
		$data = date('Y-m-d H:i:s', strtotime("+2 hours"));

		include "../includes/conn.php";
		$sql_adiciona_feedback = "INSERT INTO db_feedbacks (feedback_user, feedback_text, feedback_data) VALUES ('{$user}', '{$text}', '{$data}')";
		$result_adiciona_feedback = $conn->query($sql_adiciona_feedback);

		unset($_POST['nm_feedback-0']);
	}

	header("location: ..")
?>