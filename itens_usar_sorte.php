<?php include_once("fun_anti_inj.php") ?>
<?php include("verificar_cookie.php") ?>
<?php include("conexao.php") ?>
<?php include("verificar_conexao.php") ?>
<?php
$q = anti_inj($_POST['q']);

if (!$q) {
	header("Location: index.php"); break;
}

if (ereg('[^0-9]',$q)) {
	header("Location: index.php"); break;
}

if (strlen($q) > 4) {
	header("Location: index.php"); break;
}

if ($q < 1 or $q > 1000) {
	header("Location: index.php"); break;
}

$query = mysql_query("SELECT ID, Sorte, Item_Sorte FROM Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$rs = mysql_fetch_array($query);

$mc_id = $rs["ID"];
$mc_sorte = $rs["Sorte"];
$mc_item_sorte = $rs["Item_Sorte"];

if ($q > $mc_item_sorte) {
	header("Location: itens.php?msg_itens=1"); break;
}

if ($mc_sorte >= 1000) {
	header("Location: itens.php?msg_itens=3"); break;
}

if ($mc_sorte + $q > 1000) {
	$q = 1000 - $mc_sorte;
}

mysql_query("UPDATE Usuarios SET Sorte = Sorte + '". $q ."', Item_Sorte = Item_Sorte - '". $q ."' WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");

mysql_query("DELETE FROM Historico WHERE Usuario = '". $mc_id ."' AND Tipo = 11");

$acao = "usou uma quantidade de Sorte.";

mysql_query("INSERT INTO Historico (Usuario,Tipo,Acao) VALUES ('". $mc_id ."',11,'". $acao ."')");

header("Location: itens.php?msg_itens=2"); break;
?>