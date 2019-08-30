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
	mysql_query("DELETE FROM Cargos WHERE Time = '". $mc_time ."' AND Cargo = 2");
} else if ($id == 2) {
	mysql_query("DELETE FROM Cargos WHERE Time = '". $mc_time ."' AND Cargo = 3");
} else if ($id == 3) {
	mysql_query("DELETE FROM Cargos WHERE Time = '". $mc_time ."' AND Cargo = 4");
}

header("Location: painel_cupula.php"); break;
?>