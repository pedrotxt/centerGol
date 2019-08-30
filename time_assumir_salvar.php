<?php include("fun_ .php") ?>
<?php include("verificar_cookie.php") ?>
<?php include("conexao.php") ?>
<?php include("verificar_conexao.php") ?>
<?php
$id =  ($_POST['id']);

if (!$id) {
	header("Location: index.php"); break;
}

if (ereg('[^0-9]',$id)) {
	header("Location: index.php"); break;
}

if ($id < 1 or $id > 50) {
	header("Location: index.php"); break;
}

$query = mysql_query("SELECT ID, Time, vip FROM Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$rs = mysql_fetch_array($query);

$mc_id = $rs["ID"];
$mc_time = $rs["Time"];
$mc_vip = $rs["vip"];

if ($mc_time != $id) {
	header("Location: index.php"); break;
}

if ($mc_vip == 0) {
	header("Location: index.php"); break;
}

$query = mysql_query("SELECT Time, Presidente FROM Times WHERE ID = '". $id ."'");
$rs = mysql_fetch_array($query);

$time_nome = $rs["Time"];
$time_presidente = $rs["Presidente"];

if ($time_presidente != 0) {
	header("Location: index.php"); break;
}

mysql_query("UPDATE Times SET Presidente = '". $mc_id ."' WHERE ID = '". $id ."'");

$acao = "virou Presidente do <a href=time.php?id=". $id ."><b>". $time_nome ."</b></a>.";

mysql_query("INSERT INTO Historico (Usuario,Tipo,Acao) VALUES ('". $mc_id ."',10,'". $acao ."')");

mysql_query("DELETE FROM Propostas WHERE Usuario = '". $mc_id ."'");

mysql_query("DELETE FROM Renovacoes WHERE Usuario = '". $mc_id ."'");

mysql_query("DELETE FROM Cargos WHERE Usuario = '". $mc_id ."'");

header("Location: inicio.php"); break;
?>