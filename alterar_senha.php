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
function valida_alterar_senha() {

if (document.alterar_senha.senha_atual.value=="") {
	alert("É necessário preencher a senha atual.");
	document.alterar_senha.senha_atual.focus();
	return false;
}

if (document.alterar_senha.senha_nova.value=="") {
	alert("É necessário preencher a senha nova.");
	document.alterar_senha.senha_nova.focus();
	return false;
}

if (document.alterar_senha.senha_nova.value.length<4) {
	alert("É necessário preencher uma senha maior.");
	document.alterar_senha.senha_nova.focus();
	return false;
}

if (document.alterar_senha.senha_nova_conf.value=="") {
	alert("É necessário confirmar a senha nova.");
	document.alterar_senha.senha_nova_conf.focus();
	return false;
}

if (document.alterar_senha.senha_nova.value!=document.alterar_senha.senha_nova_conf.value) {
	alert("É necessário confirmar as senhas igualmente.");
	document.alterar_senha.senha_nova_conf.focus();
	return false;
}

}
</script>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Alterar Senha</h1></div></div></div>
	<div class="borda_esquerda"><div class="borda_direita"><div class="conteudo">

<?php if (anti_inj($_GET["msg_alterar"]) == 1) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_sim.png"></span> Senha alterada com sucesso!</div>

<?php } else if (anti_inj($_GET["msg_alterar"]) == 2) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Senha atual incorreta!</div>

<?php } else if (anti_inj($_GET["msg_alterar"]) == 3) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Preencha uma senha diferente da atual!</div>

<?php } else if (anti_inj($_GET["msg_alterar"]) == 4) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Preencha uma senha com mais de 4 digitos!</div>

<?php } ?>

<form name="alterar_senha" method="post" action="alterar_senha_salvar.php" onSubmit="return valida_alterar_senha()">
<div id="linha10"><span class="fonte_form">Qual é a sua senha atual?</span> <span class="align_form"><input name="senha_atual" type="password" maxlength="12" style="width: 100px; height: 20px"></span></div>

<div id="linha15"><span class="fonte_form">Qual será a sua nova senha?</span> <span class="align_form"><input name="senha_nova" type="password" maxlength="12" style="width: 100px; height: 20px"></span></div>

<div id="linha15"><span class="fonte_form">Confirme a sua nova senha...</span> <span class="align_form"><input name="senha_nova_conf" type="password" maxlength="12" style="width: 100px; height: 20px"></span></div>

<div id="linha12"><input name="submit" type="image" src="figuras/principal/botao_confirmar.png" onClick="return valida_alterar_senha()"></div>
</form>

	</div></div></div>
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