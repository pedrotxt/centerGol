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

$query = mysql_query("SELECT Usuarios.Usuario as Usuario_Nome, Usuarios.Nivel as Usuario_Nivel, Usuarios.Conquistas as Usuario_Conquistas, Usuarios.Gols_Total as Usuario_Gols_Total, Usuarios.VIP as Usuario_VIP, Usuarios.VIP_Cor as Usuario_VIP_Cor, Times.ID as Time_ID, Times.Time as Time_Nome, Usuarios.TH_1 as Usuario_TH_1, Usuarios.TH_2 as Usuario_TH_2, Usuarios.TH_3 as Usuario_TH_3, Usuarios.TH_4 as Usuario_TH_4, Usuarios.TH_5 as Usuario_TH_5, Usuarios.TH_6 as Usuario_TH_6, Usuarios.TH_7 as Usuario_TH_7, Usuarios.TH_8 as Usuario_TH_8, Usuarios.TH_9 as Usuario_TH_9, Usuarios.TH_10 as Usuario_TH_10, Usuarios.TR_1 as Usuario_TR_1, Usuarios.TR_2 as Usuario_TR_2, Usuarios.TR_3 as Usuario_TR_3, Usuarios.TR_4 as Usuario_TR_4, Usuarios.TR_5 as Usuario_TR_5, Usuarios.TR_6 as Usuario_TR_6, Usuarios.TR_7 as Usuario_TR_7, Usuarios.TR_8 as Usuario_TR_8, Usuarios.TR_9 as Usuario_TR_9, Usuarios.TR_10 as Usuario_TR_10, Usuarios.TT_1 as Usuario_TT_1, Usuarios.TT_2 as Usuario_TT_2, Usuarios.TT_3 as Usuario_TT_3, Usuarios.TT_4 as Usuario_TT_4, Usuarios.TT_5 as Usuario_TT_5, Usuarios.TT_6 as Usuario_TT_6, Usuarios.TT_7 as Usuario_TT_7, Usuarios.TT_8 as Usuario_TT_8, Usuarios.TT_9 as Usuario_TT_9, Usuarios.TT_10 as Usuario_TT_10, Usuarios.Campeonato_FC_Titulos as Usuario_Campeonato_FC_Titulos, Usuarios.Copa_Brasil_Titulos as Usuario_Copa_Brasil_Titulos, Usuarios.Copa_FC_Titulos as Usuario_Copa_FC_Titulos, Usuarios.TSorteio as Usuario_TSorteio, Usuarios.TConvidados as Usuario_TConvidados FROM Usuarios INNER JOIN Times ON Times.ID = Usuarios.Time WHERE Usuarios.ID = '". $id ."'");
$rs = mysql_fetch_array($query);

if (!$rs) {
	header("Location: index.php"); break;
}

$usuario_nome = $rs["Usuario_Nome"];
$usuario_time_id = $rs["Time_ID"];
$usuario_time_nome = $rs["Time_Nome"];
$usuario_nivel = $rs["Usuario_Nivel"];
$usuario_conquistas = $rs["Usuario_Conquistas"];
$usuario_gols_total = $rs["Usuario_Gols_Total"];
$usuario_vip = $rs["Usuario_VIP"];
$usuario_vip_cor = $rs["Usuario_VIP_Cor"];
$usuario_th_1 = $rs["Usuario_TH_1"];
$usuario_th_2 = $rs["Usuario_TH_2"];
$usuario_th_3 = $rs["Usuario_TH_3"];
$usuario_th_4 = $rs["Usuario_TH_4"];
$usuario_th_5 = $rs["Usuario_TH_5"];
$usuario_th_6 = $rs["Usuario_TH_6"];
$usuario_th_7 = $rs["Usuario_TH_7"];
$usuario_th_8 = $rs["Usuario_TH_8"];
$usuario_th_9 = $rs["Usuario_TH_9"];
$usuario_th_10 = $rs["Usuario_TH_10"];
$usuario_tr_1 = $rs["Usuario_TR_1"];
$usuario_tr_2 = $rs["Usuario_TR_2"];
$usuario_tr_3 = $rs["Usuario_TR_3"];
$usuario_tr_4 = $rs["Usuario_TR_4"];
$usuario_tr_5 = $rs["Usuario_TR_5"];
$usuario_tr_6 = $rs["Usuario_TR_6"];
$usuario_tr_7 = $rs["Usuario_TR_7"];
$usuario_tr_8 = $rs["Usuario_TR_8"];
$usuario_tr_9 = $rs["Usuario_TR_9"];
$usuario_tr_10 = $rs["Usuario_TR_10"];
$usuario_tt_1 = $rs["Usuario_TT_1"];
$usuario_tt_2 = $rs["Usuario_TT_2"];
$usuario_tt_3 = $rs["Usuario_TT_3"];
$usuario_tt_4 = $rs["Usuario_TT_4"];
$usuario_tt_5 = $rs["Usuario_TT_5"];
$usuario_tt_6 = $rs["Usuario_TT_6"];
$usuario_tt_7 = $rs["Usuario_TT_7"];
$usuario_tt_8 = $rs["Usuario_TT_8"];
$usuario_tt_9 = $rs["Usuario_TT_9"];
$usuario_tt_10 = $rs["Usuario_TT_10"];
$usuario_campeonato_fc_titulos = $rs["Usuario_Campeonato_FC_Titulos"];
$usuario_copa_brasil_titulos = $rs["Usuario_Copa_Brasil_Titulos"];
$usuario_copa_fc_titulos = $rs["Usuario_Copa_FC_Titulos"];
$usuario_tsorteio = $rs["Usuario_TSorteio"];
$usuario_tconvidados = $rs["Usuario_TConvidados"];

ob_end_flush();
?>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Sobre o Usuário</h1></div></div></div>
	<div class="conteudo">

<div id="linha10"><span class="img25"><img width="25" height="25" src="figuras/niveis/<?=$usuario_nivel?>.png" title="<?=$usuario_nivel?>" alt="<?=$usuario_nivel?>"></span> <span class="img20"><a href="time.php?id=<?=$usuario_time_id?>"><img width="20" height="20" src="figuras/times_pequenos/<?=$usuario_time_id?>.png" title="<?=$usuario_time_nome?>" alt="<?=$usuario_time_nome?>" border="0"></a></span> <a href="usuario.php?id=<?=$id?>"><?php if ($usuario_vip > 0) { ?><span id="usuario_vip<?=$usuario_vip_cor?>"><?=$usuario_nome?></span><?php } else { ?><span id="usuario_normal"><?=$usuario_nome?></span><?php } ?></a> <span class="align5">(<?=number_format($usuario_gols_total,0,',','.')?> <?php if ($usuario_gols_total == 1) { ?> gol<?php } else { ?> gols<?php } ?>)</span></div>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/conquistas.png" title="Conquistas" alt="Conquistas"></span> <b>Conquistas:</b> <?=number_format($usuario_conquistas,0,',','.')?></div>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<div id="divide"></div>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Vezes Entre os Melhores</h1></div></div></div>
	<div class="conteudo">

<div id="linha10">
<table width="550" cellpadding="0" cellspacing="0">
	<tr height="25" bgcolor="#B6B6B6">
		<td width="183" style="padding-left: 26px" class="fonte1_negrito">Hora</td>
		<td width="183" style="padding-left: 26px" class="fonte1_negrito">Rodada</td>
		<td width="183" style="padding-left: 26px" class="fonte1_negrito">Temporada</td>
	</tr>
	<tr>
		<td style="padding-top: 5px"><span class="img20"><img width="20" height="20" src="figuras/principal/medalha1.png"></span> <?=number_format($usuario_th_1,0,',','.')?></td>
		<td style="padding-top: 5px"><span class="img20"><img width="20" height="20" src="figuras/principal/bola1.png"></span> <?=number_format($usuario_tr_1,0,',','.')?></td>
		<td style="padding-top: 5px"><span class="img20"><img width="20" height="20" src="figuras/principal/trofeu1.png"></span> <?=number_format($usuario_tt_1,0,',','.')?></td>
	</tr>
	<tr>
		<td style="padding-top: 5px"><span class="img20"><img width="20" height="20" src="figuras/principal/medalha2.png"></span> <?=number_format($usuario_th_2,0,',','.')?></td>
		<td style="padding-top: 5px"><span class="img20"><img width="20" height="20" src="figuras/principal/bola2.png"></span> <?=number_format($usuario_tr_2,0,',','.')?></td>
		<td style="padding-top: 5px"><span class="img20"><img width="20" height="20" src="figuras/principal/trofeu2.png"></span> <?=number_format($usuario_tt_2,0,',','.')?></td>
	</tr>
	<tr>
		<td style="padding-top: 5px"><span class="img20"><img width="20" height="20" src="figuras/principal/medalha3.png"></span> <?=number_format($usuario_th_3,0,',','.')?></td>
		<td style="padding-top: 5px"><span class="img20"><img width="20" height="20" src="figuras/principal/bola3.png"></span> <?=number_format($usuario_tr_3,0,',','.')?></td>
		<td style="padding-top: 5px"><span class="img20"><img width="20" height="20" src="figuras/principal/trofeu3.png"></span> <?=number_format($usuario_tt_3,0,',','.')?></td>
	</tr>
	<tr>
		<td style="padding-top: 5px"><span class="img20"><img width="20" height="20" src="figuras/principal/colocacao4.png"></span> <?=number_format($usuario_th_4,0,',','.')?></td>
		<td style="padding-top: 5px"><span class="img20"><img width="20" height="20" src="figuras/principal/colocacao4.png"></span> <?=number_format($usuario_tr_4,0,',','.')?></td>
		<td style="padding-top: 5px"><span class="img20"><img width="20" height="20" src="figuras/principal/colocacao4.png"></span> <?=number_format($usuario_tt_4,0,',','.')?></td>
	</tr>
	<tr>
		<td style="padding-top: 5px"><span class="img20"><img width="20" height="20" src="figuras/principal/colocacao5.png"></span> <?=number_format($usuario_th_5,0,',','.')?></td>
		<td style="padding-top: 5px"><span class="img20"><img width="20" height="20" src="figuras/principal/colocacao5.png"></span> <?=number_format($usuario_tr_5,0,',','.')?></td>
		<td style="padding-top: 5px"><span class="img20"><img width="20" height="20" src="figuras/principal/colocacao5.png"></span> <?=number_format($usuario_tt_5,0,',','.')?></td>
	</tr>
	<tr>
		<td style="padding-top: 5px"><span class="img20"><img width="20" height="20" src="figuras/principal/colocacao6.png"></span> <?=number_format($usuario_th_6,0,',','.')?></td>
		<td style="padding-top: 5px"><span class="img20"><img width="20" height="20" src="figuras/principal/colocacao6.png"></span> <?=number_format($usuario_tr_6,0,',','.')?></td>
		<td style="padding-top: 5px"><span class="img20"><img width="20" height="20" src="figuras/principal/colocacao6.png"></span> <?=number_format($usuario_tt_6,0,',','.')?></td>
	</tr>
	<tr>
		<td style="padding-top: 5px"><span class="img20"><img width="20" height="20" src="figuras/principal/colocacao7.png"></span> <?=number_format($usuario_th_7,0,',','.')?></td>
		<td style="padding-top: 5px"><span class="img20"><img width="20" height="20" src="figuras/principal/colocacao7.png"></span> <?=number_format($usuario_tr_7,0,',','.')?></td>
		<td style="padding-top: 5px"><span class="img20"><img width="20" height="20" src="figuras/principal/colocacao7.png"></span> <?=number_format($usuario_tt_7,0,',','.')?></td>
	</tr>
	<tr>
		<td style="padding-top: 5px"><span class="img20"><img width="20" height="20" src="figuras/principal/colocacao8.png"></span> <?=number_format($usuario_th_8,0,',','.')?></td>
		<td style="padding-top: 5px"><span class="img20"><img width="20" height="20" src="figuras/principal/colocacao8.png"></span> <?=number_format($usuario_tr_8,0,',','.')?></td>
		<td style="padding-top: 5px"><span class="img20"><img width="20" height="20" src="figuras/principal/colocacao8.png"></span> <?=number_format($usuario_tt_8,0,',','.')?></td>
	</tr>
	<tr>
		<td style="padding-top: 5px"><span class="img20"><img width="20" height="20" src="figuras/principal/colocacao9.png"></span> <?=number_format($usuario_th_9,0,',','.')?></td>
		<td style="padding-top: 5px"><span class="img20"><img width="20" height="20" src="figuras/principal/colocacao9.png"></span> <?=number_format($usuario_tr_9,0,',','.')?></td>
		<td style="padding-top: 5px"><span class="img20"><img width="20" height="20" src="figuras/principal/colocacao9.png"></span> <?=number_format($usuario_tt_9,0,',','.')?></td>
	</tr>
	<tr>
		<td style="padding-top: 5px"><span class="img20"><img width="20" height="20" src="figuras/principal/colocacao10.png"></span> <?=number_format($usuario_th_10,0,',','.')?></td>
		<td style="padding-top: 5px"><span class="img20"><img width="20" height="20" src="figuras/principal/colocacao10.png"></span> <?=number_format($usuario_tr_10,0,',','.')?></td>
		<td style="padding-top: 5px"><span class="img20"><img width="20" height="20" src="figuras/principal/colocacao10.png"></span> <?=number_format($usuario_tt_10,0,',','.')?></td>
	</tr>
</table>
</div>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<div id="divide"></div>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Outras Conquistas</h1></div></div></div>
	<div class="conteudo">

<div id="linha10"><b>Campeonato FC:</b> <?=number_format($usuario_campeonato_fc_titulos,0,',','.')?></div>
<div id="linha10"><b>Copa Brasil:</b> <?=number_format($usuario_copa_brasil_titulos,0,',','.')?></div>
<div id="linha10"><b>Copa FC:</b> <?=number_format($usuario_copa_fc_titulos,0,',','.')?></div>
<div id="linha10"><b>Venceu Sorteio:</b> <?=number_format($usuario_tsorteio,0,',','.')?></div>
<div id="linha10"><b>Melhor Divulgador:</b> <?=number_format($usuario_tconvidados,0,',','.')?></div>

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