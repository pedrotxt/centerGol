<?php include("fun_ .php") ?>
<?php include("verificar_cookie.php") ?>
<?php include("conexao.php") ?>
<?php include("verificar_restrito.php") ?>
<?php
$assunto =  ($_POST['assunto']);
$denuncia =  ($_POST['denuncia']);

if (!$assunto or !$denuncia) {
	header("Location: index.php"); break;
}

if (strlen($denuncia) > 200) {
	header("Location: index.php"); break;
}

$query = mysql_query("SELECT ID FROM Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$rs = mysql_fetch_array($query);

$mc_id = $rs["ID"];

mysql_query("INSERT INTO stcg (Usuario,Assunto,Denuncia,Data) VALUES ('". $mc_id ."','". $assunto ."','". $denuncia ."','". date("Y-m-d") ."')");

header("Location: stcg.php?msg_stcg=1"); break;
?>