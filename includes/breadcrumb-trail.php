<?php
	$path = $_SERVER['SCRIPT_FILENAME'];
	$path_parts = pathinfo($path);

	if ($path_parts['filename'] != "index") {
		echo "<div class='mdl-cell mdl-cell--10-col-desktop mdl-cell--10-col-tablet mdl-cell--12-col-phone mdl-shadow--2dp' style='background-color:#fff;padding: 10px;margin-top: -1px;'>";
		echo $path_parts['filename'];
		if ($path_parts['filename'] == "tutoriais") {
			echo "<span><i class='fa fa-home'></i> Página inicial</span> <i class='fa fa-angle-right'></i><span> <i class='fa fa-lightbulb-o'></i> Tutoriais</span>";
		}
		echo "</div>";
	}
?>