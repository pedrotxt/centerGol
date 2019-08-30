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

$p_total = ceil($propostas_quantidade / $limite);

if ($p_total < 1) {
	$p_total = 1;
}

if ($p > $p_total) {
	header("Location: propostas.php?p=1"); break;
}

ob_end_flush();
?>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Propostas (<?=$propostas_quantidade?>)</h1></div></div></div>
	<div class="conteudo">

<?php if (anti_inj($_GET["msg_propostas"]) == 1) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Você não pode mais trocar de time nessa temporada!</div>

<?php } else if (anti_inj($_GET["msg_propostas"]) == 2) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Você precisa marcar pelo menos 100 gols no time atual!</div>

<?php } else if (anti_inj($_GET["msg_propostas"]) == 3) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Time sem dinheiro no momento!</div>

<?php } else if (anti_inj($_GET["msg_propostas"]) == 4) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Usuário sem VIP suficiente!</div>

<?php } ?>

<div id="linha10"><a href="propostas.php"><img src="figuras/principal/botao_atualizar.png" border="0"></a></div>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<?php if ($propostas_quantidade > 0) { ?>

<?php

$query = mysql_query("SELECT Rescisao, Rescisao_Dias FROM Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$rs = mysql_fetch_array($query);

$mc_rescisao = $rs["Rescisao"];
$mc_rescisao_dias = $rs["Rescisao_Dias"];

$query = mysql_query("SELECT Propostas.ID as Propostas_ID, Propostas.Time as Propostas_Time, Propostas.De as Propostas_De, Propostas.Data as Propostas_Data, Propostas.Valor as Propostas_Valor, Propostas.Rescisao_Dias as Propostas_Rescisao_Dias, Propostas.Rescisao_Dias_VIP as Propostas_Rescisao_Dias_VIP, Propostas.Mensagem as Propostas_Mensagem, Usuarios.Usuario as Usuario_Nome, Usuarios.VIP as Usuario_VIP, Usuarios.VIP_Cor as Usuario_VIP_Cor FROM Propostas INNER JOIN Usuarios ON Usuarios.ID = Propostas.De WHERE Propostas.Usuario = '". $mc_id ."' ORDER BY Propostas.ID DESC LIMIT $inicio,$limite");

?>

<?php while ($rs = mysql_fetch_array($query)) { ?>

<?php

$query2 = mysql_query("SELECT Time FROM Times WHERE ID = '". $rs["Propostas_Time"] ."'");
$rs2 = mysql_fetch_array($query2);

$usuario_time_nome = $rs2["Time"];

?>

<div id="divide"></div>

<div class="box_branco">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"></div></div></div>
	<div class="conteudo">


<div><a href="time.php?id=<?=$rs["Contra"]?>"><span class="img20"><img width="20" height="20" src="figuras/times_pequenos/<?=$rs["Propostas_Time"]?>.png" title="<?=$usuario_time_nome?>" alt="<?=$usuario_time_nome?>" border="0"></span></a> <a href="usuario.php?id=<?=$rs["Propostas_De"]?>"><?php if ($rs["Usuario_VIP"] > 0) { ?><span id="usuario_vip<?=$rs["Usuario_VIP_Cor"]?>"><?=$rs["Usuario_Nome"]?></span><?php } else { ?><span id="usuario_normal"><?=$rs["Usuario_Nome"]?></span><?php } ?></a> (<?=$rs["Propostas_Data"]?>)</div>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/propostas_valor.png" title="Valor" alt="Valor"></span> <b>Valor:</b> <?=number_format($rs["Propostas_Valor"],0,',','.')?> com a multa de rescisão de <?=number_format($rs["Propostas_Valor"]*2,0,',','.')?>.</div>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/propostas_dias.png" title="Dias" alt="Dias"></span> <b>Dias de Contrato:</b> <?=$rs["Propostas_Rescisao_Dias"]?></div>

<?php if ($rs["Propostas_Rescisao_Dias_VIP"] > 0) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/propostas_rescisao_dias.png" title="Rescisão dias VIP" alt="Rescisão dias VIP"></span> <b>Dias de VIP:</b> <?=$rs["Propostas_Rescisao_Dias_VIP"]?> (não pode sair do time até acabar)</div>

<?php } ?>

<?php if ($mc_rescisao > 0) { ?>
<?php
$mc_vip_tempo = $mc_rescisao_dias;
$data_inicial = time()-86400 ;
$data_final = $mc_vip_tempo;
$diferenca = $data_final - $data_inicial;
$dias = (int)floor( $diferenca / (60 * 60 * 24));
?>
<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/propostas_valor_rescisao.png" title="Rescisão" alt="Rescisão"></span> <b>Multa de Rescisão:</b> Você tem multa de <?=number_format($mc_rescisao,0,',','.')?> que expira em <?=$dias?> <?php if ($dias == 1) { ?> dia<?php } else { ?> dias<?php } ?>.</div>

<div id="linha10"><b>Valor Final:</b> <?=number_format($rs["Propostas_Valor"]-$mc_rescisao,0,',','.')?></div>

<?php } ?>

<?php if ($rs["Propostas_Mensagem"]) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/propostas_mensagem.png" title="Mensagem" alt="Mensagem"></span> <b>Mensagem:</b> <?=$rs["Propostas_Mensagem"]?></div>

<?php } ?>

<div id="linha10"><a href="proposta_aceitar.php?id=<?=$rs["Propostas_ID"]?>"><img src="figuras/principal/botao_aceitar.png" border="0"></a> <a href="proposta_recusar.php?id=<?=$rs["Propostas_ID"]?>"><img src="figuras/principal/botao_recusar.png" border="0"></a></div>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<?php } ?>

<?php
if ($propostas_quantidade > $limite) {
	$p_nome = "propostas";
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