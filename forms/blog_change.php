<?php 
	if(isset($_SESSION['permissao_5']) == false){
		header("location: ../academia-wired/");
	}
?>
				<h3 class="art-postheader">Modificar as postagens do Blog</h3>
            	<style>
						form#send_blog {
							line-height:35px;
						}
						form#send_blog input, form#send_blog textarea, form#send_blog select, .all {
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
                    	form#send_blog input[type="text"], form#send_blog input[type="date"] {
							max-width: 200px !important;
							text-transform: none;
						}
                    	form#send_blog input[type="number"] {
							max-width: 80px !important;
							text-transform: none;
						}
						form#send_blog select {
							max-width:121px
						}
                    	form#send_blog input[type="submit"], form#send_blog div.g-recaptcha, .all {
							margin: 10px;
						}
						form#send_blog input[disabled], form#send_blog select[disabled], form#send_blog textarea[disabled], [disabled].all {
							color:rgba(153,153,153,1) !important;
							background:rgba(204,204,204,1)
						}
						form#send_blog input[required], form#send_blog textarea[required] {
							border-color:rgba(136,0,0,1) !important
						}
						form#send_blog input[type="number"]:valid, form#send_blog input[type="text"]:valid, form#send_blog input[type="date"]:valid, form#send_blog select:valid, form#send_blog textarea:valid {
							border-color:rgba(0,153,0,1) !important
						}
						form#send_blog input[type="submit"]:hover, :enabled.all:hover {
							cursor:pointer;
							background:#1D2762;
							color: #FFF !important;
							border: 1px solid #3244AB !important;
						}
                    </style>
                <div class="overflow-auto">
                	<form id="send_blog" action="forms/blog_change_post.php" method="post">
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
                            <label for="input_id">Id: </label><input name="nm_id" id="input_id" type="number" disabled>
                            <br>
                            <label for="input_title">Título: </label><input name="nm_title" id="input_title" type="text" required>
                            <br>
                            <label for="input_url">Url personalizada: www.academiawired.com/blog/?post=</label><input name="nm_url" id="input_url" type="text" required>
                            <br>
                            <label for="input_capa">Capa da postagem: </label><input name="nm_capa" id="input_capa" type="text" required><!--<input name="nm_capa" id="input_capa" type="file" accept="image/*" required>-->
                            <br>
                            <label for="textarea_corpo">Corpo da mensagem (em HTML): </label><br><textarea name="nm_corpo" id="textarea_corpo" required></textarea>
                            <br>
                            <label for="input_categoria">Categoria: </label><input name="nm_categoria" id="input_categoria" type="text" required>
                            <br>
                            <label for="input_tags">Tags separadas por vírgulas sem espaço ao lado delas: </label><input name="nm_tags" id="input_tags" type="text" required>
							<br>
							<label for="input_data_post">Data postado: </label><input name="nm_data_post" id="input_data_post" type="date" value="<?php echo date('Y-m-d'); ?>" required>
							<br>
							<label for="input_data_edit">Data editada: </label><input name="nm_data_edit" id="input_data_edit" type="date" value="<?php echo date('Y-m-d'); ?>" disabled>
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
							document.getElementById('input_url').required = true;
							document.getElementById('input_url').disabled = false;
							document.getElementById('input_capa').required = true;
							document.getElementById('input_capa').disabled = false;
							document.getElementById('textarea_corpo').required = true;
							document.getElementById('textarea_corpo').disabled = false;
							document.getElementById('input_categoria').required = true;
							document.getElementById('input_categoria').disabled = false;
							document.getElementById('input_tags').required = true;
							document.getElementById('input_tags').disabled = false;
							document.getElementById('input_data_post').required = true;
							document.getElementById('input_data_post').disabled = false;
							document.getElementById('input_data_edit').required = false;
							document.getElementById('input_data_edit').disabled = true;
						}
						if (type == "exc"){
							document.getElementById('input_id').disabled = false;
							document.getElementById('input_id').required = true;
							document.getElementById('input_title').required = false;
							document.getElementById('input_title').disabled = true;
							document.getElementById('input_url').required = false;
							document.getElementById('input_url').disabled = true;
							document.getElementById('input_capa').required = false;
							document.getElementById('input_capa').disabled = true;
							document.getElementById('textarea_corpo').required = false;
							document.getElementById('textarea_corpo').disabled = true;
							document.getElementById('input_categoria').required = false;
							document.getElementById('input_categoria').disabled = true;
							document.getElementById('input_tags').required = false;
							document.getElementById('input_tags').disabled = true;
							document.getElementById('input_data_post').required = false;
							document.getElementById('input_data_post').disabled = true;
							document.getElementById('input_data_edit').required = false;
							document.getElementById('input_data_edit').disabled = true;
						}
						if (type == "mod"){
							document.getElementById('input_id').disabled = false;
							document.getElementById('input_id').required = true;
							document.getElementById('input_title').required = false;
							document.getElementById('input_title').disabled = false;
							document.getElementById('input_url').required = false;
							document.getElementById('input_url').disabled = false;
							document.getElementById('input_capa').required = false;
							document.getElementById('input_capa').disabled = false;
							document.getElementById('textarea_corpo').required = false;
							document.getElementById('textarea_corpo').disabled = false;
							document.getElementById('input_categoria').required = false;
							document.getElementById('input_categoria').disabled = false;
							document.getElementById('input_tags').required = false;
							document.getElementById('input_tags').disabled = false;
							document.getElementById('input_data_post').required = false;
							document.getElementById('input_data_post').disabled = true;
							document.getElementById('input_data_edit').required = true;
							document.getElementById('input_data_edit').disabled = false;
						}
					}
				</script>
                
				<br>
				<div class="overflow-auto">
					<table style="width:100%" class="registros">
   	                   	<tr>
                	       	<th>*id</th>
							<th>*title</th>
							<th>*url</th>
							<th>*user_post</th>
							<th>*user_edit</th>
							<th>*capa</th>
                            <th>*body</th>
                            <th>*categoria</th>
                            <th>*tags</th>
                            <th>*data_postado</th>
                            <th>*data_editado</th>
						</tr>
						<?php
							include 'includes/conn.php';
														
							$selecao = "SELECT * FROM db_posts";
							$result = $conn->query($selecao);
	
							if ($result->num_rows > 0) {
							    while($linha = $result->fetch_assoc()) {
									echo "<tr><td>".$linha['post_id']."</td>";
									echo "<td>".$linha['post_title']."</td>";
									echo "<td>".$linha['post_url']."</td>";
									echo "<td>".$linha['post_user_post']."</td>";
									echo "<td>".$linha['post_user_edit']."</td>";
									echo "<td>".$linha['post_capa']."</td>";
									echo "<td><pre><code>".str_replace(">", "&gt;", str_replace("<", "&lt;", $linha['post_body']))."</code></pre></td>";
									echo "<td>".$linha['post_categoria']."</td>";
									echo "<td>";
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
									echo "<td>".date('d/m/Y H:i:s', strtotime($linha['post_data_editado']))."</td></tr>";
								}
							}
							$conn->close();
						?>
					</table>
				</div>
				<ul>
					"*": "post_"
				</ul>