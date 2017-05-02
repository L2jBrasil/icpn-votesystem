<?php
sleep(3);
if (!isset($_SESSION)){ session_start(); }
if ($_SESSION["UsuarioNivel"] != '1'){
	session_destroy();
	echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=./'>";
	exit;
}
if(file_exists("config/connect_config.php")){
include('config/connect_config.php');
}
if(file_exists("config/language.php")){
include('config/language.php');
}
if($_SESSION["UsuarioNivel"] == '1'){ ?>
<script type="text/javascript">
function user(){
$(function(){
	$.post('painel/index.php', {}, function(data){
		$('.formulario').html(data).show();
	});
	$('.loading').fadeIn('slow').delay(3000);
});
	$('.loading').ajaxStop(function(){
		$('.loading').hide();
	});
};
</script>
<div id="adm"><a href="#" onClick="javascript:user();"><?php echo"$language_33"; ?></a></div>
<?php
$pagina = @file_get_contents('http://www.icpnetworks.com.br/votesystem/update.php');
$pos = strpos($pagina, 'Version: ');
$update = $pagina[9].$pagina[10].$pagina[11];
$pos = strstr($pagina, 'http://');
$up_download = $pos;
if($version < $update){
	echo"<div id='update'><div style='padding-left:25px; height:23px; line-height:23px; color:#ff0; background-color:rgba(150,150,150,0.3); border-bottom:1px solid #999; text-shadow:1px 1px #000; font-size:12px;'>$language_42</div><div style='padding-left:3px;'>$language_43 <a href='$up_download' target='_blank'>VoteSystem ICPNetworks $update</a></div></div>";
}
}
if(isset($_POST["edit"])){
	if(strpos($_SERVER['HTTP_REFERER'],$end)) {
		$deposito = $_POST["deposito"];
		$vts = $_POST["voto"];
		$horas = !empty($_POST["horas"]) ? $_POST["horas"] : NULL;
		if($horas < '12'){ $horas = '12'; }else{ $horas = $horas; }
		
		$m1 = !empty($_POST["m1"]) ? $_POST["m1"]."," : NULL;
		$qtd1 = !empty($_POST["qtd1"]) ? $_POST["qtd1"]."," : NULL;
		$m2 = !empty($_POST["m2"]) ? $_POST["m2"]."," : NULL;
		$qtd2 = !empty($_POST["qtd2"]) ? $_POST["qtd2"]."," : NULL;
		$m3 = !empty($_POST["m3"]) ? $_POST["m3"]."," : NULL;
		$qtd3 = !empty($_POST["qtd3"]) ? $_POST["qtd3"]."," : NULL;
		$m4 = !empty($_POST["m4"]) ? $_POST["m4"]."," : NULL;
		$qtd4 = !empty($_POST["qtd4"]) ? $_POST["qtd4"]."," : NULL;
		$m5 = !empty($_POST["m5"]) ? $_POST["m5"]."," : NULL;
		$qtd5 = !empty($_POST["qtd5"]) ? $_POST["qtd5"]."," : NULL;
		$m6 = !empty($_POST["m6"]) ? $_POST["m6"]."," : NULL;
		$qtd6 = !empty($_POST["qtd6"]) ? $_POST["qtd6"]."," : NULL;
		$m7 = !empty($_POST["m7"]) ? $_POST["m7"]."," : NULL;
		$qtd7 = !empty($_POST["qtd7"]) ? $_POST["qtd7"]."," : NULL;
		$m8 = !empty($_POST["m8"]) ? $_POST["m8"]."," : NULL;
		$qtd8 = !empty($_POST["qtd8"]) ? $_POST["qtd8"]."," : NULL;
		$m9 = !empty($_POST["m9"]) ? $_POST["m9"]."," : NULL;
		$qtd9 = !empty($_POST["qtd9"]) ? $_POST["qtd9"]."," : NULL;
		$m10 = !empty($_POST["m10"]) ? $_POST["m10"]."," : NULL;
		$qtd10 = !empty($_POST["qtd10"]) ? $_POST["qtd10"]."," : NULL;
		
		mysql_query("UPDATE icp_votesystem_config SET moeda_voto = '$m1$m2$m3$m4$m5$m6$m7$m8$m9$m10$m11$m12', qtd_moeda_voto = '$qtd1$qtd2$qtd3$qtd4$qtd5$qtd6$qtd7$qtd8$qtd9$qtd10', horas_voto = '$horas', deposito = '$deposito', votos = '$vts'") or die(mysql_error());
		
		$b1a = !empty($_POST["b1"]) ? $_POST["b1"] : NULL;
		$b1b = !empty($b1a) ? '1' : '0';
		$b2a = !empty($_POST["b2"]) ? $_POST["b2"] : NULL;
		$b2b = !empty($b2a) ? '1' : '0';
		$b3a = !empty($_POST["b3"]) ? $_POST["b3"] : NULL;
		$b3b = !empty($b3a) ? '1' : '0';
		$b4a = !empty($_POST["b4"]) ? $_POST["b4"] : NULL;
		$b4b = !empty($b4a) ? '1' : '0';
		$b5a = !empty($_POST["b5"]) ? $_POST["b5"] : NULL;
		$b5b = !empty($b5a) ? '1' : '0';
		$b6a = !empty($_POST["b6"]) ? $_POST["b6"] : NULL;
		$b6b = !empty($b6a) ? '1' : '0';
		$b7a = !empty($_POST["b7"]) ? $_POST["b7"] : NULL;
		$b7b = !empty($b7a) ? '1' : '0';
		$b8a = !empty($_POST["b8"]) ? $_POST["b8"] : NULL;
		$b8b = !empty($b8a) ? '1' : '0';
		$b9a = !empty($_POST["b9"]) ? $_POST["b9"] : NULL;
		$b9b = !empty($b9a) ? '1' : '0';
		$b10a = !empty($_POST["b10"]) ? $_POST["b10"] : NULL;
		$b10b = !empty($b10a) ? '1' : '0';
		$b11a = !empty($_POST["b11"]) ? $_POST["b11"] : NULL;
		$b11b = !empty($b11a) ? '1' : '0';
		$b12a = !empty($_POST["b12"]) ? $_POST["b12"] : NULL;
		$b12b = !empty($b12a) ? '1' : '0';
		
		if($b1b == '1'){
			mysql_query("UPDATE icp_votesystem_tops SET top_id = '$b1a', disponivel = '1' WHERE id = '1'") or die(mysql_error());
		}elseif($b1b == '0'){
			mysql_query("UPDATE icp_votesystem_tops SET top_id = 'sem_id', disponivel = '0' WHERE id = '1'") or die(mysql_error());
		}
		if($b2b == '1'){
			mysql_query("UPDATE icp_votesystem_tops SET top_id = '$b2a', disponivel = '1' WHERE id = '2'") or die(mysql_error());
		}elseif($b2b == '0'){
			mysql_query("UPDATE icp_votesystem_tops SET top_id = 'sem_id', disponivel = '0' WHERE id = '2'") or die(mysql_error());
		}
		if($b3b == '1'){
			mysql_query("UPDATE icp_votesystem_tops SET top_id = '$b3a', disponivel = '1' WHERE id = '3'") or die(mysql_error());
		}elseif($b3b == '0'){
			mysql_query("UPDATE icp_votesystem_tops SET top_id = 'sem_id', disponivel = '0' WHERE id = '3'") or die(mysql_error());
		}
		if($b4b == '1'){
			mysql_query("UPDATE icp_votesystem_tops SET top_id = '$b4a', disponivel = '1' WHERE id = '4'") or die(mysql_error());
		}elseif($b4b == '0'){
			mysql_query("UPDATE icp_votesystem_tops SET top_id = 'sem_id', disponivel = '0' WHERE id = '4'") or die(mysql_error());
		}
		if($b5b == '1'){
			mysql_query("UPDATE icp_votesystem_tops SET top_id = '$b5a', disponivel = '1' WHERE id = '5'") or die(mysql_error());
		}elseif($b5b == '0'){
			mysql_query("UPDATE icp_votesystem_tops SET top_id = 'sem_id', disponivel = '0' WHERE id = '5'") or die(mysql_error());
		}
		if($b6b == '1'){
			mysql_query("UPDATE icp_votesystem_tops SET top_id = '$b6a', disponivel = '1' WHERE id = '6'") or die(mysql_error());
		}elseif($b6b == '0'){
			mysql_query("UPDATE icp_votesystem_tops SET top_id = 'sem_id', disponivel = '0' WHERE id = '6'") or die(mysql_error());
		}
		if($b7b == '1'){
			mysql_query("UPDATE icp_votesystem_tops SET top_id = '$b7a', disponivel = '1' WHERE id = '7'") or die(mysql_error());
		}elseif($b7b == '0'){
			mysql_query("UPDATE icp_votesystem_tops SET top_id = 'sem_id', disponivel = '0' WHERE id = '7'") or die(mysql_error());
		}
		if($b8b == '1'){
			mysql_query("UPDATE icp_votesystem_tops SET top_id = '$b8a', disponivel = '1' WHERE id = '8'") or die(mysql_error());
		}elseif($b8b == '0'){
			mysql_query("UPDATE icp_votesystem_tops SET top_id = 'sem_id', disponivel = '0' WHERE id = '8'") or die(mysql_error());
		}
		if($b9b == '1'){
			mysql_query("UPDATE icp_votesystem_tops SET top_id = '$b9a', disponivel = '1' WHERE id = '9'") or die(mysql_error());
		}elseif($b9b == '0'){
			mysql_query("UPDATE icp_votesystem_tops SET top_id = 'sem_id', disponivel = '0' WHERE id = '9'") or die(mysql_error());
		}
		if($b10b == '1'){
			mysql_query("UPDATE icp_votesystem_tops SET top_id = '$b10a', disponivel = '1' WHERE id = '10'") or die(mysql_error());
		}elseif($b10b == '0'){
			mysql_query("UPDATE icp_votesystem_tops SET top_id = 'sem_id', disponivel = '0' WHERE id = '10'") or die(mysql_error());
		}
		if($b11b == '1'){
			mysql_query("UPDATE icp_votesystem_tops SET top_id = '$b11a', disponivel = '1' WHERE id = '11'") or die(mysql_error());
		}elseif($b11b == '0'){
			mysql_query("UPDATE icp_votesystem_tops SET top_id = 'sem_id', disponivel = '0' WHERE id = '11'") or die(mysql_error());
		}
		if($b12b == '1'){
			mysql_query("UPDATE icp_votesystem_tops SET top_id = '$b12a', disponivel = '1' WHERE id = '12'") or die(mysql_error());
		}elseif($b12b == '0'){
			mysql_query("UPDATE icp_votesystem_tops SET top_id = 'sem_id', disponivel = '0' WHERE id = '12'") or die(mysql_error());
		}
		?>
			<script type="text/javascript">
			$(function(){
				$('.edits').fadeIn('slow').addClass('erro').html('<?php echo"$language_58"; ?>').delay(5000).fadeOut('slow');
			});
			</script>
		<?php
	}
}
$style1 = "style='width:90px;'";
$style2 = "style='width:30px;'";
$style3 = "style='width:245px;'";
$pega_config = mysql_query("SELECT * FROM icp_votesystem_config") or die(mysql_error());
$pega_tops = mysql_query("SELECT * FROM icp_votesystem_tops WHERE disponivel = '1'") or die(mysql_error());
while($crow = mysql_fetch_array($pega_config)){ $mv = explode(",", $crow["moeda_voto"]); $qv = explode(",", $crow["qtd_moeda_voto"]); $m01 = $mv[0]; $m02 = $mv[1]; $m03 = $mv[2]; $m04 = $mv[3]; $m05 = $mv[4]; $m06 = $mv[5]; $m07 = $mv[6]; $m08 = $mv[7]; $m09 = $mv[8]; $ml0 = $mv[9]; $ml1 = $mv[10]; $q01 = $qv[0]; $q02 = $qv[1]; $q03 = $qv[2]; $q04 = $qv[3]; $q05 = $qv[4]; $q06 = $qv[5]; $q07 = $qv[6]; $q08 = $qv[7]; $q09 = $qv[8]; $ql0 = $qv[9]; $ql1 = $qv[10]; $hora = $crow["horas_voto"]; $dep = $crow["deposito"]; $vd = $crow["votos"]; $m01 = !empty($m01) ? $m01 : NULL; $m02 = !empty($m02) ? $m02 : NULL; $m03 = !empty($m03) ? $m03 : NULL; $m04 = !empty($m04) ? $m04 : NULL; $m05 = !empty($m05) ? $m05 : NULL; $m06 = !empty($m06) ? $m06 : NULL; $m07 = !empty($m07) ? $m07 : NULL; $m08 = !empty($m08) ? $m08 : NULL; $m09 = !empty($m09) ? $m09 : NULL; $m10 = !empty($m10) ? $m10 : NULL; $m11 = !empty($m11) ? $m11 : NULL; $q01 = !empty($q01) ? $q01 : NULL; $q02 = !empty($q02) ? $q02 : NULL; $q03 = !empty($q03) ? $q03 : NULL; $q04 = !empty($q04) ? $q04 : NULL; $q05 = !empty($q05) ? $q05 : NULL; $q06 = !empty($q06) ? $q06 : NULL; $q07 = !empty($q07) ? $q07 : NULL; $q08 = !empty($q08) ? $q08 : NULL; $q09 = !empty($q09) ? $q09 : NULL; $q10 = !empty($q10) ? $q10 : NULL; $q11 = !empty($q11) ? $q11 : NULL; $hora = !empty($hora) ? $hora : NULL; }
while($trow = mysql_fetch_array($pega_tops)){ if($trow["id"] == '1'){ $b01 = $trow["top_id"]; } if($trow["id"] == '2'){ $b02 = $trow["top_id"]; } if($trow["id"] == '3'){ $b03 = $trow["top_id"]; } if($trow["id"] == '4'){ $b04 = $trow["top_id"]; } if($trow["id"] == '5'){ $b05 = $trow["top_id"]; } if($trow["id"] == '6'){ $b06 = $trow["top_id"]; } if($trow["id"] == '7'){ $b07 = $trow["top_id"]; } if($trow["id"] == '8'){ $b08 = $trow["top_id"]; } if($trow["id"] == '9'){ $b09 = $trow["top_id"]; } if($trow["id"] == '10'){ $b10 = $trow["top_id"]; } if($trow["id"] == '11'){ $b11 = $trow["top_id"]; } if($trow["id"] == '12'){ $b12 = $trow["top_id"]; } $b01 = !empty($b01) ? $b01 : NULL; $b02 = !empty($b02) ? $b02 : NULL; $b03 = !empty($b03) ? $b03 : NULL; $b04 = !empty($b04) ? $b04 : NULL; $b05 = !empty($b05) ? $b05 : NULL; $b06 = !empty($b06) ? $b06 : NULL; $b07 = !empty($b07) ? $b07 : NULL; $b08 = !empty($b08) ? $b08 : NULL; $b09 = !empty($b09) ? $b09 : NULL; $b10 = !empty($b10) ? $b10 : NULL; $b11 = !empty($b11) ? $b11 : NULL; $b12 = !empty($b12) ? $b12 : NULL; }
?>
<script type="text/javascript">
function edit_config(){
	$('button').click(function(){
	$('button').attr('disabled', 'disabled');
	setTimeout(function(){
		$('button').removeAttr('disabled');
	}, 4000);
	$.post('adm.php', {deposito: $('select[id=1]').val(), b1: $('input[id=7]').val(), b2: $('input[id=8]').val(), b3: $('input[id=9]').val(), b4: $('input[id=10]').val(), b5: $('input[id=11]').val(), b6: $('input[id=12]').val(), b7: $('input[id=13]').val(), b8: $('input[id=14]').val(), b9: $('input[id=15]').val(), b10: $('input[id=16]').val(), b11: $('input[id=39]').val(), b12: $('input[id=40]').val(), m1: $('input[id=17]').val(), m2: $('input[id=18]').val(), m3: $('input[id=19]').val(), m4: $('input[id=20]').val(), m5: $('input[id=21]').val(), m6: $('input[id=22]').val(), m7: $('input[id=23]').val(), m8: $('input[id=24]').val(), m9: $('input[id=25]').val(), m10: $('input[id=26]').val(), qtd1: $('input[id=27]').val(), qtd2: $('input[id=28]').val(), qtd3: $('input[id=29]').val(), qtd4: $('input[id=30]').val(), qtd5: $('input[id=31]').val(), qtd6: $('input[id=32]').val(), qtd7: $('input[id=33]').val(), qtd8: $('input[id=34]').val(), qtd9: $('input[id=35]').val(), qtd10: $('input[id=36]').val(), horas: $('input[id=37]').val(), voto: $('select[id=38]').val(), edit: 'edit'}, function(data){
		$('.formulario').html(data).show();
	});
	$('.entrega').fadeIn('slow').delay(5000);
	$('.entrega').ajaxStop(function(){
		$('.entrega').hide();
	});
	});
};
</script>
<div style="text-align:left; border-bottom:1px solid #666; padding-left:5px; float:left; margin-top:-67px; width:572px; color:#FFF; line-height:30px; background-image:url(images/bg_votesystem.gif); z-index:1;">
<?php echo"$language_57"; ?>
</div>
<div align="left" style="padding-left:25px; background-image:url(images/bg_votesystem.gif);">
<form action="javascript:edit_config();" method="post">

<div style="float:left; width:100%; height:80px; line-height:80px; text-align:center; font-weight:bold; margin-top:-35px; background-image:url(images/bg_votesystem.gif); margin-left:-25px; padding-left:25px;"><?php echo"$language_50"; ?></div>

<div style="float:left; width:130px; height:120px; text-align:center;">
<a href="http://www.topservers200.com" target="_blank" title="<?php echo"$language_37"; ?>">TopServers200<br>
<img src="images/topservers200.png" width="87" height="47" border="0"></a><br>
<input type='text' id='7' <?php echo"$style1"; echo" value='$b01'"; ?>>
</div>
<div style="float:left; width:130px; height:120px; text-align:center;">
<a href="http://top.l2jbrasil.com" target="_blank" title="<?php echo"$language_37"; ?>">L2jBrasil<br>
<img src="images/l2jbrasil.png" width="87" height="47" border="0"></a><br>
<input type='text' id='8' <?php echo"$style1"; echo" value='$b02'"; ?>>
</div>
<div style="float:left; width:130px; height:120px; text-align:center;">
<a href="http://www.gamesites200.com" target="_blank" title="<?php echo"$language_37"; ?>">GameSites200<br>
<img src="http://www.gamesites200.com/lineage2/vote.gif" width="87" height="47" border="0"></a><br>
<input type='text' id='9' <?php echo"$style1"; echo" value='$b03'"; ?>>
</div>
<div style="float:left; width:130px; height:120px; text-align:center;">
<a href="http://www.toplineage2.com" target="_blank" title="<?php echo"$language_37"; ?>">Top Lineage 2<br>
<img src="http://www.toplineage2.com/images/toplineage2_2.png" width="87" height="47" border="0"></a><br>
<input type='text' id='10' <?php echo"$style1"; echo" value='$b04'"; ?>>
</div>
<div style="float:left; width:130px; height:120px; text-align:center;">
<a href="http://www.gtop100.com" target="_blank" title="<?php echo"$language_37"; ?>">GTop100<br>
<img src="http://www.gtop100.com/images/votebutton.jpg" width="87" height="47" border="0"></a><br>
<input type='text' id='11' <?php echo"$style1"; echo" value='$b05'"; ?>>
</div>
<div style="float:left; width:130px; height:120px; text-align:center;">
<a href="http://www.lineagetop200.com" target="_blank" title="<?php echo"$language_37"; ?>">LineageTop200<br>
<img src="http://www.lineagetop200.com/vote.png" width="87" height="47" border="0"></a><br>
<input type='text' id='12' <?php echo"$style1"; echo" value='$b06'"; ?>>
</div>
<div style="float:left; width:130px; height:120px; text-align:center;">
<a href="http://www.mmorpgtoplist.com" target="_blank" title="<?php echo"$language_37"; ?>">MMORPG<br>
<img src="http://www.mmorpgtoplist.com/vote.jpg" width="87" height="47" border="0"></a><br>
<input type='text' id='13' <?php echo"$style1"; echo" value='$b07'"; ?>>
</div>
<div style="float:left; width:130px; height:120px; text-align:center;">
<a href="http://l2.hopzone.net" target="_blank" title="<?php echo"$language_37"; ?>">HopZone<br>
<img src="images/hopzone.gif" width="87" height="47" border="0"></a><br>
<input type='text' id='14' <?php echo"$style1"; echo" value='$b08'"; ?>>
</div>
<div style="float:left; width:130px; height:120px; text-align:center;">
<a href="http://www.topgs200.com" target="_blank" title="<?php echo"$language_37"; ?>">Topgs200<br>
<img src="http://www.topgs200.com/lineage2/images/botaopropaganda.png" width="87" height="47" border="0"></a><br>
<input type='text' id='15' <?php echo"$style1"; echo" value='$b09'"; ?>>
</div>
<div style="float:left; width:130px; height:120px; text-align:center;">
<a href="http://www.top100arena.com" target="_blank" title="<?php echo"$language_37"; ?>">Top100arena<br>
<img src="images/top100arena.jpg" width="87" height="47" border="0"></a><br>
<input type='text' id='16' <?php echo"$style1"; echo" value='$b10'"; ?>>
</div>
<div style="float:left; width:130px; height:120px; text-align:center;">
<a href="http://www.topmmo.com.br/" target="_blank" title="<?php echo"$language_37"; ?>">Top MMO<br>
<img src="http://www.topmmo.com.br/vote.gif" width="87" height="47" border="0"></a><br>
<input type='text' id='39' <?php echo"$style1"; echo" value='$b11'"; ?>>
</div>
<div style="float:left; width:130px; height:120px; text-align:center;">
<a href="http://www.top200games.com.br/" target="_blank" title="<?php echo"$language_37"; ?>">Top200Games<br>
<img src="http://www.top200games.com.br/skins/New/vote.png" width="87" height="47" border="0"></a><br>
<input type='text' id='40' <?php echo"$style1"; echo" value='$b12'"; ?>>
</div>

<div style="float:left; width:100%; height:80px; line-height:80px; text-align:center; font-weight:bold;"><?php echo"$language_51"; ?></div>

<div id="inst_1"><?php echo"$language_52"; ?> 01: <input type='text' id='17' name="m1" <?php echo"$style1"; echo" value='$m01'"; ?>> <?php echo"$language_55"; ?> <input type='text' id='27' <?php echo"$style2"; echo" value='$q01'"; ?>></div>
<div id="inst_1"><?php echo"$language_52"; ?> 06: <input type='text' id='22' name="m6" <?php echo"$style1"; echo" value='$m06'"; ?>> <?php echo"$language_55"; ?> <input type='text' id='32' <?php echo"$style2"; echo" value='$q06'"; ?>></div>
<div id="inst_1"><?php echo"$language_52"; ?> 02: <input type='text' id='18' name="m2" <?php echo"$style1"; echo" value='$m02'"; ?>> <?php echo"$language_55"; ?> <input type='text' id='28' <?php echo"$style2"; echo" value='$q02'"; ?>></div>
<div id="inst_1"><?php echo"$language_52"; ?> 07: <input type='text' id='23' name="m7" <?php echo"$style1"; echo" value='$m07'"; ?>> <?php echo"$language_55"; ?> <input type='text' id='33' <?php echo"$style2"; echo" value='$q07'"; ?>></div>
<div id="inst_1"><?php echo"$language_52"; ?> 03: <input type='text' id='19' name="m3" <?php echo"$style1"; echo" value='$m03'"; ?>> <?php echo"$language_55"; ?> <input type='text' id='29' <?php echo"$style2"; echo" value='$q03'"; ?>></div>
<div id="inst_2"><?php echo"$language_52"; ?> 08: <input type='text' id='24' name="m8" <?php echo"$style1"; echo" value='$m08'"; ?>> <?php echo"$language_55"; ?> <input type='text' id='34' <?php echo"$style2"; echo" value='$q08'"; ?>></div>
<div id="inst_2"><?php echo"$language_52"; ?> 04: <input type='text' id='20' name="m4" <?php echo"$style1"; echo" value='$m04'"; ?>> <?php echo"$language_55"; ?> <input type='text' id='30' <?php echo"$style2"; echo" value='$q04'"; ?>></div>
<div id="inst_2"><?php echo"$language_52"; ?> 09: <input type='text' id='25' name="m9" <?php echo"$style1"; echo" value='$m09'"; ?>> <?php echo"$language_55"; ?> <input type='text' id='35' <?php echo"$style2"; echo" value='$q09'"; ?>></div>
<div id="inst_2"><?php echo"$language_52"; ?> 05: <input type='text' id='21' name="m5" <?php echo"$style1"; echo" value='$m05'"; ?>> <?php echo"$language_55"; ?> <input type='text' id='31' <?php echo"$style2"; echo" value='$q05'"; ?>></div>
<div id="inst_2"><?php echo"$language_52"; ?> 10: <input type='text' id='26' name="m10" <?php echo"$style1"; echo" value='$m010'"; ?>> <?php echo"$language_55"; ?> <input type='text' id='36' <?php echo"$style2"; echo" value='$q10'"; ?>></div>

<div id="inst_1"><?php echo"$language_53"; ?></div><div id="inst_2"><select name="deposito" id='1'><?php if($dep == '0'){ ?><option value="0">Warehouse</option><option value="1">Inventário</option><?php }elseif($dep == '1'){ ?><option value="1">Inventário</option><option value="0">Warehouse</option><?php } ?></select></div>

<div id="inst_1"><?php echo"$language_66"; ?></div><div id="inst_2"><select name="voto" id='38'><?php if($vd == '0'){ ?><option value="0"><?php echo"$language_68"; ?></option><option value="1"><?php echo"$language_67"; ?></option><?php }elseif($vd == '1'){ ?><option value="1"><?php echo"$language_67"; ?></option><option value="0"><?php echo"$language_68"; ?></option><?php } ?></select></div>

<div id="inst_1"><?php echo"$language_54"; ?></div><div id="inst_2"><input type='text' id='37' value="12" <?php echo"$style3"; echo" value='$hora'"; ?>></div>

<div class='entrega' style='text-align:center;'><img src='images/ajax-loader.gif'><br /><?php echo"$language_60"; ?></div>

<div style="float:left; width:100%; height:80px; line-height:80px; text-align:center;">
<button style='margin-top: 20px; margin-bottom: 20px;' class='button secondary'><?php echo"$language_59"; ?></button>
</div>

</form>
<div class="edits"></div>
<div style="clear:both;"></div>
</div>