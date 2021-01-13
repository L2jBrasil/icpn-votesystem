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
sleep(3);
if (!isset($_SESSION)){ session_start(); }
if ($_SESSION["UsuarioNivel"] != '1'){
	session_destroy();
	echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=./'>";
	exit;
}
$style1 = "style='width:90px;'";
$style2 = "style='width:30px;'";
$style3 = "style='width:245px;'";
?>
<div id="adm">
	<a href="javascript: void(0)" onClick="javascript:user();"><?php echo $language_33; ?></a>
</div>
<?php
if(isset($_POST["edit"])){
	saveConfigs($_POST["admins"],$_POST["buttons"],$_POST["token"],$_POST["id"],$_POST["coins"],$_POST["qtd_coins"],$_POST["deposito"],$_POST["voto"]);
}
?>
<style>
.hidden {
  display: none;
}
</style>
<div style="text-align:left; border-bottom:1px solid #666; padding-left:5px; float:left; margin-top:-67px; width:572px; color:#FFF; line-height:30px;">
	<span style="float:left;"><?php echo $language_57; ?></span>
	<span style="float:right; margin-right:5px;">
		<a href="painel/logout.php" style="color:#ccc; text-decoration:none;">
			<?php echo $language_02; ?>
		</a>
	</span>
</div>
<div align="left" style="padding-left:25px; background-image:url(images/bg_votesystem.gif);">
	<form action="javascript:edit();" method="post">
		<div style="float:left; width:100%; height:80px; line-height:80px; text-align:center; font-weight:bold; margin-top:-30px">
			<?php echo $language_50; ?>
		</div>
		<?php
		$select_sites = $conn->prepare("SELECT * FROM icp_votesystem_tops");
		$select_sites->execute();
		while($row = $select_sites->fetchObject()){
			?>
			<div style="float:left; width:130px; height:auto; text-align:center; margin: 10px 0px;">
				<a href="<?php echo $row->top_url; ?>" target="_blank" title="<?php echo $language_37; ?>"><?php echo $row->top_name; ?><br>
				<img src="images/buttons/<?php echo $row->top_img; ?>" width="87" height="47" border="0"></a><br>
				<input type='text' name='buttons[]' <?php echo $style1; ?> value='<?php echo isset($_POST["buttons"][($row->id - 1)]) ? $_POST["buttons"][($row->id - 1)] : isset($row->top_id) && $row->top_id != "sem_id" ? $row->top_id : null; ?>'>
				<?php if($row->use_token == 1){ ?>
				<br><input type='text' name='token[]' <?php echo $style1; ?> value='<?php echo isset($_POST["token"][($row->id - 1)]) ? $_POST["token"][($row->id - 1)] : isset($row->top_token) && $row->top_token != "sem_token" ? $row->top_token : null; ?>'>
				<?php }else{ ?>
				<br><input type='text' name='token[]' <?php echo $style1; ?> class="hidden" value=''>
				<?php } ?>
				<input type="hidden" name="id[]" value="<?php echo isset($row->id) ? $row->id : null; ?>">
			</div>
			<?php
		}
		?>
		<div style="float:left; width:100%; height:80px; line-height:80px; text-align:center; font-weight:bold;">
			<?php echo $language_51; ?>
		</div>
		<?php
			$total_moedas_permitido = 10;
			if(empty($moeda_voto))
				for($x=1;$x<$total_moedas_permitido;$x++)
					$moeda_voto .= ",";
			$moeda = explode(",", $moeda_voto);
			$qtd_moeda = explode(",", $qtd_moeda_voto);
			$subtrai_total = abs((count($moeda)-1) - $total_moedas_permitido);
			for($x=0;$x<=((count($moeda)-1) + ($subtrai_total-1));$x++){
				echo $x < ceil($total_moedas_permitido / 2) ? "<div id=\"inst_1\">" : "<div id=\"inst_2\">";
				echo $language_52." ".str_pad(($x+1), 2, '0', STR_PAD_LEFT); ?>: <input type='text' name="coins[]" <?php echo $style1; ?> value='<?php if(isset($_POST["coins"][$x]) && !empty($_POST["coins"][$x])){ echo $_POST["coins"][$x]; }else{ if(isset($moeda[$x]) && !empty($moeda[$x]) && !isset($_POST["coins"][$x])){ echo $moeda[$x]; }else{ echo null; } } ?>'> <?php echo $language_55; ?> <input type='text' name="qtd_coins[]" <?php echo $style2; ?> value='<?php if(isset($_POST["qtd_coins"][$x]) && !empty($_POST["qtd_coins"][$x])){ echo $_POST["qtd_coins"][$x]; }else{ if(isset($qtd_moeda[$x]) && !empty($qtd_moeda[$x]) && !isset($_POST["qtd_coins"][$x])){ echo $qtd_moeda[$x]; }else{ echo null; } } ?>'>
				</div>
				<?php
			}
			?>
			<div id="inst_1"></div><div id="inst_2"></div>
			<div id="inst_1">
				<?php echo $language_53; ?>
			</div>
			<div id="inst_2">
				<select name="deposito" id='1'>
					<?php $deposito_loc = isset($_POST["deposito"]) ? $_POST["deposito"] : $deposito_loc; ?>
					<?php if($deposito_loc == 0){ ?>
						<option value="0">Warehouse</option>
						<option value="1">Inventário</option>
					<?php }elseif($deposito_loc == 1){ ?>
						<option value="1">Inventário</option>
						<option value="0">Warehouse</option>
					<?php }else{ ?>
						<option value="0">Warehouse</option>
						<option value="1">Inventário</option>
					<?php } ?>
				</select>
			</div>
			<div id="inst_1">
				<?php echo $language_66; ?>
			</div>
			<div id="inst_2">
				<select name="voto" id='38'>
					<?php $mostra_votos = isset($_POST["voto"]) ? $_POST["voto"] : $mostra_votos; ?>
					<?php if($mostra_votos == 0){ ?>
						<option value="0"><?php echo $language_68; ?></option>
						<option value="1"><?php echo $language_67; ?></option>
					<?php }elseif($mostra_votos == 1){ ?>
						<option value="1"><?php echo $language_67; ?></option>
						<option value="0"><?php echo $language_68; ?></option>
					<?php }else{ ?>
						<option value="1"><?php echo $language_67; ?></option>
						<option value="0"><?php echo $language_68; ?></option>
					<?php } ?>
				</select>
			</div>
			<div id="inst_1">
				<?php echo $language_71; ?>
			</div>
			<div id="inst_2">
				<?php
				$admins = explode(",", $admins);
				for($x=0;$x < count($admins);$x++){
					$adms .= $admins[$x];
					if(!empty($admins[$x]) && $x != (count($admins)-2))
						$adms .= ",";
				}
				?>
				<input type='text' id='6' <?php echo $style3; ?> value='<?php echo isset($_POST["admins"]) ? $_POST["admins"] : $adms; ?>'>
			</div>
			<?php
		?>
		<div style="float:left; width:100%; height:80px; line-height:80px; text-align:center;">
			<button style='margin-top: 20px; margin-bottom: 20px;' class='button secondary'><?php echo $language_59; ?></button>
		</div>
	</form>
</div>
	<div style="clear:both;"></div>