<?php 

//ini_set('display_errors', 1);
//ini_set('log_errors', 1);
//ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
//error_reporting(E_ALL);

	if(isset($_GET['nm_search'])) {
		header('location: busca.php?nm_search='.$_GET['nm_search']);
	}

	session_start();
	
	if(!isset($_SESSION['view_meu_wired'])){
		$_SESSION['view_meu_wired'] = 0;
	}

	/***
	 * Função para remover acentos de uma string
	 *
	 * @autor Thiago Belem <contato@thiagobelem.net>
	 */
	function removeAcentos($string, $slug = false) {
	  $string = strtolower($string);
	  // Código ASCII das vogais
	  $ascii['a'] = range(224, 230);
	  $ascii['e'] = range(232, 235);
	  $ascii['i'] = range(236, 239);
	  $ascii['o'] = array_merge(range(242, 246), array(240, 248));
	  $ascii['u'] = range(249, 252);
	  // Código ASCII dos outros caracteres
	  $ascii['b'] = array(223);
	  $ascii['c'] = array(231);
	  $ascii['d'] = array(208);
	  $ascii['n'] = array(241);
	  $ascii['y'] = array(253, 255);
	  foreach ($ascii as $key=>$item) {
	    $acentos = '';
	    foreach ($item AS $codigo) $acentos .= chr($codigo);
	    $troca[$key] = '/['.$acentos.']/i';
	  }
	  $string = preg_replace(array_values($troca), array_keys($troca), $string);
	  // Slug?
	  if ($slug) {
	    // Troca tudo que não for letra ou número por um caractere ($slug)
	    $string = preg_replace('/[^a-z0-9]/i', $slug, $string);
	    // Tira os caracteres ($slug) repetidos
	    $string = preg_replace('/' . $slug . '{2,}/i', $slug, $string);
	    $string = trim($string, $slug);
	  }
	  return $string;
	}
?>
<!DOCTYPE html>
<html lang="pt-BR">
	<head>
		<style>
			.td_img {
				width:70px;
				vertical-align:top;
				text-align:center;
				background-position: center 20px;
				background-repeat:no-repeat;
				min-width: 70px;
			}
			table h1 sup {
				font-size: 20px;
				font-weight: normal;
			}
			table h4, table h1 {
				margin-bottom: 0;
				margin-top: 10px;
			}
			.combinacao {
				width:40px;
				height: 40px;
				margin: 6px;
				box-shadow: 0 2px 2px 0 rgba(0,0,0,.14) inset,0 3px 1px -2px rgba(0,0,0,.2) inset,0 1px 5px 0 rgba(0,0,0,.12) inset;
			}
		</style>
		<meta charset="UTF-8">
		<title>
			<?php
				include "includes/conn.php";

				if (!isset($_GET['wired'])) {
					echo "Galeria de Wireds na Academia Wired";
				} else {
					$wired_titulo = $_GET['wired'];
					$busca_wired_titulo = "SELECT wired_name FROM db_wireds WHERE wired_id_name = '{$wired_titulo}'";
					$result_wired_titulo = $conn->query($busca_wired_titulo);
					$linha_wired_titulo = $result_wired_titulo->fetch_assoc();
					echo $linha_wired_titulo['wired_name']." na Academia Wired";
				}
			?>
		</title>
		<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
	    <meta name="viewport" content="initial-scale = 1.0, maximum-scale = 1.0, user-scalable = no, width = device-width">
		<meta name="theme-color" content="rgb(63,81,181)">
		<link rel="icon" sizes="192x192" href="/favicon.png">

		<link rel="stylesheet" href="https://storage.googleapis.com/code.getmdl.io/1.0.2/material.indigo-blue.min.css" /> 
		<script src="https://storage.googleapis.com/code.getmdl.io/1.0.2/material.min.js"></script>
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		
		<link rel="stylesheet" href="/css/style.css" />
		<link rel="stylesheet" href="/css/emojis.css" />
		<link rel="stylesheet" href="/css/style.galeria.de.wireds.css" />
	    <script src="/js/script.js"></script>

		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
		
		<!--
		<link rel="stylesheet" href="offline/material.min.css">
		<script src="offline/material.min.js"></script>
		-->

	</head>
	<body id="pg_ga-de-wi">
		<?php include "includes/header.php" ?>
			<main class="mdl-grid">
				<div class="mdl-cell mdl-cell--10-col-desktop mdl-cell--10-col-tablet mdl-cell--12-col-phone mdl-shadow--2dp" style="margin-left:auto;margin-right:auto;padding: 10px 5px;">
					<?php
						include "includes/conn.php";

						if (!isset($_GET['wired'])) {
							$select_wired_atua = "SELECT wired_atualizado FROM db_wireds ORDER BY wired_atualizado DESC LIMIT 1";
							$result_wired_atua = $conn->query($select_wired_atua);
							$linha_wired_atua = $result_wired_atua->fetch_assoc();

							$select_group_atua = "SELECT wired_group_atualizado FROM db_wireds_group ORDER BY wired_group_atualizado DESC LIMIT 1";
							$result_group_atua = $conn->query($select_group_atua);
							$linha_group_atua = $result_group_atua->fetch_assoc();

							if ($linha_wired_atua['wired_atualizado'] > $linha_group_atua['wired_group_atualizado']) {
								$atualizado = $linha_wired_atua['wired_atualizado'];
							} else {
								$atualizado = $linha_group_atua['wired_group_atualizado'];
							}

							echo "<h6 class='atualizado'>Banco de dados atualizado dia ".date('d/m/y', strtotime($atualizado))." às ".date('H:i', strtotime($atualizado))."</h6>";
					?>
					<h1>Wireds</h1>
					<p>Mobis Wired lhe darão infinitas funções ao juntar Ativadores, Efeitos e opcionalmente Condições e Extras. Cada Ativador, Efeito e Condição poderá ser montado individualmente, e todos podem trabalhar juntos.</p>
					<h2>Como funciona?</h2>
					<p>Para tornar o seu Quarto Wired você precisa conhecer os Mobis:</p>
					<ol>
						<li><b>Ativadores: </b>coisas que você precisa fazer para um Efeito funcionar;</li>
						<li><b>Efeitos:</b> coisas que acontecem quando você liga um Ativador;</li>
						<li><b>Condições (opcionais):</b> as condições necessárias para o Ativador funcionar.</li>
					</ol>
					<p>Cada um destes pode ser programado separadamente. Empilhe seu Ativador com os Efeitos e Condições e eles transformarão o seu Quarto!</p>
					<?php
							echo "<table style='text-align:justify !important'>";
							

								$select_group = "SELECT * FROM db_wireds_group ORDER BY wired_group_id ASC";
								$result_group = $conn->query($select_group);
								while ($linha_group = $result_group->fetch_assoc()) {
									$id_group = $linha_group['wired_group_id'];
									$select_wireds = "SELECT * FROM db_wireds WHERE wired_group_id = '{$id_group}' ORDER BY wired_name ASC";
									$result_wireds = $conn->query($select_wireds);
									echo "<thead>
										<tr>
											<th colspan='2'>
												<h1>".$linha_group['wired_group_name']." <sup>(".$result_wireds->num_rows.")</sup></h1>
											</th>
										</tr>
										<tr>
											<th colspan='2'>
												<p>".$linha_group['wired_group_descricao']."</p>
											</th>
										</tr>
									</thead>
									<tbody>";
										while ($linha_wireds = $result_wireds->fetch_assoc()) {
											echo "<tr>
												<td rowspan='4' class='td_img' style='background-image:url(&#39;".$linha_wireds['wired_ico']."&#39;)'></td>
											</tr>
											<tr>
												<td>
													<h4 class='";
													if ($linha_wireds['wired_body_tutor'] != "") {
														echo "c-tutor";
													} else {
														echo "s-tutor";
													}
													echo"''><a href='?wired=".$linha_wireds['wired_id_name']."'>".$linha_wireds['wired_name']."</a></h4>
												</td>
											</tr>
											<tr>
												<td>".$linha_wireds['wired_descricao']."</td>
											</tr>
											<tr>
												<td>
													<b>Valor oficial:</b> ".$linha_wireds['wired_official_price']." câmbios
												</td>
											</tr>";
										}
									echo "</tbody>";
								}
							echo "</table>
						</div>";
						} elseif (isset($_GET['wired'])) {


/*							$busca_efeitos = "SELECT wired_id_name FROM db_wireds WHERE wired_group_id = 2";
							$result_efeitos = $conn->query($busca_efeitos);
							$k = 123;
							$wired_123 = $_GET['wired'];
							while ($linha_efeitos = $result_efeitos->fetch_assoc()) {
								$efeito_while = $linha_efeitos['wired_id_name'];
								$insere_combinacao = "INSERT INTO db_wireds_combinacoes (wireds_combinacao_funciona, wireds_combinacao_funcao, wireds_combinacao_ativadores, wireds_combinacao_efeitos) VALUES (1, '{$k}', '{$wired_123}', '{$efeito_while}')";
								$result_insere_combinacao = $conn->query($insere_combinacao);
								$k++;
							}*/
/*							$busca_codigos = "SELECT wired_id_name FROM db_wireds";
							$result_codigos = $conn->query($busca_codigos);
							while ($linha_codigos = $result_codigos->fetch_assoc()) {
								$id_abc = $linha_codigos['wired_id_name'];
								$ico = "img/wireds/".$linha_codigos['wired_id_name']."_ico.png";
								$mobi = "img/wireds/".$linha_codigos['wired_id_name']."_mobi_png.png";
								$atualiza_imgs = "UPDATE db_wireds SET wired_ico = '{$ico}', wired_mobi_png = '{$mobi}' WHERE wired_id_name = '{$id_abc}'";
								$result_imgs = $conn->query($atualiza_imgs);
								echo $id_abc." atualizado!";
							}*/

/*								$atualiza_imgs = "UPDATE db_wireds SET wired_altura = 0.37 WHERE wired_group_id = 4";
								$result_imgs = $conn->query($atualiza_imgs);*/






							$id_wired = $_GET['wired'];
							$select_ficha_wired = "SELECT * FROM db_wireds WHERE wired_id_name = '{$id_wired}'";
							$result_ficha_wired = $conn->query($select_ficha_wired);
							$linha_ficha_wired = $result_ficha_wired->fetch_assoc();
							echo "
							<script>
								function abreImg(src){
								    window.open(src);	
								}
							</script>
							<h6 class='atualizado ficha'>Atualizado dia ".date('d/m/y', strtotime($linha_ficha_wired['wired_atualizado']))." às ".date('H:i', strtotime($linha_ficha_wired['wired_atualizado']))."</h6>
							<h1>Ficha do Wired:</h1>
							<span class='official_price'>".$linha_ficha_wired['wired_official_price']."</span>
							<h2>".$linha_ficha_wired['wired_name']."</h2>
							<span class='ficha'>".$linha_ficha_wired['wired_descricao']."</span>
							<div class='mdl-grid' style='text-align:center'>
								<div class='mdl-cell mdl-cell--4-col'>
									<h3>Mobília</h3>
									<div style='max-width:153px;margin:auto;padding:5px' class='mdl-shadow--2dp' id='mobi'>
										<img src='".$linha_ficha_wired['wired_ico']."' onclick='abreImg(&#39;".$linha_ficha_wired['wired_ico']."&#39;)'>
										<br>
										<img src='".$linha_ficha_wired['wired_mobi_png']."' onclick='abreImg(&#39;".$linha_ficha_wired['wired_mobi_png']."&#39;)'>
										<img src='/img/setinha.gif'>
										<img src='".$linha_ficha_wired['wired_mobi_gif']."' onclick='abreImg(&#39;".$linha_ficha_wired['wired_mobi_gif']."&#39;)'>
									</div>
								</div>
								<div class='mdl-cell mdl-cell--8-col mdl-cell--4-col-tablet mdl-grid'>
									<div class='mdl-cell mdl-cell--12-col'>
										<h3>Menu</h3>
									</div>
									<div class='mdl-cell mdl-cell--6-col mdl-cell--4-col-tablet'>
										<h4>pela WEB</h4>
										<div class='mdl-shadow--2dp' id='menu_web' style='background-image:url(&#39;".$linha_ficha_wired['wired_menu_web']."&#39;)' onclick='abreImg(&#39;".$linha_ficha_wired['wired_menu_web']."&#39;)'></div>
									</div>
									<div class='mdl-cell mdl-cell--6-col mdl-cell--4-col-tablet'>
										<h4>pelo APP</h4>
										<div class='mdl-shadow--2dp' id='menu_app' style='background-image:url(&#39;".$linha_ficha_wired['wired_menu_app']."&#39;)' onclick='abreImg(&#39;".$linha_ficha_wired['wired_menu_app']."&#39;)'></div>
									</div>
								</div>
							</div>";
							if ($linha_ficha_wired['wired_group_id'] != 5) {
								echo "<h3>Combinações</h3>";
								$select_num_wireds_groups = "SELECT * FROM db_wireds_group";
								$result_num_wireds_groups = $conn->query($select_num_wireds_groups);
								while ($linha_num_wireds_groups = $result_num_wireds_groups->fetch_assoc()) {
									if ($linha_num_wireds_groups['wired_group_id'] != $linha_ficha_wired['wired_group_id'] AND $linha_num_wireds_groups['wired_group_id'] != 5) {
										echo "<h4>".$linha_num_wireds_groups['wired_group_name']."</h4>";
										echo "<div style='display: flex; flex-flow: row wrap;'>";
										$id_group = $linha_num_wireds_groups['wired_group_id'];
										$select_wireds_secundarios = "SELECT * FROM db_wireds WHERE wired_group_id = '{$id_group}' ORDER BY wired_name";
										$result_wireds_secundarios = $conn->query($select_wireds_secundarios);






										$j = 0;
										$jj = 0;
										while ($linha_wireds_secundarios = $result_wireds_secundarios->fetch_assoc()) {
											$id_name = $linha_wireds_secundarios['wired_id_name'];

											$group_ficha_wired = $linha_ficha_wired['wired_group_id'];
											$select_name_group_ficha_wired = "SELECT * FROM db_wireds_group WHERE wired_group_id = '{$group_ficha_wired}'";
											$result_name_group_ficha_wired = $conn->query($select_name_group_ficha_wired);
											$linha_name_group_ficha_wired = $result_name_group_ficha_wired->fetch_assoc();

											$select_combinacao_funciona = "SELECT * FROM db_wireds_combinacoes WHERE wireds_combinacao_funciona = '1' AND wireds_combinacao_".removeAcentos(utf8_decode($linha_name_group_ficha_wired['wired_group_name']), '_')." = '{$id_wired}' AND wireds_combinacao_".removeAcentos(utf8_decode($linha_num_wireds_groups['wired_group_name']), '_')." = '{$id_name}'";
											$result_combinacao_funciona = $conn->query($select_combinacao_funciona);
											if ($result_combinacao_funciona->num_rows > 0) {
												$j++;
											}

											$select_combinacao_n_funciona = "SELECT * FROM db_wireds_combinacoes WHERE wireds_combinacao_funciona = '0' AND wireds_combinacao_".removeAcentos(utf8_decode($linha_name_group_ficha_wired['wired_group_name']), '_')." = '{$id_wired}' AND wireds_combinacao_".removeAcentos(utf8_decode($linha_num_wireds_groups['wired_group_name']), '_')." = '{$id_name}'";
											$result_combinacao_n_funciona = $conn->query($select_combinacao_n_funciona);
											if ($result_combinacao_n_funciona->num_rows > 0) {
												$jj++;
											}
										}




										if ($j == $result_wireds_secundarios->num_rows) {
											echo "<p>Todos os Wireds desta categoria funcionam com o/a ".$linha_ficha_wired['wired_name']."!</p></div>";
										} elseif ($jj == $result_wireds_secundarios->num_rows) {
											echo "<p>Nenhum Wired desta categoria funciona com o/a ".$linha_ficha_wired['wired_name'].". Vá a página 'Combinar Wireds' para obter mais informações.</p></div>";
										} else {
											$result_wireds_secundarios = $conn->query($select_wireds_secundarios);
											while ($linha_wireds_secundarios = $result_wireds_secundarios->fetch_assoc()) {
												echo "<div id='combinacao_".$linha_wireds_secundarios['wired_id_name']."' class='combinacao' style='background: url(&#39;".$linha_wireds_secundarios['wired_ico']."&#39;) center no-repeat, ";
												$id_name = $linha_wireds_secundarios['wired_id_name'];



												$group_ficha_wired = $linha_ficha_wired['wired_group_id'];
												$select_name_group_ficha_wired = "SELECT * FROM db_wireds_group WHERE wired_group_id = '{$group_ficha_wired}'";
												$result_name_group_ficha_wired = $conn->query($select_name_group_ficha_wired);
												$linha_name_group_ficha_wired = $result_name_group_ficha_wired->fetch_assoc();

												$select_combinacao_funciona = "SELECT * FROM db_wireds_combinacoes WHERE wireds_combinacao_funciona = '1' AND wireds_combinacao_".removeAcentos(utf8_decode($linha_name_group_ficha_wired['wired_group_name']), '_')." = '{$id_wired}' AND wireds_combinacao_".removeAcentos(utf8_decode($linha_num_wireds_groups['wired_group_name']), '_')." = '{$id_name}'";


												$result_combinacao_funciona = $conn->query($select_combinacao_funciona);
												if ($result_combinacao_funciona->num_rows > 0) {
													echo "lightgreen";
												} else {
													$select_combinacao_n_funciona = "SELECT * FROM db_wireds_combinacoes WHERE wireds_combinacao_funciona = '0' AND wireds_combinacao_".removeAcentos(utf8_decode($linha_name_group_ficha_wired['wired_group_name']), '_')." = '{$id_wired}' AND wireds_combinacao_".removeAcentos(utf8_decode($linha_num_wireds_groups['wired_group_name']), '_')." = '{$id_name}'";
													$result_combinacao_n_funciona = $conn->query($select_combinacao_n_funciona);
													if ($result_combinacao_n_funciona->num_rows > 0) {
														echo "lightcoral";
													} else {
														echo "#f6f6f6; -webkit-filter: grayscale(1);filter: grayscale(1)";
													}
												}
												echo ";'></div>";
											}
											echo "</div>";
											$result_wireds_secundarios = $conn->query($select_wireds_secundarios);
											while ($linha_wireds_secundarios_tooltip = $result_wireds_secundarios->fetch_assoc()) {
												$id_name = $linha_wireds_secundarios_tooltip['wired_id_name'];
												$select_combinacao = "SELECT *, rand() FROM db_wireds_combinacoes WHERE wireds_combinacao_".removeAcentos(utf8_decode($linha_name_group_ficha_wired['wired_group_name']), '_')." = '{$id_wired}' AND wireds_combinacao_".removeAcentos(utf8_decode($linha_num_wireds_groups['wired_group_name']), '_')." = '{$id_name}' ORDER BY rand() LIMIT 1";
												$result_combinacao = $conn->query($select_combinacao);
												$linha_combinacao = $result_combinacao->fetch_assoc();

												echo "<div class='mdl-tooltip' for='combinacao_".$linha_wireds_secundarios_tooltip['wired_id_name']."'>";
												if ($result_combinacao->num_rows > 0) {
													if ($linha_combinacao['wireds_combinacao_funciona'] == 0) {
														echo "Esta combinação NÃO funciona, veja um exemplo:";
													} else {
														echo "A combinação destes é funcional, veja um exemplo:";
													}

													$div_combinacao = "<div style='background: ";
													$distancia_y = 0;
													
													$combinacao_extras = explode(",", $linha_combinacao['wireds_combinacao_extras']);
													$combinacao_efeitos = explode(",", $linha_combinacao['wireds_combinacao_efeitos']);
													$combinacao_condicoes = explode(",", $linha_combinacao['wireds_combinacao_condicoes']);
													$combinacao_ativadores = explode(",", $linha_combinacao['wireds_combinacao_ativadores']);

													if ($combinacao_extras[0] != "") {
														for ($i_extras = 0; $i_extras < count($combinacao_extras); $i_extras++) {
															$busca_wired_combinacao_extra = "SELECT * FROM db_wireds WHERE wired_id_name = '{$combinacao_extras[$i_extras]}'";
															$result_wired_combinacao_extra = $conn->query($busca_wired_combinacao_extra);
															$linha_wired_combinacao_extra = $result_wired_combinacao_extra->fetch_assoc();
															$div_combinacao .= "url(&#39;".$linha_wired_combinacao_extra['wired_mobi_png']."&#39;) center ".$distancia_y."px, ";
															$distancia_y += $linha_wired_combinacao_extra['wired_altura'] * 32;
														}
													} if ($combinacao_efeitos[0] != "") {
														for ($i_efeitos = 0; $i_efeitos < count($combinacao_efeitos); $i_efeitos++) {
															$busca_wired_combinacao_efeito = "SELECT * FROM db_wireds WHERE wired_id_name = '{$combinacao_efeitos[$i_efeitos]}'";
															$result_wired_combinacao_efeito = $conn->query($busca_wired_combinacao_efeito);
															$linha_wired_combinacao_efeito = $result_wired_combinacao_efeito->fetch_assoc();
															$div_combinacao .= "url(&#39;".$linha_wired_combinacao_efeito['wired_mobi_png']."&#39;) center ".$distancia_y."px, ";
															$distancia_y += $linha_wired_combinacao_efeito['wired_altura'] * 32;
														}
													} if ($combinacao_condicoes[0] != "") {
														for ($i_condicoes = 0; $i_condicoes < count($combinacao_condicoes); $i_condicoes++) {
															$busca_wired_combinacao_condicao = "SELECT * FROM db_wireds WHERE wired_id_name = '{$combinacao_condicoes[$i_condicoes]}'";
															$result_wired_combinacao_condicao = $conn->query($busca_wired_combinacao_condicao);
															$linha_wired_combinacao_condicao = $result_wired_combinacao_condicao->fetch_assoc();
															$div_combinacao .= "url(&#39;".$linha_wired_combinacao_condicao['wired_mobi_png']."&#39;) center ".$distancia_y."px, ";
															$distancia_y += $linha_wired_combinacao_condicao['wired_altura'] * 32;
														}
													} if ($combinacao_ativadores[0] != "") {
														for ($i_ativadores = 0; $i_ativadores < count($combinacao_ativadores); $i_ativadores++) {
															$busca_wired_combinacao_ativador = "SELECT * FROM db_wireds WHERE wired_id_name = '{$combinacao_ativadores[$i_ativadores]}'";
															$result_wired_combinacao_ativador = $conn->query($busca_wired_combinacao_ativador);
															$linha_wired_combinacao_ativador = $result_wired_combinacao_ativador->fetch_assoc();
															$div_combinacao .= "url(&#39;".$linha_wired_combinacao_ativador['wired_mobi_png']."&#39;) center ".$distancia_y."px, ";
															$distancia_y += $linha_wired_combinacao_ativador['wired_altura'] * 32;
														}
													}
													$distancia_y += 29;
													$div_combinacao .= "; height: ".$distancia_y."px; width:68px; background-repeat:no-repeat; margin: 0 auto;'></div>";
													echo $div_combinacao;
													echo $linha_combinacao['wireds_combinacao_funcao'];
												} else {
													echo "Esta combinação ainda não foi testada. Vá à página 'Combinar Wireds' para enviar um pedido.";
												}
												echo "</div>";

											}
										}
									}
								}
							}
							echo "</div>
							<div class='mdl-cell mdl-cell--10-col-desktop mdl-cell--10-col-tablet mdl-cell--12-col-phone mdl-shadow--2dp' style='margin-left:auto;margin-right:auto;padding: 10px 5px;'>";
							if ($linha_ficha_wired['wired_body_tutor'] != "") {
								echo $linha_ficha_wired['wired_body_tutor'];
							} else {
								echo "<p class='emoji e10 e-40pt text-20pt esps-110px' style='text-align: center;line-height:1.5em;'> Não encontrei nenhum tutorial específico para este Wired. </p>";
							}
							echo "</div>";
						}
					?>
			</main>
		<?php include "includes/footer.php" ?>
	</body>
</html>