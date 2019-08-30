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

if ($id != 1 and $id != 2 and $id != 3) {
	header("Location: index.php"); break;
}

$query = mysql_query("SELECT Time FROM Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$rs = mysql_fetch_array($query);

$mc_time = $rs["Time"];

if ($id == 1) {
	mysql_query("UPDATE Times SET Olheiro_1 = 0 WHERE ID = '". $mc_time ."'");
} else if ($id == 2) {
	mysql_query("UPDATE Times SET Olheiro_2 = 0 WHERE ID = '". $mc_time ."'");
} else if ($id == 3) {
	mysql_query("UPDATE Times SET Olheiro_3 = 0 WHERE ID = '". $mc_time ."'");
}

header("Location: painel_cupula.php"); break;
?>