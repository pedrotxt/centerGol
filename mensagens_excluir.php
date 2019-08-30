<?php include_once("fun_anti_inj.php") ?>
<?php include("verificar_cookie.php") ?>
<?php include("conexao.php") ?>
<?php include("verificar_conexao.php") ?>
<?php
if (!$_POST["mensagens_selecao"]) {
	header("Location: mensagens.php"); break;
}

$query = mysql_query("SELECT ID FROM Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$rs = mysql_fetch_array($query);

$mc_id = $rs["ID"];

foreach($_POST["mensagens_selecao"] as $mensagens_selecao) {
	mysql_query("DELETE FROM Mensagens_Usuario WHERE Para = '". $mc_id ."' AND ID = '". $mensagens_selecao ."'");
}

header("Location: mensagens.php"); break;
?>