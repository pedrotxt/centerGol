<?php ob_start(); ?>
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


<?php
if ($eu_presidente != 1 and $eu_diretor != 1 and $eu_olheiro != 1) {
	header("Location: index.php"); break;
}

ob_end_flush();
?>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Deixar Cargo</h1></div></div></div>
	<div class="conteudo">

<form name="time_deixar" method="post" action="time_deixar_salvar.php">
<input name="id" type="hidden" value="<?=$mc_time?>">

<?php if ($eu_presidente == 1) { ?>

<div id="linha10">Tem certeza que deseja deixar o cargo de <b>Presidente</b>?</div>

<div id="linha10">Lembrando que a cúpula será removida.</div>

<?php } else if ($eu_diretor == 1) { ?>

<div id="linha10">Tem certeza que deseja deixar o cargo de <b>Diretor</b>?</div>

<?php } else if ($eu_olheiro == 1) { ?>

<div id="linha10">Tem certeza que deseja deixar o cargo de <b>Olheiro</b>?</div>

<?php } ?>

<div id="linha10"><input name="submit" type="image" src="figuras/principal/botao_confirmar.png"> <a href="inicio.php"><img src="figuras/principal/botao_cancelar.png" border="0"></a></div>

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