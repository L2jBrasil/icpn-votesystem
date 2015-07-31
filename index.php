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
if(file_exists("config/connect_config.php")){
include('config/language.php');
}
if(file_exists("config/connect_config.php")){
include('config/connect_config.php');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>VoteSystem ICPNETWORKS 2.5</title>
<link href='css/default.css' rel='stylesheet' type='text/css' />
<link href='images/favicon.png' rel='shortcut icon'/>
<link href='images/favicon.png' rel='icon' type='image/png'/>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript">
function logar(){

$(function(){

	$('input[type=text]').keyup(function(){
		$(this).removeClass('erro');
	})
	$('input[type=password]').keyup(function(){
		$(this).removeClass('erro');
	})
	$('input[type=text]').blur(function(){
		$(this).removeClass('erro');
	})
	$('input[type=password]').blur(function(){
		$(this).removeClass('erro');
	})

	$('button').click(function(){
	
	
	$('button').attr('disabled', 'disabled');
	
	setTimeout(function(){
		$('button').removeAttr('disabled');
	}, 4000);
	
	$('.alvo').hide();

		if($('input[type=text]').val() == ''){
			$('input[type=text]').addClass('erro');
			$('.msg').fadeIn('slow').addClass('erro').html('<?php echo"$language_26"; ?>').delay(3000).fadeOut('slow');
			exit();
		}else if($('input[type=password]').val() == ''){
			$('input[type=password]').addClass('erro');
			$('.msg').fadeIn('slow').addClass('erro').html('<?php echo"$language_27"; ?>').delay(3000).fadeOut('slow');
			exit();			
		}else{
		
		$.post('painel/validacao.php', {login: $('input[type=text]').val(), senha: $('input[type=password]').val(), ip: '<?php echo $_SERVER['REMOTE_ADDR']; ?>'}, function(data){
			$('.alvo').fadeIn('slow').html(data).delay(3000);
		});
				
		}
		
		$('.loading').fadeIn('slow').delay(3000);
	});
	
	$('.loading').ajaxStop(function(){
		$('.loading').hide();
	});
});

};
$(function(){
		$('#total_votos').load('painel/count.php');
});
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<div class="corpo-topo">
 <div id="server">
<div id="total_votos"></div>
  </div>
<div id="vote"></div>
<div id="logo"></div>
 <div id="login-box">
           <div class="center-login"<?php if(!file_exists("config/connect_config.php")){ echo" style='background-image:url(images/bg_votesystem.gif);'"; } ?>>
             <div class="formulario" align="center">
			 <?php if(!file_exists("config/connect_config.php")){
			 if(file_exists("instalacao.php")){ include('instalacao.php'); }else{ echo"$language_34"; }
			 }else{ if(isset($_SESSION["UsuarioLogin"])){
			 include('painel/index.php'); }else{ ?>
			   <form class="row six columns" action="javascript:logar();" method="post">
               <table width="194" border="0">
                 <tr>
                   <td width="43" height="41"><?php echo"$language_19"; ?></td>
                   <td width="141"><input type="text" name="usuario" maxlength="16" autocomplete="off"></td>
                 </tr>
                 <tr>
                   <td height="45"><?php echo"$language_20"; ?></td>
                   <td><input type="password" name="senha" maxlength="16" autocomplete="off"></td>
                 </tr>
                 <tr>
                   <td height="44">&nbsp;</td>
                   <td><button style="margin-top: -5px;" class="button secondary"><?php echo"$language_21"; ?></button></td>
                 </tr>
			   </table>
			   </form>
			 <?php } } ?>
             </div>
			 <div class="msg"></div>
			 <div class="alvo"></div>
			 <div class='loading'><img src="images/ajax-loader.gif"><br /><?php echo"$language_28"; ?></div>
           </div>
         </div>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/pt_BR/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class="fb-like-box-back">
<div class="fb-like-box" data-href="https://www.facebook.com/pages/ICP-Networks-Design-Desenvolvimentos-web/250350185072159" data-width="578" data-height="85" data-colorscheme="dark" data-show-faces="false" data-border-color="#666" data-stream="true" data-header="false"></div></div>
<div id="creditos">
<br />
<table id="creditos" width="630" border="0" align="center" cellpadding="10" cellspacing="0">
  <tr>
    <td width="525"><?php echo"$language_62"; ?> <a href="http://icpnetworks.com.br" title="ICP Networks - Designer Gráfico e Desenvolvimentos web" target="new" id='0'>ICP Networks</a> - <?php echo"$language_63"; ?></td>
    <td width="30"><a href="http://icpnetworks.com.br" target="new"><img src="images/secure.png" alt="Site 100% seguro!" width="30" height="30" border="0"></a></td>
    <td width="104"><a href="http://icpnetworks.com.br" target="new"><img src="images/rodape_icon.png" alt="Desenvolvido por: ICP Networks" width="105" height="50" border="0"></a></td>
  </tr>
</table>
<table id="creditos2" width="700" border="0" align="center" cellpadding="10" cellspacing="0">
  <tr>
    <td width="525"><strong><?php echo"$language_64"; ?></strong> <?php echo"$language_65"; ?> <a href="http://icpnetworks.com.br" title="ICP Networks - Designer Gráfico e Desenvolvimentos web" target="new" id='1'>ICP Networks</a><br></td>
    </tr>
</table>
</div>
</div>

</body>
</html>