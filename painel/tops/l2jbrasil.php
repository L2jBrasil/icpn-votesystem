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
$topL2jbrURL = "https://top.l2jbrasil.com/votesystem/?hours=12&player_id={$player_id}&username={$row->top_id}&type=json";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $topL2jbrURL);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERAGENT, 'curl/7.68.0 ICPNetwork/2.6');
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

$response = curl_exec($ch);
$http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

$can_vote = false;
$tops_voted = array_replace($tops_voted, array($i => array(1, '0000-00-00 00:00:00')));

if ($response === false) {
    $can_vote = true;
} else {
    
    if ($http_status != 200) {
        $can_vote = true;
    } else {
        $json = json_decode($response, true);

        if ($json != null) {
            if (!isset($json['vote'])) {
                $can_vote = true;
            } else {
                $votes = $json['vote'];

                // check the status of the last vote
                $last_vote = end($votes);
                if (isset($last_vote['status']) && $last_vote['status'] == '1' && intval($last_vote['hours_since_vote']) < 12) {
                    $can_vote = false;
                } else {
                    $can_vote = true;
                }
            }
        }
    }
}

// use the value of can_vote as needed
if ($can_vote):
	?>
		<div style='width:87px; height:47px; border:1px solid #999; margin-top:5px; margin-left:5px; float:left;'>
			<a href='https://top.l2jbrasil.com/index.php?a=in&u=<?php echo $row->top_id; ?>&player_id=<?php echo $player_id; ?>' target='_blank'><img src='images/buttons/<?php echo $row->top_img; ?>' title='Top L2JBrasil de Servidores de Lineage2' border='0' width='87' height='47'></a>
		</div>
		<?php
else:
	$hoursToVoteAgain = 12;
	
	//Legacy Code
	$data_modificada = $data_modificada = date("Y-m-d H:i:s",strtotime($last_vote['date']." + {$hoursToVoteAgain} hours"));
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
endif;