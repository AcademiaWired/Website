<?php 
	session_start();
	
	if(!isset($_SESSION['view_meu_wired'])){
		$_SESSION['view_meu_wired'] = 0;
	}
?>
<!DOCTYPE html>
<html lang="pt-BR">
	<head>
		<meta charset="UTF-8">
		<title>Fazer uma busca na Academia Wired</title>
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
	    <meta name="viewport" content="initial-scale = 1.0, maximum-scale = 1.0, user-scalable = no, width = device-width">
		<meta name="theme-color" content="rgb(63,81,181)">
		<link rel="icon" sizes="192x192" href="favicon.png">
		
		<link rel="stylesheet" href="css/style.css" />
		<link rel="stylesheet" href="css/emojis.css" />
	    <script src="js/script.js"></script>
		
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
		
		<!--
		<link rel="stylesheet" href="offline/material.min.css">
		<script src="offline/material.min.js"></script>
		-->
		<link rel="stylesheet" href="https://storage.googleapis.com/code.getmdl.io/1.0.2/material.indigo-blue.min.css" /> 
		<script src="https://storage.googleapis.com/code.getmdl.io/1.0.2/material.min.js"></script>
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	</head>
	<body id='pg_se'>
		<?php include "includes/header.php" ?>
				<main>
					<div style='text-align: center; width: 100%'>
						<form action='busca.php' method='get'>
		  					<div class='mdl-textfield mdl-js-textfield mdl-textfield--floating-label'>
							    <input class='mdl-textfield__input' type='search' id='input_search_3' name='nm_search' />
							    <label class='mdl-textfield__label' for='input_search_3'>Pesquisar...</label>
							</div>
							<button class='mdl-button mdl-js-button mdl-button--icon'>
								<i class='material-icons'>search</i>
							</button>
						</form>
					</div>
					<?php
						if (isset($_GET['nm_search'])) {

							include "includes/conn.php";

							$busca = explode(" ", $_GET['nm_search']);
							$data_atual = date('Y-m-d H:i', strtotime("-5 hours"));
							if (count($busca) > 1) {
								$select_busca_tutors = "SELECT * FROM db_posts WHERE post_data_postado <= '{$data_atual}' AND (";
								for ($l_a = 0; $l_a < count($busca); $l_a++) {
									if ($l_a > 0) {
										$select_busca_tutors .= " OR ";
									}
									$select_busca_tutors .= "post_title LIKE '%{$busca[$l_a]}%'";
								}
								$select_busca_tutors .= ") ORDER BY post_data_postado DESC";
							} else {
								$select_busca_tutors = "SELECT * FROM db_posts WHERE post_data_postado <= '{$data_atual}' AND post_title LIKE '%{$busca[0]}%' ORDER BY post_data_postado DESC";
							}
							$result_busca_tutors = $conn->query($select_busca_tutors);
							if ($result_busca_tutors->num_rows == 0) {
								$resultados_busca_tutors = "nenhum resultado";
							} elseif ($result_busca_tutors->num_rows == 1) {
								$resultados_busca_tutors = $result_busca_tutors->num_rows." resultado";
							} elseif ($result_busca_tutors->num_rows > 1) {
								$resultados_busca_tutors = $result_busca_tutors->num_rows." resultados";
							}
							echo "<div style='overflow: auto'><table style='margin: 10px auto' class='mdl-data-table mdl-js-data-table mdl-shadow--2dp'>
								<thead>
									<tr>
										<th class='mdl-data-table__cell--non-numeric'>Tutoriais: ".$resultados_busca_tutors."</th>
										<th class='mdl-data-table__cell--non-numeric'></th>
										<th class='mdl-data-table__cell--non-numeric'></th>
										<th class='mdl-data-table__cell--non-numeric'></th>
										<th class='mdl-data-table__cell--non-numeric'></th>
									</tr>
									<tr>
										<th class='mdl-data-table__cell--non-numeric'>Título</th>
										<th class='mdl-data-table__cell--non-numeric'>Descrição</th>
										<th class='mdl-data-table__cell--non-numeric'>Informações</th>
										<th class='mdl-data-table__cell--non-numeric'>Comentários</th>
										<th class='mdl-data-table__cell--non-numeric'>Categoria</th>
									</tr>
								</thead>";

							if ($result_busca_tutors->num_rows > 0) {
								echo "<tbody>";
								while ($linha_busca_tutors = $result_busca_tutors->fetch_assoc()) {
									if (strlen(strip_tags($linha_busca_tutors['post_title'])) > 40) {
									//	$linha_busca_tutors['post_title'] = substr($linha_busca_tutors['post_title'], 0, 40)."...";
									}
									if (strlen(strip_tags($linha_busca_tutors['post_descricao'])) > 140) {
										$linha_busca_tutors['post_descricao'] = substr($linha_busca_tutors['post_descricao'], 0, 140)."...";
									}

									$pesquisa = explode(" ", $_GET['nm_search']);
									for ($i = 0; $i < count($pesquisa); $i++) {
										$first_uc = explode(" ", $linha_busca_tutors['post_title']);
										str_ireplace(trim($pesquisa[$i]), trim("<b>".$pesquisa[$i]."</b>"), $linha_busca_tutors['post_title'], $count_ireplace);
										str_replace(trim($pesquisa[$i]), trim("<b>".$pesquisa[$i]."</b>"), $linha_busca_tutors['post_title'], $count_replace);
										if ($count_ireplace != $count_replace AND $count_ireplace == 1 AND $first_uc[0] === ucfirst($pesquisa[$i])) {
											$pesquisa[$i] = ucfirst($pesquisa[$i]);
											$linha_busca_tutors['post_title'] = str_replace(trim($pesquisa[$i]), trim("<mark>".$pesquisa[$i]."</mark>"), $linha_busca_tutors['post_title']);
										} else {
											$linha_busca_tutors['post_title'] = str_ireplace(trim($pesquisa[$i]), trim("<mark>".$pesquisa[$i]."</mark>"), $linha_busca_tutors['post_title']);
										}
									}

									$pega_tags = "SELECT * FROM db_posts_tags WHERE post_tag_id = '{$linha_busca_tutors['post_id']}'";
									$result_tags = $conn->query($pega_tags);
									$pega_coments = "SELECT coment_id FROM db_posts_coments WHERE coment_post_id = '{$linha_busca_tutors['post_id']}'";
									$result_coments = $conn->query($pega_coments);
									if ($result_coments->num_rows < 100) {
										if ($result_coments->num_rows == 0) {
											$num_coments = "Nenhum comentário";
										} elseif ($result_coments->num_rows == 1) {
											$num_coments = $result_coments->num_rows." comentário";
										} else {
											$num_coments = $result_coments->num_rows." comentários";
										}
									} elseif ($result_coments->num_rows >= 100) {
										$num_coments = "+99 comentários";
									}
									$categoria = $linha_busca_tutors['post_categoria'];
									$select_catg = "SELECT * FROM db_posts_categorias WHERE categoria_nome = '{$categoria}'";
									$result_catg = $conn->query($select_catg);
									$linha_catg = $result_catg->fetch_assoc();
									echo "<tr>
											<td class='mdl-data-table__cell--non-numeric' style='white-space: nowrap;overflow: hidden;text-overflow: ellipsis;'><a href='tutors.php?url=".$linha_busca_tutors['post_url']."' style='text-decoration: none;'>".$linha_busca_tutors['post_title']."</a></td>
										<td class='mdl-data-table__cell--non-numeric' style='white-space: initial;text-align: justify;min-width: 200px;'>".$linha_busca_tutors['post_descricao']."</td>
										<td class='mdl-data-table__cell--non-numeric'>Postado por ".$linha_busca_tutors['post_user_post']." em ".date('d/m/Y', strtotime($linha_busca_tutors['post_data_postado']))." às ".date('H:i', strtotime($linha_busca_tutors['post_data_postado']))."</td>
										<td class='mdl-data-table__cell--non-numeric'>".$num_coments."</td>
										<td class='mdl-data-table__cell--non-numeric'>".$linha_catg['categoria_nome']."</td>
									</tr>";
								}
								echo "</tbody>";
							}
							echo "</table></div>";
						} else {
							echo "<div style='text-align: center; width: 100%'>
								<p class='emoji e2 e-40pt text-20pt esps-80px'> Nenhuma busca foi realizada </p>
							</div>";
						}
					?>
				</main>
		<?php include "includes/footer.php" ?>
	</body>
</html>