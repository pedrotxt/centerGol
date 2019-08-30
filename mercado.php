<?php ob_start(); ?>
<?php include_once("fun_anti_inj.php") ?>
<?php include("verificar_cookie.php") ?>
<?php include("conexao.php") ?>
<?php include("verificar_restrito.php") ?>
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


<script language="javascript">
function comprar(pid) {
	document.getElementById('mercado_comprar').innerHTML  = "<div class='box'><div class='topo_esquerdo'><div class='topo_direito'><div class='topo_meio'><h1>Aguarde</h1></div></div></div><div class='conteudo'><div id='linha10'><span class='img16'><img width='16' height='16' src='figuras/principal/icon_carregando.gif'></span> Carregando dados...</div></div><div class='baixo_esquerdo'><div class='baixo_direito'><div class='baixo_meio'></div></div></div></div>";
	ajaxGet('mercado_comprar.php?pid='+pid,"document.getElementById('mercado_comprar').innerHTML", false);
}
</script>

<?php
$id = anti_inj($_GET['id']);
$p = anti_inj($_GET['p']);

if (!$id) {
	header("Location: index.php"); break;
}

if (ereg('[^0-9]',$id)) {
	header("Location: index.php"); break;
}

if (ereg('[^0-9]',$p)) {
	header("Location: index.php"); break;
}

$query = mysql_query("SELECT Usuario, VIP, VIP_Cor, Mercado_Nome, Mercado_Texto, Mercado_Valor FROM Usuarios WHERE ID = '". $id ."'");
$rs = mysql_fetch_array($query);

$usuario_nome = $rs["Usuario"];
$usuario_vip = $rs["VIP"];
$usuario_vip_cor = $rs["VIP_Cor"];
$mercado_nome = $rs["Mercado_Nome"];
$mercado_texto = $rs["Mercado_Texto"];
$mercado_valor = $rs["Mercado_Valor"];

if ($id != $mc_id and $mercado_nome) {
	mysql_query("UPDATE Usuarios SET Mercado_Visitas = Mercado_Visitas + 1 WHERE ID = '". $id ."'");
}

if (!$mercado_nome) {
	$mercado_nome = "Sobre o Mercado";
}

$query = mysql_query("SELECT Count(ID) AS mercado_quantidade FROM Mercado WHERE Usuario = '". $id ."'");
$rs = mysql_fetch_array($query);

$mercado_quantidade = $rs["mercado_quantidade"];

ob_end_flush();
?>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Mercado</h1></div></div></div>
	<div class="conteudo">

<div id="linha10"><?php if ($p) { ?><a href="mercados.php?p=<?=$p?>"><img src="figuras/principal/botao_voltar.png" border="0"></a> <?php } ?><a href="meu_mercado.php"><img src="figuras/principal/botao_meu_mercado.png" border="0"></a></div>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<div id="divide"></div>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1><?=$mercado_nome?></h1></div></div></div>
	<div class="conteudo">

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/usuario.png" title="Usuário" alt="Usuário"></span> <a href="usuario.php?id=<?=$id?>"><? if ($usuario_vip > 0) { ?><span id="usuario_vip<?=$usuario_vip_cor?>"><?=$usuario_nome?></span><?php } else { ?><span id="usuario_normal"><?=$usuario_nome?></span><?php } ?></a></div>

<?php if ($mercado_texto) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/investimento.png" title="Investimento" alt="Investimento"></span> <?=number_format($mercado_valor,0,',','.')?></div>
<div id="linha10"><?=$mercado_texto?></div>

<?php } else { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Esse mercado ainda não foi criado.</div>

<?php } ?>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<?php if ($mercado_texto) { ?>

<div id="divide"></div>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Vendendo (<?=$mercado_quantidade?>)</h1></div></div></div>
	<div class="conteudo">

<?php if (anti_inj($_GET["msg_mercado"]) == 1) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_sim.png"></span> Ítem comprado com sucesso!</div>

<?php } else if (anti_inj($_GET["msg_mercado"]) == 2) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Você não tem dinheiro suficiente!</div>

<?php } else if (anti_inj($_GET["msg_mercado"]) == 3) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Esse usuário não tem essa quantidade no momento!</div>

<?php } else if (anti_inj($_GET["msg_mercado"]) == 4) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Você não pode comprar no seu mercado!</div>

<?php } ?>

<?php if ($mercado_quantidade > 0) { ?>

<div id="linha10">
<table width="550" cellpadding="0" cellspacing="0">
	<tr height="25" bgcolor="#B6B6B6">
		<td width="100" style="padding-left: 22px" class="fonte1_negrito">Ítem</td>
		<td width="150" class="fonte1_negrito" align="center">Valor</td>
		<td width="190" class="fonte1_negrito" align="center">Quantidade</td>
        <td width="110">&nbsp;</td>
	</tr>

<?php

$query = mysql_query("SELECT ID, Item, Quantidade, Valor FROM Mercado WHERE Usuario = '". $id ."' ORDER BY ID DESC LIMIT 10");

?>

<?php while ($rs = mysql_fetch_array($query)) { ?>

<?php
if ($rs["Item"] == 1) {
	$item_nome = "Sorte";
	$item_figura = "sorte";
} else if ($rs["Item"] == 2) {
	$item_nome = "Pedra";
	$item_figura = "pedra";
} else if ($rs["Item"] == 3) {
	$item_nome = "Energia";
	$item_figura = "energia";
} else if ($rs["Item"] == 4) {
	$item_nome = "Sacola";
	$item_figura = "sacola";
} else if ($rs["Item"] == 5) {
	$item_nome = "Veneno";
	$item_figura = "veneno";
} else if ($rs["Item"] == 6) {
	$item_nome = "Escudo";
	$item_figura = "escudo";
} else if ($rs["Item"] == 7) {
	$item_nome = "VIP";
	$item_figura = "usuario_vip";
}
?>

	<tr>
		<td style="padding-top: 5px"><span class="img16"><img width="16" height="16" src="figuras/principal/<?=$item_figura?>.png" title="<?=$item_nome?>" alt="<?=$item_nome?>"></span> <b><?=$item_nome?></b></td>
		<td style="padding-top: 5px" align="center"><?=number_format($rs["Valor"],0,',','.')?></td>
		<td style="padding-top: 5px" align="center"><?=number_format($rs["Quantidade"],0,',','.')?></td>
        <td style="padding-top: 5px"><a id="cursor" onClick="javascript:comprar(<?=$rs["ID"]?>);"><img src="figuras/principal/botao_comprar.png" title="Comprar" alt="Comprar" border="0"></a></td>
	</tr>

<?php } ?>

</table>
</div>

<?php } else { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Esse usuário não está vendendo nenhum ítem.</div>

<?php } ?>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<div id="divide"></div>

<div id="mercado_comprar"></div>

<?php } ?>


<!-- FIM DA PÁGINA -->
</div>
<div class="clear"></div>

</div>
<div id="baixo"><?php include("baixo.php") ?></div>
</div>
</body>
</html>