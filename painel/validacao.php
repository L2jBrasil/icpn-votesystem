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
sleep(3);
include('../config/connect_config.php');
include('../config/language.php');
if(isset($_POST["login"])){
	if(strpos($_SERVER['HTTP_REFERER'],$end)) {
if((empty($_POST['login'])) || (empty($_POST['senha'])) || (empty($_POST['ip']))){
	?>
		<script type="text/javascript">
		$(function(){
			$('.msg').fadeIn('slow').addClass('erro').html('<?php echo"$language_22"; ?>\n<?php echo"$language_23"; ?>\n<?php echo"$language_24"; ?>').delay(3000).fadeOut('slow');
		});
		</script>
	<?php
}else{
	$usuario = mysql_real_escape_string(trim($_POST['login']));
	$senha = base64_encode(pack('H*', sha1($_POST['senha'])));
$query = mysql_query("SELECT $col_acc_login, $col_acc_access FROM $tab_acc WHERE $col_acc_login = '$usuario' AND $col_acc_pass = '$senha' LIMIT 1") or die(mysql_error());
if (mysql_num_rows($query) != 1) {
		?>
			<script type="text/javascript">
			$(function(){
				$('.msg').fadeIn('slow').addClass('erro').html('<?php echo"$language_25"; ?>\n<?php echo"$language_24"; ?>').delay(3000).fadeOut('slow');
			});
			</script>
		<?php
} else {
	while($resultado = mysql_fetch_array($query)){
	$_SESSION["UsuarioLogin"] = $resultado["$col_acc_login"];
	$_SESSION["UsuarioNivel"] = $resultado["$col_acc_access"];
	?>
	<script type="text/javascript">
	setTimeout(function(){
	$(function(){
		$.post('painel/index.php', {login: $('input[type=text]').val(), senha: $('input[type=password]').val(), ip: '<?php echo $_SERVER['REMOTE_ADDR']; ?>'}, function(data){
			$('.formulario').fadeIn('slow').html(data).delay(3000);
		});
			$('.entrando').fadeIn('slow').delay(3000);
		$('.entrando').ajaxStop(function(){
			$('.entrando').hide();
		});
	});
	}, 3000);
	</script>
	<div class='entrando' style='text-align:center;'><img src='images/ajax-loader.gif'><br /><?php echo"$language_29"; ?></div>
	<?php
	exit;
	}
}
}
	}else{
		session_destroy();
		header("Location: ../index.php"); exit;
		exit;
	}
}else{
		session_destroy();
		header("Location: ../index.php"); exit;
		exit;
	}
?>