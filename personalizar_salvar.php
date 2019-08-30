<?php include_once("fun_anti_inj.php") ?>
<?php include("verificar_cookie.php") ?>
<?php include("conexao.php") ?>
<?php include("verificar_conexao.php") ?>
<?php
$vip_cor = anti_inj($_POST['vip_cor']);
$fundo = anti_inj($_POST['fundo']);

if (!$vip_cor or !$fundo) {
	header("Location: index.php"); break;
}

if (ereg('[^0-9]',$vip_cor)) {
	header("Location: index.php"); break;
}
if (ereg('[^0-9]',$fundo)) {
	header("Location: index.php"); break;
}

if ($vip_cor < 1 or $vip_cor > 8) {
	header("Location: index.php"); break;
}

if ($fundo < 1 or $fundo > 9) {
	header("Location: index.php"); break;
}

$query = mysql_query("SELECT ID FROM Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$rs = mysql_fetch_array($query);

$mc_id = $rs["ID"];

mysql_query("UPDATE Usuarios SET VIP_Cor = '". $vip_cor ."', Fundo = '". $fundo ."' WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");

mysql_query("DELETE FROM Historico WHERE Usuario = '". $mc_id ."' AND Tipo = 6");

$acao = "personalizou o jogo.";

mysql_query("INSERT INTO Historico (Usuario,Tipo,Acao) VALUES ('". $mc_id ."',6,'". $acao ."')");

header("Location: personalizar.php?msg_personalizar=1"); break;
?>