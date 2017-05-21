<?php
	session_start();
	$id = $_POST['id'];
	$user = $_SESSION['nick_logado'];

	include "../includes/conn.php";

	$select_coment_like = "SELECT * FROM db_posts_coments_likes WHERE posts_coments_like_coment_id = '{$id}' AND posts_coments_like_user = '{$user}'";
	$result_coment_like = $conn->query($select_coment_like);
	$rows_coment_like = $result_coment_like->num_rows;
	if ($rows_coment_like > 0) {
		$linha_coment_like = $result_coment_like->fetch_assoc();
	
		if ($_POST['like'] != 0) {
			if ($_POST['like'] == "1" AND $linha_coment_like['posts_coments_like_updown'] < 0) {

				$new_like_user = 1;

			} elseif ($_POST['like'] == "-1" AND $linha_coment_like['posts_coments_like_updown'] > 0) {

				$new_like_user = -1;

			} elseif (($_POST['like'] == "1" OR $linha_coment_like['posts_coments_like_updown'] < 0) OR ($_POST['like'] == "-1" AND $linha_coment_like['posts_coments_like_updown'] > 0)) {
				$sql = "DELETE FROM db_posts_coments_likes WHERE posts_coments_like_coment_id = '{$id}' AND posts_coments_like_user = '{$user}'";
				$a = 1;
			}
			if (!isset($a)) {
				$new_coment_likes = $_POST['like'];
				$sql = "UPDATE db_posts_coments_likes SET posts_coments_like_updown = '{$new_coment_likes}' WHERE posts_coments_like_coment_id = '{$id}' AND posts_coments_like_user = '{$user}'";
			}
		} elseif ($_POST['like'] == "0") {

			$sql = "DELETE FROM db_posts_coments_likes WHERE posts_coments_like_coment_id = '{$id}' AND posts_coments_like_user = '{$user}'";

		}
		
	} else {
		if ($_POST['like'] == "1") {

			$new_like_user = 1;

		} elseif ($_POST['like'] == "-1") {
			
			$new_like_user = -1;

		}
		$sql = "INSERT INTO db_posts_coments_likes (posts_coments_like_coment_id, posts_coments_like_updown, posts_coments_like_user) VALUES ('{$id}', '{$new_like_user}', '{$user}')";
		
	}
	$result_sql = $conn->query($sql);


	$busca_new_coment_likes = "SELECT * FROM db_posts_coments_likes WHERE posts_coments_like_coment_id = '{$id}'";
	$result_new_coment_likes = $conn->query($busca_new_coment_likes);

	$new_coment_likes = 0;
	if ($result_new_coment_likes->num_rows > 0) {
		while ($linha_new_coment_likes = $result_new_coment_likes->fetch_assoc()) {
			$new_coment_likes += $linha_new_coment_likes['posts_coments_like_updown'];
		}
	}



	echo "<button class='mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon' onclick='likeUpDown(".$id.", &#39;";
	if ($_POST['like'] == 1) {echo 0;}
	elseif ($_POST['like'] != 1) {echo 1;}
	echo "&#39;)'>
		<i class='fa fa-thumbs";
		if ($_POST['like'] != 1) {echo "-o";}
		echo"-up'></i>
	</button>
	<span class='";

		if ($new_coment_likes < 0) {echo "red";}
		if ($new_coment_likes > 0) {echo "green";}
	
	echo "' title='Há um total de ".$result_new_coment_likes->num_rows." ";
	if ($result_new_coment_likes->num_rows != 1) {
		echo "avaliações";
	} else {
		echo "avaliação";
	}
	echo "'>".$new_coment_likes."</span>
	<button class='mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon' onclick='likeUpDown(".$id.", &#39;";
	if ($_POST['like'] == -1) {echo 0;}
	elseif ($_POST['like'] != -1) {echo -1;}
	echo "&#39;)'>
		<i class='fa fa-thumbs";
		if ($_POST['like'] != -1) {echo "-o";}
		echo"-down'></i>
	</button>";
?>