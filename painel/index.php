<?php include("fun_anti_inj.php") ?>
<?php include("conexao.php") ?>
<?php include("verificar_conexao.php") ?>
<html>
<?php include("head.php") ?>
<body>
<center>
<?php
$query = mysql_query("SELECT Count(ID) AS online FROM Usuarios WHERE Status = 1");
$rs = mysql_fetch_array($query);

$online = $rs["online"];


$query = mysql_query("SELECT Count(ID) AS stfc FROM STFC");
$rs = mysql_fetch_array($query);

$stfc = $rs["stfc"];


$data = date("Y-m-d") ." 00:00:00";

$query = mysql_query("SELECT Count(ID) AS cadastrados_hoje FROM Usuarios WHERE Cadastro >= '". $data ."' AND Confirmar = '0'");
$rs = mysql_fetch_array($query);

$cadastrados_hoje = $rs["cadastrados_hoje"];


$query = mysql_query("SELECT Count(ID) AS cadastrados FROM Usuarios WHERE Confirmar = '0'");
$rs = mysql_fetch_array($query);

$cadastrados = $rs["cadastrados"];


$query = mysql_query("SELECT Count(ID) AS convidados_hoje FROM Usuarios WHERE Cadastro >= '". $data ."' AND Convite <> 0 AND Confirmar = '0'");
$rs = mysql_fetch_array($query);

$convidados_hoje = $rs["convidados_hoje"];

$query = mysql_query("SELECT Count(ID) AS convidados FROM Usuarios WHERE Convite <> 0 AND Confirmar = '0'");
$rs = mysql_fetch_array($query);

$convidados = $rs["convidados"];


$query = mysql_query("SELECT Gols_Rodada, Gols_Temporada, Gols_Total, Online_Record FROM Configuracoes");
$rs = mysql_fetch_array($query);

$gols_rodada = $rs["Gols_Rodada"];
$gols_temporada = $rs["Gols_Temporada"];
$gols_total = $rs["Gols_Total"];
$online_record = $rs["Online_Record"];

$hora = date("H");

if ($hora >= 18) {
	$saudacao = "Boa noite";
} else if ($hora >= 12) {
	$saudacao =  "Boa tarde";
} else {
	$saudacao = "Bom dia";
}
?>
<table width="770" cellpadding="0" cellspacing="0">
	<tr>
		<td id="cima" colspan="2"><?php include("cima.php") ?></td>
	</tr>
	<tr>
		<td id="menu" align="right"><?php include("menu.php") ?></td>
		<td id="principal" align="center">

<table id="tabela" width="426" cellpadding="0" cellspacing="0">
	<tr>
		<td class="fonte_titulo1">Principal</td>
	</tr>
	<tr>
		<td class="fonte1" style="padding-left: 10; padding-top: 10"><?=$saudacao?> <b><?=$mc_nome?></b>.</td>
	</tr>
	<tr>
		<td class="fonte1" style="padding-left: 10; padding-top: 10"><b><?=$online?></b> usuários online / <b><?=$online_record?></b> record</td>
	</tr>
	<tr>
		<td id="normal1" style="padding-left: 10; padding-top: 10"><a href="stfc.php"><span id="normal1_negrito"><?=$stfc?></span> denúncias</a></td>
	</tr>
	<tr>
		<td class="fonte1" style="padding-left: 10; padding-top: 10"><b><?=$gols_rodada?></b> gols na rodada</td>
	</tr>
	<tr>
		<td class="fonte1" style="padding-left: 10; padding-top: 10"><b><?=$gols_temporada?></b> gols na temporada</td>
	</tr>
	<tr>
		<td class="fonte1" style="padding-left: 10; padding-top: 10; padding-bottom: 10"><b><?=$gols_total?></b> gols no total</td>
	</tr>
</table>

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
		<td class="fonte_titulo1">Cadastros</td>
	</tr>
	<tr>
		<td class="fonte1" style="padding-left: 10; padding-top: 10"><b><?=$cadastrados_hoje?></b> cadastrados hoje</td>
	</tr>
	<tr>
		<td class="fonte1" style="padding-left: 10; padding-top: 10"><b><?=$cadastrados?></b> cadastrados no total</td>
	</tr>
	<tr>
		<td class="fonte1" style="padding-left: 10; padding-top: 10"><b><?=$convidados_hoje?></b> convidados hoje</td>
	</tr>
	<tr>
		<td class="fonte1" style="padding-left: 10; padding-top: 10; padding-bottom: 10"><b><?=$convidados?></b> convidados no total</td>
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