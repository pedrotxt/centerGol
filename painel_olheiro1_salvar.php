<?php include_once("fun_anti_inj.php") ?>
<?php include("verificar_cookie.php") ?>
<?php include("conexao.php") ?>
<?php include("verificar_conexao.php") ?>
<?php include("verificar_cargo.php") ?>
<?php
if ($eu_presidente == 0) {
	header("Location: index.php"); break;
}

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

if ($id == $mc_id) {
	header("Location: index.php"); break;
}

$mc_time = $rs["Time"];

$query = mysql_query("SELECT Diretor, Olheiro_1, Olheiro_2, Olheiro_3 FROM Times WHERE ID = '". $mc_time ."'");
$rs = mysql_fetch_array($query);

$diretor = $rs["Diretor"];
$olheiro_1 = $rs["Olheiro_1"];
$olheiro_2 = $rs["Olheiro_2"];
$olheiro_3 = $rs["Olheiro_3"];

if ($olheiro_1 != 0) {
	header("Location: index.php"); break;
}

$query = mysql_query("SELECT Usuario FROM Cargos WHERE Time = '". $mc_time ."' AND Cargo = 1");
$rs = mysql_fetch_array($query);

if ($rs) {
	$diretor_pendente = $rs["Usuario"];
}

$query = mysql_query("SELECT Usuario FROM Cargos WHERE Time = '". $mc_time ."' AND Cargo = 2");
$rs = mysql_fetch_array($query);

if ($rs) {
	$olheiro_1_pendente = $rs["Usuario"];
}

$query = mysql_query("SELECT Usuario FROM Cargos WHERE Time = '". $mc_time ."' AND Cargo = 3");
$rs = mysql_fetch_array($query);

if ($rs) {
	$olheiro_2_pendente = $rs["Usuario"];
}

$query = mysql_query("SELECT Usuario FROM Cargos WHERE Time = '". $mc_time ."' AND Cargo = 4");
$rs = mysql_fetch_array($query);

if ($rs) {
	$olheiro_3_pendente = $rs["Usuario"];
}

if ($olheiro_1_pendente) {
	header("Location: index.php"); break;
}

$query = mysql_query("SELECT Time FROM Usuarios WHERE ID = '". $id ."'");
$rs = mysql_fetch_array($query);

$usuario_time = $rs["Time"];

if ($usuario_time != $mc_time) {
	header("Location: index.php"); break;
}

if ($id == $diretor or $id == $olheiro_1 or $id == $olheiro_2 or $id == $olheiro_3) {
	header("Location: painel_olheiro1.php?msg_cupula=1"); break;
}

if ($id == $diretor_pendente or $id == $olheiro_1_pendente or $id == $olheiro_2_pendente or $id == $olheiro_3_pendente) {
	header("Location: painel_olheiro1.php?msg_cupula=1"); break;
}

$data = date("d/m");

mysql_query("INSERT INTO Cargos (Time,De,Usuario,Data,Cargo) VALUES ('". $mc_time ."','". $mc_id ."','". $id ."','". $data ."',2)");

header("Location: painel_cupula.php"); break;
?>