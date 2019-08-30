<?php include_once("fun_anti_inj.php") ?>
<?php include("verificar_cookie.php") ?>
<?php include("conexao.php") ?>
<?php include("verificar_conexao.php") ?>
<?php
$query = mysql_query("SELECT ID FROM Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$rs = mysql_fetch_array($query);

$mc_id = $rs["ID"];

mysql_query("UPDATE Usuarios SET Secar = 0, Secar_Gols = 0 WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");

mysql_query("DELETE FROM Historico WHERE Usuario = '". $mc_id ."' AND Tipo = 4");

$acao = "deixou de Secar um time.";

mysql_query("INSERT INTO Historico (Usuario,Tipo,Acao) VALUES ('". $mc_id ."',4,'". $acao ."')");

header("Location: inicio.php"); break;
?>