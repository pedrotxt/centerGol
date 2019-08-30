<?php ob_start(); ?>
<?php include("verificar_cargo.php") ?>

<?php if (!$_COOKIE["usuarioid"]) { ?>
<script language="javascript">
function valida_login() {

if (document.login.email.value=="") {
	alert("É necessário preencher o email.");
	document.login.email.focus();
	return false;
}

var email=document.login.email.value;

if (email.indexOf("@")==-1) {
	alert("É necessário preencher o email corretamente.");
	document.login.email.focus();
	return false;
}

var sufxemail=email.substring(email.indexOf("@"));

if (email.length<9 || email.indexOf(",")>-1 || email.indexOf("'")>-1 || email.indexOf(" ")>-1 || sufxemail.length<6 || sufxemail.indexOf(".")==-1) {
	alert("É necessário preencher o email corretamente.");
	document.login.email.focus();
	return false;
}

if (document.login.senha.value=="") {
	alert("É necessário preencher a senha.");
	document.login.senha.focus();
	return false;
}

}
</script>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Acesse sua conta</h1></div></div></div>
	<div class="conteudo">

<?php if (anti_inj($_GET["msg_autenticar"]) == 1) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Senha incorreta!</div>

<?php } else if (anti_inj($_GET["msg_autenticar"]) == 2) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Conta não confirmada!</div>

<?php } else if (anti_inj($_GET["msg_autenticar"]) == 3) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Conta banida!</div>

<?php } else if (anti_inj($_GET["msg_autenticar"]) == 4) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Limite por IP!</div>

<?php } ?>

<form name="login" method="post" action="autenticar.php" target="_parent" onSubmit="return valida_login()">
<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/email.png"></span> <b>Email</b></div>
<div id="linha8"><input name="email" type="text" maxlength="50" style="width: 149px; height: 20px"></div>
<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/senha.png"></span> <b>Senha</b></div>
<div id="linha8"><input name="senha" type="password" maxlength="12" style="width: 149px; height: 20px"></div>
<div style="padding-top: 15px; text-align: center"><input type="image" src="figuras/principal/botao_jogar.png" onClick="return valida_login()"></div>
</form>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<div class="opacity"><a href="cadastro.php"><img src="figuras/principal/botao_cadastro.png" border="0"></a></div>
<div class="opacity"><a href="recuperar.php"><img src="figuras/principal/botao_resenha.png" border="0"></a></div>
<div class="opacity"><a href="reenviar.php"><img src="figuras/principal/botao_reemail1.png" border="0"></a></div>

<?php } else { ?>

<img src="figuras/principal/botao_chute.png" border="0">
<div style="position:absolute; margin-top:-20px; margin-left:68px; color:#FFFFFF"><span id="tempo_chutar"> <?php include("tempo_chutar.php") ?></span></div>
<a href="alterar_time_secar.php"><img src="figuras/principal/botao_secar.png" border="0">
<div style="position:absolute; margin-top:-20px; margin-left:68px; color:#FFFFFF"><span id="tempo_secar"><?php include("tempo_secar.php") ?></span>
</div></a>
<img src="figuras/principal/botao_entre.png" border="0">
<div style="position:absolute; margin-top:-20px; margin-left:68px; color:#FFFFFF"><span id="tempo_entretenimentos"><?php include("tempo_entretenimentos.php") ?></span>
</div>

<div id="linha10"><div id="tempo_entretenimentos_tent"><?php include("entretenimentos.php") ?></div></div>

<div id="divide"></div>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Minha Conta</h1></div></div></div>
	<div class="conteudo">

<div id="minha_conta" style="padding-top: 10px"><?php include("minha_conta.php") ?></div>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<?php } ?>