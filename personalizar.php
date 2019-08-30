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


<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Personalizar</h1></div></div></div>
	<div class="conteudo">

<?php if (anti_inj($_GET["msg_personalizar"]) == 1) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_sim.png"></span> Personalizado com sucesso!</div>

<?php } ?>

<form name="personalizar" method="post" action="personalizar_salvar.php">
<div id="linha10">
<span class="fonte_form">Qual a cor do seu VIP?</span>
<span class="align_form">
<select name="vip_cor" style="width: 160px; height: 26px">
<option value="1" <? if ($mc_vip_cor == 1) { ?>selected<?php } ?> id="usuario_vip1">Verde</option>
<option value="2" <? if ($mc_vip_cor == 2) { ?>selected<?php } ?> id="usuario_vip2">Azul</option>
<option value="3" <? if ($mc_vip_cor == 3) { ?>selected<?php } ?> id="usuario_vip3">Vermelho</option>
<option value="4" <? if ($mc_vip_cor == 4) { ?>selected<?php } ?> id="usuario_vip4">Rosa</option>
<option value="5" <? if ($mc_vip_cor == 5) { ?>selected<?php } ?> id="usuario_vip5">Roxo</option>
<option value="6" <? if ($mc_vip_cor == 6) { ?>selected<?php } ?> id="usuario_vip6">Laranja</option>
<option value="7" <? if ($mc_vip_cor == 7) { ?>selected<?php } ?> id="usuario_vip7">Marrom</option>
<option value="8" <? if ($mc_vip_cor == 8) { ?>selected<?php } ?> id="usuario_vip8">Cinza</option>
</select>
</span>
</div>
<div id="linha15">
<span class="fonte_form">Qual o fundo do site?</span>
<span class="align_form">
<select name="fundo" style="width: 160px; height: 26px">
<option value="1" <?php if ($mc_fundo == 1) { ?>selected<?php } ?>>Principal</option>
<option value="2" <?php if ($mc_fundo == 2) { ?>selected<?php } ?>>Grama Escura</option>
<option value="3" <?php if ($mc_fundo == 3) { ?>selected<?php } ?>>Grama Clara</option>
<option value="4" <?php if ($mc_fundo == 4) { ?>selected<?php } ?>>Tapete</option>
<option value="5" <?php if ($mc_fundo == 5) { ?>selected<?php } ?>>Madeira Preta</option>
<option value="6" <?php if ($mc_fundo == 6) { ?>selected<?php } ?>>Pontilhado Laranja</option>
<option value="7" <?php if ($mc_fundo == 7) { ?>selected<?php } ?>>Mundo</option>
<option value="8" <?php if ($mc_fundo == 8) { ?>selected<?php } ?>>Vermelho</option>
<option value="9" <?php if ($mc_fundo == 9) { ?>selected<?php } ?>>Preto</option>
</select>
</span>
</div>

<div id="linha12"><input name="submit" type="image" src="figuras/principal/botao_confirmar.png"></div>
</form>

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