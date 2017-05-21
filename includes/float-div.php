<?php

	echo "<link rel='stylesheet' href='css/style.painel.css' media='all'>"; 
	
	if((isset($_SESSION['unchecked_nick']) or isset($_SESSION['unchecked_email'])) and $_SERVER ['REQUEST_URI'] != "/academia-wired/painel/"){
		echo "<script>decisao = confirm('Sua conta está BLOQUEADA por falta de verificar o email e/ou o personagem do Habbo. Acesse o Painel de Controle para mais informações! Confirme essa mensagem para ser redirecionado para lá ou cancele caso queira sair desse usuário.');
				if (decisao){
					location.href='http://localhost/academia-wired/painel/';
				}else{
					location.href='painel/sair.php?backto=http://localhost/academia-wired/painel/';
				}</script>";
	}

?>
<?php if(isset($_SESSION['logado']) == true): ?>

<div class="float-div logado">
	<span style="background: url('https://www.habbo.com.br/habbo-imaging/avatarimage?user=<?php echo $_SESSION['nick_logado']; ?>&action=sit&direction=2&head_direction=2&img_format=png&gesture=sml&size=s') -5px -10px no-repeat;">
    </span>
    <i class="fa fa-user fa-lg"></i>
    <a href="painel" title="Painel de Controle"><i class="fa fa-sliders fa-lg"></i></a>
    <a href="includes/painel/sair.php?backto=<?php echo "http://".$_SERVER['SERVER_NAME'].$_SERVER ['REQUEST_URI']; ?>" title="Sair da conta"><i class="fa fa-sign-out fa-lg"></i></a>
</div>

<?php else: ?>

<div class="float-div deslogado">
    <a href="painel?backto=<?php echo "http://".$_SERVER['SERVER_NAME'].$_SERVER ['REQUEST_URI']; ?>" title="Não se preocupe, após o processo você será direcionado de volta para essa página"><i class="fa fa-sign-in fa-lg">Fazer login / Cadastrar-se</i></a>
</div>

<?php endif ?>