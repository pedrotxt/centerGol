<?php ob_start(); ?>
<?php include("fun_anti_inj.php") ?>
<?php include("conexao.php") ?>
<?php include("verificar_conexao.php") ?>
<html>
<?php include("head.php") ?>
<?php include("verificar_cargo.php") ?>
<?php ob_end_flush(); ?>
<script language="javascript">
function valida_configuracoes()
{
if (document.configuracoes.rodada.value==""){
alert("É necessário preencher a rodada.");
document.configuracoes.rodada.focus();
return false; }

if (document.configuracoes.temporada.value==""){
alert("É necessário preencher a temporada.");
document.configuracoes.temporada.focus();
return false; }

if (document.configuracoes.dinheiro_chutar.value==""){
alert("É necessário preencher o dinheiro chutar.");
document.configuracoes.dinheiro_chutar.focus();
return false; }

if (document.configuracoes.dinheiro_passe_certo.value==""){
alert("É necessário preencher o dinheiro passe certo.");
document.configuracoes.dinheiro_passe_certo.focus();
return false; }

if (document.configuracoes.dinheiro_penalti.value==""){
alert("É necessário preencher o dinheiro penalti.");
document.configuracoes.dinheiro_penalti.focus();
return false; }

if (document.configuracoes.convite.value==""){
alert("É necessário preencher o convite.");
document.configuracoes.convite.focus();
return false; }

if (document.configuracoes.sorteio.value==""){
alert("É necessário preencher o sorteio.");
document.configuracoes.sorteio.focus();
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

<?php
$query = mysql_query("SELECT Rodada, Temporada, Dinheiro_Chutar, Dinheiro_Passe_Certo, Dinheiro_Penalti, Sorteio_Acumulado, Convite FROM Configuracoes");
$rs = mysql_fetch_array($query);

$rodada = $rs["Rodada"];
$temporada = $rs["Temporada"];
$dinheiro_chutar = $rs["Dinheiro_Chutar"];
$dinheiro_passe_certo = $rs["Dinheiro_Passe_Certo"];
$dinheiro_penalti = $rs["Dinheiro_Penalti"];
$sorteio = $rs["Sorteio_Acumulado"];
$convite = $rs["Convite"];
?>
<form name="configuracoes" method="post" action="configuracoes_salvar.php" onSubmit="return valida_configuracoes()">
<table id="tabela" width="426" cellpadding="0" cellspacing="0">
	<tr>
		<td class="fonte_titulo1">Configurações</td>
	</tr>
<?php if (anti_inj($_GET["msg"]) == 1) { ?>
	<tr>
		<td align="center" style="padding-top: 15; padding-bottom: 5">

<table width="242" cellpadding="0" cellspacing="0">
	<tr>
		<td width="20"><img src="../figuras/painel/alerta_sim.png"></td>
		<td class="fonte1">Configurações alteradas com sucesso!</td>
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
		<td align="center" style="padding-top: 10; padding-bottom: 10">
<table width="240" cellpadding="0" cellspacing="0">
	<tr>
		<td width="100" class="fonte1">Rodada:</td>
		<td width="140"><input name="rodada" type="text" class="fonte1" size="22" maxlength="2" value="<?=$rodada?>"></td>
	</tr>
	<tr>
		<td class="fonte1" style="padding-top: 10">Temporada:</td>
		<td style="padding-top: 10"><input name="temporada" type="text" class="fonte1" size="22" maxlength="3" value="<?=$temporada?>"></td>
	</tr>
	<tr>
		<td colspan="2" class="fonte1_negrito" style="padding-top: 15">Dinheiro: (futcash por gol feito)</td>
	</tr>
	<tr>
		<td class="fonte1" style="padding-top: 10">Chute:</td>
		<td style="padding-top: 10"><input name="dinheiro_chutar" type="text" class="fonte1" size="10" maxlength="2" value="<?=$dinheiro_chutar?>"></td>
	</tr>
	<tr>
		<td class="fonte1" style="padding-top: 10">Passe Certo:</td>
		<td style="padding-top: 10"><input name="dinheiro_passe_certo" type="text" class="fonte1" size="10" maxlength="2" value="<?=$dinheiro_passe_certo?>"></td>
	</tr>
	<tr>
		<td class="fonte1" style="padding-top: 10">Penalti:</td>
		<td style="padding-top: 10"><input name="dinheiro_penalti" type="text" class="fonte1" size="10" maxlength="2" value="<?=$dinheiro_penalti?>"></td>
	</tr>
	<tr>
		<td colspan="2" class="fonte1_negrito" style="padding-top: 15">Outros:</td>
	</tr>
	<tr>
		<td class="fonte1" style="padding-top: 10">Convite:</td>
		<td class="fonte1" style="padding-top: 10"><input name="convite" type="text" class="fonte1" size="10" maxlength="5" value="<?=$convite?>"></td>
	</tr>
	<tr>
		<td colspan="2" class="fonte1" style="padding-top: 10">(futcash quando amigo fizer 10 gols)</td>
	</tr>
	<tr>
		<td class="fonte1" style="padding-top: 15">Sorteio Acumulado:</td>
		<td class="fonte1" style="padding-top: 15"><input name="sorteio" type="text" class="fonte1" size="10" maxlength="8" value="<?=$sorteio?>"></td>
	</tr>
</table>
		</td>
	</tr>
	<tr>
		<td align="center" style="padding-top: 10; padding-bottom: 10;"><input name="submit" type="submit" class="input2" onClick="return valida_configuracoes()" value="ALTERAR"></td>
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