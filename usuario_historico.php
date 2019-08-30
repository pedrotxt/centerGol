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

$query = mysql_query("SELECT Count(ID) AS historico_quantidade FROM Historico WHERE Usuario = '". $id ."'");
$rs = mysql_fetch_array($query);

$historico_quantidade = $rs["historico_quantidade"];

$p_total = ceil($historico_quantidade / $limite);

if ($p_total < 1) {
	$p_total = 1;
}

if ($p > $p_total) {
	header("Location: usuario_historico.php?id=". $id ."&p=1"); break;
}

$query = mysql_query("SELECT Usuarios.ID as Usuario_ID, Usuarios.Usuario as Usuario_Nome, Usuarios.Nivel as Usuario_Nivel, Usuarios.Gols_Total as Usuario_Gols_Total, Usuarios.VIP as Usuario_VIP, Usuarios.VIP_Cor as Usuario_VIP_Cor, Times.ID as Time_ID, Times.Time as Time_Nome FROM Usuarios INNER JOIN Times ON Times.ID = Usuarios.Time WHERE Usuarios.ID = '". $id ."'");
$rs = mysql_fetch_array($query);

$usuario_id = $rs["Usuario_ID"];
$usuario_nome = $rs["Usuario_Nome"];
$usuario_time_id = $rs["Time_ID"];
$usuario_time_nome = $rs["Time_Nome"];
$usuario_nivel = $rs["Usuario_Nivel"];
$usuario_gols_total = $rs["Usuario_Gols_Total"];
$usuario_vip = $rs["Usuario_VIP"];
$usuario_vip_cor = $rs["Usuario_VIP_Cor"];

ob_end_flush();
?>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Sobre o Usuário</h1></div></div></div>
	<div class="conteudo">

<div id="linha10"><span class="img25"><img width="25" height="25" src="figuras/niveis/<?=$usuario_nivel?>.png" title="<?=$usuario_nivel?>" alt="<?=$usuario_nivel?>"></span> <span class="img20"><a href="time.php?id=<?=$usuario_time_id?>"><img width="20" height="20" src="figuras/times_pequenos/<?=$usuario_time_id?>.png" title="<?=$usuario_time_nome?>" alt="<?=$usuario_time_nome?>" border="0"></a></span> <a href="usuario.php?id=<?=$id?>"><?php if ($usuario_vip > 0) { ?><span id="usuario_vip<?=$usuario_vip_cor?>"><?=$usuario_nome?></span><?php } else { ?><span id="usuario_normal"><?=$usuario_nome?></span><?php } ?></a> <span class="align5">(<?=number_format($usuario_gols_total,0,',','.')?> <?php if ($usuario_gols_total == 1) { ?> gol<?php } else { ?> gols<?php } ?>)</span></div>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/historico.png" title="Histórico" alt="Histórico"></span> <b>Histórico:</b> <?=number_format($historico_quantidade,0,',','.')?></div>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<div id="divide"></div>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Histórico</h1></div></div></div>
	<div class="conteudo" style="padding-top: 3px">

<?php if ($historico_quantidade > 0) { ?>

<?php

$query = mysql_query("SELECT Times.Time, Usuarios.Time as Time_ID, Usuarios.ID as Usuario_ID, Usuarios.Usuario, Usuarios.Nivel, Historico.Acao, Usuarios.VIP, Usuarios.Gols_Total, Usuarios.VIP_Cor FROM Historico INNER JOIN Usuarios ON Usuarios.ID = Historico.Usuario INNER JOIN Times ON Usuarios.Time = Times.ID WHERE Historico.Usuario = '". $id ."' ORDER BY Historico.ID DESC LIMIT $inicio,$limite");

?>

<?php while ($rs = mysql_fetch_array($query)) { ?>

<div id="linha6"><span class="img25"><img width="25" height="25" src="figuras/niveis/<?=$rs["Nivel"]?>.png" title="<?=$rs["Nivel"]?>" alt="<?=$rs["Nivel"]?>"></span> <span class="img20"><a href="time.php?id=<?=$rs["Time_ID"]?>"><img width="20" height="20" src="figuras/times_pequenos/<?=$rs["Time_ID"]?>.png" title="<?=$rs["Time"]?>" alt="<?=$rs["Time"]?>" border="0"></a></span> <a href="usuario.php?id=<?=$rs["Usuario_ID"]?>"><?php if ($rs["VIP"] > 0) { ?><span id="usuario_vip<?=$rs["VIP_Cor"]?>"><?=$rs["Usuario"]?></span><?php } else { ?><span id="usuario_normal"><?=$rs["Usuario"]?></span><?php } ?></a> <?=$rs["Acao"]?></div>

<?php } ?>

<?php } else { ?>

<div id="linha7"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Nenhum histórico encontrado.</div>

<?php } ?>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<?php
if ($historico_quantidade > $limite) {
	$p_nome = "usuario_historico";
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