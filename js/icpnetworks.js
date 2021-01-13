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

function adm(){
	$(function(){
		$.post('links.php?icp=adm', {}, function(data){
			$('.formulario').html(data).show();
		});
		$('.loading').fadeIn('slow').delay(3000);
	});
};
function user(){
	$(function(){
		$.post('links.php?icp=home', {}, function(data){
			$('.formulario').html(data).show();
		});
		$('.loading').fadeIn('slow').delay(3000);
	});
	$('.loading').ajaxStop(function(){
		$('.loading').hide();
	});
};
function instalar(){
	$('button[id=50]').attr('disabled', 'disabled');
	setTimeout(function(){
		$('button[id=50]').removeAttr('disabled');
	}, 4000);
	$.post('links.php?icp=instalacao', {
		ip_db: $('input[id=2]').val(),
		user_db: $('input[id=3]').val(),
		pass_db: $('input[id=4]').val(),
		name_db: $('input[id=5]').val(),
		admins: $('input[id=6]').val(),
		db_type: $('input[name=6]:checked').val(),
		l2jruss: $('input[id=russ]').is(':checked'),
		install: 'install',
		pagina: "#|======================================================================|#\n#|  ## ####### #######                                                  |#\n#|  ## ##      ##   ##                                                  |#\n#|  ## ##      ## ####  |)  | |¯¯¯ ¯¯|¯¯ |     | |¯¯¯| |¯¯¯| | ) |¯¯¯|  |#\n#|  ## ##      ##       | | | |--    |    ) . (  | | | | |_| |<   ¯|_   |#\n#|  ## ####### ##       |  (| |___   |     V V   |___| | | ) | ) |___|  |#\n#| -------------------------------------------------------------------- |#\n#|      Brazillian Developer / WebSite: http://www.icpfree.com.br       |#\n#|                Email & Skype: ivan1507@gmail.com.br                  |#\n#|======================================================================|#\n\n$db_data = 'db_type';\n$L2jVersaoRussa = l2jruss;\n$db_ip = 'ipx';\n$db_name = 'name_dbx';\n$db_user = 'user_dbx';\n$db_pass = 'pass_dbx';\n$cached_port = 2012;\n\ninclude('connection.php');\n\n$configuracoes = $conn->prepare('SELECT * FROM icp_votesystem_config');\n$configuracoes->execute();\n$config = $configuracoes->fetch(PDO::FETCH_ASSOC);\n\nif($config){\n	$admins = $config['admins'];\n	$moeda_voto = $config['moeda_voto'];\n	$qtd_moeda_voto = $config['qtd_moeda_voto'];\n	$deposito_loc = $config['deposito'];\n	$mostra_votos = $config['votos'];\n}"
	}, function(data){
		$('.formulario').html(data).show();
	});
	$('.loading').fadeIn('slow');
};
function edit(){
	$('button').attr('disabled', 'disabled');
	setTimeout(function(){
		$('button').removeAttr('disabled');
	}, 4000);
	$.post('links.php?icp=adm', {
		buttons: $("input[name='buttons[]']").map(function(){return $(this).val();}).get(),
		token: $("input[name='token[]']").map(function(){return $(this).val();}).get(),
		id: $("input[name='id[]']").map(function(){return $(this).val();}).get(),
		coins: $("input[name='coins[]']").map(function(){return $(this).val();}).get(),
		qtd_coins: $("input[name='qtd_coins[]']").map(function(){return $(this).val();}).get(),
		deposito: $('select[id=1]').val(),
		voto: $('select[id=38]').val(),
		admins: $('input[id=6]').val(),
		edit: 'edit'
	}, function(data){
		$('.formulario').html(data).show();
	});
	$('#total_votos').load('links.php?icp=count');
	$('.loading').fadeIn('slow').delay(3000);
};
function trocar(){
	$('button').attr('disabled', 'disabled');
	setTimeout(function(){
		$('button').removeAttr('disabled');
	}, 4000);
	$.post('links.php?icp=home', {verificar: 'verificar'}, function(data){
		$('.formulario').html(data).show();
	});
	$('.verify').fadeIn('slow').delay(5000);
};
function logar(){
	$('button[id=1]').attr('disabled', 'disabled');
	setTimeout(function(){
		$('button[id=1]').removeAttr('disabled');
	}, 4000);
	$(function(){
		$.post('links.php?icp=validacao', { logar: 'logar', login: $('input[id=7]').val(), senha: $('input[id=8]').val() }, function(data){
			$('.alvo').fadeIn('slow').html(data);
		});
	});
	$('.loading').fadeIn('slow');
};
function receber(){
	$('button').attr('disabled', 'disabled');
	setTimeout(function(){
		$('button').removeAttr('disabled');
	}, 4000);
	$.post('links.php?icp=home', {trocar: 'trocar', char: $('select[id=1]').val()}, function(data){
		$('.formulario').html(data).show();
	});
	$('.loading').fadeIn('slow').delay(5000);
};
function atualizaContador(id1, ano1, mes1, dia1, hora1, min1, seg1){
	$(function(){
		setInterval(function(){
			var hoje = new Date();
			var futuro = new Date(ano1,mes1-1,dia1,hora1,min1,seg1);
			var ss = parseInt((futuro - hoje) / 1000);
			var mm = parseInt(ss / 60);
			var hh = parseInt(mm / 60);
			var dd = parseInt(hh / 24);
			ss = ss - (mm * 60);
			mm = mm - (hh * 60);
			hh = hh - (dd * 24);
			var hora = (hh && hh >= 10) ? hh+':' : ((hh<10 && hh>0) ? '0'+hh+':' : '00:');
			var min = (mm && mm >= 10) ? mm+':' : ((mm<10 && mm>0) ? '0'+mm+':' : '00:');
			var seg = (ss && ss >= 10) ? ss : (ss<10 ? '0'+ss : '00');
			var faltam = hora+min+seg;
			if (faltam > '00:00:00') {
				$("#contador"+id1).html(faltam);
			} else {
				document.getElementById('contador' + id1).innerHTML = 'Vote!';
			}
		},1000);
	});
}
function SetCookie(cookieName) {
	var today = new Date();
	var expire = new Date();
	var click = new Date();
	var nHours = 12;
	expire.setTime(today.getTime() + 3600000*nHours);
	click.setTime(today.getTime() - 10800000);
	document.cookie = cookieName + "=" + click.toGMTString() + ";expires=" + expire.toGMTString();
}
$(function(){
	$('#total_votos').load('links.php?icp=count');
	$('.loading').ajaxStop(function(){
		$('.loading').hide();
	});
	$('.verify').ajaxStop(function(){
		$('.verify').hide();
	});
});