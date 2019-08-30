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

if ($id == $mc_id) {
	header("Location: index.php"); break;
}

$query = mysql_query("SELECT Count(ID) AS total_de_amigos FROM Amigos WHERE Usuario = '". $mc_id ."'");
$rs = mysql_fetch_array($query);

$total_de_amigos = $rs["total_de_amigos"];

if ($total_de_amigos >= 100) {
	header("Location: usuario.php?id=". $id ."&msg_amigo=1"); break;
}

$query = mysql_query("SELECT ID FROM Usuarios WHERE ID = '". $id ."'");
$rs = mysql_fetch_array($query);

if (!$rs) {
	header("Location: index.php"); break;
}

$query = mysql_query("SELECT ID FROM Amigos WHERE Usuario = '". $mc_id ."' AND Amigo = '". $id ."'");
$rs = mysql_fetch_array($query);

if (!$rs) {
	mysql_query("INSERT INTO Amigos (Usuario,Amigo,Ultimo_Acesso) VALUES ('". $mc_id ."','". $id ."','". date("Y-m-d H:i:s") ."')");
}

header("Location: usuario.php?id=". $id); break;
?>