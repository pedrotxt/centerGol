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

$p_total = ceil($amigos_quantidade / $limite);

if ($p_total < 1) {
	$p_total = 1;
}

if ($p > $p_total) {
	header("Location: amigos.php?p=1"); break;
}

$query = mysql_query("SELECT Count(ID) AS meus_amigos_quantidade FROM Amigos WHERE Amigo = '". $mc_id ."'");
$rs = mysql_fetch_array($query);

$meus_amigos_quantidade = $rs["meus_amigos_quantidade"];

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

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Amigos (<?=$amigos_quantidade?>)</h1></div></div></div>
	<div class="conteudo">

<?php if ($amigos_quantidade > 0) { ?>

<div id="linha10"><?php if ($amigos_quantidade > 1) { ?><a id="cursor" onClick="javascript:check(document.amigos_selecao.todos);"><img src="figuras/principal/botao_selecionar_todos.png" border="0"></a> <?php } ?><input type="image" src="figuras/principal/botao_excluir.png" onClick="javascript:document.amigos_selecao.submit();"></div>

<?php } else { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Nenhum usuário encontrado.</div>

<?php } ?>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<?php if ($amigos_quantidade > 0) { ?>

<div id="divide"></div>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Meus Amigos</h1></div></div></div>
	<div class="conteudo" style="padding-top: 4px">

<div id="linha6">

<form name="amigos_selecao" action="amigos_excluir.php" method="post">
<table width="550" cellpadding="0" cellspacing="0">

<?php

$query_wl = 0;

$query = mysql_query("SELECT Amigos.Amigo as Usuario_ID, Usuarios.Usuario as Usuario_Nome, Usuarios.Time as Time_ID, Usuarios.VIP as Usuario_VIP, Usuarios.VIP_Cor as Usuario_VIP_Cor, Usuarios.Gols_Total as Usuario_Gols_Total, Usuarios.Status as Usuario_Status, Times.Time as Time_Nome FROM Amigos INNER JOIN Usuarios ON Usuarios.ID = Amigos.Amigo INNER JOIN Times ON Times.ID = Usuarios.Time WHERE Amigos.Usuario = '". $mc_id ."' ORDER BY Amigos.Ultimo_Acesso DESC LIMIT $inicio,$limite");

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
		<td style="padding-top: 10px"><span class="align_radio"><input name="amigos_selecao[]" type="checkbox" value="<?=$rs["Usuario_ID"]?>" id="todos"></span> <span class="img16"><?php if ($rs["Usuario_Status"] == 1) { ?><img width="16" width="16" src="figuras/principal/online.png" title="Online" alt="Online"><?php } else { ?><img width="16" height="16" src="figuras/principal/offline.png" title="Offline" alt="Offline"><?php } ?></span> <a href="usuario.php?id=<?=$rs["Usuario_ID"]?>"><?php if ($rs["Usuario_VIP"] > 0) { ?><span id="usuario_vip<?=$rs["Usuario_VIP_Cor"]?>"><?=$rs["Usuario_Nome"]?></span><?php } else { ?><span id="usuario_normal"><?=$rs["Usuario_Nome"]?></span><?php } ?></a> <?php if ($rs["Usuario_ID"] == $medalha_1) { ?><span class="medalha"><img width="16" height="16" src="figuras/principal/medalha1.png" title="Top 1 da Hora" alt="Top 1 da Hora"></span><?php } else if ($rs["Usuario_ID"] == $medalha_2) { ?><span class="medalha"><img width="16" height="16" src="figuras/principal/medalha2.png" title="Top 2 da Hora" alt="Top 2 da Hora"></span><?php } else if ($rs["Usuario_ID"] == $medalha_3) { ?><span class="medalha"><img width="16" height="16" src="figuras/principal/medalha3.png" title="Top 3 da Hora" alt="Top 3 da Hora"></span><?php } ?></td>
		<td style="padding-top: 10px"><span class="img20"><a href="time.php?id=<?=$rs["Time_ID"]?>"><img width="20" height="20" src="figuras/times_pequenos/<?=$rs["Time_ID"]?>.png" title="<?=$rs["Time_Nome"]?>" alt="<?=$rs["Time_Nome"]?>" border="0"></a></span> <a href="time.php?id=<?=$rs["Time_ID"]?>"><?=$rs["Time_Nome"]?></a></td>
		<td style="padding-top: 10px"><?=number_format($rs["Usuario_Gols_Total"],0,',','.')?></td>
	</tr>

<?php } ?>

</table>
</form>

</div>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<?php
if ($amigos_quantidade > $limite) {
	$p_nome = "amigos";
	include("paginacao1.php");
}
?>

<?php } ?>

<div id="divide"></div>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Quem me adicionou?</h1></div></div></div>
	<div class="conteudo">

<div id="linha10"><span class="img16"><a href="meus_amigos.php"><img src="figuras/principal/amigos.png" title="Me Adicionou" alt="Me Adicionou" border="0"></a></span> <a href="meus_amigos.php"><b><?=number_format($meus_amigos_quantidade,0,',','.')?></b> <?php if ($meus_amigos_quantidade == 1) { ?>usuário te adicionou<?php } else { ?>usuários te adicionaram<?php } ?> como amigo.</a></div>

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