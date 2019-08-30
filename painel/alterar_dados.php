<?php include("fun_anti_inj.php") ?>
<?php include("conexao.php") ?>
<?php include("verificar_conexao.php") ?>
<html>
<?php include("head.php") ?>
<script language="javascript">
function valida_alterar_dados()
{
if (document.alterar_dados.email.value==""){
alert("É necessário preencher o email.");
document.alterar_dados.email.focus();
return false; }

if (document.alterar_dados.nome.value==""){
alert("É necessário preencher o nome.");
document.alterar_dados.nome.focus();
return false; }
}
</script>
<body>
<center>
<table width="770" cellpadding="0" cellspacing="0">
	<tr>
		<td id="cima" colspan="2"><?php include("cima.php") ?></td>
	</tr>
	<tr>
		<td id="menu" align="right"><?php include("menu.php") ?></td>
		<td id="principal" align="center">

<form name="alterar_dados" method="post" action="alterar_dados_salvar.php" onSubmit="return valida_alterar_dados()">
<table id="tabela" width="426" cellpadding="0" cellspacing="0">
	<tr>
		<td class="fonte_titulo1">Alterar dados</td>
	</tr>
<?php if (anti_inj($_GET["msg"]) == 1) { ?>
	<tr>
		<td align="center" style="padding-top: 15; padding-bottom: 5">

<table width="200" cellpadding="0" cellspacing="0">
	<tr>
		<td width="20"><img src="../figuras/painel/alerta_sim.png"></td>
		<td class="fonte1">Dados alterados com sucesso!</td>
	</tr>
</table>

		</td>
	</tr>
<?php } ?>
<?php if (anti_inj($_GET["msg"]) == 2) { ?>
	<tr>
		<td align="center" style="padding-top: 15; padding-bottom: 5">

<table width="115" cellpadding="0" cellspacing="0">
	<tr>
		<td width="20"><img src="../figuras/painel/alerta_nao.png"></td>
		<td class="fonte1">Esse email não pode ser usado!</td>
	</tr>
</table>

		</td>
	</tr>
<?php } ?>
	<tr>
		<td align="center" style="padding-top: 10; padding-bottom: 10">
<table width="190" cellpadding="0" cellspacing="0">
	<tr>
		<td width="60" class="fonte1">Email:</td>
		<td width="130" class="fonte1_negrito"><input name="email" type="text" class="fonte1" size="22" maxlength="50" value="<?=$mc_email?>"></td>
	</tr>
	<tr>
		<td class="fonte1" style="padding-top: 10">Nome:</td>
		<td style="padding-top: 10"><input name="nome" type="text" class="fonte1" size="22" maxlength="30" value="<?=$mc_nome?>"></td>
	</tr>
	<tr>
		<td class="fonte1" style="padding-top: 10">Senha:</td>
		<td style="padding-top: 10"><input name="senha" type="password" class="fonte1" size="22" maxlength="12"></td>
	</tr>
	<tr>
		<td colspan="2" class="fonte1" style="padding-top: 8">(deixe em branco para manter a senha atual)</td>
	</tr>
</table>
		</td>
	</tr>
	<tr>
		<td align="center" style="padding-top: 10; padding-bottom: 10;"><input name="submit" type="submit" class="input2" onClick="return valida_alterar_dados()" value="ALTERAR"></td>
	</tr>
</table>
</form>

		</td>
	</tr>
	<tr>
		<td id="baixo" colspan="2"><?php include("baixo.php") ?></td>
	</tr>
</table>
</center>
</body>
</html>