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

if ($q < 1) {
	header("Location: index.php"); break;
}

$query = mysql_query("SELECT Dinheiro FROM Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$rs = mysql_fetch_array($query);

$mc_dinheiro = $rs["Dinheiro"];

$valor = 8000;
$valor_total = $q * $valor;

if ($valor_total > $mc_dinheiro) {
	header("Location: itens_comprar.php?msg_comprar=1"); break;
}

mysql_query("UPDATE Usuarios SET Dinheiro = Dinheiro - '". $valor_total ."', Item_Energia = Item_Energia + '". $q ."' WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");

header("Location: itens_comprar.php?msg_comprar=4"); break;
?>