<?php include_once("fun_anti_inj.php") ?>
<?php include("verificar_cookie.php") ?>
<?php include("conexao.php") ?>
<?php include("verificar_conexao.php") ?>
<?php
$senha_atual = anti_inj($_POST['senha_atual']);
$senha_nova = anti_inj($_POST['senha_nova']);

if (strlen($senha_nova) > 12) {
	header("Location: index.php"); break;
}

if (strlen($senha_nova) < 4) {
	header("Location: alterar_senha.php?msg_alterar=4"); break;
}

$query = mysql_query("SELECT ID FROM Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."') AND Senha = password('". $senha_atual ."')");
$rs = mysql_fetch_array($query);

if (!$rs) {
	header("Location: alterar_senha.php?msg_alterar=2"); break;
}

if ($senha_atual == $senha_nova) {
	header("Location: alterar_senha.php?msg_alterar=3"); break;
}

mysql_query("UPDATE Usuarios SET Senha = password('". $senha_nova ."') WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");

header("Location: alterar_senha.php?msg_alterar=1"); break;
?>