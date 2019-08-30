<?php include_once("fun_anti_inj.php") ?>
<?php include("verificar_cookie.php") ?>
<?php include("conexao.php") ?>
<?php include("verificar_conexao.php") ?>
<?php
$query = mysql_query("SELECT ID, VIP_Tempo, Item_Veneno, Secar FROM Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$rs = mysql_fetch_array($query);

$mc_id = $rs["ID"];
$mc_vip = $rs["VIP_Tempo"];
$mc_item_veneno = $rs["Item_Veneno"];
$mc_secar = $rs["Secar"];

if ($mc_vip < time()) {
	header("Location: itens.php?msg_itens=5"); break;
}

if ($mc_item_veneno == 0) {
	header("Location: itens.php?msg_itens=1"); break;
}

if ($mc_secar == 0) {
	header("Location: itens.php?msg_itens=11"); break;
}

mysql_query("UPDATE Usuarios SET Veneno = 1, Item_Veneno = Item_Veneno - 1, Veneno_Tempo = '". date("Y-m-d H:i:s", strtotime("+1 day")) ."' WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");

mysql_query("DELETE FROM Historico WHERE Usuario = '". $mc_id ."' AND Tipo = 8");

$acao = "está usando Veneno.";

mysql_query("INSERT INTO Historico (Usuario,Tipo,Acao) VALUES ('". $mc_id ."',8,'". $acao ."')");

header("Location: itens.php?msg_itens=10"); break;
?>