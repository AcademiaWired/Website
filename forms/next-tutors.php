<?php 
	if(isset($_SESSION['permissao_3']) == false){
		header("location: ../academia-wired/");
	}
?>

				<style>
					div.art-postcontent {
						text-align:justify;
					}
					form#send_next_tutors {
						line-height:35px;
					}
					form#send_next_tutors input, form#send_next_tutors select, .all {
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
					form#send_next_tutors input[type="text"], form#send_next_tutors input[type="date"] {
						max-width: 200px !important;
						text-transform: none;
					}
					form#send_next_tutors input[type="number"] {
						max-width: 80px !important;
						text-transform: none;
					}
					form#send_next_tutors select {
						max-width:121px
					}
					form#send_next_tutors input[type="submit"], form#send_next_tutors div.g-recaptcha, .all {
						margin: 10px;
					}
					form#send_next_tutors input[disabled], form#send_next_tutors select[disabled], [disabled].all {
						color:rgba(153,153,153,1) !important;
						background:rgba(204,204,204,1)
					}
					form#send_next_tutors input[required] {
						border-color:rgba(136,0,0,1) !important
					}
					form#send_next_tutors input[type="number"]:valid, form#send_next_tutors input[type="text"]:valid, form#send_next_tutors input[type="date"]:valid, form#send_next_tutors select:valid {
						border-color:rgba(0,153,0,1) !important
					}
					form#send_next_tutors input[type="submit"]:hover, :enabled.all:hover {
						cursor:pointer;
						background:#1D2762;
						color: #FFF !important;
						border: 1px solid #3244AB !important;
					}
					</style>
				<h3 class="art-postheader">Modificar os próximos tutoriais</h3>
				<div class="overflow-auto">
					<form id="send_next_tutors" action="forms/next-tutors-post.php" method="post">
						<fieldset>
							<legend>Formulário</legend>
							<label for="select_tarefa">Tarefa: </label>
							<select name="nm_tarefa" id="select_tarefa" onChange="change_type()">
								<optgroup label="Tarefa a ser executada">
									<option value="add" selected>Adicionar</option>
									<option value="exc">Excluir</option>
									<option value="mod">Modificar</option>
								</optgroup>
							</select>
							<br>
							<label for="input_id">Id: </label>
							<input name="nm_id" id="input_id" type="number" disabled>
							<br>
							<label for="input_title">Título: </label>
							<input name="nm_title" id="input_title" type="text" required>
							<br>
							<label for="input_sugerido">Sugerido por: </label>
							<input name="nm_sugerido" id="input_sugerido" type="text" required>
							<br>
							<label for="input_progresso">Progresso: </label>
							<input name="nm_progresso" id="input_progresso" type="number" min="0" max="100" required>
							<br>
							<label for="input_atualizado">Data: </label>
							<input name="nm_atualizado" id="input_atualizado" type="date" value="<?php echo date('Y-m-d'); ?>" required>
							<br>
							<label for="select_display">Visibilidade: </label>
							<select name="nm_display" id="select_display">
								<optgroup label="Vísivel ou não?">
									<option value="1" selected>Visível</option>
									<option value="0">Não visível</option>
								</optgroup>
							</select>
							<div class="g-recaptcha" data-sitekey="6LcEfAkTAAAAAObHLBrn5wTK2xI1BhhW8vC-nAEO"></div>
							<input type="submit" value="Enviar">
						</fieldset>
					</form>
				</div>
				<script>
					function change_type() {
						var type = document.getElementById('select_tarefa').value;
						if (type == "add"){
							document.getElementById('input_id').disabled = true;
							document.getElementById('input_id').required = false;
							document.getElementById('input_title').required = true;
							document.getElementById('input_title').disabled = false;
							document.getElementById('input_sugerido').required = true;
							document.getElementById('input_sugerido').disabled = false;
							document.getElementById('input_progresso').required = true;
							document.getElementById('input_progresso').disabled = false;
							document.getElementById('input_atualizado').required = true;
							document.getElementById('input_atualizado').disabled = false;
							document.getElementById('select_display').disabled = false;
						}
						if (type == "exc"){
							document.getElementById('input_id').required = true;
							document.getElementById('input_id').disabled = false;
							document.getElementById('input_title').disabled = true;
							document.getElementById('input_title').required = false;
							document.getElementById('input_sugerido').disabled = true;
							document.getElementById('input_sugerido').required = false;
							document.getElementById('input_progresso').disabled = true;
							document.getElementById('input_progresso').required = false;
							document.getElementById('input_atualizado').disabled = true;
							document.getElementById('input_atualizado').required = false;
							document.getElementById('select_display').disabled = true;
						}
						if (type == "mod"){
							document.getElementById('input_id').required = true;
							document.getElementById('input_id').disabled = false;
							document.getElementById('input_title').disabled = false;
							document.getElementById('input_title').required = false;
							document.getElementById('input_sugerido').disabled = false;
							document.getElementById('input_sugerido').required = false;
							document.getElementById('input_progresso').disabled = false;
							document.getElementById('input_progresso').required = false;
							document.getElementById('input_atualizado').required = true;
							document.getElementById('input_atualizado').disabled = false;
							document.getElementById('select_display').disabled = false;
						}
					}
				</script>
				<br>
				<div class="overflow-auto" style="text-align: center;">
					<input class="all" type="button" id="input_onlyvisible-0" value="Mostrar todos os registros" onclick="window.location='painel?change=next_tutors'" style="display:inline-table" disabled>
					<input class="all" type="button" id="input_onlyvisible-1" value="Mostrar apenas os registros visíveis" onclick="window.location='painel?change=next_tutors&onlyvisible=visiveis'" style="display:inline-table">
					<input class="all" type="button" id="input_onlyvisible-2" value="Mostrar apenas os registros NÃO visíveis" onclick="window.location='painel?change=next_tutors&onlyvisible=invisiveis'" style="display:inline-table">
				</div>
				<br>
				<div class="overflow-auto">
					<table style="width:100%">
						<tr>
							<th>*id</th>
							<th>*title</th>
							<th>*sugerido</th>
							<th>*progresso</th>
							<th>*atualizado</th>
							<th>*display</th>
						</tr>
						<?php
							include "includes/conn.php";
							
							$selecao = "SELECT * FROM db_next_tutors";
							if (isset($_GET['onlyvisible'])){
								if ($_GET['onlyvisible'] == "visiveis"){
									$selecao = "SELECT * FROM db_next_tutors WHERE next_tutor_display='1'";
									echo "<script>document.getElementById('input_onlyvisible-0').disabled = false; document.getElementById('input_onlyvisible-1').disabled = true; document.getElementById('input_onlyvisible-2').disabled = false;</script>";
								}
								if ($_GET['onlyvisible'] == "invisiveis"){
									$selecao = "SELECT * FROM db_next_tutors WHERE next_tutor_display='0'";
									echo "<script>document.getElementById('input_onlyvisible-0').disabled = false; document.getElementById('input_onlyvisible-1').disabled = false; document.getElementById('input_onlyvisible-2').disabled = true;</script>";
								}
							}
							$result = $conn->query($selecao);
							
							if ($result->num_rows > 0) {
								while($linha = $result->fetch_assoc()) {
									echo "<tr><td>".$linha['next_tutor_id']."</td>";
									echo "<td>".$linha['next_tutor_title']."</td>";
									echo "<td>".$linha['next_tutor_sugerido']."</td>";
									echo "<td>".$linha['next_tutor_progresso']."</td>";
									echo "<td>".date('d/m/Y H:i:s', strtotime($linha['next_tutor_atualizado']))."</td>";
									echo "<td>".$linha['next_tutor_display']."</td></tr>";
								}
							}
							$conn->close();
						?>
					</table>
				</div>
				<ul>
					display:
					<li>0 = não visível</li>
					<li>1 = visível</li>
					"*": "next_tutor_"
				</ul>