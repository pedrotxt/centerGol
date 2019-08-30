<?php ob_start(); ?>
<?php include("fun_ .php") ?>
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
$id =  ($_GET['id']);

if (!$id) {
	header("Location: index.php"); break;
}

if (ereg('[^0-9]',$id)) {
	header("Location: index.php"); break;
}

if ($id < 1 or $id > 50) {
	header("Location: index.php"); break;
}

$query = mysql_query("SELECT vip FROM Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$rs = mysql_fetch_array($query);

$mc_vip = $rs["vip"];

$query = mysql_query("SELECT nivel FROM Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$rs = mysql_fetch_array($query);

$mc_nivel = $rs["nivel"];

$query = mysql_query("SELECT Time, Presidente FROM Times WHERE ID = '". $id ."'");
$rs = mysql_fetch_array($query);

$time_nome = $rs["Time"];
$time_presidente = $rs["Presidente"];

ob_end_flush();
?>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Virar Presidente</h1></div></div></div>
	<div class="conteudo">

<?php if ($mc_vip <10) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Você não tem VIP suficiente para assumir este cargo. </br> é preciso, ter no mínimo 10 dias para assumir!</div>
<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/seta1.png"></span> <a href="loja.php"><b>Ver Planos</b></a></div>

<?php } else if ($time_presidente != 0) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> <a href="time.php?id=<?=$id?>"><b><?=$time_nome?></b></a></span> tem Presidente, não tem como você assumir no momento.</div>

<?php } else if ($mc_time != $id) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Você precisa estar no time <a href="time.php?id=<?=$id?>"><b><?=$time_nome?></b></a></span> para assumir o controle.</div>

<?php } else { ?>

<form name="time_assumir" method="post" action="time_assumir_salvar.php">
<input name="id" type="hidden" value="<?=$id?>">

<div id="linha10">Tem certeza que deseja assumir o cargo de <b>Presidente</b>? Lembrando que assumindo a presidência do clube, você não poderá passar mais de 10 dias sem acessar sua conta, ou perderá o cargo de Presidente.</div>
<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/presidente.png"></span> Você tem <b><?=number_format($mc_vip,0,',','.')?></b> <?php if ($mc_vip == 1) { ?>Dia<?php } else { ?>Dias<?php } ?> de VIP. Evite que acabe, caso contrário a cúpula será removida.</div>
<div id="linha10"><input name="submit" type="image" src="figuras/principal/botao_confirmar.png"> <a href="inicio.php"><img src="figuras/principal/botao_cancelar.png" border="0"></a></div>

</form>

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