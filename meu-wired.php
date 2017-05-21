<?php 
	session_start();
	


	if (!isset($_SESSION['alert_view_meu_wired'])) {
		$_SESSION['alert_view_meu_wired'] = true;
		echo "<script>alert('A Academia Wired não se responsabiliza por nenhum imprevisto decorrente da troca feita entre o vendedor e o comprador!');</script>";
	}



	include "includes/conn.php";
	$sql_session_ultimo_wired = "SELECT meu_wired_data FROM db_meu_wired ORDER BY meu_wired_id DESC LIMIT 1";
	$result_session_ultimo_wired = $conn->query($sql_session_ultimo_wired);
	$linha_session_ultimo_wired = $result_session_ultimo_wired->fetch_assoc();
	$_SESSION['view_meu_wired'] = $linha_session_ultimo_wired['meu_wired_data'];
	$conn->close();



	if(!isset($_GET['wired']) OR $_GET['wired'] == "" OR !isset($_GET['shop']) OR $_GET['shop'] == "" OR !isset($_GET['advertiser']) OR $_GET['advertiser'] == ""){
		header("location:meu-wired.php?advertiser=all&wired=all&shop=all");
	}

?>
<!DOCTYPE html>
<html lang="pt-BR">
	<head>
		<meta charset="UTF-8">
		<title>Meu Wired na Academia Wired</title>
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
		<meta name="viewport" content="initial-scale = 1.0, maximum-scale = 1.0, user-scalable = no, width = device-width">
		<meta name="theme-color" content="rgb(63,81,181)">
		<link rel="icon" sizes="192x192" href="favicon.png">
		
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
		
		<!--
		<link rel="stylesheet" href="offline/material.min.css">
		<script src="offline/material.min.js"></script>
		-->
		<link rel="stylesheet" href="https://storage.googleapis.com/code.getmdl.io/1.0.2/material.indigo-blue.min.css" /> 
		<script src="https://storage.googleapis.com/code.getmdl.io/1.0.2/material.min.js"></script>
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
		<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
		
		<link rel="stylesheet" href="css/style.css" />
		<link rel="stylesheet" href="css/emojis.css" />
		<link rel="stylesheet" href="css/style.meu.wired.css" media="all">
		<script src="js/script.js"></script>
	</head>
	<body id="pg_me-wi">
		<?php include "includes/header.php" ?>
			<main>
				<article class="mdl-grid">
					<div id="filter">
						<form action="meu-wired" method="get" style="line-height: 3em;">
							<select name="advertiser" class="mdl-button mdl-button--primary" id="">
								<option value="all">Todos os negociantes</option>
								<?php
									include "includes/conn.php";

									$data_limite = date('Y-m-d H:i:s', strtotime("-2 day", strtotime(date('Y-m-d H:i:s', strtotime("-5 hours")))));
									//'{$data_limite}'
									$select_all_advertisers = "SELECT meu_wired_user FROM db_meu_wired WHERE meu_wired_data >= '0000-00-00' AND meu_wired_sold = 0 GROUP BY meu_wired_user ORDER BY meu_wired_user";
									$result_all_advertisers = $conn->query($select_all_advertisers);
									while($linha_all_advertisers = $result_all_advertisers->fetch_assoc()){
										echo "<option value='".$linha_all_advertisers['meu_wired_user']."'";
										if($_GET['advertiser'] == $linha_all_advertisers['meu_wired_user']){
											echo " selected";
										}
										echo ">".$linha_all_advertisers['meu_wired_user']."</option>";
									}

								?>
							</select>
							<select name="wired" id="select_wired" class="mdl-button mdl-button--primary">
								<option value="all">Todos os Wireds</option>
								<?php
								
									$select_wireds_group = "SELECT * FROM db_wireds_group";
									$result_wireds_group = $conn->query($select_wireds_group);
									while($linha_group = $result_wireds_group->fetch_assoc()) {
										echo "<optgroup label='".$linha_group['wired_group_name']."'>";
										$grupo_id = $linha_group['wired_group_id'];
										$select_group_wireds = "SELECT * FROM db_wireds WHERE wired_group_id = '{$grupo_id}' ORDER BY wired_name ASC";
										$result_group_wireds = $conn->query($select_group_wireds);
										while($linha_wired = $result_group_wireds->fetch_assoc()){
											echo"<option value='".$linha_wired['wired_id_name']."'";
											if($_GET['wired'] == $linha_wired['wired_id_name']){
												echo " selected";
											}
											echo ">".$linha_wired['wired_name']."</option>";
										}
										echo "</optgroup>";
									}
									unset($select_wireds_group);
									unset($result_wireds_group);
									unset($linha_group);
									unset($select_group_wireds);
									unset($result_group_wireds);
									unset($linha_wired);
									$conn->close();
								?>
							</select>
							<select name="shop" class="mdl-button mdl-button--primary">
								<option value="all">Todas as trocas</option>
								<option value="1"<?php if($_GET['shop'] == 1){echo " selected";} ?>>Vendendo</option>
								<option value="2"<?php if($_GET['shop'] == 2){echo " selected";} ?>>Comprando</option>
							</select>
							<button class="mdl-button mdl-button--raised mdl-js-button mdl-button--primary mdl-js-ripple-effect">Filtrar</button>
						</form>
					</div>
	
					<hr>

					<?php

						function data_restante($recebe) {
							$data_recebe = date('d-m-Y H:i:s', strtotime("+2 day", strtotime($recebe)));

							$data_atual = date('d-m-Y H:i:s', strtotime("-5 hours"));

							$d_restante = strtotime($data_recebe) - strtotime($data_atual);


							if (floor($d_restante / (60*60*24)) > 7) {

								$t1 = floor($d_restante / (60*60*24*7));
								$t2 = floor(($d_restante / (60*60*24)) - (floor($d_restante / (60*60*24*7)) * 7));

								if($t1 == 1) {$t1 .= " semana";} else {$t1 .= " semanas";}

								if($t2 != 1) {$t2 .= " dias";} else {$t2 .= " dia";}

								return array ($t1, $t2);

							} elseif (floor($d_restante / (60*60)) > 24) {

								$t1 = floor($d_restante / (60*60*24));
								$t2 = floor(($d_restante / (60*60)) - (floor($d_restante / (60*60*24)) * 24));

								if($t1 == 1) {$t1 .= " dia";} else {$t1 .= " dias";}

								if($t2 != 1) {$t2 .= " horas";} else {$t2 .= " hora";}

								return array ($t1, $t2);

							} elseif (floor($d_restante / (60)) > 60) {

								$t1 = floor($d_restante / (60*60));
								$t2 = floor(($d_restante / (60)) - (floor($d_restante / (60*60)) * 60));

								if($t1 != 1) {$t1 .= " horas";} else {$t1 .= " hora";}

								if($t2 != 1) {$t2 .= " minutos";} else {$t2 .= " minuto";}

								return array ($t1, $t2);

							} elseif ($d_restante > 60) {

								$t1 = floor($d_restante / (60));
								$t2 = floor($d_restante - (floor($d_restante / (60)) * 60));

								if($t1 != 1) {$t1 .= " minutos";} else {$t1 .= " minuto";}

								if($t2 != 1) {$t2 .= " segundos";} else {$t2 .= " segundo";}

								return array ($t1, $t2);

							}
							

						}


						if($_GET['advertiser'] == "no" OR $_GET['wired'] == "no" OR $_GET['shop'] == "no"){
							echo "<div style='width: 100%'><p class='emoji e10 e-40pt text-20pt esps-110px' style='text-align: center'> A buscar por ID não retornou nenhum resultado </p></div>";
						} else {
							include "includes/conn.php";

							$data_limite = date('Y-m-d H:i:s', strtotime("-2 day", strtotime(date('Y-m-d H:i:s', strtotime("-5 hours")))));
							//'{$data_limite}'
							$select_wireds_view = "SELECT * FROM db_meu_wired WHERE meu_wired_data >= '0000-00-00' AND meu_wired_sold = 0";
							if($_GET['wired'] != "all"){
								$get_wired = $_GET['wired'];
								$select_wireds_view .= " AND meu_wired_name = '{$get_wired}'";
							}
							if($_GET['shop'] != "all"){
								$get_shop = $_GET['shop'];
								$select_wireds_view .= " AND meu_wired_acao = '{$get_shop}'";
							}
							if($_GET['advertiser'] != "all"){
								$get_advertiser = $_GET['advertiser'];
								$select_wireds_view .= " AND meu_wired_user = '{$get_advertiser}'";
							}
							$result_wireds_view = $conn->query($select_wireds_view);
							if($result_wireds_view->num_rows > 0){

								//'{$data_limite}'
								$select_wired_type = "SELECT DISTINCT * FROM db_meu_wired WHERE meu_wired_sold = 0 AND meu_wired_data >= '0000-00-00'";
								if($_GET['wired'] != "all"){
									$get_wired = $_GET['wired'];
									$select_wired_type .= " AND meu_wired_name = '{$get_wired}'";
								}
								if($_GET['shop'] != "all"){
									$get_shop = $_GET['shop'];
									$select_wired_type .= " AND meu_wired_acao = '{$get_shop}'";
								}
								if($_GET['advertiser'] != "all"){
									$get_advertiser = $_GET['advertiser'];
									$select_wired_type .= " AND meu_wired_user = '{$get_advertiser}'";
								}
								$select_wired_type .= " GROUP BY meu_wired_name ORDER BY meu_wired_name";
								$result_wired_type = $conn->query($select_wired_type);
								while ($linha_wired_type = $result_wired_type->fetch_assoc()) {
									$wired_details = $linha_wired_type['meu_wired_name'];

									$select_wired_details = "SELECT wired_name, wired_ico FROM db_wireds WHERE wired_id_name = '{$wired_details}'";
									$result_wired_details = $conn->query($select_wired_details);
									$linha_wired_details = $result_wired_details->fetch_assoc();

									//'{$data_limite}'
									$select_wired_selling = "SELECT * FROM db_meu_wired WHERE meu_wired_name = '{$wired_details}' AND meu_wired_acao = 1 AND meu_wired_data >= '0000-00-00' AND meu_wired_sold = 0";
									if($_GET['advertiser'] != "all"){
										$get_advertiser = $_GET['advertiser'];
										$select_wired_selling .= " AND meu_wired_user = '{$get_advertiser}'";
									}
									$result_wired_selling = $conn->query($select_wired_selling);


									//'{$data_limite}'
									$select_wired_shopping = "SELECT * FROM db_meu_wired WHERE meu_wired_name = '{$wired_details}' AND meu_wired_acao = 2 AND meu_wired_data >= '0000-00-00' AND meu_wired_sold = 0";
									if($_GET['advertiser'] != "all"){
										$get_advertiser = $_GET['advertiser'];
										$select_wired_shopping .= " AND meu_wired_user = '{$get_advertiser}'";
									}
									$result_wired_shopping = $conn->query($select_wired_shopping);

									$wired_trade = 0;
									if($result_wired_selling->num_rows > 0 AND ($_GET['shop'] == "all" OR $_GET['shop'] == 1)){
										$wired_trade += 1;
									}
									if ($result_wired_shopping->num_rows > 0 AND ($_GET['shop'] == "all" OR $_GET['shop'] == 2)) {
										$wired_trade += 2;
									}

									echo "<div class='mdl-cell mdl-cell--center mdl-cell--";

									if($wired_trade == 3){
										echo "6";
									} else {
										echo "3";
									}
									echo "-col mdl-card mdl-card--expand mdl-shadow--2dp card_offer";
									if($result_wired_type->num_rows == 1){
										echo " only-one";
									}
									echo "'>";

									echo "<h2>".$linha_wired_details['wired_name']."</h2>";
									echo "<div class='ico'><img class='mdl-shadow--3dp' src='".$linha_wired_details['wired_ico']."'></div><div class='div-offers";
									if($_GET['shop'] != "all"){
										echo " one-colun";
									}
									echo "'>";

									if($result_wired_selling->num_rows > 0 AND ($_GET['shop'] == "all" OR $_GET['shop'] == 1)){
										while($linha_wired_selling = $result_wired_selling->fetch_assoc()){
											$exit = 0;
											echo "<div class='";
											if($wired_trade == 3){
												echo "selling-left";
											} else {
												echo "trade-center";
											}
											if ($result_wired_selling->num_rows == 1 OR $_GET['shop'] != "all"){
												echo "' id='".$linha_wired_selling['meu_wired_id'];
											}
											echo "'><h3 class='selling'>Vendendo</h3>";
											if ($result_wired_selling->num_rows == 1 OR $_GET['shop'] != "all") {
												echo "<div class='separator'></div>";
												echo "<span class='advertiser'>".$linha_wired_selling['meu_wired_user']."</span>";
												echo "<div class='separator'></div>";
												echo "<span class='price'>".$linha_wired_selling['meu_wired_price'];
												if ($linha_wired_selling['meu_wired_price'] == 1){
													echo " câmbio";
												} else {
													echo " câmbios";
												}
												echo "</span>";
												echo "<div class='separator'></div>";
												echo "<span class='units'>".$linha_wired_selling['meu_wired_qtd'];
												if ($linha_wired_selling['meu_wired_qtd'] == 1){
													echo " unidade";
												} else {
													echo " unidades";
												}
												echo "</span>";
												echo "<div class='separator'></div>";
												echo "<span class='room'><a href='".$linha_wired_selling['meu_wired_room']."' target='_blank'>Quarto para negociação</a></span>";
												echo "<div class='separator'></div>";
												

												//echo data_restante($linha_wired_selling['meu_wired_data']);
												list($d1, $d2) = data_restante($linha_wired_selling['meu_wired_data']);
												//echo $d1." e ".$d2;


												echo "<span class='expires'>Esta oferta expira em "./*date('d/m/Y', strtotime("+2 day", strtotime($linha_wired_selling['meu_wired_data'])))*/$d1." e "./*date('H:i', strtotime($linha_wired_selling['meu_wired_data']))*/$d2."</span>";
												echo "<div class='separator'></div>";
												echo "<span class='id'>ID ".$linha_wired_selling['meu_wired_id']."</span>";
											} elseif ($result_wired_selling->num_rows > 1 AND $_GET['shop'] == "all") {
												echo "<div class='separator'></div>";
												echo "<span class='offers'>Existem <a href='?advertiser=".$_GET['advertiser']."&wired=".$linha_wired_type['meu_wired_name']."&shop=1'>".$result_wired_selling->num_rows." ofertas</a></span>";
												$exit = 1;
											}
											echo "</div>";
											if($exit == 1){
												unset($exit);
												break;
											}
										}
									}

									if($result_wired_shopping->num_rows > 0 AND ($_GET['shop'] == "all" OR $_GET['shop'] == 2)){
										while($linha_wired_shopping = $result_wired_shopping->fetch_assoc()){
											$exit = 0;
											echo "<div class='";
											if($wired_trade == 3){
												echo "shopping-right";
											} else {
												echo "trade-center";
											}
											if($result_wired_shopping->num_rows == 1 OR $_GET['shop'] != "all"){
												echo "' id='".$linha_wired_shopping['meu_wired_id'];
											}
											echo "'><h3 class='shopping'>Comprando</h3>";
											if ($result_wired_shopping->num_rows == 1 OR $_GET['shop'] != "all") {
												echo "<div class='separator'></div>";
												echo "<span class='advertiser'>".$linha_wired_shopping['meu_wired_user']."</span>";
												echo "<div class='separator'></div>";
												echo "<span class='price'>".$linha_wired_shopping['meu_wired_price'];
												if ($linha_wired_shopping['meu_wired_price'] == 1){
													echo " câmbio";
												} else {
													echo " câmbios";
												}
												echo "</span>";
												echo "<div class='separator'></div>";
												echo "<span class='units'>".$linha_wired_shopping['meu_wired_qtd'];
												if ($linha_wired_shopping['meu_wired_qtd'] == 1){
													echo " unidade";
												} else {
													echo " unidades";
												}
												echo "</span>";
												echo "<div class='separator'></div>";
												echo "<span class='room'><a href='".$linha_wired_shopping['meu_wired_room']."' target='_blank'>Quarto para negociação</a></span>";
												echo "<div class='separator'></div>";

												list($d1, $d2) = data_restante($linha_wired_shopping['meu_wired_data']);

												echo "<span class='expires'>Esta oferta expira em "./*date('d/m/Y', strtotime("+2 day", strtotime($linha_wired_selling['meu_wired_data'])))*/$d1." e "./*date('H:i', strtotime($linha_wired_selling['meu_wired_data']))*/$d2."</span>";
												echo "<div class='separator'></div>";
												echo "<span class='id'>ID ".$linha_wired_shopping['meu_wired_id']."</span>";
											} elseif ($result_wired_shopping->num_rows > 1 AND $_GET['shop'] == "all") {
												echo "<div class='separator'></div>";
												echo "<span class='offers'>Existem  <a href='?advertiser=".$_GET['advertiser']."&wired=".$linha_wired_type['meu_wired_name']."&shop=2'>".$result_wired_shopping->num_rows." ofertas</a></span>";
												$exit = 1;
											}
											echo "</div>";
											if($exit == 1){
												unset($exit);
												break;
											}
										}
									}
									unset($wired_trade);
									echo "</div></div>";
								}
							} else {
								echo "<div style='width: 100%'><p class='emoji e3 e-40pt text-20pt esps-110px' style='text-align: center'> Nenhuma oferta encontrada </p></div>";
							}

							unset($data_limite);
							unset($select_wireds_view);
							unset($result_wireds_view);
							unset($get_wired);
							unset($get_shop);
							unset($get_advertiser);
							unset($select_wireds_type);
							unset($result_wired_type);
							unset($linha_wired_type);
							unset($wired_details);
							unset($select_wired_details);
							unset($result_wired_details);
							unset($linha_wired_details);
							unset($select_wired_selling);
							unset($result_wired_selling);
							unset($select_wired_shopping);
							unset($result_wired_shopping);
							unset($wired_trade);
							unset($linha_wired_selling);
							unset($linha_wired_shopping);
							$conn->close();
						}
					?>

					<hr>

					<form action="/includes/meu-wired_search.php" method="get" style="margin: 0 auto;">
						<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width: 70px;">
							<input class="mdl-textfield__input" type="number" name="nm_search" min="1" width="50px" id="id_search" required/>
							<label class="mdl-textfield__label" for="id_search">ID</label>
						</div>
						<button class="mdl-button mdl-button--raised mdl-js-button mdl-button--primary mdl-js-ripple-effect">Buscar</button>
					</form>
				</article>
				
				<div class='floating_botton'>
					<label for="id_search" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--accent mdl-color-text--white">Busca por ID</label>
					<?php
						if (isset($_SESSION['nick_logado'])):
					?>
					<a href="#" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--accent mdl-color-text--white" onclick="floatingCard('s', 'cell_1')">Publicar Meu Wired</a>
					<div class='floating_cell cell_1 mdl-cell mdl-cell--10-col' style='display:none'>
						<button class="mdl-button mdl-js-button mdl-button--icon" style="float: right;" onclick="floatingCard('h')">
						  <i class="material-icons">close</i>
						</button>
						<h4>Publicar Meu Wired</h4>
						<form class='form_meu_wired' action='forms/meu_wired_change_post.php' method='post'>
							<select name="meu_wired" id="input_0" class="mdl-button mdl-button--primary" required>
								<option value="" disabled selected>Selecione um Wired</option>
								<?php
									include "includes/conn.php";
								
									$select_wireds_group = "SELECT * FROM db_wireds_group";
									$result_wireds_group = $conn->query($select_wireds_group);
									while($linha_group = $result_wireds_group->fetch_assoc()) {
										echo "<optgroup label='".$linha_group['wired_group_name']."'>";
										$grupo_id = $linha_group['wired_group_id'];
										$select_group_wireds = "SELECT * FROM db_wireds WHERE wired_group_id = '{$grupo_id}' ORDER BY wired_name ASC";
										$result_group_wireds = $conn->query($select_group_wireds);
										while($linha_wired = $result_group_wireds->fetch_assoc()){
											echo"<option value='".$linha_wired['wired_id_name']."'>".$linha_wired['wired_name']."</option>";
										}
										echo "</optgroup>";
									}
									unset($select_wireds_group);
									unset($result_wireds_group);
									unset($linha_group);
									unset($select_group_wireds);
									unset($result_group_wireds);
									unset($linha_wired);
									$conn->close();
								?>
							</select>
							<br>Eu quero: 
							<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="input_1">
								<input type="radio" id="input_1" class="mdl-radio__button" name="meu_shop" value="1" required />
								<span class="mdl-radio__label">vender</span>
							</label>
							<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="input_2">
								<input type="radio" id="input_2" class="mdl-radio__button" name="meu_shop" value="2" />
								<span class="mdl-radio__label">comprar</span>
							</label>
							<br>
							<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width: 113px;">
							    <input class="mdl-textfield__input" name='meu_price' min='1' max='20' type="text" pattern="-?[0-9]*(\.[0-9]+)?" id="input_3" title="Insira o valor em câmbios por unidade" required />
							    <label class="mdl-textfield__label" for="input_3">Por qual preço?</label>
							</div> c/uni
							<br>
							<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width: 140px;">
							    <input class="mdl-textfield__input" name='meu_qtd' min='1' type="text" pattern="-?[0-9]*(\.[0-9]+)?" id="input_4" required />
							    <label class="mdl-textfield__label" for="input_4">Quantas unidades?</label>
							</div>
							<br>
							<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width: 252px;">
							    <input class="mdl-textfield__input" name='meu_room' type="url" id="input_5" required />
							    <label class="mdl-textfield__label" for="input_5">Em qual quarto podem te procurar?</label>
							</div>
							<br>
							<p><b>Aviso:</b> esta oferta não poderá ser editada, apenas <a href="#input_6" onclick="floatingCard('s', 'cell_2')">excluída</a>. Ela ficará visível na página Meu Wired durante no máximo 2 dias.</p>
							<br>
							<button class="mdl-button mdl-button--raised mdl-js-button mdl-button--primary mdl-js-ripple-effect">Publicar</button>
						</form>
						<h4>Excluir oferta do Meu Wired</h4>
						<form class='form_meu_wired' action='forms/meu_wired_change_post.php' method='post'>
							<select name="meu_wired" id="input_6" class="mdl-button mdl-button--primary" required>
								<option value="" disabled selected>Selecione uma oferta sua</option>
								<?php
									include "includes/conn.php";
								
									$select_wireds_group = "SELECT * FROM db_wireds_group";
									$result_wireds_group = $conn->query($select_wireds_group);
									while($linha_group = $result_wireds_group->fetch_assoc()) {
										echo "<optgroup label='".$linha_group['wired_group_name']."'>";
										$grupo_id = $linha_group['wired_group_id'];
										$select_group_wireds = "SELECT * FROM db_wireds WHERE wired_group_id = '{$grupo_id}' ORDER BY wired_name ASC";
										$result_group_wireds = $conn->query($select_group_wireds);
										while($linha_wired = $result_group_wireds->fetch_assoc()){
											echo"<option value='".$linha_wired['wired_id_name']."'>".$linha_wired['wired_name']."</option>";
										}
										echo "</optgroup>";
									}
									unset($select_wireds_group);
									unset($result_wireds_group);
									unset($linha_group);
									unset($select_group_wireds);
									unset($result_group_wireds);
									unset($linha_wired);
									$conn->close();
								?>
							</select>
							<br>
							<button class="mdl-button mdl-button--raised mdl-js-button mdl-button--primary mdl-js-ripple-effect">Excluir</button>
						</form>
					</div>
					<?php
						endif
					?>
				</div>
			</main>
		<?php include "includes/footer.php" ?>
	</body>
</html>