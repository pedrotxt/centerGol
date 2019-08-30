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

$query = mysql_query("SELECT Count(ID) AS desafios_quantidade FROM Desafios WHERE Usuario_1 = '". $mc_id ."'");
$rs = mysql_fetch_array($query);

$desafios_quantidade = $rs["desafios_quantidade"];

$p_total = ceil($desafios_quantidade / $limite);

if ($p_total < 1) {
	$p_total = 1;
}

if ($p > $p_total) {
	header("Location: desafios_pendentes.php?p=1"); break;
}

ob_end_flush();
?>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Desafios Pendentes (<?=$desafios_quantidade?>)</h1></div></div></div>
	<div class="conteudo">

<div id="linha10"><a href="desafios.php"><img src="figuras/principal/botao_voltar.png" border="0"></a></div>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<?php if ($desafios_quantidade > 0) { ?>

<?php

$query = mysql_query("SELECT Usuarios.ID as Usuario_ID, Usuarios.Usuario as Usuario_Nome, Usuarios.Nivel as Usuario_Nivel, Usuarios.VIP as Usuario_VIP, Usuarios.VIP_Cor as Usuario_VIP_Cor, Times.ID as Time_ID, Times.Time as Time_Nome, Desafios.ID as Desafio_ID, Desafios.Aposta as Desafio_Aposta FROM Desafios INNER JOIN Usuarios ON Usuarios.ID = Desafios.Usuario_2 INNER JOIN Times ON Times.ID = Usuarios.Time WHERE Desafios.Usuario_1 = '". $mc_id ."' ORDER BY Desafios.ID DESC LIMIT $inicio,$limite");

?>

<?php while ($rs = mysql_fetch_array($query)) { ?>

<div id="divide"></div>

<div class="box_branco">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"></div></div></div>
	<div class="conteudo">

<table width="550" cellpadding="0" cellspacing="0">
	<tr>
		<td width="210"><span class="img25"><img width="25" height="25" src="figuras/niveis/<?=$rs["Usuario_Nivel"]?>.png" title="<?=$rs["Usuario_Nivel"]?>" alt="<?=$rs["Usuario_Nivel"]?>"></span> <span class="img20"><a href="time.php?id=<?=$rs["Time_ID"]?>"><img width="20" height="20" src="figuras/times_pequenos/<?=$rs["Time_ID"]?>.png" title="<?=$rs["Time_Nome"]?>" alt="<?=$rs["Time_Nome"]?>" border="0"></a></span> <a href="usuario.php?id=<?=$rs["Usuario_ID"]?>"><?php if ($rs["Usuario_VIP"] > 0) { ?><span id="usuario_vip<?=$rs["Usuario_VIP_Cor"]?>"><?=$rs["Usuario_Nome"]?></span><?php } else { ?><span id="usuario_normal"><?=$rs["Usuario_Nome"]?></span><?php } ?></a></td>
		<td width="237"><span class="img16"><img width="16" height="16" src="figuras/principal/aposta.png" title="Aposta" alt="Aposta"></span> <?=number_format($rs["Desafio_Aposta"],0,',','.')?></td>
		<td width="103"><a href="desafios_pendentes_cancelar.php?id=<?=$rs["Desafio_ID"]?>"><img src="figuras/principal/botao_cancelar.png" border="0"></a></td>
	</tr>
</table>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<?php } ?>

<?php
if ($desafios_quantidade > $limite) {
	$p_nome = "desafios_pendentes";
	include("paginacao1.php");
}
?>

<?php } ?>


<!-- FIM DA PÁGINA -->
</div>
<div class="clear"></div>

</div>
<div id="baixo"><?php include("baixo.php") ?></div>
</div>
</body>
</html>