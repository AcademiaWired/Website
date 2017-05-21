<?php
							
						include "conn.php";
						
						if(isset($_POST['g-recaptcha-response'])){
							$captcha=$_POST['g-recaptcha-response'];
						}
						if(!$captcha){
							echo "<script>alert('Por favor, confira o captcha e tente novamente.');history.go(-1)</script>";
//							echo "<h2>Por favor, confira o captcha e tente novamente: <a href='index.php'>voltar</a>.</h2>";
							exit;
						}
						$recaptcha_secret = "6LcEfAkTAAAAAAUFfTsyq4k1mvLzsCEMiX9zMyDc";
						$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$recaptcha_secret."&response=".$_POST['g-recaptcha-response']);
						$response = json_decode($response, true);
						if($response["success"] === true){
							
							$email = $_POST['nm_create_email'];
							$nick = $_POST['nm_create_nick'];
							$pass = crypt($_POST['nm_create_pass']);
							
							
							function verifica($randon_inicio, $randon_fim, $randon_type, $randon_no_type){
								$conn = new mysqli('localhost','root','','db_academia_wired');
								if ($conn->connect_error) {
								    die("Connection failed: " . $conn->connect_error);
								}
								
								$conn->query("SET NAMES 'utf8'");
								$conn->query('SET character_set_connection=utf8');
								$conn->query('SET character_set_client=utf8');
								$conn->query('SET character_set_results=utf8');
								
								$randon_number = mt_rand($randon_inicio, $randon_fim);
								$db_select = "SELECT * FROM db_users WHERE '{$randon_type}' = '{$randon_number}' OR '{$randon_no_type}' = '{$randon_number}'";
								$result = $conn->query($db_select);
								
								if ($result->num_rows > 0) {
									verifica($randon_inicio, $randon_fim, $randon_type);
								}
								return $randon_number;
							}
							
							$randon_one = verifica("100000", "499999", "user_nick_active", "user_email_active");
							$randon_two = verifica("500000", "999999", "user_email_active", "user_nick_active");
							
							$ver_nick_email = "SELECT * FROM db_users WHERE user_nick='{$nick}' OR user_email='{$email}'";
							$result_nick_email = $conn->query($ver_nick_email);
							
							if ($result_nick_email->num_rows == 0){
								$item = "INSERT INTO db_users (user_data, user_nick, user_nick_active, user_email, user_email_active, user_pass, user_permissao) VALUES (CURRENT_DATE(), '{$nick}', '{$randon_one}', '{$email}', '{$randon_two}', '{$pass}', 1)";
							
								/*
							
							
							for($randon_one = 0 AND $randon_two = 0; $randon_one == $randon_two; $randon_one = mt_rand(100000, 999999) AND $randon_two = mt_rand(100000, 999999)){
								for ($verifica_one = "SELECT user_nick_active FROM db_users WHERE user_nick_active = '{$randon_one}'"; $conn->query($verifica_one) === FALSE; $randon_one = mt_rand(100000, 999999)){}
								
								for ($verifica_two = "SELECT user_email_active FROM db_users WHERE user_email_active = '{$randon_two}'"; $conn->query($verifica_two) === FALSE; $randon_two = mt_rand(100000, 999999)){}
							};
							
							
							*/
							
														
								if ($conn->query($item) === TRUE) {
									session_start();
									$_SESSION['logado'] = true;
									$_SESSION['nick_logado'] = $nick;
									if(isset($_GET['backto'])){
									    header("location:../painel/?backto=".$_GET['backto']);
									} else {
									    header("location:../painel/");
									}
								} else {
									echo "<script>alert('Ocorreu um erro inesperado: '".$conn->error."'. Tente novamente.');history.go(-1) </script>";
								}
							} else {
								header("location:../painel/?erro=existe");
							}
									
						}
						?>