<?php include("fun_anti_inj.php") ?>
<?php include("verificar_cookie.php") ?>
<?php include("conexao.php") ?>
<?php
$email = anti_inj(strtolower($_POST['email']));
$senha = anti_inj($_POST['senha']);
$mc_ip = $_SERVER["REMOTE_ADDR"];

if (!$email or !$senha) {
	header("Location: login.php"); break;
}

$query = mysql_query("SELECT ID FROM Administradores WHERE Email = '". $email ."' AND Senha = password('". $senha ."')");
$rs = mysql_fetch_array($query);

if ($rs) {

$mc_id = $rs["ID"];

} else {
	header("Location: login.php?msg=1"); break;
}

$cod_estrutura = $email ."". date("Y-m-d H:i:s");
$cod = md5($cod_estrutura);

mysql_query("UPDATE Administradores SET ID_Cod = password('". $cod ."'), Ultimo_Acesso = '". date("Y-m-d H:i:s") ."', IP = '". $mc_ip ."' WHERE ID = '". $mc_id ."'");

setcookie("admid", $cod, time()+31536000); 

header("Location: index.php"); break;
?>