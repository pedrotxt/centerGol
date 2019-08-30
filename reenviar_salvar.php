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
	header("Location: reenviar.php?msg_reenviar=2"); break;
}

if ($rs["Confirmar"] == "0") {
	header("Location: reenviar.php?msg_reenviar=3"); break;
}

$id = $rs["ID"];
$cod = $rs["Confirmar"];

$headers = "MIME-Version: 1.0 \n";
$headers .= "Content-type: text/html; charset=iso-8859-1 \n";
$headers .= "From: centergol <sistema@centergol.kinghost.net> \n";

$assunto = "cadastro do centergol";

$corpo = "<font face= 'Verdana, Arial, Helvetica, sans-serif' size = '2' color = '#009933'>";
$corpo .= "<b>Obrigado por se cadastrar no maior e melhor site de futebol online do Brasil.</b><br><br>";
$corpo .= "<b>Para confirmar seu cadastro no centergol, clique no endereço abaixo:</b><br><br>";
$corpo .= "<a href='http://www.centergol.kinghost.net/confirmar.php?id=". $id ."&cod=". $cod ."' target='_blank'>http://centergol.com//confirmar.php?id=". $id ."&cod=". $cod ."</a><br><br>";
$corpo .= "<b>Aproveite e participe da página do jogo no Facebook e acompanhe as novidades:</b><br><br>";
$corpo .= "<a href='http://www.facebook.com/futclubebr' target='_blank'>http://www.facebook.com/futclubebr</a>";
$corpo .= "</font>";

mail($email,$assunto,$corpo,$headers);
	
header("Location: reenviar.php?msg_reenviar=1"); break;
?>