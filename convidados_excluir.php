<?php include_once("fun_anti_inj.php") ?>
<?php include("verificar_cookie.php") ?>
<?php include("conexao.php") ?>
<?php include("verificar_conexao.php") ?>
<?php
if (!$_POST["convidados_selecao"]) {
	header("Location: convidados.php"); break;
}

$query = mysql_query("SELECT ID FROM Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$rs = mysql_fetch_array($query);

$mc_id = $rs["ID"];

foreach($_POST["convidados_selecao"] as $convidados_selecao) {
	mysql_query("UPDATE Usuarios SET Convite = 0 WHERE Convite = '". $mc_id ."' AND ID = '". $convidados_selecao ."'");
}

header("Location: convidados.php"); break;
?>