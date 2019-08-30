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

$query = mysql_query("SELECT ID2, Time, Estado, Estadio, Capacidade, Reputacao, Gols, Texto, Campeonato_FC_Titulos, Campeonato_FC_Vices, Copa_Brasil_Titulos, Copa_Brasil_Vices, Copa_FC_Titulos, Copa_FC_Vices, Presidente, Diretor,  Olheiro_1, Olheiro_2, Olheiro_3, Pontos, Jogos, Vitorias, Empates, Derrotas FROM Times WHERE ID = '". $id ."'");
$rs = mysql_fetch_array($query);

$time_id2 = $rs["ID2"];
$time_nome = $rs["Time"];
$estado = $rs["Estado"];
$estadio = $rs["Estadio"];
$capacidade = $rs["Capacidade"];
$reputacao = $rs["Reputacao"];
$gols = $rs["Gols"];
$texto = $rs["Texto"];
$campeonato_fc_titulos = $rs["Campeonato_FC_Titulos"];
$campeonato_fc_vices = $rs["Campeonato_FC_Vices"];
$copa_brasil_titulos = $rs["Copa_Brasil_Titulos"];
$copa_brasil_vices = $rs["Copa_Brasil_Vices"];
$copa_fc_titulos = $rs["Copa_FC_Titulos"];
$copa_fc_vices = $rs["Copa_FC_Vices"];
$presidente = $rs["Presidente"];
$diretor = $rs["Diretor"];
$olheiro_1 = $rs["Olheiro_1"];
$olheiro_2 = $rs["Olheiro_2"];
$olheiro_3 = $rs["Olheiro_3"];
$pontos = $rs["Pontos"];
$jogos = $rs["Jogos"];
$vitorias = $rs["Vitorias"];
$empates = $rs["Empates"];
$derrotas = $rs["Derrotas"];


$r=mysql_fetch_array(mysql_query("select Serie From  Tabela_Campeonato where Time = {$time_id2}"));

if ($r['Serie'] == 'A') {
	$grupo = 1;
} else if ($r['Serie'] == 'B') {
	$grupo = 2;
} else if ($r['Serie'] == 'C') {
	$grupo = 3;
}

if ($presidente != 0) {

$query = mysql_query("SELECT Usuario, VIP, VIP_Cor FROM Usuarios WHERE ID = '". $presidente ."'");
$rs = mysql_fetch_array($query);

$presidente_nome = $rs["Usuario"];
$presidente_vip = $rs["VIP"];
$presidente_vip_cor = $rs["VIP_Cor"];

}

if ($diretor != 0) {

$query = mysql_query("SELECT Usuario, VIP, VIP_Cor FROM Usuarios WHERE ID = '". $diretor ."'");
$rs = mysql_fetch_array($query);

$diretor_nome = $rs["Usuario"];
$diretor_vip = $rs["VIP"];
$diretor_vip_cor = $rs["VIP_Cor"];

}

if ($olheiro_1 != 0) {

$query = mysql_query("SELECT Usuario, VIP, VIP_Cor FROM Usuarios WHERE ID = '". $olheiro_1 ."'");
$rs = mysql_fetch_array($query);

$olheiro_1_nome = $rs["Usuario"];
$olheiro_1_vip = $rs["VIP"];
$olheiro_1_vip_cor = $rs["VIP_Cor"];

}

if ($olheiro_2 != 0) {

$query = mysql_query("SELECT Usuario, VIP, VIP_Cor FROM Usuarios WHERE ID = '". $olheiro_2 ."'");
$rs = mysql_fetch_array($query);

$olheiro_2_nome = $rs["Usuario"];
$olheiro_2_vip = $rs["VIP"];
$olheiro_2_vip_cor = $rs["VIP_Cor"];

}

if ($olheiro_3 != 0) {

$query = mysql_query("SELECT Usuario, VIP, VIP_Cor FROM Usuarios WHERE ID = '". $olheiro_3 ."'");
$rs = mysql_fetch_array($query);

$olheiro_3_nome = $rs["Usuario"];
$olheiro_3_vip = $rs["VIP"];
$olheiro_3_vip_cor = $rs["VIP_Cor"];

}

$query = mysql_query("SELECT Count(ID) AS usuarios_quantidade FROM Usuarios WHERE Time = '". $id ."' AND Confirmar = '0'");
$rs = mysql_fetch_array($query);

$usuarios_quantidade = $rs["usuarios_quantidade"];

$query = mysql_query("SELECT Count(ID) AS usuarios_vip_quantidade FROM Usuarios WHERE Time = '". $id ."' AND Confirmar = '0' AND VIP_Tempo > '".time()."'");
$rs = mysql_fetch_array($query);

$usuarios_vip_quantidade = $rs["usuarios_vip_quantidade"];

$query = mysql_query("SELECT Count(ID) AS usuarios_online_quantidade FROM Usuarios WHERE Time = '". $id ."' AND Status = 1");
$rs = mysql_fetch_array($query);

$usuarios_online_quantidade = $rs["usuarios_online_quantidade"];

$query = mysql_query("SELECT Count(ID) AS usuarios_online_vip_quantidade FROM Usuarios WHERE Time = '". $id ."' AND Status = 1 AND VIP_Tempo > '".time()."'");
$rs = mysql_fetch_array($query);

$usuarios_online_vip_quantidade = $rs["usuarios_online_vip_quantidade"];

$query = mysql_query("SELECT Count(ID) AS usuarios_secando_quantidade FROM Usuarios WHERE Secar = '". $id ."'");
$rs = mysql_fetch_array($query);

$usuarios_secando_quantidade = $rs["usuarios_secando_quantidade"];

$query = mysql_query("SELECT Count(ID) AS usuarios_secando_veneno_quantidade FROM Usuarios WHERE Secar = '". $id ."' AND Veneno = 1");
$rs = mysql_fetch_array($query);

$usuarios_secando_veneno_quantidade = $rs["usuarios_secando_veneno_quantidade"];

$query = mysql_query("SELECT ID, Usuario, Nivel, Gols_Rodada, VIP, VIP_Cor FROM Usuarios WHERE Gols_Rodada > 0 AND Time = '". $id ."' ORDER BY Gols_Rodada DESC LIMIT 1");
$rs = mysql_fetch_array($query);

if ($rs) {
	$artilheiro = $rs["ID"];
	$artilheiro_nome = $rs["Usuario"];
	$artilheiro_nivel = $rs["Nivel"];
	$artilheiro_gols_rodada = $rs["Gols_Rodada"];
	$artilheiro_vip = $rs["VIP"];
	$artilheiro_vip_cor = $rs["VIP_Cor"];
} else {
	$artilheiro = 0;
}

$medalha = 0;
$query = mysql_query("SELECT ID FROM Usuarios WHERE Gols_Hora > 0 ORDER BY Gols_Hora DESC LIMIT 3");

while ($rs = mysql_fetch_array($query)) {

$medalha = $medalha + 1;

if ($medalha == 1) {
	$medalha_1 = $rs["ID"];
} else if ($medalha == 2) {
	$medalha_2 = $rs["ID"];
} else if ($medalha == 3) {
	$medalha_3 = $rs["ID"];
}

}

ob_end_flush();
?>

<div id="principal_metade">

<div id="principal_metade_esquerda">

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1><?=$time_nome?></h1></div></div></div>
	<div class="conteudo">

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/brasil.png"></span> <b>Estado:</b> <?=$estado?></div>
<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/gols.png"></span> <b>Gols:</b> <?=number_format($gols,0,',','.')?></div>
<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/estadio.png"></span> <b>Estádio:</b> <?=$estadio?> <span class="align5">(<?=number_format($capacidade,0,',','.')?>)</span></div>
<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/chuteira.png"></span> <b>Jogadores:</b> <?=number_format($usuarios_quantidade,0,',','.')?> <span class="align5">(<?=number_format($usuarios_vip_quantidade,0,',','.')?> com VIP)</span></div>
<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/online.png"></span> <b>Online:</b> <?=number_format($usuarios_online_quantidade,0,',','.')?> <span class="align5">(<?=number_format($usuarios_online_vip_quantidade,0,',','.')?> com VIP)</span></div>
<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/secando.png"></span> <b>Secando:</b> <?=number_format($usuarios_secando_quantidade,0,',','.')?> <span class="align5">(<?=number_format($usuarios_secando_veneno_quantidade,0,',','.')?> com Veneno)</span></div>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<div id="divide"></div>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Menu do Time</h1></div></div></div>
	<div class="conteudo">

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/seta1.png"></span> <a href="rodada.php?id=<?=$id?>"><b>Rodada</b></a> <span class="img16"><img width="16" height="16" src="figuras/principal/seta1.png"></span> <a href="time_online.php?id=<?=$id?>"><b>Usuários Online</b></a> </div>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/seta1.png"></span> <a href="campeonato_fc_classificacao.php?id=<?=$grupo?>"><b>Classificação</b></a> <span class="img16"><img width="16" height="16" src="figuras/principal/seta1.png"></span> <a href="campeonato_fc_jogos.php?id=<?=$grupo?>"><b>Jogos</b></a></div>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/seta1.png"></span> <a href="time_secando.php?id=<?=$id?>"><b>Usuários Secando</b></a>

<?php if ($_COOKIE["usuarioid"]) { ?>

<span class="img16"><img width="16" height="16" src="figuras/principal/seta1.png"></span> <a href="time_doar_dinheiro.php?id=<?=$id?>"><b>Doar Dinheiro</b></a>

<?php } ?>

</div>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<div id="divide"></div>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Cúpula</h1></div></div></div>
	<div class="conteudo">

<?php if ($presidente != 0) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/presidente.png" title="Presidente" alt="Presidente"></span> <a href="usuario.php?id=<?=$presidente?>"><?php if ($presidente_vip > 0) { ?><span id="usuario_vip<?=$presidente_vip_cor?>"><?=$presidente_nome?></span><?php } else { ?><span id="usuario_normal"><?=$presidente_nome?></span><?php } ?></a> <?php if ($presidente == $medalha_1) { ?><span class="medalha"><img width="16" height="16" src="figuras/principal/medalha1.png" title="Top 1 da Hora" alt="Top 1 da Hora"></span><?php } else if ($presidente == $medalha_2) { ?><span class="medalha"><img width="16" height="16" src="figuras/principal/medalha2.png" title="Top 2 da Hora" alt="Top 2 da Hora"></span><?php } else if ($presidente == $medalha_3) { ?><span class="medalha"><img width="16" height="16" src="figuras/principal/medalha3.png" title="Top 3 da Hora" alt="Top 3 da Hora"></span><?php } ?></div>


<?php if ($diretor != 0) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/diretor.png" title="Diretor" alt="Diretor"></span> <a href="usuario.php?id=<?=$diretor?>"><?php if ($diretor_vip > 0) { ?><span id="usuario_vip<?=$diretor_vip_cor?>"><?=$diretor_nome?></span><?php } else { ?><span id="usuario_normal"><?=$diretor_nome?></span><?php } ?></a> <?php if ($diretor == $medalha_1) { ?><span class="medalha"><img width="16" height="16" src="figuras/principal/medalha1.png" title="Top 1 da Hora" alt="Top 1 da Hora"></span><?php } else if ($diretor == $medalha_2) { ?><span class="medalha"><img width="16" height="16" src="figuras/principal/medalha2.png" title="Top 2 da Hora" alt="Top 2 da Hora"></span><?php } else if ($diretor == $medalha_3) { ?><span class="medalha"><img width="16" height="16" src="figuras/principal/medalha3.png" title="Top 3 da Hora" alt="Top 3 da Hora"></span><?php } ?></div>

<?php } ?>

<?php if ($olheiro_1 != 0) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/olheiro.png" title="Olheiro" alt="Olheiro"></span> <a href="usuario.php?id=<?=$olheiro_1?>"><?php if ($olheiro_1_vip > 0) { ?><span id="usuario_vip<?=$olheiro_1_vip_cor?>"><?=$olheiro_1_nome?></span><?php } else { ?><span id="usuario_normal"><?=$olheiro_1_nome?></span><?php } ?></a> <?php if ($olheiro_1 == $medalha_1) { ?><span class="medalha"><img width="16" height="16" src="figuras/principal/medalha1.png" title="Top 1 da Hora" alt="Top 1 da Hora"></span><?php } else if ($olheiro_1 == $medalha_2) { ?><span class="medalha"><img width="16" height="16" src="figuras/principal/medalha2.png" title="Top 2 da Hora" alt="Top 2 da Hora"></span><?php } else if ($olheiro_1 == $medalha_3) { ?><span class="medalha"><img width="16" height="16" src="figuras/principal/medalha3.png" title="Top 3 da Hora" alt="Top 3 da Hora"></span><?php } ?></div>

<?php } ?>

<?php if ($olheiro_2 != 0) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/olheiro.png" title="Olheiro" alt="Olheiro"></span> <a href="usuario.php?id=<?=$olheiro_2?>"><?php if ($olheiro_2_vip > 0) { ?><span id="usuario_vip<?=$olheiro_2_vip_cor?>"><?=$olheiro_2_nome?></span><?php } else { ?><span id="usuario_normal"><?=$olheiro_2_nome?></span><?php } ?></a> <?php if ($olheiro_2 == $medalha_1) { ?><span class="medalha"><img width="16" height="16" src="figuras/principal/medalha1.png" title="Top 1 da Hora" alt="Top 1 da Hora"></span><?php } else if ($olheiro_2 == $medalha_2) { ?><span class="medalha"><img width="16" height="16" src="figuras/principal/medalha2.png" title="Top 2 da Hora" alt="Top 2 da Hora"></span><?php } else if ($olheiro_2 == $medalha_3) { ?><span class="medalha"><img width="16" height="16" src="figuras/principal/medalha3.png" title="Top 3 da Hora" alt="Top 3 da Hora"></span><?php } ?></div>

<?php } ?>

<?php if ($olheiro_3 != 0) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/olheiro.png" title="Olheiro" alt="Olheiro"></span> <a href="usuario.php?id=<?=$olheiro_3?>"><?php if ($olheiro_3_vip > 0) { ?><span id="usuario_vip<?=$olheiro_3_vip_cor?>"><?=$olheiro_3_nome?></span><?php } else { ?><span id="usuario_normal"><?=$olheiro_3_nome?></span><?php } ?></a> <?php if ($olheiro_3 == $medalha_1) { ?><span class="medalha"><img width="16" height="16" src="figuras/principal/medalha1.png" title="Top 1 da Hora" alt="Top 1 da Hora"></span><?php } else if ($olheiro_3 == $medalha_2) { ?><span class="medalha"><img width="16" height="16" src="figuras/principal/medalha2.png" title="Top 2 da Hora" alt="Top 2 da Hora"></span><?php } else if ($olheiro_3 == $medalha_3) { ?><span class="medalha"><img width="16" height="16" src="figuras/principal/medalha3.png" title="Top 3 da Hora" alt="Top 3 da Hora"></span><?php } ?></div>

<?php } ?>

<?php } else { ?>

<?php if ($_COOKIE["usuarioid"]) { ?>

<div id="linha10" style="text-align: center"><a href="time_assumir.php?id=<?=$id?>"><img src="figuras/principal/botao_virar_presidente.png" title="Virar Presidente" alt="Virar Presidente" border="0"></a></div>

<?php } else { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Time sem Presidente no momento.</div>

<?php } ?>

<?php } ?>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

</div>
<div id="principal_metade_direita">

<div class="box_branco">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"></div></div></div>
	<div class="conteudo">

<table width="280" cellpadding="0" cellspacing="0">
	<tr>
    	<td width="150" style="text-align: center" rowspan="4"><a href="rodada.php?id=<?=$id?>"><img src="figuras/times_grandes/<?=$id?>.png" border="0"></a></td>
	</tr>
	<tr>
		<td width="130" height="34"><a href="#" class="balao_time"><img src="figuras/principal/campeonato_fc.png"><span class="balao" style="width: 110px">Campeonato FC</span></a> <a href="#" class="balao_time"><img src="figuras/titulos/<?=$campeonato_fc_titulos?>.png"><span class="balao" style="width: 43px">Títulos</span></a> <a href="#" class="balao_time"><img src="figuras/vices/<?=$campeonato_fc_vices?>.png"><span class="balao" style="width: 32px">Vices</span></a></td>
	</tr>
	<tr>
        <td width="130" height="33"><a href="#" class="balao_time"><img src="figuras/principal/copa_brasil.png"><span class="balao" style="width: 110px">Copa Brasil</span></a> <a href="#" class="balao_time"><img src="figuras/titulos/<?=$copa_brasil_titulos?>.png"><span class="balao" style="width: 43px">Títulos</span></a> <a href="#" class="balao_time"><img src="figuras/vices/<?=$copa_brasil_vices?>.png"><span class="balao" style="width: 32px">Vices</span></a></td>
	</tr>
	<tr>
        <td width="130" height="33"><a href="#" class="balao_time"><img src="figuras/principal/copa_fc.png"><span class="balao" style="width: 110px">Copa FC</span></a> <a href="#" class="balao_time"><img src="figuras/titulos/<?=$copa_fc_titulos?>.png"><span class="balao" style="width: 43px">Títulos</span></a> <a href="#" class="balao_time"><img src="figuras/vices/<?=$copa_fc_vices?>.png"><span class="balao" style="width: 32px">Vices</span></a></td>
	</tr>
</table>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<div id="divide"></div>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Estatísticas</h1></div></div></div>
	<div class="conteudo">

<div id="linha10"><b>Reputação:</b> <?=number_format($reputacao,0,',','.')?></div>
<div id="linha10"></div>
</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<div id="divide"></div>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Melhor da Rodada</h1></div></div></div>
	<div class="conteudo">

<?php if ($artilheiro != 0) { ?>

<div id="linha10"><span class="img25"><img width="25" height="25" src="figuras/niveis/<?=$artilheiro_nivel?>.png" title="<?=$artilheiro_nivel?>" alt="<?=$artilheiro_nivel?>"></span> <a href="usuario.php?id=<?=$artilheiro?>"><?php if ($artilheiro_vip > 0) { ?><span id="usuario_vip<?=$artilheiro_vip_cor?>"><?=$artilheiro_nome?></span><?php } else { ?><span id="usuario_normal"><?=$artilheiro_nome?></span><?php } ?></a> <?php if ($artilheiro == $medalha_1) { ?><span class="medalha"><img width="16" height="16" src="figuras/principal/medalha1.png" title="Top 1 da Hora" alt="Top 1 da Hora"></span><?php } else if ($artilheiro == $medalha_2) { ?><span class="medalha"><img width="16" height="16" src="figuras/principal/medalha2.png" title="Top 2 da Hora" alt="Top 2 da Hora"></span><?php } else if ($artilheiro == $medalha_3) { ?><span class="medalha"><img width="16" height="16" src="figuras/principal/medalha3.png" title="Top 3 da Hora" alt="Top 3 da Hora"></span><?php } ?> <span class="gols_rodada"><?=number_format($artilheiro_gols_rodada,0,',','.')?></span></div>

<?php } else { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Nenhum marcador encontrado.</div>

<?php } ?>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<?php if ($texto) { ?>

<div id="divide"></div>

<div class="box_branco">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"></div></div></div>
	<div class="conteudo">

<?=$texto?>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<?php } ?>

</div>

</div>


<!-- FIM DA PÁGINA -->
</div>
<div class="clear"></div>

</div>
<div id="baixo"><?php include("baixo.php") ?></div>
</div>
</body>
</html>