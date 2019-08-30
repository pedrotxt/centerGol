<?php include_once("fun_anti_inj.php") ?>
<?php include("verificar_cookie.php") ?>
<?php include("conexao.php") ?>
<?php include("verificar_conexao.php") ?>
<?php
if (!$_POST["amigos_selecao"]) {
	header("Location: amigos.php"); break;
}

$query = mysql_query("SELECT ID FROM Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$rs = mysql_fetch_array($query);

$mc_id = $rs["ID"];

foreach($_POST["amigos_selecao"] as $amigos_selecao) {
	mysql_query("DELETE FROM Amigos WHERE Usuario = '". $mc_id ."' AND Amigo = '". $amigos_selecao ."'");
}

header("Location: amigos.php"); break;
?>