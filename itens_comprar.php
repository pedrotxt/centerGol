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

function valida_comprar_sorte() {

if (document.comprar_sorte.q.value=="") {
	alert("É necessário preencher a quantidade.");
	document.comprar_sorte.q.focus();
	return false;
}

if (document.comprar_sorte.q.value==0) {
	alert("É necessário preencher uma quantidade maior.");
	document.comprar_sorte.q.focus();
	return false;
}

}

function valida_comprar_energia() {

if (document.comprar_energia.q.value=="") {
	alert("É necessário preencher a quantidade.");
	document.comprar_energia.q.focus();
	return false;
}

if (document.comprar_energia.q.value==0) {
	alert("É necessário preencher uma quantidade maior.");
	document.comprar_energia.q.focus();
	return false;
}

}

function valida_comprar_veneno() {

if (document.comprar_veneno.q.value=="") {
	alert("É necessário preencher a quantidade.");
	document.comprar_veneno.q.focus();
	return false;
}

if (document.comprar_veneno.q.value==0) {
	alert("É necessário preencher uma quantidade maior.");
	document.comprar_veneno.q.focus();
	return false;
}

}

function valida_comprar_sacola() {

if (document.comprar_sacola.q.value=="") {
	alert("É necessário preencher a quantidade.");
	document.comprar_sacola.q.focus();
	return false;
}

if (document.comprar_sacola.q.value==0) {
	alert("É necessário preencher uma quantidade maior.");
	document.comprar_sacola.q.focus();
	return false;
}

}

function valida_comprar_pedra() {

if (document.comprar_pedra.q.value=="") {
	alert("É necessário preencher a quantidade.");
	document.comprar_pedra.q.focus();
	return false;
}

if (document.comprar_pedra.q.value==0) {
	alert("É necessário preencher uma quantidade maior.");
	document.comprar_pedra.q.focus();
	return false;
}

}

function valida_comprar_escudo() {

if (document.comprar_escudo.q.value=="") {
	alert("É necessário preencher a quantidade.");
	document.comprar_escudo.q.focus();
	return false;
}

if (document.comprar_escudo.q.value==0) {
	alert("É necessário preencher uma quantidade maior.");
	document.comprar_escudo.q.focus();
	return false;
}

}

itensinfo = 0;
</script>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Comprar Ítens</h1></div></div></div>
	<div class="conteudo">

<?php if (anti_inj($_GET["msg_comprar"]) == 1) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Você não tem dinheiro suficiente!</div>

<?php } else if (anti_inj($_GET["msg_comprar"]) == 2) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_sim.png"></span> Sorte comprada com sucesso!</div>

<?php } else if (anti_inj($_GET["msg_comprar"]) == 3) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_sim.png"></span> Pedra comprada com sucesso!</div>

<?php } else if (anti_inj($_GET["msg_comprar"]) == 4) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_sim.png"></span> Energia comprada com sucesso!</div>

<?php } else if (anti_inj($_GET["msg_comprar"]) == 5) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_sim.png"></span> Sacola comprada com sucesso!</div>

<?php } else if (anti_inj($_GET["msg_comprar"]) == 6) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_sim.png"></span> Veneno comprado com sucesso!</div>

<?php } else if (anti_inj($_GET["msg_comprar"]) == 7) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_sim.png"></span> Escudo comprado com sucesso!</div>

<?php }else if (anti_inj($_GET["msg_comprar"]) == 8) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_sim.png"></span> Dias P comprado com sucesso!</div>

<?php } ?>

<div id="linha10">
<table width="550" cellpadding="0" cellspacing="0">
	<tr height="25" bgcolor="#B6B6B6">
		<td width="100" style="padding-left: 22px" class="fonte1_negrito">Ítem</td>
		<td width="150" class="fonte1_negrito" align="center">Valor</td>
		<td width="190" class="fonte1_negrito" align="center">Quantidade</td>
        <td width="110">&nbsp;</td>
	</tr>

<form name="comprar_sorte" method="post" action="itens_comprar_sorte.php" onSubmit="return valida_comprar_sorte()">
	<tr>
		<td style="padding-top: 5px"><span class="img16"><img width="16" height="16" src="figuras/principal/sorte.png" title="Sorte" alt="Sorte"></span> <b>Sorte</b> <a href="#" class="balao"><span class="img16"><img width="16" height="16" src="figuras/principal/icon_sobre.png"></span><span class="balao" style="width: 201px">Ajuda seu acerto no Passe Certo.</span></a></td>
		<td style="padding-top: 5px" align="center">300</td>
		<td style="padding-top: 5px" align="center"><input name="q" type="text" maxlength="4" value="1" style="width: 40px; height: 20px; text-align: center" onKeyPress="return somente_numeros(event);"></td>
        <td style="padding-top: 5px"><input name="submit" type="image" src="figuras/principal/botao_comprar.png" onClick="return valida_comprar_sorte()"></td>
	</tr>
</form>

<form name="comprar_energia" method="post" action="itens_comprar_energia.php" onSubmit="return valida_comprar_energia()">
	<tr>
		<td style="padding-top: 5px"><span class="img16"><img width="16" height="16" src="figuras/principal/energia.png" title="Energia" alt="Energia"></span> <b>Energia</b> <a href="#" class="balao"><span class="img16"><img width="16" height="16" src="figuras/principal/icon_sobre.png"></span><span class="balao" style="width: 249px">Reduz 1 minuto no seu Tempo de Chute.</span></a></td>
		<td style="padding-top: 5px" align="center">8.000</td>
		<td style="padding-top: 5px" align="center"><input name="q" type="text" maxlength="4" value="1" style="width: 40px; height: 20px; text-align: center" onKeyPress="return somente_numeros(event);"></td>
        <td style="padding-top: 5px"><input name="submit" type="image" src="figuras/principal/botao_comprar.png" onClick="return valida_comprar_energia()"></td>
	</tr>
</form>

<form name="comprar_veneno" method="post" action="itens_comprar_veneno.php" onSubmit="return valida_comprar_veneno()">
	<tr>
		<td style="padding-top: 5px"><span class="img16"><img width="16" height="16" src="figuras/principal/veneno.png" title="Veneno" alt="Veneno"></span> <b>Veneno</b> <a href="#" class="balao"><span class="img16"><img width="16" height="16" src="figuras/principal/icon_sobre.png"></span><span class="balao" style="width: 248px">Reduz 1 minuto no seu Tempo de Secar.</span></a></td>
		<td style="padding-top: 5px" align="center">500</td>
		<td style="padding-top: 5px" align="center"><input name="q" type="text" maxlength="4" value="1" style="width: 40px; height: 20px; text-align: center" onKeyPress="return somente_numeros(event);"></td>
        <td style="padding-top: 5px"><input name="submit" type="image" src="figuras/principal/botao_comprar.png" onClick="return valida_comprar_veneno()"></td>
	</tr>
</form>

<form name="comprar_sacola" method="post" action="itens_comprar_sacola.php" onSubmit="return valida_comprar_sacola()">
	<tr>
		<td style="padding-top: 5px"><span class="img16"><img width="16" height="16" src="figuras/principal/sacola.png" title="Sacola" alt="Sacola"></span> <b>Sacola</b> <a href="#" class="balao"><span class="img16"><img width="16" height="16" src="figuras/principal/icon_sobre.png"></span><span class="balao" style="width: 275px">Acumula 2 chances em cada Entretenimento.</span></a></td>
		<td style="padding-top: 5px" align="center">1.000</td>
		<td style="padding-top: 5px" align="center"><input name="q" type="text" maxlength="4" value="1" style="width: 40px; height: 20px; text-align: center" onKeyPress="return somente_numeros(event);"></td>
        <td style="padding-top: 5px"><input name="submit" type="image" src="figuras/principal/botao_comprar.png" onClick="return valida_comprar_sacola()"></td>
	</tr>
</form>

<form name="comprar_escudo" method="post" action="itens_comprar_escudo.php" onSubmit="return valida_comprar_escudo()">
	<tr>
		<td style="padding-top: 5px"><span class="img16"><img width="16" height="16" src="figuras/principal/escudo.png" title="Escudo" alt="Escudo"></span> <b>Escudo</b> <a href="#" class="balao"><span class="img16"><img width="16" height="16" src="figuras/principal/icon_sobre.png"></span><span class="balao" style="width: 221px">Impede que joguem Pedra em você.</span></a></td>
		<td style="padding-top: 5px" align="center">1.000</td>
		<td style="padding-top: 5px" align="center"><input name="q" type="text" maxlength="4" value="1" style="width: 40px; height: 20px; text-align: center" onKeyPress="return somente_numeros(event);"></td>
        <td style="padding-top: 5px"><input name="submit" type="image" src="figuras/principal/botao_comprar.png" onClick="return valida_comprar_escudo()"></td>
	</tr>
</form>

<form name="comprar_pedra" method="post" action="itens_comprar_pedra.php" onSubmit="return valida_comprar_pedra()">
	<tr>
		<td style="padding-top: 5px"><span class="img16"><img width="16" height="16" src="figuras/principal/pedra.png" title="Pedra" alt="Pedra"></span> <b>Pedra</b> <a href="#" class="balao"><span class="img16"><img width="16" height="16" src="figuras/principal/icon_sobre.png"></span><span class="balao" style="width: 192px">Tira Sorte do usuário escolhido.</span></a></td>
		<td style="padding-top: 5px" align="center">300</td>
		<td style="padding-top: 5px" align="center"><input name="q" type="text" maxlength="4" value="1" style="width: 40px; height: 20px; text-align: center" onKeyPress="return somente_numeros(event);"></td>
        <td style="padding-top: 5px"><input name="submit" type="image" src="figuras/principal/botao_comprar.png" onClick="return valida_comprar_pedra()"></td>
	</tr>
</form>

<form name="comprar_diasp" method="post" action="itens_comprar_diasp.php" onSubmit="return valida_comprar_diasp()">
	<tr>
		<td style="padding-top: 5px"><span class="img16"><img width="16" height="16" src="figuras/principal/presidente.png" title="Dias Presidente" alt="Dias Presidente"></span> <b>Dias P</b> <a href="#" class="balao"><span class="img16"><img width="16" height="16" src="figuras/principal/icon_sobre.png"></span><span class="balao" style="width: 192px">Comprando esse Item você pode se tornar Presidente de um Time!</span></a></td>
		<td style="padding-top: 5px" align="center">200.000</td>
		<td style="padding-top: 5px" align="center">20 Dias</td>
        <td style="padding-top: 5px"><input name="submit" type="image" src="figuras/principal/botao_comprar.png" onClick="return valida_comprar_diasp()"></td>
	</tr>
</form>

</table>
</div>
<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/seta1.png"></span> <a href="itens.php"><b>Meus Ítens</b></a></div>

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