<?php include_once("fun_anti_inj.php") ?>
<?php include("verificar_cookie.php") ?>
<?php include("conexao.php") ?>
<?php include("verificar_conexao.php") ?>
<?php
$id = anti_inj($_GET['id']);

if (!$id) {
	header("Location: index.php"); break;
}

if (ereg('[^0-9]',$id)) {
	header("Location: index.php"); break;
}

$query = mysql_query("SELECT ID FROM Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$rs = mysql_fetch_array($query);

$mc_id = $rs["ID"];

$query = mysql_query("SELECT ID FROM Desafios WHERE ID = ". $id ." AND Usuario_2 = '". $mc_id ."'");
$rs = mysql_fetch_array($query);

if (!rs) {
	header("Location: index.php"); break;
}

$query = mysql_query("SELECT Usuarios.ID as Usuario_ID, Usuarios.Usuario as Usuario_Nome, Usuarios.VIP as Usuario_VIP, Usuarios.VIP_Cor as Usuario_VIP_Cor, Desafios.Aposta as Desafio_Aposta FROM Desafios INNER JOIN Usuarios ON Usuarios.ID = Desafios.Usuario_1 WHERE Desafios.ID = '". $id ."'");
$rs = mysql_fetch_array($query);

$usuario_id = $rs["Usuario_ID"];
$usuario_nome = $rs["Usuario_Nome"];
$usuario_vip = $rs["Usuario_VIP"];
$usuario_vip_cor = $rs["Usuario_VIP_Cor"];
$desafio_aposta = $rs["Desafio_Aposta"];

mysql_query("DELETE FROM Desafios WHERE ID = '". $id ."'");

if ($desafio_aposta != 0) {

$aposta_historico = number_format($desafio_aposta,0,',','.');

if ($usuario_vip > 0) {
	$acao = "recusou desafio de <span id=usuario_vip". $usuario_vip_cor ."><a href=usuario.php?id=". $usuario_id .">". $usuario_nome ."</a></span> de ". $aposta_historico .".";
} else {
	$acao = "recusou desafio de <span id=usuario_normal><a href=usuario.php?id=". $usuario_id .">". $usuario_nome ."</a></span> de ". $aposta_historico .".";
}

mysql_query("INSERT INTO Historico (Usuario,Tipo,Acao) VALUES ('". $mc_id ."',22,'". $acao ."')");

mysql_query("UPDATE Usuarios SET Desafio_Recusados = Desafio_Recusados + 1 WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");

mysql_query("UPDATE Usuarios SET Dinheiro = Dinheiro + '". $desafio_aposta ."' WHERE ID = '". $usuario_id ."'");

}

header("Location: desafios.php"); break;
?>