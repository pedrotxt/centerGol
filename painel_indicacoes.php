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
<? if ($eu_olheiro == 1 or $eu_presidente == 1 or $eu_diretor == 1) { 
if(isset($_POST['Excluir'])){
	
}
?>
<style type="text/css">
input[type="submit"]
{
	background:url(figuras/principal/botao_canc.png) no-repeat;
	width:130px;
	height:30px;
	border:none;
}
</style>
<?php
$p = anti_inj($_GET['p']);

if (ereg('[^0-9]',$p)) {
	header("Location: index.php"); break;
}

if (!$p) {
	$p = 1;
}
if($eu_olheiro == 1){
$query = mysql_query("SELECT Count(ID) AS olheiro_quantidade FROM Olheiro WHERE Time = '". $mc_time ."' AND De='".$mc_id."'");
}else{
$query = mysql_query("SELECT Count(ID) AS olheiro_quantidade FROM Olheiro WHERE Time = '". $mc_time ."'");
}
$rs = mysql_fetch_array($query);

$olheiro_quantidade = $rs["olheiro_quantidade"];

$limite = 10;
$inicio = $p - 1;
$inicio = $limite * $inicio;

$p_total = ceil($olheiro_quantidade / $limite);

if ($p_total < 1) {
	$p_total = 1;
}

if ($p > $p_total) {
	header("Location: painel_indicacoes.php?p=1"); break;
}

ob_end_flush();

?>
<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Indicações (<?=number_format($olheiro_quantidade,0,',','.')?>)</h1></div></div></div>
	<div class="conteudo">
<div id="linha10"><a href="painel_indicacoes.php"><img src="figuras/principal/botao_atualizar.png" border="0"></a></div>
	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<?php
if($eu_olheiro == 1){
$query = mysql_query("SELECT * from Olheiro WHERE Time='".$mc_time."' AND De='".$mc_id."' ORDER BY ID DESC LIMIT $inicio,$limite");
}else{
$query = mysql_query("SELECT * from Olheiro WHERE Time='".$mc_time."' ORDER BY ID DESC LIMIT $inicio,$limite");
}
?>

<?php while ($rs = mysql_fetch_array($query)) { ?>

<div class="box_branco">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"></div></div></div>
	<div class="conteudo">


<div><a href="time.php?id=<?=$rs["Time_User"]?>"><span class="img20"><img width="20" height="20" src="figuras/times_pequenos/<?=$rs["Time_User"]?>.png" title="<?=$usuario_time_nome?>" alt="<?=$usuario_time_nome?>" border="0"></span></a> <a href="usuario.php?id=<?=$rs["Usuario"]?>"><?php if ($rs["Usuario_VIP"] > 0) { ?><span id="usuario_vip<?=$rs["Usuario_VIP_Cor"]?>"><?=usuarionome($rs["Usuario"])?></span><?php } else { ?><span id="usuario_normal"><?=usuarionome($rs["Usuario"])?></span><?php } ?></a> (<?=$rs["Data"]?>)</div>

<?php if ($rs["Motivo"]) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/propostas_mensagem.png" title="Mensagem" alt="Mensagem"></span> <b>Motivo:</b> <?=$rs["Motivo"]?></div>

<?php } ?>
<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/olheiro.png" title="Olheiro" alt="Olheiro"></span> <b>Olheiro:</b> <a href="usuario.php?id=<?=$rs["De"]?>"><?php if ($rs["Usuario_VIP"] > 0) { ?><span id="usuario_vip<?=$rs["Usuario_VIP_Cor"]?>"><?=usuarionome($rs["De"])?></span><?php } else { ?><span id="usuario_normal"><?=usuarionome($rs["De"])?></span><?php } ?></a></div>

<div id="linha10"><a href="usuario.php?id=<?=$rs["Usuario"]?>"><img src="figuras/principal/botao_verificar.png" border="0"></a> </div>
<div id="linha10"><a href="painel_indicacoes_recusar.php?id=<?=$rs["ID"]?>"><img src="figuras/principal/botao_canc.png" border="0"></a></div>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>


<? } ?>

<?php
if ($olheiro_quantidade > $limite) {
	$p_nome = "painel_indicacoes";
	include("paginacao1.php");
}
}else{	
?>
<div class="box_branco">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"></div></div></div>
	<div class="conteudo">
    Desculpa você não pode acessar essa página!
    	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>
<? } ?>
<!-- FIM DA PÁGINA -->
</div>
<div class="clear"></div>

</div>
<div id="baixo"><?php include("baixo.php") ?></div>
</div>
</body>
</html>