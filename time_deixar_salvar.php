<?php include_once("fun_anti_inj.php") ?>
<?php include("verificar_cookie.php") ?>
<?php include("conexao.php") ?>
<?php include("verificar_conexao.php") ?>
<?php include("verificar_cargo.php") ?>
<?php
$id = anti_inj($_POST['id']);

if (!$id) {
	header("Location: index.php"); break;
}

if (ereg('[^0-9]',$id)) {
	header("Location: index.php"); break;
}

if ($id < 1 or $id > 60) {
	header("Location: index.php"); break;
}

if ($eu_presidente != 1 and $eu_diretor != 1 and $eu_olheiro != 1) {
	header("Location: index.php"); break;
}

$query = mysql_query("SELECT ID, Time FROM Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$rs = mysql_fetch_array($query);

$mc_id = $rs["ID"];
$mc_time = $rs["Time"];

$query = mysql_query("SELECT Time, Presidente, Diretor, Olheiro_1, Olheiro_2, Olheiro_3 FROM Times WHERE ID = '". $mc_time ."'");
$rs = mysql_fetch_array($query);

$time_nome = $rs["Time"];
$time_presidente = $rs["Presidente"];
$time_diretor = $rs["Diretor"];
$time_olheiro_1 = $rs["Olheiro_1"];
$time_olheiro_2 = $rs["Olheiro_2"];
$time_olheiro_3 = $rs["Olheiro_3"];

$data = date("d/m");
$hora = date("H:i");

if ($time_presidente == $mc_id) {

$mensagem = "Presidente do time deixou o cargo. A cúpula foi removida.";

if ($time_diretor != 0) {
	mysql_query("INSERT INTO Mensagens_Usuario (Usuario,Para,Mensagem,Data,Hora) VALUES (0,'". $time_diretor ."','". $mensagem ."','". $data ."','". $hora ."')");
}

if ($time_olheiro_1 != 0) {
	mysql_query("INSERT INTO Mensagens_Usuario (Usuario,Para,Mensagem,Data,Hora) VALUES (0,'". $time_olheiro_1 ."','". $mensagem ."','". $data ."','". $hora ."')");
}

if ($time_olheiro_2 != 0) {
	mysql_query("INSERT INTO Mensagens_Usuario (Usuario,Para,Mensagem,Data,Hora) VALUES (0,'". $time_olheiro_2 ."','". $mensagem ."','". $data ."','". $hora ."')");
}

if ($time_olheiro_3 != 0) {
	mysql_query("INSERT INTO Mensagens_Usuario (Usuario,Para,Mensagem,Data,Hora) VALUES (0,'". $time_olheiro_3 ."','". $mensagem ."','". $data ."','". $hora ."')");
}

$acao = "deixou de ser Presidente do <a href=time.php?id=". $mc_time ."><b>". $time_nome ."</b></a>.";

mysql_query("INSERT INTO Historico (Usuario,Tipo,Acao) VALUES ('". $mc_id ."',10,'". $acao ."')");

mysql_query("UPDATE Times SET Presidente = 0, Diretor = 0, Olheiro_1 = 0, Olheiro_2 = 0, Olheiro_3 = 0 WHERE ID = '". $mc_time ."'");

mysql_query("DELETE FROM Propostas WHERE Time = '". $mc_time ."'");

mysql_query("DELETE FROM Renovacoes WHERE Time = '". $mc_time ."'");

mysql_query("DELETE FROM Cargos WHERE Time = '". $mc_time ."'");

} else if ($time_diretor == $mc_id) {

$mensagem = "Diretor do time deixou o cargo.";

mysql_query("INSERT INTO Mensagens_Usuario (Usuario,Para,Mensagem,Data,Hora) VALUES (0,'". $time_presidente ."','". $mensagem ."','". $data ."','". $hora ."')");

if ($time_olheiro_1 != 0) {
	mysql_query("INSERT INTO Mensagens_Usuario (Usuario,Para,Mensagem,Data,Hora) VALUES (0,'". $time_olheiro_1 ."','". $mensagem ."','". $data ."','". $hora ."')");
}

if ($time_olheiro_2 != 0) {
	mysql_query("INSERT INTO Mensagens_Usuario (Usuario,Para,Mensagem,Data,Hora) VALUES (0,'". $time_olheiro_2 ."','". $mensagem ."','". $data ."','". $hora ."')");
}

if ($time_olheiro_3 != 0) {
	mysql_query("INSERT INTO Mensagens_Usuario (Usuario,Para,Mensagem,Data,Hora) VALUES (0,'". $time_olheiro_3 ."','". $mensagem ."','". $data ."','". $hora ."')");
}

$acao = "deixou de ser Diretor do <a href=time.php?id=". $mc_time ."><b>". $time_nome ."</b></a>.";

mysql_query("INSERT INTO Historico (Usuario,Tipo,Acao) VALUES ('". $mc_id ."',10,'". $acao ."')");

mysql_query("UPDATE Times SET Diretor = 0 WHERE ID = '". $mc_time ."'");

} else if ($time_olheiro_1 == $mc_id) {

$mensagem = "Olheiro do time deixou o cargo.";

mysql_query("INSERT INTO Mensagens_Usuario (Usuario,Para,Mensagem,Data,Hora) VALUES (0,'". $time_presidente ."','". $mensagem ."','". $data ."','". $hora ."')");

if ($time_diretor != 0) {
	mysql_query("INSERT INTO Mensagens_Usuario (Usuario,Para,Mensagem,Data,Hora) VALUES (0,'". $time_diretor ."','". $mensagem ."','". $data ."','". $hora ."')");
}

if ($time_olheiro_2 != 0) {
	mysql_query("INSERT INTO Mensagens_Usuario (Usuario,Para,Mensagem,Data,Hora) VALUES (0,'". $time_olheiro_2 ."','". $mensagem ."','". $data ."','". $hora ."')");
}

if ($time_olheiro_3 != 0) {
	mysql_query("INSERT INTO Mensagens_Usuario (Usuario,Para,Mensagem,Data,Hora) VALUES (0,'". $time_olheiro_3 ."','". $mensagem ."','". $data ."','". $hora ."')");
}

$acao = "deixou de ser Olheiro do <a href=time.php?id=". $mc_time ."><b>". $time_nome ."</b></a>.";

mysql_query("INSERT INTO Historico (Usuario,Tipo,Acao) VALUES ('". $mc_id ."',10,'". $acao ."')");

mysql_query("UPDATE Times SET Olheiro_1 = 0 WHERE ID = '". $mc_time ."'");

} else if ($time_olheiro_2 == $mc_id) {

$mensagem = "Olheiro do time deixou o cargo.";

mysql_query("INSERT INTO Mensagens_Usuario (Usuario,Para,Mensagem,Data,Hora) VALUES (0,'". $time_presidente ."','". $mensagem ."','". $data ."','". $hora ."')");

if ($time_diretor != 0) {
	mysql_query("INSERT INTO Mensagens_Usuario (Usuario,Para,Mensagem,Data,Hora) VALUES (0,'". $time_diretor ."','". $mensagem ."','". $data ."','". $hora ."')");
}

if ($time_olheiro_1 != 0) {
	mysql_query("INSERT INTO Mensagens_Usuario (Usuario,Para,Mensagem,Data,Hora) VALUES (0,'". $time_olheiro_1 ."','". $mensagem ."','". $data ."','". $hora ."')");
}

if ($time_olheiro_3 != 0) {
	mysql_query("INSERT INTO Mensagens_Usuario (Usuario,Para,Mensagem,Data,Hora) VALUES (0,'". $time_olheiro_3 ."','". $mensagem ."','". $data ."','". $hora ."')");
}

$acao = "deixou de ser Olheiro do <a href=time.php?id=". $mc_time ."><b>". $time_nome ."</b></a>.";

mysql_query("INSERT INTO Historico (Usuario,Tipo,Acao) VALUES ('". $mc_id ."',10,'". $acao ."')");

mysql_query("UPDATE Times SET Olheiro_2 = 0 WHERE ID = '". $mc_time ."'");

} else if ($time_olheiro_3 == $mc_id) {

$mensagem = "Olheiro do time deixou o cargo.";

mysql_query("INSERT INTO Mensagens_Usuario (Usuario,Para,Mensagem,Data,Hora) VALUES (0,'". $time_presidente ."','". $mensagem ."','". $data ."','". $hora ."')");

if ($time_diretor != 0) {
	mysql_query("INSERT INTO Mensagens_Usuario (Usuario,Para,Mensagem,Data,Hora) VALUES (0,'". $time_diretor ."','". $mensagem ."','". $data ."','". $hora ."')");
}

if ($time_olheiro_1 != 0) {
	mysql_query("INSERT INTO Mensagens_Usuario (Usuario,Para,Mensagem,Data,Hora) VALUES (0,'". $time_olheiro_1 ."','". $mensagem ."','". $data ."','". $hora ."')");
}

if ($time_olheiro_2 != 0) {
	mysql_query("INSERT INTO Mensagens_Usuario (Usuario,Para,Mensagem,Data,Hora) VALUES (0,'". $time_olheiro_2 ."','". $mensagem ."','". $data ."','". $hora ."')");
}

$acao = "deixou de ser Olheiro do <a href=time.php?id=". $mc_time ."><b>". $time_nome ."</b></a>.";

mysql_query("INSERT INTO Historico (Usuario,Tipo,Acao) VALUES ('". $mc_id ."',10,'". $acao ."')");

mysql_query("UPDATE Times SET Olheiro_3 = 0 WHERE ID = '". $mc_time ."'");

}

header("Location: inicio.php"); break;
?>