<?php include_once("fun_anti_inj.php") ?>
<?php include("verificar_cookie.php") ?>
<?php include("conexao.php") ?>
<?php
if ($_COOKIE["usuarioid"]) {
	header("Location: index.php"); break;
}

$id = anti_inj($_POST['id']);
$cod = anti_inj($_POST['cod']);
$senha = anti_inj($_POST['senha']);

if (!$id or !$cod or $cod == "0" or !$senha) {
	header("Location: index.php"); break;
}

if (ereg('[^0-9]',$id)) {
	header("Location: index.php"); break;
}

if (!ctype_alnum($cod)) {
	header("Location: index.php"); break;
}

$query = mysql_query("SELECT ID FROM Usuarios WHERE ID = '". $id ."' AND Recuperar = '". $cod ."'");
$rs = mysql_fetch_array($query);

if (!$rs) {
	header("Location: index.php"); break;
}

mysql_query("UPDATE Usuarios SET Senha = password('". $senha ."'), Recuperar = 0 WHERE ID = '". $id ."'");

header("Location: recadastrar_sucesso.php"); break;
?>