<?php include("fun_anti_inj.php") ?>
<?php include("conexao.php") ?>
<?php include("verificar_conexao.php") ?>
<?php
$email = anti_inj(strtolower($_POST['email']));
$senha = anti_inj($_POST['senha']);
$nome = anti_inj($_POST['nome']);

if ($email == "" or $nome == "") {
	header("Location: alterar_dados.php"); break;
}

$query = mysql_query("SELECT ID FROM Administradores WHERE ID_Cod = password('". $_COOKIE["admid"] ."')");
$rs = mysql_fetch_array($query);

$id = $rs["ID"];

$query = mysql_query("SELECT ID FROM Administradores WHERE Email = '". $email ."' AND ID <> '". $id ."'");
$rs = mysql_fetch_array($query);

if ($rs) {
	header("Location: alterar_dados.php?msg=2"); break;
}

if ($senha != "") {
	mysql_query("UPDATE Administradores SET Senha = password('". $senha ."') WHERE ID = '". $id ."'");
}

mysql_query("UPDATE Administradores SET Email = '". $email ."', Nome = '". $nome ."' WHERE ID = '". $id ."'");

header("Location: alterar_dados.php?msg=1"); break;
?>