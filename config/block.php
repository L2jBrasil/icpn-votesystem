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
function redirect(){
	$block = array();
	$block[] = 'connect_config.php';
	$atual = $_SERVER['PHP_SELF'];
	$remove_barra = explode("/", $atual);
	$count = count($remove_barra)-1;
	$pag = $remove_barra[$count];
	if(in_array($pag,$block)){
		if (!isset($_SESSION)){ session_start(); }
		session_destroy();
		header("location: ../");
		exit;
	}
}
echo redirect();
?>