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
$rodada = anti_inj($_GET['r']);

if (ereg('[^0-9]',$rodada)) {
	header("Location: index.php"); break;
}

$query = mysql_query("SELECT Rodada FROM Configuracoes");
$rs = mysql_fetch_array($query);

$rodada_atual = $rs["Rodada"];

if (!$rodada) {
	$rodada = $rodada_atual;
}

if ($rodada < 20) {
	$rodada = 20;
}

if ($rodada > 24) {
	$rodada = 24;
}

if ($rodada == 20) {
	$fase = "Primeira Fase";
} else if ($rodada == 21) {
	$fase = "Oitavas de Final";
} else if ($rodada == 22) {
	$fase = "Quartas de Final";
} else if ($rodada == 23) {
	$fase = "Semifinal";
} else if ($rodada == 24) {
	$fase = "Final";
}

ob_end_flush();
?> 

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Copa Brasil</h1></div></div></div>
	<div class="conteudo">

<div id="linha10" style="text-align: center"><a href="copa_brasil.php?r=20"><img src="figuras/principal/botao_primeira_fase.png" border="0"></a> <a href="copa_brasil.php?r=21"><img src="figuras/principal/botao_oitavas.png" border="0"></a> <a href="copa_brasil.php?r=22"><img src="figuras/principal/botao_quartas.png" border="0"></a> <a href="copa_brasil.php?r=23"><img src="figuras/principal/botao_semifinal.png" border="0"></a> <a href="copa_brasil.php?r=24"><img src="figuras/principal/botao_final.png" border="0"></a></div>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<div id="divide"></div>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1><?=$fase?></h1></div></div></div>
	<div class="conteudo">

<?php if ($rodada_atual < $rodada and $rodada_atual < 20) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Aguarde o fim do Campeonato FC.</div>

<?php } else if ($rodada_atual < $rodada and $rodada_atual > 19) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Aguarde a definição da fase anterior.</div>

<?php } else { ?>

<div id="linha10">

<table width="550" cellpadding="0" cellspacing="0">

<?php

$jogo = 0;

$query = mysql_query("SELECT Jogos.Time_2 as Time_2_ID2, Jogos.Placar_1 as Placar_1, Jogos.Placar_2 as Placar_2, Times.ID as Time_1_ID, Times.Time as Time_1_Nome FROM Jogos INNER JOIN Times ON Times.ID2 = Jogos.Time_1 WHERE Rodada = '". $rodada ."' AND Campeonato = 5 ORDER BY Jogos.ID");

?>

<?php while ($rs = mysql_fetch_array($query)) { ?>

<?php $jogo = $jogo + 1; ?>

<?php

$query2 = mysql_query("SELECT ID, Time FROM Times WHERE ID2 = '". $rs["Time_2_ID2"] ."'");
$rs2 = mysql_fetch_array($query2);

$time_2_id = $rs2["ID"];
$time_2_nome = $rs2["Time"];

?>

	<tr height="32" <?php if ($jogo == 1 or $jogo == 3 or $jogo == 5 or $jogo == 7 or $jogo == 9 or $jogo == 11 or $jogo == 13 or $jogo == 15) { ?>bgcolor="#CCC"<?php } ?>>
		<td width="182" style="padding-right: 5px" align="right"><a href="time.php?id=<?=$rs["Time_1_ID"]?>"><?=$rs["Time_1_Nome"]?></a></td>
		<td width="23" align="right"><a href="time.php?id=<?=$rs["Time_1_ID"]?>"><img width="20" height="20" src="figuras/times_pequenos/<?=$rs["Time_1_ID"]?>.png" title="<?=$rs["Time_1_Nome"]?>" alt="<?=$rs["Time_1_Nome"]?>" border="0"></a></td>
		<td width="57" class="fonte1_negrito" align="right"><?=number_format($rs["Placar_1"],0,',','.')?></td>
		<td width="26" align="center"><?php if ($rodada == $rodada_atual) { ?><a href="rodada.php?id=<?=$rs["Time_1_ID"]?>"><img width="11" height="11" src="figuras/principal/x.png" border="0"></a><?php } else { ?><img width="11" height="11" src="figuras/principal/x.png"><?php } ?></td>
		<td width="57" class="fonte1_negrito"><?=number_format($rs["Placar_2"],0,',','.')?></td>
		<td width="23"><a href="time.php?id=<?=$time_2_id?>"><img width="20" height="20" src="figuras/times_pequenos/<?=$time_2_id?>.png" title="<?=$time_2_nome?>" alt="<?=$time_2_nome?>" border="0"></a></td>
		<td width="182" class="fonte1" style="padding-left: 5px"><a href="time.php?id=<?=$time_2_id?>"><?=$time_2_nome?></a></td>
	</tr>

<?php } ?>

</table>

</div>

<?php } ?>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<div id="divide"></div>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Prêmios dos Times</h1></div></div></div>
	<div class="conteudo">

<div id="linha10"><b>1º</b> - 500.000 Fc e 30 de Reputação</div>
<div id="linha10"><b>2º</b> - 250.000 Fc e 15 de Reputação</div>

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