<?php
	echo "<script src='//cdn.ckeditor.com/4.5.3/full/ckeditor.js'></script>
	<div class='conteudo mdl-shadow--2dp' style='overflow: auto'><h1>Gerenciador de postagens</h1>
		<form method='post' action='forms/gerencia.blog.post.php'>
			<fieldset>
				<legend>Formulário para criar/editar/excluir postagens do blog</legend>
				<div class='mdl-textfield mdl-js-textfield mdl-textfield--floating-label'>
					<input class='mdl-textfield__input' type='number' name='nm_gb_id' id='input_gb_id' min='1'/>
					<label class='mdl-textfield__label' for='input_gb_id'>ID</label>
				</div>
	            <div class='mdl-textfield mdl-js-textfield mdl-textfield--floating-label'>
					<input class='mdl-textfield__input' type='text' name='nm_gb_title' id='input_gb_title'/>
					<label class='mdl-textfield__label' for='input_gb_title'>Título</label>
				</div>
	            <div class='mdl-textfield mdl-js-textfield mdl-textfield--floating-label'>
					<input class='mdl-textfield__input' type='text' name='nm_gb_url' id='input_gb_url'/>
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
					<option value=''>Selecione uma categoria</option>";

					include 'includes/conn.php';
					$select_categorias = "SELECT * FROM db_posts_categorias";
					$result_categorias = $conn->query($select_categorias);
					if ($result_categorias->num_rows > 0) {
						while ($linha_categorias = $result_categorias->fetch_assoc()) {
							echo "<option value='".$linha_categorias['categoria_nome']."'>".$linha_categorias['categoria_nome']."</option>";
						}
					}
	            echo "</select>
	            <div class='mdl-textfield mdl-js-textfield mdl-textfield--floating-label'>
					<input class='mdl-textfield__input' type='text' name='nm_gb_tags' id='input_gb_tags'/>
					<label class='mdl-textfield__label' for='input_gb_tags'>Etiquetas</label>
				</div>
	            <div class='mdl-textfield mdl-js-textfield mdl-textfield--floating-label'>
					<input class='mdl-textfield__input' type='date' name='nm_gb_date' id='input_gb_date'/>
					<label class='mdl-textfield__label' for='input_gb_tags'>Data para postar</label>
				</div>
	            <div class='mdl-textfield mdl-js-textfield mdl-textfield--floating-label'>
					<input class='mdl-textfield__input' type='text' name='nm_gb_embed' id='input_gb_embed'/>
					<label class='mdl-textfield__label' for='input_gb_embed'>Código do vídeo</label>
				</div>
	            <textarea name='nm_gb_body'></textarea>
				<script>
					CKEDITOR.replace( 'nm_gb_body' );
				</script>
	            <br>
				<button class='mdl-button mdl-button--raised mdl-js-button mdl-button--primary mdl-js-ripple-effect'>Enviar</button>
			</fieldset>
		</form></div>";


		echo "<div class='tabela-dados'>
			<table  class='mdl-data-table mdl-js-data-table mdl-shadow--3dp'>
				<thead>
                   	<tr>
	        	       	<th>*id</th>
						<th class='mdl-data-table__cell--non-numeric'>*title</th>
						<th class='mdl-data-table__cell--non-numeric'>*url</th>
						<th class='mdl-data-table__cell--non-numeric'>*descricao</th>
						<th class='mdl-data-table__cell--non-numeric'>*user_post</th>
						<th class='mdl-data-table__cell--non-numeric'>*user_edit</th>
						<th class='mdl-data-table__cell--non-numeric'>*capa</th>
	                    <th class='mdl-data-table__cell--non-numeric'>*embed</th>
	                    <th class='mdl-data-table__cell--non-numeric'>*body</th>
	                    <th class='mdl-data-table__cell--non-numeric'>*categoria</th>
	                    <th class='mdl-data-table__cell--non-numeric'>*tags</th>
	                    <th>*data_postado</th>
	                    <th>*data_editado</th>
					</tr>
				</thead>";

									
		$selecao = "SELECT * FROM db_posts ORDER BY post_data_postado DESC";
		$result = $conn->query($selecao);

		if ($result->num_rows > 0) {
		    while($linha = $result->fetch_assoc()) {
				echo "<tr><td>".$linha['post_id']."</td>";
				echo "<td class='mdl-data-table__cell--non-numeric'>".$linha['post_title']."</td>";
				echo "<td class='mdl-data-table__cell--non-numeric'>".$linha['post_url']."</td>";
				echo "<td class='mdl-data-table__cell--non-numeric'>".$linha['post_descricao']."</td>";
				echo "<td class='mdl-data-table__cell--non-numeric'>".$linha['post_user_post']."</td>";
				echo "<td class='mdl-data-table__cell--non-numeric'>".$linha['post_user_edit']."</td>";
				echo "<td class='mdl-data-table__cell--non-numeric'>".$linha['post_capa']."</td>";
				echo "<td class='mdl-data-table__cell--non-numeric'>".$linha['post_embed']."</td>";
				echo "<td class='mdl-data-table__cell--non-numeric'><pre style='margin: 3px 0;'><code>".str_replace(">", "&gt;", str_replace("<", "&lt;", $linha['post_body']))."</code></pre></td>";
				echo "<td class='mdl-data-table__cell--non-numeric'>".$linha['post_categoria']."</td>";
				echo "<td class='mdl-data-table__cell--non-numeric'>";
				$selecao_tags = "SELECT * FROM db_posts_tags WHERE post_tag_id = '{$linha['post_id']}'";
				$result_tags = $conn->query($selecao_tags);
				$i = 0;
				while($linha_tags = $result_tags->fetch_assoc()){
					if($i != 0){echo ", ";}
					echo $linha_tags['post_tag_name'];
					$i++;										
				}
				echo "</td>";
				echo "<td>".date('d/m/Y H:i:s', strtotime($linha['post_data_postado']))."</td>";
				echo "<td>";
				if ($linha['post_data_editado'] != "0000-00-00 00:00:00") {
					echo date('d/m/Y H:i:s', strtotime($linha['post_data_editado']));
				}
				echo "</td></tr>";
			}
		}
		echo "</table>
	</div>";


	echo "<div class='conteudo mdl-shadow--2dp' style='overflow: auto'><h1>Gerenciador de categorias</h1>
		<form method='post' action='forms/gerencia.blog.post.php?catg=1'>
			<fieldset>
				<legend>Formulário para criar/editar/excluir categorias das postagens</legend>
				<div class='mdl-textfield mdl-js-textfield mdl-textfield--floating-label'>
					<input class='mdl-textfield__input' type='number' name='nm_gb_catg_id' id='input_gb_catg_id' min='1'/>
					<label class='mdl-textfield__label' for='input_gb_catg_id'>ID</label>
				</div>
	            <div class='mdl-textfield mdl-js-textfield mdl-textfield--floating-label'>
					<input class='mdl-textfield__input' type='text' name='nm_gb_catg_nome' id='input_gb_catg_nome'/>
					<label class='mdl-textfield__label' for='input_gb_catg_nome'>Nome</label>
				</div>
	            <div class='mdl-textfield mdl-js-textfield mdl-textfield--floating-label'>
					<input class='mdl-textfield__input' type='text' name='nm_gb_catg_ico' id='input_gb_catg_ico'/>
					<label class='mdl-textfield__label' for='input_gb_catg_ico'>Nome do ícone (MDL)</label>
				</div>
	            <br>
				<button class='mdl-button mdl-button--raised mdl-js-button mdl-button--primary mdl-js-ripple-effect'>Enviar</button>
			</fieldset>
		</form>
	</div>";

	echo "<div style='overflow: auto'>
		<table  class='mdl-data-table mdl-js-data-table mdl-shadow--3dp'>
			<thead>
               	<tr>
        	       	<th>*id</th>
					<th class='mdl-data-table__cell--non-numeric'>*nome</th>
					<th class='mdl-data-table__cell--non-numeric'>*ico</th>
				</tr>
			</thead>";

								
	$selecao_catg = "SELECT * FROM db_posts_categorias";
	$result_catg = $conn->query($selecao_catg);

	if ($result_catg->num_rows > 0) {
	    while($linha_catg = $result_catg->fetch_assoc()) {
			echo "<tr><td>".$linha_catg['categoria_id']."</td>";
			echo "<td class='mdl-data-table__cell--non-numeric'>".$linha_catg['categoria_nome']."</td>";
			echo "<td class='mdl-data-table__cell--non-numeric'><i class='material-icons'>".$linha_catg['categoria_ico']."</i> ".$linha_catg['categoria_ico']."</td></tr>";
		}
	}
	echo "</table>";


	echo "<div class='conteudo mdl-shadow--2dp' style='overflow: auto'>
		<h1>Fazer upload de imagens das postagens</h1>
		<form method='post' action='forms/gerencia.blog.post.php?img=1' enctype='multipart/form-data'>
			<fieldset>
				<legend>Formulário para enviar imagens das postagens ao servidor</legend>
				<div class='mdl-textfield mdl-js-textfield mdl-textfield--floating-label'>
					<input class='mdl-textfield__input' type='file' name='nm_ui_img' id='input_ui_img'/>
				</div>
				<br>
				<button class='mdl-button mdl-button--raised mdl-js-button mdl-button--primary mdl-js-ripple-effect'>Enviar</button>
			</fieldset>
		</form>
	</div>";

	echo "<div class='conteudo mdl-shadow--2dp' style='overflow: auto; width: 90%'>
		<br>
		<button onclick='document.getElementById(&#39;dir_posts&#39;).src = document.getElementById(&#39;dir_posts&#39;).src' class='mdl-button mdl-button--raised mdl-js-button mdl-button--primary mdl-js-ripple-effect'>Recarregar diretório</button>
		<br><br>
		<iframe id='dir_posts' src='forms/dir.php' style='height:500px'></iframe>
	</div>";

	$conn->close();
?>