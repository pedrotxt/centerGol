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
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Clones</h1></div></div></div>
	<div class="conteudo">

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Detectamos outra conta online no seu IP!</div>

<div id="linha10">Sistema liberando apenas 1 conta por IP.</div>

<div id="linha15"><b>Não está logado em nenhuma conta e mesmo assim continua dando o erro?</b></div>

<div id="linha10" style="text-align: justify">Aguarde 10 minutos para sua conta deslogar automaticamente do sistema e tente novamente, seu login ainda deve estar online do seu último acesso, impossibilitando o seu acesso.</div>

<div id="linha15"><b>Precisa logar mais de 1 conta por causa de parentes dividindo a mesma internet?</b></div>

<div id="linha10" style="text-align: justify">Fale com um administrador do jogo.</div>

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