<?php session_start(); ?>
<!DOCTYPE html>
<html dir="ltr" lang="pt-BR">
	<head>
		<meta charset="utf-8">
		<title>Blog Academia Wired</title>
		<meta name="viewport" content="initial-scale = 1.0, maximum-scale = 1.0, user-scalable = no, width = device-width">
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
		
		<link rel="stylesheet" href="css/style.css" media="screen">
		<link rel="stylesheet" href="css/style.livros.abas.css">
		<link rel="stylesheet" href="css/style.responsive.css" media="all">
		<link rel="stylesheet" href="css/style.painel.css" media="all">

		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
		<link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
		
		<script src="js/jquery.js"></script>
		<script src="js/script.js"></script>
		<script src="js/script.responsive.js"></script>
		<script src="js/script.livros.abas.js"></script>
	
		
		
		<style>
			.art-content .art-postcontent-0 .layout-item-old-0 { padding-right: 10px;padding-left: 10px;}
			.ie7 .art-post .art-layout-cell {border:none !important; padding:0 !important; }
			.ie6 .art-post .art-layout-cell {border:none !important; padding:0 !important; }.art-content .art-postcontent-1 .layout-item-old-0 { padding-right: 10px;padding-left: 10px;}
			.ie7 .art-post .art-layout-cell {border:none !important; padding:0 !important; }
			.ie6 .art-post .art-layout-cell {border:none !important; padding:0 !important; }
		</style>
	</head>
	<body id="blog">
		<?php include 'includes/header.php';?>
		<?php
			include 'includes/conn.php';
			
			if(!isset($_GET['post'])){
				$data_atual = date('Y-m-d H:i', strtotime("-5 hours"));
				$selecao = "SELECT * FROM db_posts WHERE post_data_postado <= '{$data_atual}' ORDER BY post_data_postado DESC";
				$result = $conn->query($selecao);
				
				if ($result->num_rows > 0) {
					while($linha = $result->fetch_assoc()) {
						$pega_tags = "SELECT * FROM db_posts_tags WHERE post_tag_id = '{$linha['post_id']}'";
						$result_tags = $conn->query($pega_tags);
						$body = explode('<!--more-->', $linha['post_body']);
						echo "<article class='art-post art-article'><h2 class='art-postheader'><a href='http://".$_SERVER['SERVER_NAME']."/academia-wired/blog?post=".$linha['post_url']."'>".$linha['post_title']."</a></h2><div class='art-postheadericons art-metadata-icons'>Postado por <a href=''>".$linha['post_user_post']."</a> em ".date('d/m/Y', strtotime($linha['post_data_postado']))." às ".date('H:i', strtotime($linha['post_data_postado']));
						if($linha['post_user_edit'] != ""){
							echo " | Editado por <a href=''>".$linha['post_user_edit']."</a> em ".date('d/m/Y', strtotime($linha['post_data_editado']))." às ".date('H:i', strtotime($linha['post_data_editado']));
						}
						echo "</div><div class='art-postcontent art-postcontent-0 clearfix'><div class='art-content-layout'><div class='art-content-layout-row'><div class='art-layout-cell layout-item-old-0' style='width: 100%'><div class='image-caption-wrapper' style='width: 45%; float: left'><img alt='capa da postagem' style='width: 90%; ' class='art-lightbox' src='".$linha['post_capa']."'></div>".$body[1]."</div></div></div><a href='http://".$_SERVER['SERVER_NAME']."/academia-wired/blog?post=".$linha['post_url']."'>Continue lendo...</a></div><div class='art-postfootericons art-metadata-icons'><span class='art-postcategoryicon'>Categoria: ".$linha['post_categoria']."</span> | <span class='art-posttagicon'>Tags: ";
						$i = 0;
						while($linha_tag = $result_tags->fetch_assoc()){
							if($i != 0){echo ", ";}
							echo $linha_tag['post_tag_name'];
							$i++;
						}
						echo "</span> | <span class='art-postcommentsicon'><a href='#comments' title='Comments'>Nenhum comentário »</a></span></div></article>";
					}
				}
			} elseif(isset($_GET['post'])) {
				/* mostrando a postagem */
				$post = $_GET['post'];
				$selecao = "SELECT * FROM db_posts WHERE post_url = '{$post}'";
				$result = $conn->query($selecao);
				$linha = $result->fetch_assoc();
				$pega_tags = "SELECT * FROM db_posts_tags WHERE post_tag_id = '{$linha['post_id']}'";
				$result_tags = $conn->query($pega_tags);
				echo "<article class='art-post art-article'><h2 class='art-postheader'>".$linha['post_title']."</h2><div class='art-postheadericons art-metadata-icons'>Postado por <a href=''>".$linha['post_user_post']."</a> em ".date('d/m/Y', strtotime($linha['post_data_postado']))." às ".date('H:i', strtotime($linha['post_data_postado']));
				if($linha['post_user_edit'] != ""){
					echo " | Editado por <a href=''>".$linha['post_user_edit']."</a> em ".date('d/m/Y', strtotime($linha['post_data_editado']))." às ".date('H:i', strtotime($linha['post_data_editado']));
				}
				echo "</div><div class='art-postcontent art-postcontent-0 clearfix'><div class='art-content-layout'><div class='art-content-layout-row responsive-layout-row-1'><div class='art-layout-cell layout-item-old-0' style='width: 100%'>".$linha['post_body']."</div></div></div></div><div class='art-postfootericons art-metadata-icons'><span class='art-postcategoryicon'>Categoria: ".$linha['post_categoria']."</span> | <span class='art-posttagicon'>Tags: ";
				$i = 0;
				while($linha_tag = $result_tags->fetch_assoc()){
					if($i != 0){echo ", ";}
					echo $linha_tag['post_tag_name'];
					$i++;
				}
				echo "</span></div><div class='coments'><h3>Comentários</h3>";
				//$pega_coments = "SELECT * FROM db_coments WHERE coment_post_id = '{$linha['post_id']}' AND coment_child_of = '0' ORDER BY coment_data";
				echo "<ul clas='coment_list'><li><div class='autor_avatar'><img src='https://www.habbo.com.br/habbo-imaging/avatarimage?user=alynva&direction=2&head_direction=2&img_format=png&size=l&gesture=spk'></div><div class='corpo_coment'><h5>alynva em 12/07/15 às 16:20</h5><div class='coment'>Um comentário qualquer</div></div><ul class='children'><li><div class='autor_avatar'><img src='https://www.habbo.com.br/habbo-imaging/avatarimage?user=alynva&direction=2&head_direction=2&img_format=png&size=l&gesture=spk'></div><div class='corpo_coment'><h5>alynva em 12/07/15 às 16:20</h5><div class='coment'>Um comentário qualquer</div></div></li></ul></li></ul>";
				
				echo "<div class='new_coment'><form><h3>Escreva um comentário:</h3>";
				if(!Isset($_SESSION['logado'])){echo "<span class='no_log'>Você precisa fazer login para comentar</span>";}
				echo "<textarea placeholder='Comentário'";
				if(!Isset($_SESSION['logado'])){echo "disabled";}
				echo "></textarea><div><input type='submit'";
				if(!Isset($_SESSION['logado'])){echo "disabled";}
				echo "></div></form></div></div>";
				
				echo "</article>";
			}
			$conn->close();
		?>
		<?php include 'includes/footer.php';?>
	</body>
</html>