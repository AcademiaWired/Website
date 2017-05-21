<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-68984366-1', 'auto');
  ga('send', 'pageview');

</script>
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header mdl-layout--fixed-drawer">
	<header class="mdl-layout__header">
		<div class="mdl-layout__header-row">
			<span class="mdl-layout-title mdl-logo"><a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>">Academia Wired</a></span>
			<div class="mdl-layout-spacer"></div>
			<nav class="mdl-navigation header-links">
				<form action="busca.php">
				  <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
				    <div class="mdl-textfield__expandable-holder">
				      <input class="mdl-textfield__input" type="search" id="input_search_1" name="nm_search" placeholder="Pesquisar" />
				    </div>
				    <label class="mdl-button mdl-js-button mdl-button--icon" for="input_search_1">
				      <i class="material-icons">search</i>
				    </label>
				  </div>
				</form>
				<a href="#" class="mdl-navigation__link">Sobre</a>
				<a href="#" class="mdl-navigation__link">Ajuda</a>
				<a href="#" class="mdl-navigation__link">Fale conosco</a>
			</nav>
		</div>
	</header>
	<div class="mdl-layout__drawer">
		<div class="drawer-login">
			<?php if(isset($_SESSION['logado'])){echo "<a href='painel.php'>";} ?>
			<div id="avatar-circle"<?php if(isset($_SESSION['nick_logado'])){echo " style='background-image:url(&#39;http://www.habbo.com.br/habbo-imaging/avatarimage?user=".$_SESSION['nick_logado']."&gesture=sml&#39;)'";} ?>></div>
			<?php if(!isset($_SESSION['logado'])): ?>
			<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored for-login" onclick="window.location='/entrar.php'">Fazer login</button>
			<?php else: ?>
			</a>
			<div class="mdl-tooltip" for="avatar-circle">Ir para o painel</div>
			<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored left-login" onclick="window.location='/includes/sair.php'">Sair da conta</button>
			<?php endif ?>
			<?php
				if($_SERVER['REQUEST_URI'] != "/entrar.php"){
					$_SESSION['voltarpara'] = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
				}
			?>
		</div>
		<div class="drawer-menu">
				<form action="busca.php" class='busca'>
				  <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable is-focused">
				    <div class="mdl-textfield__expandable-holder">
				      <input class="mdl-textfield__input" type="search" id="input_search_2" name="nm_search" placeholder="Pesquisar" />
				    </div>
				    <label class="mdl-button mdl-js-button mdl-button--icon" for="input_search_2">
				      <i class="material-icons">search</i>
				    </label>
				  </div>
				</form>
			<span class="mdl-layout-title">Menu</span>
			<nav class="mdl-navigation">
				<a href="/" class="mdl-navigation__link pg_pg-in mdl-button mdl-js-button mdl-js-ripple-effect">Página inicial</a>
				<a href="/tutoriais.php" class="mdl-navigation__link pg_tu mdl-button mdl-js-button mdl-js-ripple-effect">Tutoriais</a>
				<!--<a href="comunidade.php" class="mdl-navigation__link pg_co mdl-button mdl-js-button mdl-js-ripple-effect">Comunidade</a>-->
				<a href="/galeria-de-wireds.php" class="mdl-navigation__link pg_ga-de-wi mdl-button mdl-js-button mdl-js-ripple-effect">Galeria de Wireds</a>
				<?php
					echo "<a href='/meu-wired.php' class='mdl-navigation__link pg_me-wi mdl-badge mdl-button mdl-js-button mdl-js-ripple-effect'";

					$data_limite_wired = $_SESSION['view_meu_wired'];

					include "includes/conn.php";
					$sql_verifica_ultimo_wired = "SELECT meu_wired_id, meu_wired_data FROM db_meu_wired ORDER BY meu_wired_id DESC LIMIT 1";
					$result_verifica_ultimo_wired = $conn->query($sql_verifica_ultimo_wired);
					$linha_verifica_ultimo_wired = $result_verifica_ultimo_wired->fetch_assoc();
					if ($data_limite_wired < $linha_verifica_ultimo_wired['meu_wired_data']) {
						$sql_ultimos_wireds = "SELECT meu_wired_id FROM db_meu_wired WHERE meu_wired_data > '{$data_limite_wired}'";
						$resultado_ultimos_wireds = $conn->query($sql_ultimos_wireds);
						echo " data-badge='";
						if ($data_limite_wired != 0) {
							echo "+";
						}
						if ($resultado_ultimos_wireds->num_rows < 100) {
							echo $resultado_ultimos_wireds->num_rows."'";
						} elseif ($resultado_ultimos_wireds->num_rows >= 100) {
							echo "99+"."'";
						}
					}
					echo ">Meu Wired";
						//echo " ".$_SESSION['view_meu_wired'];
						//echo " ".$data_limite_wired;
						//echo " ".$linha_verifica_ultimo_wired['meu_wired_data'];
						//echo " ".$sql_ultimos_wireds;
					echo "</a>";
				?>
				<a href="/combinar-wireds.php" class="mdl-navigation__link pg_co-wi mdl-button mdl-js-button mdl-js-ripple-effect">Combinar Wireds<sup style='color:red'>BETA</sup></a>
				<!--<a href="#" class="mdl-navigation__link pg_id mdl-button mdl-js-button mdl-js-ripple-effect">Ideias</a>-->
			</nav>
			<!--<?php include $_SERVER['DOCUMENT_ROOT']."/includes/next-tutors-widget.php"; ?>-->
			<nav class="mdl-navigation drawer-links mdl-card--border">
				<a href="#" class="drawer-links-a mdl-navigation__link">Sobre</a>
				<a href="#" class="drawer-links-a mdl-navigation__link">Ajuda</a>
				<a href="#" class="drawer-links-a mdl-navigation__link">Fale conosco</a>
				<a href="#" class="mdl-navigation__link" id="go-floating-cell-feedback" onclick="floatingCard('s', 'cell_feedback','go-floating-cell-feedback')">Feedback</a>

				<div class='floating_cell cell_feedback mdl-cell mdl-cell--10-col' style='display:none;'>
					<button class="mdl-button mdl-js-button mdl-button--icon" style="float: right;">
					  <i class="material-icons">close</i>
					</button>
					<h4>Enviar meu feedback</h4>
					<form class='form_display' style='text-align:center' method='post' action='forms/novo.feedback.post.php'>
						<div class='mdl-textfield mdl-js-textfield mdl-textfield--floating-label'>
							<textarea class='mdl-textfield__input' type='text' rows= '5' id='feedback-0' name='nm_feedback-0' required ></textarea>
							<label class='mdl-textfield__label' for='feedback-0'>Descreva seu problema ou sua opnião</label>
						</div>
						<br>
						<br>
						<button class='mdl-button mdl-js-button mdl-button--raised mdl-button--colored'>
							Enviar
						</button>
					</form>
				</div>
			</nav>
		</div>
	</div>
	<div class="mdl-layout__content">

		<!--<?php //include "includes/breadcrumb-trail.php" ?>-->
