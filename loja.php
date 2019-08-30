<?php include("fun_ .php") ?>
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
function valida_pacote_1() {

if (document.pagamentodigital.produto_qtde_1.value=="") {
	alert("É necessário preencher a quantidade.");
	document.pagamentodigital.produto_qtde_1.focus();
	return false;
}

}
</script>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Algumas Vantagens</h1></div></div></div>
	<div class="conteudo">

<div id="linha10">

<table width="480" cellpadding="0" cellspacing="0">
	<tr>
		<td width="240px" id="usuario_vip1"><span class="img16"><img width="16" height="16" src="figuras/principal/usuario_vip.png" title="Usuário VIP" alt="Usuário VIP"></span> Usuário VIP</td>
		<td width="240px" id="usuario_normal"><span class="img16"><img width="16" height="16" src="figuras/principal/usuario_normal.png" title="Usuário Normal" alt="Usuário Normal"></span> Usuário Normal</td>
	</tr>
	<tr>
		<td class="fonte1" style="padding-top: 5px">Escolhe a cor do nome</td>
		<td class="fonte1" style="padding-top: 5px">Nome preto</td>
	</tr>
	<tr>
		<td class="fonte1" style="padding-top: 5px">Chute Automático: <b>4</b> minutos</td>
		<td class="fonte1" style="padding-top: 5px">Chute Automático: <b>8</b> minutos</td>
	</tr>
	<tr>
		<td class="fonte1" style="padding-top: 5px">Entretenimentos: <b>4</b> minutos</td>
		<td class="fonte1" style="padding-top: 5px">Entretenimentos: <b>8</b> minutos</td>
	</tr>
	<tr>
		<td class="fonte1" style="padding-top: 5px">Pode usar Energia</td>
		<td class="fonte1" style="padding-top: 5px">Não pode usar Energia</td>
	</tr>
	<tr>
		<td class="fonte1" style="padding-top: 5px">Pode usar Veneno</td>
		<td class="fonte1" style="padding-top: 5px">Não pode usar Veneno</td>
	</tr>
	<tr>
		<td class="fonte1" style="padding-top: 5px">Pode usar Sacola</td>
		<td class="fonte1" style="padding-top: 5px">Não pode usar Sacola</td>
	</tr>
	<tr>
		<td class="fonte1" style="padding-top: 5px">Pode Secar um time</td>
		<td class="fonte1" style="padding-top: 5px">Não pode Secar um time</td>
	</tr>
</table>

</div>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<div id="divide"></div>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Pontos de Fidelidade</h1></div></div></div>
	<div class="conteudo">

<div id="linha10">Ganhe 1 ponto a cada R$ 10,00 em compras de qualquer plano.</div>
<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/fidelidade.png" title="Fidelidade" alt="Fidelidade"></span> <b>Pontos:</b> <?=$mc_fidelidade?></div>
<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/seta1.png"></span> <a href="fidelidade.php"><b>Trocar Pontos</b></a></div>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<div id="divide"></div>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Pacotes de VIP</h1></div></div></div>
	<div class="conteudo">

<div id="linha10">

<table width="100%" cellpadding="0" cellspacing="0">

<form name="pagamentodigital" action="https://www.pagamentodigital.com.br/checkout/pay/" method="post" target="_blank">
<input name="email_loja" type="hidden" value="leonardo.guimaraes13@gmail.com">
<input name="produto_extra_1" type="hidden" value="<?=$mc_id?>">
<input name="produto_codigo_1" type="hidden" value="Pacote 1">
<input name="produto_descricao_1" type="hidden" value="60 VIP">
<input name="produto_valor_1" type="hidden" value="10.00">
<input name="tipo_integracao" type="hidden" value="PAD">
<input name="frete" type="hidden" value="0">
	<tr>
		<td width="385" class="fonte1"><b>Pacote 1 - (60 VIP) - R$ 10,00</b></td>
		<td width="57"><input type="text" name="produto_qtde_1" value="1" style="width: 30px; height: 20px"></td>
		<td><input type="image" src="figuras/principal/botao_comprar.png" border="0"></td>
	</tr>
</form>

<form name="pagamentodigital" action="https://www.pagamentodigital.com.br/checkout/pay/" method="post" target="_blank">
<input name="email_loja" type="hidden" value="leonardo.guimaraes13@gmail.com">
<input name="produto_extra_1" type="hidden" value="<?=$mc_id?>">
<input name="produto_codigo_1" type="hidden" value="Pacote 2">
<input name="produto_descricao_1" type="hidden" value="150 VIP">
<input name="produto_valor_1" type="hidden" value="20.00">
<input name="tipo_integracao" type="hidden" value="PAD">
<input name="frete" type="hidden" value="0">
	<tr>
		<td class="fonte1"><b>Pacote 2 - (150 VIP) - R$ 20,00</b></td>
		<td><input type="text" name="produto_qtde_1" value="1" style="width: 30px; height: 20px"></td>
		<td><input type="image" src="figuras/principal/botao_comprar.png" border="0"></td>
	</tr>
</form>

<form name="pagamentodigital" action="https://www.pagamentodigital.com.br/checkout/pay/" method="post" target="_blank">
<input name="email_loja" type="hidden" value="leonardo.guimaraes13@gmail.com">
<input name="produto_extra_1" type="hidden" value="<?=$mc_id?>">
<input name="produto_codigo_1" type="hidden" value="Pacote 3">
<input name="produto_descricao_1" type="hidden" value="230 VIP">
<input name="produto_valor_1" type="hidden" value="30.00">
<input name="tipo_integracao" type="hidden" value="PAD">
<input name="frete" type="hidden" value="0">
	<tr>
		<td class="fonte1"><b>Pacote 3 - (230 VIP) - R$ 30,00</b></td>
		<td><input type="text" name="produto_qtde_1" value="1" style="width: 30px; height: 20px"></td>
		<td><input type="image" src="figuras/principal/botao_comprar.png" border="0"></td>
	</tr>
</form>

<form name="pagamentodigital" action="https://www.pagamentodigital.com.br/checkout/pay/" method="post" target="_blank">
<input name="email_loja" type="hidden" value="leonardo.guimaraes13@gmail.com">
<input name="produto_extra_1" type="hidden" value="<?=$mc_id?>">
<input name="produto_codigo_1" type="hidden" value="Pacote 4">
<input name="produto_descricao_1" type="hidden" value="310 VIP">
<input name="produto_valor_1" type="hidden" value="40.00">
<input name="tipo_integracao" type="hidden" value="PAD">
<input name="frete" type="hidden" value="0">
	<tr>
		<td class="fonte1"><b>Pacote 4 - (310 VIP) - R$ 40,00</b></td>
		<td><input type="text" name="produto_qtde_1" value="1" style="width: 30px; height: 20px"></td>
		<td><input type="image" src="figuras/principal/botao_comprar.png" border="0"></td>
	</tr>
</form>

<form name="pagamentodigital" action="https://www.pagamentodigital.com.br/checkout/pay/" method="post" target="_blank">
<input name="email_loja" type="hidden" value="leonardo.guimaraes13@gmail.com">
<input name="produto_extra_1" type="hidden" value="<?=$mc_id?>">
<input name="produto_codigo_1" type="hidden" value="Pacote 5">
<input name="produto_descricao_1" type="hidden" value="390 VIP">
<input name="produto_valor_1" type="hidden" value="50.00">
<input name="tipo_integracao" type="hidden" value="PAD">
<input name="frete" type="hidden" value="0">
	<tr>
		<td class="fonte1"><b>Pacote 5 - (390 VIP) - R$ 50,00</b></td>
		<td><input type="text" name="produto_qtde_1" value="1" style="width: 30px; height: 20px"></td>
		<td><input type="image" src="figuras/principal/botao_comprar.png" border="0"></td>
	</tr>
</form>

<form name="pagamentodigital" action="https://www.pagamentodigital.com.br/checkout/pay/" method="post" target="_blank">
<input name="email_loja" type="hidden" value="leonardo.guimaraes13@gmail.com">
<input name="produto_extra_1" type="hidden" value="<?=$mc_id?>">
<input name="produto_codigo_1" type="hidden" value="Pacote 6">
<input name="produto_descricao_1" type="hidden" value="1010">
<input name="produto_valor_1" type="hidden" value="100.00">
<input name="tipo_integracao" type="hidden" value="PAD">
<input name="frete" type="hidden" value="0">
	<tr>
		<td class="fonte1"><b>Pacote 6 - (1010 VIP) - R$ 100,00</b></td>
		<td><input type="text" name="produto_qtde_1" value="1" style="width: 30px; height: 20px"></td>
		<td><input type="image" src="figuras/principal/botao_comprar.png" border="0"></td>
	</tr>
</form>

</table>

</div>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>


<div id="divide"></div>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Pacotes de FutCash</h1></div></div></div>
	<div class="conteudo">

<div id="linha10">

<table width="100%" cellpadding="0" cellspacing="0">

<form name="pagamentodigital" action="https://www.pagamentodigital.com.br/checkout/pay/" method="post" target="_blank">
<input name="email_loja" type="hidden" value="leonardo.guimaraes13@gmail.com">
<input name="produto_extra_1" type="hidden" value="<?=$mc_id?>">
<input name="produto_codigo_1" type="hidden" value="Pacote 7">
<input name="produto_descricao_1" type="hidden" value="100.000 Fc">
<input name="produto_valor_1" type="hidden" value="10.00">
<input name="tipo_integracao" type="hidden" value="PAD">
<input name="frete" type="hidden" value="0">
	<tr>
		<td width="385" class="fonte1"><b>Pacote 7 - (100.000 Fc) - R$ 10,00</b></td>
		<td width="57"><input type="text" name="produto_qtde_1" value="1" style="width: 30px; height: 20px"></td>
		<td><input type="image" src="figuras/principal/botao_comprar.png" border="0"></td>
	</tr>
</form>

<form name="pagamentodigital" action="https://www.pagamentodigital.com.br/checkout/pay/" method="post" target="_blank">
<input name="email_loja" type="hidden" value="leonardo.guimaraes13@gmail.com">
<input name="produto_extra_1" type="hidden" value="<?=$mc_id?>">
<input name="produto_codigo_1" type="hidden" value="Pacote 8">
<input name="produto_descricao_1" type="hidden" value="250.000 Fc">
<input name="produto_valor_1" type="hidden" value="20.00">
<input name="tipo_integracao" type="hidden" value="PAD">
<input name="frete" type="hidden" value="0">
	<tr>
		<td width="385" class="fonte1"><b>Pacote 8 - (250.000 Fc) - R$ 20,00</b></td>
		<td width="57"><input type="text" name="produto_qtde_1" value="1" style="width: 30px; height: 20px"></td>
		<td><input type="image" src="figuras/principal/botao_comprar.png" border="0"></td>
	</tr>
</form>

<form name="pagamentodigital" action="https://www.pagamentodigital.com.br/checkout/pay/" method="post" target="_blank">
<input name="email_loja" type="hidden" value="leonardo.guimaraes13@gmail.com">
<input name="produto_extra_1" type="hidden" value="<?=$mc_id?>">
<input name="produto_codigo_1" type="hidden" value="Pacote 9">
<input name="produto_descricao_1" type="hidden" value="400.000 Fc">
<input name="produto_valor_1" type="hidden" value="30.00">
<input name="tipo_integracao" type="hidden" value="PAD">
<input name="frete" type="hidden" value="0">
	<tr>
		<td width="385" class="fonte1"><b>Pacote 9 - (400.000 Fc) - R$ 30,00</b></td>
		<td width="57"><input type="text" name="produto_qtde_1" value="1" style="width: 30px; height: 20px"></td>
		<td><input type="image" src="figuras/principal/botao_comprar.png" border="0"></td>
	</tr>
</form>

<form name="pagamentodigital" action="https://www.pagamentodigital.com.br/checkout/pay/" method="post" target="_blank">
<input name="email_loja" type="hidden" value="leonardo.guimaraes13@gmail.com">
<input name="produto_extra_1" type="hidden" value="<?=$mc_id?>">
<input name="produto_codigo_1" type="hidden" value="Pacote 10">
<input name="produto_descricao_1" type="hidden" value="900.000 Fc">
<input name="produto_valor_1" type="hidden" value="60.00">
<input name="tipo_integracao" type="hidden" value="PAD">
<input name="frete" type="hidden" value="0">
	<tr>
		<td width="385" class="fonte1"><b>Pacote 10 - (900.000 Fc) - R$ 60,00</b></td>
		<td width="57"><input type="text" name="produto_qtde_1" value="1" style="width: 30px; height: 20px"></td>
		<td><input type="image" src="figuras/principal/botao_comprar.png" border="0"></td>
	</tr>
</form>


</table>

</div>

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