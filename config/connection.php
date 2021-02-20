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
try {
	$conect_base = strtolower($db_data) == "l2j" ? "mysql:host=".$db_ip.";dbname=".$db_name : "sqlsrv:Server=".$db_ip.";Database=".$db_name;
	$conn = new PDO($conect_base, $db_user, $db_pass);
} catch(PDOException $e) {
	echo 'ERROR: ' . $e->getMessage();
}
?>