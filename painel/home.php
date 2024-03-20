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
if (($_SESSION["UsuarioNivel"] < 0) or ($_SESSION["UsuarioNivel"] > 1)) {
	session_destroy();
	echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=./'>";
	exit;
}
if($_SESSION["UsuarioNivel"] == 1){ ?>
	<div id="adm"><a href="javascript: void(0)" onClick="javascript:adm();"><?php echo $language_32; ?></a></div>
	<?php
} ?>
<div style="text-align:left; border-bottom:1px solid #666; padding-left:5px; float:left; margin-top:-67px; width:574px; color:#FFF; line-height:30px;">
	<span style="float:left;"><?php echo $language_01." ".$_SESSION["UsuarioLogin"]; ?></span>
	<span style="float:right; margin-right:5px;">
		<a href="painel/logout.php" style="color:#ccc; text-decoration:none;">
			<?php echo $language_02; ?>
		</a>
	</span>
</div>
<div style="width:470px; height:auto; margin:auto;" id="banners">
	<?php
	$tops = $conn->prepare("SELECT * FROM icp_votesystem_tops WHERE disponivel = '1'");
	$tops->execute();
	if($tops->rowCount() == 0){
		if ($_SESSION["UsuarioNivel"] == 1) {
			echo resposta($language_70)."<script type='text/javascript'>adm();</script>";
		}else{
			echo $language_03."<br>".$language_04;
		}
	}else{
		$tops_voted = array();
		$data_modificada = null;
		$voto = 0;
		for($x=0;$x<$tops->rowCount();$x++){
			array_push($tops_voted, [0,'0000-00-00 00:00:00']);
		}
		$i = 0;
		while ($row = $tops->fetchObject()){
			include_once("painel/tops/".$row->top_btn);
			$i++;
		}
		for($x=0;$x<count($tops_voted);$x++){
			$voto += $tops_voted[$x][0];
		}
		?>
		<div class='verify' style='text-align:center;'><img src='images/ajax-loader.gif'><br /><?php echo $language_30; ?></div>
		<?php
		if(isset($_POST["verificar"])){
			if(strpos($_SERVER['HTTP_REFERER'],$_SERVER['SERVER_NAME'])) {
				if($voto == $tops->rowCount()){
					if(checkVoteForIP(get_client_ip()) && checkVoteForLogin($_SESSION["UsuarioLogin"]) && !checkVoteForCookies()){
						$chars = selectChar($_SESSION["UsuarioLogin"]);
						if(!empty($chars)){
							?>
							<div class='entrega' style='text-align:center;'><img src='images/ajax-loader.gif'><br /><?php echo $language_31; ?></div>
							<?php
							echo"<div style='float:left; width:100%; margin-top:10px;'>".$language_08;
							echo"<form action='javascript:receber();' method='post'><select name='char' id='1' style='margin-top:10px;'>";
							$chars_return = explode(";", $chars);
							for ($x=0;$x<(count($chars_return)-1);$x++) {
								$chars_list = explode(",", $chars_return[$x]);
								echo "<OPTION VALUE=\"".$chars_list[0]."\">".$chars_list[1]."</OPTION>";
							}
							echo"</select><br><button style='margin-top: 20px; margin-bottom: 20px;' class='button secondary'>".$language_09."</button></form></div>";
						}else{
							echo resposta($language_10);
							$_POST["verificar"] = NULL;
						}
					}else{
						echo resposta($language_07);
						$_POST["verificar"] = NULL;
					}
				}else{
					echo respostaDelay($language_11."<br>".$language_12,8000);
					$_POST["verificar"] = NULL;
				}
			}
		}
		if(isset($_POST["trocar"])){
			if(strpos($_SERVER['HTTP_REFERER'],$_SERVER['SERVER_NAME'])){
				if($voto == $tops->rowCount()){
					if(checkVoteForIP(get_client_ip()) && checkVoteForLogin($_SESSION["UsuarioLogin"]) && !checkVoteForCookies()){
						echo entregaPremio($_SESSION["UsuarioLogin"],$_POST["char"]);
					}else{
						echo resposta($language_13."<br>".$language_14);
					}
				}else{
					echo respostaDelay($language_11."<br>".$language_12,8000);
				}
			}
		}
		if(!isset($_POST["verificar"])){
			echo"<div style='width:100%; float:left;'><form action='javascript:trocar();' method='post'><button style='margin-top: 20px; margin-bottom: 20px;' class='button secondary'>".$language_18."</button></form></div>";
		}
	}
	?>
</div>
<div style="clear:both;"></div>