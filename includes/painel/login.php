<?php


	include "../conn.php";
	
	$user = $_POST['nm_login_user'];
	$senha = htmlspecialchars(strip_tags($_POST['nm_login_pass']));
	
	$selecao = "SELECT * FROM db_users WHERE user_nick = '{$user}' OR user_email = '{$user}'";
	$result = $conn->query($selecao);
	$coluna = $result->fetch_assoc();
	
	
	
	if ($result->num_rows > 0){
		if(crypt($senha,$coluna['user_pass']) == $coluna['user_pass']){
			session_start();
			$_SESSION['logado'] = true;
			$_SESSION['nick_logado'] = $coluna['user_nick'];
			
			
			$num = $coluna['user_permissao'];
			function fatorarando($numero) {  
				// $numero > 2
			    $x=2 ;
			    while($numero != 1) {
			        if($numero % $x == 0) {
						// Vetor recebendo a variavel $x
						$vet[] = $x;
						$numero = $numero/$x;
					} else {
						$x++;
					}
				}
				return $vet;
			}
			$resposta = fatorarando($num);
			for($i = 0; $i < count($resposta); $i++){
				$_SESSION['permissao_'.$resposta[$i]] = true;
			}
			/*echo "Seus fatores: ";
			foreach($resposta as $aux) echo "$aux ";*/
			
						
			if(date('Y-m-d', strtotime($coluna['user_data']. ' + 7 days')) <= date('Y-m-d')){
				$_SESSION['unchecked_nick'] = true;
			}
			if(date('Y-m-d', strtotime($coluna['user_data']. ' + 30 days')) <= date('Y-m-d')){
				$_SESSION['unchecked_email'] = true;
			}
			if(isset($_GET['backto'])){
			    header("location:../../painel?backto=".$_GET['backto']);
			} else {
				header("location:../../painel");
			}
		}else{
			header("location:../../painel?erro=login");
		}
	}else{
		header("location:../../painel?erro=login");
	}
	
	unset($user);
	unset($senha);
	unset($selecao);
	unset($result);
	unset($coluna);
	$conn->close();
?>