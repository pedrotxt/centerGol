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


<script language="javascript">
function somente_numeros(evt) {

var key_code = evt.keyCode  ? evt.keyCode  :
				evt.charCode ? evt.charCode :
				evt.which    ? evt.which    : void 0;

if (key_code == 8 ||  key_code == 9 ||  key_code == 13 || key_code == 48 ||  key_code == 49 ||  key_code == 50 ||  key_code == 51 ||  key_code == 52 ||  key_code == 53 ||  key_code == 54 ||  key_code == 55 ||  key_code == 56 ||  key_code == 57) { return true; }

return false;

}

function valida_renovar() {

if (document.renovar.valor.value=="") {
	alert("É necessário preencher o valor.");
	document.renovar.valor.focus();
	return false;
}

if (document.renovar.valor.value==0) {
	alert("É necessário preencher um valor maior.");
	document.renovar.valor.focus();
	return false;
}

}
</script>

<?php
if ($eu_presidente == 0 and $eu_diretor == 0) {
	header("Location: index.php"); break;
}

$id = anti_inj($_GET['id']);

if (!$id) {
	header("Location: index.php"); break;
}

if (ereg('[^0-9]',$id)) {
	header("Location: index.php"); break;
}

if ($id == $mc_id) {
	header("Location: index.php"); break;
}

$query = mysql_query("SELECT Dinheiro FROM Times WHERE ID = '". $mc_time ."'");
$rs = mysql_fetch_array($query);

$mc_time_dinheiro = $rs["Dinheiro"];

$query = mysql_query("SELECT Trocas FROM Configuracoes");
$rs = mysql_fetch_array($query);

$trocas_total = $rs["Trocas"];

$query = mysql_query("SELECT VIP, Rescisao_Dias_VIP FROM Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$rs = mysql_fetch_array($query);

$mc_vip = $rs["VIP"] - 1;
$mc_vip_rescisao = $rs["Rescisao_Dias_VIP"];
$mc_vip_total = $mc_vip - $mc_vip_rescisao;

if ($mc_vip_total < 0) {
	$mc_vip_total = 0;
}

$query = mysql_query("SELECT Propostas, Usuario, Time, VIP, VIP_Cor, Trocas, Valor, Rescisao, Rescisao_Dias, Rescisao_Dias_VIP FROM Usuarios WHERE ID = '". $id ."'");
$rs = mysql_fetch_array($query);

if (!$rs) {
	header("Location: index.php"); break;
}

$usuario_propostas = $rs["Propostas"];

if ($usuario_propostas == 0) {
	header("Location: index.php"); break;
}

$usuario_nome = $rs["Usuario"];
$usuario_time = $rs["Time"];
$usuario_vip = $rs["VIP"];
$usuario_vip_cor = $rs["VIP_Cor"];
$usuario_trocas = $rs["Trocas"];
$usuario_valor = $rs["Valor"];
$usuario_rescisao = $rs["Rescisao"];
$usuario_rescisao_dias = $rs["Rescisao_Dias"];
$usuario_rescisao_dias_vip = $rs["Rescisao_Dias_VIP"];

$query = mysql_query("SELECT Time, Presidente, Diretor, Olheiro_1, Olheiro_2, Olheiro_3 FROM Times WHERE ID = '". $usuario_time ."'");
$rs = mysql_fetch_array($query);

$usuario_time_nome = $rs["Time"];
$usuario_time_presidente = $rs["Presidente"];
$usuario_time_diretor = $rs["Diretor"];
$usuario_time_olheiro_1 = $rs["Olheiro_1"];
$usuario_time_olheiro_2 = $rs["Olheiro_2"];
$usuario_time_olheiro_3 = $rs["Olheiro_3"];

if ($id == $usuario_time_presidente or $id == $usuario_time_diretor or $id == $usuario_time_olheiro_1 or $id == $usuario_time_olheiro_2 or $id == $usuario_time_olheiro_3) {
	$usuario_cargo = 1;
}

ob_end_flush();
?>

<?php if ($usuario_cargo == 1) { ?>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Renovar Contrato</h1></div></div></div>
	<div class="conteudo">

<div id="linha10"><a href="usuario.php?id=<?=$id?>"><?php if ($usuario_vip > 0) { ?><span id="usuario_vip<?=$usuario_vip_cor?>"><?=$usuario_nome?></span><?php } else { ?><span id="usuario_normal"><?=$usuario_nome?></span><?php } ?></a> tem cargo no <a href="time.php?id=<?=$usuario_time?>"><b><?=$usuario_time_nome?></b></a> e não pode ter contrato renovado.</div>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<?php } else if ($usuario_time != $mc_time) { ?>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Renovar Contrato</h1></div></div></div>
	<div class="conteudo">

<div id="linha10"><a href="usuario.php?id=<?=$id?>"><?php if ($usuario_vip > 0) { ?><span id="usuario_vip<?=$usuario_vip_cor?>"><?=$usuario_nome?></span><?php } else { ?><span id="usuario_normal"><?=$usuario_nome?></span><?php } ?></a> não é do seu time.</div>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<?php } else { ?>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Sobre o Usuário</h1></div></div></div>
	<div class="conteudo">

<div id="linha10"><b>Nome:</b> <a href="usuario.php?id=<?=$id?>"><?php if ($usuario_vip > 0) { ?><span id="usuario_vip<?=$usuario_vip_cor?>"><?=$usuario_nome?></span><?php } else { ?><span id="usuario_normal"><?=$usuario_nome?></span><?php } ?></a></div>

<div id="linha10"><b>Trocas na Temporada:</b> <?=$usuario_trocas?> / <?=$trocas_total?></div>

<div id="linha10"><b>Valor Esperado:</b> <?=number_format($usuario_valor,0,',','.')?></div>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<div id="divide"></div>



<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Contrato Atual</h1></div></div></div>
	<div class="conteudo">

<?php if ($usuario_rescisao != 0 or $usuario_rescisao_dias != 0 or $usuario_rescisao_dias_vip != 0) { ?>

<?php if ($usuario_rescisao != 0) { ?>
<?php
$mc_vip_tempo = $usuario_rescisao_dias;
$data_inicial = time()-86400 ;
$data_final = $mc_vip_tempo;
$diferenca = $data_final - $data_inicial;
$dias = (int)floor( $diferenca / (60 * 60 * 24));
$diasvip = $usuario_rescisao_dias_vip;
$data_inicial = time()-86400 ;
$data_final = $diasvip;
$diferenca = $data_final - $data_inicial;
$diasvips = (int)floor( $diferenca / (60 * 60 * 24));

?>
<? if($mc_vip_tempo > time()){ ?>
<div id="linha10"><b>Multa de Rescisão:</b> <?=number_format($usuario_rescisao,0,',','.')?> (<?=$dias?> <?php if ($dias == 1) { ?> dia<?php } else { ?> dias<?php } ?>)</div>
<? }else{}?>

<?php } ?>

<?php if ($usuario_rescisao_dias_vip != 0) { ?>

<div id="linha10"><b>Dias de VIP:</b> <?=$diasvips?></div>

<?php } ?>

<?php } else { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Sem contrato com o time!</div>

<?php } ?>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<div id="divide"></div>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Sobre Você</h1></div></div></div>
	<div class="conteudo">

<div id="linha10"><b>Dinheiro do Time:</b> <?=number_format($mc_time_dinheiro,0,',','.')?></div>

<div id="linha10"><b>Dias de VIP:</b> <?=number_format($mc_vip_total,0,',','.')?></div>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<div id="divide"></div>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Renovar Contrato</h1></div></div></div>
	<div class="conteudo">

<?php if (anti_inj($_GET["msg_renovar"]) == 1) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_sim.png"></span> Renovação enviada com sucesso!</div>

<?php } else if (anti_inj($_GET["msg_renovar"]) == 2) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Esse jogador já tem proposta para renovar com o seu time!</div>

<?php } else if (anti_inj($_GET["msg_renovar"]) == 3) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Time sem esse dinheiro em caixa!</div>

<?php } else if (anti_inj($_GET["msg_renovar"]) == 4) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Você não tem esses dias de VIP!</div>

<?php } ?>

<form name="renovar" method="post" action="usuario_renovar_salvar.php" onSubmit="return valida_renovar()">
<input name="id" type="hidden" value="<?=$id?>">

<div id="linha10"><span class="fonte_form">Qual o valor desejado?</span> <span class="align_form"><input name="valor" type="text" maxlength="7" onKeyPress="return somente_numeros(event);" style="width: 90px; height: 20px"></span></div>

<div id="linha15">
<span class="fonte_form">Quantos dias de Rescisão?</span>
<span class="align_form">
<select name="rescisao_dias" style="width: 100px; height: 26px">
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5" selected>5</option>
<option value="6">6</option>
<option value="7">7</option>
<option value="8">8</option>
<option value="9">9</option>
<option value="10">10</option>
</select>
</span>
</div>

<div id="linha15">
<span class="fonte_form">Quantos dias de VIP?</span>
<span class="align_form">
<select name="rescisao_dias_vip" style="width: 100px; height: 26px">
<option value="0" selected>0</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
<option value="8">8</option>
<option value="9">9</option>
<option value="10">10</option>
</select>
</span>
</div>

<div id="linha15"><span class="fonte_form">Mensagem para o usuário?</span> <span class="align_form"><input name="mensagem" type="text" maxlength="100" style="width: 200px; height: 20px"></span></div>

<div id="linha12"><input name="submit" type="image" src="figuras/principal/botao_confirmar.png" onClick="return valida_renovar()"></div>
</form>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<div id="divide"></div>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Importante</h1></div></div></div>
	<div class="conteudo">

<div id="linha10">Caso o usuário aceite o novo contrato, o atual será descartado.</div>
<div id="linha10">Preencha o valor somente com números.</div>
<div id="linha10">A multa de rescisão com o seu time será o dobro do valor oferecido.</div>
<div id="linha10">Caso você ofereça dias de VIP, o jogador ficará no seu time até os dias acabarem.</div>
<div id="linha10">Se o sistema detectar desvio de dinheiro, sua conta será banida sem aviso.</div>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<?php } ?>


<!-- FIM DA PÁGINA -->
</div>
<div class="clear"></div>

</div>
<div id="baixo"><?php include("baixo.php") ?></div>
</div>
</body>
</html>