<style>
.top-header{
	background: url(./figuras/principal/header.jpg) center;
	border-radius: 0px 0px 5px 5px;
	border-top:0px double #ccc;
	border-left:3px double #ccc;
	border-right:3px double #ccc;
	border-bottom:3px double #ccc;
	min-height:190px;
	margin-top:-20px;
}
.menu-top{
	background: url(./figuras/principal/news/bg_blank.jpg);
	width:799px;
	margin-top:2px;
	border-radius: 5px 5px 0px 0px;
	border-top:3px double #ccc;
	border-left:3px double #ccc;
}
.menu-top1{
	background: url(./figuras/principal/news/bg_blank.jpg);
	width:789px;
	margin-top:2px;
	border-radius: 5px 5px 0px 0px;
	border-top:3px double #ccc;
	border-right:3px double #ccc;
}

.menu-top li{
	min-width:100px;
}
.f-nav { z-index: 9999; position: fixed; top: 0;
	border-radius: 0px 0px 5px 5px;
	border-top:0px double #ccc;
	border-left:3px double #ccc;
	border-right:3px double #ccc;
	border-bottom:3px double #ccc;
	-webkit-box-shadow:0px 0px 12px 0px rgba(50, 50, 50, 0.75);
	-moz-box-shadow:0px 0px 12px 0px rgba(50, 50, 50, 0.75);
	box-shadow: 0px 0px 12px 0px rgba(50, 50, 50, 0.75);
	margin-top:-3px;
}

.online{float:right;width:150px!important;height:25px;padding:5px;margin-top:0px;}
.online .on{background:rgba(0,0,0,.2);border-radius:3px;padding:4px;height:15px;}
.online .on a span{color:#333;font-size:13px;}
</style>
    <link rel="stylesheet" href="js/tipsy.css" type="text/css" />
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type='text/javascript' src='js/jquery.tipsy.js'></script>


    <script type="text/javascript">
    $('#tip-w').tipsy({gravity: 'w'});
	$('#tip-sw').tipsy({gravity: 'sw'});
	$('#tip-ne').tipsy({gravity: 'ne'});
	$('#tip-nw').tipsy({gravity: 'nw'});
	$('#tip-n').tipsy({gravity: 'n'});
	$('#tip-e').tipsy({gravity: 'e'});
	$('#tip-s').tipsy({gravity: 's'});
	$('.tip-s').tipsy({gravity: 's'});
</script>
<?php if (!$_COOKIE["usuarioid"]) { }else{?>
<?php
$a=mysql_fetch_array(mysql_query("select premiodiario,Usuario from Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')"));
$usuario_nome = $a["Usuario"];
if($a['premiodiario'] != 1){
}else{
 ?>
<div style="width: 108px; position:absolute; top: 169px; margin-left:730px; z-index:99;
">

<a href="premiodiario.php"><img  width="60" height="60" id="tip-n" original-title="CLIQUE AQUI PARA RECEBER SEU PRÊMIO DIARIO" src="figuras/principal/diario.png" border="0"></a></div>
<? }}?>
<div class="top-header">
</div>
<style type="text/css">
.baixo{float:left; margin-top:-33px; margin-left:5px; position:absolute;}
.seriea{display:block;float:left; padding:5px;}
.serieb{display:none;float:left; padding:5px;}
.seriec{display:none;float:left; padding:5px;}
</style>
<div class="baixo">
<select id="serie" onchange="if(this.value == 'a'){
$('.seriea').show();
$('.serieb').hide();
$('.seriec').hide();
}else if(this.value == 'b'){
$('.serieb').show();
$('.seriea').hide();
$('.seriec').hide();
}else{
$('.seriec').show();
$('.seriea').hide();
$('.serieb').hide();};">
<option value="a">Serie A</option>
<option value="b">Serie B</option>
<option value="c">Serie C</option>
</select>
</div>
<div style="position:absolute; margin-left:100px; margin-top:-42px;">
<? 
   function pegaid($id){
   $r=mysql_fetch_array(mysql_query("select ID,Time from Times where ID2='".$id."'"));
   return $r['ID'];
}
   $a=mysql_query("select * from Tabela_Campeonato where Serie='A'");
   while($b=mysql_fetch_array($a)){ 

?>
<div class="seriea"><a href="time.php?id=<?=pegaid($b['Time'])?>"><img height="30" width="30" src="./figuras/times_grandes/<?=pegaid($b['Time'])?>.png" /></a></div>
<? } $a=mysql_query("select * from Tabela_Campeonato where Serie='B'");
   while($b=mysql_fetch_array($a)){ 
 ?>
<div class="serieb"><a href="time.php?id=<?=pegaid($b['Time'])?>"><img height="30" width="30" src="./figuras/times_grandes/<?=pegaid($b['Time'])?>.png" /></a></div>
 <? } $a=mysql_query("select * from Tabela_Campeonato where Serie='C'");
   while($b=mysql_fetch_array($a)){ 
 ?>
<div class="seriec"><a href="time.php?id=<?=pegaid($b['Time'])?>"><img height="30" width="30" src="./figuras/times_grandes/<?=pegaid($b['Time'])?>.png" /></a></div>
<? } ?>
</div>
<div>
<div class="online menu-top1">
	<div class="on">
	<span class="img32"><img width="15" height="15" src="figuras/principal/usuarios_online.png" title="Usuários Online" alt="Usuários Online"  style="position:absolute;"></span>
	<a href="online.php"><span class="fonte_online" style="padding-left:15px;"><?=number_format($usuarios_online,0,',','.')?> online</span></a>
	</div>
</div>
<ul class="menu menu-top">
	<li class="top"><a href="index.php" class="top_link"><span>Principal</span></a></li>
	<li class="top"><a href="#" class="top_link"><span>Torneios</span></a>
		<ul class="sub">
			<li><a href="brasileirao.php">Brasileirão</a></li>
			<li><a href="copa_brasil.php">Copa Brasil</a></li>
            <li><a href="copa_cg.php">Copa CG</a></li>
            <li><a href="copadomundo.php">copa libertadores</a></li>
			<li><a href="amistosos.php">Amistosos</a></li>
		</ul>
	</li>
	<li class="top"><a href="#" class="top_link"><span>O Jogo</span></a>
		<ul class="sub">
			<li><a href="premios.php">Prêmios</a></li>
			<li><a href="niveis.php">Níveis</a></li>
			<li><a href="desafios_completo.php">Desafios</a></li>
			<li><a href="equipe.php">Equipe</a></li>
		</ul>
	</li>
	<li class="top"><a href="ranking.php" class="top_link"><span>Rankings</span></a>
		<ul class="sub">
			<li><a href="ranking_hora.php">Hora</a></li>
			<li><a href="ranking_rodada.php">Rodada</a></li>
			<li><a href="ranking_temporada.php">Temporada</a></li>
			<li><a href="ranking_total.php">Total</a></li>
            <li><a href="time_titulos.php">times</a></li>
			<li><a href="ranking_dinheiro.php">Dinheiro</a></li>
			<li><a href="ranking_convidados.php">Convidados</a></li>
			<li><a href="ranking.php">Outros</a></li>
		</ul>
	</li>
	<li class="top"><a href="selecao.php" class="top_link"><span>Seleção</span></a></li>
<?php if ($_COOKIE["usuarioid"]) { ?>
	<li class="top"><a href="inicio.php" class="top_link"><span>conta</span></a>
		<ul class="sub">
			<li><a href="inicio.php">Início</a></li>
			<li><a href="alterar_dados.php">Alterar Dados</a></li>
			<li><a href="itens.php">Meus Ítens</a></li>
            <li><a href="personalizar.php">mudar aparência</a></li>
			<li><a href="itens_comprar.php">Comprar Ítens</a></li>
			<li><a href="novidades.php">Novidades</a></li>
			<li><a href="logout.php">Sair da Conta</a></li>
		</ul>
	</li>
  <li class="top"><a href="tarefas.php" class="top_link"><span>Tarefas</span></a>	</li>
<?php } ?>
</ul>
</div>
