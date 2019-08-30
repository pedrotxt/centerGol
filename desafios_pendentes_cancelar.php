<?php include_once("fun_anti_inj.php") ?>
<?php include("verificar_cookie.php") ?>
<?php include("conexao.php") ?>
<?php include("verificar_conexao.php") ?>
<?php
$id = anti_inj($_GET['id']);

if (!$id) {
	header("Location: index.php"); break;
}

if (ereg('[^0-9]',$id)) {
	header("Location: index.php"); break;
}

$query = mysql_query("SELECT ID FROM Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$rs = mysql_fetch_array($query);

$mc_id = $rs["ID"];

$query = mysql_query("SELECT Aposta FROM Desafios WHERE ID = ". $id ." AND Usuario_1 = '". $mc_id ."'");
$rs = mysql_fetch_array($query);

if (!rs) {
	header("Location: index.php"); break;
}

$desafio_aposta = $rs["Aposta"];

mysql_query("DELETE FROM Desafios WHERE ID = '". $id ."'");

mysql_query("UPDATE Usuarios SET Dinheiro = Dinheiro + '". $desafio_aposta ."' WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");

header("Location: desafios_pendentes.php"); break;
?>