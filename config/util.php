<?php
function getUserIP()
{
	
	//Check to see if the CF-Connecting-IP header exists.
	if(isset($_SERVER["HTTP_CF_CONNECTING_IP"])){
		//If it does, assume that PHP app is behind Cloudflare.
		$ipAddress = $_SERVER["HTTP_CF_CONNECTING_IP"];
	} else{
		//Otherwise, use REMOTE_ADDR.
		$ipAddress = $_SERVER['REMOTE_ADDR'];
	}

	return $ipAddress;
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
   curl_setopt($ch,CURLOPT_DNS_SERVERS,"1.1.1.1");	
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
