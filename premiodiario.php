<strong></strong><?php ob_start(); ?>
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
<?php if (!$_COOKIE["usuarioid"]) { }else{?>

<?
$query = mysql_query("SELECT ID, VIP_Tempo, premiodiario FROM Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$rs = mysql_fetch_array($query);

$mc_vip_tempo = $rs["VIP_Tempo"];
$mc_id = $rs["ID"];
$mc_premiodiario = $rs["premiodiario"];

$var = mt_rand(1,100);
if(isset($_POST['receber'])){
	if($mc_premiodiario != 1){
	}else{
if($var<=10){
	
$comum = mt_rand(1,10);
switch($comum){
			case 1: 
$acao = ' ganhou 2 Dias de VIP no Premio Diario';
if($mc_vip_tempo < time()){
mysql_query("UPDATE Usuarios SET VIP_Tempo = '". (time()+2*86400) ."', premiodiario=0 WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
}else{
mysql_query("UPDATE Usuarios SET VIP_Tempo = VIP_Tempo + '". (2*86400) ."', premiodiario=0 WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
}
mysql_query("INSERT INTO Historico (Usuario,Tipo,Acao) VALUES ('". $mc_id ."',15,'". $acao ."')");
$msg = '<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_sim.png"></span> Parabéns Você recebeu 2 Dia de VIP</div> ' ; break;

			
			case 2: 
$acao = ' ganhou 1 Dia de VIP no Premio Diario';
if($mc_vip_tempo < time()){
mysql_query("UPDATE Usuarios SET VIP_Tempo = '". (time()+1*86400) ."', premiodiario=0 WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
}else{
mysql_query("UPDATE Usuarios SET VIP_Tempo = VIP_Tempo + '". (1*86400) ."', premiodiario=0 WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
}
mysql_query("INSERT INTO Historico (Usuario,Tipo,Acao) VALUES ('". $mc_id ."',15,'". $acao ."')");
$msg = '<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_sim.png"></span> Parabéns Você recebeu 1 Dia de VIP</div> ' ; break;


			case 3: 
$acao = ' ganhou 10.000 LC Cash no Premio Diario';
mysql_query("update Usuarios set Dinheiro=Dinheiro+10000, premiodiario=0 WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
mysql_query("INSERT INTO Historico (Usuario,Tipo,Acao) VALUES ('". $mc_id ."',15,'". $acao ."')");
$msg = '<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_sim.png"></span> Parabéns Você recebeu 10.000 LC Cash</div> ' ; break;


			case 4: 
$acao = ' ganhou 10.000 LC Cash no Premio Diario';
mysql_query("update Usuarios set Dinheiro=Dinheiro+10000, premiodiario=0 WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$msg = '<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_sim.png"></span> Parabéns Você recebeu 10.000 LC Cash</div> ' ; break;


			case 5: 
$acao = ' ganhou 9.000 LC Cash no Premio Diario';
mysql_query("update Usuarios set Dinheiro=Dinheiro+9000, premiodiario=0 WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$msg = '<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_sim.png"></span> Parabéns Você recebeu 9.000 LC Cash</div> ' ; break;


			case 6: 
$acao = ' ganhou 9.000 LC Cash no Premio Diario';
mysql_query("update Usuarios set Dinheiro=Dinheiro+9000, premiodiario=0 WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$msg = '<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_sim.png"></span> Parabéns Você recebeu 9.000 LC Cash</div> ' ; break;


			case 7: 
$acao = ' ganhou 9.000 LC Cash no Premio Diario';
mysql_query("update Usuarios set Dinheiro=Dinheiro+9000, premiodiario=0 WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$msg = '<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_sim.png"></span> Parabéns Você recebeu 9.000 LC Cash</div> ' ; break;


			case 8: 
$acao = ' ganhou 8.000 LC Cash no Premio Diario';
mysql_query("update Usuarios set Dinheiro=Dinheiro+8000, premiodiario=0 WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$msg = '<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_sim.png"></span> Parabéns Você recebeu 8.000 LC Cash</div> ' ; break;


			case 9: 
$acao = ' ganhou 8.000 LC Cash no Premio Diario';
mysql_query("update Usuarios set Dinheiro=Dinheiro+8000, premiodiario=0 WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$msg = '<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_sim.png"></span> Parabéns Você recebeu 8.000 LC Cash</div> ' ; break;


			case 10: 
$acao = ' ganhou 8.000 LC Cash no Premio Diario';
mysql_query("update Usuarios set Dinheiro=Dinheiro+8000, premiodiario=0 WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$msg = '<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_sim.png"></span> Parabéns
Você recebeu 8.000 LC Cash</div> ' ; break;

}
}


if($var>10 && $var<=20){
$comum = mt_rand(1,3);
switch($comum){
			case 1: 
mysql_query("update Usuarios set Dinheiro=Dinheiro+6000, premiodiario=0 WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$msg = '<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_sim.png"></span> Parabéns Você recebeu 6.000 LC Cash</div> ' ; break;


			case 2: 
mysql_query("update Usuarios set Dinheiro=Dinheiro+5000, premiodiario=0 WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$msg = '<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_sim.png"></span> Parabéns Você recebeu 5.000 LC Cash</div> ' ; break;


			case 3: 
mysql_query("update Usuarios set Dinheiro=Dinheiro+4000, premiodiario=0 WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$msg = '<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_sim.png"></span> Parabéns Você recebeu 4.000 LC Cash</div> ' ; break;
}
}



if($var>20 && $var<=100){
$comum = mt_rand(1,3);
switch($comum){
			case 1: 
mysql_query("update Usuarios set Dinheiro=Dinheiro+3000, premiodiario=0 WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$msg = '<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_sim.png"></span> Parabéns Você recebeu 3.000 LC Cash</div> ' ; break;


			case 2: 
mysql_query("update Usuarios set Dinheiro=Dinheiro+2000, premiodiario=0 WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$msg = '<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_sim.png"></span> Parabéns Você recebeu 2.000 LC Cash</div> ' ; break;


			case 3: 
mysql_query("update Usuarios set Dinheiro=Dinheiro+1000, premiodiario=0 WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$msg = '<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_sim.png"></span> Parabéns Você recebeu 1.000 LC Cash</div> ' ; break;
}
}
}
}


?>


<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Receber Prêmio</h1></div></div></div>
	<div class="conteudo">
    <?=$msg?>
<? 	if($mc_premiodiario != 1){echo'<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Você já recebeu o premio diario hoje, volte amanhã!</div>';}else{ ?>
<div id="linha10"> <strong>Aqui você receberá um Prêmio Diario, os prêmios foram citados na box Abaixo</strong></div>
<div id="linha10"> <strong>Clique no Botão Abaixo para receber o Prêmio!</strong></div>

<br>
<form  method="post" action="">
<div align="center"><input name="receber" type="submit" value=""></div>
</form>
<? } ?>
	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<div id="divide"></div>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Prêmios Comuns</h1></div></div></div>
	<div class="conteudo">

<div id="linha10"><strong>1.000 LC Cash </strong></div>
<div id="linha10"><strong>2.000 LC Cash </strong></div>
<div id="linha10"><strong>3.000 LC Cash</strong></div>
<div id="linha10"><strong>4.000 LC Cash </strong></div>
<div id="linha10"><strong>5.000 LC Cash </strong></div>
<div id="linha10"><strong>6.000 LC Cash</strong></div>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<div id="divide"></div>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Prêmios Raros</h1></div></div></div>
	<div class="conteudo">

<div id="linha10"><strong>8.000 LC Cash </strong></div>
<div id="linha10"><strong>9.000 LC Cash </strong></div>
<div id="linha10"><strong>10.000 LC Cash </strong></div>
<div id="linha10"><strong>1 Dia de VIP </strong></div>
<div id="linha10"><strong>2 Dias de VIP</strong></div>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<div id="divide"></div>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Importante</h1></div></div></div>
	<div class="conteudo">

<div id="linha10"><strong>Você só pode receber premiação 1 vez por Rodada </strong></div>
<div id="linha10"><strong>Premiação Diaria é liberada às 00:00 na virada da Rodada </strong></div>
<div id="linha10"><strong>Quando um sortudo ganha um prêmio raro é postado no Historico Geral </strong></div>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<!-- FIM DA PÁGINA -->
<? } ?>
</div>
<div class="clear"></div>

</div>
<div id="baixo"><?php include("baixo.php") ?></div>
</div>
</body>
</html>