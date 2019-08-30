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

<div id="esquerda"><?php include("esquerda.php") ?></div>
<div id="direita"><?php include("direita.php") ?></div>
<div id="principal">
<!-- INÍCIO DA PÁGINA -->


<script language="javascript">
function valida_recadastrar_senha() {

if (document.recadastrar_senha.senha.value=="") {
	alert("É necessário preencher a senha.");
	document.recadastrar_senha.senha.focus();
	return false;
}

if (document.recadastrar_senha.senha.value.length<4) {
	alert("É necessário preencher uma senha maior.");
	document.recadastrar_senha.senha.focus();
	return false;
}

}
</script>
<?php
if ($_COOKIE["usuarioid"]) {
	header("Location: index.php"); break;
}

$id = anti_inj($_GET['id']);
$cod = anti_inj($_GET['cod']);

if (!$id or !$cod or $cod == "0") {
	header("Location: index.php"); break;
}

if (ereg('[^0-9]',$id)) {
	header("Location: index.php"); break;
}

if (!ctype_alnum($cod)) {
	header("Location: index.php"); break;
}

$query = mysql_query("SELECT ID FROM Usuarios WHERE ID = '". $id ."' AND Recuperar = '". $cod ."'");
$rs = mysql_fetch_array($query);

if ($rs) {
	$verificar = 1;
} else {
	$verificar = 0;
}

ob_end_flush();
?>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Recadastrar Senha</h1></div></div></div>
	<div class="conteudo">

<?php if ($verificar == 0) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Código inválido, tente recuperar novamente!</div>

<?php } else if ($verificar == 1) { ?>

<div id="linha10">Não passe a sua senha para ninguém, não divida a sua conta.</div>

<form name="recadastrar_senha" method="post" action="recadastrar_salvar.php" onSubmit="return valida_recadastrar_senha()">
<input name="id" type="hidden" value="<?=$id?>">
<input name="cod" type="hidden" value="<?=$cod?>">

<div id="linha12"><span class="fonte_form">Qual será a sua nova senha?</span> <span class="align_form"><input name="senha" type="password" maxlength="12" style="width: 200px; height: 20px"></span></div>

<div id="linha12"><input name="submit" type="image" src="figuras/principal/botao_confirmar.png" onClick="return valida_recadastrar_senha()"></div>
</form>

<?php } ?>

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