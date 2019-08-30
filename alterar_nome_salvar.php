<?php include_once("fun_anti_inj.php") ?>
<?php include("verificar_cookie.php") ?>
<?php include("conexao.php") ?>
<?php include("verificar_conexao.php") ?>
<?php
$usuario = anti_inj($_POST['usuario']);

if (strlen($usuario) < 2 or strlen($usuario) > 15) {
	header("Location: index.php"); break;
}

if (!ctype_alnum($usuario)) {
    header("Location: alterar_nome.php?msg_alterar=2"); break;
}

$custo = 300;

$query = mysql_query("SELECT ID, Usuario, Dinheiro FROM Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$rs = mysql_fetch_array($query);

$mc_id = $rs["ID"];
$mc_usuario = $rs["Usuario"];
$mc_dinheiro = $rs["Dinheiro"];

if (strtolower($usuario) == strtolower($mc_usuario)) {
	header("Location: alterar_nome.php?msg_alterar=3"); break;
}

$query = mysql_query("SELECT ID FROM Usuarios WHERE Usuario = '". $usuario ."'");
$rs = mysql_fetch_array($query);

if ($rs) {
	header("Location: alterar_nome.php?msg_alterar=4"); break;
}

if ($mc_dinheiro < $custo) {
	header("Location: alterar_nome.php?msg_alterar=5"); break;
}

mysql_query("UPDATE Usuarios SET Usuario = '". $usuario ."', Dinheiro = Dinheiro - '". $custo ."' WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");

mysql_query("DELETE FROM Historico WHERE Usuario = '". $mc_id ."' AND Tipo = 3");

$acao = "alterou o nome. Antigo era <b>". $mc_usuario ."</b>.";

mysql_query("INSERT INTO Historico (Usuario,Tipo,Acao) VALUES ('". $mc_id ."',3,'". $acao ."')");

header("Location: alterar_nome.php?msg_alterar=1"); break;
?>