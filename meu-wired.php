<?php 
	session_start();
	
	if(!isset($_GET['wired']) or !isset($_GET['shop'])){
		header("location:meu-wired?wired=all&shop=all");
	}
?>
<!DOCTYPE html>
<html dir="ltr" lang="pt-BR">
	<head>
		<meta charset="utf-8">
		<title>Meu Wired - Academia Wired</title>
		<meta name="viewport" content="initial-scale = 1.0, maximum-scale = 1.0, user-scalable = no, width = device-width">
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
		
		<link rel="stylesheet" href="css/style.css" media="screen">
		<link rel="stylesheet" href="css/style.livros.abas.css">
		<link rel="stylesheet" href="css/style.responsive.css" media="all">
		<link rel="stylesheet" href="css/style.painel.css" media="all">
        <link rel="stylesheet" href="css/style.meu.wired.css" media="all">

		<link rel="stylesheet" href="css/font-awesome.min.css">
		<!--<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
		<link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>-->
		
		<script src="js/jquery.js"></script>
		<script src="js/script.js"></script>
		<script src="js/script.responsive.js"></script>
		<script src="js/script.livros.abas.js"></script>

		<style>
			.art-content .art-postcontent-0 .layout-item-0 { padding-right: 10px;padding-left: 10px;}
			.ie7 .art-post .art-layout-cell {border:none !important; padding:0 !important; }
			.ie6 .art-post .art-layout-cell {border:none !important; padding:0 !important; }
			div#filter {
				text-align:center;
			}
			div#filter form select {
				width: 100%;
				max-width: 140px;
				background: #FFFFFF;
				border-radius: 2px;
				-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
				box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
				border: 1px solid #cccccc !important;
				padding:4px !important;
				height: 30px;
				-webkit-box-sizing: border-box;
				-moz-box-sizing: border-box;
				box-sizing: border-box;
				color: #1D2762 !important;
				font-size: 13px;
				font-family: Verdana, Geneva, Arial, Helvetica, Sans-Serif;
				font-weight: normal;
				font-style: normal;
			}
			div#filter form select#select_wired {
				max-width: 300px;
			}
		</style>
	</head>
	<body id="meu-wired">
		<?php include 'includes/header.php';?>
		<article class='art-post art-article'>
			<h2 class="art-postheader">Meu Wired</h2>
			<div class="art-postcontent art-postcontent-0 clearfix">
            	<div id="filter">
                	<form action="meu-wired" method="get">
                    	<select name="wired" id="select_wired">
                        	<option value="all">Todos os Wireds</option>
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
                        <select name="shop">
                        	<option value="all">Todos as trocas</option>
                            <option value="1"<?php if($_GET['shop'] == 1){echo " selected";} ?>>Vendendo</option>
                            <option value="2"<?php if($_GET['shop'] == 2){echo " selected";} ?>>Comprando</option>
                        </select>
                        <input type="submit" value="Filtrar">
                    </form>
                </div>
				<div class="ofertas">
					<?php
						
						include "includes/conn.php";
						
						$data_limite = date('Y-m-d H:i:s', strtotime("-2 day", strtotime(date('Y-m-d H:i:s', strtotime("-5 hours")))));
						$busca = "SELECT * FROM db_meu_wired WHERE meu_wired_data >= '{$data_limite}'";
						$resultado = $conn->query($busca);
						if($resultado->num_rows > 0) {
							$seleciona = "SELECT * FROM (SELECT DISTINCT meu_wired_name, meu_wired_qtd, meu_wired_id, meu_wired_acao, meu_wired_data, meu_wired_user, meu_wired_price, meu_wired_room, meu_wired_sold FROM db_meu_wired WHERE meu_wired_sold = 0 AND meu_wired_data >= '{$data_limite}' GROUP BY meu_wired_name, meu_wired_acao) tab, (SELECT meu_wired_name, meu_wired_acao, COUNT(meu_wired_name) AS qtd FROM db_meu_wired WHERE meu_wired_sold = 0 AND meu_wired_data >= '{$data_limite}' GROUP BY meu_wired_name, meu_wired_acao) tabqtd WHERE tab.meu_wired_name = tabqtd.meu_wired_name AND tab.meu_wired_acao = tabqtd.meu_wired_acao";
							if($_GET['wired'] != "all"){
								$seleciona = "SELECT * FROM db_meu_wired WHERE meu_wired_data >= '{$data_limite}'";
								$linha['qtd'] = 1;
							}
							$result = $conn->query($seleciona);
							if($result->num_rows > 0) {
								while($linha = $result->fetch_assoc()) {
									if(($_GET['wired'] == "all" or $linha['meu_wired_name'] == $_GET['wired']) and ($_GET['shop'] == "all" or $linha['meu_wired_acao'] == $_GET['shop'])) {
										$more_offers = true;
										echo "<div class='all_shop ";
										if ($linha['meu_wired_acao'] == 1){
											echo "selling'><h4>Vendendo";
										} elseif ($linha['meu_wired_acao'] == 2){
											echo "shopping'><h4>Comprando";
										}
										echo "</h4><div class='ico'><img src='";
										$wired_name = $linha['meu_wired_name'];
										$select_img = "SELECT * FROM db_wireds WHERE wired_id_name='{$wired_name}'";
										$result_img = $conn->query($select_img);
										$linha_img = $result_img->fetch_assoc();
										echo $linha_img['wired_ico']."'></div><span class='name'>".$linha_img['wired_name']."</span><br><div class='separator'></div><span class='";
										if(isset($linha['qtd'])){
											if ($linha['qtd'] == 1){
												echo "advertiser'>".$linha['meu_wired_user']."</span><br><div class='separator'></div><span class='price'>".$linha['meu_wired_price'];
												if($linha['meu_wired_price'] == 1){
													echo " câmbio";
												} else {
													echo " câmbios";
												}
												echo "</span><br><div class='separator'></div><span class='units'>".$linha['meu_wired_qtd'];
												if($linha['meu_wired_qtd'] == 1){
													echo " unidade";
												} else {
													echo " unidades";
												}
												echo "</span><div class='separator'></div><span class='room'><a href='".$linha['meu_wired_room']."' target='_blank'>Quarto para negociação</a><span><br><div class='separator'></div><span class='expires'>Esta oferta expira em ".date('d/m/Y', strtotime("+2 day", strtotime($linha['meu_wired_data'])))." às ".date('H:i', strtotime($linha['meu_wired_data']))."</span></div>";
											} else{
												echo "offers'>Existem <a href='?wired=".$linha['meu_wired_name']."&shop=".$linha['meu_wired_acao']."'>".$linha['qtd']." ofertas</a></span></div>";
											}
										} else {
											echo "advertiser'>".$linha['meu_wired_user']."</span><br><div class='separator'></div><span class='price'>".$linha['meu_wired_price'];
											if($linha['meu_wired_price'] == 1){
												echo " câmbio";
											} else {
												echo " câmbios";
											}
											echo "</span><br><div class='separator'></div><span class='units'>".$linha['meu_wired_qtd'];
											if($linha['meu_wired_qtd'] == 1){
												echo " unidade";
											} else {
												echo " unidades";
											}
											echo "</span><div class='separator'></div><span class='room'><a href='".$linha['meu_wired_room']."' target='_blank'>Quarto para negociação</a><span><br><div class='separator'></div><span class='expires'>Esta oferta expira em ".date('d/m/Y', strtotime("+2 day", strtotime($linha['meu_wired_data'])))." às ".date('H:i', strtotime($linha['meu_wired_data']))."</span></div>";
										}
									} //elseif(!isset($more_offers)) {
										//$zero_offers = true;
//										echo "Nenhuma oferta encontrada :'(";
									//}
								}
							} else {
	//							echo "Nenhuma oferta encontrada :'(";
							}
						} else {
//							echo "Nenhuma oferta encontrada :'(";
						}
						if(!isset($more_offers)){
							echo "Nenhuma oferta encontrada :'(";
						}
												
						$conn->close();
						
					?>
				</div>
			</div>
		</article>
		<?php include 'includes/footer.php'; ?>
	</body>
</html>