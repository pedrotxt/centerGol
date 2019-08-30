<?php
if (!$_COOKIE["usuarioid"]) {
	header("Location: index.php"); break;
}

$query = mysql_query("SELECT ID FROM Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$ver_con = mysql_fetch_array($query);

if (!$ver_con) {
	header("Location: logout.php"); break;
}
?>