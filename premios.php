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


<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Prêmios da Hora</h1></div></div></div>
	<div class="conteudo">

<div id="linha10"><span class="img20"><img width="20" height="20" src="figuras/principal/medalha1.png"></span> 2.000</div>
<div id="linha10"><span class="img20"><img width="20" height="20" src="figuras/principal/medalha2.png"></span> 1.800</div>
<div id="linha10"><span class="img20"><img width="20" height="20" src="figuras/principal/medalha3.png"></span> 1.600</div>
<div id="linha10"><span class="img20"><img width="20" height="20" src="figuras/principal/colocacao4.png"></span> 1.000</div>
<div id="linha10"><span class="img20"><img width="20" height="20" src="figuras/principal/colocacao5.png"></span> 900</div>
<div id="linha10"><span class="img20"><img width="20" height="20" src="figuras/principal/colocacao6.png"></span> 800</div>
<div id="linha10"><span class="img20"><img width="20" height="20" src="figuras/principal/colocacao7.png"></span> 700</div>
<div id="linha10"><span class="img20"><img width="20" height="20" src="figuras/principal/colocacao8.png"></span> 600</div>
<div id="linha10"><span class="img20"><img width="20" height="20" src="figuras/principal/colocacao9.png"></span> 500</div>
<div id="linha10"><span class="img20"><img width="20" height="20" src="figuras/principal/colocacao10.png"></span> 400</div>
<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/seta1.png"></span> <a href="ranking_hora.php"><b>Ver Ranking</b></a></div>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<div id="divide"></div>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Prêmios da Rodada</h1></div></div></div>
	<div class="conteudo">

<div id="linha10"><span class="img20"><img width="20" height="20" src="figuras/principal/bola1.png"></span> 15.000</div>
<div id="linha10"><span class="img20"><img width="20" height="20" src="figuras/principal/bola2.png"></span> 14.000</div>
<div id="linha10"><span class="img20"><img width="20" height="20" src="figuras/principal/bola3.png"></span> 13.000</div>
<div id="linha10"><span class="img20"><img width="20" height="20" src="figuras/principal/colocacao4.png"></span> 10.000</div>
<div id="linha10"><span class="img20"><img width="20" height="20" src="figuras/principal/colocacao5.png"></span> 9.000</div>
<div id="linha10"><span class="img20"><img width="20" height="20" src="figuras/principal/colocacao6.png"></span> 8.000</div>
<div id="linha10"><span class="img20"><img width="20" height="20" src="figuras/principal/colocacao7.png"></span> 7.000</div>
<div id="linha10"><span class="img20"><img width="20" height="20" src="figuras/principal/colocacao8.png"></span> 6.000</div>
<div id="linha10"><span class="img20"><img width="20" height="20" src="figuras/principal/colocacao9.png"></span> 5.000</div>
<div id="linha10"><span class="img20"><img width="20" height="20" src="figuras/principal/colocacao10.png"></span> 4.000</div>
<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/seta1.png"></span> <a href="ranking_rodada.php"><b>Ver Ranking</b></a></div>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<div id="divide"></div>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Prêmios da Temporada</h1></div></div></div>
	<div class="conteudo">

<div id="linha10"><span class="img20"><img width="20" height="20" src="figuras/principal/trofeu1.png"></span> 60.000 + 70 dias de VIP</div>
<div id="linha10"><span class="img20"><img width="20" height="20" src="figuras/principal/trofeu2.png"></span> 55.000 + 50 dias de VIP</div>
<div id="linha10"><span class="img20"><img width="20" height="20" src="figuras/principal/trofeu3.png"></span> 50.000 + 30 dias de VIP</div>
<div id="linha10"><span class="img20"><img width="20" height="20" src="figuras/principal/colocacao4.png"></span> 40.000</div>
<div id="linha10"><span class="img20"><img width="20" height="20" src="figuras/principal/colocacao5.png"></span> 35.000</div>
<div id="linha10"><span class="img20"><img width="20" height="20" src="figuras/principal/colocacao6.png"></span> 30.000</div>
<div id="linha10"><span class="img20"><img width="20" height="20" src="figuras/principal/colocacao7.png"></span> 25.000</div>
<div id="linha10"><span class="img20"><img width="20" height="20" src="figuras/principal/colocacao8.png"></span> 20.000</div>
<div id="linha10"><span class="img20"><img width="20" height="20" src="figuras/principal/colocacao9.png"></span> 18.000</div>
<div id="linha10"><span class="img20"><img width="20" height="20" src="figuras/principal/colocacao10.png"></span> 16.000</div>
<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/seta1.png"></span> <a href="ranking_temporada.php"><b>Ver Ranking</b></a></div>

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