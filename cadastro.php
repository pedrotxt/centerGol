<?php ob_start(); ?>
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
function valida_cadastro() {

if (document.cadastro.email.value=="") {
	alert("É necessário preencher o email.");
	document.cadastro.email.focus();
	return false;
}

var email=document.cadastro.email.value;

if (email.indexOf("@")==-1) {
	alert("É necessário preencher o email corretamente.");
	document.cadastro.email.focus();
	return false;
}

var sufxemail=email.substring(email.indexOf("@"));

if (email.length<9 || email.indexOf(",")>-1 || email.indexOf("'")>-1 || email.indexOf(" ")>-1 || sufxemail.length<6 || sufxemail.indexOf(".")==-1) {
	alert("É necessário preencher o email corretamente.");
	document.cadastro.email.focus();
	return false;
}

if (document.cadastro.usuario.value=="") {
	alert("É necessário preencher o nome.");
	document.cadastro.usuario.focus();
	return false;
}

if (document.cadastro.usuario.value.length<2) {
	alert("É necessário preencher um nome maior.");
	document.cadastro.usuario.focus();
	return false;
}

if (document.cadastro.senha.value=="") {
	alert("É necessário preencher a senha.");
	document.cadastro.senha.focus();
	return false;
}

if (document.cadastro.senha.value.length<4) {
	alert("É necessário preencher uma senha maior.");
	document.cadastro.senha.focus();
	return false;
}

if (document.cadastro.sexo.value==0) {
	alert("É necessário selecionar o sexo.");
	document.cadastro.sexo.focus();
	return false;
}

if (document.cadastro.time.value==0) {
	alert("É necessário selecionar o time.");
	document.cadastro.time.focus();
	return false;
}

if (document.cadastro.camisa.value==0) {
	alert("É necessário selecionar a camisa.");
	document.cadastro.camisa.focus();
	return false;
}

}

function verificaremail() {

if (document.cadastro.email.value=="") {
	alert("É necessário preencher o email.");
	document.cadastro.email.focus();
	return false;
}

var email=document.cadastro.email.value;

if (email.indexOf("@")==-1) {
	alert("É necessário preencher o email corretamente.");
	document.cadastro.email.focus();
	return false;
}

var sufxemail=email.substring(email.indexOf("@"));

if (email.length<9 || email.indexOf(",")>-1 || email.indexOf("'")>-1 || email.indexOf(" ")>-1 || sufxemail.length<6 || sufxemail.indexOf(".")==-1) {
	alert("É necessário preencher o email corretamente.");
	document.cadastro.email.focus();
	return false;
}

verificar_email("cadastro_verificar_email.php?email="+document.cadastro.email.value);
}

function verificarusuario() {

if (document.cadastro.usuario.value=="") {
	alert("É necessário preencher o nome.");
	document.cadastro.usuario.focus();
	return false;
}

if (document.cadastro.usuario.value.length<2) {
	alert("É necessário preencher um nome maior.");
	document.cadastro.usuario.focus();
	return false;
}

verificar_usuario("cadastro_verificar_usuario.php?usuario="+document.cadastro.usuario.value);
}
</script>
<?php
$id = anti_inj($_GET['id']);

if (ereg('[^0-9]',$id)) {
	header("Location: index.php"); break;
}

if ($id) {

$query = mysql_query("SELECT Usuarios.Usuario as Usuario_Nome, Usuarios.Nivel as Usuario_Nivel, Usuarios.Gols_Total as Usuario_Gols_Total, Usuarios.VIP as Usuario_VIP, Usuarios.VIP_Cor as Usuario_VIP_Cor, Times.ID as Time_ID, Times.Time as Time_Nome FROM Usuarios INNER JOIN Times ON Times.ID = Usuarios.Time WHERE Usuarios.ID = '". $id ."'");
$rs = mysql_fetch_array($query);

if ($rs) {
	$convite_nome = $rs["Usuario_Nome"];
	$convite_nivel = $rs["Usuario_Nivel"];
	$convite_time = $rs["Time_ID"];
	$convite_time_nome = $rs["Time_Nome"];
	$convite_gols_total = $rs["Usuario_Gols_Total"];
	$convite_vip = $rs["Usuario_VIP"];
	$convite_vip_cor = $rs["Usuario_VIP_Cor"];
} else {
	header("Location: cadastro.php"); break;
}

}

ob_end_flush();
?>
<?php if ($id) { ?>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Convidado Por</h1></div></div></div>
	<div class="conteudo">

<div id="linha10"><span class="img25"><img width="25" height="25" src="figuras/niveis/<?=$convite_nivel?>.png" title="<?=$convite_nivel?>" alt="<?=$convite_nivel?>"></span> <span class="img20"><img width="20" height="20" src="figuras/times_pequenos/<?=$convite_time?>.png" title="<?=$convite_time_nome?>" alt="<?=$convite_time_nome?>"></span> <?php if ($convite_vip > 0) { ?><span id="usuario_vip<?=$convite_vip_cor?>"><?=$convite_nome?></span><?php } else { ?><span id="usuario_normal"><?=$convite_nome?></span><?php } ?> (<?=number_format($convite_gols_total,0,',','.')?> <?php if ($convite_gols_total == 1) { ?> gol<?php } else { ?> gols<?php } ?>)</div>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<div id="divide"></div>

<?php } ?>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Cadastro</h1></div></div></div>
	<div class="conteudo">

<?php if (anti_inj($_GET["msg_cadastro"]) == 1) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Esse email não pode ser usado!</div>

<?php } else if (anti_inj($_GET["msg_cadastro"]) == 2) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Preencha o nome somente com letras e números!</div>

<?php } else if (anti_inj($_GET["msg_cadastro"]) == 3) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Esse nome não pode ser usado!</div>

<?php } ?>

<form name="cadastro" method="post" action="cadastro_salvar.php" onSubmit="return valida_cadastro()">
<input name="convite" type="hidden" value="<?=$id?>">

<div id="linha10"><span class="fonte_form">Qual o seu email? <span class="img16"><a id="cursor" onClick="javascript:verificaremail();"><img width="16" height="16" src="figuras/principal/icon_duvida.png" title="Verificar Email" alt="Verificar Email" border="0"></a></span></span> <span class="align_form"><input name="email" type="text" maxlength="50" style="width: 200px; height: 20px" onChange="javascript:verificaremail();"></span></div>

<div id="verificar_email" style="padding-top: 10px"></div>

<div id="linha15"><span class="fonte_form">Qual o seu nome? <span class="img16"><a id="cursor" onClick="javascript:verificarusuario();"><img width="16" height="16" src="figuras/principal/icon_duvida.png" title="Verificar Usuário" alt="Verificar Usuário" border="0"></a></span></span> <span class="align_form"><input name="usuario" type="text" maxlength="10" style="width: 200px; height: 20px" onChange="javascript:verificarusuario();"></span></div>

<div id="verificar_usuario" style="padding-top: 10px"></div>

<div id="linha15"><span class="fonte_form">Qual a sua senha?</span> <span class="align_form"><input name="senha" type="password" maxlength="12" style="width: 200px; height: 20px"></span></div>

<div id="linha15">
<span class="fonte_form">Qual o seu sexo?</span>
<span class="align_form">
<select name="sexo" style="width: 180px; height: 26px">
<option value="0"></option>
<option value="1">Masculino</option>
<option value="2">Feminino</option>
</select>
</span>
</div>

<div id="linha15"><span class="fonte_form">Qual o seu time?</span> <span class="align_form"><?php include("times_lista.php") ?></span></div>

<div id="linha15">
<span class="fonte_form">Qual o número da sua camisa?</span>
<span class="align_form">
<select name="camisa" style="width: 70px; height: 26px">
<option value="0"></option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
<option value="8">8</option>
<option value="9">9</option>
<option value="10">10</option>
<option value="11">11</option>
</select>
</span>
</div>

<div id="linha12"><input name="submit" type="image" src="figuras/principal/botao_confirmar.png" onClick="return valida_cadastro()"></div>
</form>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<div id="divide"></div>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Importante</h1></div></div></div>
	<div class="conteudo">

<div id="linha10">Digite um email válido, será preciso confirmar.</div>
<div id="linha10">Em caso de perda de senha, a mesma será enviada para o seu email.</div>
<div id="linha10">Preencha o seu nome usando apenas letras e números.</div>
<div id="linha10">Não divida sua conta, não passe sua senha para ninguém.</div>

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