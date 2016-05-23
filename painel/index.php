<?php
##########################################
#				 Créditos:				 #
#	Este sistema foi desenvolvido por:	 #
#		 Ivan Pires (ICPNetworks)		 #
#		    E estilizado por:			 #
#		Hugo Felipe (ICPNetworks)		 #
#	E-mail: contato@icpnetworks.com.br	 #
#	Site: http://www.icpnetworks.com.br	 #
##########################################
if (!isset($_SESSION)){ session_start(); }
if (($_SESSION["UsuarioNivel"] < '0') or ($_SESSION["UsuarioNivel"] > '1')) {
	session_destroy();
	echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=../'>";
	exit;
}
if(file_exists("../config/connect_config.php")){
include('../config/connect_config.php');
}
if(file_exists("../config/language.php")){
include('../config/language.php');
}
$id1 = isset($id1) ? $id1 : NULL;
$id2 = isset($id2) ? $id2 : NULL;
$id3 = isset($id3) ? $id3 : NULL;
$id4 = isset($id4) ? $id4 : NULL;
$id5 = isset($id5) ? $id5 : NULL;
$id6 = isset($id6) ? $id6 : NULL;
$id7 = isset($id7) ? $id7 : NULL;
$id8 = isset($id8) ? $id8 : NULL;
$id9 = isset($id9) ? $id9 : NULL;
$id10 = isset($id10) ? $id10 : NULL;
$id11 = isset($id11) ? $id11 : NULL;
$id12 = isset($id12) ? $id12 : NULL;
if($_SESSION["UsuarioNivel"] == '1'){ ?>
<script type="text/javascript">
function adm(){
$(function(){
	$.post('adm.php', {}, function(data){
		$('.formulario').html(data).show();
	});
	$('.loading').fadeIn('slow').delay(3000);
});
	$('.loading').ajaxStop(function(){
		$('.loading').hide();
	});
};
</script>
<div id="adm"><a href="#" onClick="javascript:adm();"><?php echo"$language_32"; ?></a></div>
<?php
$pagina = @file_get_contents('http://www.icpnetworks.com.br/votesystem/update.php');
$pos = strpos($pagina, 'Version: ');
$update = $pagina[9].$pagina[10].$pagina[11];
$pos = strstr($pagina, 'http://');
$up_download = $pos;
if($version < $update){
	echo"<div id='update'><div style='padding-left:25px; height:23px; line-height:23px; color:#ff0; background-color:rgba(150,150,150,0.3); border-bottom:1px solid #999; text-shadow:1px 1px #000; font-size:12px;'>$language_42</div><div style='padding-left:3px;'>$language_43 <a href='$up_download' target='_blank'>VoteSystem ICPNetworks $update</a></div></div>";
}
} ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='../css/default.css' rel='stylesheet' type='text/css' />
<link href='../imgs/icpnetworks_icon.png' type='image/x-icon' rel='shortcut icon' />
<script language="Javascript" type="text/javascript">
<!--
function SetCookie(cookieName,cookieValue) {
 var today = new Date();
 var expire = new Date();
 var click = new Date();
 var nHours=12
 expire.setTime(today.getTime() + 3600000*nHours);
 click.setTime(today.getTime() - 10800000);
 document.cookie = cookieName+"="+click.toGMTString()
                 + ";expires="+expire.toGMTString();
}
//-->
</script>
<div style="text-align:left; border-bottom:1px solid #666; padding-left:5px; float:left; margin-top:-67px; width:574px; color:#FFF; line-height:30px;">
<span style="float:left;"><?php echo"$language_01 $_SESSION[UsuarioLogin]"; ?></span><span style="float:right; margin-right:5px;"><a href="painel/logout.php" style="color:#ccc; text-decoration:none;"><?php echo"$language_02"; ?></a></span>
</div>
<div style="width:470px; height:auto; margin:auto;" id="banners">
<?php
$tops = mysql_query("SELECT * FROM icp_votesystem_tops WHERE disponivel = '1'") or die(mysql_error());
if(mysql_num_rows($tops) == '0'){
	echo"$language_03<br>$language_04";
}else{
while($row = mysql_fetch_array($tops)){
if($row["id"] == '1'){
$link = "http://www.topservers200.com";@$site = fopen($link,"r");
if($site){
@header('Content-Type: text/html; charset=utf-8');
$xml1 = @simplexml_load_file("http://www.topservers200.com/api/vote/?ip=$_SERVER[REMOTE_ADDR]");
foreach($xml1->vote as $vote){
$data_modificada1 = date("Y-m-d H:i:s",strtotime("$vote->date + $horas_voto hours"));
}
$data_hoje = date('Y-m-d H:i:s');
$data1 = strtotime($data_modificada1);
$data2 = strtotime($data_hoje);
if($data1 >= $data2){
	$id1 = '1';
	$data_modificada_1 = substr(str_replace(" ", "", $data_modificada1), 0, 10);
	$hora_modificada_1 = substr(str_replace(" ", "", $data_modificada1), 10, 19);
	$data_voto = explode("-", $data_modificada_1);
	$hora_voto = explode(":", $hora_modificada_1);
?>
<script language="javascript">
        var YY = <?php echo $data_voto[0]; ?>;
        var MM = <?php echo $data_voto[1]; ?>;
        var DD = <?php echo $data_voto[2]; ?>;
        var HH = <?php echo $hora_voto[0]; ?>;
        var MI = <?php echo $hora_voto[1]; ?>;
        var SS = <?php echo $hora_voto[2]; ?>;
        
        function atualizaContador1() {  
                var hoje = new Date();  
                var futuro = new Date(YY,MM-1,DD,HH,MI,SS);   
                var ss = parseInt((futuro - hoje) / 1000);  
                var mm = parseInt(ss / 60);  
                var hh = parseInt(mm / 60);  
                var dd = parseInt(hh / 24);   
                ss = ss - (mm * 60);  
                mm = mm - (hh * 60);  
                hh = hh - (dd * 24);
                var hora = (hh && hh >= 10) ? hh+':' : ((hh<10 && hh>0) ? '0'+hh+':' : '00:');
                var min = (mm && mm >= 10) ? mm+':' : ((mm<10 && mm>0) ? '0'+mm+':' : '00:');
                var seg = (ss && ss >= 10) ? ss : (ss<10 ? '0'+ss : '00');
				var faltam = hora+min+seg;
        
                if (faltam > '00:00:00') {
                        document.getElementById('contador1').innerHTML = faltam;       
                        setTimeout(atualizaContador1, 1000);  
                } else {
                        document.getElementById('contador1').innerHTML = 'Vote!'; 
                }
        }
		atualizaContador1();
</script>
<?php
echo"<div style='background:url(http://www.topservers200.com/button/$row[top_id].png); background-repeat: no-repeat; background-size: 87px 47px; width:87px; height:47px; border:1px solid #999; margin-top:5px; margin-left:5px; float:left;'><div style='width:89px; *width:87px; _width:87px; height:49px; *height:47px; _height:47px; font-size:10px; font-family:Arial; background: rgba(0,0,0,0.7); text-shadow:1px 1px #000; font-weight:bold;'>$language_05<br><font size='3'><span id='contador1'></span></font><br>$language_06</div></div>";
}else{
	$id1 = '0';
echo"<div style='width:87px; height:47px; border:1px solid #999; margin-top:5px; margin-left:5px; float:left;'><a href='http://www.topservers200.com/in.php?id=$row[top_id]' target='_blank'><img src='http://www.topservers200.com/button/$row[top_id].png' title='Vote no Top 200' border='0'></a></div>";
}
}else{
	$id1 = '1';
}
}


if($row["id"] == '2'){
$link = "http://top.l2jbrasil.com/votesystem/";
@$site = fopen($link,"r");
$xml2 = null;
if(checkOnline($link)){
@header('Content-Type: text/html; charset=utf-8');

$xml_string = acessoSimples("http://top.l2jbrasil.com/votesystem/?ip=$_SERVER[REMOTE_ADDR]&username=$row[top_id]");
$xml2 = @simplexml_load_string($xml_string);
//var_dump($xml2,count($xml2));exit;
if(count($xml2)){
	foreach($xml2->vote as $vote){
		$data_modificada2 = date("Y-m-d H:i:s",strtotime("$vote->date + $horas_voto hours"));
	}
}
$data_hoje = date('Y-m-d H:i:s');
$data1 = strtotime($data_modificada2);
$data2 = strtotime($data_hoje);
if($data1 >= $data2){
	$id2 = '1';
	$data_modificada_2 = substr(str_replace(" ", "", $data_modificada2), 0, 10);
	$hora_modificada_2 = substr(str_replace(" ", "", $data_modificada2), 10, 19);
	$data_voto = explode("-", $data_modificada_2);
	$hora_voto = explode(":", $hora_modificada_2);
?>
<script language="javascript">
        var YY2 = <?php echo $data_voto[0]; ?>;
        var MM2 = <?php echo $data_voto[1]; ?>;
        var DD2 = <?php echo $data_voto[2]; ?>;
        var HH2 = <?php echo $hora_voto[0]; ?>;
        var MI2 = <?php echo $hora_voto[1]; ?>;
        var SS2 = <?php echo $hora_voto[2]; ?>;
        
        function atualizaContador2() {  
                var hoje = new Date();  
                var futuro = new Date(YY2,MM2-1,DD2,HH2,MI2,SS2);   
                var ss = parseInt((futuro - hoje) / 1000);  
                var mm = parseInt(ss / 60);  
                var hh = parseInt(mm / 60);  
                var dd = parseInt(hh / 24);   
                ss = ss - (mm * 60);  
                mm = mm - (hh * 60);  
                hh = hh - (dd * 24);
                var hora = (hh && hh >= 10) ? hh+':' : ((hh<10 && hh>0) ? '0'+hh+':' : '00:');
                var min = (mm && mm >= 10) ? mm+':' : ((mm<10 && mm>0) ? '0'+mm+':' : '00:');
                var seg = (ss && ss >= 10) ? ss : (ss<10 ? '0'+ss : '00');
				var faltam = hora+min+seg;
        
                if (faltam > '00:00:00') {
                        document.getElementById('contador2').innerHTML = faltam;       
                        setTimeout(atualizaContador2, 1000);  
                } else {
                        document.getElementById('contador2').innerHTML = 'Vote!'; 
                }
        }
		atualizaContador2();
</script>
<?php
echo"<div style='background:url(http://top.l2jbrasil.com/button.php?u=$row[top_id]); background-repeat: no-repeat; background-size: 87px 47px; width:87px; height:47px; border:1px solid #999; margin-top:5px; margin-left:5px; float:left;'><div style='width:89px; *width:87px; _width:87px; height:49px; *height:47px; _height:47px; font-size:10px; font-family:Arial; background: rgba(0,0,0,0.7); text-shadow:1px 1px #000; font-weight:bold;'>$language_05<br><font size='3'><span id='contador2'></span></font><br>$language_06</div></div>";
}else{
	$id2 = '0';
echo"<div style='width:87px; height:47px; border:1px solid #999; margin-top:5px; margin-left:5px; float:left;'><a href='http://top.l2jbrasil.com/index.php?a=in&u=$row[top_id]' target='_blank'><img src='http://top.l2jbrasil.com/button.php?u=$row[top_id]' title='Top L2JBrasil de Servidores de Lineage2' border='0' width='87' height='47'></a></div>";
}
}else{
	$id2 = '1';
}
}


if($row["id"] == '3'){
$link = "http://www.gamesites200.com";@$site = fopen($link,"r");
if($site){
$preg = preg_match('/([0-9.]+)[.]/', $_SERVER["REMOTE_ADDR"], $match);
$exp = explode('.',$match[1]);
$ip_analise = implode('-', $exp);
$pagina = @file_get_contents('http://www.gamesites200.com/lineage2/analyzeIP-'.$row['top_id'].'-'.$ip_analise.'.html');
$pos = strpos($pagina, 'Used');
if($pagina[130] == '0'){
	$id3 = '0';
	echo"<div style='width:87px; height:47px; border:1px solid #999; margin-top:5px; margin-left:5px; float:left;'><a href='http://www.gamesites200.com/lineage2/in.php?id=$row[top_id]' target='_blank'><img src='http://www.gamesites200.com/lineage2/vote.gif' title='Lineage 2 Top 200 - L2 Adena, Clans, Private Servers' border='0' width='87' height='47' onClick=SetCookie('gamesites','click');></a></div>";
}elseif($pagina[130] == '1'){
		$data_hoje = date('Y-m-d H:i:s');
			if(isset($_COOKIE["gamesites"])){
			$dia_gs = substr($_COOKIE["gamesites"], 5, 2);
			$ano_gs = substr($_COOKIE["gamesites"], 12, 4);
			$mes_gs = substr($_COOKIE["gamesites"], 8, 3);
			$hor_gs = substr($_COOKIE["gamesites"], 17, 2);
			$min_gs = substr($_COOKIE["gamesites"], 20, 2);
			$seg_gs = substr($_COOKIE["gamesites"], 23, 2);
			if($mes_gs == 'Jan'){ $mes_gs = '01'; }elseif($mes_gs == 'Feb'){ $mes_gs = '02'; }elseif($mes_gs == 'Mar'){ $mes_gs = '03'; }elseif($mes_gs == 'Apr'){ $mes_gs = '04'; }elseif($mes_gs == 'May'){ $mes_gs = '05'; }elseif($mes_gs == 'Jun'){ $mes_gs = '06'; }elseif($mes_gs == 'Jul'){ $mes_gs = '07'; }elseif($mes_gs == 'Aug'){ $mes_gs = '08'; }elseif($mes_gs == 'Sep'){ $mes_gs = '09'; }elseif($mes_gs == 'Oct'){ $mes_gs = '10'; }elseif($mes_gs == 'Nov'){ $mes_gs = '11'; }elseif($mes_gs == 'Dec'){ $mes_gs = '12'; }
			$clickgs = $ano_gs."-".$mes_gs."-".$dia_gs." ".$hor_gs.":".$min_gs.":".$seg_gs;
			$clickgs = date("Y-m-d H:i:s",strtotime("$clickgs + $horas_voto hours"));
			}else{
			$clickgs = '0000-00-00 00:00:00';
			}
		$checa_gs200 = mysql_query("SELECT data_voto_id3 FROM icp_votesystem_votos WHERE ip = '$_SERVER[REMOTE_ADDR]' AND data_voto_id3 >= '$data_hoje'") or die(mysql_error());
		if(mysql_num_rows($checa_gs200) == '0' and $data_hoje > $clickgs){
			$id3 = '0';
			echo"<div style='width:87px; height:47px; border:1px solid #999; margin-top:5px; margin-left:5px; float:left;'><a href='http://www.gamesites200.com/lineage2/in.php?id=$row[top_id]' target='_blank'><img src='http://www.gamesites200.com/lineage2/vote.gif' title='Lineage 2 Top 200 - L2 Adena, Clans, Private Servers' border='0' width='87' height='47' onClick=SetCookie('gamesites','click');></a></div>";
		}elseif(mysql_num_rows($checa_gs200) == '0' and $data_hoje < $clickgs){
			$id3 = '1';
				$data_modificada3 = $clickgs;
				$data_modificada_3 = substr(str_replace(" ", "", $data_modificada3), 0, 10);
				$hora_modificada_3 = substr(str_replace(" ", "", $data_modificada3), 10, 19);
				$data_voto = explode("-", $data_modificada_3);
				$hora_voto = explode(":", $hora_modificada_3);
			?>
			<script language="javascript">
					var YY3 = <?php echo $data_voto[0]; ?>;
					var MM3 = <?php echo $data_voto[1]; ?>;
					var DD3 = <?php echo $data_voto[2]; ?>;
					var HH3 = <?php echo $hora_voto[0]; ?>;
					var MI3 = <?php echo $hora_voto[1]; ?>;
					var SS3 = <?php echo $hora_voto[2]; ?>;
					
					function atualizaContador3() {  
							var hoje = new Date();  
							var futuro = new Date(YY3,MM3-1,DD3,HH3,MI3,SS3);   
							var ss = parseInt((futuro - hoje) / 1000);  
							var mm = parseInt(ss / 60);  
							var hh = parseInt(mm / 60);  
							var dd = parseInt(hh / 24);   
							ss = ss - (mm * 60);  
							mm = mm - (hh * 60);  
							hh = hh - (dd * 24);
							var hora = (hh && hh >= 10) ? hh+':' : ((hh<10 && hh>0) ? '0'+hh+':' : '00:');
							var min = (mm && mm >= 10) ? mm+':' : ((mm<10 && mm>0) ? '0'+mm+':' : '00:');
							var seg = (ss && ss >= 10) ? ss : (ss<10 ? '0'+ss : '00');
							var faltam = hora+min+seg;
					
							if (faltam > '00:00:00') {
									document.getElementById('contador3').innerHTML = faltam;       
									setTimeout(atualizaContador3, 1000);  
							} else {
									document.getElementById('contador3').innerHTML = 'Vote!'; 
							}
					}
					atualizaContador3();
			</script>
			<?php
			echo"<div style='background:url(http://www.gamesites200.com/lineage2/vote.gif); background-repeat: no-repeat; background-size: 87px 47px; width:87px; height:47px; border:1px solid #999; margin-top:5px; margin-left:5px; float:left;'><div style='width:89px; *width:87px; _width:87px; height:49px; *height:47px; _height:47px; font-size:10px; font-family:Arial; background: rgba(0,0,0,0.6); text-shadow:1px 1px #000; font-weight:bold;'>$language_05<br><font size='3'><span id='contador3'></span></font><br>$language_06</div></div>";
		}else{
			$id3 = '1';
			while($voto3 = mysql_fetch_array($checa_gs200)){ $data3 = $voto3["data_voto_id3"]; }
			$data_modificada3 = date("Y-m-d H:i:s",strtotime("$data3"));
				$data_modificada_3 = substr(str_replace(" ", "", $data_modificada3), 0, 10);
				$hora_modificada_3 = substr(str_replace(" ", "", $data_modificada3), 10, 19);
				$data_voto = explode("-", $data_modificada_3);
				$hora_voto = explode(":", $hora_modificada_3);
			?>
			<script language="javascript">
					var YY3 = <?php echo $data_voto[0]; ?>;
					var MM3 = <?php echo $data_voto[1]; ?>;
					var DD3 = <?php echo $data_voto[2]; ?>;
					var HH3 = <?php echo $hora_voto[0]; ?>;
					var MI3 = <?php echo $hora_voto[1]; ?>;
					var SS3 = <?php echo $hora_voto[2]; ?>;
					
					function atualizaContador3() {  
							var hoje = new Date();  
							var futuro = new Date(YY3,MM3-1,DD3,HH3,MI3,SS3);    
							var ss = parseInt((futuro - hoje) / 1000);  
							var mm = parseInt(ss / 60);  
							var hh = parseInt(mm / 60);  
							var dd = parseInt(hh / 24);   
							ss = ss - (mm * 60);  
							mm = mm - (hh * 60);  
							hh = hh - (dd * 24);
							var hora = (hh && hh >= 10) ? hh+':' : ((hh<10 && hh>0) ? '0'+hh+':' : '00:');
							var min = (mm && mm >= 10) ? mm+':' : ((mm<10 && mm>0) ? '0'+mm+':' : '00:');
							var seg = (ss && ss >= 10) ? ss : (ss<10 ? '0'+ss : '00');
							var faltam = hora+min+seg;
					
							if (faltam > '00:00:00') {
									document.getElementById('contador3').innerHTML = faltam;       
									setTimeout(atualizaContador3, 1000);  
							} else {
									document.getElementById('contador3').innerHTML = 'Vote!'; 
							}
					}
					atualizaContador3();
			</script>
			<?php
			echo"<div style='background:url(http://www.gamesites200.com/lineage2/vote.gif); background-repeat: no-repeat; background-size: 87px 47px; width:87px; height:47px; border:1px solid #999; margin-top:5px; margin-left:5px; float:left;'><div style='width:89px; *width:87px; _width:87px; height:49px; *height:47px; _height:47px; font-size:10px; font-family:Arial; background: rgba(0,0,0,0.6); text-shadow:1px 1px #000; font-weight:bold;'>$language_05<br><font size='3'><span id='contador3'></span></font><br>$language_06</div></div>";
		}
}elseif($pagina[130] >= '2'){
		$data_hoje = date('Y-m-d H:i:s');
			if(isset($_COOKIE["gamesites"])){
			$dia_gs = substr($_COOKIE["gamesites"], 5, 2);
			$ano_gs = substr($_COOKIE["gamesites"], 12, 4);
			$mes_gs = substr($_COOKIE["gamesites"], 8, 3);
			$hor_gs = substr($_COOKIE["gamesites"], 17, 2);
			$min_gs = substr($_COOKIE["gamesites"], 20, 2);
			$seg_gs = substr($_COOKIE["gamesites"], 23, 2);
			if($mes_gs == 'Jan'){ $mes_gs = '01'; }elseif($mes_gs == 'Feb'){ $mes_gs = '02'; }elseif($mes_gs == 'Mar'){ $mes_gs = '03'; }elseif($mes_gs == 'Apr'){ $mes_gs = '04'; }elseif($mes_gs == 'May'){ $mes_gs = '05'; }elseif($mes_gs == 'Jun'){ $mes_gs = '06'; }elseif($mes_gs == 'Jul'){ $mes_gs = '07'; }elseif($mes_gs == 'Aug'){ $mes_gs = '08'; }elseif($mes_gs == 'Sep'){ $mes_gs = '09'; }elseif($mes_gs == 'Oct'){ $mes_gs = '10'; }elseif($mes_gs == 'Nov'){ $mes_gs = '11'; }elseif($mes_gs == 'Dec'){ $mes_gs = '12'; }
			$clickgs = $ano_gs."-".$mes_gs."-".$dia_gs." ".$hor_gs.":".$min_gs.":".$seg_gs;
			$clickgs = date("Y-m-d H:i:s",strtotime("$clickgs + $horas_voto hours"));
			}else{
			$clickgs = '0000-00-00 00:00:00';
			}
		$checa_gs200 = mysql_query("SELECT data_voto_id3 FROM icp_votesystem_votos WHERE ip = '$_SERVER[REMOTE_ADDR]' AND data_voto_id3 >= '$data_hoje'") or die(mysql_error());
		if(mysql_num_rows($checa_gs200) == '0' and $data_hoje > $clickgs){
			$id3 = '1';
			$data3 = $data_hoje;
			$data_modificada3 = date("Y-m-d H:i:s",strtotime("$data3"));
				$data_modificada_3 = substr(str_replace(" ", "", $data_modificada3), 0, 10);
				$hora_modificada_3 = substr(str_replace(" ", "", $data_modificada3), 10, 19);
				$data_voto = explode("-", $data_modificada_3);
				$hora_voto = explode(":", $hora_modificada_3);
			?>
			<script language="javascript">
					var YY3 = <?php echo $data_voto[0]; ?>;
					var MM3 = <?php echo $data_voto[1]; ?>;
					var DD3 = <?php echo $data_voto[2]; ?>;
					var HH3 = <?php echo $hora_voto[0]; ?>;
					var MI3 = <?php echo $hora_voto[1]; ?>;
					var SS3 = <?php echo $hora_voto[2]; ?>;
					
					function atualizaContador3() {  
							var hoje = new Date();  
							var futuro = new Date(YY3,MM3-1,DD3,HH3,MI3,SS3);    
							var ss = parseInt((futuro - hoje) / 1000);  
							var mm = parseInt(ss / 60);  
							var hh = parseInt(mm / 60);  
							var dd = parseInt(hh / 24);   
							ss = ss - (mm * 60);  
							mm = mm - (hh * 60);  
							hh = hh - (dd * 24);
							var hora = (hh && hh >= 10) ? hh+':' : ((hh<10 && hh>0) ? '0'+hh+':' : '00:');
							var min = (mm && mm >= 10) ? mm+':' : ((mm<10 && mm>0) ? '0'+mm+':' : '00:');
							var seg = (ss && ss >= 10) ? ss : (ss<10 ? '0'+ss : '00');
							var faltam = hora+min+seg;
					
							if (faltam > '00:00:00') {
									document.getElementById('contador3').innerHTML = faltam;       
									setTimeout(atualizaContador3, 1000);  
							} else {
									document.getElementById('contador3').innerHTML = 'Vote!'; 
							}
					}
					atualizaContador3();
			</script>
			<?php
			echo"<div style='background:url(http://www.gamesites200.com/lineage2/vote.gif); background-repeat: no-repeat; background-size: 87px 47px; width:87px; height:47px; border:1px solid #999; margin-top:5px; margin-left:5px; float:left;'><div style='width:89px; *width:87px; _width:87px; height:49px; *height:47px; _height:47px; font-size:10px; font-family:Arial; background: rgba(0,0,0,0.6); text-shadow:1px 1px #000; font-weight:bold;'>$language_05<br><font size='3'><span id='contador3'></span></font><br>$language_06</div></div>";
		}elseif(mysql_num_rows($checa_gs200) == '0' and $data_hoje < $clickgs){
			$id3 = '1';
			$data_modificada3 = $clickgs;
				$data_modificada_3 = substr(str_replace(" ", "", $data_modificada3), 0, 10);
				$hora_modificada_3 = substr(str_replace(" ", "", $data_modificada3), 10, 19);
				$data_voto = explode("-", $data_modificada_3);
				$hora_voto = explode(":", $hora_modificada_3);
			?>
			<script language="javascript">
					var YY3 = <?php echo $data_voto[0]; ?>;
					var MM3 = <?php echo $data_voto[1]; ?>;
					var DD3 = <?php echo $data_voto[2]; ?>;
					var HH3 = <?php echo $hora_voto[0]; ?>;
					var MI3 = <?php echo $hora_voto[1]; ?>;
					var SS3 = <?php echo $hora_voto[2]; ?>;
					
					function atualizaContador3() {  
							var hoje = new Date();  
							var futuro = new Date(YY3,MM3-1,DD3,HH3,MI3,SS3);   
							var ss = parseInt((futuro - hoje) / 1000);  
							var mm = parseInt(ss / 60);  
							var hh = parseInt(mm / 60);  
							var dd = parseInt(hh / 24);   
							ss = ss - (mm * 60);  
							mm = mm - (hh * 60);  
							hh = hh - (dd * 24);
							var hora = (hh && hh >= 10) ? hh+':' : ((hh<10 && hh>0) ? '0'+hh+':' : '00:');
							var min = (mm && mm >= 10) ? mm+':' : ((mm<10 && mm>0) ? '0'+mm+':' : '00:');
							var seg = (ss && ss >= 10) ? ss : (ss<10 ? '0'+ss : '00');
							var faltam = hora+min+seg;
					
							if (faltam > '00:00:00') {
									document.getElementById('contador3').innerHTML = faltam;       
									setTimeout(atualizaContador3, 1000);  
							} else {
									document.getElementById('contador3').innerHTML = 'Vote!'; 
							}
					}
					atualizaContador3();
			</script>
			<?php
			echo"<div style='background:url(http://www.gamesites200.com/lineage2/vote.gif); background-repeat: no-repeat; background-size: 87px 47px; width:87px; height:47px; border:1px solid #999; margin-top:5px; margin-left:5px; float:left;'><div style='width:89px; *width:87px; _width:87px; height:49px; *height:47px; _height:47px; font-size:10px; font-family:Arial; background: rgba(0,0,0,0.6); text-shadow:1px 1px #000; font-weight:bold;'>$language_05<br><font size='3'><span id='contador3'></span></font><br>$language_06</div></div>";
		}else{
			$id3 = '1';
			while($voto3 = mysql_fetch_array($checa_gs200)){ $data3 = $voto3["data_voto_id3"]; }
			$data_modificada3 = date("Y-m-d H:i:s",strtotime("$data3"));
				$data_modificada_3 = substr(str_replace(" ", "", $data_modificada3), 0, 10);
				$hora_modificada_3 = substr(str_replace(" ", "", $data_modificada3), 10, 19);
				$data_voto = explode("-", $data_modificada_3);
				$hora_voto = explode(":", $hora_modificada_3);
			?>
			<script language="javascript">
					var YY3 = <?php echo $data_voto[0]; ?>;
					var MM3 = <?php echo $data_voto[1]; ?>;
					var DD3 = <?php echo $data_voto[2]; ?>;
					var HH3 = <?php echo $hora_voto[0]; ?>;
					var MI3 = <?php echo $hora_voto[1]; ?>;
					var SS3 = <?php echo $hora_voto[2]; ?>;
					
					function atualizaContador3() {  
							var hoje = new Date();  
							var futuro = new Date(YY3,MM3-1,DD3,HH3,MI3,SS3);   
							var ss = parseInt((futuro - hoje) / 1000);  
							var mm = parseInt(ss / 60);  
							var hh = parseInt(mm / 60);  
							var dd = parseInt(hh / 24);   
							ss = ss - (mm * 60);  
							mm = mm - (hh * 60);  
							hh = hh - (dd * 24);
							var hora = (hh && hh >= 10) ? hh+':' : ((hh<10 && hh>0) ? '0'+hh+':' : '00:');
							var min = (mm && mm >= 10) ? mm+':' : ((mm<10 && mm>0) ? '0'+mm+':' : '00:');
							var seg = (ss && ss >= 10) ? ss : (ss<10 ? '0'+ss : '00');
							var faltam = hora+min+seg;
					
							if (faltam > '00:00:00') {
									document.getElementById('contador3').innerHTML = faltam;       
									setTimeout(atualizaContador3, 1000);  
							} else {
									document.getElementById('contador3').innerHTML = 'Vote!'; 
							}
					}
					atualizaContador3();
			</script>
			<?php
			echo"<div style='background:url(http://www.gamesites200.com/lineage2/vote.gif); background-repeat: no-repeat; background-size: 87px 47px; width:87px; height:47px; border:1px solid #999; margin-top:5px; margin-left:5px; float:left;'><div style='width:89px; *width:87px; _width:87px; height:49px; *height:47px; _height:47px; font-size:10px; font-family:Arial; background: rgba(0,0,0,0.6); text-shadow:1px 1px #000; font-weight:bold;'>$language_05<br><font size='3'><span id='contador3'></span></font><br>$language_06</div></div>";
		}
}
}else{
	$id3 = '1';
}
}


if($row["id"] == '4'){
$link = "http://www.toplineage2.com";@$site = fopen($link,"r");
if($site){
@header('Content-Type: text/html; charset=utf-8');
$xml4 = @simplexml_load_file("http://toplineage2.com/api/?ip=$_SERVER[REMOTE_ADDR]&site_id=$row[top_id]");
foreach($xml4->vote as $vote){
$data_modificada4 = date("Y-m-d H:i:s",strtotime("$vote->date + $horas_voto hours"));
}
$data_hoje = date('Y-m-d H:i:s');
$data1 = strtotime($data_modificada4);
$data2 = strtotime($data_hoje);
if($data1 >= $data2){
	$id4 = '1';
	$data_modificada_4 = substr(str_replace(" ", "", $data_modificada4), 0, 10);
	$hora_modificada_4 = substr(str_replace(" ", "", $data_modificada4), 10, 19);
	$data_voto = explode("-", $data_modificada_4);
	$hora_voto = explode(":", $hora_modificada_4);
?>
<script language="javascript">
        var YY4 = <?php echo $data_voto[0]; ?>;
        var MM4 = <?php echo $data_voto[1]; ?>;
        var DD4 = <?php echo $data_voto[2]; ?>;
        var HH4 = <?php echo $hora_voto[0]; ?>;
        var MI4 = <?php echo $hora_voto[1]; ?>;
        var SS4 = <?php echo $hora_voto[2]; ?>;
        
        function atualizaContador4() {  
                var hoje = new Date();  
                var futuro = new Date(YY4,MM4-1,DD4,HH4,MI4,SS4);   
                var ss = parseInt((futuro - hoje) / 1000);  
                var mm = parseInt(ss / 60);  
                var hh = parseInt(mm / 60);  
                var dd = parseInt(hh / 24);   
                ss = ss - (mm * 60);  
                mm = mm - (hh * 60);  
                hh = hh - (dd * 24);
                var hora = (hh && hh >= 10) ? hh+':' : ((hh<10 && hh>0) ? '0'+hh+':' : '00:');
                var min = (mm && mm >= 10) ? mm+':' : ((mm<10 && mm>0) ? '0'+mm+':' : '00:');
                var seg = (ss && ss >= 10) ? ss : (ss<10 ? '0'+ss : '00');
				var faltam = hora+min+seg;
        
                if (faltam > '00:00:00') {
                        document.getElementById('contador4').innerHTML = faltam;       
                        setTimeout(atualizaContador4, 1000);  
                } else {
                        document.getElementById('contador4').innerHTML = 'Vote!'; 
                }
        }
		atualizaContador4();
</script>
<?php
echo"<div style='background:url(http://toplineage2.com/banner.php?site_id=$row[top_id]); background-repeat: no-repeat; background-size: 87px 47px; width:87px; height:47px; border:1px solid #999; margin-top:5px; margin-left:5px; float:left;'><div style='width:89px; *width:87px; _width:87px; height:49px; *height:47px; _height:47px; font-size:10px; font-family:Arial; background: rgba(0,0,0,0.6); text-shadow:1px 1px #000; font-weight:bold;'>$language_05<br><font size='3'><span id='contador4'></span></font><br>$language_06</div></div>";
}else{
	$id4 = '0';
echo"<div style='width:87px; height:47px; border:1px solid #999; margin-top:5px; margin-left:5px; float:left;'><a href='http://toplineage2.com/index.php?icp=vote&id=$row[top_id]' target='_blank'><img src='http://toplineage2.com/banner.php?site_id=$row[top_id]' title='Vote on the Lineage 2 Top 200' border='0' width='87' height='47'></a></div>";
}
}else{
	$id4 = '1';
}
}


if($row["id"] == '5'){
$link = "http://www.gtop100.com";@$site = fopen($link,"r");
if($site){
	if(isset($_COOKIE["click_id5"])){
	$dia_5 = substr($_COOKIE["click_id5"], 5, 2);
	$ano_5 = substr($_COOKIE["click_id5"], 12, 4);
	$mes_5 = substr($_COOKIE["click_id5"], 8, 3);
	$hor_5 = substr($_COOKIE["click_id5"], 17, 2);
	$min_5 = substr($_COOKIE["click_id5"], 20, 2);
	$seg_5 = substr($_COOKIE["click_id5"], 23, 2);
	if($mes_5 == 'Jan'){ $mes_5 = '01'; }elseif($mes_5 == 'Feb'){ $mes_5 = '02'; }elseif($mes_5 == 'Mar'){ $mes_5 = '03'; }elseif($mes_5 == 'Apr'){ $mes_5 = '04'; }elseif($mes_5 == 'May'){ $mes_5 = '05'; }elseif($mes_5 == 'Jun'){ $mes_5 = '06'; }elseif($mes_5 == 'Jul'){ $mes_5 = '07'; }elseif($mes_5 == 'Aug'){ $mes_5 = '08'; }elseif($mes_5 == 'Sep'){ $mes_5 = '09'; }elseif($mes_5 == 'Oct'){ $mes_5 = '10'; }elseif($mes_5 == 'Nov'){ $mes_5 = '11'; }elseif($mes_5 == 'Dec'){ $mes_5 = '12'; }
	$click_id5 = $ano_5."-".$mes_5."-".$dia_5." ".$hor_5.":".$min_5.":".$seg_5;
	$click_id5 = date("Y-m-d H:i:s",strtotime("$click_id5 + $horas_voto hours"));
		$id5 = '1';
			$data_modificada5 = $click_id5;
			$data_modificada_5 = substr(str_replace(" ", "", $data_modificada5), 0, 10);
			$hora_modificada_5 = substr(str_replace(" ", "", $data_modificada5), 10, 19);
			$data_voto = explode("-", $data_modificada_5);
			$hora_voto = explode(":", $hora_modificada_5);
		?>
		<script language="javascript">
				var YY5 = <?php echo $data_voto[0]; ?>;
				var MM5 = <?php echo $data_voto[1]; ?>;
				var DD5 = <?php echo $data_voto[2]; ?>;
				var HH5 = <?php echo $hora_voto[0]; ?>;
				var MI5 = <?php echo $hora_voto[1]; ?>;
				var SS5 = <?php echo $hora_voto[2]; ?>;
				
				function atualizaContador5() {  
						var hoje = new Date();  
						var futuro = new Date(YY5,MM5-1,DD5,HH5,MI5,SS5);   
						var ss = parseInt((futuro - hoje) / 1000);  
						var mm = parseInt(ss / 60);  
						var hh = parseInt(mm / 60);  
						var dd = parseInt(hh / 24);   
						ss = ss - (mm * 60);  
						mm = mm - (hh * 60);  
						hh = hh - (dd * 24);
						var hora = (hh && hh >= 10) ? hh+':' : ((hh<10 && hh>0) ? '0'+hh+':' : '00:');
						var min = (mm && mm >= 10) ? mm+':' : ((mm<10 && mm>0) ? '0'+mm+':' : '00:');
						var seg = (ss && ss >= 10) ? ss : (ss<10 ? '0'+ss : '00');
						var faltam = hora+min+seg;
				
						if (faltam > '00:00:00') {
								document.getElementById('contador5').innerHTML = faltam;       
								setTimeout(atualizaContador5, 1000);  
						} else {
								document.getElementById('contador5').innerHTML = 'Vote!'; 
						}
				}
				atualizaContador5();
		</script>
		<?php
		echo"<div style='background:url(http://www.gtop100.com/images/votebutton.jpg); background-repeat: no-repeat; background-size: 87px 47px; width:87px; height:47px; border:1px solid #999; margin-top:5px; margin-left:5px; float:left;'><div style='width:89px; *width:87px; _width:87px; height:49px; *height:47px; _height:47px; font-size:10px; font-family:Arial; background: rgba(0,0,0,0.6); text-shadow:1px 1px #000; font-weight:bold;'>$language_05<br><font size='3'><span id='contador5'></span></font><br>$language_06</div></div>";
	}else{
		$id5 = '0';
		echo"<div style='width:87px; height:47px; border:1px solid #999; margin-top:5px; margin-left:5px; float:left;'><a href='http://www.gtop100.com/in.php?site=$row[top_id]' target='_blank'><img src='http://www.gtop100.com/images/votebutton.jpg' title='Lineage 2 Top 100' border='0' width='87' height='47' onClick=SetCookie('click_id5','click');></a></div>";
	}
}else{
	$id5 = '1';
}
}


if($row["id"] == '6'){
$link = "http://www.l2topzone.com";@$site = fopen($link,"r");
if($site){
	if(isset($_COOKIE["click_id6"])){
	$dia_6 = substr($_COOKIE["click_id6"], 5, 2);
	$ano_6 = substr($_COOKIE["click_id6"], 12, 4);
	$mes_6 = substr($_COOKIE["click_id6"], 8, 3);
	$hor_6 = substr($_COOKIE["click_id6"], 17, 2);
	$min_6 = substr($_COOKIE["click_id6"], 20, 2);
	$seg_6 = substr($_COOKIE["click_id6"], 23, 2);
	if($mes_6 == 'Jan'){ $mes_6 = '01'; }elseif($mes_6 == 'Feb'){ $mes_6 = '02'; }elseif($mes_6 == 'Mar'){ $mes_6 = '03'; }elseif($mes_6 == 'Apr'){ $mes_6 = '04'; }elseif($mes_6 == 'May'){ $mes_6 = '05'; }elseif($mes_6 == 'Jun'){ $mes_6 = '06'; }elseif($mes_6 == 'Jul'){ $mes_6 = '07'; }elseif($mes_6 == 'Aug'){ $mes_6 = '08'; }elseif($mes_6 == 'Sep'){ $mes_6 = '09'; }elseif($mes_6 == 'Oct'){ $mes_6 = '10'; }elseif($mes_6 == 'Nov'){ $mes_6 = '11'; }elseif($mes_6 == 'Dec'){ $mes_6 = '12'; }
	$click_id6 = $ano_6."-".$mes_6."-".$dia_6." ".$hor_6.":".$min_6.":".$seg_6;
	$click_id6 = date("Y-m-d H:i:s",strtotime("$click_id6 + $horas_voto hours"));
		$id6 = '1';
			$data_modificada6 = $click_id6;
			$data_modificada_6 = substr(str_replace(" ", "", $data_modificada6), 0, 10);
			$hora_modificada_6 = substr(str_replace(" ", "", $data_modificada6), 10, 19);
			$data_voto = explode("-", $data_modificada_6);
			$hora_voto = explode(":", $hora_modificada_6);
		?>
		<script language="javascript">
				var YY6 = <?php echo $data_voto[0]; ?>;
				var MM6 = <?php echo $data_voto[1]; ?>;
				var DD6 = <?php echo $data_voto[2]; ?>;
				var HH6 = <?php echo $hora_voto[0]; ?>;
				var MI6 = <?php echo $hora_voto[1]; ?>;
				var SS6 = <?php echo $hora_voto[2]; ?>;
				
				function atualizaContador6() {  
						var hoje = new Date();  
						var futuro = new Date(YY6,MM6-1,DD6,HH6,MI6,SS6);   
						var ss = parseInt((futuro - hoje) / 1000);  
						var mm = parseInt(ss / 60);  
						var hh = parseInt(mm / 60);  
						var dd = parseInt(hh / 24);   
						ss = ss - (mm * 60);  
						mm = mm - (hh * 60);  
						hh = hh - (dd * 24);
						var hora = (hh && hh >= 10) ? hh+':' : ((hh<10 && hh>0) ? '0'+hh+':' : '00:');
						var min = (mm && mm >= 10) ? mm+':' : ((mm<10 && mm>0) ? '0'+mm+':' : '00:');
						var seg = (ss && ss >= 10) ? ss : (ss<10 ? '0'+ss : '00');
						var faltam = hora+min+seg;
				
						if (faltam > '00:00:00') {
								document.getElementById('contador6').innerHTML = faltam;       
								setTimeout(atualizaContador6, 1000);  
						} else {
								document.getElementById('contador6').innerHTML = 'Vote!'; 
						}
				}
				atualizaContador6();
		</script>
		<?php
		echo"<div style='background:url(http://image.l2topzone.com/l2topzone.com.jpg); background-repeat: no-repeat; background-size: 87px 47px; width:87px; height:47px; border:1px solid #999; margin-top:5px; margin-left:5px; float:left;'><div style='width:89px; *width:87px; _width:87px; height:49px; *height:47px; _height:47px; font-size:10px; font-family:Arial; background: rgba(0,0,0,0.6); text-shadow:1px 1px #000; font-weight:bold;'>$language_05<br><font size='3'><span id='contador6'></span></font><br>$language_06</div></div>";
	}else{
		$id6 = '0';
		echo"<div style='width:87px; height:47px; border:1px solid #999; margin-top:5px; margin-left:5px; float:left;'><a href='http://l2topzone.com/vote.php?id=$row[top_id]' target='_blank'><img src='http://image.l2topzone.com/l2topzone.com.jpg' title='Lineage 2 Servers' border='0' width='87' height='47' onClick=SetCookie('click_id6','click');></a></div>";
	}
}else{
	$id6 = '1';
}
}


if($row["id"] == '7'){
$link = "http://www.mmorpgtoplist.com";@$site = fopen($link,"r");
if($site){
	if(isset($_COOKIE["click_id7"])){
	$dia_7 = substr($_COOKIE["click_id7"], 5, 2);
	$ano_7 = substr($_COOKIE["click_id7"], 12, 4);
	$mes_7 = substr($_COOKIE["click_id7"], 8, 3);
	$hor_7 = substr($_COOKIE["click_id7"], 17, 2);
	$min_7 = substr($_COOKIE["click_id7"], 20, 2);
	$seg_7 = substr($_COOKIE["click_id7"], 23, 2);
	if($mes_7 == 'Jan'){ $mes_7 = '01'; }elseif($mes_7 == 'Feb'){ $mes_7 = '02'; }elseif($mes_7 == 'Mar'){ $mes_7 = '03'; }elseif($mes_7 == 'Apr'){ $mes_7 = '04'; }elseif($mes_7 == 'May'){ $mes_7 = '05'; }elseif($mes_7 == 'Jun'){ $mes_7 = '06'; }elseif($mes_7 == 'Jul'){ $mes_7 = '07'; }elseif($mes_7 == 'Aug'){ $mes_7 = '08'; }elseif($mes_7 == 'Sep'){ $mes_7 = '09'; }elseif($mes_7 == 'Oct'){ $mes_7 = '10'; }elseif($mes_7 == 'Nov'){ $mes_7 = '11'; }elseif($mes_7 == 'Dec'){ $mes_7 = '12'; }
	$click_id7 = $ano_7."-".$mes_7."-".$dia_7." ".$hor_7.":".$min_7.":".$seg_7;
	$click_id7 = date("Y-m-d H:i:s",strtotime("$click_id7 + $horas_voto hours"));
		$id7 = '1';
			$data_modificada7 = $click_id7;
			$data_modificada_7 = substr(str_replace(" ", "", $data_modificada7), 0, 10);
			$hora_modificada_7 = substr(str_replace(" ", "", $data_modificada7), 10, 19);
			$data_voto = explode("-", $data_modificada_7);
			$hora_voto = explode(":", $hora_modificada_7);
		?>
		<script language="javascript">
				var YY7 = <?php echo $data_voto[0]; ?>;
				var MM7 = <?php echo $data_voto[1]; ?>;
				var DD7 = <?php echo $data_voto[2]; ?>;
				var HH7 = <?php echo $hora_voto[0]; ?>;
				var MI7 = <?php echo $hora_voto[1]; ?>;
				var SS7 = <?php echo $hora_voto[2]; ?>;
				
				function atualizaContador7() {  
						var hoje = new Date();  
						var futuro = new Date(YY7,MM7-1,DD7,HH7,MI7,SS7);   
						var ss = parseInt((futuro - hoje) / 1000);  
						var mm = parseInt(ss / 60);  
						var hh = parseInt(mm / 60);  
						var dd = parseInt(hh / 24);   
						ss = ss - (mm * 60);  
						mm = mm - (hh * 60);  
						hh = hh - (dd * 24);
						var hora = (hh && hh >= 10) ? hh+':' : ((hh<10 && hh>0) ? '0'+hh+':' : '00:');
						var min = (mm && mm >= 10) ? mm+':' : ((mm<10 && mm>0) ? '0'+mm+':' : '00:');
						var seg = (ss && ss >= 10) ? ss : (ss<10 ? '0'+ss : '00');
						var faltam = hora+min+seg;
				
						if (faltam > '00:00:00') {
								document.getElementById('contador7').innerHTML = faltam;       
								setTimeout(atualizaContador7, 1000);  
						} else {
								document.getElementById('contador7').innerHTML = 'Vote!'; 
						}
				}
				atualizaContador7();
		</script>
		<?php
		echo"<div style='background:url(http://www.mmorpgtoplist.com/vote.jpg); background-repeat: no-repeat; background-size: 87px 47px; width:87px; height:47px; border:1px solid #999; margin-top:5px; margin-left:5px; float:left;'><div style='width:89px; *width:87px; _width:87px; height:49px; *height:47px; _height:47px; font-size:10px; font-family:Arial; background: rgba(0,0,0,0.7); text-shadow:1px 1px #000; font-weight:bold;'>$language_05<br><font size='3'><span id='contador7'></span></font><br>$language_06</div></div>";
	}else{
		$id7 = '0';
		echo"<div style='width:87px; height:47px; border:1px solid #999; margin-top:5px; margin-left:5px; float:left;'><a href='http://www.mmorpgtoplist.com/in.php?site=$row[top_id]' target='_blank'><img src='http://www.mmorpgtoplist.com/vote.jpg' title='Lineage2 Private Server' border='0' width='87' height='47' onClick=SetCookie('click_id7','click');></a></div>";
	}
}else{
	$id7 = '1';
}
}


if($row["id"] == '8'){
$link = "http://vgw.hopzone.net";@$site = fopen($link,"r");
if($site){
	if(isset($_COOKIE["click_id8"])){
	$dia_8 = substr($_COOKIE["click_id8"], 5, 2);
	$ano_8 = substr($_COOKIE["click_id8"], 12, 4);
	$mes_8 = substr($_COOKIE["click_id8"], 8, 3);
	$hor_8 = substr($_COOKIE["click_id8"], 17, 2);
	$min_8 = substr($_COOKIE["click_id8"], 20, 2);
	$seg_8 = substr($_COOKIE["click_id8"], 23, 2);
	if($mes_8 == 'Jan'){ $mes_8 = '01'; }elseif($mes_8 == 'Feb'){ $mes_8 = '02'; }elseif($mes_8 == 'Mar'){ $mes_8 = '03'; }elseif($mes_8 == 'Apr'){ $mes_8 = '04'; }elseif($mes_8 == 'May'){ $mes_8 = '05'; }elseif($mes_8 == 'Jun'){ $mes_8 = '06'; }elseif($mes_8 == 'Jul'){ $mes_8 = '07'; }elseif($mes_8 == 'Aug'){ $mes_8 = '08'; }elseif($mes_8 == 'Sep'){ $mes_8 = '09'; }elseif($mes_8 == 'Oct'){ $mes_8 = '10'; }elseif($mes_8 == 'Nov'){ $mes_8 = '11'; }elseif($mes_8 == 'Dec'){ $mes_8 = '12'; }
	$click_id8 = $ano_8."-".$mes_8."-".$dia_8." ".$hor_8.":".$min_8.":".$seg_8;
	$click_id8 = date("Y-m-d H:i:s",strtotime("$click_id8 + $horas_voto hours"));
		$id8 = '1';
			$data_modificada8 = $click_id8;
			$data_modificada_8 = substr(str_replace(" ", "", $data_modificada8), 0, 10);
			$hora_modificada_8 = substr(str_replace(" ", "", $data_modificada8), 10, 19);
			$data_voto = explode("-", $data_modificada_8);
			$hora_voto = explode(":", $hora_modificada_8);
		?>
		<script language="javascript">
				var YY8 = <?php echo $data_voto[0]; ?>;
				var MM8 = <?php echo $data_voto[1]; ?>;
				var DD8 = <?php echo $data_voto[2]; ?>;
				var HH8 = <?php echo $hora_voto[0]; ?>;
				var MI8 = <?php echo $hora_voto[1]; ?>;
				var SS8 = <?php echo $hora_voto[2]; ?>;
				
				function atualizaContador8() {  
						var hoje = new Date();  
						var futuro = new Date(YY8,MM8-1,DD8,HH8,MI8,SS8);   
						var ss = parseInt((futuro - hoje) / 1000);  
						var mm = parseInt(ss / 60);  
						var hh = parseInt(mm / 60);  
						var dd = parseInt(hh / 24);   
						ss = ss - (mm * 60);  
						mm = mm - (hh * 60);  
						hh = hh - (dd * 24);
						var hora = (hh && hh >= 10) ? hh+':' : ((hh<10 && hh>0) ? '0'+hh+':' : '00:');
						var min = (mm && mm >= 10) ? mm+':' : ((mm<10 && mm>0) ? '0'+mm+':' : '00:');
						var seg = (ss && ss >= 10) ? ss : (ss<10 ? '0'+ss : '00');
						var faltam = hora+min+seg;
				
						if (faltam > '00:00:00') {
								document.getElementById('contador8').innerHTML = faltam;       
								setTimeout(atualizaContador8, 1000);  
						} else {
								document.getElementById('contador8').innerHTML = 'Vote!'; 
						}
				}
				atualizaContador8();
		</script>
		<?php
		echo"<div style='background:url(images/hopzone.gif); background-repeat: no-repeat; background-size: 87px 47px; width:87px; height:47px; border:1px solid #999; margin-top:5px; margin-left:5px; float:left;'><div style='width:89px; *width:87px; _width:87px; height:49px; *height:47px; _height:47px; font-size:10px; font-family:Arial; background: rgba(0,0,0,0.7); text-shadow:1px 1px #000; font-weight:bold;'>$language_05<br><font size='3'><span id='contador8'></span></font><br>$language_06</div></div>";
	}else{
		$id8 = '0';
		echo"<div style='width:87px; height:47px; border:1px solid #999; margin-top:5px; margin-left:5px; float:left;'><a href='http://vgw.hopzone.net/site/vote/$row[top_id]/1' target='_blank'><img src='images/hopzone.gif' title='Vote for HopZone.Net' border='0' width='87' height='47' onClick=SetCookie('click_id8','click');></a></div>";
	}
}else{
	$id8 = '1';
}
}


if($row["id"] == '9'){
$link = "http://www.topgs200.com";@$site = fopen($link,"r");
if($site){
	if(isset($_COOKIE["click_id9"])){
	$dia_9 = substr($_COOKIE["click_id9"], 5, 2);
	$ano_9 = substr($_COOKIE["click_id9"], 12, 4);
	$mes_9 = substr($_COOKIE["click_id9"], 8, 3);
	$hor_9 = substr($_COOKIE["click_id9"], 17, 2);
	$min_9 = substr($_COOKIE["click_id9"], 20, 2);
	$seg_9 = substr($_COOKIE["click_id9"], 23, 2);
	if($mes_9 == 'Jan'){ $mes_9 = '01'; }elseif($mes_9 == 'Feb'){ $mes_9 = '02'; }elseif($mes_9 == 'Mar'){ $mes_9 = '03'; }elseif($mes_9 == 'Apr'){ $mes_9 = '04'; }elseif($mes_9 == 'May'){ $mes_9 = '05'; }elseif($mes_9 == 'Jun'){ $mes_9 = '06'; }elseif($mes_9 == 'Jul'){ $mes_9 = '07'; }elseif($mes_9 == 'Aug'){ $mes_9 = '08'; }elseif($mes_9 == 'Sep'){ $mes_9 = '09'; }elseif($mes_9 == 'Oct'){ $mes_9 = '10'; }elseif($mes_9 == 'Nov'){ $mes_9 = '11'; }elseif($mes_9 == 'Dec'){ $mes_9 = '12'; }
	$click_id9 = $ano_9."-".$mes_9."-".$dia_9." ".$hor_9.":".$min_9.":".$seg_9;
	$click_id9 = date("Y-m-d H:i:s",strtotime("$click_id9 + $horas_voto hours"));
		$id9 = '1';
			$data_modificada9 = $click_id9;
			$data_modificada_9 = substr(str_replace(" ", "", $data_modificada9), 0, 10);
			$hora_modificada_9 = substr(str_replace(" ", "", $data_modificada9), 10, 19);
			$data_voto = explode("-", $data_modificada_9);
			$hora_voto = explode(":", $hora_modificada_9);
		?>
		<script language="javascript">
				var YY9 = <?php echo $data_voto[0]; ?>;
				var MM9 = <?php echo $data_voto[1]; ?>;
				var DD9 = <?php echo $data_voto[2]; ?>;
				var HH9 = <?php echo $hora_voto[0]; ?>;
				var MI9 = <?php echo $hora_voto[1]; ?>;
				var SS9 = <?php echo $hora_voto[2]; ?>;
				
				function atualizaContador9() {  
						var hoje = new Date();  
						var futuro = new Date(YY9,MM9-1,DD9,HH9,MI9,SS9);   
						var ss = parseInt((futuro - hoje) / 1000);  
						var mm = parseInt(ss / 60);  
						var hh = parseInt(mm / 60);  
						var dd = parseInt(hh / 24);   
						ss = ss - (mm * 60);  
						mm = mm - (hh * 60);  
						hh = hh - (dd * 24);
						var hora = (hh && hh >= 10) ? hh+':' : ((hh<10 && hh>0) ? '0'+hh+':' : '00:');
						var min = (mm && mm >= 10) ? mm+':' : ((mm<10 && mm>0) ? '0'+mm+':' : '00:');
						var seg = (ss && ss >= 10) ? ss : (ss<10 ? '0'+ss : '00');
						var faltam = hora+min+seg;
				
						if (faltam > '00:00:00') {
								document.getElementById('contador9').innerHTML = faltam;       
								setTimeout(atualizaContador9, 1000);  
						} else {
								document.getElementById('contador9').innerHTML = 'Vote!'; 
						}
				}
				atualizaContador9();
		</script>
		<?php
		echo"<div style='background:url(http://www.topgs200.com/lineage2/images/botaopropaganda.png); background-repeat: no-repeat; background-size: 87px 47px; width:87px; height:47px; border:1px solid #999; margin-top:5px; margin-left:5px; float:left;'><div style='width:89px; *width:87px; _width:87px; height:49px; *height:47px; _height:47px; font-size:10px; font-family:Arial; background: rgba(0,0,0,0.8); text-shadow:1px 1px #000; font-weight:bold;'>$language_05<br><font size='3'><span id='contador9'></span></font><br>$language_06</div></div>";
	}else{
		$id9 = '0';
		echo"<div style='width:87px; height:47px; border:1px solid #999; margin-top:5px; margin-left:5px; float:left;'><a href='http://www.topgs200.com/lineage2/voto.php?id=$row[top_id]' target='_blank'><img src='http://www.topgs200.com/lineage2/images/botaopropaganda.png' title='Vote no L2 Top 200' border='0' width='87' height='47' onClick=SetCookie('click_id9','click');></a></div>";
	}
}else{
	$id9 = '1';
}
}


if($row["id"] == '10'){
$link = "http://www.top100arena.com";@$site = fopen($link,"r");
if($site){
	if(isset($_COOKIE["click_id10"])){
	$dia_10 = substr($_COOKIE["click_id10"], 5, 2);
	$ano_10 = substr($_COOKIE["click_id10"], 12, 4);
	$mes_10 = substr($_COOKIE["click_id10"], 8, 3);
	$hor_10 = substr($_COOKIE["click_id10"], 17, 2);
	$min_10 = substr($_COOKIE["click_id10"], 20, 2);
	$seg_10 = substr($_COOKIE["click_id10"], 23, 2);
	if($mes_10 == 'Jan'){ $mes_10 = '01'; }elseif($mes_10 == 'Feb'){ $mes_10 = '02'; }elseif($mes_10 == 'Mar'){ $mes_10 = '03'; }elseif($mes_10 == 'Apr'){ $mes_10 = '04'; }elseif($mes_10 == 'May'){ $mes_10 = '05'; }elseif($mes_10 == 'Jun'){ $mes_10 = '06'; }elseif($mes_10 == 'Jul'){ $mes_10 = '07'; }elseif($mes_10 == 'Aug'){ $mes_10 = '08'; }elseif($mes_10 == 'Sep'){ $mes_10 = '09'; }elseif($mes_10 == 'Oct'){ $mes_10 = '10'; }elseif($mes_10 == 'Nov'){ $mes_10 = '11'; }elseif($mes_10 == 'Dec'){ $mes_10 = '12'; }
	$click_id10 = $ano_10."-".$mes_10."-".$dia_10." ".$hor_10.":".$min_10.":".$seg_10;
	$click_id10 = date("Y-m-d H:i:s",strtotime("$click_id10 + $horas_voto hours"));
		$id10 = '1';
			$data_modificada10 = $click_id10;
			$data_modificada_10 = substr(str_replace(" ", "", $data_modificada10), 0, 10);
			$hora_modificada_10 = substr(str_replace(" ", "", $data_modificada10), 10, 19);
			$data_voto = explode("-", $data_modificada_10);
			$hora_voto = explode(":", $hora_modificada_10);
		?>
		<script language="javascript">
				var YY10 = <?php echo $data_voto[0]; ?>;
				var MM10 = <?php echo $data_voto[1]; ?>;
				var DD10 = <?php echo $data_voto[2]; ?>;
				var HH10 = <?php echo $hora_voto[0]; ?>;
				var MI10 = <?php echo $hora_voto[1]; ?>;
				var SS10 = <?php echo $hora_voto[2]; ?>;
				
				function atualizaContador10() {  
						var hoje = new Date();  
						var futuro = new Date(YY10,MM10-1,DD10,HH10,MI10,SS10);   
						var ss = parseInt((futuro - hoje) / 1000);  
						var mm = parseInt(ss / 60);  
						var hh = parseInt(mm / 60);  
						var dd = parseInt(hh / 24);   
						ss = ss - (mm * 60);  
						mm = mm - (hh * 60);  
						hh = hh - (dd * 24);
						var hora = (hh && hh >= 10) ? hh+':' : ((hh<10 && hh>0) ? '0'+hh+':' : '00:');
						var min = (mm && mm >= 10) ? mm+':' : ((mm<10 && mm>0) ? '0'+mm+':' : '00:');
						var seg = (ss && ss >= 10) ? ss : (ss<10 ? '0'+ss : '00');
						var faltam = hora+min+seg;
				
						if (faltam > '00:00:00') {
								document.getElementById('contador10').innerHTML = faltam;       
								setTimeout(atualizaContador10, 1000);  
						} else {
								document.getElementById('contador10').innerHTML = 'Vote!'; 
						}
				}
				atualizaContador10();
		</script>
		<?php
		echo"<div style='background:url(images/top100arena.jpg); background-repeat: no-repeat; background-size: 87px 47px; width:87px; height:47px; border:1px solid #999; margin-top:5px; margin-left:5px; float:left;'><div style='width:89px; *width:87px; _width:87px; height:49px; *height:47px; _height:47px; font-size:10px; font-family:Arial; background: rgba(0,0,0,0.8); text-shadow:1px 1px #000; font-weight:bold;'>$language_05<br><font size='3'><span id='contador10'></span></font><br>$language_06</div></div>";
	}else{
		$id10 = '0';
		echo"<div style='width:87px; height:47px; border:1px solid #999; margin-top:5px; margin-left:5px; float:left;'><a href='http://www.top100arena.com/in.asp?id=$row[top_id]' target='_blank'><img src='images/top100arena.jpg' title='Lineage 2 private server' border='0' width='87' height='47' onClick=SetCookie('click_id10','click');></a></div>";
	}
}else{
	$id10 = '1';
}
}


if($row["id"] == '11'){
$site = "http://www.topmmo.com.br";
$link = "http://www.topmmo.com.br";@$site = fopen($link,"r");
if($site){
@header('Content-Type: text/html; charset=utf-8');
$xml5 = @simplexml_load_file("http://topmmo.com.br/api/index.php?site_id=$row[top_id]&ip=$_SERVER[REMOTE_ADDR]");
foreach($xml5->vote as $vote){
$data_modificada11 = date("Y-m-d H:i:s",strtotime("$vote->date + $horas_voto hours"));
}
$data_hoje = date('Y-m-d H:i:s');
$data1 = strtotime($data_modificada11);
$data2 = strtotime($data_hoje);
if($data1 >= $data2){
	$id11 = '1';
	$data_modificada_11 = substr(str_replace(" ", "", $data_modificada11), 0, 10);
	$hora_modificada_11 = substr(str_replace(" ", "", $data_modificada11), 10, 19);
	$data_voto = explode("-", $data_modificada_11);
	$hora_voto = explode(":", $hora_modificada_11);
?>
<script language="javascript">
        var YY11 = <?php echo $data_voto[0]; ?>;
        var MM11 = <?php echo $data_voto[1]; ?>;
        var DD11 = <?php echo $data_voto[2]; ?>;
        var HH11 = <?php echo $hora_voto[0]; ?>;
        var MI11 = <?php echo $hora_voto[1]; ?>;
        var SS11 = <?php echo $hora_voto[2]; ?>;
        
        function atualizaContador11() {  
                var hoje = new Date();  
                var futuro = new Date(YY11,MM11-1,DD11,HH11,MI11,SS11);   
                var ss = parseInt((futuro - hoje) / 1000);  
                var mm = parseInt(ss / 60);  
                var hh = parseInt(mm / 60);  
                var dd = parseInt(hh / 24);   
                ss = ss - (mm * 60);  
                mm = mm - (hh * 60);  
                hh = hh - (dd * 24);
                var hora = (hh && hh >= 10) ? hh+':' : ((hh<10 && hh>0) ? '0'+hh+':' : '00:');
                var min = (mm && mm >= 10) ? mm+':' : ((mm<10 && mm>0) ? '0'+mm+':' : '00:');
                var seg = (ss && ss >= 10) ? ss : (ss<10 ? '0'+ss : '00');
				var faltam = hora+min+seg;
        
                if (faltam > '00:00:00') {
                        document.getElementById('contador11').innerHTML = faltam;       
                        setTimeout(atualizaContador11, 1000);  
                } else {
                        document.getElementById('contador11').innerHTML = 'Vote!'; 
                }
        }
		atualizaContador11();
</script>
<?php
echo"<div style='background:url(http://www.topmmo.com.br/vote.gif); background-repeat: no-repeat; background-size: 87px 47px; width:87px; height:47px; border:1px solid #999; margin-top:5px; margin-left:5px; float:left;'><div style='width:89px; *width:87px; _width:87px; height:49px; *height:47px; _height:47px; font-size:10px; font-family:Arial; background: rgba(0,0,0,0.6); text-shadow:1px 1px #000; font-weight:bold;'>$language_05<br><font size='3'><span id='contador11'></span></font><br>$language_06</div></div>";
}else{
	$id11 = '0';
echo"<div style='width:87px; height:47px; border:1px solid #999; margin-top:5px; margin-left:5px; float:left;'><a href='http://www.topmmo.com.br/votar/$row[top_id]' target='_blank'><img src='http://www.topmmo.com.br/vote.gif' title='Vote on the Lineage 2 Top 200' border='0' width='87' height='47'></a></div>";
}
}else{
	$id11 = '1';
}
}


if($row["id"] == '12'){
$link = "http://www.top200games.com.br";@$site = fopen($link,"r");
if($site){
@header('Content-Type: text/html; charset=utf-8');
$xml12 = @simplexml_load_file("http://top200games.com.br/api/?ip=$_SERVER[REMOTE_ADDR]&username=$row[top_id]");
foreach($xml12->vote as $vote){
$data_modificada12 = date("Y-m-d H:i:s",strtotime("$vote->date + $horas_voto hours"));
}
$data_hoje = date('Y-m-d H:i:s');
$data1 = strtotime($data_modificada12);
$data2 = strtotime($data_hoje);
if($data1 >= $data2){
	$id12 = '1';
	$data_modificada_12 = substr(str_replace(" ", "", $data_modificada12), 0, 10);
	$hora_modificada_12 = substr(str_replace(" ", "", $data_modificada12), 10, 19);
	$data_voto = explode("-", $data_modificada_12);
	$hora_voto = explode(":", $hora_modificada_12);
?>
<script language="javascript">
        var YY12 = <?php echo $data_voto[0]; ?>;
        var MM12 = <?php echo $data_voto[1]; ?>;
        var DD12 = <?php echo $data_voto[2]; ?>;
        var HH12 = <?php echo $hora_voto[0]; ?>;
        var MI12 = <?php echo $hora_voto[1]; ?>;
        var SS12 = <?php echo $hora_voto[2]; ?>;
        
        function atualizaContador12() {  
                var hoje = new Date();  
                var futuro = new Date(YY12,MM12-1,DD12,HH12,MI12,SS12);   
                var ss = parseInt((futuro - hoje) / 1000);  
                var mm = parseInt(ss / 60);  
                var hh = parseInt(mm / 60);  
                var dd = parseInt(hh / 24);   
                ss = ss - (mm * 60);  
                mm = mm - (hh * 60);  
                hh = hh - (dd * 24);
                var hora = (hh && hh >= 10) ? hh+':' : ((hh<10 && hh>0) ? '0'+hh+':' : '00:');
                var min = (mm && mm >= 10) ? mm+':' : ((mm<10 && mm>0) ? '0'+mm+':' : '00:');
                var seg = (ss && ss >= 10) ? ss : (ss<10 ? '0'+ss : '00');
				var faltam = hora+min+seg;
        
                if (faltam > '00:00:00') {
                        document.getElementById('contador12').innerHTML = faltam;       
                        setTimeout(atualizaContador12, 1000);  
                } else {
                        document.getElementById('contador12').innerHTML = 'Vote!'; 
                }
        }
		atualizaContador12();
</script>
<?php
echo"<div style='background:url(http://www.top200games.com.br/skins/New/vote.png); background-repeat: no-repeat; background-size: 87px 47px; width:87px; height:47px; border:1px solid #999; margin-top:5px; margin-left:5px; float:left;'><div style='width:89px; *width:87px; _width:87px; height:49px; *height:47px; _height:47px; font-size:10px; font-family:Arial; background: rgba(0,0,0,0.6); text-shadow:1px 1px #000; font-weight:bold;'>$language_05<br><font size='3'><span id='contador12'></span></font><br>$language_06</div></div>";
}else{
	$id12 = '0';
echo"<div style='width:87px; height:47px; border:1px solid #999; margin-top:5px; margin-left:5px; float:left;'><a href='http://www.top200games.com.br/index.php?a=in&u=$row[top_id]' target='_blank'><img src='http://www.top200games.com.br/skins/New/vote.png' title='Vote on Top200' border='0' width='87' height='47'></a></div>";
}
}else{
	$id12 = '1';
}
}


}
if($id1 == NULL){
	$id1 = '0';
	$data_modificada1 = '0000-00-00 00:00:00';
}
if($id2 == NULL){
	$id2 = '0';
	$data_modificada2 = '0000-00-00 00:00:00';
}
if($id3 == NULL){
	$id3 = '0';
	$data_modificada3 = '0000-00-00 00:00:00';
}
if($id4 == NULL){
	$id4 = '0';
	$data_modificada4 = '0000-00-00 00:00:00';
}
if($id5 == NULL){
	$id5 = '0';
	$data_modificada5 = '0000-00-00 00:00:00';
}
if($id6 == NULL){
	$id6 = '0';
	$data_modificada6 = '0000-00-00 00:00:00';
}
if($id7 == NULL){
	$id7 = '0';
	$data_modificada7 = '0000-00-00 00:00:00';
}
if($id8 == NULL){
	$id8 = '0';
	$data_modificada8 = '0000-00-00 00:00:00';
}
if($id9 == NULL){
	$id9 = '0';
	$data_modificada9 = '0000-00-00 00:00:00';
}
if($id10 == NULL){
	$id10 = '0';
	$data_modificada10 = '0000-00-00 00:00:00';
}
if($id11 == NULL){
	$id11 = '0';
	$data_modificada11 = '0000-00-00 00:00:00';
}
if($id12 == NULL){
	$id12 = '0';
	$data_modificada12 = '0000-00-00 00:00:00';
}
$voto = $id1 + $id2 + $id3 + $id4 + $id5 + $id6 + $id7 + $id8 + $id9 + $id10 + $id11 + $id12;

if($id1 == 1 and $xml1){ $contador1 = 'atualizaContador1();'; }else{ $contador1 = ''; }
if($id2 == 1 and $xml2){ $contador2 = 'atualizaContador2();'; }else{ $contador2 = ''; }
if($id3 == 1 and $pagina){ $contador3 = 'atualizaContador3();'; }else{ $contador3 = ''; }
if($id4 == 1 and $xml4){ $contador4 = 'atualizaContador4();'; }else{ $contador4 = ''; }
if($id5 == 1){ $contador5 = 'atualizaContador5();'; }else{ $contador5 = ''; }
if($id6 == 1){ $contador6 = 'atualizaContador6();'; }else{ $contador6 = ''; }
if($id7 == 1){ $contador7 = 'atualizaContador7();'; }else{ $contador7 = ''; }
if($id8 == 1){ $contador8 = 'atualizaContador8();'; }else{ $contador8 = ''; }
if($id9 == 1){ $contador9 = 'atualizaContador9();'; }else{ $contador9 = ''; }
if($id10 == 1){ $contador10 = 'atualizaContador10();'; }else{ $contador10 = ''; }
if($id11 == 1){ $contador11 = 'atualizaContador11();'; }else{ $contador11 = ''; }
if($id12 == 1){ $contador12 = 'atualizaContador12();'; }else{ $contador12 = ''; }
if($id1 == 1 or $id2 == 1 or $id3 == 1 or $id4 == 1 or $id5 == 1 or $id6 == 1 or $id7 == 1 or $id8 == 1 or $id9 == 1 or $id10 == 1 or $id11 == 1 or $id12 == 1){
echo"<body onload='$contador1$contador2$contador3$contador4$contador5$contador6$contador7$contador8$contador9$contador10$contador11$contador12'></body>";
}
?>
	<script type="text/javascript">
	function trocar(){
	$('button').click(function(){
	$('button').attr('disabled', 'disabled');
	setTimeout(function(){
		$('button').removeAttr('disabled');
	}, 4000);
		$.post('painel/index.php', {verificar: 'verificar'}, function(data){
			$('.formulario').html(data).show();
		});
		$('.verify').fadeIn('slow').delay(5000);
		$('.verify').ajaxStop(function(){
			$('.verify').hide();
		});
	});
	};
	</script>
	<div class='verify' style='text-align:center;'><img src='images/ajax-loader.gif'><br /><?php echo"$language_30"; ?></div>
<?php
if(isset($_POST["verificar"])){
	if(strpos($_SERVER['HTTP_REFERER'],$end)) {
if($voto == mysql_num_rows($tops)){
	$busca_entrega = mysql_query("SELECT * FROM icp_votesystem_votos WHERE ip = '$_SERVER[REMOTE_ADDR]'") or die(mysql_error());
		if(mysql_num_rows($busca_entrega) == '1'){
			while($rows = mysql_fetch_array($busca_entrega)){
				if(strtotime($rows["data_voto_id1"]) == strtotime($data_modificada1) and $rows["data_voto_id1"] != '0000-00-00 00:00:00'){
					$_POST["verificar"] = NULL;
					?>
					<script type="text/javascript">
					$(function(){
						$('.msg').fadeIn('slow').addClass('erro').html('<?php echo"$language_07"; ?>').delay(3000).fadeOut('slow');
					});
					</script>
					<?php
				}elseif(strtotime($rows["data_voto_id2"]) == strtotime($data_modificada2) and $rows["data_voto_id2"] != '0000-00-00 00:00:00'){
					$_POST["verificar"] = NULL;
					?>
					<script type="text/javascript">
					$(function(){
						$('.msg').fadeIn('slow').addClass('erro').html('<?php echo"$language_07"; ?>').delay(3000).fadeOut('slow');
					});
					</script>
					<?php
				}elseif(strtotime($rows["data_voto_id3"]) == strtotime($data_modificada3) and $rows["data_voto_id3"] != '0000-00-00 00:00:00'){
					$_POST["verificar"] = NULL;
					?>
					<script type="text/javascript">
					$(function(){
						$('.msg').fadeIn('slow').addClass('erro').html('<?php echo"$language_07"; ?>').delay(3000).fadeOut('slow');
					});
					</script>
					<?php
				}elseif(strtotime($rows["data_voto_id4"]) == strtotime($data_modificada4) and $rows["data_voto_id4"] != '0000-00-00 00:00:00'){
					$_POST["verificar"] = NULL;
					?>
					<script type="text/javascript">
					$(function(){
						$('.msg').fadeIn('slow').addClass('erro').html('<?php echo"$language_07"; ?>').delay(3000).fadeOut('slow');
					});
					</script>
					<?php
				}elseif(strtotime($rows["data_voto_id11"]) == strtotime($data_modificada11) and $rows["data_voto_id11"] != '0000-00-00 00:00:00'){
					$_POST["verificar"] = NULL;
					?>
					<script type="text/javascript">
					$(function(){
						$('.msg').fadeIn('slow').addClass('erro').html('<?php echo"$language_07"; ?>').delay(3000).fadeOut('slow');
					});
					</script>
					<?php
				}elseif(strtotime($rows["data_voto_id12"]) == strtotime($data_modificada12) and $rows["data_voto_id12"] != '0000-00-00 00:00:00'){
					$_POST["verificar"] = NULL;
					?>
					<script type="text/javascript">
					$(function(){
						$('.msg').fadeIn('slow').addClass('erro').html('<?php echo"$language_07"; ?>').delay(3000).fadeOut('slow');
					});
					</script>
					<?php
				}else{
					$chars = mysql_query("SELECT $col_char_name, $col_char_id FROM $tab_char WHERE $col_char_account = '$_SESSION[UsuarioLogin]' AND $col_char_online = '0' ORDER BY $col_char_name ASC") or die(mysql_error());
					$nr = mysql_num_rows($chars);
					if($nr >= '1'){
						?>
						<script type="text/javascript">
						function receber(){
							$('button').click(function(){
							$('button').attr('disabled', 'disabled');
							setTimeout(function(){
								$('button').removeAttr('disabled');
							}, 4000);
							$.post('painel/index.php', {trocar: 'trocar', char: $('select[id=1]').val()}, function(data){
								$('.formulario').html(data).show();
							});
							$('.entrega').fadeIn('slow').delay(5000);
							$('.entrega').ajaxStop(function(){
								$('.entrega').hide();
							});
							});
						};
						</script>
						<div class='entrega' style='text-align:center;'><img src='images/ajax-loader.gif'><br /><?php echo"$language_31"; ?></div>
						<?php
						echo"<div style='float:left; width:100%; margin-top:10px;'>$language_08";
						echo"<form action='javascript:receber();' method='post'><select name='char' id='1' style='margin-top:10px;'>";
						for ($i=0; $i<$nr; $i++) {
							$r = mysql_fetch_array($chars);
							echo "<OPTION VALUE=\"".$r["$col_char_id"]."\">".$r["$col_char_name"]."</OPTION>";
						}
						echo"</select><br><button style='margin-top: 20px; margin-bottom: 20px;' class='button secondary'>$language_09</button></form></div>";
					}else{
						?>
						<script type="text/javascript">
						$(function(){
							$('.msg').fadeIn('slow').addClass('erro').html('<?php echo"$language_10"; ?>').delay(3000).fadeOut('slow');
						});
						</script>
						<?php
						$_POST["verificar"] = NULL;
					}
				}
			}
		}else{
			$chars = mysql_query("SELECT $col_char_name, $col_char_id FROM $tab_char WHERE $col_char_account = '$_SESSION[UsuarioLogin]' AND $col_char_online = '0' ORDER BY $col_char_name ASC") or die(mysql_error());
			$nr = mysql_num_rows($chars);
			if($nr >= '1'){
				?>
				<script type="text/javascript">
				function receber(){
					$('button').click(function(){
					$('button').attr('disabled', 'disabled');
					setTimeout(function(){
						$('button').removeAttr('disabled');
					}, 4000);
					$.post('painel/index.php', {trocar: 'trocar', char: $('select[id=1]').val()}, function(data){
						$('.formulario').html(data).show();
					});
					$('.entrega').fadeIn('slow').delay(5000);
					$('.entrega').ajaxStop(function(){
						$('.entrega').hide();
					});
					});
				};
				</script>
				<div class='entrega' style='text-align:center;'><img src='images/ajax-loader.gif'><br /><?php echo"$language_31"; ?></div>
				<?php
				echo"<div style='float:left; width:100%; margin-top:10px;'>$language_08";
				echo"<form action='javascript:receber();' method='post'><select name='char' id='1' style='margin-top:10px;'>";
				for ($i=0; $i<$nr; $i++) {
					$r = mysql_fetch_array($chars);
					echo "<OPTION VALUE=\"".$r["$col_char_id"]."\">".$r["$col_char_name"]."</OPTION>";
				}
				echo"</select><br><button style='margin-top: 20px; margin-bottom: 20px;' class='button secondary'>$language_09</button></form></div>";
			}else{
				?>
				<script type="text/javascript">
				$(function(){
					$('.msg').fadeIn('slow').addClass('erro').html('<?php echo"$language_10"; ?>').delay(3000).fadeOut('slow');
				});
				</script>
				<?php
				$_POST["verificar"] = NULL;
			}
		}
}else{
	?>
		<script type="text/javascript">
		$(function(){
			$('.msg').fadeIn('slow').addClass('erro').html('<?php echo"$language_11"; ?>\n<?php echo"$language_12"; ?>').delay(3000).fadeOut('slow');
		});
		</script>
	<?php
	$_POST["verificar"] = NULL;
}
	}
}


if(isset($_POST["trocar"])){
	if(strpos($_SERVER['HTTP_REFERER'],$end)) {
if($voto == mysql_num_rows($tops)){
	$busca_entrega = mysql_query("SELECT * FROM icp_votesystem_votos WHERE ip = '$_SERVER[REMOTE_ADDR]'") or die(mysql_error());
		if(mysql_num_rows($busca_entrega) == '1'){
			while($rows = mysql_fetch_array($busca_entrega)){
				if(strtotime($rows["data_voto_id1"]) == strtotime($data_modificada1) and $rows["data_voto_id1"] != '0000-00-00 00:00:00'){
					?>
					<script type="text/javascript">
					$(function(){
						$('.msg').fadeIn('slow').addClass('erro').html('<?php echo"$language_13"; ?>\n<?php echo"$language_14"; ?>').delay(3000).fadeOut('slow');
					});
					</script>
					<?php
				}elseif(strtotime($rows["data_voto_id2"]) == strtotime($data_modificada2) and $rows["data_voto_id2"] != '0000-00-00 00:00:00'){
					?>
					<script type="text/javascript">
					$(function(){
						$('.msg').fadeIn('slow').addClass('erro').html('<?php echo"$language_13"; ?>\n<?php echo"$language_14"; ?>').delay(3000).fadeOut('slow');
					});
					</script>
					<?php
				}elseif(strtotime($rows["data_voto_id3"]) == strtotime($data_modificada3) and $rows["data_voto_id3"] != '0000-00-00 00:00:00'){
					?>
					<script type="text/javascript">
					$(function(){
						$('.msg').fadeIn('slow').addClass('erro').html('<?php echo"$language_13"; ?>\n<?php echo"$language_14"; ?>').delay(3000).fadeOut('slow');
					});
					</script>
					<?php
				}elseif(strtotime($rows["data_voto_id4"]) == strtotime($data_modificada4) and $rows["data_voto_id4"] != '0000-00-00 00:00:00'){
					?>
					<script type="text/javascript">
					$(function(){
						$('.msg').fadeIn('slow').addClass('erro').html('<?php echo"$language_13"; ?>\n<?php echo"$language_14"; ?>').delay(3000).fadeOut('slow');
					});
					</script>
					<?php
				}elseif(strtotime($rows["data_voto_id11"]) == strtotime($data_modificada11) and $rows["data_voto_id11"] != '0000-00-00 00:00:00'){
					?>
					<script type="text/javascript">
					$(function(){
						$('.msg').fadeIn('slow').addClass('erro').html('<?php echo"$language_13"; ?>\n<?php echo"$language_14"; ?>').delay(3000).fadeOut('slow');
					});
					</script>
					<?php
				}elseif(strtotime($rows["data_voto_id12"]) == strtotime($data_modificada12) and $rows["data_voto_id12"] != '0000-00-00 00:00:00'){
					?>
					<script type="text/javascript">
					$(function(){
						$('.msg').fadeIn('slow').addClass('erro').html('<?php echo"$language_13"; ?>\n<?php echo"$language_14"; ?>').delay(3000).fadeOut('slow');
					});
					</script>
					<?php
				}else{
					$chars = mysql_query("SELECT $col_char_name FROM $tab_char WHERE $col_char_account = '$_SESSION[UsuarioLogin]' AND $col_char_online = '0' AND $col_char_id = '$_POST[char]' ORDER BY $col_char_name ASC") or die(mysql_error());
					if($deposito_loc == '0'){
						$loc = 'WAREHOUSE';
					}elseif($deposito_loc == '1'){
						$loc = 'INVENTORY';
					}else{
						$loc = 'WAREHOUSE';
					}
					if($loc == 'WAREHOUSE'){
						$local = 'warehouse.';
					}elseif($loc == 'INVENTORY'){
						$local = 'inventario.';
					}
					if(mysql_num_rows($chars) == '1'){
						if(count($moeda_voto) == '0' || count($qtd_moeda_voto) == '0'){
						?>
							<script type="text/javascript">
							$(function(){
								$('.msg').fadeIn('slow').addClass('erro').html('<?php echo"$language_69"; ?>').delay(3000).fadeOut('slow');
							});
							</script>
						<?php
						$_POST["verificar"] = NULL;
						}else{
							$moeda_votos = substr($moeda_voto,-1);
							$qtd_moeda_votos = substr($qtd_moeda_voto,-1);
							if($moeda_votos != ','){ $moeda_voto = $moeda_voto.","; }
							if($qtd_moeda_votos != ','){ $qtd_moeda_voto = $qtd_moeda_voto.","; }
							$moeda_voto = explode(',', $moeda_voto);
							$qtd_moeda_voto = explode(',', $qtd_moeda_voto);
							for($x = 0; $x < (count($moeda_voto)-1); $x++) {
								$busca_item = mysql_query("SELECT $col_item_count FROM $tab_items WHERE $col_item_id = '$moeda_voto[$x]' AND $col_item_owner = '$_POST[char]' AND $col_item_loc = '$loc'") or die(mysql_error());
								if(mysql_num_rows($busca_item) == '0'){
									$id_maximo = mysql_query("SELECT MAX($col_item_objid) AS max FROM $tab_items") or die (mysql_error());
									$id_max = mysql_fetch_array($id_maximo);
									$nova_id = '1000' + $id_max['max'];
									$inserindo_item = mysql_query("INSERT INTO $tab_items ($col_item_owner, $col_item_objid, $col_item_id, $col_item_count, $col_item_enchant, $col_item_loc) VALUES ('$_POST[char]', '$nova_id', '$moeda_voto[$x]', '$qtd_moeda_voto[$x]', '0', '$loc')") or die(mysql_error());
								}else{
									while($rrow = mysql_fetch_array($busca_item)){ $qtd_existente = $rrow["$col_item_count"] + $qtd_moeda_voto[$x]; }
									$inserindo_item = mysql_query("UPDATE $tab_items SET $col_item_count = '$qtd_existente' WHERE $col_item_owner = '$_POST[char]' AND $col_item_id = '$moeda_voto[$x]' AND $col_item_loc = '$loc'") or die(mysql_error());
								}
							}
							$v_id = $rows["votos"] + '1';
							$inserindo_voto = mysql_query("UPDATE icp_votesystem_votos SET login = '$_SESSION[UsuarioLogin]', data_voto_id1 = '$data_modificada1', data_voto_id2 = '$data_modificada2', data_voto_id3 = '$data_modificada3', data_voto_id11 = '$data_modificada11', data_voto_id12 = '$data_modificada12', votos = '$v_id' WHERE ip = '$_SERVER[REMOTE_ADDR]'") or die(mysql_error());
							?>
							<script type="text/javascript">
							$(function(){
								$('.msg').fadeIn('slow').addClass('erro').html('<?php echo"$language_15 ".(count($moeda_voto)-1); ?>\n<?php echo"$language_16 $local."; ?>\n<?php echo"$language_17"; ?>').delay(10000).fadeOut('slow');
							});
							</script>
							<?php
						}
					}else{
						?>
							<script type="text/javascript">
							$(function(){
								$('.msg').fadeIn('slow').addClass('erro').html('<?php echo"$language_10"; ?>').delay(3000).fadeOut('slow');
							});
							</script>
						<?php
						$_POST["verificar"] = NULL;
					}
				}
			}
		}else{
			$chars = mysql_query("SELECT $col_char_name FROM $tab_char WHERE $col_char_account = '$_SESSION[UsuarioLogin]' AND $col_char_online = '0' AND $col_char_id = '$_POST[char]' ORDER BY $col_char_name ASC") or die(mysql_error());
			if($deposito_loc == '0'){
				$loc = 'WAREHOUSE';
			}elseif($deposito_loc == '1'){
				$loc = 'INVENTORY';
			}else{
				$loc = 'WAREHOUSE';
			}
			if($loc == 'WAREHOUSE'){
				$local = 'warehouse';
			}elseif($loc == 'INVENTORY'){
				$local = 'inventario';
			}
			if(mysql_num_rows($chars) == '1'){
				if(count($moeda_voto) == '0' || count($qtd_moeda_voto) == '0'){
				?>
					<script type="text/javascript">
					$(function(){
						$('.msg').fadeIn('slow').addClass('erro').html('<?php echo"$language_69"; ?>').delay(3000).fadeOut('slow');
					});
					</script>
				<?php
				$_POST["verificar"] = NULL;
				}else{
					$moeda_votos = substr($moeda_voto,-1);
					$qtd_moeda_votos = substr($qtd_moeda_voto,-1);
					if($moeda_votos != ','){ $moeda_voto = $moeda_voto.","; }
					if($qtd_moeda_votos != ','){ $qtd_moeda_voto = $qtd_moeda_voto.","; }
					$moeda_voto = explode(',', $moeda_voto);
					$qtd_moeda_voto = explode(',', $qtd_moeda_voto);
					for($x = 0; $x < (count($moeda_voto)-1); $x++) {
						$busca_item = mysql_query("SELECT $col_item_count FROM $tab_items WHERE $col_item_id = '$moeda_voto[$x]' AND $col_item_owner = '$_POST[char]' AND $col_item_loc = '$loc'") or die(mysql_error());
						if(mysql_num_rows($busca_item) == '0'){
							$id_maximo = mysql_query("SELECT MAX($col_item_objid) AS max FROM $tab_items") or die (mysql_error());
							$id_max = mysql_fetch_array($id_maximo);
							$nova_id = '1000' + $id_max['max'];
							$inserindo_item = mysql_query("INSERT INTO $tab_items ($col_item_owner, $col_item_objid, $col_item_id, $col_item_count, $col_item_enchant, $col_item_loc) VALUES ('$_POST[char]', '$nova_id', '$moeda_voto[$x]', '$qtd_moeda_voto[$x]', '0', '$loc')") or die(mysql_error());
						}else{
							while($rrow = mysql_fetch_array($busca_item)){ $qtd_existente = $rrow["$col_item_count"] + $qtd_moeda_voto[$x]; }
							$inserindo_item = mysql_query("UPDATE $tab_items SET $col_item_count = '$qtd_existente' WHERE $col_item_owner = '$_POST[char]' AND $col_item_id = '$moeda_voto[$x]' AND $col_item_loc = '$loc'") or die(mysql_error());
						}
					}
					$inserindo_voto = mysql_query("INSERT INTO icp_votesystem_votos (login, ip, data_voto_id1, data_voto_id2, data_voto_id3, data_voto_id4, data_voto_id11, data_voto_id12, votos) VALUES ('$_SESSION[UsuarioLogin]', '$_SERVER[REMOTE_ADDR]', '$data_modificada1', '$data_modificada2', '$data_modificada3', '$data_modificada4', '$data_modificada11', '$data_modificada12', '1')") or die(mysql_error());
					?>
					<script type="text/javascript">
					$(function(){
						$('.msg').fadeIn('slow').addClass('erro').html('<?php echo"$language_15 ".(count($moeda_voto)-1); ?>\n<?php echo"$language_16 $local."; ?>\n<?php echo"$language_17"; ?>').delay(10000).fadeOut('slow');
					});
					</script>
					<?php
				}
			}else{
				?>
				<script type="text/javascript">
				$(function(){
					$('.msg').fadeIn('slow').addClass('erro').html('<?php echo"$language_10"; ?>').delay(3000).fadeOut('slow');
				});
				</script>
				<?php
				$_POST["verificar"] = NULL;
			}
		}
}else{
	?>
		<script type="text/javascript">
		$(function(){
			$('.msg').fadeIn('slow').addClass('erro').html('<?php echo"$language_11"; ?>\n<?php echo"$language_12"; ?>').delay(3000).fadeOut('slow');
		});
		</script>
	<?php
}
	}
}


if(!isset($_POST["verificar"])){
	echo"<div style='width:100%; float:left;'><form action='javascript:trocar();' method='post'><button style='margin-top: 20px; margin-bottom: 20px;' class='button secondary'>$language_18</button></form></div>";
}

}
?>
</div>
<div style="clear:both;"></div>
