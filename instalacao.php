<?php
if(file_exists("config/connect_config.php")){
		session_destroy();
		header("location: index.php");
		exit;
}else{
if(file_exists("config/language.php")){
include('config/language.php');
}

if(isset($_POST["install"])){
	sleep(3);
	$ip = trim(str_replace("http://", "", str_replace("www.", "", $_POST["ip_db"])));
	$conexao = @mysql_connect($ip,$_POST["user_db"],$_POST["pass_db"]);
	$banco = @mysql_select_db($_POST["name_db"], $conexao);
	if(!$conexao){
	?>
		<script type="text/javascript">
		$(function(){
			$('.msg').fadeIn('slow').addClass('erro').html('<?php echo"$language_39"; ?>').delay(8000).fadeOut('slow');
		});
		</script>
	<?php
	}else{
		$pega_cols_acc = mysql_query("SHOW COLUMNS FROM accounts");
		$pega_cols_chars = mysql_query("SHOW COLUMNS FROM characters");
		$pega_cols_items = mysql_query("SHOW COLUMNS FROM items");
		while ($row = mysql_fetch_array($pega_cols_acc)) {
			if($row[0] == 'access_level' and $row[4] == '0'){
				$access_name = 'access_level';
				$access_level = '0';
			}elseif($row[0] == 'accesslevel' and $row[4] == '0'){
				$access_name = 'accesslevel';
				$access_level = '0';
			}elseif($row[0] == 'accessLevel' and $row[4] == '0'){
				$access_name = 'accessLevel';
				$access_level = '0';
			}elseif($row[0] == 'access_level' and $row[4] == NULL){
				$access_name = 'access_level';
				$access_level = '';
			}elseif($row[0] == 'accesslevel' and $row[4] == NULL){
				$access_name = 'accesslevel';
				$access_level = '';
			}elseif($row[0] == 'accessLevel' and $row[4] == NULL){
				$access_name = 'accessLevel';
				$access_level = '';
			}
		}
		while ($row2 = mysql_fetch_array($pega_cols_chars)) {
			if($row2[0] == 'char_id'){
				$char_id = 'char_id';
			}elseif($row2[0] == 'charId'){
				$char_id = 'charId';
			}elseif($row2[0] == 'obj_Id'){
				$char_id = 'obj_Id';
			}
		}
		while ($row3 = mysql_fetch_array($pega_cols_items)) {
			if($row3[0] == 'object_id'){
				$obj_id = 'object_id';
			}elseif($row3[0] == 'char_object_id'){
				$obj_id = 'char_object_id';
			}elseif($row3[0] == 'char_obj_id'){
				$obj_id = 'char_obj_id';
			}
		}
		if($access_level == NULL){
			mysql_query("ALTER TABLE accounts ALTER $access_name SET DEFAULT 0");
		}
		mysql_query("DROP TABLE IF EXISTS icp_votesystem_config") or die(mysql_error());
		mysql_query("DROP TABLE IF EXISTS icp_votesystem_tops") or die(mysql_error());
		mysql_query("DROP TABLE IF EXISTS icp_votesystem_votos") or die(mysql_error());
		mysql_query("CREATE TABLE `icp_votesystem_config` (
					`col_accesslevel` varchar(15) DEFAULT NULL,
					`col_obj_id` varchar(15) DEFAULT NULL,
					`col_object_id` varchar(15) DEFAULT NULL,
					`moeda_voto` varchar(255) DEFAULT NULL,
					`qtd_moeda_voto` varchar(255) DEFAULT NULL,
					`horas_voto` int(3) DEFAULT NULL,
					`deposito` int(1) NOT NULL DEFAULT '0',
					`votos` int(1) NOT NULL DEFAULT '0'
					) ENGINE=MyISAM DEFAULT CHARSET=latin1") or die(mysql_error());
		mysql_query("CREATE TABLE `icp_votesystem_tops` (
					`id` int(11) NOT NULL AUTO_INCREMENT,
					`top_name` varchar(45) NOT NULL DEFAULT 'top_sem_nome',
					`top_id` varchar(100) NOT NULL DEFAULT 'sem_id',
					`disponivel` int(1) NOT NULL DEFAULT '0',
					PRIMARY KEY (`id`)
					) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1") or die(mysql_error());
		mysql_query("CREATE TABLE `icp_votesystem_votos` (
					`id` int(11) NOT NULL AUTO_INCREMENT,
					`login` varchar(45) NOT NULL DEFAULT 'sem_login',
					`ip` varchar(15) NOT NULL DEFAULT 'sem_ip',
					`data_voto_id1` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
					`data_voto_id2` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
					`data_voto_id3` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
					`data_voto_id4` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
					`data_voto_id11` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
					`data_voto_id12` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
					`data_entrega` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
					`votos` int(11) NOT NULL DEFAULT '0',
					PRIMARY KEY (`id`)
					) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=latin1") or die(mysql_error());
		mysql_query("INSERT INTO `icp_votesystem_tops` VALUES ('1', 'TOP SERVERS 200', 'sem_id', '0')") or die(mysql_error());
		mysql_query("INSERT INTO `icp_votesystem_tops` VALUES ('2', 'L2jBrasil', 'sem_id', '0')") or die(mysql_error());
		mysql_query("INSERT INTO `icp_votesystem_tops` VALUES ('3', 'GameSites200', 'sem_id', '0')") or die(mysql_error());
		mysql_query("INSERT INTO `icp_votesystem_tops` VALUES ('4', 'Top Lineage 2', 'sem_id', '0')") or die(mysql_error());
		mysql_query("INSERT INTO `icp_votesystem_tops` VALUES ('5', 'GTOP100', 'sem_id', '0')") or die(mysql_error());
		mysql_query("INSERT INTO `icp_votesystem_tops` VALUES ('6', 'L2 TOP ZONE', 'sem_id', '0')") or die(mysql_error());
		mysql_query("INSERT INTO `icp_votesystem_tops` VALUES ('7', 'MMORPG', 'sem_id', '0')") or die(mysql_error());
		mysql_query("INSERT INTO `icp_votesystem_tops` VALUES ('8', 'HOPZONE', 'sem_id', '0')") or die(mysql_error());
		mysql_query("INSERT INTO `icp_votesystem_tops` VALUES ('9', 'TOPGS200', 'sem_id', '0')") or die(mysql_error());
		mysql_query("INSERT INTO `icp_votesystem_tops` VALUES ('10', 'Top 100 Arena', 'sem_id', '0')") or die(mysql_error());
		mysql_query("INSERT INTO `icp_votesystem_tops` VALUES ('11', 'Top MMO', 'sem_id', '0')") or die(mysql_error());
		mysql_query("INSERT INTO `icp_votesystem_tops` VALUES ('12', 'Top200Games', 'sem_id', '0')") or die(mysql_error());
		
		$site = trim(str_replace("http://", "", str_replace("www.", "", $_POST["site_name"])));
		$deposito = $_POST["deposito"];
		$vtd = $_POST["voto"];
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
		
		mysql_query("INSERT INTO icp_votesystem_config (col_accesslevel, col_obj_id, col_object_id, moeda_voto, qtd_moeda_voto, horas_voto, deposito, votos) VALUES ('$access_name', '$char_id', '$obj_id', '$m1$m2$m3$m4$m5$m6$m7$m8$m9$m10', '$qtd1$qtd2$qtd3$qtd4$qtd5$qtd6$qtd7$qtd8$qtd9$qtd10', '$horas', '$deposito', '$vtd')") or die(mysql_error());
		
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
		$conteudo = str_replace("sitex", "$site", (str_replace("name_dbx", "$_POST[name_db]", (str_replace("pass_dbx", "$_POST[pass_db]", (str_replace("user_dbx", "$_POST[user_db]", (str_replace("ipx", "$ip", (stripslashes($_POST["pagina"])))))))))));
		$html = "<?php\n";
		$html .= "$conteudo";
		$html .= "\n?>";
		$pag_config = fopen("config/connect_config.php", "w");
		fwrite($pag_config, "$html");
		fclose($pag_config);
		?>
			<script type="text/javascript">
			$(function(){
				$('.msg').fadeIn('slow').addClass('erro').html('<?php echo"$language_40"; ?>\n<?php echo"$language_41"; ?>').delay(8000).fadeOut('slow');
				setTimeout("location.href='index.php'",8000);
			});
			</script>
		<?php
	}
}

$style1 = "style='width:90px;'";
$style2 = "style='width:30px;'";
$style3 = "style='width:245px;'";
?>
<script type="text/javascript">
function instalar(){
	$('button').click(function(){
	$('button').attr('disabled', 'disabled');
	setTimeout(function(){
		$('button').removeAttr('disabled');
	}, 4000);
	$.post('instalacao.php', {deposito: $('select[id=1]').val(), ip_db: $('input[id=2]').val(), user_db: $('input[id=3]').val(), pass_db: $('input[id=4]').val(), name_db: $('input[id=5]').val(), site_name: $('input[id=6]').val(), b1: $('input[id=7]').val(), b2: $('input[id=8]').val(), b3: $('input[id=9]').val(), b4: $('input[id=10]').val(), b5: $('input[id=11]').val(), b6: $('input[id=12]').val(), b7: $('input[id=13]').val(), b8: $('input[id=14]').val(), b9: $('input[id=15]').val(), b10: $('input[id=16]').val(), b11: $('input[id=39]').val(), b12: $('input[id=40]').val(), m1: $('input[id=17]').val(), m2: $('input[id=18]').val(), m3: $('input[id=19]').val(), m4: $('input[id=20]').val(), m5: $('input[id=21]').val(), m6: $('input[id=22]').val(), m7: $('input[id=23]').val(), m8: $('input[id=24]').val(), m9: $('input[id=25]').val(), m10: $('input[id=26]').val(), qtd1: $('input[id=27]').val(), qtd2: $('input[id=28]').val(), qtd3: $('input[id=29]').val(), qtd4: $('input[id=30]').val(), qtd5: $('input[id=31]').val(), qtd6: $('input[id=32]').val(), qtd7: $('input[id=33]').val(), qtd8: $('input[id=34]').val(), qtd9: $('input[id=35]').val(), qtd10: $('input[id=36]').val(), horas: $('input[id=37]').val(), install: 'install', pagina: "##########################################\n#				 Créditos:				 #\n#	Este sistema foi desenvolvido por:	 #\n#		 Ivan Pires (ICPNetworks)		 #\n#		    E estilizado por:			 #\n#		Hugo Felipe (ICPNetworks)		 #\n#	E-mail: contato@icpnetworks.com.br	 #\n#	Site: http://www.icpnetworks.com.br	 #\n##########################################\n if(file_exists('block.php')){\n include('block.php');\n}\n$conexao = mysql_connect('ipx','user_dbx','pass_dbx') or die (mysql_error());\n$banco = mysql_select_db('name_dbx', $conexao) or die(mysql_error());\n$end = 'sitex';		 # Endereço ou IP do seu site sem o 'http://www.', escreva assim: 'seusite.com.br' ou '200.145.221.89'\n$tab_acc = 'accounts';				 # Nome da tabela onde ficam os dados das contas do seu servidor. (padrão = 'accounts')\n$tab_char = 'characters';			 # Nome da tabela onde ficam os dados dos Chars do seu servidor. (padrão = 'characters')\n$tab_items = 'items';				 # Nome da tabela onde ficam os itens dos Chars do seu servidor. (padrão = 'items')\n$col_acc_login = 'login';			 # Nome da coluna 'login' dentro da sua tabela accounts.\n$col_acc_pass = 'password';			 # Nome da coluna 'password' dentro da sua tabela accounts.\n$col_char_name = 'char_name';		 # Nome da coluna 'char_name' dentro da sua tabela characters.\n$col_char_account = 'account_name';	 # Nome da coluna 'account_name' dentro da sua tabela characters.\n$col_char_online = 'online';		 # Nome da coluna 'online' dentro da sua tabela characters.\n$col_item_id = 'item_id';			 # Nome da coluna 'item_id' dentro da sua tabela items.\n$col_item_count = 'count';			 # Nome da coluna 'count' dentro da sua tabela items.\n$col_item_owner = 'owner_id';		 # Nome da coluna 'owner_id' dentro da sua tabela items.\n$col_item_loc = 'loc';				 # Nome da coluna 'loc' dentro da sua tabela items.\n$col_item_enchant = 'enchant_level'; # Nome da coluna 'enchant_level' dentro da sua tabela items.\n$configuracoes = mysql_query('SELECT * FROM icp_votesystem_config') or die(mysql_error());\n while($config = mysql_fetch_array($configuracoes)){\n$col_acc_access = $config['col_accesslevel'];	 # Nome da coluna 'accessLevel' dentro da sua tabela accounts.\n$col_char_id = $config['col_obj_id'];		 # Nome da coluna ID do char dentro da sua tabela characters. (Ex: obj_Id, charId, char_Id, etc.)\n$col_item_objid = $config['col_object_id'];			# Nome da coluna 'object_id' dentro da sua tabela items.\n$moeda_voto = $config['moeda_voto'];				# Defina o ID da moeda de voto do seu servidor.\n$qtd_moeda_voto = $config['qtd_moeda_voto'];	# Defina quantas moedas de voto o player vai ganhar por cada vez em que votar no servidor.\n$horas_voto = $config['horas_voto'];			# Defina de quantas em quantas horas o player pode votar no servidor. (Padrão = '12')\n$deposito_loc = $config['deposito'];	# Defina o local onde vai ser depositado o premio do char, coloque '0' para WAREHOUSE ou '1' para INVENTARIO.\n$mostra_votos = $config['votos'];		# Define se mostra ou não o total de votos do servidor.\n}",voto: $('select[id=38]').val()}, function(data){
		$('.formulario').html(data).show();
	});
	$('.entrega').fadeIn('slow').delay(5000);
	$('.entrega').ajaxStop(function(){
		$('.entrega').hide();
	});
	});
};
</script>
<div style="text-align:left; border-bottom:1px solid #666; padding-left:5px; float:left; margin-top:-67px; width:572px; color:#FFF; line-height:30px; background-image:url(images/bg_votesystem.gif);">
<?php echo"$language_44"; ?>
</div>
<div align="left" style="padding-left:25px; background-image:url(images/bg_votesystem.gif);">
<form action="javascript:instalar();" method="post">
<div style="float:left; width:100%; height:80px; line-height:80px; text-align:center; font-weight:bold; margin-top:-35px; background-image:url(images/bg_votesystem.gif); margin-left:-25px; padding-left:25px;"><?php echo"$language_56"; ?></div>
<div id="inst_1"><?php echo"$language_45"; ?></div><div id="inst_2"><input type='text' id='2' <?php echo"$style3"; if(isset($_POST["ip_db"])){ echo" value='$_POST[ip_db]'"; } ?>></div>
<div id="inst_1"><?php echo"$language_46"; ?></div><div id="inst_2"><input type='text' id='3' <?php echo"$style3"; if(isset($_POST["user_db"])){ echo" value='$_POST[user_db]'"; } ?>></div>
<div id="inst_1"><?php echo"$language_47"; ?></div><div id="inst_2"><input type='password' id='4' <?php echo"$style3"; if(isset($_POST["pass_db"])){ echo" value='$_POST[pass_db]'"; } ?>></div>
<div id="inst_1"><?php echo"$language_48"; ?></div><div id="inst_2"><input type='text' id='5' <?php echo"$style3"; if(isset($_POST["name_db"])){ echo" value='$_POST[name_db]'"; } ?>></div>

<div id="inst_1"><?php echo"$language_49"; ?> </div><div id="inst_2"><input type='text' id='6'<?php echo " value='".str_replace("http://", "", str_replace("www.", "", $_SERVER["SERVER_NAME"]))."'"; ?>" <?php echo"$style3"; ?>></div>

<div style="float:left; width:100%; height:80px; line-height:80px; text-align:center; font-weight:bold;"><?php echo"$language_50"; ?></div>

<div style="float:left; width:130px; height:120px; text-align:center;">
<a href="http://www.topservers200.com" target="_blank" title="<?php echo"$language_37"; ?>">TopServers200<br>
<img src="images/topservers200.png" width="87" height="47" border="0"></a><br>
<input type='text' id='7' <?php echo"$style1"; if(isset($_POST["b1"])){ echo" value='$_POST[b1]'"; } ?>>
</div>
<div style="float:left; width:130px; height:120px; text-align:center;">
<a href="http://top.l2jbrasil.com" target="_blank" title="<?php echo"$language_37"; ?>">L2jBrasil<br>
<img src="images/l2jbrasil.png" width="87" height="47" border="0"></a><br>
<input type='text' id='8' <?php echo"$style1"; if(isset($_POST["b2"])){ echo" value='$_POST[b2]'"; } ?>>
</div>
<div style="float:left; width:130px; height:120px; text-align:center;">
<a href="http://www.gamesites200.com" target="_blank" title="<?php echo"$language_37"; ?>">GameSites200<br>
<img src="http://www.gamesites200.com/lineage2/vote.gif" width="87" height="47" border="0"></a><br>
<input type='text' id='9' <?php echo"$style1"; if(isset($_POST["b3"])){ echo" value='$_POST[b3]'"; } ?>>
</div>
<div style="float:left; width:130px; height:120px; text-align:center;">
<a href="http://www.toplineage2.com" target="_blank" title="<?php echo"$language_37"; ?>">Top Lineage 2<br>
<img src="http://www.toplineage2.com/images/toplineage2_2.png" width="87" height="47" border="0"></a><br>
<input type='text' id='10' <?php echo"$style1"; if(isset($_POST["b4"])){ echo" value='$_POST[b4]'"; } ?>>
</div>
<div style="float:left; width:130px; height:120px; text-align:center;">
<a href="http://www.gtop100.com" target="_blank" title="<?php echo"$language_37"; ?>">GTop100<br>
<img src="http://www.gtop100.com/images/votebutton.jpg" width="87" height="47" border="0"></a><br>
<input type='text' id='11' <?php echo"$style1"; if(isset($_POST["b5"])){ echo" value='$_POST[b5]'"; } ?>>
</div>
<div style="float:left; width:130px; height:120px; text-align:center;">
<a href="http://www.l2topzone.com" target="_blank" title="<?php echo"$language_37"; ?>">TopZone<br>
<img src="http://image.l2topzone.com/l2topzone.com.jpg" width="87" height="47" border="0"></a><br>
<input type='text' id='12' <?php echo"$style1"; if(isset($_POST["b6"])){ echo" value='$_POST[b6]'"; } ?>>
</div>
<div style="float:left; width:130px; height:120px; text-align:center;">
<a href="http://www.mmorpgtoplist.com" target="_blank" title="<?php echo"$language_37"; ?>">MMORPG<br>
<img src="http://www.mmorpgtoplist.com/vote.jpg" width="87" height="47" border="0"></a><br>
<input type='text' id='13' <?php echo"$style1"; if(isset($_POST["b7"])){ echo" value='$_POST[b7]'"; } ?>>
</div>
<div style="float:left; width:130px; height:120px; text-align:center;">
<a href="http://l2.hopzone.net" target="_blank" title="<?php echo"$language_37"; ?>">HopZone<br>
<img src="images/hopzone.gif" width="87" height="47" border="0"></a><br>
<input type='text' id='14' <?php echo"$style1"; if(isset($_POST["b8"])){ echo" value='$_POST[b8]'"; } ?>>
</div>
<div style="float:left; width:130px; height:120px; text-align:center;">
<a href="http://www.topgs200.com" target="_blank" title="<?php echo"$language_37"; ?>">Topgs200<br>
<img src="http://www.topgs200.com/lineage2/images/botaopropaganda.png" width="87" height="47" border="0"></a><br>
<input type='text' id='15' <?php echo"$style1"; if(isset($_POST["b9"])){ echo" value='$_POST[b9]'"; } ?>>
</div>
<div style="float:left; width:130px; height:120px; text-align:center;">
<a href="http://www.top100arena.com" target="_blank" title="<?php echo"$language_37"; ?>">Top100arena<br>
<img src="images/top100arena.jpg" width="87" height="47" border="0"></a><br>
<input type='text' id='16' <?php echo"$style1"; if(isset($_POST["b10"])){ echo" value='$_POST[b10]'"; } ?>>
</div>
<div style="float:left; width:130px; height:120px; text-align:center;">
<a href="http://www.topmmo.com.br" target="_blank" title="<?php echo"$language_37"; ?>">Top MMO<br>
<img src="http://www.topmmo.com.br/vote.gif" width="87" height="47" border="0"></a><br>
<input type='text' id='39' <?php echo"$style1"; if(isset($_POST["b11"])){ echo" value='$_POST[b11]'"; } ?>>
</div>
<div style="float:left; width:130px; height:120px; text-align:center;">
<a href="http://www.top200games.com.br" target="_blank" title="<?php echo"$language_37"; ?>">Top200Games<br>
<img src="http://www.top200games.com.br/skins/New/vote.png" width="87" height="47" border="0"></a><br>
<input type='text' id='40' <?php echo"$style1"; if(isset($_POST["b12"])){ echo" value='$_POST[b12]'"; } ?>>
</div>

<div style="float:left; width:100%; height:80px; line-height:80px; text-align:center; font-weight:bold;"><?php echo"$language_51"; ?></div>

<div id="inst_1"><?php echo"$language_52"; ?> 01: <input type='text' id='17' name="m1" <?php echo"$style1"; if(isset($_POST["m1"])){ echo" value='$_POST[m1]'"; } ?>> <?php echo"$language_55"; ?> <input type='text' id='27' <?php echo"$style2"; if(isset($_POST["qtd1"])){ echo" value='$_POST[qtd1]'"; } ?>></div>
<div id="inst_1"><?php echo"$language_52"; ?> 06: <input type='text' id='22' name="m6" <?php echo"$style1"; if(isset($_POST["m6"])){ echo" value='$_POST[m6]'"; } ?>> <?php echo"$language_55"; ?> <input type='text' id='32' <?php echo"$style2"; if(isset($_POST["qtd6"])){ echo" value='$_POST[qtd6]'"; } ?>></div>
<div id="inst_1"><?php echo"$language_52"; ?> 02: <input type='text' id='18' name="m2" <?php echo"$style1"; if(isset($_POST["m2"])){ echo" value='$_POST[m2]'"; } ?>> <?php echo"$language_55"; ?> <input type='text' id='28' <?php echo"$style2"; if(isset($_POST["qtd2"])){ echo" value='$_POST[qtd2]'"; } ?>></div>
<div id="inst_1"><?php echo"$language_52"; ?> 07: <input type='text' id='23' name="m7" <?php echo"$style1"; if(isset($_POST["m7"])){ echo" value='$_POST[m7]'"; } ?>> <?php echo"$language_55"; ?> <input type='text' id='33' <?php echo"$style2"; if(isset($_POST["qtd7"])){ echo" value='$_POST[qtd7]'"; } ?>></div>
<div id="inst_1"><?php echo"$language_52"; ?> 03: <input type='text' id='19' name="m3" <?php echo"$style1"; if(isset($_POST["m3"])){ echo" value='$_POST[m3]'"; } ?>> <?php echo"$language_55"; ?> <input type='text' id='29' <?php echo"$style2"; if(isset($_POST["qtd3"])){ echo" value='$_POST[qtd3]'"; } ?>></div>
<div id="inst_2"><?php echo"$language_52"; ?> 08: <input type='text' id='24' name="m8" <?php echo"$style1"; if(isset($_POST["m8"])){ echo" value='$_POST[m8]'"; } ?>> <?php echo"$language_55"; ?> <input type='text' id='34' <?php echo"$style2"; if(isset($_POST["qtd8"])){ echo" value='$_POST[qtd8]'"; } ?>></div>
<div id="inst_2"><?php echo"$language_52"; ?> 04: <input type='text' id='20' name="m4" <?php echo"$style1"; if(isset($_POST["m4"])){ echo" value='$_POST[m4]'"; } ?>> <?php echo"$language_55"; ?> <input type='text' id='30' <?php echo"$style2"; if(isset($_POST["qtd4"])){ echo" value='$_POST[qtd4]'"; } ?>></div>
<div id="inst_2"><?php echo"$language_52"; ?> 09: <input type='text' id='25' name="m9" <?php echo"$style1"; if(isset($_POST["m9"])){ echo" value='$_POST[m9]'"; } ?>> <?php echo"$language_55"; ?> <input type='text' id='35' <?php echo"$style2"; if(isset($_POST["qtd9"])){ echo" value='$_POST[qtd9]'"; } ?>></div>
<div id="inst_2"><?php echo"$language_52"; ?> 05: <input type='text' id='21' name="m5" <?php echo"$style1"; if(isset($_POST["m5"])){ echo" value='$_POST[m5]'"; } ?>> <?php echo"$language_55"; ?> <input type='text' id='31' <?php echo"$style2"; if(isset($_POST["qtd5"])){ echo" value='$_POST[qtd5]'"; } ?>></div>
<div id="inst_2"><?php echo"$language_52"; ?> 10: <input type='text' id='26' name="m10" <?php echo"$style1"; if(isset($_POST["m10"])){ echo" value='$_POST[m10]'"; } ?>> <?php echo"$language_55"; ?> <input type='text' id='36' <?php echo"$style2"; if(isset($_POST["qtd10"])){ echo" value='$_POST[qtd10]'"; } ?>></div>

<div id="inst_1"><?php echo"$language_53"; ?></div><div id="inst_2"><select name="deposito" id='1'><?php if($_POST["deposito"] == '0'){ ?><option value="0">Warehouse</option><option value="1">Inventário</option><?php }elseif($_POST["deposito"] == '1'){ ?><option value="1">Inventário</option><option value="0">Warehouse</option><?php }else{ ?><option value="0">Warehouse</option><option value="1">Inventário</option><?php } ?></select></div>

<div id="inst_1"><?php echo"$language_66"; ?></div><div id="inst_2"><select name="voto" id='38'><?php if($_POST["voto"] == '0'){ ?><option value="0"><?php echo"$language_68"; ?></option><option value="1"><?php echo"$language_67"; ?></option><?php }elseif($_POST["voto"] == '1'){ ?><option value="1"><?php echo"$language_67"; ?></option><option value="0"><?php echo"$language_68"; ?></option><?php }else{ ?><option value="1"><?php echo"$language_67"; ?></option><option value="0"><?php echo"$language_68"; ?></option><?php } ?></select></div>

<div id="inst_1"><?php echo"$language_54"; ?></div><div id="inst_2"><input type='text' id='37' value="12" <?php echo"$style3"; if(isset($_POST["horas"])){ echo" value='$_POST[horas]'"; } ?>></div>

<div class='entrega' style='text-align:center;'><img src='images/ajax-loader.gif'><br /><?php echo"$language_38"; ?></div>

<div style="float:left; width:100%; height:80px; line-height:80px; text-align:center;">
<button style='margin-top: 20px; margin-bottom: 20px;' class='button secondary'><?php echo"$language_36"; ?></button>
</div>

</form>
<div style="clear:both;"></div>
</div>
<?php
}
?>