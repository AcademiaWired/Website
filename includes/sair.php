<?php
	session_start();
	/*unset($_SESSION['logado']);
	unset($_SESSION['nick_logado']);
	unset($_SESSION["unchecked_nick"]);
	unset($_SESSION["unchecked_email"]);*/
	session_unset($_SESSION);
	echo "<script>history.go(-1)</script>";

?>