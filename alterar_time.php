<?php include_once("fun_anti_inj.php") ?>
<?php include("verificar_cookie.php") ?>
<?php include("conexao.php") ?>
<?php include("verificar_conexao.php") ?>
<?php include("verificar_cargo.php") ?>
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


<script language="javascript">
function valida_alterar_time() {

if (document.alterar_time.time.value==0) {
	alert("É necessário selecionar o time.");
	document.alterar_time.time.focus();
	return false;
}

}
</script>

<?php
$query = mysql_query("SELECT Trocas FROM Configuracoes");
$rs = mysql_fetch_array($query);

$trocas_total = $rs["Trocas"];

$query = mysql_query("SELECT Trocas, Gols_Time, Rescisao, Rescisao_Dias, Rescisao_Dias_VIP FROM Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$rs = mysql_fetch_array($query);

$mc_trocas = $rs["Trocas"];
$mc_gols_time = $rs["Gols_Time"];
$mc_rescisao = $rs["Rescisao"];
$mc_rescisao_dias = $rs["Rescisao_Dias"];
$mc_rescisao_dias_vip = $rs["Rescisao_Dias_VIP"];

$custo = 10000;
$custo_total = $custo + $mc_rescisao;
?>

<?php if ($eu_presidente == 1 or $eu_diretor == 1 or $eu_olheiro == 1) { ?>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Alterar Time</h1></div></div></div>
	<div class="conteudo">

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Você tem cargo no time e não pode sair.</div>
<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/seta1.png"></span> <a href="time_deixar.php"><b>Sair do Cargo</b></a></div>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<?php } else if ($mc_trocas >= $trocas_total) { ?>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Alterar Time</h1></div></div></div>
	<div class="conteudo">

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Você atingiu o número máximo de <?=$trocas_total?> trocas nessa temporada.</div>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<?php } else if ($mc_rescisao_dias_vip > 0) { ?>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Alterar Time</h1></div></div></div>
	<div class="conteudo">

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Você tem <?=$mc_rescisao_dias_vip?> <?php if ($mc_rescisao_dias_vip == 1) { ?> dia<?php } else { ?> dias<?php } ?> de VIP do time, espere acabar para alterar.</div>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<?php } else if ($mc_gols_time < 100) { ?>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Alterar Time</h1></div></div></div>
	<div class="conteudo">

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Você prerecisa marcar pelo menos 100 gols no time atual para poder alterar.</div>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<?php } else { ?>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Alterar Time</h1></div></div></div>
	<div class="conteudo">

<?php if (anti_inj($_GET["msg_time"]) == 1) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Você não tem dinheiro suficiente!</div>

<?php } else if (anti_inj($_GET["msg_time"]) == 2) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Você já está jogando nesse time!</div>

<?php } ?>

<div id="linha10"><b>Custo:</b> <?=number_format($custo,0,',','.')?></div>
<div id="linha10"><b>Trocas na Temporada:</b> <?=$mc_trocas?> / <?=$trocas_total?></div>

<?php if ($mc_rescisao != 0) { ?>
<?php
$mc_vip_tempo = $mc_rescisao_dias;
$data_inicial = time()-86400 ;
$data_final = $mc_vip_tempo;
$diferenca = $data_final - $data_inicial;
$dias = (int)floor( $diferenca / (60 * 60 * 24));
?>

<div id="linha10"><b>Rescisão:</b> <?=number_format($mc_rescisao,0,',','.')?> (<?=$dias?> <?php if ($dias == 1) { ?> dia<?php } else { ?> dias<?php } ?>)</div>
<div id="linha10"><b>Custo Total:</b> <?=number_format($custo_total,0,',','.')?></div>

<?php } ?>

<form name="alterar_time" method="post" action="alterar_time_salvar.php" onSubmit="return valida_alterar_time()">

<div id="linha10"><span class="fonte_form">Para qual time você quer mudar?</span> <span class="align_form"><?php include("times_lista.php") ?></span></div>
<div id="linha12"><input name="submit" type="image" src="figuras/principal/botao_confirmar.png" onClick="return valida_alterar_time()"><?php if ($mc_rescisao != 0) { ?> <a href="alterar_time_rescisao.php"><img src="figuras/principal/botao_pagar_rescisao.png" border="0"></a><?php } ?></div>

</form>

<script language="javascript">
document.forms.alterar_time.time.value = "<?=$mc_time?>";
</script>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<div id="divide"></div>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Importante</h1></div></div></div>
	<div class="conteudo">

<div id="linha10">Pense bem antes de alterar seu time.</div>
<div id="linha10">Caso você tenha rescisão, terá que pagar ela e mais o custo de troca.</div>
<div id="linha10">Pode também pagar somente a rescisão para depois negociar contrato com outro time.</div>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
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