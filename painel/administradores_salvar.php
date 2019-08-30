<?php include("fun_anti_inj.php") ?>
<?php include("conexao.php") ?>
<?php include("verificar_conexao.php") ?>
<?php
$email = anti_inj(strtolower($_POST['email']));
$senha = anti_inj($_POST['senha']);
$nome = anti_inj($_POST['nome']);
$cargo = anti_inj($_POST['cargo']);

if ($email == "" or $senha == "" or $nome == "" or $cargo == "") {
	header("Location: usuarios.php"); break;
}

$query = mysql_query("SELECT ID FROM Administradores WHERE Email = '". $email ."'");
$rs = mysql_fetch_array($query);

if ($rs) {
	header("Location: administradores.php?msg=2"); break;
}

mysql_query("INSERT INTO Administradores (Email,Senha,Nome,Cargo) VALUES ('". $email ."',password('". $senha ."'),'". $nome ."','". $cargo ."')");

header("Location: administradores.php?msg=1"); break;
?>