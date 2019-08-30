<?php ob_start(); ?>
<?php include_once("fun_anti_inj.php") ?>
<?php include("verificar_cookie.php") ?>
<?php include("conexao.php") ?>
<?php include("verificar_conexao.php") ?>
<?php include("verificar_cargo.php") ?>
<?php include("fun_sub_cor.php") ?>
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
<?
$salario_presidente = 3000;
$salario_diretor = 2000;
$salario_olheiro = 1000;
?>
<?php if ($eu_olheiro == 1) { ?>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Painel do Olheiro</h1></div></div></div>
	<div class="conteudo">

<div id="linha10"><b>Salário por Rodada:</b> <?=number_format($salario_olheiro,0,',','.')?></div>
<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/seta1.png"></span> <a href="painel_indicacoes.php"><b>Indicações Feitas</b></a></div>
<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/seta1.png"></span> <a href="time_deixar.php"><b>Sair do Cargo</b></a></div>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<?php }else{ ?>
<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Painel do Olheiror</h1></div></div></div>
	<div class="conteudo">
<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Você não é olheiro de nenhum time.</div>
	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<? } ?>

<?php ob_end_flush(); ?>


<!-- FIM DA PÁGINA -->
</div>
<div class="clear"></div>

</div>
<div id="baixo"><?php include("baixo.php") ?></div>
</div>
</body>
</html>