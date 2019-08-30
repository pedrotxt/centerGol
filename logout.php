<?php include_once("fun_anti_inj.php") ?>
<?php include("verificar_cookie.php") ?>
<?php include("conexao.php") ?>
<?php
if ($_COOKIE["usuarioid"]) {
	$query = mysql_query("UPDATE Usuarios SET Status = 0 WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
}

setcookie ("usuarioid", "", time()-3600);
setcookie ("mcnivel", "", time()-3600);
setcookie ("mcitens", "", time()-3600);

if (anti_inj($_GET["id"]) == 1) {
	header("Location: clones.php"); break;
} else {
	header("Location: index.php"); break;
}
?>