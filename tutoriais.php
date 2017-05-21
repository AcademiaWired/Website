<?php 
	session_start();
	
	if (!isset($_SESSION['view_meu_wired'])) {
		$_SESSION['view_meu_wired'] = 0;
	}
?>
<!DOCTYPE html>
<html lang="pt-BR">
	<head>
		<meta charset="UTF-8">
		<title><?php if(isset($_GET['url'])){
			include "includes/conn.php";
			$url = $_GET['url'];
			$select_url = "SELECT * FROM db_posts WHERE post_url = '{$url}'";
			$result_url = $conn->query($select_url);
			$linha_url = $result_url->fetch_assoc();
			echo $linha_url['post_title']." - ";
		} ?>Tutoriais da Academia Wired</title>
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
		
		<link rel="stylesheet" href="/css/style.css" />
		<link rel="stylesheet" href="/css/emojis.css" />
	    <script src="/js/script.js"></script>
	    <script type="/text/javascript">
			function likeUpDown(id, like){
				var ativador = $('#ativador').val();
				var efeito = $('#efeito').val();
				var condicao = $('#condicao').val();
				var extra = $('#extra').val();

				$('#resultado').hide();
				$('.mdl-spinner').show();

				$.post("forms/like_coment.post.php", { like: like, id: id },
					function(data){
						if(data == ""){
							$('#likes_' + id).html("erro");
						} else {
							$('#likes_' + id).html(data);
						}
				});
			}
		</script>
	</head>
	<body id="pg_tu">
		<?php include "includes/header.php" ?>
			<main>

				
				<article class="mdl-grid"
					<?php
						if (isset($_GET['url'])) {
							echo " style='max-width: 800px;margin-left: auto;margin-right: auto;'";
						}
						echo ">";
					?>


					<?php
						include 'includes/conn.php';
						
						if(!isset($_GET['url']) AND !isset($_GET['catg']) AND !isset($_GET['new_tutor'])){
							$data_atual = date('Y-m-d H:i', strtotime("-5 hours"));
							if (isset($_GET['pg'])) {
								$pg = $_GET['pg']* 12 - 12;
							} else {
								$pg = 0;
							}
							$selecao = "SELECT * FROM db_posts WHERE post_data_postado <= '{$data_atual}' ORDER BY post_data_postado DESC LIMIT 12 OFFSET {$pg}";
							$result = $conn->query($selecao);

							if ($result->num_rows > 0) {
								$p = 1;
								while($linha = $result->fetch_assoc()) {
									$pega_tags = "SELECT * FROM db_posts_tags WHERE post_tag_id = '{$linha['post_id']}'";
									$result_tags = $conn->query($pega_tags);
									$pega_coments = "SELECT coment_id FROM db_posts_coments WHERE coment_post_id = '{$linha['post_id']}'";
									$result_coments = $conn->query($pega_coments);
									if ($result_coments->num_rows < 100) {
										$num_coments = $result_coments->num_rows;
									} else {
										$num_coments = "+99";
									}
									$body = explode('<!--more-->', $linha['post_body']);
									echo "<div class='mdl-cell mdl-cell--4-col mdl-card mdl-shadow--2dp'><a href='?url=".$linha['post_url']."' style='text-decoration: none;'><div class='mdl-card__title mdl-card--expand mdl-color-text--blue card-post' style='background-image: url(&#39;".$linha['post_capa']."&#39;)'><h3 class='mdl-card__title-text'>".$linha['post_title']."</h3></div></a><div class='mdl-card__supporting-text'><b>#".$linha['post_id']."</b> &#187; ".$linha['post_descricao']."</div><div class='mdl-card__supporting-text mdl-card--border card-post'><div class='card-post-autor' style='background: url(&#39;../img/braco.png&#39;) no-repeat center -11px, url(&#39;../img/mesa.png&#39;) no-repeat 12px 16px, url(&#39;http://www.habbo.com.br/habbo-imaging/avatarimage?user=".$linha['post_user_post']."&action=sit,crr=0&size=s&#39;) no-repeat center -11px, url(&#39;../img/cadeira.png&#39;) no-repeat 7px 13px, #f5f5f5'></div><div class='card-post-infos'><b class='mdl-color-text--blue'>".$linha['post_user_post']."</b><span>".date('d/m/Y', strtotime($linha['post_data_postado']))." às ".date('H:i', strtotime($linha['post_data_postado']))."</span></div><button style='overflow: initial;float:right;margin:0 0 0 auto;cursor:auto' class='mdl-button mdl-js-button mdl-button--icon";
									if ($num_coments != 0) {
										echo " mdl-button--colored mdl-badge";
									}
									echo "' data-badge='".$num_coments."'><i class='material-icons'>chat</i></button></div>";
									$categoria = $linha['post_categoria'];
									$select_catg = "SELECT * FROM db_posts_categorias WHERE categoria_nome = '{$categoria}'";
									$result_catg = $conn->query($select_catg);
									$linha_catg = $result_catg->fetch_assoc();
									echo "<div id='postagem_".$p."' class='mdl-card__menu ico_catg'><button onclick='location.href=&#39;?catg=".$linha_catg['categoria_ico']."&#39;' class='mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect'><i class='material-icons'>".$linha_catg['categoria_ico']."</i></button></div><span class='mdl-tooltip' for='postagem_".$p."'>Ver mais de:<br>".$linha_catg['categoria_nome']."</span></div>";
									$p++;
								}
							} else {
								echo "<div style='text-align: center; width: 100%'><p class='emoji e9 e-40pt text-20pt esps-110px''> Não encontrei nenhuma postagem </p></div>";
							}
								
						} elseif (isset($_GET['url']) AND !isset($_GET['catg']) AND !isset($_GET['new_tutor'])) {
							if (isset($_GET['url']) AND isset($_GET['exc']) AND isset($_SESSION['logado'])) {
								$post = $_GET['url'];
								$coment = $_GET['exc'];

								$verifica_coment_user = "SELECT coment_user FROM db_posts_coments WHERE coment_id = '{$coment}'";
								$result_coment_user = $conn->query($verifica_coment_user);
								$linha_coment_user = $result_coment_user->fetch_assoc();
								if ($_SESSION['nick_logado'] == $linha_coment_user['coment_user']) {
									$deleta_coment = "DELETE FROM db_posts_coments WHERE coment_id = '{$coment}'";
									$result_deleta_coment = $conn->query($deleta_coment);
								}
							} 
							$url = $_GET['url'];
							$select_url = "SELECT * FROM db_posts WHERE post_url = '{$url}'";
							$result_url = $conn->query($select_url);
							if ($result_url->num_rows > 0) {
								$linha_url = $result_url->fetch_assoc();
								$post_id = $linha_url['post_id'];
								$select_tags = "SELECT post_tag_name FROM db_posts_tags WHERE post_tag_id = '{$post_id}'";
								$result_tags = $conn->query($select_tags);
								echo "<div class='mdl-card mdl-shadow--4dp mdl-cell mdl-cell--12-col'>
									<div class='mdl-card__media mdl-card--expand mdl-color-text--blue card-post' style='padding:0'>
										<div style='text-align: center; width:100%'>
											<iframe width='640' height='360' src='https://www.youtube.com/embed/".$linha_url['post_embed']."' frameborder='0' allowfullscreen></iframe>
										</div>
									</div>
									<div class='mdl-card__supporting-text mdl-card--border card-post' style='width:calc(100% - 32px)'>
										<div id='post-autor'>
											<div class='card-post-autor' style='background: url(&#39;../img/braco.png&#39;) no-repeat center -11px, url(&#39;../img/mesa.png&#39;) no-repeat 12px 16px, url(&#39;http://www.habbo.com.br/habbo-imaging/avatarimage?user=".$linha_url['post_user_post']."&action=sit,crr=0&size=s&#39;) no-repeat center -11px, url(&#39;../img/cadeira.png&#39;) no-repeat 7px 13px, #f5f5f5'></div>
											<div class='card-post-infos'>
												<span>Autor: <b class='mdl-color-text--blue'>".$linha_url['post_user_post']."</b></span>
												<span>".date('d/m/Y', strtotime($linha_url['post_data_postado']))." às ".date('H:i', strtotime($linha_url['post_data_postado']))."</span>
											</div>
										</div>";
										if ($linha_url['post_user_edit'] != "") {
											echo "<div class='mdl-layout-spacer'></div>
											<div id='post-editor'>
												<div class='card-post-infos'>
													<span>Editor: <b class='mdl-color-text--blue'>".$linha_url['post_user_edit']."</b></span>
													<span>".date('d/m/Y', strtotime($linha_url['post_data_editado']))." às ".date('H:i', strtotime($linha_url['post_data_editado']))."</span>
												</div>
												<div class='card-post-editor' style='background: url(&#39;../img/braco.png&#39;) no-repeat center -11px, url(&#39;../img/mesa.png&#39;) no-repeat 12px 16px, url(&#39;http://www.habbo.com.br/habbo-imaging/avatarimage?user=".$linha_url['post_user_edit']."&action=sit,crr=0&size=s&#39;) no-repeat center -11px, url(&#39;../img/cadeira.png&#39;) no-repeat 7px 13px, #f5f5f5'></div>
											</div>";
										}
										$c = 1;
									echo "</div>
									<div class='mdl-card__supporting-text post-body' style='width: calc(100% - 32px);'>".$linha_url['post_body']."
										<div>
											<hr>
											<i class='material-icons md-13'>label</i> <b>Wireds usados:</b> ";
											$t = 0;
											while ($linha_tags = $result_tags->fetch_assoc()) {
												if ($t > 0) {
													echo " | ";
												}
												echo $linha_tags['post_tag_name'];
												$t++;
											}
										echo "</div>
									</div>
								</div>
								<div class='mdl-card mdl-shadow--4dp mdl-cell mdl-cell--12-col new-coment'>";
									if (isset($_SESSION['logado'])) {
										echo "<form method='post' action='forms/novo.coment.post.php?id=".$linha_url['post_id']."'>
											<div class='mdl-textfield mdl-js-textfield mdl-textfield--floating-label'>
												<input class='mdl-textfield__input' type='text' id='input_".$c."' name='nm_coment' />
												<label class='mdl-textfield__label' for='input_".$c."'>Publicar comentário</label>
											</div>
											<button class='mdl-button mdl-button--raised mdl-js-button mdl-button--primary mdl-js-ripple-effect'>Publicar</button>
										</form>";
										$cc = "input_".$c;
									} else {
										echo "<div class='sem-comentar'>Você precisa <a href='entrar.php'>fazer login</a> para comentar a postagem</div>";
									}
								echo "</div>";
								$c++;
								$select_coment = "SELECT * FROM db_posts_coments WHERE coment_post_id = '{$post_id}' AND coment_child_of = '0' ORDER BY coment_data DESC";
								$result_coment = $conn->query($select_coment);
								if ($result_coment->num_rows > 0) {
									while($linha_coment = $result_coment->fetch_assoc()) {
										$coment_id = $linha_coment['coment_id'];
										echo "<div class='mdl-card mdl-shadow--4dp mdl-cell mdl-cell--12-col coment'>
											<header id='".$coment_id."' class='coment-header'>
												<div class='coment-autor' style='background: url(&#39;../img/balao_fala_small.png&#39;) no-repeat 28px 2px, url(&#39;http://www.habbo.com.br/habbo-imaging/avatarimage?user=".$linha_coment['coment_user']."&action=sit&gesture=spk&size=s&#39;) no-repeat center -8px, url(&#39;../img/bonnie";
												if ($linha_coment['coment_user'] == $linha_url['post_user_post'] OR $linha_coment['coment_user'] == $linha_url['post_user_edit']) {
													echo "_adm";
												}
												echo ".png&#39;) no-repeat center 30px, #F5F5F5'></div>
												<div class='coment-details'>
													<b";
													if ($linha_coment['coment_user'] == $linha_url['post_user_post'] OR $linha_coment['coment_user'] == $linha_url['post_user_edit']) {
														echo " class='mdl-color-text--blue'";
													}
													echo ">".$linha_coment['coment_user']."</b>
													<span>".date('d/m/Y', strtotime($linha_coment['coment_data']))." às ".date('H:i', strtotime($linha_coment['coment_data']))."</span>
												</div>
												<div class='mdl-card__menu'>
													<button id='menu-card".$c."' class='mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon'>
														<i class='material-icons'>more_vert</i>
													</button>
													<ul class='mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect' for='menu-card".$c."'>";
														if (isset($_SESSION['nick_logado'])) {
										  					if ($_SESSION['nick_logado'] != $linha_coment['coment_user']) {
										  						echo "<li class='mdl-menu__item'>Denunciar</li>";
										  					} else {
										  						echo "<a href='?url=".$linha_url['post_url']."&exc=".$linha_coment['coment_id']."'><li class='mdl-menu__item' title='Fazendo isto você irá ocultar as respostas ao seu comentário'>Excluir</li></a>";
										  					}
										  				} else {
										  					echo "<li class='mdl-menu__item'>Denunciar</li>";
										  				}
													echo "</ul>";
													$c++;
												echo "</div>
											</header>
											<div class='coment-text'>
												<p>".$linha_coment['coment_body']."</p>
											</div>";
											
												$com_id = $linha_coment['coment_id'];
												if (isset($_SESSION['nick_logado'])) {
													$usuario = $_SESSION['nick_logado'];
												}
												echo "<nav class='coment-actions' id='likes_".$linha_coment['coment_id']."'>
													<button class='mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon'";
													if (isset($_SESSION['nick_logado'])) {
														echo " onclick='likeUpDown(".$linha_coment['coment_id'].", &#39;1&#39;)'";

														$busca_user_liked = "SELECT * FROM db_posts_coments_likes WHERE posts_coments_like_coment_id = '{$com_id}' AND posts_coments_like_user = '{$usuario}'";
														$result_user_liked = $conn->query($busca_user_liked);
														$linha_user_liked = $result_user_liked->fetch_assoc();

													} else {
														echo "disabled";
													}
														echo ">
														<i class='fa fa-thumbs";
														if (isset($_SESSION['nick_logado'])) {
															if ($linha_user_liked['posts_coments_like_updown'] != 1) {echo "-o";}
														}
														echo"-up'></i>
													</button>
													<span class='";
													$busca_likes = "SELECT * FROM db_posts_coments_likes WHERE posts_coments_like_coment_id = '{$com_id}'";
													$result_likes = $conn->query($busca_likes);
													if ($result_likes->num_rows > 0) {
														$likes = 0;
														while ($linha_likes = $result_likes->fetch_assoc()) {
															$likes += $linha_likes['posts_coments_like_updown'];
														}

														if ($likes < 0) {echo "red";}
														if ($likes > 0) {echo "green";}
													} else {$likes = 0;}
													echo "' title='Há um total de ".$result_likes->num_rows." ";
													if ($result_likes->num_rows != 1) {
														echo "avaliações";
													} else {
														echo "avaliação";
													}
													echo "'>".$likes."</span>
													<button class='mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon'";
													if (isset($_SESSION['nick_logado'])) {
														echo " onclick='likeUpDown(".$linha_coment['coment_id'].", &#39;-1&#39;)'";
													} else {
														echo "disabled";
													}
														echo ">
														<i class='fa fa-thumbs";
														if (isset($_SESSION['nick_logado'])) {
															if ($linha_user_liked['posts_coments_like_updown'] != -1) {echo "-o";}
														}
														echo"-down'></i>
													</button>
												</nav>";
											echo "<div class='coment-answers'>";
												$select_coment_child = "SELECT * FROM db_posts_coments WHERE coment_post_id = '{$post_id}' AND coment_child_of = '{$coment_id}'";
												$result_coment_child = $conn->query($select_coment_child);
												if ($result_coment_child->num_rows > 0) {
													$l = 0;
													while ($linha_coment_child = $result_coment_child->fetch_assoc()) {
														if ($l == 1) {echo "<hr>";}
														echo "<header class='answers-header' style='position:relative'>
															<div class='answers-autor' style='background: url(&#39;../img/balao_fala_small.png&#39;) no-repeat 26px 2px, url(&#39;http://www.habbo.com.br/habbo-imaging/avatarimage?user=".$linha_coment_child['coment_user']."&action=sit&gesture=spk&size=s&#39;) no-repeat center -8px, url(&#39;../img/bonnie";
																if ($linha_coment['coment_user'] == $linha_url['post_user_post'] OR $linha_coment['coment_user'] == $linha_url['post_user_edit']) {
																	echo "_adm";
																}
															echo ".png&#39;) no-repeat center 30px, #F5F5F5'></div>
															<div class='answers-details'>
																<b";
																	if ($linha_coment['coment_user'] == $linha_url['post_user_post'] OR $linha_coment['coment_user'] == $linha_url['post_user_edit']) {
																		echo " class='mdl-color-text--blue'";
																	}
																echo ">".$linha_coment_child['coment_user']."</b>
																<span>".date('d/m/Y', strtotime($linha_coment_child['coment_data']))." às ".date('H:i', strtotime($linha_coment_child['coment_data']))."</span>
															</div>
															<div class='mdl-card__menu'>
																<button id='menu-card".$c."' class='mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon'>
																	<i class='material-icons'>keyboard_arrow_down</i>
																</button>
																<ul class='mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect' for='menu-card".$c."'>";
										  							if (isset($_SESSION['nick_logado'])) {
												  						if ($_SESSION['nick_logado'] != $linha_coment_child['coment_user']) {
												  							echo "<li class='mdl-menu__item'>Denunciar</li>";
												  						} else {
												  							echo "<a href='?url=".$linha_url['post_url']."&exc=".$linha_coment_child['coment_id']."'><li class='mdl-menu__item'>Excluir</li></a>";
												  						}
												  					} else {
												  						echo "<li class='mdl-menu__item'>Denunciar</li>";
												  					}
																echo "</ul>";
																$c++;
															echo "</div>
														</header>
														<div class='answers-text'><p>".$linha_coment_child['coment_body']."</p></div>";
											
														$com_id = $linha_coment_child['coment_id'];
														if (isset($_SESSION['nick_logado'])) {
															$usuario = $_SESSION['nick_logado'];
														}
														echo "<nav class='coment-actions' id='likes_".$linha_coment_child['coment_id']."'>
															<button class='mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon'";
															if (isset($_SESSION['nick_logado'])) {
																echo " onclick='likeUpDown(".$linha_coment_child['coment_id'].", &#39;1&#39;)'";

																$busca_user_liked = "SELECT * FROM db_posts_coments_likes WHERE posts_coments_like_coment_id = '{$com_id}' AND posts_coments_like_user = '{$usuario}'";
																$result_user_liked = $conn->query($busca_user_liked);
																$linha_user_liked = $result_user_liked->fetch_assoc();

															} else {
																echo "disabled";
															}
																echo ">
																<i class='fa fa-thumbs";
																if (isset($_SESSION['nick_logado'])) {
																	if ($linha_user_liked['posts_coments_like_updown'] != 1) {echo "-o";}
																}
																echo"-up'></i>
															</button>
															<span class='";
															$busca_likes = "SELECT * FROM db_posts_coments_likes WHERE posts_coments_like_coment_id = '{$com_id}'";
															$result_likes = $conn->query($busca_likes);
															if ($result_likes->num_rows > 0) {
																$likes = 0;
																while ($linha_likes = $result_likes->fetch_assoc()) {
																	$likes += $linha_likes['posts_coments_like_updown'];
																}

																if ($likes < 0) {echo "red";}
																if ($likes > 0) {echo "green";}
															} else {$likes = 0;}
															echo "' title='Há um total de ".$result_likes->num_rows." ";
															if ($result_likes->num_rows != 1) {
																echo "avaliações";
															} else {
																echo "avaliação";
															}
															echo "'>".$likes."</span>
															<button class='mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon'";
															if (isset($_SESSION['nick_logado'])) {
																echo " onclick='likeUpDown(".$linha_coment_child['coment_id'].", &#39;-1&#39;)'";
															} else {
																echo "disabled";
															}
																echo ">
																<i class='fa fa-thumbs";
																if (isset($_SESSION['nick_logado'])) {
																	if ($linha_user_liked['posts_coments_like_updown'] != -1) {echo "-o";}
																}
																echo"-down'></i>
															</button>
														</nav>";
														$l = 1;
													}
												}
											echo "</div>
											<div class='coment-form-answers'>";
												if (isset($_SESSION['logado'])) {
													echo "<form method='post' action='forms/novo.coment.post.php?id=".$linha_url['post_id']."&c=".$linha_coment['coment_id']."'>
														<div class='mdl-textfield mdl-js-textfield mdl-textfield--floating-label'>
															<input class='mdl-textfield__input' type='text' id='input_".$c."' name='nm_coment' />
															<label class='mdl-textfield__label' for='input_".$c."'>Responder comentário</label>
														</div>
														<button class='mdl-button mdl-button--raised mdl-js-button mdl-button--primary mdl-js-ripple-effect'>Responder</button>
													</form>";
												} else {
													echo "<div class='sem-comentar'>Você precisa <a href='entrar.php'>fazer login</a> para responder um comentário</div>";
												}
											echo "</div>";
											$c++;
										echo "</div>";
									}
								} else {
										echo "<div style='text-align: center; width: 100%'><p class='emoji e9 e-40pt text-20pt esps-110px'> Ainda não fizeram nenhum comentário nesta postagem </p></div>";
								}
							} else {
								echo "<div style='text-align: center; width: 100%'><p class='emoji e9 e-40pt text-20pt esps-110px''> Não encontrei nenhuma postagem com essa URL </p></div>";
							}
						} elseif (!isset($_GET['url']) AND isset($_GET['catg']) AND !isset($_GET['new_tutor'])) {
							$categoria = $_GET['catg'];
							$select_busc_catg = "SELECT categoria_nome FROM db_posts_categorias WHERE categoria_ico = '{$categoria}'";
							$result_busc_catg = $conn->query($select_busc_catg);
							$linha_busc_catg = $result_busc_catg->fetch_assoc();
							$post_catg = $linha_busc_catg['categoria_nome'];

							$select_busc_post = "SELECT * FROM db_posts WHERE post_categoria = '{$post_catg}'";
							$result_busc_post = $conn->query($select_busc_post);

							if ($result_busc_post->num_rows > 0) {
								$p_busc_post = 1;
								echo "<div style='width:100%'><span>Exibindo ".$result_busc_post->num_rows." postage";
								if ($result_busc_post->num_rows == 1) {
									echo "m";
								} elseif ($result_busc_post->num_rows > 1) {
									echo "ns";
								}
								echo " na categoria <b>".$post_catg."</b>. <a href='?'>Mostrar todas</a> as postagens.</span></div>";
								while ($linha_busc_post = $result_busc_post->fetch_assoc()) {
									$id_busc_post = $linha_busc_post['post_id'];
									$pega_coments_busc_post = "SELECT coment_id FROM db_posts_coments WHERE coment_post_id = '{$id_busc_post}'";
									$result_coments_busc_post = $conn->query($pega_coments_busc_post);
									if ($result_coments_busc_post->num_rows < 100) {
										$num_coments_busc_post = $result_coments_busc_post->num_rows;
									} else {
										$num_coments_busc_post = "+99";
									}
									echo "<div class='mdl-cell mdl-cell--4-col mdl-card mdl-shadow--2dp'><a href='?url=".$linha_busc_post['post_url']."' style='text-decoration: none;'><div class='mdl-card__title mdl-card--expand mdl-color-text--blue card-post' style='background-image: url(&#39;".$linha_busc_post['post_capa']."&#39;)'><h3 class='mdl-card__title-text'>".$linha_busc_post['post_title']."</h3></div></a><div class='mdl-card__supporting-text'>".$linha_busc_post['post_descricao']."</div><div class='mdl-card__supporting-text mdl-card--border card-post'><div class='card-post-autor' style='background: url(&#39;../img/braco.png&#39;) no-repeat center -11px, url(&#39;../img/mesa.png&#39;) no-repeat 12px 16px, url(&#39;http://www.habbo.com.br/habbo-imaging/avatarimage?user=".$linha_busc_post['post_user_post']."&action=sit,crr=0&size=s&#39;) no-repeat center -11px, url(&#39;../img/cadeira.png&#39;) no-repeat 7px 13px, #f5f5f5'></div><div class='card-post-infos'><b class='mdl-color-text--blue'>".$linha_busc_post['post_user_post']."</b><span>".date('d/m/Y', strtotime($linha_busc_post['post_data_postado']))." às ".date('H:i', strtotime($linha_busc_post['post_data_postado']))."</span></div><button style='overflow: initial;float:right;margin:0 0 0 auto;' class='mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon";
									if ($num_coments_busc_post != 0) {
										echo " mdl-button--colored mdl-badge";
									}
									echo "' data-badge='".$num_coments_busc_post."'><i class='material-icons'>chat</i></button></div>";
									echo "</div>";
									$p_busc_post++;
								}
							} else {
								echo "<div style='text-align: center; width: 100%'><p class='emoji e9 e-40pt text-20pt esps-110px''> Não encontrei nenhuma postagem dessa categoria. <a href='?'>Voltar</a>. </p></div>";
							}
						} if (isset($_GET['new_tutor']) AND (isset($_SESSION['permissao_2']) OR isset($_SESSION['permissao_7']))):
					?>
						<div class='mdl-cell mdl-cell--10-col mdl-shadow--2dp' style="margin:auto;padding:5px">
							<button class="mdl-button mdl-js-button mdl-button--icon" style="float: right;" onclick="window.history.go(-1); return false;">
							  <i class="material-icons">close</i>
							</button>
							<h4>Gerenciador de postagens</h4>
							<form method='post' style='text-align:center' action='forms/gerencia.blog.post.php'>
								Para excluir ou editar, defina o ID da postagem.
								<br>
								<div class='mdl-textfield mdl-js-textfield mdl-textfield--floating-label' style="width:50px">
									<input class='mdl-textfield__input' type='number' name='nm_gb_id' id='input_gb_id' min='1'/>
									<label class='mdl-textfield__label' for='input_gb_id'>ID</label>
								</div>
								<hr>
								<script>
								function removerAcentos( newStringComAcento, slug ) {
								  var string = newStringComAcento;
									var mapaAcentosHex 	= {
										a : /[\xE0-\xE6]/g,
										e : /[\xE8-\xEB]/g,
										i : /[\xEC-\xEF]/g,
										o : /[\xF2-\xF6]/g,
										u : /[\xF9-\xFC]/g,
										c : /\xE7/g,
										n : /\xF1/g
									};
									// substitiu os acentos
									for ( var letra in mapaAcentosHex ) {
										var expressaoRegular = mapaAcentosHex[letra];
										string = string.replace( expressaoRegular, letra );
									}
									// remove tudo que não for letra, número ou unicode
									string = string.replace(/[^a-zA-Z 0-9]+/g, "");
									// substitui os espaços
									while(string.indexOf(" ") != -1) {
										string = string.replace(" ", "-");
									}

									document.getElementById("input_gb_url").value = string.toLowerCase();
								}
								</script>
					            <div class='mdl-textfield mdl-js-textfield mdl-textfield--floating-label'>
									<input class='mdl-textfield__input' type='text' name='nm_gb_title' id='input_gb_title' onkeyup="removerAcentos(this.value, '-')"/>
									<label class='mdl-textfield__label' for='input_gb_title'>Título</label>
								</div>
					            <div class='mdl-textfield mdl-js-textfield mdl-textfield--floating-label'>
									<input class='mdl-textfield__input' type='text' name='nm_gb_url' id='input_gb_url' value=" "/>
									<label class='mdl-textfield__label' for='input_gb_url'>URL</label>
								</div>
					            <div class='mdl-textfield mdl-js-textfield mdl-textfield--floating-label'>
									<input class='mdl-textfield__input' type='text' name='nm_gb_descricao' id='input_gb_descricao'/>
									<label class='mdl-textfield__label' for='input_gb_descricao'>Descrição</label>
								</div>
					            <div class='mdl-textfield mdl-js-textfield mdl-textfield--floating-label' title='Exemplo: img/posts/como-fazer-um-up-de-gol-avancado-capa.jpg'>
									<input class='mdl-textfield__input' type='text' name='nm_gb_capa' id='input_gb_capa'/>
									<label class='mdl-textfield__label' for='input_gb_capa'>Capa</label>
								</div>
								<select class='mdl-button mdl-button--primary' name='nm_gb_catg' style='width: 300px;'>
									<option value=''>Selecione uma categoria</option>
									<?php
										include 'includes/conn.php';
										$select_categorias = "SELECT * FROM db_posts_categorias";
										$result_categorias = $conn->query($select_categorias);
										if ($result_categorias->num_rows > 0) {
											while ($linha_categorias = $result_categorias->fetch_assoc()) {
												echo "<option value='".$linha_categorias['categoria_nome']."'>".$linha_categorias['categoria_nome']."</option>";
											}
										}
									?>
					            </select>
					            <div class='mdl-textfield mdl-js-textfield mdl-textfield--floating-label'>
									<input class='mdl-textfield__input' type='text' name='nm_gb_tags' id='input_gb_tags'/>
									<label class='mdl-textfield__label' for='input_gb_tags'>Etiquetas dos Wireds usados</label>
								</div>
					            <div class='mdl-textfield mdl-js-textfield mdl-textfield--floating-label'>
									<input class='mdl-textfield__input' type='datetime-local' name='nm_gb_date' id='input_gb_date'/>
									<label class='mdl-textfield__label' for='input_gb_tags'>Data para postar</label>
								</div>
					            <div class='mdl-textfield mdl-js-textfield mdl-textfield--floating-label'>
									<input class='mdl-textfield__input' type='text' name='nm_gb_embed' id='input_gb_embed'/>
									<label class='mdl-textfield__label' for='input_gb_embed'>Código do vídeo principal</label>
								</div>
					            <textarea name='nm_gb_body' id="editor1" rows="10" cols="80"></textarea>
					            <script src='ckeditor/ckeditor.js'></script>
					            <script src='ckfinder/ckfinder.js'></script>
								<script>
									CKFinder.setupCKEditor();
									CKEDITOR.replace( 'nm_gb_body', {
										filebrowserBrowseUrl: '/ckfinder/ckfinder.html',
										filebrowserUploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
									} );
								</script>
					            <br>
								<button class='mdl-button mdl-button--raised mdl-js-button mdl-button--primary mdl-js-ripple-effect'>Enviar</button>
							</form>
						</div>
					<?php
						endif;
						if (isset($_GET['new_tutor']) AND !(isset($_SESSION['permissao_2']) OR isset($_SESSION['permissao_7']))) {
							echo "<script>history.go(-1)</script>";
						}
					?>
				</article>
				<div class='floating_botton'>
					<?php
						if (isset($cc)):
					?>
					<label for="<?php echo $cc ?>" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--accent mdl-color-text--white">Comentar</label>
					<?php
						endif;
						if (isset($_SESSION['permissao_7']) AND !isset($_GET['new_tutor'])):
					?>
					<a href="?new_tutor" id="go-floating-cell-add-tutor" style="overflow:visible" class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--accent mdl-color-text--white'>Adicionar tutorial</a>
					<?php
						endif;
					?>
				</div>
				<?php
					if (!isset($_GET['url']) AND !isset($_GET['catg']) AND !isset($_GET['new_tutor'])) {
						$select_pgs = "SELECT post_id FROM db_posts WHERE post_data_postado <= '{$data_atual}'";
						$result_pgs = $conn->query($select_pgs);
						$num_pgs = ceil($result_pgs->num_rows / 12);
						if ($num_pgs > 1) {
							echo "<div class='buttons_pgs'>";
							if (isset($_GET['pg'])){
								if ($_GET['pg'] != 1) {
									$pg_back = $_GET['pg'] - 1;
									echo "<a href='?'><button class='mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--colored'><i class='material-icons'>arrow_back</i></button></a><a href='?pg=".$pg_back."'><button class='mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--colored'><i class='material-icons'>chevron_left</i></button></a>";
								}
							}
							$pg = 1;
							while ($pg <= $num_pgs) {
								echo "<a href='?pg=".$pg."'><button class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect ";
								if (isset($_GET['pg'])) {
									if ($pg == $_GET['pg']) {
										echo "mdl-button--accent";
									}
								} if (!isset($_GET['pg']) AND $pg == 1) {
									echo "mdl-button--accent";
								} else {
									echo " mdl-button--colored";
								}
								echo "''>".$pg."</button></a>";
								$pg++;
							}
							if (isset($_GET['pg'])){
								if ($_GET['pg'] != $num_pgs) {
									$pg_next = $_GET['pg'] + 1;
									echo "<a href='?pg=".$pg_next."'><button class='mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--colored'><i class='material-icons'>chevron_right</i></button></a><a href='?pg=".$num_pgs."'><button class='mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--colored'><i class='material-icons'>arrow_forward</i></button></a>";
								}
							} if (!isset($_GET['pg'])) {
								echo "<a href='?pg=2'><button class='mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--colored'><i class='material-icons'>chevron_right</i></button></a><a href='?pg=".$num_pgs."'><button class='mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--colored'><i class='material-icons'>arrow_forward</i></button></a>";
							}
							echo "</div>";
						}
					}

					$conn->close();
				?>
			</main>
		<?php include "includes/footer.php" ?>
	</body>
</html>