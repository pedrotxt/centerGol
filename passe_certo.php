<?php session_start(); ?>
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
function verificar_entretenimento() {

if (document.passe_certo.palavra.value=="") {
	alert("É necessário preencher o código.");
	document.passe_certo.palavra.focus();
	return false;
}

}
</script>

<?php
$query = mysql_query("SELECT Sorte, Passe_Certo_Tent, Passe_Certo_Cod FROM Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$rs = mysql_fetch_array($query);

$mc_sorte = $rs["Sorte"];
$mc_tent = $rs["Passe_Certo_Tent"];
$mc_cod = $rs["Passe_Certo_Cod"];
?>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Passe Certo</h1></div></div></div>
	<div class="conteudo">

<?php if ($mc_tent > 0) { ?>

<div id="linha10">

<?php if ($mc_id != 100001232027146) { ?> <!-- para Leo -->



<?php if ($_POST["palavra"]) { ?>

<?php if (strtolower($_POST["palavra"]) == $_SESSION["palavra"]) { ?>

<div id="passe_certo_swf" style="text-align: center">
<a href="http://www.adobe.com/go/EN_US-H-GET-FLASH" target="_blank"><img src="http://www.adobe.com/images/shared/download_buttons/get_adobe_flash_player.png" border="0"></a>

<?php if ($mc_sorte == 1000) { ?>

<script type="text/javascript">
	var fo = new FlashObject("swf/passe_certo_sorte_v6.swf?cod=<?=$mc_cod?>", "pcerto", "351", "416", "7", "#fff");
	fo.addParam("quality", "high");
	fo.addParam("menu", "false");
	fo.addParam("wmode", "transparent");
	fo.addParam("scale", "noscale");
	fo.write("passe_certo_swf");
</script>

<?php } else { ?>

<script type="text/javascript">
	var fo = new FlashObject("swf/passe_certo_v6.swf?cod=<?=$mc_cod?>", "pcerto", "351", "416", "7", "#fff");
	fo.addParam("quality", "high");
	fo.addParam("menu", "false");
	fo.addParam("wmode", "transparent");
	fo.addParam("scale", "noscale");
	fo.write("passe_certo_swf");
</script>

<?php } ?>

</div>

<?php } else { ?>

<span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Código inválido, tente novamente!

<?php } ?>

<?php unset($_SESSION['palavra']); ?>

<?php } else { ?>

<div id="passe_certo">

<div style="text-align: center"><img src="captcha.php?l=150&a=50&tf=20&ql=5"></div>

<form name="passe_certo" action="passe_certo.php" onSubmit="return verificar_entretenimento()" method="post">
<div id="linha10" style="text-align: center"><input name="palavra" type="text" maxlength="5" style="width: 90px; height: 20px; text-align: center"></div>
<div id="linha10" style="text-align: center"><input name="submit" type="image" src="figuras/principal/botao_confirmar.png" onClick="return verificar_entretenimento()"></div>
</form>

<script language="javascript">
document.passe_certo.palavra.focus();
</script>

</div>

<?php } ?>



<?php } else { ?> <!-- para Leo -->

<div id="passe_certo_swf" style="text-align: center">
<a href="http://www.adobe.com/go/EN_US-H-GET-FLASH" target="_blank"><img src="http://www.adobe.com/images/shared/download_buttons/get_adobe_flash_player.png" border="0"></a>

<?php if ($mc_sorte == 1000) { ?>

<script type="text/javascript">
	var fo = new FlashObject("swf/passe_certo_sorte_v6.swf?cod=<?=$mc_cod?>", "pcerto", "351", "416", "7", "#fff");
	fo.addParam("quality", "high");
	fo.addParam("menu", "false");
	fo.addParam("wmode", "transparent");
	fo.addParam("scale", "noscale");
	fo.write("passe_certo_swf");
</script>

<?php } else { ?>

<script type="text/javascript">
	var fo = new FlashObject("swf/passe_certo_v6.swf?cod=<?=$mc_cod?>", "pcerto", "351", "416", "7", "#fff");
	fo.addParam("quality", "high");
	fo.addParam("menu", "false");
	fo.addParam("wmode", "transparent");
	fo.addParam("scale", "noscale");
	fo.write("passe_certo_swf");
</script>

<?php } ?>

</div>

<?php } ?> <!-- para Leo -->



</div>

<?php } else { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Você não tem tentativas no momento, aguarde.</div>

<?php } ?>

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