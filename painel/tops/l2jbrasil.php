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
$player_id = md5("ipc".$_SESSION["UsuarioLogin"].$row->top_id);
if(@fsockopen(str_replace("https://","",str_replace("http://","",$row->top_url)), 80 , $errno , $errstr , 30)){
	@header('Content-Type: text/html; charset=utf-8')
	$xml = @simplexml_load_string(acessoSimples("https://top.l2jbrasil.com/votesystem/?hours=12&player_id={$player_id}&username={$row->top_id}"));
	if(count($xml)){
		$lastVote = end($xml->vote);
		$data_modificada = date("Y-m-d H:i:s",strtotime($lastVote->date." + 12 hours"));
	}
	$xml = null;
	if(strtotime($data_modificada) >= strtotime(date('Y-m-d H:i:s'))){
		$data_voto = explode("-", substr(str_replace(" ", "", $data_modificada), 0, 10));
		$hora_voto = explode(":", substr(str_replace(" ", "", $data_modificada), 10, 19));
		$tops_voted = array_replace($tops_voted, array($i => array(1, $data_modificada)));
		?>
		<script language="javascript">
			atualizaContador(<?php echo $row->id; ?>,<?php echo $data_voto[0]; ?>,<?php echo $data_voto[1]; ?>,<?php echo $data_voto[2]; ?>,<?php echo $hora_voto[0]; ?>,<?php echo $hora_voto[1]; ?>,<?php echo $hora_voto[2]; ?>);
		</script>
		<div style='background:url(images/buttons/<?php echo $row->top_img; ?>); background-repeat: no-repeat; background-size: 87px 47px; width:87px; height:47px; border:1px solid #999; margin-top:5px; margin-left:5px; float:left;'>
			<div style='width:89px; *width:87px; _width:87px; height:49px; *height:47px; _height:47px; font-size:10px; font-family:Arial; background: rgba(0,0,0,0.7); text-shadow:1px 1px #000; font-weight:bold;'>
				<?php echo $language_05; ?><br><font size='3'><span id='contador<?php echo $row->id; ?>'></span></font><br><?php echo $language_06; ?>
			</div>
		</div>
		<?php
	}else{
		?>
		<div style='width:87px; height:47px; border:1px solid #999; margin-top:5px; margin-left:5px; float:left;'>
			<a href='https://top.l2jbrasil.com/index.php?a=in&u=<?php echo $row->top_id; ?>&player_id=<?php echo $player_id; ?>' target='_blank'><img src='images/buttons/<?php echo $row->top_img; ?>' title='Top L2JBrasil de Servidores de Lineage2' border='0' width='87' height='47'></a>
		</div>
		<p>Use apenas o link acima que contém o seu "player_id": <b><?php echo $player_id; ?></b></p>
		<?php
	}
}else{
	$tops_voted = array_replace($tops_voted, array($i => array(1, '0000-00-00 00:00:00')));
}
?>