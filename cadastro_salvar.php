<?php include_once("fun_anti_inj.php") ?>
<?php include("verificar_cookie.php") ?>
<?php include("conexao.php") ?>
<?php
$convite = addslashes(anti_inj($_POST['convite']));
$email = addslashes(anti_inj(strtolower($_POST['email'])));
$senha = addslashes(anti_inj($_POST['senha']));
$usuario = addslashes(anti_inj($_POST['usuario']));
$sexo = addslashes(anti_inj($_POST['sexo']));
$time = addslashes(anti_inj($_POST['time']));
$camisa = addslashes(anti_inj($_POST['camisa']));
$ip = $_SERVER["REMOTE_ADDR"];

if (!$email or !$senha or !$usuario or !$sexo or !$time or !$camisa) {
	header("Location: index.php"); break;
}

if (strlen($email) > 50) {
	header("Location: index.php"); break;
}

if (strlen($senha) > 12) {
	header("Location: index.php"); break;
}

if ($sexo != 1 and $sexo != 2) {
	header("Location: index.php"); break;
}

if (ereg('[^0-9]',$time)) {
	header("Location: index.php"); break;
}

if ($time < 1 or $time > 80) {
	header("Location: index.php"); break;
}

if ($camisa != 1 and $camisa != 2 and $camisa != 3 and $camisa != 4 and $camisa != 5 and $camisa != 6 and $camisa != 7 and $camisa != 8 and $camisa != 9 and $camisa != 10 and $camisa != 11) {
	header("Location: index.php"); break;
}

if ($convite) {

$query = mysql_query("SELECT ID FROM Usuarios WHERE ID = '". $convite ."'");
$rs = mysql_fetch_array($query);

if (!$rs) {
	header("Location: index.php"); break;
}

} else {
	$convite = 0;
}

$query = mysql_query("SELECT ID FROM Usuarios WHERE Email = '". $email ."'");
$rs = mysql_fetch_array($query);

if ($rs) {

if ($convite != 0) {
	header("Location: cadastro.php?id=". $convite ."&msg_cadastro=1"); break;
} else {
	header("Location: cadastro.php?msg_cadastro=1"); break;
}

}

if (strlen($usuario) < 2 or strlen($usuario) > 15) {
	header("Location: index.php"); break;
}

if (!ctype_alnum($usuario)) {

if ($convite != 0) {
	header("Location: cadastro.php?id=". $convite ."&msg_cadastro=2"); break;
} else {
	header("Location: cadastro.php?msg_cadastro=2"); break;
}

}

$usuario_nome = strtolower($usuario);

$query = mysql_query("SELECT ID FROM Usuarios WHERE Usuario = '". $usuario_nome ."'");
$rs = mysql_fetch_array($query);

if ($rs) {

if ($convite != 0) {
	header("Location: cadastro.php?id=". $convite ."&msg_cadastro=3"); break;
} else {
	header("Location: cadastro.php?msg_cadastro=3"); break;
}

}

$cod = md5(date("Y-m-d H:i:s"));

mysql_query("INSERT INTO Usuarios (Email,Senha,Usuario,Sexo,Time,Camisa,Convite,Cadastro,Ultimo_Acesso,IP,Confirmar,VIP_Tempo) VALUES ('". $email ."',password('". $senha ."'),'". $usuario ."','". $sexo ."','". $time ."','". $camisa ."','". $convite ."','". date("Y-m-d H:i:s") ."','". date("Y-m-d H:i:s") ."','". $ip ."','". $cod ."','".(time()+2*86400)."')");

$query = mysql_query("SELECT ID FROM Usuarios WHERE Email = '". $email ."'");
$rs = mysql_fetch_array($query);

$id = $rs["ID"];


$headers = "MIME-Version: 1.0 \n";
$headers .= "Content-type: text/html; charset=iso-8859-1 \n";
$headers .= "From: Cadastro centergol <ligacampeoes@centergol.com.br> \n";

$assunto = "Confirme seu Cadastro no centergol";

$corpo = "<font face= 'Verdana, Arial, Helvetica, sans-serif' size = '2' color = '#009933'>";
$corpo .= "<b>Obrigado por se cadastrar no maior e melhor site de futebol online do Brasil.</b><br><br>";
$corpo .= "<b>Para confirmar seu cadastro no centergol, clique no endereço abaixo:</b><br><br>";
$corpo .= "<a href='http://centergol.com/confirmar.php?id=". $id ."&cod=". $cod ."' target='_blank'>http://centergol.com/confirmar.php?id=". $id ."&cod=". $cod ."</a><br><br>";
$corpo .= "<b>Aproveite e participe da página no Facebook e acompanhe as novidades:
 https://www.facebook.com/LigaCampeoesOnline</b><br><br>";
$corpo .= "</font>";

mail($email,$assunto,$corpo,$headers);

header("Location: cadastro_sucesso.php"); break;
?>