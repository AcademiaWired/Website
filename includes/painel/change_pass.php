<div id="change_pass" class="all">
	<h4>Mudar senha</h4>
    <form method="post" action="change_pass.php">
    	<label for="id_current_email_change_pass"><span><i class="fa fa-envelope"></i></span></label><input type="email" id="id_current_email_change_pass" name="nm_current_email_change_pass" placeholder="Email atual" required><br>
	    <label for="id_current_pass_change_pass"><span><i class="fa fa-key"></i></span></label><input type="password" id="id_current_pass_change_pass" name="nm_current_pass_change_pass" placeholder="Senha atual" required><br>
    	<label for="id_new_pass_change_pass"><span><i class="fa fa-key"></i></span></label><input type="password" id="id_new_pass_change_pass" name="nm_new_pass_change_pass" placeholder="Nova senha" required><br>
	    <label for="id_new_pass_again_change_pass"><span><i class="fa fa-key"></i></span></label><input type="password" id="id_new_pass_again_change_pass" name="nm_new_pass_again_change_pass" placeholder="Repita a nova senha" required><br>
        captcha aqui
        <input type="submit" value="Mudar senha">
    </form>
</div>