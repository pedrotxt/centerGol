<?php ob_start(); ?>
<?php include_once("fun_anti_inj.php") ?>
<?php include("verificar_cookie.php") ?>
<?php include("conexao.php") ?>
<?php include("verificar_conexao.php") ?>
<html>
<head>
</head>
<?php
$pid = anti_inj($_GET['pid']);

if (!$pid) {
	header("Location: index.php"); break;
}

if (ereg('[^0-9]',$pid)) {
	header("Location: index.php"); break;
}

$query = mysql_query("SELECT ID FROM Mercado WHERE ID = '". $pid ."'");
$rs = mysql_fetch_array($query);

if (!$rs) {
	$verificar = 1;
}

ob_end_flush();
?>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Confirme a Compra</h1></div></div></div>
	<div class="conteudo">

<?php if ($verificar == 1) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Esse &iacute;tem n&atilde;o existe mais.</div>

<?php } else { ?>

<form name="mercado_comprar" method="post" action="mercado_comprar_salvar.php">
<input name="pid" type="hidden" value="<?=$pid?>">

<div id="linha12"><input name="submit" type="image" src="figuras/principal/botao_confirmar.png"> <a href="inicio.php"><img src="figuras/principal/botao_cancelar.png" border="0"></a></div>
</form>

<?php } ?>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>