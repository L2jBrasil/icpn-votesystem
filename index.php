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
include_once('../config/fix_mysql.inc.php');
if (!isset($_SESSION)){ session_start(); }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<title>VoteSystem ICPNETWORKS 2.7</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<link href='css/default.css' rel='stylesheet' type='text/css' />
		<link href='images/favicon.png' rel='shortcut icon'/>
		<link href='images/favicon.png' rel='icon' type='image/png'/>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		<script type="text/javascript" src="js/icpnetworks.js"></script>
	</head>
	<body>
		<div class="corpo-topo">
			<div id="server">
				<?php if(file_exists("config/connect_config.php")){ ?><div id="total_votos"></div><?php } ?>
			</div>
			<div id="vote"></div>
			<div id="logo"></div>
			<div id="login-box">
				<div class="center-login"<?php echo !file_exists("config/connect_config.php") ? " style='background-image:url(images/bg_votesystem.gif);'" : null; ?>>
					<div class="formulario" align="center">
						<?php
						include("links.php");
						?>
					</div>
					<div class="msg"></div>
					<div class="alvo"></div>
					<div class='loading'><img src="images/ajax-loader.gif"><br /><?php echo $language_28; ?></div>
				</div>
			</div>
			<div id="fb-root"></div>
			<script>
				(function(d, s, id) {
					var js, fjs = d.getElementsByTagName(s)[0];
					if (d.getElementById(id)) return;
					js = d.createElement(s);
					js.id = id;
					js.src = "//connect.facebook.net/pt_BR/all.js#xfbml=1";
					fjs.parentNode.insertBefore(js, fjs);
				}(document, 'script', 'facebook-jssdk'));
			</script>
			<div class="fb-like-box-back">
				<div class="fb-like-box" data-href="https://www.facebook.com/pages/ICP-Networks-Design-Desenvolvimentos-web/250350185072159" data-width="578" data-height="85" data-colorscheme="dark" data-show-faces="false" data-border-color="#666" data-stream="true" data-header="false"></div>
			</div>
			<div id="creditos">
				<br />
				<table id="creditos" width="630" border="0" align="center" cellpadding="10" cellspacing="0">
					<tr>
						<td width="525">
							<?php echo $language_62; ?> <a href="http://icpfree.com.br" title="ICP Networks - Designer Gráfico e Desenvolvimentos web" target="new" id='0'>ICP Networks</a> - <?php echo $language_63; ?>
						</td>
						<td width="30">
							<a href="http://icpfree.com.br" target="new"><img src="images/secure.png" alt="Site 100% seguro!" width="30" height="30" border="0"></a>
							</td>
						<td width="104">
							<a href="http://icpfree.com.br" target="new"><img src="images/rodape_icon.png" alt="Desenvolvido por: ICP Networks" width="105" height="50" border="0"></a>
						</td>
					</tr>
				</table>
				<table id="creditos2" width="700" border="0" align="center" cellpadding="10" cellspacing="0">
					<tr>
						<td width="525">
							<strong><?php echo $language_64; ?></strong> <?php echo $language_65; ?> <a href="http://icpfree.com.br" title="ICP Networks - Designer Gráfico e Desenvolvimentos web" target="new" id='1'>ICP Networks</a><br>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</body>
</html>