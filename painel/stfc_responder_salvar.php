<?php include("fun_anti_inj.php") ?>
<?php include("conexao.php") ?>
<?php include("verificar_conexao.php") ?>
<?php
$id = anti_inj($_GET['id']);
$mensagem = anti_inj($_POST['mensagem']);

if (!$id or !$mensagem) {
	die();
}

if (ereg('[^0-9]',$id)) {
	die();
}

if (strlen($mensagem) > 200) {
	die();
}

$data = date("d/m");
$hora = date("H:i");

mysql_query("INSERT INTO Mensagens_Usuario (Usuario,Para,Mensagem,Data,Hora) VALUES (0,'". $id ."','". $mensagem ."','". $data ."','". $hora ."')");

header("Location: stfc_responder_sucesso.php?id=".$id); break;
?>