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
$id = anti_inj($_GET['id']);

if (!$id) {
	header("Location: index.php"); break;
}

if ($id != 1 and $id != 2 and $id != 3) {
	header("Location: index.php"); break;
}

$cor_copa_fc = "bgcolor=#43BD09";
$cor_copa_brasil = "bgcolor=#9DCBFD";
$cor_rebaixado = "bgcolor=#FF0000";
$cor_normal = "bgcolor=#CCC";

if ($id == 1) {
	$where = "Tabela_Campeonato.Serie = 'A'";
} else if ($id == 2) {
	$where = "Tabela_Campeonato.Serie = 'B'";
} else if ($id == 3) {
	$where = "Tabela_Campeonato.Serie = 'C'";
}

$query = mysql_query("SELECT Temporada FROM Configuracoes");
$rs = mysql_fetch_array($query);

$temporada = $rs["Temporada"];

ob_end_flush();
?>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Brasileirão</h1></div></div></div>
	<div class="conteudo">

<div id="linha10" style="text-align: center"><a href="brasileirao_classificacao.php?id=1"><img src="figuras/principal/botao_serie_a.png" border="0"></a> <a href="brasileirao_classificacao.php?id=2"><img src="figuras/principal/botao_serie_b.png" border="0"></a> <a href="brasileirao_classificacao.php?id=3"><img src="figuras/principal/botao_serie_c.png" border="0"></a></div>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<div id="divide"></div>
<? if($id == 1){
	$serie='A';
}elseif($id == 2){
	$serie='B';
}else{
	$serie='C';
}
?>
<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Serie <?=$serie?> - Temporada <?=$temporada?></h1></div></div></div>
	<div class="conteudo">

<div id="linha10">

<table width="550" cellpadding="0" cellspacing="1">
	<tr bgcolor="#B6B6B6">
		<td width="30" height="25">&nbsp;</td>
		<td width="220" class="fonte1_negrito" align="center">Time</td>
		<td width="46" class="fonte1_negrito" align="center">PG</td>
		<td width="42" class="fonte1_negrito" align="center">J</td>
		<td width="42" class="fonte1_negrito" align="center">V</td>
		<td width="42" class="fonte1_negrito" align="center">E</td>
		<td width="42" class="fonte1_negrito" align="center">D</td>
		<td width="86" class="fonte1_negrito" align="center">SG</td>
	</tr>

<?php

$colocacao = 0;

$query = mysql_query("SELECT Tabela_Campeonato.Pontos as Time_Pontos, Tabela_Campeonato.Jogos as Time_Jogos, Tabela_Campeonato.Vitorias as Time_Vitorias, Tabela_Campeonato.Empates as Time_Empates, Tabela_Campeonato.Derrotas as Time_Derrotas, Tabela_Campeonato.SG as Time_SG, Times.ID as Time_ID, Times.Time as Time_Nome FROM Tabela_Campeonato INNER JOIN Times ON Times.ID2 = Tabela_Campeonato.Time WHERE ". $where ." ORDER BY Tabela_Campeonato.Pontos DESC, Tabela_Campeonato.Vitorias DESC, Tabela_Campeonato.SG DESC, Tabela_Campeonato.Derrotas, Tabela_Campeonato.Time LIMIT 20");

?>

<?php while ($rs = mysql_fetch_array($query)) { ?>

<?php $colocacao = $colocacao + 1; ?>

	<tr>
		<td class="fonte2_negrito" align="center" bgcolor="#666" style="padding: 3px 0 3px 0"><?=$colocacao?></td>
		<td <?php if ($colocacao  <=4) { ?><?=$cor_copa_fc?><?php } else if ($colocacao > 4 and $colocacao <= 11) { ?><?=$cor_copa_brasil?><?php } else if ($colocacao > 11 and $colocacao <= 16) { ?><?=$cor_normal?><?php } else { ?><?=$cor_rebaixado?><?php } ?> style="padding: 3px 0 3px 5px"><a href="time.php?id=<?=$rs["Time_ID"]?>"><span class="img20"><img width="20" height="20" src="figuras/times_pequenos/<?=$rs["Time_ID"]?>.png" title="<?=$rs["Time_Nome"]?>" alt="<?=$rs["Time_Nome"]?>" border="0"></span> <?=$rs["Time_Nome"]?></a></td>
		<td align="center" <?php if ($colocacao  <=4) { ?><?=$cor_copa_fc?><?php } else if ($colocacao > 4 and $colocacao <= 11) { ?><?=$cor_copa_brasil?><?php } else if ($colocacao > 11 and $colocacao <= 16) { ?><?=$cor_normal?><?php } else { ?><?=$cor_rebaixado?><?php } ?> style="padding: 3px 0 3px 0"><?=$rs["Time_Pontos"]?></td>
		<td align="center" <?php if ($colocacao  <=4) { ?><?=$cor_copa_fc?><?php } else if ($colocacao > 4 and $colocacao <= 11) { ?><?=$cor_copa_brasil?><?php } else if ($colocacao > 11 and $colocacao <= 16) { ?><?=$cor_normal?><?php } else { ?><?=$cor_rebaixado?><?php } ?> style="padding: 3px 0 3px 0"><?=$rs["Time_Jogos"]?></td>
		<td align="center" <?php if ($colocacao  <=4) { ?><?=$cor_copa_fc?><?php } else if ($colocacao > 4 and $colocacao <= 11) { ?><?=$cor_copa_brasil?><?php } else if ($colocacao > 11 and $colocacao <= 16) { ?><?=$cor_normal?><?php } else { ?><?=$cor_rebaixado?><?php } ?> style="padding: 3px 0 3px 0"><?=$rs["Time_Vitorias"]?></td>
		<td align="center" <?php if ($colocacao  <=4) { ?><?=$cor_copa_fc?><?php } else if ($colocacao > 4 and $colocacao <= 11) { ?><?=$cor_copa_brasil?><?php } else if ($colocacao > 11 and $colocacao <= 16) { ?><?=$cor_normal?><?php } else { ?><?=$cor_rebaixado?><?php } ?> style="padding: 3px 0 3px 0"><?=$rs["Time_Empates"]?></td>
		<td align="center" <?php if ($colocacao  <=4) { ?><?=$cor_copa_fc?><?php } else if ($colocacao > 4 and $colocacao <= 11) { ?><?=$cor_copa_brasil?><?php } else if ($colocacao > 11 and $colocacao <= 16) { ?><?=$cor_normal?><?php } else { ?><?=$cor_rebaixado?><?php } ?> style="padding: 3px 0 3px 0"><?=$rs["Time_Derrotas"]?></td>
		<td align="center" <?php if ($colocacao  <=4) { ?><?=$cor_copa_fc?><?php } else if ($colocacao > 4 and $colocacao <= 11) { ?><?=$cor_copa_brasil?><?php } else if ($colocacao > 11 and $colocacao <= 16) { ?><?=$cor_normal?><?php } else { ?><?=$cor_rebaixado?><?php } ?> style="padding: 3px 0 3px 0"><?=number_format($rs["Time_SG"],0,',','.')?></td>
	</tr>

<?php } ?>

</table>

</div>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<div id="divide"></div>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Importante</h1></div></div></div>
	<div class="conteudo">

<div id="linha10"><strong>A premiação é igual para todos os Grupos.</strong></div>
<div id="linha10"><strong>S&eacute;rie A e B os 11 Primeiros se classifica para a Copa do Brasil</strong></div>
<div id="linha10"><strong>S&eacute;rie C apenas os 10 Primeiros se classifica para a Copa do Brasil</strong></div>
<div id="linha10"><strong>Apenas os 4 Primeiros a S&eacute;rie A e B se classifica para a Copa LC</strong></div>
<div id="linha10"><strong>S&eacute;rie C est&aacute; fora Copa LC</strong></div>
<div id="linha10"><strong>A tabela só é zerada no fim da temporada, depois da Copa LC.</strong></div>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>
<div id="divide"></div>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Legenda</h1></div></div></div>
	<div class="conteudo">

<div id="linha10"><span class="img20"><img width="50" height="20" src="figuras/principal/classificacao_verde.jpg"></span> Classificado Copa LC</div>
<div id="linha10"><span class="img20"><img width="50" height="20" src="figuras/principal/classificacao_azul.jpg"></span> Classificado Copa Brasil</div>
<div id="linha10"><span class="img20"><img width="50" height="20" src="figuras/principal/classificacao_cinza.jpg"></span> Nada</div>
<div id="linha10"><span class="img20"><img width="50" height="20" src="figuras/principal/classificacao_vermelha.jpg"></span> Rebaixado</div>


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