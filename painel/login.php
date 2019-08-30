<?php include("fun_anti_inj.php") ?>
<?php include("conexao.php") ?>
<html>
<head>
<link rel="shortcut icon" href="../figuras/principal/futclube.ico">
<title>FUTCLUBE - Líder em futebol online!</title>
<link href="../css/painel.css" rel="stylesheet" type="text/css" media="screen">
<script>
function valida_login()
{
if (document.login.email.value==""){
alert("É necessário preencher o email.");
document.login.email.focus();
return false; }

if (document.login.senha.value==""){
alert("É necessário preencher a senha.");
document.login.senha.focus();
return false; }
}
</script>
</head>
<body background="../figuras/painel/fundo.jpg">
<table width="100%" height="100%">
	<tr>
		<td align="center">

<table id="tabela" width="230" cellpadding="0" cellspacing="0">
	<tr>
		<td class="fonte_titulo1">Área Restrita</td>
	</tr>
	<tr>
		<td style="padding: 15" bgcolor="#FFFFFF" align="center">

<?php if (anti_inj($_GET["msg"]) == 1) { ?>
<table width="120" cellpadding="0" cellspacing="0">
	<tr>
		<td width="20" style="padding-bottom: 15"><img src="../figuras/painel/alerta_nao.png"></td>
		<td class="fonte1" style="padding-bottom: 15">Senha incorreta!</td>
	</tr>
</table>
<?php } ?>

<form name="login" action="autenticar.php" method="post" onSubmit="return valida_login()">
<table width="170" cellpadding="0" cellspacing="0">
	<tr>
		<td align="center"><input name="email" type="text" class="fonte1" size="19" maxlength="50"></td>
	</tr>
	<tr>
		<td align="center" style="padding-top: 10"><input name="senha" type="password" class="fonte1" size="19" maxlength="12"></td>
	</tr>
	<tr>
		<td style="padding-top: 15" align="center"><input name="entrar" type="submit" class="input2" onClick="return valida_login()" value="ENTRAR"></td>
	</tr>
</table>
</form>

		</td>
	</tr>
</table>

		</td>
	</tr>
</table>
</body>
</html>