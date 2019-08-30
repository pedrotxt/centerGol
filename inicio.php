<?php ob_start(); ?>
<?php include_once("fun_anti_inj.php") ?>
<?php include("verificar_cookie.php") ?>
<?php include("conexao.php") ?>
<?php include("verificar_conexao.php") ?>
<?php include("verificar_cargo.php") ?>
<?php include("fun_sub_cor.php") ?>
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
$a=mysql_fetch_array(mysql_query("select tutorial from Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')"));
if(isset($_GET['desabilitar'])){
mysql_query("update Usuarios set tutorial=0 WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
?>
<script language= "JavaScript">
location.href="inicio.php"
</script>
<? } ?>
<?
if (!$_COOKIE["usuarioid"]) { }else{
	if($a['tutorial'] !=1){}else{
include('tutorial.php');
	}
}

$mensagem_global_status = $rs["Status"];

if ($mensagem_global_status == 1) {
	$mensagem_global = $rs["Mensagem"];
	$mensagem_global_por = $rs["Por"];
	$mensagem_global_data = $rs["Data"];
}

$query = mysql_query("SELECT Time FROM Times WHERE ID = '". $mc_time ."'");
$rs = mysql_fetch_array($query);

$mc_time_nome = $rs["Time"];

if ($mc_secar != 0) {

$query = mysql_query("SELECT Time FROM Times WHERE ID = '". $mc_secar ."'");
$rs = mysql_fetch_array($query);

$mc_secar_nome = $rs["Time"];

}

$query = mysql_query("SELECT Cargos.ID as Cargo_ID, Cargos.Data as Cargo_Data, Cargos.Cargo as Cargo_Funcao, Usuarios.ID as Usuario_ID, Usuarios.Usuario as Usuario_Nome, Usuarios.VIP as Usuario_VIP, Usuarios.VIP_Cor as Usuario_VIP_Cor FROM Cargos INNER JOIN Usuarios ON Usuarios.ID = Cargos.De WHERE Cargos.Time = '". $mc_time ."' AND Cargos.Usuario = '". $mc_id ."'");
$rs = mysql_fetch_array($query);

if ($rs) {
	$cargo_usuario_id = $rs["Usuario_ID"];
	$cargo_usuario_nome = $rs["Usuario_Nome"];
	$cargo_usuario_vip = $rs["Usuario_VIP"];
	$cargo_usuario_vip_cor = $rs["Usuario_VIP_Cor"];
	$cargo_id = $rs["Cargo_ID"];
	$cargo_data = $rs["Cargo_Data"];
	$cargo_funcao = $rs["Cargo_Funcao"];
} else {
	$cargo_id = 0;
}


$query = mysql_query("SELECT Renovacoes.ID as Renovacao_ID, Renovacoes.Valor as Renovacao_Valor, Renovacoes.Rescisao_Dias as Renovacao_Rescisao_Dias, Renovacoes.Rescisao_Dias_VIP as Renovacao_Rescisao_Dias_VIP, Renovacoes.Data as Renovacao_Data, Renovacoes.Mensagem as Renovacao_Mensagem, Usuarios.ID as Usuario_ID, Usuarios.Usuario as Usuario_Nome, Usuarios.VIP as Usuario_VIP, Usuarios.VIP_Cor as Usuario_VIP_Cor FROM Renovacoes INNER JOIN Usuarios ON Usuarios.ID = Renovacoes.De WHERE Renovacoes.Time = '". $mc_time ."' AND Renovacoes.Usuario = '". $mc_id ."'");
$rs = mysql_fetch_array($query);

if ($rs) {
	$renovacao_usuario_id = $rs["Usuario_ID"];
	$renovacao_usuario_nome = $rs["Usuario_Nome"];
	$renovacao_usuario_vip = $rs["Usuario_VIP"];
	$renovacao_usuario_vip_cor = $rs["Usuario_VIP_Cor"];
	$renovacao_id = $rs["Renovacao_ID"];
	$renovacao_valor = $rs["Renovacao_Valor"];
	$renovacao_rescisao_dias = $rs["Renovacao_Rescisao_Dias"];
	$renovacao_rescisao_dias_vip = $rs["Renovacao_Rescisao_Dias_VIP"];
	$renovacao_data = $rs["Renovacao_Data"];
	$renovacao_mensagem = $rs["Renovacao_Mensagem"];
} else {
	$renovacao_id = 0;
}

$salario_presidente = 3000;
$salario_diretor = 2000;
$salario_olheiro = 1000;

$hora = date("H");

if ($hora >= 18) {
	$saudacao = "Boa noite";
} else if ($hora >= 12) {
	$saudacao =  "Boa tarde";
} else {
	$saudacao = "Bom dia";
}
?>

<?php if ($mensagem_global_status == 1) { ?>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Mensagem Global</h1></div></div></div>
	<div class="conteudo">

<div id="linha10"><?=sub_cor($mensagem_global)?></div>
<div id="linha15"><span class="img16"><img width="16" height="16" src="figuras/principal/icon_lapis.png" title="Por" alt="Por"></span> <?=$mensagem_global_por?> <span class="align20"><span class="img16"><img width="16" height="16" src="figuras/principal/icon_data.png" title="Data" alt="Data"></span> <?=$mensagem_global_data?></span></div>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<div id="divide"></div>

<?php } ?>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Bem Vindo ao centergol</h1></div></div></div>
	<div class="conteudo">

<div id="linha10"><?=$saudacao?> <?php if ($mc_vip > 0) { ?><span id="usuario_vip<?=$mc_vip_cor?>"> <?=$mc_usuario?></span><?php } else { ?><span id="usuario_normal"> <?=$mc_usuario?></span><?php } ?>.</div>

<div id="linha10">O que é proibido no jogo?</div>
<div id="linha10">- Chingar ou ofender qualquer usuário.</div>
<div id="linha10">- Se beneficiar de algum bug, o que acarretará em banimento eterno da conta.</div>
<div id="linha10">- Passar sua conta para outro usuário logar, sua conta é de uso pessoal e intransferível.</div>
<div id="linha10">Obs: Não nos responsabilizamos por qualquer atitudes dos nossos usuários.</div>


	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<?php if ($cargo_id != 0) { ?>

<div id="divide"></div>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Convite de Cargo</h1></div></div></div>
	<div class="conteudo">

<div id="linha10"><span class="img20"><a href="time.php?id=<?=$mc_time?>"><img width="20" height="20" src="figuras/times_pequenos/<?=$mc_time?>.png" title="<?=$mc_time_nome?>" alt="<?=$mc_time_nome?>" border="0"></a></span> <a href="time.php?id=<?=$mc_time?>"><?=$mc_time_nome?></a> <span class="align5">(<?=$cargo_data?>)</span></div>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/usuario.png" title="Usuário" alt="Usuário"></span> <a href="usuario.php?id=<?=$cargo_usuario_id?>"><?php if ($cargo_usuario_vip > 0) { ?><span id="usuario_vip<?=$cargo_usuario_vip_cor?>"><?=$cargo_usuario_nome?></span><?php } else { ?><span id="usuario_normal"><?=$cargo_usuario_nome?></span><?php } ?></a> fez uma proposta de cargo do clube.</div>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/cargo.png" title="Cargo" alt="Cargo"></span> <b>Cargo:</b> <?php if ($cargo_funcao == 1) { ?>Diretor<?php } else { ?>Olheiro<?php } ?></div>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/moedas.png" title="Salário" alt="Salário"></span> <b>Salário:</b> <?php if ($cargo_funcao == 1) { ?><?=number_format($salario_diretor,0,',','.')?><?php } else { ?><?=number_format($salario_olheiro,0,',','.')?><?php } ?></div>

<div id="linha10"><a href="cargo_aceitar.php?id=<?=$cargo_id?>"><img src="figuras/principal/botao_aceitar.png" border="0"></a> <a href="cargo_recusar.php?id=<?=$cargo_id?>"><img src="figuras/principal/botao_recusar.png" border="0"></a></div>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<?php } ?>

<?php if ($renovacao_id != 0) { ?>

<div id="divide"></div>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Renovar Contrato</h1></div></div></div>
	<div class="conteudo">

<?php if (anti_inj($_GET["msg_renovar"]) == 1) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Time sem dinheiro no momento!</div>

<?php } else if (anti_inj($_GET["msg_renovar"]) == 2) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Usuário sem VIP suficiente!</div>

<?php } ?>

<div id="linha10"><span class="img20"><a href="time.php?id=<?=$mc_time?>"><img width="20" height="20" src="figuras/times_pequenos/<?=$mc_time?>.png" title="<?=$mc_time_nome?>" alt="<?=$mc_time_nome?>" border="0"></a></span> <a href="time.php?id=<?=$mc_time?>"><?=$mc_time_nome?></a> <span class="align5">(<?=$renovacao_data?>)</span></div>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/usuario.png" title="Usuário" alt="Usuário"></span> <a href="usuario.php?id=<?=$renovacao_usuario_id?>"><? if ($renovacao_usuario_vip > 0) { ?><span id="usuario_vip<?=$renovacao_usuario_vip_cor?>"><?=$renovacao_usuario_nome?></span><?php } else { ?><span id="usuario_normal"><?=$renovacao_usuario_nome?></span><?php } ?></a> quer renovar o seu contrato.</div>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/propostas_valor.png" title="Valor" alt="Valor"></span> <b>Valor:</b> <?=number_format($renovacao_valor,0,',','.')?></div>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/propostas_valor_rescisao.png" title="Rescisão" alt="Rescisão"></span> <b>Multa de Rescisão:</b> <?=number_format($renovacao_valor*2,0,',','.')?></div>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/propostas_dias.png" title="Dias" alt="Dias"></span> <b>Dias de Contrato:</b> <?=$renovacao_rescisao_dias?></div>

<?php if ($renovacao_rescisao_dias_vip > 0) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/propostas_rescisao_dias.png" title="Dias VIP" alt="Dias VIP"></span> <b>Dias de VIP:</b> <?=$renovacao_rescisao_dias_vip?></div>

<?php } ?>

<?php if ($renovacao_mensagem) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/propostas_mensagem.png" title="Mensagem" alt="Mensagem"></span> <b>Mensagem:</b> <?=$renovacao_mensagem?></div>

<?php } ?>

<div id="linha10"><a href="renovar_aceitar.php?id=<?=$renovacao_id?>"><img src="figuras/principal/botao_aceitar.png" border="0"></a> <a href="renovar_recusar.php?id=<?=$renovacao_id?>"><img src="figuras/principal/botao_recusar.png" border="0"></a></div>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<?php } ?>

<div id="divide"></div>

<div id="principal_metade">

<div id="principal_metade_esquerda">

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1><?=$mc_time_nome?></h1></div></div></div>
	<div class="conteudo">

<div id="align_center" style="padding-top: 10px"><a href="rodada.php?id=<?=$mc_time?>"><img src="figuras/times_grandes/<?=$mc_time?>.png" title="<?=$mc_time_nome?>" alt="<?=$mc_time_nome?>" border="0"></a></div>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/seta1.png"></span> <a href="alterar_time.php"><b>Alterar Time</b></a></div>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

</div>

<div id="principal_metade_direita">

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1><?php if ($mc_secar == 0) { ?>Time Secar<?php } else { ?><?=$mc_secar_nome?><?php } ?></h1></div></div></div>
	<div class="conteudo">

<?php if ($mc_secar != 0) { ?>

<div id="align_center" style="padding-top: 10px"><a href="rodada.php?id=<?=$mc_secar?>"><img src="figuras/times_grandes/<?=$mc_secar?>.png" title="<?=$mc_secar_nome?>" alt="<?=$mc_secar_nome?>" border="0"></a></div>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/seta1.png"></span> <a href="alterar_time_secar.php"><b>Alterar Time Secar</b></a></div>

<?php } else { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/seta1.png"></span> <a href="alterar_time_secar.php"><b>Escolher Time Secar</b></a></div>

<?php } ?>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

</div>

</div>

<?php ob_end_flush(); ?>


<!-- FIM DA PÁGINA -->
</div>
<div class="clear"></div>

</div>
<div id="baixo"><?php include("baixo.php") ?></div>
</div>
</body>
</html>