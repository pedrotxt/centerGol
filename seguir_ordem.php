<?php include_once("fun_anti_inj.php") ?>
<?php include("verificar_cookie.php") ?>
<?php include("conexao.php") ?>
<?php include("verificar_cargo.php") ?>
<!DOCTYPE html>
<html>
<?php include("head.php") ?>
<style type="text/css">
input[type="submit"]
{
	background:url(figuras/principal/botao_confirmar.png) no-repeat;
	width:100px;
	height:30px;
	border:none;
}
</style>
<body>
<div id="container">
<div id="cima"><?php include("cima.php") ?></div>
<div id="conteudo">

<div id="esquerda"><?php include("esquerda.php") ?></div>
<div id="direita"><?php include("direita.php") ?></div>
<div id="principal">
<!-- INÍCIO DA PÁGINA -->
<?php
function timenome($id){
	$r=mysql_fetch_array(mysql_query("select ID,Time from Times where ID='".$id."'"));
	return $r['Time'];
}

$query = mysql_query("SELECT ID, Dinheiro, Ordem, Ordem_Time FROM Times WHERE ID = {$mc_time}");
$rs = mysql_fetch_array($query);

$custo=25000;
$mc_time = $rs["ID"];
$mc_dinheiro = $rs["Dinheiro"];
$mc_ordem = $rs["Ordem"];
$mc_ordem_time = $rs["Ordem_Time"];


if(isset($_POST['enviar'])){
if($mc_dinheiro < $custo){
$msg = '<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Time não tem dinheiro suficiente!</div>';
}elseif($_POST['time_secar'] == 0){
$msg = '<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Selecione um time!</div>';
}elseif($mc_ordem != 1){
$msg = '<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Você já deu uma ordem nessa Rodada!</div>';
}elseif($mc_time == $_POST['time_secar']){
$msg = '<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Você não pode secar o seu time!</div>';
}else{
	mysql_query("update Usuarios set Secar = {$_POST['time_secar']} where Time = {$mc_time} and Secar = 0");
	mysql_query("update Times set Dinheiro = Dinheiro-$custo, Ordem = 0, Ordem_Time = {$_POST['time_secar']} where ID = {$mc_time}");
	$msg = '<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_sim.png"></span> Seguir Ordem adicionado com Sucesso!</div>';
	
	$acao = 'deu a ordem para secar o time: <img style="margin-top:4px;position:absolute;margin-left:4px;" width="20" height="20" src="figuras/times_pequenos/'.$_POST['time_secar'].'.png" /> <strong><span style="margin-left:25px;"> '.timenome($_POST['time_secar']).' </span></strong>';

    mysql_query("INSERT INTO Historico (Usuario,Tipo,Acao) VALUES ('". $mc_id ."',6,'". $acao ."')");

}
}
?>
<?php if ($eu_presidente == 1 or $eu_diretor == 1) { ?>
  <? if( $mc_ordem == 1 ){ ?>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Seguir Ordem</h1></div></div></div>
	<div class="conteudo">
    <?=$msg?>
    
<div id="linha10"><b>Custo:</b> <?=$custo?></div>

<form  method="post" action="">

<div id="linha10"><span class="fonte_form">Selecione o Time para Seguir Ordem</span> <span class="align_form"><?php include("times_secar_lista.php") ?></span></div>
<div id="linha12"><input name="enviar" type="submit" value="">
</div>

</form>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>
<? }else{ ?>
<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Seguir Ordem</h1></div></div></div>
	<div class="conteudo">
    <div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Você já deu uma ordem nessa Rodada!</div>
	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>
<? } ?>
<div id="divide"></div>
<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Time sendo secado</h1></div></div></div>
	<div class="conteudo">
    <? if($mc_ordem_time != 0){ ?> <div id="linha10" style="padding:10px;"> <strong>Seu time deu a ordem para secar o Time:</strong> 
    
    
    <img style="margin-top:-2px;position:absolute;margin-left:4px;" width="20" height="20" src="figuras/times_pequenos/<?=$mc_ordem_time?>.png" /> <span style="margin-left:25px;"><a href="time.php?id=<?=$mc_ordem_time?>"> <strong><?=timenome($mc_ordem_time)?></strong> </a></span> </div>  <? }else{ ?> <div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Nenhum time sendo secado! </div><? } ?>
	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>
<div id="divide"></div>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Importante</h1></div></div></div>
	<div class="conteudo">

<div id="linha10">Secar serve para marcar gols automaticamente para o adversário do time escolhido.</div>
<div id="linha10">Você só pode dar ordem 1 vez por rodada</div>
<div id="linha10">Usuários que já estão secando time não vai sofrer alteração.</div>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<? }else{ ?>
<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Seguir Ordem</h1></div></div></div>
	<div class="conteudo">
    <div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span>Você não é presidente ou diretor.</div>
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