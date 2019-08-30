<?php include("fun_anti_inj.php") ?>
<?php include("conexao.php") ?>
<?php include("verificar_conexao.php") ?>
<?php
$mensagem = anti_inj($_POST['mensagem']);
$por = anti_inj($_POST['por']);
$data = anti_inj($_POST['data']);
$status = anti_inj($_POST['status']);

if ($mensagem == "" or $por == "" or $data == "" or $status == "") {
	header("Location: mensagem_global.php"); break;
}

mysql_query("UPDATE Mensagem_Global SET Mensagem = '". $mensagem ."', Por = '". $por ."', Data = '". $data ."', Status = '". $status ."'");

header("Location: mensagem_global.php?msg=1"); break;
?>