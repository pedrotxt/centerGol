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
$p = anti_inj($_GET['p']);

if (ereg('[^0-9]',$p)) {
	header("Location: index.php"); break;
}

if (!$p) {
	$p = 1;
}

$limite = 20;
$inicio = $p - 1;
$inicio = $limite * $inicio;

$query = mysql_query("SELECT Count(ID) AS desafios_quantidade FROM Desafios_Resultados");
$rs = mysql_fetch_array($query);

$desafios_quantidade = $rs["desafios_quantidade"];

$p_total = ceil($desafios_quantidade / $limite);

if ($p_total < 1) {
	$p_total = 1;
}

if ($p > $p_total) {
	header("Location: desafios_completo.php?p=1"); break;
}

ob_end_flush();
?>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Desafios (<?=number_format($desafios_quantidade,0,',','.')?>)</h1></div></div></div>
	<div class="conteudo" style="padding-top: 4px">

<?php if ($desafios_quantidade > 0) { ?>

<?php

$query = mysql_query("SELECT Times.Time as Usuario1_Time_Nome, Usuarios.Time as Usuario1_Time_ID, Usuarios.ID as Usuario1_ID, Usuarios.Usuario as Usuario1_Nome, Usuarios.Nivel as Usuario1_Nivel, Usuarios.VIP as Usuario1_VIP, Usuarios.VIP_Cor as Usuario1_VIP_Cor, Usuarios.Gols_Total as Usuario1_Gols_Total, Desafios_Resultados.ID as Desafio_ID, Desafios_Resultados.Usuario_2 as Usuario2_ID, Desafios_Resultados.Placar_1 as Placar_1, Desafios_Resultados.Placar_2 as Placar_2, Desafios_Resultados.Aposta as Aposta FROM Desafios_Resultados INNER JOIN Usuarios ON Usuarios.ID = Desafios_Resultados.Usuario_1 INNER JOIN Times ON Times.ID = Usuarios.Time ORDER BY Desafios_Resultados.ID DESC LIMIT $inicio,$limite");

?>

<?php while ($rs = mysql_fetch_array($query)) { ?>

<?php

$query2 = mysql_query("SELECT Times.Time as Usuario2_Time_Nome, Usuarios.Time as Usuario2_Time_ID, Usuarios.Usuario as Usuario2_Nome, Usuarios.Nivel as Usuario2_Nivel, Usuarios.VIP as Usuario2_VIP, Usuarios.VIP_Cor as Usuario2_VIP_Cor, Usuarios.Gols_Total as Usuario2_Gols_Total FROM Usuarios INNER JOIN Times ON Times.ID = Usuarios.Time WHERE Usuarios.ID = '". $rs["Usuario2_ID"] ."'");
$rs2 = mysql_fetch_array($query2);

$usuario2_time_nome = $rs2["Usuario2_Time_Nome"];
$usuario2_time_id = $rs2["Usuario2_Time_ID"];
$usuario2_nome = $rs2["Usuario2_Nome"];
$usuario2_nivel = $rs2["Usuario2_Nivel"];
$usuario2_vip = $rs2["Usuario2_VIP"];
$usuario2_vip_cor = $rs2["Usuario2_VIP_Cor"];
$usuario2_gols_total = $rs2["Usuario2_Gols_Total"];

?>

<div id="linha6">

<table width="550" cellpadding="0" cellspacing="0">
	<tr>
		<td width="32"><img width="25" height="25" src="figuras/niveis/<?=$rs["Usuario1_Nivel"]?>.png" title="<?=$rs["Usuario1_Nivel"]?>" alt="<?=$rs["Usuario1_Nivel"]?>"></td>
		<td width="25"><a href="time.php?id=<?=$rs["Usuario1_Time_ID"]?>"><img width="20" height="20" src="figuras/times_pequenos/<?=$rs["Usuario1_Time_ID"]?>.png" title="<?=$rs["Usuario1_Time_Nome"]?>" alt="<?=$rs["Usuario1_Time_Nome"]?>" border="0"></a></td>
		<td width="138"><a href="usuario.php?id=<?=$rs["Usuario1_ID"]?>"><?php if ($rs["Usuario1_VIP"] > 0) { ?><span id="usuario_vip<?=$rs["Usuario1_VIP_Cor"]?>"><?=$rs["Usuario1_Nome"]?></span><?php } else { ?><span id="usuario_normal"><?=$rs["Usuario1_Nome"]?></span><?php } ?></a></td>
		<td width="30"><img width="25" height="25" src="figuras/desafio/placar_<?=$rs["Placar_1"]?>.png"></td>
		<td width="30"><a href="desafio_compartilhar.php?id=<?=$rs["Desafio_ID"]?>"><img width="25" height="25" src="figuras/desafio/x.png" border="0"></a></td>
		<td width="30"><img width="25" height="25" src="figuras/desafio/placar_<?=$rs["Placar_2"]?>.png"></td>
		<td width="138" align="right"><a href="usuario.php?id=<?=$rs["Usuario2_ID"]?>"><?php if ($usuario2_vip > 0) { ?><span id="usuario_vip<?=$usuario2_vip_cor?>"><?=$usuario2_nome?></span><?php } else { ?><span id="usuario_normal"><?=$usuario2_nome?></span><?php } ?></a></td>
		<td width="25" align="right"><a href="time.php?id=<?=$usuario2_time_id?>"><img width="20" height="20" src="figuras/times_pequenos/<?=$usuario2_time_id?>.png" title="<?=$usuario2_time_nome?>" alt="<?=$usuario2_time_nome?>" border="0"></a></td>

		<td width="32" align="right"><img width="25" height="25" src="figuras/niveis/<?=$usuario2_nivel?>.png" title="<?=$usuario2_nivel?>" alt="<?=$usuario2_nivel?>"></td>
		<td width="70" style="padding-left: 10px"><span class="img16"><img width="16" height="16" src="figuras/desafio/dinheiro.png" title="Aposta" alt="Aposta"></span> <?=number_format($rs["Aposta"],0,',','.')?></td>
	</tr>
</table>

</div>

<?php } ?>

<?php } else { ?>

<div id="linha6"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Nenhum desafio encontrado.</div>

<?php } ?>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<?php
if ($desafios_quantidade > $limite) {
	$p_nome = "desafios_completo";
	include("paginacao1.php");
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