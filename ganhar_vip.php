<?php ob_start(); ?>
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
  <style type="text/css">
input[type="submit"]
{
	background:url(figuras/principal/botao_confirmar.png) no-repeat;
	width:100px;
	height:30px;
	border:none;
}
</style>
  <?
  $query = mysql_query("SELECT tutorialvip,VIP_Tempo FROM Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$rs = mysql_fetch_array($query);

$mc_vip_tempo = $rs["VIP_Tempo"];
$mc_tutorial_vip = $rs["tutorialvip"];


  if(isset($_POST['ganhar'])){
	  if($mc_tutorial_vip !=1){
$msg = '<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Você já recebeu esse Prêmio!</div> ' ;
		  }elseif($mc_tutorial_vip > time()){
$msg = '<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Você já tem VIP, Volte aqui quando acabar!</div> ' ;
		  }else{
if($mc_vip_tempo < time()){
mysql_query("UPDATE Usuarios SET VIP_Tempo = '". (time()+1*86400) ."',tutorial=0, tutorialvip=0 WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
}else{
mysql_query("UPDATE Usuarios SET VIP_Tempo = VIP_Tempo + '". (1*86400) ."',tutorial=0, tutorialvip=0 WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
}
$msg = '<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_sim.png"></span> Parabéns você ganhou 1 dia de VIP Gratis.</div> ' ;

  }
  }
  ?>
  <div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Ganhar VIP Gratis</h1></div></div></div>
	<div class="conteudo">
<?=$msg?>
<div id="linha10" align="center">Clique no botão abaixo para ganhar o VIP Gratis</div>
<form  method="post" action="">
<div id="linha6" align="center"><input name="ganhar" type="submit" value=""></div>
</form>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>
<div id="divide"></div>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Importante</h1></div></div></div>
	<div class="conteudo">
    
<div id="linha10"><strong> Você só pode receber esse prêmio se você não tiver VIP </strong></div>
<div id="linha10"><strong> Você só pode receber esse prêmio apenas 1 vez! </strong></div>
<div id="linha10"><strong> Se você já recebeu não poderá mais receber. </strong></div>


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