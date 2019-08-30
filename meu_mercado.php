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


<script language="javascript">
function somente_numeros(evt) {

var key_code = evt.keyCode  ? evt.keyCode  :
				evt.charCode ? evt.charCode :
				evt.which    ? evt.which    : void 0;

if (key_code == 8 ||  key_code == 9 ||  key_code == 13 || key_code == 48 ||  key_code == 49 ||  key_code == 50 ||  key_code == 51 ||  key_code == 52 ||  key_code == 53 ||  key_code == 54 ||  key_code == 55 ||  key_code == 56 ||  key_code == 57) { return true; }

return false;

}

function valida_alterar_mercado() {

if (document.alterar_mercado.nome.value=="") {
	alert("É necessário preencher o nome.");
	document.alterar_mercado.nome.focus();
	return false;
}

if (document.alterar_mercado.nome.value.length<5) {
	alert("É necessário preencher um nome maior.");
	document.alterar_mercado.nome.focus();
	return false;
}

if (document.alterar_mercado.texto.value=="") {
	alert("É necessário preencher a descrição.");
	document.alterar_mercado.texto.focus();
	return false;
}

if (document.alterar_mercado.texto.value.length<10) {
	alert("É necessário preencher uma descrição maior.");
	document.alterar_mercado.texto.focus();
	return false;
}

if (document.alterar_mercado.investir.value=="") {
	alert("É necessário preencher o investimento.");
	document.alterar_mercado.investir.focus();
	return false;
}

if (document.alterar_mercado.investir.value!=0 && document.alterar_mercado.investir.value<100) {
	alert("É necessário preencher um investimento maior.");
	document.alterar_mercado.investir.focus();
	return false;
}

}

function valida_mercado_add() {

if (document.adicionar_item.item_id.value==0) {
	alert("É necessário selecionar o ítem.");
	document.adicionar_item.item_id.focus();
	return false;
}

if (document.adicionar_item.q.value=="") {
	alert("É necessário preencher a quantidade.");
	document.adicionar_item.q.focus();
	return false;
}

if (document.adicionar_item.q.value==0) {
	alert("É necessário preencher uma quantidade maior.");
	document.adicionar_item.q.focus();
	return false;
}

if (document.adicionar_item.valor.value=="") {
	alert("É necessário preencher o valor.");
	document.adicionar_item.valor.focus();
	return false;
}

if (document.adicionar_item.valor.value<100) {
	alert("É necessário preencher um valor maior.");
	document.adicionar_item.valor.focus();
	return false;
}

}
</script>

<?php
$query = mysql_query("SELECT Mercado_Nome, Mercado_Texto, Mercado_Valor, Mercado_Visitas FROM Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$rs = mysql_fetch_array($query);

$mc_mercado_nome = $rs["Mercado_Nome"];
$mc_mercado_texto = $rs["Mercado_Texto"];
$mc_mercado_valor = $rs["Mercado_Valor"];
$mc_mercado_visitas = $rs["Mercado_Visitas"];

$query = mysql_query("SELECT Count(ID) AS mercado_quantidade FROM Mercado WHERE Usuario = '". $mc_id ."'");
$rs = mysql_fetch_array($query);

$mercado_quantidade = $rs["mercado_quantidade"];
?>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Meu Mercado</h1></div></div></div>
	<div class="conteudo">

<?php if (anti_inj($_GET["msg_mercado"]) == 1) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_sim.png"></span> Mercado alterado com sucesso!</div>

<?php } else if (anti_inj($_GET["msg_mercado"]) == 2) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Preencha o nome com no mínimo 5 caracteres!</div>

<?php } else if (anti_inj($_GET["msg_mercado"]) == 3) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Preencha a descrição com no mínimo 10 caracteres!</div>

<?php } else if (anti_inj($_GET["msg_mercado"]) == 4) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Preencha o investimento somente com números!</div>

<?php } else if (anti_inj($_GET["msg_mercado"]) == 5) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Investimento mínimo é de 100!</div>

<?php } else if (anti_inj($_GET["msg_mercado"]) == 6) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Você não tem dinheiro suficiente!</div>

<?php } ?>

<form name="alterar_mercado" method="post" action="meu_mercado_salvar.php" onSubmit="return valida_alterar_mercado()">

<div id="linha10"><span class="fonte_form">Qual o nome do mercado?</span> <span class="align_form"><input name="nome" type="text" maxlength="50" value="<?=$mc_mercado_nome?>" style="width: 200px; height: 20px"></span></div>

<div id="linha15"><span class="fonte_form">Qual o texto de descrição?</span> <span class="align_form"><input name="texto" type="text" maxlength="100" value="<?=$mc_mercado_texto?>" style="width: 200px; height: 20px"></span></div>

<div id="linha15"><span class="fonte_form">Quanto você quer investir?</span> <span class="align_form"><input name="investir" type="text" maxlength="6" value="0" style="width: 70px; height: 20px" onKeyPress="return somente_numeros(event);"></span></div>

<div id="linha15"><span class="fonte_form">Quanto você investiu:</span> <span class="align_form"><input name="valor" type="text" maxlength="6" value="<?=number_format($mc_mercado_valor,0,',','.')?>" style="width: 70px; height: 20px" disabled></span></div>

<div id="linha15"><span class="fonte_form">Quantas visitas você recebeu:</span> <span class="align_form"><input name="visitas" type="text" maxlength="6" value="<?=number_format($mc_mercado_visitas,0,',','.')?>" style="width: 70px; height: 20px" disabled></span></div>

<div id="linha12"><input name="submit" type="image" src="figuras/principal/botao_confirmar.png" onClick="return valida_alterar_mercado()"></div>
</form>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<div id="divide"></div>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Vendendo (<?=$mercado_quantidade?>)</h1></div></div></div>
	<div class="conteudo">

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

$query = mysql_query("SELECT ID, Item, Quantidade, Valor FROM Mercado WHERE Usuario = '". $mc_id ."' ORDER BY ID DESC LIMIT 10");

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
        <td style="padding-top: 5px"><a href="meu_mercado_excluir.php?id=<?=$rs["ID"]?>"><img src="figuras/principal/botao_excluir.png" title="Excluir" alt="Excluir" border="0"></a></td>
	</tr>

<?php } ?>

</table>
</div>

<?php } else { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Você não está vendendo nenhum ítem.</div>

<?php } ?>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<div id="divide"></div>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Adicionar Ítem</h1></div></div></div>
	<div class="conteudo">

<?php if ($mc_mercado_nome and $mc_mercado_texto) { ?>

<?php if (anti_inj($_GET["msg_add"]) == 1) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_sim.png"></span> Ítem adicionado com sucesso!</div>

<?php } else if (anti_inj($_GET["msg_add"]) == 2) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Você não tem essa quantidade!</div>

<?php } else if (anti_inj($_GET["msg_add"]) == 3) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Limite de ítens alcançado!</div>

<?php } else if (anti_inj($_GET["msg_add"]) == 4) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Preencha os valores somente com números!</div>

<?php } else if (anti_inj($_GET["msg_add"]) == 5) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Você precisa ser nível 15 para vender!</div>

<?php } ?>

<form name="adicionar_item" method="post" action="meu_mercado_add.php" onSubmit="return valida_mercado_add()">

<div id="linha10">
<span class="fonte_form">Qual o ítem?</span>
<span class="align_form">
<select name="item_id" style="width: 120px; height: 26px">
<option value="0"></option>
<option value="1">Sorte</option>
<option value="2">Pedra</option>
<option value="3">Energia</option>
<option value="4">Sacola</option>
<option value="5">Veneno</option>
<option value="6">Escudo</option>
<option value="7">VIP</option>
</select>
</span>
</div>

<div id="linha15"><span class="fonte_form">Qual a quantidade?</span> <span class="align_form"><input name="q" type="text" maxlength="4" value="1" style="width: 60px; height: 20px" onKeyPress="return somente_numeros(event);"></span></div>

<div id="linha15"><span class="fonte_form">Qual o valor total?</span> <span class="align_form"><input name="valor" type="text" maxlength="6" value="100" style="width: 60px; height: 20px" onKeyPress="return somente_numeros(event);"></span></div>

<div id="linha12"><input name="submit" type="image" src="figuras/principal/botao_confirmar.png" onClick="return valida_mercado_add()"></div>
</form>

<?php } else { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Para adicionar ítem, nomeie o seu mercado antes.</div>

<?php } ?>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<div id="divide"></div>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Importante</h1></div></div></div>
	<div class="conteudo">

<div id="linha10">Seu mercado só aparecerá para todos caso você esteja vendendo algum ítem.</div>
<div id="linha10">A ordem dos mercados é feita pelo investimento.</div>
<div id="linha10">Preencha o investimento, valor e quantidade somente com números.</div>
<div id="linha10">Você pode vender até 10 ítens por vez.</div>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>


<!-- FIM DA PÁGINA -->
</div>
<div class="clear"></div>

</div>
<div id="baixo"><?php include("baixo.php") ?></div>
</div>
</body>
</html>