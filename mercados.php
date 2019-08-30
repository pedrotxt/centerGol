<?php ob_start(); ?>
<?php include_once("fun_anti_inj.php") ?>
<?php include("verificar_cookie.php") ?>
<?php include("conexao.php") ?>
<?php include("verificar_conexao.php") ?>
<!DOCTYPE html>
<html>
<?php include("head.php") ?>
<body>
<div id="container">
<div id="cima"><?php include("cima.php") ?></div>
<div id="conteudo">

<div id="esquerda"><?php include("esquerda.php") ?></div>
<div id="direita"><?php include("direita.php") ?></div>
<div id="principal">
<!-- INÍCIO DA PÁGINA -->


<?php
$p = anti_inj($_GET['p']);

if (ereg('[^0-9]',$p)) {
	header("Location: index.php"); break;
}

if (!$p) {
	$p = 1;
}

$limite = 10;
$inicio = $p - 1;
$inicio = $limite * $inicio;

$query = mysql_query("SELECT Count(ID) AS mercados_quantidade FROM Usuarios WHERE Mercado_Itens > 0");
$rs = mysql_fetch_array($query);

$mercados_quantidade = $rs["mercados_quantidade"];

$p_total = ceil($mercados_quantidade / $limite);

if ($p_total < 1) {
	$p_total = 1;
}

if ($p > $p_total) {
	header("Location: mercados.php?p=1"); break;
}

ob_end_flush();
?>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Mercados (<?=number_format($mercados_quantidade,0,',','.')?>)</h1></div></div></div>
	<div class="conteudo">

<div id="linha10"><a href="meu_mercado.php"><img src="figuras/principal/botao_meu_mercado.png" border="0"></a></div>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<?php if ($mercados_quantidade > 0) { ?>

<?php

$query = mysql_query("SELECT ID, Usuario, VIP, VIP_Cor, Mercado_Nome, Mercado_Texto, Mercado_Valor, Mercado_Itens FROM Usuarios WHERE Mercado_Itens > 0 ORDER BY Mercado_Valor DESC LIMIT $inicio,$limite");

?>

<?php while ($rs = mysql_fetch_array($query)) { ?>

<div id="divide"></div>

<div class="box_branco">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"></div></div></div>
	<div class="conteudo">

<table width="550" cellpadding="0" cellspacing="0">
	<tr>
		<td style="padding-top: 6px"><a href="mercado.php?id=<?=$rs["ID"]?>&p=<?=$p?>"><span class="img16"><img width="16" height="16" src="figuras/principal/mercado.png" title="Entrar" alt="Entrar"></span> <?=$rs["Mercado_Nome"]?></a></td>
	</tr>
	<tr>
		<td style="padding-top: 14px"><?=$rs["Mercado_Texto"]?></td>
	</tr>
 	<tr>
		<td style="padding-top: 14px; padding-bottom: 2px"><span class="img16"><img width="16" height="16" src="figuras/principal/usuario.png" title="Usuário" alt="Usuário"></span> <a href="usuario.php?id=<?=$rs["ID"]?>"><?php if ($rs["VIP"] > 0) { ?><span id="usuario_vip<?=$rs["VIP_Cor"]?>"><?=$rs["Usuario"]?></span><?php } else { ?><span id="usuario_normal"><?=$rs["Usuario"]?></span><?php } ?></a> <span class="img16" style="padding-left: 20px"><img width="16" height="16" src="figuras/principal/carrinho.png" title="Ítens" alt="Ítens"></span> <?=$rs["Mercado_Itens"]?> <span class="img16" style="padding-left: 20px"><img width="16" height="16" src="figuras/principal/investimento.png" title="Investimento" alt="Investimento"></span> <?=number_format($rs["Mercado_Valor"],0,',','.')?></td>
	</tr>
</table>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<?php } ?>

<?php
if ($mercados_quantidade > $limite) {
	$p_nome = "mercados";
	include("paginacao1.php");
}
?>

<?php } ?>


<!-- FIM DA PÁGINA -->
</div>
<div class="clear"></div>

</div>
<div id="baixo"><?php include("baixo.php") ?></div>
</div>
</body>
</html>