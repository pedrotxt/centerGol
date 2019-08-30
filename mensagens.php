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

$p_total = ceil($mensagens_quantidade / $limite);

if ($p_total < 1) {
	$p_total = 1;
}

if ($p > $p_total) {
	header("Location: mensagens.php?p=1"); break;
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

<!--

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Mensagem Extra</h1></div></div></div>
	<div class="conteudo">

<div id="linha10" class="fonte3_negrito">Hoje será o Mega Halloween da Rádio Zone, daremos 30 dias de VIP para quem usar a fantasia mais louca na webcam do chat, e o segundo melhor fatura 15 dias. Começaremos com a programação a partir das 20h. Não perca hoje!</div>

<div id="linha10" class="fonte1_negrito">Não precisa de fantasia profissional, qualquer coisa avacalhada serve, seja criativo e venha zoar com a gente!</div>

<div id="linha10" class="fonte1_negrito">Curta a fan page da Zone e fique de olho na programação.</div>

<div id="linha10" class="fonte3_negrito"><a href="http://www.facebook.com/radiozonebrasil" target="_blank"><span class="fonte3_negrito">Fan Page</span></a> / <a href="chat.php" target="_blank"><span class="fonte3_negrito">Chat</span></a></div>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<div id="divide"></div>

-->

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Mensagens (<?=number_format($mensagens_quantidade,0,',','.')?>)</h1></div></div></div>
	<div class="conteudo">

<?php if ($mensagens_quantidade > 0) { ?>

<div id="linha10"><?php if ($mensagens_quantidade > 1) { ?><a id="cursor" onClick="javascript:check(document.mensagens_selecao.todos);"><img src="figuras/principal/botao_selecionar_todas.png" border="0"></a> <?php } ?><input type="image" src="figuras/principal/botao_excluir.png" onClick="javascript:document.mensagens_selecao.submit();"><? if ($mensagens_quantidade > 10) { ?> <a href="mensagens_excluir_todas.php"><img src="figuras/principal/botao_excluir_todas.png" border="0"></a><?php } ?></div>

<?php } else { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Nenhuma mensagem encontrada.</div>

<?php } ?>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<?php if ($mensagens_quantidade > 0) { ?>

<form name="mensagens_selecao" action="mensagens_excluir.php" method="post">

<?php

$query_wl = 0;

$query = mysql_query("SELECT ID, Usuario, Mensagem, Hora, Data FROM Mensagens_Usuario WHERE Para = '". $mc_id ."' ORDER BY ID DESC LIMIT $inicio,$limite");

?>

<?php while ($rs = mysql_fetch_array($query)) { ?>

<?php $query_wl = $query_wl + 1; ?>

<script language="javascript">
responder<?=$rs["ID"]?> = 0;

function change_responder_<?=$rs["ID"]?>() {

		if (responder<?=$rs["ID"]?> == 0) {
			document.getElementById('responder_<?=$rs["ID"]?>').style.display = "block";
			responder<?=$rs["ID"]?> = 1;
		} else {
			document.getElementById('responder_<?=$rs["ID"]?>').style.display = "none";
			responder<?=$rs["ID"]?> = 0;
		}

}
</script>

<div id="divide"></div>

<div class="box_branco">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"></div></div></div>
	<div class="conteudo">

<?php if ($rs["Usuario"] != 0) { ?>

<?php

$query2 = mysql_query("SELECT Usuarios.Usuario as Usuario_Nome, Usuarios.VIP_Tempo as Usuario_VIP_Tempo, Usuarios.VIP_Cor as Usuario_VIP_Cor, Usuarios.Status as Usuario_Status, Times.ID as Time_ID, Times.Time as Time_Nome FROM Usuarios INNER JOIN Times ON Times.ID = Usuarios.Time WHERE Usuarios.ID = '". $rs["Usuario"] ."'");
$rs2 = mysql_fetch_array($query2);

$usuario_nome = $rs2["Usuario_Nome"];
$usuario_time = $rs2["Time_ID"];
$usuario_time_nome = $rs2["Time_Nome"];
$usuario_vip = $rs2["Usuario_VIP_Tempo"];
$usuario_vip_cor = $rs2["Usuario_VIP_Cor"];
$usuario_status = $rs2["Usuario_Status"];

?>

<table width="550" cellpadding="0" cellspacing="0">
	<tr>
		<td width="220" style="padding: 6px 0 6px 0"><span class="img16"><a id="cursor" onClick="javascript:change_responder_<?=$rs["ID"]?>();"><img width="16" height="16" src="figuras/principal/responder.png" title="Responder" alt="Responder" border="0"></a></span> <span class="align_radio"><input name="mensagens_selecao[]" type="checkbox" value="<?=$rs["ID"]?>" id="todos"></span> <span class="img16"><?php if ($usuario_status == 1) { ?><img width="16" width="16" src="figuras/principal/online.png" title="Online" alt="Online"><?php } else { ?><img width="16" height="16" src="figuras/principal/offline.png" title="Offline" alt="Offline"><?php } ?></span> <a href="usuario.php?id=<?=$rs["Usuario"]?>"><?php if ($usuario_vip > time()) { ?><span id="usuario_vip<?=$usuario_vip_cor?>"><?=$usuario_nome?></span><?php } else { ?><span id="usuario_normal"><?=$usuario_nome?></span><?php } ?></a> <?php if ($rs["Usuario"] == $medalha_1) { ?><span class="medalha"><img width="16" height="16" src="figuras/principal/medalha1.png" title="Top 1 da Hora" alt="Top 1 da Hora"></span><?php } else if ($rs["Usuario"] == $medalha_2) { ?><span class="medalha"><img width="16" height="16" src="figuras/principal/medalha2.png" title="Top 2 da Hora" alt="Top 2 da Hora"></span><?php } else if ($rs["Usuario"] == $medalha_3) { ?><span class="medalha"><img width="16" height="16" src="figuras/principal/medalha3.png" title="Top 3 da Hora" alt="Top 3 da Hora"></span><?php } ?></td>
		<td width="205" style="padding: 6px 0 6px 0"><span class="img20"><a href="time.php?id=<?=$usuario_time?>"><img width="20" height="20" src="figuras/times_pequenos/<?=$usuario_time?>.png" title="<?=$usuario_time_nome?>" alt="<?=$usuario_time_nome?>" border="0"></a></span> <a href="time.php?id=<?=$usuario_time?>"><span style="font-weight: normal"><?=$usuario_time_nome?></span></a></td>
        <td width="125" style="padding: 6px 0 6px 0"><span class="img16"><img width="16" height="16" src="figuras/principal/data.png" title="Data" alt="Data"></span> <?=$rs["Data"]?> <span class="img16" style="padding-left: 6px"><img width="16" height="16" src="figuras/principal/hora.png" title="Hora" alt="Hora"></span> <?=$rs["Hora"]?></td>
	</tr>
 	<tr>
		<td colspan="3" style="padding: 10px 0 10px 0; border-top: 1px solid #CCCCCC"><?=$rs["Mensagem"]?></td>
	</tr>
</table>

<div id="responder_<?=$rs["ID"]?>" style="display: none; border-top: 1px solid #CCCCCC">

<div id="linha10"><b>Custo:</b> 50</div>

<div id="linha10"><iframe name="responder" width="100%" height="35" src="mensagem_enviar.php?id=<?=$rs["Usuario"]?>" scrolling="0" frameborder="0" marginwidth="0" marginheight="0"></iframe></div>

</div>

<?php } else { ?>

<table width="550" cellpadding="0" cellspacing="0">
	<tr>
		<td width="220" style="padding: 6px 0 6px 0"><span class="align_radio"><input name="mensagens_selecao[]" type="checkbox" value="<?=$rs["ID"]?>" id="todos"></span> <span class="img16"><img width="16" height="16" src="figuras/principal/computador.png" title="Sistema Automático" alt="Sistema Automático"></span> <b>Sistema Automático</b></td>
		<td width="205" style="padding: 6px 0 6px 0">&nbsp;</td>
        <td width="125" style="padding: 6px 0 6px 0"><span class="img16"><img width="16" height="16" src="figuras/principal/data.png" title="Data" alt="Data"></span> <?=$rs["Data"]?> <span class="img16" style="padding-left: 6px"><img width="16" height="16" src="figuras/principal/hora.png" title="Hora" alt="Hora"></span> <?=$rs["Hora"]?></td>
	</tr>
 	<tr>
		<td colspan="3" style="padding: 10px 0 6px 0; border-top: 1px solid #CCCCCC"><?=$rs["Mensagem"]?></td>
	</tr>
</table>

<?php } ?>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<?php } ?>

</form>

<?php
if ($mensagens_quantidade > $limite) {
	$p_nome = "mensagens";
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