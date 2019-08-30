<?php ob_start(); ?>
<?php include("fun_anti_inj.php") ?>
<?php include("conexao.php") ?>
<?php include("verificar_conexao.php") ?>
<?php
$id = anti_inj($_GET['id']);

if (!$id) {
	header("Location: times.php"); break;
}

if (ereg('[^0-9]',$id)) {
	header("Location: times.php"); break;
}

if ($id < 1) {
	header("Location: times.php"); break;
}
?>
<html>
<?php include("head.php") ?>
<?php include("verificar_cargo.php") ?>
<?php ob_end_flush(); ?>
<script language="javascript" src="../js/principal.js"></script>
<script language="javascript">
function valida_time()
{
if (document.time.time_nome.value==""){
alert("É necessário preencher o time.");
document.time.time_nome.focus();
return false; }

if (document.time.estado.value==""){
alert("É necessário preencher o estado.");
document.time.estado.focus();
return false; }

if (document.time.serie.value==""){
alert("É necessário preencher a série.");
document.time.serie.focus();
return false; }

if (document.time.estadio.value==""){
alert("É necessário preencher o estádio.");
document.time.estadio.focus();
return false; }

if (document.time.capacidade.value==""){
alert("É necessário preencher a capacidade.");
document.time.capacidade.focus();
return false; }

if (document.time.ingresso.value==""){
alert("É necessário preencher o ingresso.");
document.time.ingresso.focus();
return false; }

if (document.time.reputacao.value==""){
alert("É necessário preencher a reputação.");
document.time.reputacao.focus();
return false; }

if (document.time.dinheiro.value==""){
alert("É necessário preencher o dinheiro.");
document.time.dinheiro.focus();
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
$query = mysql_query("SELECT Time, Estado, Estadio, Capacidade, Ingresso, Reputacao, Dinheiro, Campeonato_FC_Titulos, Campeonato_FC_Vices, Copa_Brasil_Titulos, Copa_Brasil_Vices, Copa_FC_Titulos, Copa_FC_Vices, Presidente, Diretor, Olheiro_1, Olheiro_2, Olheiro_3, Texto FROM Times WHERE ID = '". $id ."'");
$rs = mysql_fetch_array($query);

if (!$rs) {
	header("Location: times.php"); break;
}

$time = $rs["Time"];
$estado = $rs["Estado"];
$estadio = $rs["Estadio"];
$capacidade = $rs["Capacidade"];
$ingresso = $rs["Ingresso"];
$reputacao = $rs["Reputacao"];
$dinheiro = $rs["Dinheiro"];
$campeonato_fc_titulos = $rs["Campeonato_FC_Titulos"];
$campeonato_fc_vices = $rs["Campeonato_FC_Vices"];
$copa_brasil_titulos = $rs["Copa_Brasil_Titulos"];
$copa_brasil_vices = $rs["Copa_Brasil_Vices"];
$copa_fc_titulos = $rs["Copa_FC_Titulos"];
$copa_fc_vices = $rs["Copa_FC_Vices"];
$presidente = $rs["Presidente"];
$diretor = $rs["Diretor"];
$olheiro_1 = $rs["Olheiro_1"];
$olheiro_2 = $rs["Olheiro_2"];
$olheiro_3 = $rs["Olheiro_3"];
$texto = $rs["Texto"];

if ($presidente != 0) {

$query = mysql_query("SELECT Usuario, VIP, VIP_Cor FROM Usuarios WHERE ID = '". $presidente ."'");
$rs = mysql_fetch_array($query);

$presidente_nome = $rs["Usuario"];
$presidente_vip = $rs["VIP"];
$presidente_vip_cor = $rs["VIP_Cor"];

}

if ($diretor != 0) {

$query = mysql_query("SELECT Usuario, VIP, VIP_Cor FROM Usuarios WHERE ID = '". $diretor ."'");
$rs = mysql_fetch_array($query);

$diretor_nome = $rs["Usuario"];
$diretor_vip = $rs["VIP"];
$diretor_vip_cor = $rs["VIP_Cor"];

}

if ($olheiro_1 != 0) {

$query = mysql_query("SELECT Usuario, VIP, VIP_Cor FROM Usuarios WHERE ID = '". $olheiro_1 ."'");
$rs = mysql_fetch_array($query);

$olheiro_1_nome = $rs["Usuario"];
$olheiro_1_vip = $rs["VIP"];
$olheiro_1_vip_cor = $rs["VIP_Cor"];

}

if ($olheiro_2 != 0) {

$query = mysql_query("SELECT Usuario, VIP, VIP_Cor FROM Usuarios WHERE ID = '". $olheiro_2 ."'");
$rs = mysql_fetch_array($query);

$olheiro_2_nome = $rs["Usuario"];
$olheiro_2_vip = $rs["VIP"];
$olheiro_2_vip_cor = $rs["VIP_Cor"];

}

if ($olheiro_3 != 0) {

$query = mysql_query("SELECT Usuario, VIP, VIP_Cor FROM Usuarios WHERE ID = '". $olheiro_3 ."'");
$rs = mysql_fetch_array($query);

$olheiro_3_nome = $rs["Usuario"];
$olheiro_3_vip = $rs["VIP"];
$olheiro_3_vip_cor = $rs["VIP_Cor"];

}
?>

<form name="time" method="post" action="time_salvar.php?id=<?=$id?>" onSubmit="return valida_time()">
<table id="tabela" width="426" cellpadding="0" cellspacing="0">
	<tr>
		<td class="fonte_titulo1">Time</td>
	</tr>
<?php if (anti_inj($_GET["msg"]) == 1) { ?>
	<tr>
		<td align="center" style="padding-top: 15; padding-bottom: 5">

<table width="182" cellpadding="0" cellspacing="0">
	<tr>
		<td width="20"><img src="../figuras/painel/alerta_sim.png"></td>
		<td class="fonte1">Time alterado com sucesso!</td>
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
		<td width="20"><img src="../figuras/painel/alerta_sim.png"></td>
		<td class="fonte1">Cúpula removida com sucesso!</td>
	</tr>
</table>

		</td>
	</tr>
<?php } ?>
	<tr>
		<td align="center" style="padding-top: 10; padding-bottom: 10">
<table width="250" cellpadding="0" cellspacing="0">
	<tr>
		<td width="80" class="fonte1">Time:</td>
		<td width="170"><input name="time" type="text" class="fonte1" size="22" maxlength="50" value="<?=$time?>"></td>
	</tr>
	<tr>
		<td class="fonte1" style="padding-top: 10">Estado:</td>
		<td style="padding-top: 10"><input name="estado" type="text" class="fonte1" size="22" maxlength="2" value="<?=$estado?>"></td>
	</tr>
	<tr>
		<td class="fonte1" style="padding-top: 10">Estádio:</td>
		<td style="padding-top: 10"><input name="estadio" type="text" class="fonte1" size="22" maxlength="50" value="<?=$estadio?>"></td>
	</tr>
	<tr>
		<td class="fonte1" style="padding-top: 10">Capacidade:</td>
		<td style="padding-top: 10"><input name="capacidade" type="text" class="fonte1" size="22" maxlength="7" value="<?=$capacidade?>"></td>
	</tr>
	<tr>
		<td class="fonte1" style="padding-top: 10">Ingresso:</td>
		<td style="padding-top: 10"><select name="ingresso" size="1" class="fonte1">
<option value="5" <?php if ($ingresso == 5) { ?>selected<?php } ?>>5</option>
<option value="10" <?php if ($ingresso == 10) { ?>selected<?php } ?>>10</option>
</select></td>
	</tr>
	<tr>
		<td class="fonte1" style="padding-top: 10">Reputação:</td>
		<td style="padding-top: 10"><input name="reputacao" type="text" class="fonte1" size="22" maxlength="50" value="<?=$reputacao?>"></td>
	</tr>
	<tr>
		<td class="fonte1" style="padding-top: 10">Dinheiro:</td>
		<td style="padding-top: 10"><input name="dinheiro" type="text" class="fonte1" size="22" maxlength="50" value="<?=$dinheiro?>"></td>
	</tr>
	<tr>
		<td colspan="3" style="padding-top: 10"><textarea name="texto" cols="29" rows="4" class="fonte1" onKeyDown="limite_texto(this, this.form.contador, 200);" onKeyUp="limite_texto(this, this.form.contador, 200);"><?=$texto?></textarea> <input name="contador" class="fonte1" size="3" value="200" disabled></td>
	</tr>
	<tr>
		<td class="fonte1" style="padding-top: 10">Campeonato FC Títulos:</td>
		<td style="padding-top: 10"><input name="campeonato_fc_titulos" type="text" class="fonte1" size="22" maxlength="5" value="<?=$campeonato_fc_titulos?>"></td>
	</tr>
	<tr>
		<td class="fonte1" style="padding-top: 10">Campeonato FC Vices:</td>
		<td style="padding-top: 10"><input name="campeonato_fc_vices" type="text" class="fonte1" size="22" maxlength="5" value="<?=$campeonato_fc_vices?>"></td>
	</tr>
	<tr>
		<td class="fonte1" style="padding-top: 10">Copa Brasil Títulos:</td>
		<td style="padding-top: 10"><input name="copa_brasil_titulos" type="text" class="fonte1" size="22" maxlength="5" value="<?=$copa_brasil_titulos?>"></td>
	</tr>
	<tr>
		<td class="fonte1" style="padding-top: 10">Copa Brasil Vices:</td>
		<td style="padding-top: 10"><input name="copa_brasil_vices" type="text" class="fonte1" size="22" maxlength="5" value="<?=$copa_brasil_vices?>"></td>
	</tr>
	<tr>
		<td class="fonte1" style="padding-top: 10">Copa FC Títulos:</td>
		<td style="padding-top: 10"><input name="copa_fc_titulos" type="text" class="fonte1" size="22" maxlength="5" value="<?=$copa_fc_titulos?>"></td>
	</tr>
	<tr>
		<td class="fonte1" style="padding-top: 10">Copa FC Vices:</td>
		<td style="padding-top: 10"><input name="copa_fc_vices" type="text" class="fonte1" size="22" maxlength="5" value="<?=$copa_fc_vices?>"></td>
	</tr>
</table>
		</td>
	</tr>
	<tr>
		<td align="center" style="padding-top: 10; padding-bottom: 10;"><input name="submit" type="submit" class="input2" onClick="return valida_time()" value="ALTERAR"> <input name="voltar" type="button" class="input2" onClick="location.href='times.php'" value="VOLTAR"></td>
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
		<td class="fonte_titulo1">Cúpula</td>
	</tr>
	<tr>
		<td class="fonte1" style="padding: 10">

	<div class="conteudo">

<?php if ($presidente != 0) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="../figuras/principal/presidente.png" title="Presidente" alt="Presidente"></span> <a href="usuario.php?id=<?=$presidente?>"><?php if ($presidente_vip > 0) { ?><span id="usuario_vip<?=$presidente_vip_cor?>"><?=$presidente_nome?></span><?php } else { ?><span id="usuario_normal"><?=$presidente_nome?></span><?php } ?></a></div>


<?php if ($diretor != 0) { ?>
<table>
	<tr>
		<td class="tabela_divisao"></td>
	</tr>
</table>

<div id="linha10"><span class="img16"><img width="16" height="16" src="../figuras/principal/diretor.png" title="Diretor" alt="Diretor"></span> <a href="usuario.php?id=<?=$diretor?>"><?php if ($diretor_vip > 0) { ?><span id="usuario_vip<?=$diretor_vip_cor?>"><?=$diretor_nome?></span><?php } else { ?><span id="usuario_normal"><?=$diretor_nome?></span><?php } ?></a></div>

<?php } ?>

<?php if ($olheiro_1 != 0) { ?>

<table>
	<tr>
		<td class="tabela_divisao"></td>
	</tr>
</table>

<div id="linha10"><span class="img16"><img width="16" height="16" src="../figuras/principal/olheiro.png" title="Olheiro" alt="Olheiro"></span> <a href="usuario.php?id=<?=$olheiro_1?>"><?php if ($olheiro_1_vip > 0) { ?><span id="usuario_vip<?=$olheiro_1_vip_cor?>"><?=$olheiro_1_nome?></span><?php } else { ?><span id="usuario_normal"><?=$olheiro_1_nome?></span><?php } ?></a></div>

<?php } ?>

<?php if ($olheiro_2 != 0) { ?>
<table>
	<tr>
		<td class="tabela_divisao"></td>
	</tr>
</table>

<div id="linha10"><span class="img16"><img width="16" height="16" src="../figuras/principal/olheiro.png" title="Olheiro" alt="Olheiro"></span> <a href="usuario.php?id=<?=$olheiro_2?>"><?php if ($olheiro_2_vip > 0) { ?><span id="usuario_vip<?=$olheiro_2_vip_cor?>"><?=$olheiro_2_nome?></span><?php } else { ?><span id="usuario_normal"><?=$olheiro_2_nome?></span><?php } ?></a></div>

<?php } ?>

<?php if ($olheiro_3 != 0) { ?>
<table>
	<tr>
		<td class="tabela_divisao"></td>
	</tr>
</table>

<div id="linha10"><span class="img16"><img width="16" height="16" src="../figuras/principal/olheiro.png" title="Olheiro" alt="Olheiro"></span> <a href="usuario.php?id=<?=$olheiro_3?>"><?php if ($olheiro_3_vip > 0) { ?><span id="usuario_vip<?=$olheiro_3_vip_cor?>"><?=$olheiro_3_nome?></span><?php } else { ?><span id="usuario_normal"><?=$olheiro_3_nome?></span><?php } ?></a></div>

<?php } ?>

<table>
	<tr>
		<td class="tabela_divisao"></td>
	</tr>
</table>

<a href="time_excluir.php?id=<?=$id?>"><b>» excluir cúpula completa</b></a>

<?php } else { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="../figuras/painel/alerta_nao.png"></span> Time sem Presidente no momento.</div>

<?php } ?>

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