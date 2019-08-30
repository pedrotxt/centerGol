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


<script language="javascript">
function somente_numeros(evt) {

var key_code = evt.keyCode  ? evt.keyCode  :
				evt.charCode ? evt.charCode :
				evt.which    ? evt.which    : void 0;

if (key_code == 8 ||  key_code == 9 ||  key_code == 13 || key_code == 48 ||  key_code == 49 ||  key_code == 50 ||  key_code == 51 ||  key_code == 52 ||  key_code == 53 ||  key_code == 54 ||  key_code == 55 ||  key_code == 56 ||  key_code == 57) { return true; }

return false;

}

function valida_doar_dinheiro() {

if (document.doar_dinheiro.q.value=="") {
	alert("É necessário preencher o dinheiro.");
	document.doar_dinheiro.q.focus();
	return false;
}

if (document.doar_dinheiro.q.value<100) {
	alert("É necessário preencher um valor maior.");
	document.doar_dinheiro.q.focus();
	return false;
}

}
</script>

<?php
$id = anti_inj($_GET['id']);

if (!$id) {
	header("Location: index.php"); break;
}

if (ereg('[^0-9]',$id)) {
	header("Location: index.php"); break;
}

if ($id < 1 or $id > 60) {
	header("Location: index.php"); break;
}

$query = mysql_query("SELECT ID, ID2, Time, Presidente, Diretor FROM Times WHERE ID = '". $id ."'");
$rs = mysql_fetch_array($query);

$time_id = $rs["ID"];
$time_id2 = $rs["ID2"];
$time_nome = $rs["Time"];
$time_presidente = $rs["Presidente"];
$time_diretor = $rs["Diretor"];

if ($time_id2 <= 10) {
	$grupo = 1;
} else if ($time_id2 > 10 and $time_id2 <= 20) {
	$grupo = 2;
} else if ($time_id2 > 20 and $time_id2 <= 30) {
	$grupo = 3;
} else if ($time_id2 > 30 and $time_id2 <= 40) {
	$grupo = 4;
}

if ($time_presidente != 0) {

$query = mysql_query("SELECT Usuario, VIP, VIP_Cor, Gols_Total FROM Usuarios WHERE ID = '". $time_presidente ."'");
$rs = mysql_fetch_array($query);

$presidente_nome = $rs["Usuario"];
$presidente_vip = $rs["VIP"];
$presidente_vip_cor = $rs["VIP_Cor"];
$presidente_gols_total = $rs["Gols_Total"];

}

if ($time_diretor != 0) {

$query = mysql_query("SELECT Usuario, VIP, VIP_Cor, Gols_Total FROM Usuarios WHERE ID = '". $time_diretor ."'");
$rs = mysql_fetch_array($query);

$diretor_nome = $rs["Usuario"];
$diretor_vip = $rs["VIP"];
$diretor_vip_cor = $rs["VIP_Cor"];
$diretor_gols_total = $rs["Gols_Total"];

}

ob_end_flush();
?>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Sobre o Time</h1></div></div></div>
	<div class="conteudo">

<div id="linha10"><span class="img20"><a href="time.php?id=<?=$time_id?>"><img width="20" height="20" src="figuras/times_pequenos/<?=$time_id?>.png" title="<?=$time_nome?>" alt="<?=$time_nome?>" border="0"></a></span> <a href="time.php?id=<?=$time_id?>"><?=$time_nome?></a> <span class="align5">(Grupo <?=$grupo?>)</span></div>

<?php if ($time_presidente != 0) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/presidente.png" title="Presidente" alt="Presidente"></span> <a href="usuario.php?id=<?=$presidente_id?>"><?php if ($presidente_vip > 0) { ?><span id="usuario_vip<?=$presidente_vip_cor?>"><?=$presidente_nome?></span><?php } else { ?><span id="usuario_normal"><?=$presidente_nome?></span><?php } ?></a> <span class="align5">(<?=number_format($presidente_gols_total,0,',','.')?> gols)</span></div>

<?php } ?>

<?php if ($time_diretor != 0) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/diretor.png" title="Diretor" alt="Diretor"></span> <a href="usuario.php?id=<?=$diretor_id?>"><?php if ($diretor_vip > 0) { ?><span id="usuario_vip<?=$diretor_vip_cor?>"><?=$diretor_nome?></span><?php } else { ?><span id="usuario_normal"><?=$diretor_nome?></span><?php } ?></a> <span class="align5">(<?=number_format($diretor_gols_total,0,',','.')?> gols)</span></div>

<?php } ?>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<div id="divide"></div>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Doar Dinheiro</h1></div></div></div>
	<div class="conteudo">

<?php if (anti_inj($_GET["msg_doar_dinheiro"]) == 1) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_sim.png"></span> Dinheiro doado com sucesso!</div>

<?php } else if (anti_inj($_GET["msg_doar_dinheiro"]) == 2) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Você não tem essa quantidade de dinheiro!</div>

<?php } else if (anti_inj($_GET["msg_doar_dinheiro"]) == 3) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Doação mínima é de 100!</div>

<?php } ?>

<form name="doar_dinheiro" method="post" action="time_doar_dinheiro_salvar.php?id=<?=$id?>" onSubmit="return valida_doar_dinheiro()">

<div id="linha10"><span class="fonte_form">Quanto você quer doar?</span> <span class="align_form"><input name="q" type="text" maxlength="6" onKeyPress="return somente_numeros(event);" style="width: 90px; height: 20px"></span></div>

<div id="linha12"><input name="submit" type="image" src="figuras/principal/botao_confirmar.png" onClick="return valida_doar_dinheiro()"></div>

</form>

<script language="javascript">
document.doar_dinheiro.q.focus();
</script>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<div id="divide"></div>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Importante</h1></div></div></div>
	<div class="conteudo">

<div id="linha10">Preencha o valor somente com números.</div>
<div id="linha10">Valor mínimo para doação é 100.</div>
<div id="linha10">Ao clicar em confirmar, a sua ação não poderá ser desfeita.</div>
<div id="linha10">Não nos responsabilizamos por vendas feitas por esse sistema.</div>

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