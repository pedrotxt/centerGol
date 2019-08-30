<?php include_once("fun_anti_inj.php") ?>
<?php include("verificar_cookie.php") ?>
<?php include("conexao.php") ?>
<?php include("verificar_conexao.php") ?>
<?php
$query = mysql_query("SELECT ID, Item_Escudo FROM Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$rs = mysql_fetch_array($query);

$mc_id = $rs["ID"];
$mc_item_escudo = $rs["Item_Escudo"];

if ($mc_item_escudo == 0) {
	header("Location: itens.php?msg_itens=1"); break;
}

mysql_query("UPDATE Usuarios SET Escudo = 1, Item_Escudo = Item_Escudo - 1, Escudo_Tempo = '". date("Y-m-d H:i:s", strtotime("+1 day")) ."' WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");

mysql_query("DELETE FROM Historico WHERE Usuario = '". $mc_id ."' AND Tipo = 10");

$acao = "está usando Escudo.";

mysql_query("INSERT INTO Historico (Usuario,Tipo,Acao) VALUES ('". $mc_id ."',10,'". $acao ."')");

header("Location: itens.php?msg_itens=13"); break;
?>