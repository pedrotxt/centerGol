<?php ob_start(); ?>
<?php include("fun_anti_inj.php") ?>
<?php include("conexao.php") ?>
<?php include("verificar_conexao.php") ?>
<html>
<?php include("head.php") ?>
<?php include("verificar_cargo.php") ?>
<?php ob_end_flush(); ?>
<body>
<center>
<script language="javascript">
function valida_mensagem_global()
{
if (document.mensagem_global.por.value==""){
alert("É necessário preencher o por.");
document.mensagem_global.por.focus();
return false; }

if (document.mensagem_global.data.value==""){
alert("É necessário preencher a data.");
document.mensagem_global.data.focus();
return false; }

if (document.mensagem_global.mensagem.value==""){
alert("É necessário preencher a mensagem global.");
document.mensagem_global.mensagem.focus();
return false; }
}
</script>
<table width="770" cellpadding="0" cellspacing="0">
	<tr>
		<td id="cima" colspan="2"><?php include("cima.php") ?></td>
	</tr>
	<tr>
		<td id="menu" align="right"><?php include("menu.php") ?></td>
		<td id="principal" align="center">

<?php
$query = mysql_query("SELECT Mensagem, Por, Data, Status FROM Mensagem_Global");
$rs = mysql_fetch_array($query);

$mensagem = $rs["Mensagem"];
$por = $rs["Por"];
$data = $rs["Data"];
$status = $rs["Status"];
?>

<table id="tabela" width="426" cellpadding="0" cellspacing="0">
	<tr>
		<td class="fonte_titulo1">Mensagem Global</td>
	</tr>
<?php if (anti_inj($_GET["msg"]) == 1) { ?>
	<tr>
		<td align="center" style="padding-top: 15; padding-bottom: 5">

<table width="253" cellpadding="0" cellspacing="0">
	<tr>
		<td width="20"><img src="../figuras/painel/alerta_sim.png"></td>
		<td class="fonte1">Mensagem Global alterada com sucesso!</td>
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
		<td class="fonte1">Houve um erro!</td>
	</tr>
</table>

		</td>
	</tr>
<?php } ?>
	<tr>
		<td class="fonte1" style="padding: 10" align="center">

<form name="mensagem_global" method="post" action="mensagem_global_salvar.php" onSubmit="return valida_mensagem_global()">
<table width="400" cellpadding="0" cellspacing="0">
	<tr>
		<td class="fonte1">Status: <select name="status" size="1" class="fonte1" style="width: 85">
<option value="0" <?php if ($status == 0) { ?>selected<?php } ?>>Desligada</option>
<option value="1" <?php if ($status == 1) { ?>selected<?php } ?>>Ligada</option>
</select></td>
	</tr>
	<tr>
		<td class="fonte1" style="padding-top: 5">Por: <input name="por" type="text" class="fonte1" size="22" maxlength="30" value="<?=$por?>"></td>
	</tr>
	<tr>
		<td class="fonte1" style="padding-top: 5">Data: <input name="data" type="text" class="fonte1" size="22" maxlength="30" value="<?=$data?>"></td>
	</tr>
	<tr>
		<td align="center" style="padding-top: 5"><textarea name="mensagem" cols="74" rows="12" class="fonte1"><?=$mensagem?></textarea></td>
	</tr>
	<tr>
		<td align="center" style="padding-top: 15"><input name="submit" type="submit" class="input2" onClick="return valida_mensagem_global()" value="ALTERAR"></td>
	</tr>
</table>
</form>

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