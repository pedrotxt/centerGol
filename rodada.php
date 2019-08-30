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

if (ereg('[^0-9]',$id)) {
	header("Location: index.php"); break;
}

if ($id < 1 or $id > 60) {
	header("Location: index.php"); break;
}

$query = mysql_query("SELECT Rodada FROM Configuracoes");
$rs = mysql_fetch_array($query);

$rodada = $rs["Rodada"];

$query = mysql_query("SELECT ID2 FROM Times WHERE ID = '". $id ."'");
$rs = mysql_fetch_array($query);

$id2 = $rs["ID2"];

$query = mysql_query("SELECT Time_1, Time_2, Placar_1, Placar_2, Publico, Renda, Campeonato FROM Jogos WHERE Rodada = '". $rodada ."' AND Time_1 = '". $id2 ."' OR Rodada = '". $rodada ."' AND Time_2 = '". $id2 ."'");
$rs = mysql_fetch_array($query);

$rodada_time_1 = $rs["Time_1"];
$rodada_time_2 = $rs["Time_2"];
$rodada_time_1_placar = $rs["Placar_1"];
$rodada_time_2_placar = $rs["Placar_2"];
$rodada_campeonato = $rs["Campeonato"];
$rodada_publico = $rs["Publico"];
$rodada_renda = $rs["Renda"];

if ($rodada_time_1_placar > $rodada_time_2_placar) {
	$rodada_placar_diferenca = $rodada_time_1_placar - $rodada_time_2_placar;
} else if ($rodada_time_1_placar < $rodada_time_2_placar) {
	$rodada_placar_diferenca = $rodada_time_2_placar - $rodada_time_1_placar;
} else {
	$rodada_placar_diferenca = 0;
}

$query = mysql_query("SELECT ID, Time, Estadio FROM Times WHERE ID2 = '". $rodada_time_1 ."'");
$rs = mysql_fetch_array($query);

$rodada_time_1 = $rs["ID"];
$rodada_time_1_nome = $rs["Time"];
$rodada_time_1_estadio = $rs["Estadio"];

$query = mysql_query("SELECT ID, Time FROM Times WHERE ID2 = '". $rodada_time_2 ."'");
$rs = mysql_fetch_array($query);

$rodada_time_2 = $rs["ID"];
$rodada_time_2_nome = $rs["Time"];

$placar_total = $rodada_time_1_placar + $rodada_time_2_placar;

if ($placar_total > 0) {

if ($rodada_time_1_placar > $rodada_time_2_placar) {

$p_placar = ($rodada_time_1_placar / $placar_total) * 100;
$p_exp = explode(".", $p_placar);
$p_placar = $p_exp[0];

} else if ($rodada_time_1_placar < $rodada_time_2_placar) {

$p_placar = ($rodada_time_2_placar / $placar_total) * 100;
$p_exp = explode(".", $p_placar);
$p_placar = $p_exp[0];

} else {

$p_placar = "50";

}

} else {

$p_placar = "50";

}

$medalha = 0;
$query = mysql_query("SELECT ID FROM Usuarios WHERE Gols_Hora > 0 ORDER BY Gols_Hora DESC LIMIT 3");

while ($rs = mysql_fetch_array($query)) {

$medalha = $medalha + 1;

if ($medalha == 1) {
	$medalha_1 = $rs["ID"];
} else if ($medalha == 2) {
	$medalha_2 = $rs["ID"];
} else if ($medalha == 3) {
	$medalha_3 = $rs["ID"];
}

}

ob_end_flush();
?>
<div id="placar" style="text-align: center">

<a href="http://www.adobe.com/go/EN_US-H-GET-FLASH" target="_blank"><img src="http://www.adobe.com/images/shared/download_buttons/get_adobe_flash_player.png" border="0"></a>

<script type="text/javascript">
	var fo = new FlashObject("swf/placar.swf?time1=<?=$rodada_time_1?>&time2=<?=$rodada_time_2?>&placar1=<?=$rodada_time_1_placar?>&placar2=<?=$rodada_time_2_placar?>&porcentagem=<?=$p_placar?>&campeonato=<?=$rodada_campeonato?>", "resultado", "570", "150", "7", "#fff");
	fo.addParam("quality", "high");
	fo.addParam("menu", "false");
	fo.addParam("wmode", "transparent");
	fo.addParam("scale", "noscale");
	fo.write("placar");
</script>

</div>

<div id="divide"></div>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Rodada Atual</h1></div></div></div>
	<div class="conteudo">

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/estadio.png" title="Estádio" alt="Estádio"></span> <b>Estádio:</b> <?=$rodada_time_1_estadio?></div>
<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/publico.png" title="Público" alt="Público"></span> <b>Público:</b> <?=number_format($rodada_publico,0,',','.')?> (gerado com o número de online nos dois times na troca da rodada)</div>
<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/renda.png" title="Renda" alt="Renda"></span> <b>Renda:</b> <?=number_format($rodada_renda,0,',','.')?> (somente para o time mandante)</div>
<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/diferenca.png" title="Diferença" alt="Diferença"></span> <b>Diferença:</b> <?=number_format($rodada_placar_diferenca,0,',','.')?> (para vencer o jogo a diferença tem que ser no mínimo 60%)</div>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<div id="divide"></div>

<div id="principal_metade">

<div id="principal_metade_esquerda">

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1><?=$rodada_time_1_nome?></h1></div></div></div>
	<div class="conteudo" style="padding-top: 4px">

<?php

$query = mysql_query("SELECT ID, Usuario, Nivel, Gols_Rodada, VIP, VIP_Cor FROM Usuarios WHERE Time = '". $rodada_time_1 ."' AND Gols_Rodada > 0 ORDER BY Gols_Rodada DESC LIMIT 10");
$resultado = 0;

?>

<?php while ($rs = mysql_fetch_array($query)) { ?>
<?php $resultado = $resultado + 1 ?>

<div id="linha6"><span class="img25"><img width="25" height="25" src="figuras/niveis/<?=$rs["Nivel"]?>.png" title="<?=$rs["Nivel"]?>" alt="<?=$rs["Nivel"]?>"></span> <a href="usuario.php?id=<?=$rs["ID"]?>"><?php if ($rs["VIP"] > 0) { ?><span id="usuario_vip<?=$rs["VIP_Cor"]?>"><?=$rs["Usuario"]?></span><?php } else { ?><span id="usuario_normal"><?=$rs["Usuario"]?></span><?php } ?></a> <?php if ($rs["ID"] == $medalha_1) { ?><span class="medalha"><img width="16" height="16" src="figuras/principal/medalha1.png" title="Top 1 da Hora" alt="Top 1 da Hora"></span><?php } else if ($rs["ID"] == $medalha_2) { ?><span class="medalha"><img width="16" height="16" src="figuras/principal/medalha2.png" title="Top 2 da Hora" alt="Top 2 da Hora"></span><?php } else if ($rs["ID"] == $medalha_3) { ?><span class="medalha"><img width="16" height="16" src="figuras/principal/medalha3.png" title="Top 3 da Hora" alt="Top 3 da Hora"></span><?php } ?> <span class="gols_rodada"><?=number_format($rs["Gols_Rodada"],0,',','.')?></span></div>

<?php } ?>

<?php if ($resultado == 0) { ?>

<div id="linha6"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Nenhum marcador encontrado.</div>

<?php } ?>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>


</div>
<div id="principal_metade_direita">

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1><?=$rodada_time_2_nome?></h1></div></div></div>
	<div class="conteudo" style="padding-top: 4px">

<?php

$query = mysql_query("SELECT ID, Usuario, Nivel, Gols_Rodada, VIP, VIP_Cor FROM Usuarios WHERE Time = '". $rodada_time_2 ."' AND Gols_Rodada > 0 ORDER BY Gols_Rodada DESC LIMIT 10");
$resultado = 0;

?>

<?php while ($rs = mysql_fetch_array($query)) { ?>
<?php $resultado = $resultado + 1 ?>

<div id="linha6"><span class="img25"><img width="25" height="25" src="figuras/niveis/<?=$rs["Nivel"]?>.png" title="<?=$rs["Nivel"]?>" alt="<?=$rs["Nivel"]?>"></span> <a href="usuario.php?id=<?=$rs["ID"]?>"><?php if ($rs["VIP"] > 0) { ?><span id="usuario_vip<?=$rs["VIP_Cor"]?>"><?=$rs["Usuario"]?></span><?php } else { ?><span id="usuario_normal"><?=$rs["Usuario"]?></span><?php } ?></a> <?php if ($rs["ID"] == $medalha_1) { ?><span class="medalha"><img width="16" height="16" src="figuras/principal/medalha1.png" title="Top 1 da Hora" alt="Top 1 da Hora"></span><?php } else if ($rs["ID"] == $medalha_2) { ?><span class="medalha"><img width="16" height="16" src="figuras/principal/medalha2.png" title="Top 2 da Hora" alt="Top 2 da Hora"></span><?php } else if ($rs["ID"] == $medalha_3) { ?><span class="medalha"><img width="16" height="16" src="figuras/principal/medalha3.png" title="Top 3 da Hora" alt="Top 3 da Hora"></span><?php } ?> <span class="gols_rodada"><?=number_format($rs["Gols_Rodada"],0,',','.')?></span></div>

<?php } ?>

<?php if ($resultado == 0) { ?>

<div id="linha6"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Nenhum marcador encontrado.</div>

<?php } ?>



	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

</div>

</div>
<!-- FIM DA PÁGINA -->
</div>
<div class="clear"></div>

</div>
<div id="baixo"><?php include("baixo.php") ?></div>
</div>
</body>
</html>