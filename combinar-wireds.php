<?php 
	session_start();

	/*if(!isset($_GET['wired']) OR $_GET['wired'] == "" OR !isset($_GET['shop']) OR $_GET['shop'] == "" OR !isset($_GET['advertiser']) OR $_GET['advertiser'] == ""){
		header("location:meu-wired.php?advertiser=all&wired=all&shop=all");
	}*/

?>
<!DOCTYPE html>
<html lang="pt-BR">
	<head>
		<meta charset="UTF-8">
		<title>Combinar Wireds na Academia Wired</title>
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
		<meta name="viewport" content="initial-scale = 1.0, maximum-scale = 1.0, user-scalable = no, width = device-width">
		<meta name="theme-color" content="rgb(63,81,181)">
		<link rel="icon" sizes="192x192" href="favicon.png">
		
		<link rel="stylesheet" href="css/style.css" />
		<link rel="stylesheet" href="css/emojis.css" />
		<link rel="stylesheet" href="css/style.combinar.wireds.css" />
		<script src="js/script.js"></script>
		
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
		<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
		<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
	    <script>
		    function formatWired (wired) {
				if (!wired.id) { return wired.text; }
				var $wired = $(
					'<span><img src="img/wireds/' + wired.element.value.toLowerCase() + '_ico.png" class="img-flag" /> ' + wired.text + '</span>'
				);
				return $wired;
			};
			function titleize(text) {
			    var words = text.toLowerCase().split(" ");
			    for (var a = 0; a < words.length; a++) {
			        var w = words[a];
			        words[a] = w[0];
			    }
			    text = words.join("");

			    text = text.replace(/[àáâãäå]/,"a");
			    text = text.replace(/[èéêë]/,"e");
			    text = text.replace(/[ìíîï]/,"i");
			    text = text.replace(/[ç]/,"c");

			    // o resto

			    return text.replace(/[^a-z0-9]/gi,''); 
			};
	        $(document).ready(function() {
	            $(".select_ativador").select2({
	 	            maximumSelectionLength: 2,
	 	            placeholder: "Selecione o(s) Ativador(es)",
	 	            templateResult: formatWired,
	 	            language: "pt-BR",
					tokenSeparators: [',']
	            });
	        });
	        $(document).ready(function() {
	            $(".select_efeito").select2({
	 	            maximumSelectionLength: 2,
	 	            placeholder: "Selecione o(s) Efeito(s)",
	 	            templateResult: formatWired,
	 	            language: "pt-BR",
					tokenSeparators: [',']
	            });
	        });
	        $(document).ready(function() {
	            $(".select_condicao").select2({
	 	            maximumSelectionLength: 2,
	 	            placeholder: "Selecione a(s) Condição(ões)",
	 	            templateResult: formatWired,
	 	            language: "pt-BR",
					tokenSeparators: [',']
	            });
	        });
	        $(document).ready(function() {
	            $(".select_extra").select2({
	 	            maximumSelectionLength: 2,
	 	            placeholder: "Selecione o(s) Extra(s)",
	 	            templateResult: formatWired,
	 	            language: "pt-BR",
					tokenSeparators: [',']
	            });
	        });
	    </script>
	    <style>
	    	.mdl-cell {
	    		margin: 8px auto;
	    	}
	    </style>
	</head>
	<body id="pg_co-wi">
		<?php include "includes/header.php" ?>
			<main>
				<article class="mdl-grid">
					<div id="filter">
						<form action="meu-wired.php" method="post">
							<select name="" class="select_ativador" multiple onchange="pesquisaCombinacao()">
								<?php
									include "includes/conn.php";

									$busca_ativadores = "SELECT * FROM db_wireds WHERE wired_group_id = 1 ORDER BY wired_name";
									$result_ativadores = $conn->query($busca_ativadores);
									while ($linha_ativadores = $result_ativadores->fetch_assoc()) {
										echo "<option name='nm_ativador' value='".$linha_ativadores['wired_id_name']."'>".$linha_ativadores['wired_name']."</option>";
									}
								?>
							</select>
							<br class='abc'>
							+
							<br class='abc'>
							<select name="" class="select_efeito" multiple onchange="pesquisaCombinacao()">
								<?php

									$busca_ativadores = "SELECT * FROM db_wireds WHERE wired_group_id = 2 ORDER BY wired_name";
									$result_ativadores = $conn->query($busca_ativadores);
									while ($linha_ativadores = $result_ativadores->fetch_assoc()) {
										echo "<option name='nm_efeito' value='".$linha_ativadores['wired_id_name']."'>".$linha_ativadores['wired_name']."</option>";
									}
								?>
							</select>
							<br class='abc'>
							+
							<br class='abc'>
							<select name="" class="select_condicao" multiple onchange="pesquisaCombinacao()">
								<?php

									$busca_ativadores = "SELECT * FROM db_wireds WHERE wired_group_id = 3 ORDER BY wired_name";
									$result_ativadores = $conn->query($busca_ativadores);
									while ($linha_ativadores = $result_ativadores->fetch_assoc()) {
										echo "<option name='nm_condicao' value='".$linha_ativadores['wired_id_name']."'>".$linha_ativadores['wired_name']."</option>";
									}
								?>
							</select>
							<br class='abc'>
							+
							<br class='abc'>
							<select name="" class="select_extra" multiple onchange="pesquisaCombinacao()">
								<?php

									$busca_ativadores = "SELECT * FROM db_wireds WHERE wired_group_id = 4 ORDER BY wired_name";
									$result_ativadores = $conn->query($busca_ativadores);
									while ($linha_ativadores = $result_ativadores->fetch_assoc()) {
										echo "<option name='nm_extra' value='".$linha_ativadores['wired_id_name']."'>".$linha_ativadores['wired_name']."</option>";
									}
								?>
							</select>
						</form>
					</div>
	
					<hr>
					
					<script type="text/javascript">
						function pesquisaCombinacao(){
							var ativador = $('.select_ativador').val();
							var efeito = $('.select_efeito').val();
							var condicao = $('.select_condicao').val();
							var extra = $('.select_extra').val();

							$('#resultado').hide();
							$('.mdl-spinner').show();

							$.post("forms/combinar-wireds.post.php", { nm_ativador: ativador, nm_efeito: efeito, nm_condicao: condicao, nm_extra: extra },
								function(data){
									if(data == ""){
										$('.mdl-spinner').hide();
										$('#resultado').html("<p class='emoji e10 e-40pt text-20pt esps-110px' style='text-align: center;line-height:1.5em;'> Não conheço nenhuma combinação entre estes Wireds! <br> Gostaria de enviar uma solicitação? <a onclick='pedirCombinacao()' href='#'>Sim</a>. </p>");
										$('#resultado').show();
									} else {
										$('.mdl-spinner').hide()
										$('#resultado').show();
										$('#resultado').html(data);
									}
							});
						}

						function pedirCombinacao() {
							var ativador = $('.select_ativador').val();
							var efeito = $('.select_efeito').val();
							var condicao = $('.select_condicao').val();
							var extra = $('.select_extra').val();

							$.post("forms/pedir-combinacao.post.php", { nm_ativador: ativador, nm_efeito: efeito, nm_condicao: condicao, nm_extra: extra },
								function(data) {
									if (data == 1) {
										$('#resultado').html("<p class='emoji e7 e-40pt text-20pt esps-110px' style='text-align: center;line-height:1.5em;'> Eu não conheço nenhuma combinação entre estes Wireds, mas obrigado pela sugestão. Meu desenvolvedor será notificado para testá-los. </p>");
									} else {
										$('#resultado').html("<p class='emoji e6 e-40pt text-20pt esps-110px' style='text-align: center;line-height:1.5em;'> Parece que você fez um pedido a pouco tempo, aguarde um pouco mais para fazer outro. </p>");
									}
								}
							);
						}
					</script>

					<div class='mdl-spinner mdl-spinner--single-color mdl-js-spinner is-active' style='margin: auto; display:none'></div>
					<div id="resultado" style="width:100%">
						<?php
							if (!isset($_GET['id_search'])) {
								echo "<p class='emoji e11 e-40pt text-20pt esps-110px' style='text-align: center'> Selecione acima os Wireds que deseja combinar </p>";
							} else {

								$id = $_GET['id_search'];
								$pesquisa_combinacao_id = "SELECT * FROM db_wireds_combinacoes WHERE wireds_combinacao_id = '{$id}'";
								$resultado_combinacao_id = $conn->query($pesquisa_combinacao_id);
								if ($resultado_combinacao_id->num_rows > 0) {
									echo "<p class='emoji e7 e-40pt text-15pt esps-10px' style='text-align: center'> Você pesquisou pelo ID: ".$id." </p>";
									echo "<div id='resultado_search' class='mdl-grid'>";

									function geraMobis($wired) {
										include "includes/conn.php";

										$busca_wired_combinacao_extra = "SELECT * FROM db_wireds WHERE wired_id_name = '{$wired}'";
										$result_wired_combinacao_extra = $conn->query($busca_wired_combinacao_extra);
										$linha_wired_combinacao_extra = $result_wired_combinacao_extra->fetch_assoc();
										$GLOBALS['div_combinacao'] .= "url(&#39;".$linha_wired_combinacao_extra['wired_mobi_png']."&#39;) center ".$GLOBALS['distancia_y']."px, ";
										$GLOBALS['distancia_y'] += $linha_wired_combinacao_extra['wired_altura'] * 32;
									}
									
									while ($linha_combinacao_id = $resultado_combinacao_id->fetch_assoc()) {
										$div_combinacao = "<div style='background: ";
										$distancia_y = 0;

										$combinacao_extras = explode(",", $linha_combinacao_id['wireds_combinacao_extras']);
										$combinacao_efeitos = explode(",", $linha_combinacao_id['wireds_combinacao_efeitos']);
										$combinacao_condicoes = explode(",", $linha_combinacao_id['wireds_combinacao_condicoes']);
										$combinacao_ativadores = explode(",", $linha_combinacao_id['wireds_combinacao_ativadores']);


										if ($combinacao_extras[0] != "") {
											for ($i_extras = 0; $i_extras < count($combinacao_extras); $i_extras++) {
												geraMobis($combinacao_extras[$i_extras]);
											}
										} if ($combinacao_efeitos[0] != "") {
											for ($i_efeitos = 0; $i_efeitos < count($combinacao_efeitos); $i_efeitos++) {
												geraMobis($combinacao_efeitos[$i_efeitos]);
											}
										} if ($combinacao_condicoes[0] != "") {
											for ($i_condicoes = 0; $i_condicoes < count($combinacao_condicoes); $i_condicoes++) {
												geraMobis($combinacao_condicoes[$i_condicoes]);
											}
										} if ($combinacao_ativadores[0] != "") {
											for ($i_ativadores = 0; $i_ativadores < count($combinacao_ativadores); $i_ativadores++) {
												geraMobis($combinacao_ativadores[$i_ativadores]);
											}
										}
										$distancia_y += 29;
										$div_combinacao .= "; height: ".$distancia_y."px; width:68px; background-repeat:no-repeat; margin: 0 auto;'></div>";

										echo "<div class='mdl-cell mdl-cell--3-col mdl-cell--4-col-tablet mdl-cell--12-col-phone mdl-card mdl-shadow--2dp'><div>#".$linha_combinacao_id['wireds_combinacao_id']." <span class='";
										if ($linha_combinacao_id['wireds_combinacao_funciona'] == 0) {
											echo "red'>NÃO funciona";
										} else {
											echo "green'>FUNCIONA";
										}
										echo "</span></div><hr>";
										echo $div_combinacao;
										echo "<p>".$linha_combinacao_id['wireds_combinacao_funcao']."</p></div>";
									}
									echo "</div>";
								} else {
									echo "<p class='emoji e3 e-40pt text-15pt esps-80px' style='text-align: center'> Não encontrei nenhuma combinação com o ID ".$id." </p>";
								}
							}
						?>
					</div>

					<hr>

					<form action="combinar-wireds.php" method="get" style="margin: 0 auto;">
						<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width: 70px;">
							<input class="mdl-textfield__input" type="number" name="id_search" min="1" width="50px" required/>
							<label class="mdl-textfield__label" for="login-user">ID</label>
						</div>
						<button class="mdl-button mdl-button--raised mdl-js-button mdl-button--primary mdl-js-ripple-effect">Buscar</button>
					</form>
				</article>
				<div class='floating_botton'>
					<?php
						if (isset($_SESSION['permissao_19'])):

							$sql_pedidos_rows = "SELECT * FROM db_wireds_combinacoes_pedidos GROUP BY wireds_combinacoes_pedido_ativadores, wireds_combinacoes_pedido_efeitos, wireds_combinacoes_pedido_condicoes, wireds_combinacoes_pedido_extras, wireds_combinacoes_pedido_tabela_de_classificacao";
							$result_pedidos_rows = $conn->query($sql_pedidos_rows);

					?>
					<a href="#" id="go-floating-cell-add-combinacao" style="overflow:visible" class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--accent mdl-color-text--white<?php if($result_pedidos_rows->num_rows > 0){echo " mdl-badge mdl-badge--no-background' data-badge='".$result_pedidos_rows->num_rows;} ?>' onclick="floatingCard('s', 'cell_1','go-floating-cell-add-combinacao')">Adicionar uma combinação</a>
					<div class='floating_cell cell_1 mdl-cell mdl-cell--10-col mdl-shadow--2dp' style='display:none;'>
						<button class="mdl-button mdl-js-button mdl-button--icon" style="float: right;">
						  <i class="material-icons">close</i>
						</button>
						<h4>Adicionar uma combinação</h4>
						<form class='form_display' style='text-align:center' method='post' action='forms/combinar-wireds-novo.post.php"'>
							<?php
								$sql_pedidos = "SELECT *, (SELECT COUNT(*) AS total_deste FROM db_wireds_combinacoes_pedidos GROUP BY wireds_combinacoes_pedido_ativadores, wireds_combinacoes_pedido_efeitos, wireds_combinacoes_pedido_condicoes, wireds_combinacoes_pedido_extras, wireds_combinacoes_pedido_tabela_de_classificacao LIMIT 1) AS total_deste FROM db_wireds_combinacoes_pedidos GROUP BY wireds_combinacoes_pedido_ativadores, wireds_combinacoes_pedido_efeitos, wireds_combinacoes_pedido_condicoes, wireds_combinacoes_pedido_extras, wireds_combinacoes_pedido_tabela_de_classificacao LIMIT 1";
								$result_pedidos = $conn->query($sql_pedidos);
								if ($result_pedidos->num_rows > 0) {
									$linha_pedidos = $result_pedidos->fetch_assoc();
								} else {
									$linha_pedidos = 0;
								}
							?>
							<div class='mdl-textfield mdl-js-textfield mdl-textfield--floating-label'>
								<input class='mdl-textfield__input' type='text' min='1' name='nm_id' pattern="-?[0-9]*(\.[0-9]+)?" title='Para excluir ou modificar, defina o ID.' rows='3' />
								<label class='mdl-textfield__label' for='id_descricao'>ID</label>
							</div>
							<br>	
							<label class='mdl-radio mdl-js-radio mdl-js-ripple-effect' for='option-0'>
								<input type='radio' id='option-0' class='mdl-radio__button' name='nm_combinacao_funciona' value='0' required />
								<span class='mdl-radio__label'>Não funciona</span>
							</label>
							<label class='mdl-radio mdl-js-radio mdl-js-ripple-effect' for='option-1'>
								<input type='radio' id='option-1' class='mdl-radio__button' name='nm_combinacao_funciona' value='1' required />
								<span class='mdl-radio__label'>Funciona</span>
							</label>
							<br>
							<div class='mdl-textfield mdl-js-textfield mdl-textfield--floating-label'>
								<textarea class='mdl-textfield__input' type='text' rows= '3' id='id_descricao' name='nm_descricao' required ></textarea>
								<label class='mdl-textfield__label' for='id_descricao'>Descrição</label>
							</div>
							<br>

							<?php
								if($linha_pedidos != 0) {
									if ($linha_pedidos['total_deste'] != 1) {
										$plural = "sim";
									}
									echo "<p class='emoji e2 e-20pt text-10pt esps-10px' style='text-align: center;line-height:1.5em;'> ".$linha_pedidos['total_deste']." pessoa";
									if (isset($plural)) {
										echo "s";
									}
									echo " ";
									if (isset($plural)) {
										echo "pesquisaram";
									} else { echo "pesquisou"; }
									echo " esta combinação mas eu não soube respondê-la";
									if (isset($plural)) {
										echo "s";
									}
									echo ", poderia testá-la para mim? O primeiro pedido foi feito ";
									if ($linha_pedidos['wireds_combinacoes_pedido_usuario'] != "") {
										echo "pelo(a) usuário(a) ".$linha_pedidos['wireds_combinacoes_pedido_usuario'];
									} else {
										echo "anônimamente";
									}
									echo ". Há um total de ".$result_pedidos_rows->num_rows." pedidos distintos a serem testados. </p>
										<span>Ativadores: ".$linha_pedidos['wireds_combinacoes_pedido_ativadores']."</span> | 
										<span>Efeitos: ".$linha_pedidos['wireds_combinacoes_pedido_efeitos']."</span> | 
										<span>Condições: ".$linha_pedidos['wireds_combinacoes_pedido_condicoes']."</span> | 
										<span>Extras: ".$linha_pedidos['wireds_combinacoes_pedido_extras']."</span><br>";
								}
							?>
							<br>

							<select name="" class="select_ativador" style="width:200px" multiple>
								<?php
									$pedido_ativadores = explode(",", $linha_pedidos['wireds_combinacoes_pedido_ativadores']);

									include "includes/conn.php";

									$busca_ativadores = "SELECT * FROM db_wireds WHERE wired_group_id = 1";
									$result_ativadores = $conn->query($busca_ativadores);
									while ($linha_ativadores = $result_ativadores->fetch_assoc()) {
										echo "<option name='nm_ativador'";

										for ($i = 0; $i < count($pedido_ativadores); $i++) {
											if ($linha_ativadores['wired_id_name'] == $pedido_ativadores[$i]) {
												echo " selected";
											}
										}

										echo " value='".$linha_ativadores['wired_id_name']."'>".$linha_ativadores['wired_name']."</option>";
									}
								?>
							</select>
							<br class='abc'>
							+
							<br class='abc'>
							<select name="" class="select_efeito" style="width:170px" multiple>
								<?php
									$pedido_efeitos = explode(",", $linha_pedidos['wireds_combinacoes_pedido_efeitos']);

									$busca_efeitos = "SELECT * FROM db_wireds WHERE wired_group_id = 2";
									$result_efeitos = $conn->query($busca_efeitos);
									while ($linha_efeitos = $result_efeitos->fetch_assoc()) {
										echo "<option name='nm_efeito'";

										for ($i = 0; $i < count($pedido_efeitos); $i++) {
											if ($linha_efeitos['wired_id_name'] == $pedido_efeitos[$i]) {
												echo " selected";
											}
										}

										echo " value='".$linha_efeitos['wired_id_name']."'>".$linha_efeitos['wired_name']."</option>";
									}
								?>
							</select>
							<br class='abc'>
							+
							<br class='abc'>
							<select name="" class="select_condicao" style="width:200px" multiple>
								<?php
									$pedido_condicoes = explode(",", $linha_pedidos['wireds_combinacoes_pedido_condicoes']);

									$busca_condicoes = "SELECT * FROM db_wireds WHERE wired_group_id = 3";
									$result_condicoes = $conn->query($busca_condicoes);
									while ($linha_condicoes = $result_condicoes->fetch_assoc()) {
										echo "<option name='nm_condicao'";

										for ($i = 0; $i < count($pedido_condicoes); $i++) {
											if ($linha_condicoes['wired_id_name'] == $pedido_condicoes[$i]) {
												echo " selected";
											}
										}

										echo " value='".$linha_condicoes['wired_id_name']."'>".$linha_condicoes['wired_name']."</option>";
									}
								?>
							</select>
							<br class='abc'>
							+
							<br class='abc'>
							<select name="" class="select_extra" style="width:170px" multiple>
								<?php
									$pedido_extras = explode(",", $linha_pedidos['wireds_combinacoes_pedido_extras']);

									$busca_extras = "SELECT * FROM db_wireds WHERE wired_group_id = 4";
									$result_extras = $conn->query($busca_extras);
									while ($linha_extras = $result_extras->fetch_assoc()) {
										echo "<option name='nm_extra'";

										for ($i = 0; $i < count($pedido_extras); $i++) {
											if ($linha_extras['wired_id_name'] == $pedido_extras[$i]) {
												echo " selected";
											}
										}

										echo " value='".$linha_extras['wired_id_name']."'>".$linha_extras['wired_name']."</option>";
									}
								?>
							</select>
							<br>
							<br>
							<button class='mdl-button mdl-js-button mdl-button--raised mdl-button--colored'>
								Enviar
							</button>
						</form>
					</div>
					<?php
						endif
					?>
				</div>
				<?php

				if (isset($_POST['nm_combinacao_funciona'])) {
					$funciona = $_POST['nm_combinacao_funciona'];
					$descricao = $_POST['nm_descricao'];
					$ativadores = $_POST['nm_ativadores'];
					$efeitos = $_POST['nm_efeitos'];
					$condicoes = $_POST['nm_condicoes'];
					$extras = $_POST['nm_extras'];

					$insert_combinacao = "INSERT INTO db_wireds_combinacoes (wireds_combinacao_funciona, wireds_combinacao_funcao, wireds_combinacao_ativadores, wireds_combinacao_efeitos, wireds_combinacao_condicoes, wireds_combinacao_extras) VALUES ('{$funciona}', '{$descricao}', '{$ativadores}', '{$efeitos}', '{$condicoes}', '{$extras}')";
					$result_inset_combinacao = $conn->query($insert_combinacao);

				} elseif (isset($_POST['nm_ativador_excl'])) {
					$ativador_excl = $_POST['nm_ativador_excl'];
					$efeito_excl = $_POST['nm_efeito_excl'];
					$condicao_excl = $_POST['nm_condicao_excl'];
					$extra_excl = $_POST['nm_extra_excl'];

					$i_excl = 0;
					$delete_combinacao = "DELETE FROM db_wireds_combinacoes WHERE wireds_combinacao_ativadores = '{$ativador_excl}' AND ";
					if ($efeito_excl != "") {
						$delete_combinacao .= "wireds_combinacao_efeitos = '{$efeito_excl}'";
						$i_excl++;
					}
					if ($condicao_excl != "") {
						if ($i_excl > 0) {
							$delete_combinacao .= " AND ";
							$i_excl--;
						}
						$delete_combinacao .= "wireds_combinacao_condicoes = '{$condicao_excl}'";
						$i_excl++;
					}
					if ($extra_excl != "") {
						if ($i_excl > 0) {
							$delete_combinacao .= " AND ";
							$i_excl--;
						}
						$delete_combinacao .= "wireds_combinacao_extras = '{$extra_excl}'";
					}
					$result_delete_combinacao = $conn->query($delete_combinacao);
				}
				?>
			</main>
		<?php include "includes/footer.php" ?>
	</body>
</html>