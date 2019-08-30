<?php include("fun_anti_inj.php") ?>
<?php include("conexao.php") ?>
<?php include("verificar_conexao.php") ?>
<?php
$id = anti_inj($_GET['id']);

if (!$id) {
	header("Location: times.php"); break;
}

if (ereg('[^0-9]',$id)) {
	header("Location: times.php"); break;
}

if ($id < 1) {
	header("Location: times.php"); break;
}

mysql_query("UPDATE Times SET Presidente = 0, Diretor = 0, Olheiro_1 = 0, Olheiro_2 = 0, Olheiro_3 = 0 WHERE ID = '". $id ."'");

header("Location: time.php?id=$id&msg=2"); break;
?>