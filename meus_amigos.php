<?php ob_start(); ?>
<?php include_once("fun_anti_inj.php") ?>
<?php include("verificar_cookie.php") ?>
<?php include("conexao.php") ?>
<?php include("verificar_conexao.php") ?>
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

$limite = 10;
$inicio = $p - 1;
$inicio = $limite * $inicio;

$query = mysql_query("SELECT Count(ID) AS meus_amigos_quantidade FROM Amigos WHERE Amigo = '". $mc_id ."'");
$rs = mysql_fetch_array($query);

$meus_amigos_quantidade = $rs["meus_amigos_quantidade"];

$p_total = ceil($meus_amigos_quantidade / $limite);

if ($p_total < 1) {
	$p_total = 1;
}

if ($p > $p_total) {
	header("Location: amigos.php?p=1"); break;
}

ob_end_flush();
?>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Quem me adicionou? (<?=number_format($meus_amigos_quantidade,0,',','.')?>)</h1></div></div></div>
	<div class="conteudo" style="padding-top: 4px">

<?php if ($meus_amigos_quantidade > 0) { ?>

<div id="linha6">

<table width="550" cellpadding="0" cellspacing="0">

<?php

$query_wl = 0;

$query = mysql_query("SELECT Amigos.Usuario as Usuario_ID, Usuarios.Usuario as Usuario_Nome, Usuarios.Time as Time_ID, Usuarios.VIP as Usuario_VIP, Usuarios.VIP_Cor as Usuario_VIP_Cor, Usuarios.Gols_Total as Usuario_Gols_Total, Usuarios.Status as Usuario_Status, Times.Time as Time_Nome FROM Amigos INNER JOIN Usuarios ON Usuarios.ID = Amigos.Usuario INNER JOIN Times ON Times.ID = Usuarios.Time WHERE Amigos.Amigo = '". $mc_id ."' ORDER BY Amigos.Ultimo_Acesso DESC LIMIT $inicio,$limite");

?>

<?php while ($rs = mysql_fetch_array($query)) { ?>

<?php $query_wl = $query_wl + 1; ?>

<?php if ($query_wl == 1) { ?>
	<tr height="25" bgcolor="#B6B6B6">
		<td width="240" style="padding-left: 47px" class="fonte1_negrito">Usuário</td>
		<td width="235" class="fonte1_negrito">Time</td>
		<td width="75" class="fonte1_negrito">Gols</td>
	</tr>
<?php } ?>

	<tr>
		<td style="padding-top: 10px"><span class="align_radio"><input name="amigos_selecao[]" type="checkbox" value="<?=$rs["Usuario_ID"]?>" id="todos" disabled></span> <span class="img16"><?php if ($rs["Usuario_Status"] == 1) { ?><img width="16" width="16" src="figuras/principal/online.png" title="Online" alt="Online"><?php } else { ?><img width="16" height="16" src="figuras/principal/offline.png" title="Offline" alt="Offline"><?php } ?></span> <a href="usuario.php?id=<?=$rs["Usuario_ID"]?>"><?php if ($rs["Usuario_VIP"] > 0) { ?><span id="usuario_vip<?=$rs["Usuario_VIP_Cor"]?>"><?=$rs["Usuario_Nome"]?></span><?php } else { ?><span id="usuario_normal"><?=$rs["Usuario_Nome"]?></span><?php } ?></a></td>
		<td style="padding-top: 10px"><span class="img20"><a href="time.php?id=<?=$rs["Time_ID"]?>"><img width="20" height="20" src="figuras/times_pequenos/<?=$rs["Time_ID"]?>.png" title="<?=$rs["Time_Nome"]?>" alt="<?=$rs["Time_Nome"]?>" border="0"></a></span> <a href="time.php?id=<?=$rs["Time_ID"]?>"><?=$rs["Time_Nome"]?></a></td>
		<td style="padding-top: 10px"><?=number_format($rs["Usuario_Gols_Total"],0,',','.')?></td>
	</tr>

<?php } ?>

</table>

</div>

<?php } else { ?>

<div id="linha6"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Nenhum usuário encontrado.</div>

<?php } ?>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<?php
if ($meus_amigos_quantidade > $limite) {
	$p_nome = "meus_amigos";
	include("paginacao1.php");
}
?>

<div id="divide"></div>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Amigos</h1></div></div></div>
	<div class="conteudo">

<div id="linha10"><span class="img16"><a href="amigos.php"><img src="figuras/principal/amigos.png" title="Amigos" alt="Amigos" border="0"></a></span> <a href="amigos.php"><b><?=$amigos_quantidade?></b> <?php if ($amigos_quantidade == 1) { ?>usuário<?php } else { ?>usuários<?php } ?> que você adicionou como amigo.</a></div>

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