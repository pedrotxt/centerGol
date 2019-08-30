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

$query = mysql_query("SELECT Count(ID) AS historico_quantidade FROM Historico");
$rs = mysql_fetch_array($query);

$historico_quantidade = $rs["historico_quantidade"];

$p_total = ceil($historico_quantidade / $limite);

if ($p_total < 1) {
	$p_total = 1;
}

if ($p > $p_total) {
	header("Location: historico.php?p=1"); break;
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

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Histórico Geral (<?=number_format($historico_quantidade,0,',','.')?>)</h1></div></div></div>
	<div class="conteudo" style="padding-top: 4px">

<?php if ($historico_quantidade > 0) { ?>

<?php

$query = mysql_query("SELECT Times.Time, Usuarios.Time as Time_ID, Usuarios.ID as Usuario_ID, Usuarios.Usuario, Usuarios.Nivel, Historico.Acao, Usuarios.VIP_Tempo, Usuarios.Gols_Total, Usuarios.VIP_Cor FROM Historico INNER JOIN Usuarios ON Usuarios.ID = Historico.Usuario INNER JOIN Times ON Usuarios.Time = Times.ID ORDER BY Historico.ID DESC LIMIT $inicio,$limite");

?>

<?php while ($rs = mysql_fetch_array($query)) { ?>

<div id="linha6"><span class="img25"><img width="25" height="25" src="figuras/niveis/<?=$rs["Nivel"]?>.png" title="<?=$rs["Nivel"]?>" alt="<?=$rs["Nivel"]?>"></span> <span class="img20"><a href="time.php?id=<?=$rs["Time_ID"]?>"><img width="20" height="20" src="figuras/times_pequenos/<?=$rs["Time_ID"]?>.png" title="<?=$rs["Time"]?>" alt="<?=$rs["Time"]?>" border="0"></a></span> <a href="usuario.php?id=<?=$rs["Usuario_ID"]?>"><?php if ($rs["VIP_Tempo"] > time()) { ?><span id="usuario_vip<?=$rs["VIP_Cor"]?>"><?=$rs["Usuario"]?></span><?php } else { ?><span id="usuario_normal"><?=$rs["Usuario"]?></span><?php } ?></a> <?php if ($rs["Usuario_ID"] == $medalha_1) { ?><span class="medalha"><img width="16" height="16" src="figuras/principal/medalha1.png" title="Top 1 da Hora" alt="Top 1 da Hora"></span><?php } else if ($rs["Usuario_ID"] == $medalha_2) { ?><span class="medalha"><img width="16" height="16" src="figuras/principal/medalha2.png" title="Top 2 da Hora" alt="Top 2 da Hora"></span><?php } else if ($rs["Usuario_ID"] == $medalha_3) { ?><span class="medalha"><img width="16" height="16" src="figuras/principal/medalha3.png" title="Top 3 da Hora" alt="Top 3 da Hora"></span><?php } ?> <?=$rs["Acao"]?></div>

<?php } ?>

<?php } else { ?>

<div id="linha6"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Nenhum histórico encontrado.</div>

<?php } ?>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<?php
if ($historico_quantidade > $limite) {
	$p_nome = "historico";
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