<?php include("fun_anti_inj.php") ?>
<?php include("verificar_cookie.php") ?>
<?php include("conexao.php") ?>
<?php
header("Content-Type: text/html; charset=ISO-8859-1",true);

$email = anti_inj(strtolower($_GET['email']));

$query = mysql_query("SELECT ID FROM Usuarios WHERE Email = '". $email ."'");
$rs = mysql_fetch_array($query);

if ($rs) {
	$verificar = 1;
} else {
	$verificar = 0;
}
?>
<?php if ($verificar == 1) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="../figuras/painel/alerta_nao.png"></span> Esse email não pode ser usado!</div>

<?php } else if ($verificar == 0) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="../figuras/painel/alerta_sim.png"></span> Esse email pode ser usado!</div>

<?php } ?>