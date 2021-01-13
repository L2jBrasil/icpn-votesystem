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
if (!isset($_SESSION)){ session_start(); }
include_once('config/language.php');
if(!file_exists("config/connect_config.php")){
	include_once('config/functions.php');
	include_once('painel/instalacao.php');
}else{
	include_once('config/connect_config.php');
	include_once('config/functions.php');
	$pasta = "painel/"; // Caminho da pasta onde estão os seus arquivos PHP
	$home = "home"; // Página principal
	#======== Não edite daqui para baixo ========#
	$pags_array = array();
	$diretorio = dir($pasta);
	while($arquivo = $diretorio -> read()){
		if($arquivo != "." && $arquivo != ".."){
			array_push($pags_array, str_replace(".php", "", $arquivo));
		}
	}
	$diretorio -> close();
	$pagina = !empty($_GET["icp"]) ? trim($_GET["icp"]) : $home;
	$pagina = $pagina == "home" && !isset($_SESSION["UsuarioLogin"]) ? "login" : $pagina;
	if(!in_array($pagina, $pags_array)){
		$pagina = $home;
	}
	if(isset($pagina)){
		if(file_exists($pasta.$pagina.'.php')){
			@include_once($pasta.$pagina.".php");
		}else{
			session_destroy();
			@include_once($pasta.$home.".php");
		}
	}else{
		@include_once($pasta.$home.".php");
	}
}
?>