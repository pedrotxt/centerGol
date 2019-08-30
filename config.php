<?php
	
	session_start();
	
	$connect=mysql_connect("localhost","dbzuo257_fut","123456a");
	$db=mysql_select_db("dbzuo257_futclube",$connect);
	
	if(isset($_COOKIE["usuarioid"]))
		
$user=mysql_fetch_array(mysql_query("select * from Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')"));
	
	