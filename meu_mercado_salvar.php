<?php include_once("fun_anti_inj.php") ?>
<?php include("verificar_cookie.php") ?>
<?php include("conexao.php") ?>
<?php include("verificar_conexao.php") ?>
<?php
$nome = anti_inj($_POST['nome']);
$texto = anti_inj($_POST['texto']);
$investir = anti_inj($_POST['investir']);

if (!$nome or !$texto) {
	header("Location: index.php"); break;
}

if (strlen($nome) < 5) {
	header("Location: meu_mercado.php?msg_mercado=2"); break;
}

if (strlen($texto) < 10) {
	header("Location: meu_mercado.php?msg_mercado=3"); break;
}

if (ereg('[^0-9]',$investir)) {
	header("Location: meu_mercado.php?msg_mercado=4"); break;
}

if (strlen($investir) > 6) {
	header("Location: meu_mercado.php?msg_mercado=3"); break;
}

if ($investir != 0 and $investir < 100) {
	header("Location: meu_mercado.php?msg_mercado=5"); break;
}

if ($investir != 0) {

$query = mysql_query("SELECT Dinheiro FROM Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$rs = mysql_fetch_array($query);

$mc_dinheiro = $rs["Dinheiro"];

if ($investir > $mc_dinheiro) {
	header("Location: meu_mercado.php?msg_mercado=6"); break;
}

}

mysql_query("UPDATE Usuarios SET Dinheiro = Dinheiro - '". $investir ."', Mercado_Valor = Mercado_Valor + '". $investir ."', Mercado_Nome = '". $nome ."', Mercado_Texto = '". $texto ."' WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");

header("Location: meu_mercado.php?msg_mercado=1"); break;
?>