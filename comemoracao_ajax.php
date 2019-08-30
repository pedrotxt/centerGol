<?php include_once("fun_anti_inj.php") ?>
<?php include("verificar_cookie.php") ?>
<?php include("conexao.php") ?>
<?php include("verificar_conexao.php") ?>
<?php
header("Content-Type: text/html; charset=ISO-8859-1",true);

$query = mysql_query("SELECT Time, Comemoracao_Frase, Som, Usuario, Gols_Total FROM Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$rs = mysql_fetch_array($query);

$mc_time = $rs["Time"];
$mc_comemoracao_frase = $rs["Comemoracao_Frase"];
$mc_som = $rs["Som"];
$mc_usuario = $rs["Usuario"];
$mc_gols_total = $rs["Gols_Total"];
?>

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