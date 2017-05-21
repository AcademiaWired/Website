<?php
	echo "<div class='conteudo mdl-shadow--2dp' style='overflow: auto'><h1>Gerenciador de contas</h1>";

	echo "<form action='forms/gerencia.cont.post.php' method='post'>
		<fieldset>
			<legend>Formulário para criar/editar/excluir contas</legend>
			<div class='mdl-textfield mdl-js-textfield mdl-textfield--floating-label'>
				<input class='mdl-textfield__input' type='number' name='nm_id' id='input_id' min='1'/>
				<label class='mdl-textfield__label' for='input_id'>ID</label>
			</div>
            <br>
			<div class='mdl-textfield mdl-js-textfield mdl-textfield--floating-label'>
				<input class='mdl-textfield__input' type='text' name='nm_data' id='input_date'/>
				<label class='mdl-textfield__label' for='input_date'>Data de criação</label>
				...
			</div>
			<br>
			<div class='mdl-textfield mdl-js-textfield mdl-textfield--floating-label'>
				<input class='mdl-textfield__input' type='text' name='nm_nick' id='input_nick'/>
				<label class='mdl-textfield__label' for='input_nick'>Nickname</label>
			</div>
			<br>
			<div class='mdl-textfield mdl-js-textfield mdl-textfield--floating-label'>
				<input class='mdl-textfield__input' type='number' name='nm_nick_active' id='input_nick_active'/>
				<label class='mdl-textfield__label' for='input_nick_active'>Número de ativação do nickname</label>
			</div>
			<br>
			<div class='mdl-textfield mdl-js-textfield mdl-textfield--floating-label'>
				<input class='mdl-textfield__input' type='email' name='nm_email' id='input_email'/>
				<label class='mdl-textfield__label' for='input_email'>E-mail</label>
			</div>
			<br>
			<div class='mdl-textfield mdl-js-textfield mdl-textfield--floating-label'>
				<input class='mdl-textfield__input' type='number' name='nm_email_active' id='input_email_active'/>
				<label class='mdl-textfield__label' for='input_email_active'>Número de ativação do e-mail</label>
			</div>
			<br>
			<div class='mdl-textfield mdl-js-textfield mdl-textfield--floating-label'>
				<input class='mdl-textfield__input' type='text' name='nm_pass' id='input_pass'/>
				<label class='mdl-textfield__label' for='input_pass'>Senha</label>
			</div>
			<br>
			<button class='mdl-button mdl-button--raised mdl-js-button mdl-button--primary mdl-js-ripple-effect'>Enviar</button>
		</fieldset>
	</form>";

	echo "<div style='overflow: auto'><table  class='mdl-data-table mdl-js-data-table mdl-shadow--3dp'><thead><tr><th>*id</th><th>*data</th><th class='mdl-data-table__cell--non-numeric'>*nick</th><th>*nick_active</th><th class='mdl-data-table__cell--non-numeric'>*email</th><th>*email_active</th><th>*pass</th></tr></thead><tbody>";
	include "includes/conn.php";
	$selecao_user = "SELECT * FROM db_users";
	$result_user = $conn->query($selecao_user);
	
	if ($result_user->num_rows > 0) {
		while($linha_user = $result_user->fetch_assoc()) {
			echo "<tr><td>".$linha_user['user_id']."</td>";
			echo "<td>".$linha_user['user_data']."</td>";
			echo "<td class='mdl-data-table__cell--non-numeric'>".$linha_user['user_nick']."</td>";
			echo "<td>".$linha_user['user_nick_active']."</td>";
			echo "<td class='mdl-data-table__cell--non-numeric'>".$linha_user['user_email']."</td>";
			echo "<td>".$linha_user['user_email_active']."</td>";
			echo "<td>".$linha_user['user_pass']."</td></tr>";
		}
	}
	$conn->close();
	echo "</tbody></table></div></div>";
?>