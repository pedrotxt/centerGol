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
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Pontos de Fidelidade</h1></div></div></div>
	<div class="conteudo">

<div id="linha10">Pense bem antes de confirmar a sua troca.</div>
<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/fidelidade.png" title="Fidelidade" alt="Fidelidade"></span> <b>Pontos:</b> <?=$mc_fidelidade?></div>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<div id="divide"></div>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Planos de Troca</h1></div></div></div>
	<div class="conteudo">

<?php if (anti_inj($_GET["msg_fidelidade"]) == 1) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_sim.png"></span> Pontos trocados com sucesso!</div>

<?php } else if (anti_inj($_GET["msg_fidelidade"]) == 2) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Você não tem esses pontos!</div>
 
<?php } ?>

<form name="fidelidade" method="post" action="fidelidade_salvar.php">
<div id="linha10"><span class="align_radio"><input name="pacote" type="radio" value="1" checked></span> <b>Pacote 1 (30 dias de VIP) - 12 Pontos</b></div>
<div id="linha10"><span class="align_radio"><input name="pacote" type="radio" value="2"></span> <b>Pacote 2 (60 dias de VIP) - 20 Pontos</b></div>
<div id="linha10"><span class="align_radio"><input name="pacote" type="radio" value="3"></span> <b>Pacote 3 (130 dias de VIP) - 28 Pontos</b></div>
<div id="linha10"><span class="align_radio"><input name="pacote" type="radio" value="4"></span> <b>Pacote 4 (260 dias de VIP) - 50 Pontos</b></div>
<div id="linha10"><span class="align_radio"><input name="pacote" type="radio" value="5"></span> <b>Pacote 5 (75.000 Fc) - 15 Pontos</b></div>
<div id="linha10"><span class="align_radio"><input name="pacote" type="radio" value="6"></span> <b>Pacote 6 (175.000 Fc) - 20 Pontos</b></div>
<div id="linha10"><span class="align_radio"><input name="pacote" type="radio" value="7"></span> <b>Pacote 7 (325.000 Fc) - 30 Pontos</b></div>
<div id="linha10"><span class="align_radio"><input name="pacote" type="radio" value="8"></span> <b>Pacote 8 (70 dias de VIP / 80.000 Fc) - 28 Pontos</b></div>
<div id="linha10"><span class="align_radio"><input name="pacote" type="radio" value="9"></span> <b>Pacote 9 (150 dias de VIP / 180.000 Fc) - 48 Pontos</b></div>
<div id="linha10"><span class="align_radio"><input name="pacote" type="radio" value="10"></span> <b>Pacote 10 (280 dias de VIP / 350.000 Fc) - 90 Pontos</b></div>
<div id="linha12"><input name="submit" type="image" src="figuras/principal/botao_trocar.png"> <a href="loja.php"><img src="figuras/principal/botao_voltar.png" border="0"></a></div>
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