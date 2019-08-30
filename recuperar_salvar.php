<?php include("fun_ .php") ?>
<?php include("verificar_cookie.php") ?>
<?php include("conexao.php") ?>
<?php
$email =  (strtolower($_POST['email']));

if (!$email) {
	header("Location: index.php"); break;
}

$query = mysql_query("SELECT ID, Confirmar FROM Usuarios WHERE Email = '". $email ."'");
$rs = mysql_fetch_array($query);

if (!$rs) {
	header("Location: recuperar.php?msg_recuperar=2"); break;
}

if ($rs["Confirmar"] != "0") {
	header("Location: recuperar.php?msg_recuperar=3"); break;
}

$id = $rs["ID"];
$cod = md5(date("Y-m-d H:i:s"));

mysql_query("UPDATE Usuarios SET Recuperar = '". $cod ."' WHERE Email = '". $email ."'");


$headers = "MIME-Version: 1.0 \n";
$headers .= "Content-type: text/html; charset=iso-8859-1 \n";
$headers .= "From: centergol <no-reply@centergol.com> \n";

$assunto = "Recuperar Senha do centergol";

$corpo = "<font face= 'Verdana, Arial, Helvetica, sans-serif' size = '2' color = '#009933'>";
$corpo .= "<b>Para recadastrar sua senha no centergol, clique no endereço abaixo:</b><br><br>";
$corpo .= "<a href='http://www.centergol.com/recadastrar.php?id=". $id ."&cod=". $cod ."' target='_blank'>http://www.centergol.com/recadastrar.php?id=". $id ."&cod=". $cod ."</a><br><br>";
$corpo .= "<b>Aproveite e participe da página do jogo no Facebook e acompanhe as novidades:</b><br><br>";
$corpo .= "<a href='http://www.facebook.com/centergolbr' target='_blank'>http://www.facebook.com/centergolbr</a>";
$corpo .= "</font>";

mail($email,$assunto,$corpo,$headers);

header("Location: recuperar.php?msg_recuperar=1"); break;
?>