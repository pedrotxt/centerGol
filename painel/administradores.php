<?php ob_start(); ?>
<?php include("fun_anti_inj.php") ?>
<?php include("conexao.php") ?>
<?php include("verificar_conexao.php") ?>
<html>
<?php include("head.php") ?>
<?php include("verificar_cargo.php") ?>
<?php ob_end_flush(); ?>
<script language="javascript" src="../js/principal.js"></script>
<script language="javascript">
function valida_adm()
{
if (document.adm.email.value==""){
alert("É necessário preencher o email.");
document.adm.email.focus();
return false; }

if (document.adm.senha.value==""){
alert("É necessário preencher a senha.");
document.adm.senha.focus();
return false; }

if (document.adm.nome.value==""){
alert("É necessário preencher o nome.");
document.adm.nome.focus();
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

<form name="adm" method="post" action="administradores_salvar.php" onSubmit="return valida_adm()">
<table id="tabela" width="426" cellpadding="0" cellspacing="0">
	<tr>
		<td class="fonte_titulo1">Adicionar Administrador</td>
	</tr>
<?php if (anti_inj($_GET["msg"]) == 1) { ?>
	<tr>
		<td align="center" style="padding-top: 15; padding-bottom: 5">

<table width="182" cellpadding="0" cellspacing="0">
	<tr>
		<td width="20"><img src="../figuras/painel/alerta_sim.png"></td>
		<td class="fonte1">Administrador adicionado com sucesso!</td>
	</tr>
</table>

		</td>
	</tr>
<?php } ?>
<?php if (anti_inj($_GET["msg"]) == 2) { ?>
	<tr>
		<td align="center" style="padding-top: 15; padding-bottom: 5">

<table width="182" cellpadding="0" cellspacing="0">
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
<table width="250" cellpadding="0" cellspacing="0">
	<tr>
		<td width="80" class="fonte1">Email:</td>
		<td width="170"><input name="email" type="text" class="fonte1" size="22" maxlength="50"></td>
	</tr>
	<tr>
		<td class="fonte1" style="padding-top: 10">Senha:</td>
		<td style="padding-top: 10"><input name="senha" type="password" class="fonte1" size="22" maxlength="12"></td>
	</tr>
	<tr>
		<td class="fonte1" style="padding-top: 10">Nome:</td>
		<td style="padding-top: 10"><input name="nome" type="text" class="fonte1" size="22" maxlength="50"></td>
	</tr>
	<tr>
		<td class="fonte1" style="padding-top: 10">Cargo:</td>
		<td style="padding-top: 10"><select name="cargo" size="1" class="fonte1">
<option value="1" selected>Administrador</option>
<option value="2">Moderador</option>
</select></td>
	</tr>
</table>
		</td>
	</tr>
	<tr>
		<td align="center" style="padding-top: 10; padding-bottom: 10;"><input name="submit" type="submit" class="input2" onClick="return valida_adm()" value="ADICIONAR"></td>
	</tr>
</table>
</form>


<table>
	<tr>
		<td class="tabela_divisao"></td>
	</tr>
</table>
<table>
	<tr>
		<td class="tabela_divisao"></td>
	</tr>
</table>

<table id="tabela" width="426" cellpadding="0" cellspacing="0">
	<tr>
		<td class="fonte_titulo1">Administradores</td>
	</tr>
	<tr>
		<td class="fonte1" style="padding: 10">



<div id="linha10">

<table width="426" cellpadding="0" cellspacing="1">

<?php
$query = mysql_query("SELECT ID, Email, Nome, Cargo FROM Administradores");
?>

<?php while ($rs = mysql_fetch_array($query)) { ?>

	<tr>
		<td style="padding: 3px 0 3px 5px"><a href="administradores_excluir.php?id=<?=$rs["ID"]?>"><span class="img20"><img width="20" height="20" src="../figuras/painel/excluir.png" title="Excluir" alt="Excluir" border="0"></span></a> <?=$rs["Email"]?> (<?=$rs["Nome"]?>) (<?php if ($rs["Cargo"] == 1) { ?>ADM<?php } else { ?>MOD<?php } ?>)</td>
	</tr>

<?php } ?>

</table>

</div>



		</td>
	</tr>
</table>

		</td>
	</tr>
	<tr>
		<td id="baixo" colspan="2"><?php include("baixo.php") ?></td>
	</tr>
</table>
</center>
</body>
</html>