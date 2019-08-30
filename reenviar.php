<?php include_once("fun_anti_inj.php") ?>
<?php include("verificar_cookie.php") ?>
<?php include("conexao.php") ?>
<!DOCTYPE html>
<html>
<?php include("head.php") ?>
<body>
<div id="container">
<div id="cima"><?php include("cima.php") ?></div>
<div id="conteudo">

<div id="esquerda"><?php include("esquerda.php") ?>></div>
<div id="direita"><?php include("direita.php") ?></div>
<div id="principal">
<!-- INÍCIO DA PÁGINA -->


<script language="javascript">
function valida_reenviar() {

if (document.reenviar.email.value=="") {
	alert("É necessário preencher o email.");
	document.reenviar.email.focus();
	return false;
}

var email=document.reenviar.email.value

if (email.indexOf("@")==-1) {
	alert("É necessário preencher o email corretamente.");
	document.reenviar.email.focus();
	return false;
}

var sufxemail=email.substring(email.indexOf("@"))

if (email.length<9 || email.indexOf(",")>-1 || email.indexOf("'")>-1 || email.indexOf(" ")>-1 || sufxemail.length<6 || sufxemail.indexOf(".")==-1) {
	alert("É necessário preencher o email corretamente.");
	document.reenviar.email.focus();
	return false;
}

}
</script>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Reenviar Email</h1></div></div></div>
	<div class="conteudo">

<?php if (anti_inj($_GET["msg_reenviar"]) == 1) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_sim.png"></span> Email enviado com sucesso!</div>

<?php } else if (anti_inj($_GET["msg_reenviar"]) == 2) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Email não cadastrado!</div>

<?php } else if (anti_inj($_GET["msg_reenviar"]) == 3) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Esse email já está confirmado!</div>

<?php } ?>

<form name="reenviar" method="post" action="reenviar_salvar.php" onSubmit="return valida_reenviar()">
<div id="linha10"><span class="fonte_form">Qual o seu email cadastrado?</span> <span class="align_form"><input name="email" type="text" maxlength="50" style="width: 200px; height: 20px"></span></div>

<div id="linha12"><input name="submit" type="image" src="figuras/principal/botao_confirmar.png" onClick="return valida_reenviar()"></div>
</form>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<div id="divide"></div>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Importante</h1></div></div></div>
	<div class="conteudo">

<div id="linha10">Você receberá um outro email com o código de confirmação de cadastro.</div>
<div id="linha10">Seu servidor de email pode detectar como spam, verifique no lixo eletrônico.</div>

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