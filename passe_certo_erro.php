<?php ob_start(); ?>
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


<?php
$id = anti_inj($_GET['id']);

if (!$id) {
	header("Location: index.php"); break;
}

if (ereg('[^0-9]',$id)) {
	header("Location: index.php"); break;
}

if ($id != 1 and $id != 2 and $id != 3) {
	header("Location: index.php"); break;
}

$query = mysql_query("SELECT Frase FROM Passe_Certo_Frases WHERE Posicao = '". $id ."' ORDER BY RAND() LIMIT 1");
$rs = mysql_fetch_array($query);

$frase = $rs["Frase"];

ob_end_flush();
?>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Passe Certo</h1></div></div></div>
	<div class="conteudo">

<?php if ($id == 1) { ?>

<div id="linha10">Você errou o Passe no <b>Zagueiro</b>.</div>

<?php } else if ($id == 2) { ?>

<div id="linha10">Você errou o Passe no <b>Meio-Campista</b>.</div>

<?php } else if ($id == 3) { ?>

<div id="linha10">Você errou o Passe no <b>Atacante</b>.</div>

<?php } ?>

<div id="linha10"><b>Motivo:</b> <?=$frase?></div>
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