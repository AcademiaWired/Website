<?php

include "includes/conn.php";


$verefica = "UPDATE db_next_tutors SET next_tutor_display='0' WHERE next_tutor_progresso=100 AND next_tutor_atualizado<CURRENT_DATE()-7";
$conn->query($verefica);


$lastdate = "SELECT next_tutor_atualizado FROM db_next_tutors ORDER BY next_tutor_atualizado DESC LIMIT 1";
$adate = $conn->query($lastdate);
$aadate = $adate->fetch_assoc();
/*$aaadate = explode("-", $aadate["atualizado"]);*/

$selecao = "SELECT next_tutor_title, next_tutor_sugerido, next_tutor_progresso FROM db_next_tutors WHERE next_tutor_display='1' ORDER BY next_tutor_progresso DESC";
$result = $conn->query($selecao);
//mysqli_set_charset($conn,"utf8");

if ($result->num_rows > 0) {
    // output data of each row
	echo "<ul class='nexttutors'><h6 class='atualizado'> Atualizado dia ".date('d/m/y', strtotime($aadate["next_tutor_atualizado"]))."</h6>";
	$pass = 0;
	    while($row = $result->fetch_assoc()) {
			if($row["next_tutor_progresso"]==100){
				echo "<li class='completed' title='".$row["next_tutor_sugerido"]."'>".$row["next_tutor_title"]." · <span>".$row["next_tutor_progresso"]."%</span></li>";
			}
			if($row["next_tutor_progresso"]>0 && $row["next_tutor_progresso"]<100){
				echo "<li class='action' title='".$row["next_tutor_sugerido"]."'>".$row["next_tutor_title"]." · <span>".$row["next_tutor_progresso"]."%</span></li>";
			}
			if($row["next_tutor_progresso"]==0 && $pass == 0){
				echo "<li class='more'>Não iniciados <span>(0%)</span><ul class='noaction'>";
				$pass++;
			}
			if($row["next_tutor_progresso"]==0 && $pass == 1){
				echo "<li title='".$row["next_tutor_sugerido"]."'>".$row["next_tutor_title"]."</li>";
			}
	    }
	if($pass = 1){
		echo "</ul></li>";
	}
	echo "</ul>";
} else {
    echo "Aguardando sugestões ;p";
}


$conn->close();
?>