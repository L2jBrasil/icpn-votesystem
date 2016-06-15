<?php
function getUserIP()
{
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }
    //Votos feitos no localhost não serão capturados
    //Apenas IP reais serão possíveis ser analizados.
    if(in_array($ip, array('::1','127.0.0.1'),true)){
        $ip = '191.240.225.129'; 
    }
    return $ip;
}


if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
  $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_X_FORWARDED_FOR"];
}
 
if (isset($_SERVER["HTTP_CLIENT_IP"])) {
  $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CLIENT_IP"];
}
 
 
if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
  $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
}


// Correção acesso top l2jbrasil

function checkOnline($domain) {
   $ch = curl_init($domain);
   curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,10);
   curl_setopt($ch,CURLOPT_HEADER,true);
   curl_setopt($ch,CURLOPT_NOBODY,false);
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
   curl_setopt($ch,CURLOPT_USERAGENT,$_SERVER['HTTP_USER_AGENT'] );
   curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

   //get answer
   
   $response = curl_exec($ch);
   curl_close($ch);
   if ($response) return true;
   return false;
}

function acessoSimples($url, &$info = null, $get= array() , $post=array(), $timeout = 10) {
	  $ch = curl_init();
	  curl_setopt_array($ch, array(
	    CURLOPT_CONNECTTIMEOUT => $timeout ,
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_URL => $url,
		CURLOPT_USERAGENT => $_SERVER['HTTP_USER_AGENT'] 
	));
	  
	  
   /*curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,10);
   curl_setopt($ch,CURLOPT_HEADER,true);
   curl_setopt($ch,CURLOPT_NOBODY,false);
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
   curl_setopt($ch,CURLOPT_USERAGENT,$_SERVER['HTTP_USER_AGENT'] );
   curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
   curl_setopt($ch,CURLOPT_URL,$url);*/
   //get answer
   
   $response = curl_exec($ch);
   // Then, after your curl_exec call:
	$header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
	$header = substr($response, 0, $header_size);
	$body = substr($response, $header_size);
   $info = curl_getinfo($ch);
   curl_close($ch);
   
   return $response;
}
