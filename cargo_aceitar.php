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

$query = mysql_query("SELECT ID, Time FROM Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$rs = mysql_fetch_array($query);

$mc_id = $rs["ID"];
$mc_time = $rs["Time"];

$query = mysql_query("SELECT Cargo FROM Cargos WHERE Usuario = '". $mc_id ."' AND Time = '". $mc_time ."' AND ID = '". $id ."'");
$rs = mysql_fetch_array($query);

if (!$rs) {
	header("Location: index.php"); break;
}

$cargo_funcao = $rs["Cargo"];

$query = mysql_query("SELECT Time FROM Times WHERE ID = '". $mc_time ."'");
$rs = mysql_fetch_array($query);

$mc_time_nome = $rs["Time"];

if ($cargo_funcao == 1) {
	$acao = "aceitou o cargo de Diretor do <a href=time.php?id=". $mc_time ."><b>". $mc_time_nome ."</b></a>.";
	mysql_query("UPDATE Times SET Diretor = '". $mc_id ."' WHERE ID = '". $mc_time ."'");
} else if ($cargo_funcao == 2) {
	$acao = "aceitou o cargo de Olheiro do <a href=time.php?id=". $mc_time ."><b>". $mc_time_nome ."</b></a>.";
	mysql_query("UPDATE Times SET Olheiro_1 = '". $mc_id ."' WHERE ID = '". $mc_time ."'");
} else if ($cargo_funcao == 3) {
	$acao = "aceitou o cargo de Olheiro do <a href=time.php?id=". $mc_time ."><b>". $mc_time_nome ."</b></a>.";
	mysql_query("UPDATE Times SET Olheiro_2 = '". $mc_id ."' WHERE ID = '". $mc_time ."'");
} else if ($cargo_funcao == 4) {
	$acao = "aceitou o cargo de Olheiro do <a href=time.php?id=". $mc_time ."><b>". $mc_time_nome ."</b></a>.";
	mysql_query("UPDATE Times SET Olheiro_3 = '". $mc_id ."' WHERE ID = '". $mc_time ."'");
}

mysql_query("INSERT INTO Historico (Usuario,Tipo,Acao) VALUES ('". $mc_id ."',2,'". $acao ."')");

mysql_query("DELETE FROM Propostas WHERE Usuario = '". $mc_id ."'");

mysql_query("DELETE FROM Renovacoes WHERE Usuario = '". $mc_id ."'");

mysql_query("DELETE FROM Cargos WHERE Usuario = '". $mc_id ."'");

header("Location: inicio.php"); break;
?>