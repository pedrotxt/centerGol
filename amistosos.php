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


<?php
$query = mysql_query("SELECT Rodada FROM Configuracoes");
$rs = mysql_fetch_array($query);

$rodada_atual = $rs["Rodada"];
if($rodada_atual == 0){ ?>	

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Amistosos</h1></div></div></div>
	<div class="conteudo">

<div id="linha10">

<table width="550" cellpadding="0" cellspacing="0">

<?php

$jogo = 0;

$query = mysql_query("SELECT Jogos.Time_2 as Time_2_ID2, Jogos.Placar_1 as Placar_1, Jogos.Placar_2 as Placar_2, Times.ID as Time_1_ID, Times.Time as Time_1_Nome FROM Jogos INNER JOIN Times ON Times.ID2 = Jogos.Time_1 WHERE Rodada = '". $rodada_atual ."' AND Campeonato = 0 ORDER BY Jogos.ID");

?>

<?php while ($rs = mysql_fetch_array($query)) { ?>

<?php $jogo = $jogo + 1; ?>

<?php

$query2 = mysql_query("SELECT ID, Time FROM Times WHERE ID2 = '". $rs["Time_2_ID2"] ."'");
$rs2 = mysql_fetch_array($query2);

$time_2_id = $rs2["ID"];
$time_2_nome = $rs2["Time"];

?>

	<tr height="32" <?php if ($jogo == 1 or $jogo == 3 or $jogo == 5 or $jogo == 7 or $jogo == 9 or $jogo == 11 or $jogo == 13 or $jogo == 15 or $jogo == 17 or $jogo == 19 or $jogo == 21 or $jogo == 23 or $jogo == 25 or $jogo == 27 or $jogo == 29 or $jogo == 31 or $jogo == 33 or $jogo == 35 or $jogo == 37 or $jogo == 39) { ?>bgcolor="#CCC"<?php } ?>>
		<td width="182" style="padding-right: 5px" align="right"><a href="time.php?id=<?=$rs["Time_1_ID"]?>"><?=$rs["Time_1_Nome"]?></a></td>
		<td width="23" align="right"><a href="time.php?id=<?=$rs["Time_1_ID"]?>"><img width="20" height="20" src="figuras/times_pequenos/<?=$rs["Time_1_ID"]?>.png" title="<?=$rs["Time_1_Nome"]?>" alt="<?=$rs["Time_1_Nome"]?>" border="0"></a></td>
		<td width="57" class="fonte1_negrito" align="right"><?=number_format($rs["Placar_1"],0,',','.')?></td>
		<td width="26" align="center"><a href="rodada.php?id=<?=$rs["Time_1_ID"]?>"><img width="11" height="11" src="figuras/principal/x.png" border="0"></a></td>
		<td width="57" class="fonte1_negrito"><?=number_format($rs["Placar_2"],0,',','.')?></td>
		<td width="23"><a href="time.php?id=<?=$time_2_id?>"><img width="20" height="20" src="figuras/times_pequenos/<?=$time_2_id?>.png" title="<?=$time_2_nome?>" alt="<?=$time_2_nome?>" border="0"></a></td>
		<td width="182" class="fonte1" style="padding-left: 5px"><a href="time.php?id=<?=$time_2_id?>"><?=$time_2_nome?></a></td>
	</tr>

<?php } ?>

</table>

</div>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<?php
}else{
$query = mysql_query("SELECT ID FROM Jogos WHERE Rodada = '". $rodada_atual ."' AND Campeonato = 7");
$rs = mysql_fetch_array($query);

if ($rs) {
	$verificar = 1;
}

ob_end_flush();
?>

<?php if ($verificar == 1) { ?>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Amistosos</h1></div></div></div>
	<div class="conteudo">

<div id="linha10">

<table width="550" cellpadding="0" cellspacing="0">

<?php

$jogo = 0;

$query = mysql_query("SELECT Jogos.Time_2 as Time_2_ID2, Jogos.Placar_1 as Placar_1, Jogos.Placar_2 as Placar_2, Times.ID as Time_1_ID, Times.Time as Time_1_Nome FROM Jogos INNER JOIN Times ON Times.ID2 = Jogos.Time_1 WHERE Rodada = '". $rodada_atual ."' AND Campeonato = 7 ORDER BY Jogos.ID");

?>

<?php while ($rs = mysql_fetch_array($query)) { ?>

<?php $jogo = $jogo + 1; ?>

<?php

$query2 = mysql_query("SELECT ID, Time FROM Times WHERE ID2 = '". $rs["Time_2_ID2"] ."'");
$rs2 = mysql_fetch_array($query2);

$time_2_id = $rs2["ID"];
$time_2_nome = $rs2["Time"];

?>

	<tr height="32" <?php if ($jogo == 1 or $jogo == 3 or $jogo == 5 or $jogo == 7 or $jogo == 9 or $jogo == 11 or $jogo == 13 or $jogo == 15 or $jogo == 17 or $jogo == 19 or $jogo == 21 or $jogo == 23 or $jogo == 25 or $jogo == 27 or $jogo == 29 or $jogo == 31 or $jogo == 33 or $jogo == 35 or $jogo == 37 or $jogo == 39) { ?>bgcolor="#CCC"<?php } ?>>
		<td width="182" style="padding-right: 5px" align="right"><a href="time.php?id=<?=$rs["Time_1_ID"]?>"><?=$rs["Time_1_Nome"]?></a></td>
		<td width="23" align="right"><a href="time.php?id=<?=$rs["Time_1_ID"]?>"><img width="20" height="20" src="figuras/times_pequenos/<?=$rs["Time_1_ID"]?>.png" title="<?=$rs["Time_1_Nome"]?>" alt="<?=$rs["Time_1_Nome"]?>" border="0"></a></td>
		<td width="57" class="fonte1_negrito" align="right"><?=number_format($rs["Placar_1"],0,',','.')?></td>
		<td width="26" align="center"><a href="rodada.php?id=<?=$rs["Time_1_ID"]?>"><img width="11" height="11" src="figuras/principal/x.png" border="0"></a></td>
		<td width="57" class="fonte1_negrito"><?=number_format($rs["Placar_2"],0,',','.')?></td>
		<td width="23"><a href="time.php?id=<?=$time_2_id?>"><img width="20" height="20" src="figuras/times_pequenos/<?=$time_2_id?>.png" title="<?=$time_2_nome?>" alt="<?=$time_2_nome?>" border="0"></a></td>
		<td width="182" class="fonte1" style="padding-left: 5px"><a href="time.php?id=<?=$time_2_id?>"><?=$time_2_nome?></a></td>
	</tr>

<?php } ?>

</table>

</div>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<?php } else { ?>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Amistosos</h1></div></div></div>
	<div class="conteudo">

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Aguarde o fim do brasileirão.</div>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<?php }} ?>

<div id="divide"></div>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Importante</h1></div></div></div>
	<div class="conteudo">

<div id="linha10">Seu time não se classificou no brasileirão? Jogará Amistoso!</div>
<div id="linha10">Seu time foi eliminado da Copa Brasil? Jogará Amistoso!</div>
<div id="linha10">Seu time foi eliminado da copa cg? Jogará Amistoso!</div>
<div id="linha10">Os confrontos são formados de forma randômica pelo sistema.</div>

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