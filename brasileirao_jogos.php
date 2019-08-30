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
$rodada = anti_inj($_GET['r']);

if (!$rodada) {
	$rodada = anti_inj($_POST['r']);
}

if (!$id) {
	header("Location: index.php"); break;
}

if ($id != 1 and $id != 2 and $id != 3) {
	header("Location: index.php"); break;
}

$query = mysql_query("SELECT Temporada, Rodada FROM Configuracoes");
$rs = mysql_fetch_array($query);

$temporada = $rs["Temporada"];
$rodada_atual = $rs["Rodada"];

if (!$rodada) {
	$rodada = $rodada_atual;
}

if ($rodada > 19) {
	$rodada = 19;
}

ob_end_flush();
?>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio">
	  <h1>Brasileir&atilde;o</h1></div></div></div>
	<div class="conteudo">

<div id="linha10" style="text-align: center"><a href="brasileirao_jogos.php?id=1"><img src="figuras/principal/botao_serie_a.png" border="0"></a> <a href="brasileirao_jogos.php?id=2"><img src="figuras/principal/botao_serie_b.png" border="0"></a> <a href="brasileirao_jogos.php?id=3"><img src="figuras/principal/botao_serie_c.png" border="0"></a></div>

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
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Grupo <?=$serie?> - Rodada <?=$rodada?> - Temporada <?=$temporada?></h1></div></div></div>
	<div class="conteudo">

<div id="linha10">

<table width="550" cellpadding="0" cellspacing="0">

<?php

$jogo = 0;

$query = mysql_query("SELECT Jogos.Time_2 as Time_2_ID2, Jogos.Placar_1 as Placar_1, Jogos.Placar_2 as Placar_2, Times.ID as Time_1_ID, Times.Time as Time_1_Nome FROM Jogos INNER JOIN Times ON Times.ID2 = Jogos.Time_1 WHERE Rodada = '". $rodada ."' AND Campeonato = '". $id ."' ORDER BY Jogos.ID LIMIT 10");

?>

<?php while ($rs = mysql_fetch_array($query)) { ?>

<?php $jogo = $jogo + 1; ?>

<?php

$query2 = mysql_query("SELECT ID, Time FROM Times WHERE ID2 = '". $rs["Time_2_ID2"] ."'");
$rs2 = mysql_fetch_array($query2);

$time_2_id = $rs2["ID"];
$time_2_nome = $rs2["Time"];

?>

	<tr height="32" <?php if ($jogo == 1 or $jogo == 3 or $jogo == 5 or $jogo == 7 or $jogo == 9) { ?>bgcolor="#CCC"<?php } ?>>
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

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<div id="divide"></div>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Outras Rodadas</h1></div></div></div>
	<div class="conteudo">

<div id="linha10">

<form name="rodada" method="post" action="brasileirao_jogos.php?id=<?=$id?>">
<table width="550" cellpadding="0" cellspacing="0">
	<tr>
		<td width="220" style="padding-right: 3px" align="right"><?php if ($rodada > 1) { ?><a href="brasileirao_jogos.php?id=<?=$id?>&r=<?=$rodada-1?>"><img src="figuras/principal/botao_anterior.png" border="0"></a><?php } else { ?>&nbsp;<?php } ?></td>
		<td width="110" align="center">

<select name="r" style="width: 60px; height: 26px;" onChange="this.form.submit()">
<option value="1" <?php if ($rodada == 1) { ?>selected<?php } ?>>1</option>
<option value="2" <?php if ($rodada == 2) { ?>selected<?php } ?>>2</option>
<option value="3" <?php if ($rodada == 3) { ?>selected<?php } ?>>3</option>
<option value="4" <?php if ($rodada == 4) { ?>selected<?php } ?>>4</option>
<option value="5" <?php if ($rodada == 5) { ?>selected<?php } ?>>5</option>
<option value="6" <?php if ($rodada == 6) { ?>selected<?php } ?>>6</option>
<option value="7" <?php if ($rodada == 7) { ?>selected<?php } ?>>7</option>
<option value="8" <?php if ($rodada == 8) { ?>selected<?php } ?>>8</option>
<option value="9" <?php if ($rodada == 9) { ?>selected<?php } ?>>9</option>
<option value="10" <?php if ($rodada == 10) { ?>selected<?php } ?>>10</option>
<option value="11" <?php if ($rodada == 11) { ?>selected<?php } ?>>11</option>
<option value="12" <?php if ($rodada == 12) { ?>selected<?php } ?>>12</option>
<option value="13" <?php if ($rodada == 13) { ?>selected<?php } ?>>13</option>
<option value="14" <?php if ($rodada == 14) { ?>selected<?php } ?>>14</option>
<option value="15" <?php if ($rodada == 15) { ?>selected<?php } ?>>15</option>
<option value="16" <?php if ($rodada == 16) { ?>selected<?php } ?>>16</option>
<option value="17" <?php if ($rodada == 17) { ?>selected<?php } ?>>17</option>
<option value="18" <?php if ($rodada == 18) { ?>selected<?php } ?>>18</option>
<option value="19" <?php if ($rodada == 19) { ?>selected<?php } ?>>19</option>

</select>

		</td>
		<td width="220" style="padding-left: 3px"><?php if ($rodada < 19) { ?><a href="brasileirao_jogos.php?id=<?=$id?>&r=<?=$rodada+1?>"><img src="figuras/principal/botao_proxima.png" border="0"></a><?php } else { ?>&nbsp;<?php } ?></td>
	</tr>
</table>
</form>

</div>

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