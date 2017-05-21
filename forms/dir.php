<?php
	$path = "../img/posts/";
	$diretorio = dir($path);

	echo "Lista de arquivos no diretório '<strong>".$path."</strong>':<br />";
	while ($arquivo = $diretorio -> read()) {
		if ($arquivo != ".." AND $arquivo != ".") {
			echo "<a href='".$path.$arquivo."'>".$arquivo."</a><br />";
		}
	}
	$diretorio -> close();