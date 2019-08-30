<?php include("fun_anti_inj.php") ?>
<?php include("verificar_cookie.php") ?>
<?php include("conexao.php") ?>
<?php include("verificar_conexao.php") ?>
<?php
$id = anti_inj($_GET['id']);
$mensagem = anti_inj($_POST['mensagem']);

if (!$id or !$mensagem) {
	header("Location: index.php"); break;
}

if (ereg('[^0-9]',$id)) {
	header("Location: index.php"); break;
}

if (strlen($mensagem) > 200) {
	header("Location: index.php"); break;
}

$query = mysql_query("SELECT ID, Dinheiro FROM Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$rs = mysql_fetch_array($query);

$mc_id = $rs["ID"];
$mc_dinheiro = $rs["Dinheiro"];

if ($id == $mc_id) {
	header("Location: index.php"); break;
}

if ($mc_dinheiro < 50) {
	header("Location: mensagem_erro.php?id=".$id); break;
}

mysql_query("UPDATE Usuarios SET Dinheiro = Dinheiro - 50 WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");

$data = date("d/m");
$hora = date("H:i");

mysql_query("INSERT INTO Mensagens_Usuario (Usuario,Para,Mensagem,Data,Hora) VALUES ('". $mc_id ."','". $id ."','". $mensagem ."','". $data ."','". $hora ."')");

header("Location: mensagem_sucesso.php?id=".$id); break;
?>