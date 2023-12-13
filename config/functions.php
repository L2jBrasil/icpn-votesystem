<?php
//=======================================================================\\
//  ## ####### #######                                                   \\
//  ## ##      ##   ##                                                   \\
//  ## ##      ## ####  |\  | |¯¯¯ ¯¯|¯¯ \      / |¯¯¯| |¯¯¯| | / |¯¯¯|  \\
//  ## ##      ##       | \ | |--    |    \    /  | | | | |_| |<   ¯\_   \\
//  ## ####### ##       |  \| |___   |     \/\/   |___| | |\  | \ |___|  \\
// --------------------------------------------------------------------- \\
//       Brazillian Developer / WebSite: http://www.icpfree.com.br       \\
//                 Email & Skype: ivan1507@gmail.com.br                  \\
//=======================================================================\\
$db = strtolower($db_data) == "l2j" ? true : false;

function resposta($msg){
	echo "<script type=\"text/javascript\">$('.msg').fadeIn('slow').html('".$msg."').delay(3000).fadeOut('slow');</script>";
}

function respostaDelay($msg,$delay){
	echo "<script type=\"text/javascript\">$('.msg').fadeIn('slow').html('".$msg."').delay(".$delay.").fadeOut('slow');</script>";
}

function redireciona($pag,$delay=0){
	echo "<script type=\"text/javascript\">setTimeout(function(){ $('.formulario').fadeIn('slow').load('".$pag."'); }, ".$delay.");</script>";
}

function info_table($tabela,$coluna){
	global $db;
	global $conn;
	$tabela = strtolower($tabela);
	$coluna = strtolower($coluna);
	if($db){
		$stmt = $conn->prepare('SHOW COLUMNS FROM '.$tabela);
		if($stmt->execute()){
			if($coluna == "accesslevel"){
				while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
					if(preg_match("/^access/i", $row["Field"]))
						return $row["Field"];
				}
			}
			if($coluna == "charid"){
				if($tabela == "characters" || $tabela == "items"){
					while($row = $stmt->fetch(\PDO::FETCH_ASSOC))
						if ($row["Key"] == "PRI")
							return $row["Field"];
				}else{
					$row = $stmt->fetch(\PDO::FETCH_ASSOC);
					return $row["Field"];
				}
			}
		}
	}else{
		// L2 OFF SCRIPTS
	}
	return null;
}

function get_client_ip() {
    $v4mapped_prefix_hex = '00000000000000000000ffff';
    $v4mapped_prefix_bin = hex2bin($v4mapped_prefix_hex);
    $ipaddress = '';

    // Check various HTTP headers to get the client's IP address
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';

    // Check if the IP address is an IPv6 address
    if (filter_var($ipaddress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
        // Additional handling for IPv6 if needed
    } else {
        // Check if the IP address is in a private range indicating CGNAT
        $private_ranges = array(
            array('10.0.0.0', '10.255.255.255'),
            array('172.16.0.0', '172.31.255.255'),
            array('192.168.0.0', '192.168.255.255')
        );

        $ip_decimal = ip2long($ipaddress);

        foreach ($private_ranges as $range) {
            $start = ip2long($range[0]);
            $end = ip2long($range[1]);
            if ($ip_decimal >= $start && $ip_decimal <= $end) {
                // IP is in a private range, indicating CGNAT
                echo "CGNAT Address";
                break;
         }
    }
}

function acessoSimples($url, &$info = null, $get= array() , $post=array(), $timeout = 10) {
	$ch = curl_init();
	curl_setopt_array($ch, array(
		CURLOPT_CONNECTTIMEOUT => $timeout ,
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_URL => $url,
		CURLOPT_USERAGENT => $_SERVER['HTTP_USER_AGENT'] . " ICPNetwork Votesystem Legacy 2.6"
	));
	$response = curl_exec($ch);
	// Then, after your curl_exec call:
	$header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
	$header = substr($response, 0, $header_size);
	$body = substr($response, $header_size);
	$info = curl_getinfo($ch);
	curl_close($ch);
	return $response;
}

function instalar($db_ip, $db_user, $db_pass, $db_name, $db_data, $l2jruss, $admins){
	global $conn;
	global $language_40;
	global $language_41;
	global $language_72;
	$db = strtolower($db_data) == "l2j" ? true : false;
	$adms = null;
	$insert_tops = array(
		array(1, 'L2jBrasil', 'https://top.l2jbrasil.com', 'l2jbrasil.png', 'l2jbrasil.php', 'sem_id', 'sem_token', 0, 0),
		array(2, 'Private Server', 'https://www.private-server.ws', 'private_server_ws.jpg', 'privateserverws.php', 'sem_id', 'sem_token', 0, 0),
		array(3, 'Gaming Top 100', 'http://www.gamingtop100.net', 'gamingtop100.gif', 'gamingtop100.php', 'sem_id', 'sem_token', 0, 0),
		array(4, 'Games Top 200', 'https://www.gamestop200.com', 'gamestop200.jpg', 'gamestop200.php', 'sem_id', 'sem_token', 0, 0),
		array(5, 'GTOP100', 'http://www.gtop100.com', 'gtop100.jpg', 'gtop100.php', 'sem_id', 'sem_token', 0, 0),
		array(6, 'L2 TOP ZONE', 'https://www.l2topzone.com', 'l2topzone.png', 'l2topzone.php', 'sem_id', 'sem_token', 1, 0),
		array(7, 'HOP ZONE', 'https://www.hopzone.net', 'hopzone.gif', 'hopzone.php', 'sem_id', 'sem_token', 1, 0),
		array(8, 'Xtreme Top 300', 'https://xtremetop300.com', 'xtremetop300.jpg', 'xtremetop300.php', 'sem_id', 'sem_token', 1, 0),
		array(9, 'TOPGS200', 'http://www.topgs200.com', 'topgs200.jpg', 'topgs200.php', 'sem_id', 'sem_token', 0, 0),
		array(10, 'Top 100 Arena', 'http://www.top100arena.com', 'top100arena.jpg', 'top100arena.php', 'sem_id', 'sem_token', 0, 0),
		array(11, 'L2 Network', 'http://www.l2network.eu', 'l2network.png', 'l2network.php', 'sem_id', 'sem_token', 0, 0),
		array(12, 'L2Top.co', 'https://l2top.co', 'l2top.co.png', 'l2top.co.php', 'sem_id', 'sem_token', 0, 0),
		array(13, 'TopG', 'https://topg.org', 'topg.gif', 'topg.php', 'sem_id', 'sem_token', 0, 0),
		array(14, 'GameBytes', 'https://www.gamebytes.net', 'gamebytes.png', 'gamebytes.php', 'sem_id', 'sem_token', 0, 0),
		array(15, 'L2 Servers', 'https://www.l2servers.com', 'l2servers.png', 'l2servers.php', 'sem_id', 'sem_token', 0, 0),
		array(16, 'L2 Votes', 'https://www.l2votes.com', 'l2votes.jpg', 'l2votes.php', 'sem_id', 'sem_token', 0, 0)
		array(17, '4TOP Servers', 'https://top.4teambr.com', '4topmmo.png', '4topmmo.php', 'sem_id', 'sem_token', 0, 0),
	);
	if(empty($admins))
		return respostaDelay($language_72,4000);
	$admins = explode(",", $admins);
	for($x=0;$x < (count($admins)+1);$x++){
		$adms .= $admins[$x];
		if(!empty($admins[$x]))
			$adms .= ",";
	}
	if($db){
		$default_zero = $conn->prepare("ALTER TABLE accounts ALTER ".info_table("accounts","accesslevel")." SET DEFAULT 0");
		$default_zero->execute();
		$drop_config = $conn->prepare("DROP TABLE IF EXISTS icp_votesystem_config");
		$drop_config->execute();
		$drop_tops = $conn->prepare("DROP TABLE IF EXISTS icp_votesystem_tops");
		$drop_tops->execute();
		$drop_votos = $conn->prepare("DROP TABLE IF EXISTS icp_votesystem_votos");
		$drop_votos->execute();
		$create_config = $conn->prepare("CREATE TABLE `icp_votesystem_config` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`admins` varchar(255) DEFAULT NULL,
			`moeda_voto` varchar(255) DEFAULT NULL,
			`qtd_moeda_voto` varchar(255) DEFAULT NULL,
			`deposito` int(1) NOT NULL DEFAULT '0',
			`votos` int(1) NOT NULL DEFAULT '0',
			PRIMARY KEY (`id`)
		) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1");
		$create_config->execute();
		$create_tops = $conn->prepare("CREATE TABLE `icp_votesystem_tops` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`top_name` varchar(255) NOT NULL DEFAULT 'top_sem_nome',
			`top_url` varchar(255) NOT NULL DEFAULT 'top_link',
			`top_img` varchar(255) NOT NULL DEFAULT 'top_btn',
			`top_btn` varchar(255) NOT NULL DEFAULT 'top_btn',
			`top_id` varchar(255) NOT NULL DEFAULT 'sem_id',
			`top_token` varchar(255) NOT NULL DEFAULT 'sem_token',
			`use_token` int(1) NOT NULL DEFAULT '0',
			`disponivel` int(1) NOT NULL DEFAULT '0',
			PRIMARY KEY (`id`)
		) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1");
		$create_tops->execute();
		$create_votos = $conn->prepare("CREATE TABLE `icp_votesystem_votos` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`login` varchar(45) NOT NULL DEFAULT 'sem_login',
			`ip` varchar(20) NOT NULL DEFAULT 'sem_ip',
			`data_entrega` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
			`votos` int(11) NOT NULL DEFAULT '0',
			PRIMARY KEY (`id`)
		) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1");
		$create_votos->execute();
		$insert_admins = $conn->prepare("INSERT INTO `icp_votesystem_config` (admins, moeda_voto, qtd_moeda_voto) VALUES ('".$adms."', '', '')");
		$insert_admins->execute();
		for($x=0;$x<=(count($insert_tops)-1);$x++){
			$insert_sites = $conn->prepare("INSERT INTO `icp_votesystem_tops` VALUES ('".$insert_tops[$x][0]."', '".$insert_tops[$x][1]."', '".$insert_tops[$x][2]."', '".$insert_tops[$x][3]."', '".$insert_tops[$x][4]."', '".$insert_tops[$x][5]."', '".$insert_tops[$x][6]."', '".$insert_tops[$x][7]."', '".$insert_tops[$x][8]."')");
			$insert_sites->execute();
		}
	}else{
		$drop_config = $conn->prepare("DROP TABLE icp_votesystem_config");
		$drop_config->execute();
		$drop_tops = $conn->prepare("DROP TABLE icp_votesystem_tops");
		$drop_tops->execute();
		$drop_votos = $conn->prepare("DROP TABLE icp_votesystem_votos");
		$drop_votos->execute();
		$create_config = $conn->prepare("CREATE TABLE icp_votesystem_config (
			[id] INT NOT NULL IDENTITY(1,1) PRIMARY KEY,
			[admins] varchar(255) COLLATE Latin1_General_CI_AI  NOT NULL,
			[moeda_voto] varchar(255) COLLATE Latin1_General_CI_AI NOT NULL,
			[qtd_moeda_voto] varchar(255) COLLATE Latin1_General_CI_AI NOT NULL,
			[deposito] int DEFAULT ((0)) NOT NULL,
			[votos] int DEFAULT ((0)) NOT NULL
		)");
		$create_config->execute();
		$create_tops = $conn->prepare("CREATE TABLE icp_votesystem_tops (
			[id] INT NOT NULL IDENTITY(1,1) PRIMARY KEY,
			[top_name] varchar(255) COLLATE Latin1_General_CI_AI NOT NULL DEFAULT 'top_sem_nome',
			[top_url] varchar(255) COLLATE Latin1_General_CI_AI NOT NULL DEFAULT 'top_link',
			[top_img] varchar(255) COLLATE Latin1_General_CI_AI NOT NULL DEFAULT 'top_btn',
			[top_btn] varchar(255) COLLATE Latin1_General_CI_AI NOT NULL DEFAULT 'top_btn',
			[top_id] varchar(255) COLLATE Latin1_General_CI_AI NOT NULL DEFAULT 'sem_id',
			[top_token] varchar(255) COLLATE Latin1_General_CI_AI NOT NULL DEFAULT 'sem_token',
			[use_token] INT DEFAULT ((0)) NOT NULL,
			[disponivel] INT DEFAULT ((0)) NOT NULL
		)");
		$create_tops->execute();
		$create_votos = $conn->prepare("CREATE TABLE icp_votesystem_votos (
			[id] INT NOT NULL IDENTITY(1,1) PRIMARY KEY,
			[login] varchar(45) COLLATE Latin1_General_CI_AI  NOT NULL DEFAULT 'sem_login',
			[ip] varchar(20) COLLATE Latin1_General_CI_AI  NOT NULL DEFAULT 'sem_ip',
			[data_entrega] DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
			[votos] INT DEFAULT ((0)) NOT NULL
		)");
		$create_votos->execute();
		$insert_admins = $conn->prepare("INSERT INTO icp_votesystem_config VALUES ('".$adms."', '', '', '', '')");
		$insert_admins->execute();
		for($x=0;$x<=(count($insert_tops)-1);$x++){
			$insert_sites = $conn->prepare("INSERT INTO icp_votesystem_tops VALUES ('".$insert_tops[$x][1]."', '".$insert_tops[$x][2]."', '".$insert_tops[$x][3]."', '".$insert_tops[$x][4]."', '".$insert_tops[$x][5]."', '".$insert_tops[$x][6]."', '".$insert_tops[$x][7]."', '".$insert_tops[$x][8]."')");
			$insert_sites->execute();
		}
	}
	$conteudo = str_replace("l2jruss", $l2jruss, str_replace("db_type", $db_data, str_replace("name_dbx", $db_name, (str_replace("pass_dbx", $db_pass, (str_replace("user_dbx", $db_user, (str_replace("ipx", $db_ip, (stripslashes($_POST["pagina"])))))))))));
	$html = "<?php\n";
	$html .= $conteudo;
	$html .= "\n?>";
	$pag_config = fopen("config/connect_config.php", "w");
	fwrite($pag_config, $html);
	fclose($pag_config);
	return respostaDelay($language_40."<br>".$language_41,8000).redireciona("links.php?icp=home",8000);
}

function logar($login,$senha){
	global $db;
	global $conn;
	global $admins;
	global $language_24;
	global $language_25;
	global $language_26;
	global $language_27;
	global $L2jVersaoRussa;
	$accesslevel = 0;
	$adms = explode(",", $admins);
	$username = trim($login);
	$password = trim($senha);
	$errMsg = null;
	$errMsg .= empty($username) ? $language_26."<br>" : null;
	$errMsg .= empty($password) ? $language_27."<br>" : null;
	if(empty($errMsg)){
		$pass = ICP_encrypt($password);
		if($db){
			$records = $conn->prepare('SELECT login FROM accounts WHERE login = :username AND password = :password');
			$records->bindParam(':username', $username);
			$records->bindParam(':password', $pass);
			$records->execute();
			$results = $records->fetch(PDO::FETCH_ASSOC);
			if($results){
				for($x=0;$x < count($adms);$x++){
					if(trim($results['login']) == trim($adms[$x]))
						$accesslevel = 1;
				}
				$_SESSION["UsuarioLogin"] = trim($results['login']);
				$_SESSION["UsuarioNivel"] = $accesslevel;
				return resposta("Entrando...").redireciona("links.php?icp=home",3000);
			}else{
				if(!$L2jVersaoRussa){
					// Login for aCis
					$records = $conn->prepare('SELECT login, password FROM accounts WHERE login = :username');
					$records->bindParam(':username', $username);
					$records->execute();
					$results = $records->fetch(PDO::FETCH_ASSOC);
					if($results){
						if(password_verify($password, $results['password'])){
							for($x=0;$x < count($adms);$x++){
								if(trim($results['login']) == trim($adms[$x]))
									$accesslevel = 1;
							}
							$_SESSION["UsuarioLogin"] = trim($results['login']);
							$_SESSION["UsuarioNivel"] = $accesslevel;
							return resposta("Entrando...").redireciona("links.php?icp=home",3000);
						}
					}
				}
			}
			return resposta($language_25."<br>".$language_24);
		}else{
			$records = $conn->prepare("SELECT TOP 1 account FROM user_auth WHERE account = :username AND password LIKE ".$pass);
			$records->bindParam(':username', $username);
			$records->execute();
			$results = $records->fetch(PDO::FETCH_ASSOC);
			if($results){
				for($x=0;$x < count($adms);$x++){
					if(trim($results['account']) == trim($adms[$x]))
						$accesslevel = 1;
				}
				$_SESSION["UsuarioLogin"] = trim($results['account']);
				$_SESSION["UsuarioNivel"] = $accesslevel;
				return resposta("Entrando...").redireciona("links.php?icp=home",3000);
			}else{
				return resposta($language_25."<br>".$language_24);
			}
		}
	}else{
		return resposta($errMsg.$language_24);
	}
}

function saveConfigs($admins,$buttons,$token,$id,$coins2,$qtd_coins2,$deposito,$voto){
	global $conn;
	global $language_41;
	global $language_58;
	global $language_72;
	$adms = null;
	sleep(3);
	if(empty($admins))
		return respostaDelay($language_72,4000);
	$admins = explode(",", $admins);
	for($x=0;$x < (count($admins)+1);$x++){
		$adms .= $admins[$x];
		if(!empty($admins[$x]))
			$adms .= ",";
	}
	$deposito = !empty($deposito) ? $deposito : 0;
	$vtd = !empty($voto) ? $voto : 0;
	$coins = null;
	$qtd_coins = null;
	for($x=0;$x < count($coins2);$x++){
		$coins .= $coins2[$x];
		if(!empty($coins2[$x]))
			$coins .= ",";
	}
	for($x=0;$x < count($qtd_coins2);$x++){
		$qtd_coins .= $qtd_coins2[$x];
		if(!empty($qtd_coins2[$x]))
			$qtd_coins .= ",";
	}
	$update_config = $conn->prepare("UPDATE icp_votesystem_config SET admins = '".$adms."', moeda_voto = '".$coins."', qtd_moeda_voto = '".$qtd_coins."', deposito = '".$deposito."', votos = '".$vtd."' WHERE id = '1'");
	$update_config->execute();
	for($x=0;$x < count($buttons);$x++){
		$button = !empty($buttons[$x]) ? $buttons[$x] : 'sem_id';
		$tokenx = !empty($token[$x]) ? $token[$x] : 'sem_token';
		$disponivel = $button == 'sem_id' ? 0 : 1;
		$topid = !empty($id[$x]) ? $id[$x] : null;
		$update_button = $conn->prepare("UPDATE icp_votesystem_tops SET top_id = '".$button."', disponivel = '".$disponivel."', top_token = '".$tokenx."' WHERE id = '".$topid."'");
		$update_button->execute();
	}
	return respostaDelay($language_58."<br>".$language_41,6000).redireciona("links.php?icp=home",6000);
}

function pega_cookie($cookie){
	$dia_gs = substr($cookie, 5, 2);
	$ano_gs = substr($cookie, 12, 4);
	$mes_gs = substr($cookie, 8, 3);
	$hor_gs = substr($cookie, 17, 2);
	$min_gs = substr($cookie, 20, 2);
	$seg_gs = substr($cookie, 23, 2);
	if($mes_gs == 'Jan'){ $mes_gs = '01'; }elseif($mes_gs == 'Feb'){ $mes_gs = '02'; }elseif($mes_gs == 'Mar'){ $mes_gs = '03'; }elseif($mes_gs == 'Apr'){ $mes_gs = '04'; }elseif($mes_gs == 'May'){ $mes_gs = '05'; }elseif($mes_gs == 'Jun'){ $mes_gs = '06'; }elseif($mes_gs == 'Jul'){ $mes_gs = '07'; }elseif($mes_gs == 'Aug'){ $mes_gs = '08'; }elseif($mes_gs == 'Sep'){ $mes_gs = '09'; }elseif($mes_gs == 'Oct'){ $mes_gs = '10'; }elseif($mes_gs == 'Nov'){ $mes_gs = '11'; }elseif($mes_gs == 'Dec'){ $mes_gs = '12'; }
	$click_cookie = $ano_gs."-".$mes_gs."-".$dia_gs." ".$hor_gs.":".$min_gs.":".$seg_gs;
	return date("Y-m-d H:i:s",strtotime($click_cookie." + 12 hours"));
}

function checkVoteForIP($ip){
	global $db;
	global $conn;
	if($db){
		$records = $conn->prepare("SELECT data_entrega FROM icp_votesystem_votos WHERE ip = '".$ip."' ORDER BY data_entrega DESC LIMIT 1");
	}else{
		$records = $conn->prepare("SELECT TOP 1 data_entrega FROM icp_votesystem_votos WHERE ip = '".$ip."' ORDER BY data_entrega DESC");
	}
	$records->execute();
	$results = $records->fetch(PDO::FETCH_ASSOC);
	if($results){
		if(date("Y-m-d H:i:s") > date('Y-m-d H:i:s', strtotime($results["data_entrega"]." + 12 hours"))){
			return true;
		}else{
			return false;
		}
	}
	return true;
}

function checkVoteForLogin($login){
	global $db;
	global $conn;
	if($db){
		$records = $conn->prepare("SELECT data_entrega FROM icp_votesystem_votos WHERE login = '".$login."' ORDER BY data_entrega DESC LIMIT 1");
	}else{
		$records = $conn->prepare("SELECT TOP 1 data_entrega FROM icp_votesystem_votos WHERE login = '".$login."' ORDER BY data_entrega DESC");
	}
	$records->execute();
	$results = $records->fetch(PDO::FETCH_ASSOC);
	if($results){
		if(date("Y-m-d H:i:s") > date('Y-m-d H:i:s', strtotime($results["data_entrega"]." + 12 hours"))){
			return true;
		}else{
			return false;
		}
	}
	return true;
}

function checkVoteForCookies(){
	if(isset($_COOKIE["dataEntrega"])){
		return true;
	}
	return false;
}

function selectChar($login){
	global $db;
	if($db){
		global $conn;
		$charid = info_table("characters","charid");
		$chars = $conn->prepare("SELECT char_name, ".$charid." FROM characters WHERE account_name = '".$login."' AND online = '0' ORDER BY char_name ASC");
	}else{
		global $db_data;
		global $db_ip;
		global $db_user;
		global $db_pass;
		$db_name = "lin2world";
		unset($conn);
		include("connection.php");
		$charid = "char_id";
		$chars = $conn->prepare("SELECT char_name, ".$charid." FROM user_data WHERE account_name = '".$login."' ORDER BY char_name ASC", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
	}
	$chars->execute();
	if($chars->rowCount() > 0){
		$chars_list = null;
		while($row = $chars->fetchObject()){
			$chars_list .= $row->$charid.",".$row->char_name.";";
		}
		return $chars_list;
	}
	return null;
}

function entregaPremio($login,$charid){
	global $db;
	global $conn;
	global $moeda_voto;
	global $qtd_moeda_voto;
	global $deposito_loc;
	global $language_10;
	global $language_15;
	global $language_16;
	global $language_17;
	global $language_69;
	global $db_ip;
	$charid = preg_replace("/(\D)/i" , "" , $charid);
	if($db){
		$col_charid = info_table("characters","charid");
		$col_objid = info_table("items","charid");
		$chars = $conn->prepare("SELECT char_name FROM characters WHERE account_name = '".$login."' AND online = '0' AND ".$col_charid." = '".$charid."'");
		$chars->execute();
		if($chars->rowCount() == 1){
			if(empty($moeda_voto) || empty($qtd_moeda_voto)){
				return resposta($language_69);
			}else{
				$loc = $deposito_loc == 0 ? 'WAREHOUSE' : 'INVENTORY';
				$local = $loc == 'WAREHOUSE' ? 'warehouse.' : 'inventario.';
				$moeda_voto = explode(',', $moeda_voto);
				$qtd_moeda_voto = explode(',', $qtd_moeda_voto);
				for($x=0;$x<(count($moeda_voto)-1);$x++){
					$busca_item = $conn->prepare("SELECT count FROM items WHERE item_id = '".$moeda_voto[$x]."' AND owner_id = '".$charid."' AND loc = '".$loc."'");
					$busca_item->execute();
					if($busca_item->rowCount() == 1){
						$inserindo_item = $conn->prepare("UPDATE items SET count = (count + '".$qtd_moeda_voto[$x]."') WHERE owner_id = '".$charid."' AND item_id = '".$moeda_voto[$x]."' AND loc = '".$loc."'");
					}else{
						$id_maximo = $conn->prepare("SELECT MAX(".$col_objid.") AS max FROM items");
						$id_maximo->execute();
						$id_max = $id_maximo->fetch(PDO::FETCH_ASSOC);
						$nova_id = 1000 + $id_max['max'];
						$inserindo_item = $conn->prepare("INSERT INTO items (owner_id, ".$col_objid.", item_id, count, enchant_level, loc) VALUES ('".$charid."', '".$nova_id."', '".$moeda_voto[$x]."', '".$qtd_moeda_voto[$x]."', '0', '".$loc."')");
					}
					$inserindo_item->execute();
				}
				$inserindo_voto = $conn->prepare("INSERT INTO icp_votesystem_votos (login, votos, ip) VALUES ('".$login."', '1', '".get_client_ip()."')");
				$inserindo_voto->execute();
				echo "<script type='text/javascript'>SetCookie('dataEntrega');</script>";
				return respostaDelay($language_15.' '.(count($moeda_voto)-1).' '.$language_16.' '.$local.'.<br>'.$language_17,10000);
			}
		}else{
			return respostaDelay($language_10,6000);
		}
	}else{
		global $db_data;
		global $db_ip;
		global $db_user;
		global $db_pass;
		global $cached_port;
		$inserindo_voto = $conn->prepare("INSERT INTO icp_votesystem_votos (login, ip, votos) VALUES ('".$login."', '".get_client_ip()."', '1')");
		$inserindo_voto->execute();
		echo "<script type='text/javascript'>SetCookie('dataEntrega');</script>";
		unset($conn);
		$db_name = "lin2world";
		include("connection.php");
		kick_char($charid);
		$moeda_voto = explode(',', $moeda_voto);
		$qtd_moeda_voto = explode(',', $qtd_moeda_voto);
		$deposito_loc = $deposito_loc == 1 ? 0 : 1;
		$colcount = $conn->prepare("SELECT * FROM user_item");
		$colcount->execute();
		$colcount1 = $colcount->columnCount();
		$cols1 = 'c';
		$cols2 = array();
		for($x=0;$x<($colcount1 - 1);$x++){
			$cols1 .= 'V';
			if($x > 5)
				array_push($cols2, ",0");
		}
		for($x=0;$x<(count($moeda_voto)-1);$x++){
			$buf=pack($cols1,55,$charid,$deposito_loc,$moeda_voto[$x],$qtd_moeda_voto[$x],0,0,...$cols2).tounicode("admin");
			$cachedsocket=@fsockopen($db_ip,$cached_port,$errno,$errstr,1);
			fwrite($cachedsocket,pack("s",(strlen($buf)+2)).$buf);
			fclose($cachedsocket);
		}
		return respostaDelay($language_15.' '.(count($moeda_voto)-1).' '.$language_16.' '.$local.'.<br>'.$language_17,10000);
	}
	return null;
}

function kick_char($char_id){
	global $db_data;
	global $db_ip;
	global $db_user;
	global $db_pass;
	global $cached_port;
	unset($conn);
	$db_name = "lin2world";
	include("connection.php");
	$buf=pack("cV",5,$char_id).tounicode("admin");
	$cachedsocket=@fsockopen($db_ip,$cached_port,$errno,$errstr,1) or die(mssql_get_last_message());
	fwrite($cachedsocket,pack("s",(strlen($buf)+2)).$buf);
	fclose($cachedsocket);
}

function tounicode($string){
    $rs="";
	for($i=0;$i<strlen($string);$i++) $rs.=$string[$i].chr(0);
    return($rs.chr(0).chr(0));
}

function ICP_encrypt($pass){
	global $db;
	global $L2jVersaoRussa;
	if($db){
		if(!$L2jVersaoRussa){
			return base64_encode(pack('H*', sha1($pass)));
		}else{
			return base64_encode(hash('whirlpool', $pass, true));
		}
	}else{
		$key = array();
		$dst = array();
		$i = 0;
		$nBytes = strlen($pass);
		while ($i < $nBytes){
			$i++;
			$key[$i] = ord(substr($pass, $i - 1, 1));
			$dst[$i] = $key[$i];
		}
		$rslt = $key[1] + $key[2]*256 + $key[3]*65536 + $key[4]*16777216;
		$one = $rslt * 213119 + 2529077;
		$one = $one - intval($one/ 4294967296) * 4294967296;
		$rslt = $key[5] + $key[6]*256 + $key[7]*65536 + $key[8]*16777216;
		$two = $rslt * 213247 + 2529089;
		$two = $two - intval($two/ 4294967296) * 4294967296;
		$rslt = $key[9] + $key[10]*256 + $key[11]*65536 + $key[12]*16777216;
		$three = $rslt * 213203 + 2529589;
		$three = $three - intval($three/ 4294967296) * 4294967296;
		$rslt = $key[13] + $key[14]*256 + $key[15]*65536 + $key[16]*16777216;
		$four = $rslt * 213821 + 2529997;
		$four = $four - intval($four/ 4294967296) * 4294967296;
		$key[4] = intval($one/16777216);
		$key[3] = intval(($one - $key[4] * 16777216) / 65535);
		$key[2] = intval(($one - $key[4] * 16777216 - $key[3] * 65536) / 256);
		$key[1] = intval(($one - $key[4] * 16777216 - $key[3] * 65536 - $key[2] * 256));
		$key[8] = intval($two/16777216);
		$key[7] = intval(($two - $key[8] * 16777216) / 65535);
		$key[6] = intval(($two - $key[8] * 16777216 - $key[7] * 65536) / 256);
		$key[5] = intval(($two - $key[8] * 16777216 - $key[7] * 65536 - $key[6] * 256));
		$key[12] = intval($three/16777216);
		$key[11] = intval(($three - $key[12] * 16777216) / 65535);
		$key[10] = intval(($three - $key[12] * 16777216 - $key[11] * 65536) / 256);
		$key[9] = intval(($three - $key[12] * 16777216 - $key[11] * 65536 - $key[10] * 256));
		$key[16] = intval($four/16777216);
		$key[15] = intval(($four - $key[16] * 16777216) / 65535);
		$key[14] = intval(($four - $key[16] * 16777216 - $key[15] * 65536) / 256);
		$key[13] = intval(($four - $key[16] * 16777216 - $key[15] * 65536 - $key[14] * 256));
		$dst[1] = $dst[1] ^ $key[1];
		$i=1;
		while ($i<16){
			$i++;
			$dst[$i] = $dst[$i] ^ $dst[$i-1] ^ $key[$i];
		}
		$i=0;
		while ($i<16){
			$i++;
			if ($dst[$i] == 0) {
				$dst[$i] = 102;
			}
		}
		$encrypt = "0x";
		$i=0;
		while ($i<16){
			$i++;
			if ($dst[$i] < 16) {
				$encrypt = $encrypt . "0" . dechex($dst[$i]);
			} else {
				$encrypt = $encrypt . dechex($dst[$i]);
			}
		}
		return $encrypt;
	}
	return null;
}
?>
