<?php session_start(); ?>
<!DOCTYPE html>
<html dir="ltr" lang="pt-BR">
	<head>
		<meta charset="utf-8">
	    <title>Página inicial</title>
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
	    <meta name="viewport" content="initial-scale = 1.0, maximum-scale = 1.0, user-scalable = no, width = device-width">

	    <link rel="stylesheet" href="css/style.css" media="screen">
	    <link rel="stylesheet" href="css/style.livros.abas.css">
	    <link rel="stylesheet" href="css/style.responsive.css" media="all">
	    <link rel="stylesheet" href="css/style.painel.css" media="all">
        
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<!--<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	    <link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>-->

	    <script src="js/jquery.js"></script>
	    <script src="js/script.js"></script>
	    <script src="js/script.livros.abas.js"></script>
	    <script src="js/script.responsive.js"></script>

		<style>
			.art-content .art-postcontent-0 .layout-item-0 { padding-right: 10px;padding-left: 10px;  }
			.ie7 .art-post .art-layout-cell {border:none !important; padding:0 !important; }
			.ie6 .art-post .art-layout-cell {border:none !important; padding:0 !important; }
		</style>
	</head>
	<body id="pagina-inicial">
		<?php include 'includes/header.php';?>
		<article class='art-post art-article'>
			<h2 class="art-postheader">Página inicial</h2>
			<div class="art-postcontent art-postcontent-0 clearfix">
            	<div class="art-content-layout">
					<div class="art-content-layout-row">
						<div class="art-layout-cell layout-item-0" style="width: 100%" >
							<div class="image-caption-wrapper" style="width: 55%; float: left">
								<img alt="an image" style="width: 100%; max-width:360px; " class="art-lightbox" src="images/wireds_and_me.gif">
							</div>
							<p>Enter Páge content here...</p>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam pharetra, tellus sit amet congue vulputate, nisi erat iaculis nibh, vitae feugiat sapien ante eget mauris.&nbsp;Aenean sollicitudin imperdiet arcu, vitae dignissim est posuere id.</p>
							<span><a href="#">Read more</a><a href="ajuda/" target="_blank">Socorro</a></span>
						</div>
					</div>
				</div>
				<div class="art-content-layout">
					<div class="art-content-layout-row">
						<div class="art-layout-cell layout-item-0" style="width: 50%" >
							<ul>
								<li>Suspendisse pharetra auctor pharetra. Nunc a sollicitudin est.</li>
								<li>Donec vel neque in neque porta venenatis sed sit amet lectus.</li>
								<li>Curabitur ullamcorper gravida felis, sit amet scelerisque lorem iaculis sed.</li>
							</ul>
						</div>
		                <div class="art-layout-cell layout-item-0" style="width: 50%" >
							<blockquote style="margin: 10px 0">Nunc a sollicitudin est. Curabitur ullamcorper gravida felis, sit amet scelerisque lorem iaculis sed. Donec vel neque in neque porta venenatis sed sit amet lectus.</blockquote>
                        </div>
					</div>
				</div>
			</div>
		</article>
		<?php include 'includes/footer.php'; ?>
	</body>
</html>