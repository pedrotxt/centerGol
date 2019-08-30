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
function valida_alterar_nome() {

if (document.alterar_nome.usuario.value=="") {
	alert("É necessário preencher o nome.");
	document.alterar_nome.usuario.focus();
	return false;
}

if (document.alterar_nome.usuario.value.length<2) {
	alert("É necessário preencher um nome maior.");
	document.alterar_nome.usuario.focus();
	return false;
}

}

function verificarusuario() {

if (document.alterar_nome.usuario.value=="") {
	alert("É necessário preencher o nome.");
	document.alterar_nome.usuario.focus();
	return false;
}

if (document.alterar_nome.usuario.value.length<2) {
	alert("É necessário preencher um nome maior.");
	document.alterar_nome.usuario.focus();
	return false;
}

verificar_usuario("alterar_nome_verificar.php?usuario="+document.alterar_nome.usuario.value);
}
</script>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Alterar Nome</h1></div></div></div>
	<div class="borda_esquerda"><div class="borda_direita"><div class="conteudo">

<?php if (anti_inj($_GET["msg_alterar"]) == 1) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_sim.png"></span> Nome alterado com sucesso!</div>

<?php } else if (anti_inj($_GET["msg_alterar"]) == 2) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Preencha o nome somente com letras e números!</div>

<?php } else if (anti_inj($_GET["msg_alterar"]) == 3) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Preencha um nome diferente do atual!</div>

<?php } else if (anti_inj($_GET["msg_alterar"]) == 4) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Esse nome não pode ser usado!</div>

<?php } else if (anti_inj($_GET["msg_alterar"]) == 5) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Você não tem dinheiro suficiente!</div>

<?php } ?>

<div id="linha10"><b>Custo:</b> 300</div>

<form name="alterar_nome" method="post" action="alterar_nome_salvar.php" onSubmit="return valida_alterar_nome()">
<div id="linha10"><span class="fonte_form">Qual será o seu novo nome? <span class="img16"><a id="cursor" onClick="javascript:verificarusuario();"><img width="16" height="16" src="figuras/principal/icon_duvida.png" title="Verificar Usuário" alt="Verificar Usuário" border="0"></a></span></span> <span class="align_form"><input name="usuario" type="text" maxlength="10" style="width: 200px; height: 20px"></span></div>

<div id="verificar_usuario" style="padding-top: 10px"></div>

<div id="linha12"><input name="submit" type="image" src="figuras/principal/botao_confirmar.png" onClick="return valida_alterar_nome()"></div>
</form>

	</div></div></div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<div id="divide"></div>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Importante</h1></div></div></div>
	<div class="conteudo">

<div id="linha10">Preencha seu nome usando apenas letras e números.</div>
<div id="linha10">Não use espaço e nem caracteres especiais.</div>

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