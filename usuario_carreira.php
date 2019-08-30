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
$p = anti_inj($_GET['p']);

if (!$id) {
	header("Location: index.php"); break;
}

if (ereg('[^0-9]',$id)) {
	header("Location: index.php"); break;
}

if (ereg('[^0-9]',$p)) {
	header("Location: index.php"); break;
}

if (!$p) {
	$p = 1;
}

$limite = 20;
$inicio = $p - 1;
$inicio = $limite * $inicio;

$query = mysql_query("SELECT Count(ID) AS carreira_quantidade FROM Carreira WHERE Usuario = '". $id ."'");
$rs = mysql_fetch_array($query);

$carreira_quantidade = $rs["carreira_quantidade"];

$p_total = ceil($carreira_quantidade / $limite);

if ($p_total < 1) {
	$p_total = 1;
}

if ($p > $p_total) {
	header("Location: usuario_carreira.php?id=". $id ."&p=1"); break;
}

if ($p == 1) {

$query = mysql_query("SELECT Temporada FROM Configuracoes");
$rs = mysql_fetch_array($query);

$temporada_atual = $rs["Temporada"];

}

$query = mysql_query("SELECT Usuarios.ID as Usuario_ID, Usuarios.Usuario as Usuario_Nome, Usuarios.Nivel as Usuario_Nivel, Usuarios.Gols_Time as Usuario_Gols_Time, Usuarios.Gols_Total as Usuario_Gols_Total, Usuarios.VIP as Usuario_VIP, Usuarios.VIP_Cor as Usuario_VIP_Cor, Times.ID as Time_ID, Times.Time as Time_Nome FROM Usuarios INNER JOIN Times ON Times.ID = Usuarios.Time WHERE Usuarios.ID = '". $id ."'");
$rs = mysql_fetch_array($query);

$usuario_id = $rs["Usuario_ID"];
$usuario_nome = $rs["Usuario_Nome"];
$usuario_time_id = $rs["Time_ID"];
$usuario_time_nome = $rs["Time_Nome"];
$usuario_nivel = $rs["Usuario_Nivel"];
$usuario_gols_time = $rs["Usuario_Gols_Time"];
$usuario_gols_total = $rs["Usuario_Gols_Total"];
$usuario_vip = $rs["Usuario_VIP"];
$usuario_vip_cor = $rs["Usuario_VIP_Cor"];

ob_end_flush();
?>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Sobre o Usuário</h1></div></div></div>
	<div class="conteudo">

<div id="linha10"><span class="img25"><img width="25" height="25" src="figuras/niveis/<?=$usuario_nivel?>.png" title="<?=$usuario_nivel?>" alt="<?=$usuario_nivel?>"></span> <span class="img20"><a href="time.php?id=<?=$usuario_time_id?>"><img width="20" height="20" src="figuras/times_pequenos/<?=$usuario_time_id?>.png" title="<?=$usuario_time_nome?>" alt="<?=$usuario_time_nome?>" border="0"></a></span> <a href="usuario.php?id=<?=$id?>"><?php if ($usuario_vip > 0) { ?><span id="usuario_vip<?=$usuario_vip_cor?>"><?=$usuario_nome?></span><?php } else { ?><span id="usuario_normal"><?=$usuario_nome?></span><?php } ?></a> <span class="align5">(<?=number_format($usuario_gols_total,0,',','.')?> <?php if ($usuario_gols_total == 1) { ?> gol<?php } else { ?> gols<?php } ?>)</span></div>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/trocas.png" title="Trocas de Time" alt="Trocas de Time"></span> <b>Trocas de Time:</b> <?=number_format($carreira_quantidade,0,',','.')?></div>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<div id="divide"></div>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Carreira</h1></div></div></div>
	<div class="conteudo">

<div id="linha10">
<table width="550" cellpadding="0" cellspacing="0">
	<tr height="25" bgcolor="#B6B6B6">
		<td width="30">&nbsp;</td>
        <td width="200" class="fonte1_negrito">Time</td>
		<td width="150" class="fonte1_negrito">Gols</td>
		<td width="170" class="fonte1_negrito">Temporada</td>
	</tr>

<?php if ($p == 1) { ?>
	<tr>
		<td style="padding-top: 10px"><span class="img16"><?php if ($carreira_quantidade == 0) { ?><img width="16" height="16" src="figuras/principal/casa_azul.png" title="Primeiro" alt="Primeiro"><?php } else { ?><img width="16" height="16" src="figuras/principal/quadrado_azul.png" title="Atual" alt="Atual"><?php } ?></span></td>
        <td style="padding-top: 10px"><span class="img20"><a href="time.php?id=<?=$usuario_time_id?>"><img width="20" height="20" src="figuras/times_pequenos/<?=$usuario_time_id?>.png" title="<?=$usuario_time_nome?>" alt="<?=$usuario_time_nome?>" border="0"></a></span> <a href="time.php?id=<?=$usuario_time_id?>"><?=$usuario_time_nome?></a></td>
		<td style="padding-top: 10px"><?=number_format($usuario_gols_time,0,',','.')?></td>
		<td style="padding-top: 10px"><?=number_format($temporada_atual,0,',','.')?></td>
	</tr>
<?php } ?>

<?php if ($carreira_quantidade > 0) { ?>

<?php

$query_wl = 0;

$query = mysql_query("SELECT Times.ID as Time_ID, Times.Time as Time_Nome, Carreira.Gols as Usuario_Gols, Carreira.Temporada as Usuario_Temporada FROM Carreira INNER JOIN Times ON Carreira.Time = Times.ID WHERE Carreira.Usuario = '". $usuario_id ."' ORDER BY Carreira.ID DESC LIMIT $inicio,$limite");

?>

<?php while ($rs = mysql_fetch_array($query)) { ?>

<?php $query_wl = $query_wl + 1; ?>

	<tr>
		<td style="padding-top: 10px"><span class="img16"><?php if ($query_wl == $carreira_quantidade) { ?><img width="16" height="16" src="figuras/principal/casa_azul.png" title="Primeiro" alt="Primeiro"><?php } else { ?><img width="16" height="16" src="figuras/principal/seta_carreira.png" title="Saiu" alt="Saiu"><?php } ?></span></td>
		<td style="padding-top: 10px"><span class="img20"><a href="time.php?id=<?=$rs["Time_ID"]?>"><img width="20" height="20" src="figuras/times_pequenos/<?=$rs["Time_ID"]?>.png" title="<?=$rs["Time_Nome"]?>" alt="<?=$rs["Time_Nome"]?>" border="0"></a></span> <a href="time.php?id=<?=$rs["Time_ID"]?>"><?=$rs["Time_Nome"]?></a></td>
		<td style="padding-top: 10px"><?=number_format($rs["Usuario_Gols"],0,',','.')?></td>
		<td style="padding-top: 10px"><?=number_format($rs["Usuario_Temporada"],0,',','.')?></td>
	</tr>

<?php } ?>

<?php } ?>

</table>
</div>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<?php
if ($carreira_quantidade > $limite) {
	$p_nome = "usuario_carreira";
	$p_id = $id;
	include("paginacao2.php");
}
?>


<!-- FIM DA PÁGINA -->
</div>
<div class="clear"></div>

</div>
<div id="baixo"><?php include("baixo.php") ?></div>
</div>
</body>
</html>