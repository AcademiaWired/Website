		<footer class="mdl-mega-footer">
			<div class="mdl-mega-footer--top-section">
				<a class="a-title" href="galeria-de-wireds.php">Galeria de Wireds</a>
			</div>
			<div class="mdl-mega-footer--middle-section">
				<?php
					include "includes/conn.php";

					$select_group = "SELECT * FROM db_wireds_group";
					$result_group = $conn->query($select_group);
					if($result_group->num_rows > 0){
					while ($linha_group = $result_group->fetch_assoc()) {
						echo "<div class='mdl-mega-footer--drop-down-section'>
							<input type='checkbox' class='mdl-mega-footer--heading-checkbox' checked>
							<h1 class='mdl-mega-footer--heading'>".$linha_group['wired_group_name']."</h1>
							<ul class='mdl-mega-footer--link-list'>";
							$group = $linha_group['wired_group_id'];
							//$select_wireds = "SELECT *, rand() FROM db_wireds WHERE wired_group_id = '{$group}' ORDER BY rand() LIMIT 5";
							$select_wireds = "SELECT wired_name FROM (SELECT *, rand() FROM db_wireds WHERE wired_group_id = '{$group}' ORDER BY rand() LIMIT 5) AS only_five_random ORDER BY wired_name";
							$result_wireds = $conn->query($select_wireds);
							//$array_wireds = array();
							while ($linha_wireds = $result_wireds->fetch_assoc()) {
							//	array_push($array_wireds, $linha_wireds['wired_name']);
								echo "<li><a href='#'>".$linha_wireds['wired_name']."</a></li>";
							}
							//sort($array_wireds);
							//foreach ($array_wireds as $key => $value) {
							//	echo "<li><a href='#'>".$value."</a></li>";
							//}

							echo "</ul>
						</div>";
					}}
				?>
			</div>
			<div class="mdl-mega-footer--bottom-section">
				<ul class="mdl-mega-footer--link-list">
					<li><a href='https://plus.google.com/+AcademiaWiredHabbo' target='_blank'><i class='fa fa-google-plus-square fa-2x'></i> /+AcademiaWiredHabbo</a></li>
					<li><a href='https://www.facebook.com/AcademiaWired' target='_blank'><i class='fa fa-facebook-square fa-2x'></i> /AcademiaWired</a></li>
					<li><a href='https://twitter.com/AcademiaWired' target='_blank'><i class='fa fa-twitter-square fa-2x'></i> /AcademiaWired</a></li>
					<li><a href='http://www.youtube.com/AcademiaWiredHabbo' target='_blank'><i class='fa fa-youtube-square fa-2x'></i> /AcademiaWiredHabbo</a></li>
				</ul>
			</div>
		</footer>
	</div>

	<script>
		function floatingCard(sh, cell, back){

			if (sh == 's') {
				$('.floatingcard').css('visibility', 'visible').show();
				$('.background-floatingcard').css("background-color", "rgba(0,0,0,.5)").css('visibility', 'visible').attr('onclick', "floatingCard('h', '" + cell + "', '" + back +"')");
				$('.floating_cell button.mdl-button--icon').attr('onclick', "floatingCard('h', '" + cell + "', '" + back +"')")

				$('.background-floatingcard').after($('.floating_cell.' + cell).css("background-color", "rgb(255,255,255)").show());
				window.total = 0;
			} else {
				$('.floatingcard').css('visibility', 'hidden').hide();
				$('#' + back).after($('.floatingcard > .background-floatingcard ~ .floating_cell').hide());
			}
		}
	</script>
	<div class='floatingcard mdl-grid' style='display: none'>
		<div class='background-floatingcard'></div>
		<div class='mdl-spinner mdl-spinner--single-color mdl-js-spinner is-active' style='margin: auto; display:none'></div>
	</div>

</div>