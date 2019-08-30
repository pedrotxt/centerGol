<?php include_once("fun_anti_inj.php") ?>
<?php include("verificar_cookie.php") ?>
<?php include("conexao.php") ?>
<?php include("verificar_conexao.php") ?>
<?php
$item_id = anti_inj($_POST['item_id']);
$q = anti_inj($_POST['q']);
$valor = anti_inj($_POST['valor']);

if (!$item_id or !$q or !$valor) {
	header("Location: index.php"); break;
}

if (ereg('[^0-9]',$item_id)) {
	header("Location: index.php"); break;
}

if ($item_id != 1 and $item_id != 2 and $item_id != 3 and $item_id != 4 and $item_id != 5 and $item_id != 6 and $item_id != 7) {
	header("Location: index.php"); break;
}

if (ereg('[^0-9]',$q)) {
	header("Location: index.php"); break;
}

if ($q < 1) {
	header("Location: index.php"); break;
}

if (strlen($q) > 4) {
	header("Location: index.php"); break;
}

if (ereg('[^0-9]',$valor)) {
	header("Location: index.php"); break;
}

if (strlen($valor) > 6) {
	header("Location: index.php"); break;
}

$query = mysql_query("SELECT ID, Nivel, Item_Sorte, Item_Pedra, Item_Energia, Item_Sacola, Item_Veneno, Item_Escudo, VIP, Rescisao_Dias_VIP FROM Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$rs = mysql_fetch_array($query);

$mc_id = $rs["ID"];
$mc_nivel = $rs["Nivel"];
$mc_sorte = $rs["Item_Sorte"];
$mc_pedra = $rs["Item_Pedra"];
$mc_energia = $rs["Item_Energia"];
$mc_sacola = $rs["Item_Sacola"];
$mc_veneno = $rs["Item_Veneno"];
$mc_escudo = $rs["Item_Escudo"];
$mc_vip = $rs["VIP"] - 1;
$mc_vip_rescisao = $rs["Rescisao_Dias_VIP"];
$mc_vip_total = $mc_vip - $mc_vip_rescisao;

if ($mc_nivel < 15) {
	header("Location: meu_mercado.php?msg_add=5"); break;
}

$query = mysql_query("SELECT Count(ID) AS mercado_quantidade FROM Mercado WHERE Usuario = '". $mc_id ."'");
$rs = mysql_fetch_array($query);

$mercado_quantidade = $rs["mercado_quantidade"];

if ($mercado_quantidade >= 10) {
	header("Location: meu_mercado.php?msg_add=3"); break;
}

if ($item_id == 1 and $mc_sorte < $q) {
	header("Location: meu_mercado.php?msg_add=2"); break;
}

if ($item_id == 2 and $mc_pedra < $q) {
	header("Location: meu_mercado.php?msg_add=2"); break;
}

if ($item_id == 3 and $mc_energia < $q) {
	header("Location: meu_mercado.php?msg_add=2"); break;
}

if ($item_id == 4 and $mc_sacola < $q) {
	header("Location: meu_mercado.php?msg_add=2"); break;
}

if ($item_id == 5 and $mc_veneno < $q) {
	header("Location: meu_mercado.php?msg_add=2"); break;
}

if ($item_id == 6 and $mc_escudo < $q) {
	header("Location: meu_mercado.php?msg_add=2"); break;
}

if ($item_id == 7 and $mc_vip_total <= 0 or $item_id == 7 and $mc_vip_total < $q) {
	header("Location: meu_mercado.php?msg_add=2"); break;
}

mysql_query("INSERT INTO Mercado (Usuario,Item,Quantidade,Valor) VALUES ('". $mc_id ."','". $item_id ."','". $q ."','". $valor ."')");

mysql_query("UPDATE Usuarios SET Mercado_Itens = Mercado_Itens + 1 WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");

header("Location: meu_mercado.php?msg_add=1"); break;
?>