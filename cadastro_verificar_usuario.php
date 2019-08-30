<?php include_once("fun_anti_inj.php") ?>
<?php include("verificar_cookie.php") ?>
<?php include("conexao.php") ?>
<?php
header("Content-Type: text/html; charset=ISO-8859-1",true);

$usuario = anti_inj($_GET['usuario']);

if (strlen($usuario) < 2 or strlen($usuario) > 15) {
	header("Location: index.php"); break;
}

if (!ctype_alnum($usuario)) {
    $verificar = 1;
}

if ($verificar != 1) {

$query = mysql_query("SELECT ID FROM Usuarios WHERE Usuario = '". $usuario ."'");
$rs = mysql_fetch_array($query);

if ($rs) {
	$verificar = 2;
} else {
	$verificar = 3;
}

}
?>
<?php if ($verificar == 1) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Preencha o nome somente com letras e números!</div>

<?php } else if ($verificar == 2) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Esse nome não pode ser usado!</div>

<?php } else if ($verificar == 3) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_sim.png"></span> Esse nome pode ser usado!</div>

<?php } ?>