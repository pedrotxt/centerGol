<?php
if (!$_COOKIE["admid"]) {
	header("Location: login.php"); break;
}

$query = mysql_query("SELECT ID FROM Administradores WHERE ID_Cod = password('". $_COOKIE["admid"] ."')");
$ver_con = mysql_fetch_array($query);

if (!$ver_con) {
	header("Location: logout.php"); break;
}
?>