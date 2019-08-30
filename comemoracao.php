<?php include_once("fun_anti_inj.php") ?>
<?php include("verificar_cookie.php") ?>
<?php include("conexao.php") ?>
<?php include("verificar_conexao.php") ?>
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
$mc_comemoracao_frase = str_replace("[eu]",$mc_usuario,$mc_comemoracao_frase);
$mc_comemoracao_frase = str_replace("[Eu]",$mc_usuario ,$mc_comemoracao_frase);
$mc_comemoracao_frase = str_replace("[eU]",$mc_usuario ,$mc_comemoracao_frase);
$mc_comemoracao_frase = str_replace("[EU]",$mc_usuario ,$mc_comemoracao_frase);
$mc_comemoracao_frase = str_replace("[gol]",number_format($mc_gols_total,0,',','.'),$mc_comemoracao_frase);
$mc_comemoracao_frase = str_replace("[Gol]",number_format($mc_gols_total,0,',','.'),$mc_comemoracao_frase);
$mc_comemoracao_frase = str_replace("[GOl]",number_format($mc_gols_total,0,',','.'),$mc_comemoracao_frase);
$mc_comemoracao_frase = str_replace("[GoL]",number_format($mc_gols_total,0,',','.'),$mc_comemoracao_frase);
$mc_comemoracao_frase = str_replace("[gOl]",number_format($mc_gols_total,0,',','.'),$mc_comemoracao_frase);
$mc_comemoracao_frase = str_replace("[goL]",number_format($mc_gols_total,0,',','.'),$mc_comemoracao_frase);
$mc_comemoracao_frase = str_replace("[gOL]",number_format($mc_gols_total,0,',','.'),$mc_comemoracao_frase);
$mc_comemoracao_frase = str_replace("[GOL]",number_format($mc_gols_total,0,',','.'),$mc_comemoracao_frase);
?>
<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Comemoração</h1></div></div></div>
	<div class="conteudo">

<div id="linha10" style="text-align: center"><a href="time.php?id=<?=$mc_time?>"><img src="figuras/times_grandes/<?=$mc_time?>.png" border="0"></a></div>

<?php if ($mc_comemoracao_frase) { ?>
<div id="linha10" style="text-align: center"><?=$mc_comemoracao_frase?></div>
<?php } ?>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<?php if ($mc_som == 1) { ?>

<div id="som_gol">
<script type="text/javascript">
	var fo = new FlashObject("swf/som_gol.swf", "sgol", "1", "1", "7", "#fff");
	fo.addParam("quality", "high");
	fo.addParam("menu", "false");
	fo.addParam("wmode", "transparent");
	fo.addParam("scale", "noscale");
	fo.write("som_gol");
</script>
</div>

<?php } ?>


<!-- FIM DA PÁGINA -->
</div>
<div class="clear"></div>

</div>
<div id="baixo"><?php include("baixo.php") ?></div>
</div>
</body>
</html>