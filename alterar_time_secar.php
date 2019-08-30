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


<script language="javascript">
function valida_alterar_time_secar() {

if (document.alterar_time_secar.time_secar.value==0) {
	alert("É necessário selecionar o time.");
	document.alterar_time_secar.time_secar.focus();
	return false;
}

}
</script>
<?php
$query = mysql_query("SELECT ID, VIP_Tempo FROM Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$rs = mysql_fetch_array($query);
$mc_vip_tempo = $rs["VIP_Tempo"];
?>
<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Alterar Time Secar</h1></div></div></div>
	<div class="conteudo">

<?php if ($mc_vip_tempo < time()) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Somente usuários VIP podem Secar.</div>
<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/seta1.png"></span> <a href="loja.php"><b>Ver Planos</b></a></div>

<?php } else { ?>

<?php if (anti_inj($_GET["msg_secar"]) == 1) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Você não tem dinheiro suficiente!</div>

<?php } else if (anti_inj($_GET["msg_secar"]) == 2) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Você já está secando esse time!</div>

<?php } else if (anti_inj($_GET["msg_secar"]) == 3) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Você não pode secar o seu time!</div>

<?php } ?>

<div id="linha10"><b>Custo:</b> 500</div>

<form name="alterar_time_secar" method="post" action="alterar_time_secar_salvar.php" onSubmit="return valida_alterar_time_secar()">

<div id="linha10"><span class="fonte_form">Qual time você quer secar?</span> <span class="align_form"><?php include("times_secar_lista.php") ?></span></div>
<div id="linha12"><input name="submit" type="image" src="figuras/principal/botao_confirmar.png" onClick="return valida_alterar_time_secar()"><?php if ($mc_secar != 0) { ?> <a href="alterar_time_secar_excluir.php"><img src="figuras/principal/botao_deixar_de_secar.png" border="0"></a><?php } ?></div>

</form>

<script language="javascript">
document.forms.alterar_time_secar.time_secar.value = "<?=$mc_secar?>";
</script>

<?php } ?>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<div id="divide"></div>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Importante</h1></div></div></div>
	<div class="conteudo">

<div id="linha10">Secar serve para marcar gols automaticamente para o adversário do time escolhido.</div>
<div id="linha10">Para deixar de Secar você não paga o custo.</div>
<div id="linha10">Sistema válido por 1 rodada.</div>

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