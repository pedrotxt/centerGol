<?php include("fun_anti_inj.php") ?>
<?php include("conexao.php") ?>
<?php include("verificar_conexao.php") ?>
<?php
$id = anti_inj($_GET['id']);

if (!$id) {
	header("Location: administradores.php"); break;
}

if (ereg('[^0-9]',$id)) {
	header("Location: administradores.php"); break;
}

if ($id < 1) {
	header("Location: administradores.php"); break;
}

if ($id == 1) {
	header("Location: administradores.php"); break;
}

mysql_query("DELETE FROM Administradores WHERE ID = '". $id ."'");

header("Location: administradores.php"); break;
?>