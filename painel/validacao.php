<?php
//=======================================================================\\
//  ## ####### #######                                                   \\
//  ## ##      ##   ##                                                   \\
//  ## ##      ## ####  |\  | |ппп пп|пп \      / |ппп| |ппп| | / |ппп|  \\
//  ## ##      ##       | \ | |--    |    \    /  | | | | |_| |<   п\_   \\
//  ## ####### ##       |  \| |___   |     \/\/   |___| | |\  | \ |___|  \\
// --------------------------------------------------------------------- \\
//       Brazillian Developer / WebSite: http://www.icpfree.com.br       \\
//                 Email & Skype: ivan1507@gmail.com.br                  \\
//=======================================================================\\
if (!isset($_SESSION)){ session_start(); }
sleep(3);
if(strpos($_SERVER['HTTP_REFERER'],$_SERVER['SERVER_NAME'])){
	if(isset($_POST["logar"])){
		logar($_POST["login"],$_POST["senha"]);
	}
}else{
	session_destroy();
	header("Location: ../index.php");
	exit;
}
?>