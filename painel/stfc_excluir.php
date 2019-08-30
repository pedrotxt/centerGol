<?php include("fun_anti_inj.php") ?>
<?php include("conexao.php") ?>
<?php include("verificar_conexao.php") ?>
<?php
if (!$_POST["stfc_selecao"]) {
	header("Location: stfc.php"); break;
}

foreach($_POST["stfc_selecao"] as $stfc_selecao) {
	mysql_query("DELETE FROM STFC WHERE ID = '". $stfc_selecao ."'");
}

header("Location: stfc.php"); break;
?>