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
if(file_exists("config/connect_config.php")){
	session_destroy();
	header("location: index.php");
	exit;
}else{
	if(isset($_POST["install"])){
		$db_ip = $_POST["ip_db"];
		$db_user = $_POST["user_db"];
		$db_pass = $_POST["pass_db"];
		$db_name = $_POST["name_db"];
		$db_data = $_POST["db_type"];
		$l2jruss = $_POST["l2jruss"] == 'true' ? 'true' : 'false';
		$admins = $_POST["admins"];
		include("config/connection.php");
		if(!$conn){
			echo resposta($language_39);
		}else{
			include_once("config/functions.php");
			echo instalar($db_ip, $db_user, $db_pass, $db_name, $db_data, $l2jruss, $admins);
		}
	}
	$style1 = "style='width:90px;'";
	$style2 = "style='width:30px;'";
	$style3 = "style='width:245px;'";
	?>
	<div style="text-align:left; border-bottom:1px solid #666; padding-left:5px; float:left; margin-top:-67px; width:572px; color:#FFF; line-height:30px; background-image:url(images/bg_votesystem.gif);">
		<?php echo $language_44; ?>
	</div>
	<div align="left" style="padding-left:25px; background-image:url(images/bg_votesystem.gif);">
		<form action="javascript:instalar();" method="post">
			<div style="float:left; width:100%; height:80px; line-height:80px; text-align:center; font-weight:bold; margin-top:-35px; background-image:url(images/bg_votesystem.gif); margin-left:-25px; padding-left:25px;">
				<?php echo $language_56; ?>
			</div>
			<div id="inst_1">
				<?php echo $language_45; ?>
			</div>
			<div id="inst_2">
				<input type='text' id='2' <?php echo $style3; if(isset($_POST["ip_db"])){ echo" value='".$_POST["ip_db"]."'"; } ?>>
			</div>
			<div id="inst_1">
				<?php echo $language_46; ?>
			</div>
			<div id="inst_2">
				<input type='text' id='3' <?php echo $style3; if(isset($_POST["user_db"])){ echo" value='".$_POST["user_db"]."'"; } ?>>
			</div>
			<div id="inst_1">
				<?php echo $language_47; ?>
			</div>
			<div id="inst_2">
				<input type='password' id='4' <?php echo $style3; if(isset($_POST["pass_db"])){ echo " value='".$_POST["pass_db"]."'"; } ?>>
			</div>
			<div id="inst_1">
				<?php echo $language_48; ?>
			</div>
			<div id="inst_2">
				<input type='text' id='5' <?php echo $style3; if(isset($_POST["name_db"])){ echo" value='".$_POST["name_db"]."'"; } ?>>
			</div>
			<div id="inst_1">
				<?php echo $language_71; ?>
			</div>
			<div id="inst_2">
				<input type='text' id='6' <?php echo $style3; if(isset($_POST["admins"])){ echo" value='".$_POST["admins"]."'"; } ?>>
			</div>
			<div id="inst_1">
				<?php echo $language_49; ?>
			</div>
			<div id="inst_2" style="font-size:14px; line-height:14px;">
				<input name='6' type="radio" checked="checked" value="l2j" style="width:15px;height:15px;vertical-align:-3px;">L2J - MySQL
				<input id="russ" type="checkbox" value="russ" style="width:15px;height:15px;vertical-align:-3px;">Base Russ<br>
				<input name='6' type="radio" value="l2off" style="width:15px;height:15px;vertical-align:-3px;">L2OFF - MsSql
			</div>
			<div class='entrega' style='text-align:center;'>
				<img src='images/ajax-loader.gif'><br /><?php echo $language_38; ?>
			</div>
			<div style="float:left; width:100%; height:80px; line-height:80px; text-align:center;">
				<button style='margin-top: 20px; margin-bottom: 20px;' class='button secondary' id="50"><?php echo $language_36; ?></button>
			</div>
		</form>
		<div style="clear:both;"></div>
	</div>
	<?php
}
?>