<?php
if(file_exists("../config/connect_config.php")){
include('../config/language.php');
}
if(file_exists("../config/connect_config.php")){
include('../config/connect_config.php');
}
if($mostra_votos == '1'){
$busca_votos = mysql_query("SELECT SUM(votos) AS total FROM icp_votesystem_votos") or die(mysql_error());
while($count = mysql_fetch_array($busca_votos)){
$t_voto = !empty($count["total"]) ? $count["total"] : '0';
echo "$language_61 $t_voto";
}
}
?>