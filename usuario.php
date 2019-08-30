<?php ob_start(); ?>
<?php include_once("fun_anti_inj.php") ?>
<?php include("verificar_cookie.php") ?>
<?php include("conexao.php") ?>
<?php include("verificar_cargo.php") ?>
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


<script language="javascript">
function valida_mensagem() {

if (document.mensagem.mensagem.value=="") {
	alert("É necessário preencher a mensagem.");
	document.mensagem.mensagem.focus();
	return false;
}

}
</script>

<?php
$id = anti_inj($_GET['id']);

if (!$id) {
	header("Location: index.php"); break;
}

if (ereg('[^0-9]',$id)) {
	header("Location: index.php"); break;
}

if ($id < 1) {
	header("Location: index.php"); break;
}

$query = mysql_query("SELECT Trocas FROM Configuracoes");
$rs = mysql_fetch_array($query);

$trocas_total = $rs["Trocas"];

$query = mysql_query("SELECT Confirmar, Usuario, Nivel, Sexo, Time, Valor, Rescisao, Rescisao_Dias, Texto, Dinheiro, Conquistas, Mercado_Itens, Gols_Hora, Gols_Hora_Record, Gols_Rodada, Gols_Rodada_Record, Gols_Temporada, Gols_Temporada_Record, Gols_Total, Gols_Time, Passe_Certo, Passe_Certo_Acertos, Penalti, Penalti_Acertos, Sorte, Trocas, Propostas, Status, VIP_Tempo, VIP_Cor, Secar, Secar_Gols, Camisa, Rescisao_Dias_VIP, Moderador, Avatar_Cor, Avatar_Cabelo, Avatar_Cabelo_Cor, Avatar_Olho, Avatar_Olho_Cor, Energia, Sacola, Veneno, Escudo, Desafios, Desafio_Vitorias, Desafio_Empates, Desafio_Derrotas, Desafio_Total, Desafio_Recusados, Desafio_Saldo FROM Usuarios WHERE ID = '". $id ."'");
$rs = mysql_fetch_array($query);

if (!$rs) {
	header("Location: index.php"); break;
}

$usuario_confirmar = $rs["Confirmar"];

if ($usuario_confirmar != "0") {
	header("Location: index.php"); break;
}

$usuario_nome = $rs["Usuario"];
$usuario_nivel = $rs["Nivel"];
$usuario_sexo = $rs["Sexo"];
$usuario_time = $rs["Time"];
$usuario_valor = $rs["Valor"];
$usuario_rescisao = $rs["Rescisao"];
$usuario_rescisao_dias = $rs["Rescisao_Dias"];
$usuario_rescisao_dias_vip = $rs["Rescisao_Dias_VIP"];
$usuario_texto = $rs["Texto"];
$usuario_dinheiro = $rs["Dinheiro"];
$usuario_conquistas = $rs["Conquistas"];
$usuario_mercado = $rs["Mercado_Itens"];
$usuario_gols_hora = $rs["Gols_Hora"];
$usuario_gols_hora_record = $rs["Gols_Hora_Record"];
$usuario_gols_rodada = $rs["Gols_Rodada"];
$usuario_gols_rodada_record = $rs["Gols_Rodada_Record"];
$usuario_gols_temporada = $rs["Gols_Temporada"];
$usuario_gols_temporada_record = $rs["Gols_Temporada_Record"];
$usuario_gols_total = $rs["Gols_Total"];
$usuario_gols_time = $rs["Gols_Time"];
$usuario_passe_certo = $rs["Passe_Certo"];
$usuario_passe_certo_acertos = $rs["Passe_Certo_Acertos"];
$usuario_falta = $rs["Falta"];
$usuario_falta_acertos = $rs["Falta_Acertos"];
$usuario_penalti = $rs["Penalti"];
$usuario_penalti_acertos = $rs["Penalti_Acertos"];
$usuario_sorte = $rs["Sorte"];
$usuario_trocas = $rs["Trocas"];
$usuario_propostas = $rs["Propostas"];
$usuario_status = $rs["Status"];
$usuario_vip = $rs["VIP_Tempo"];
$usuario_vip_cor = $rs["VIP_Cor"];
$usuario_secar = $rs["Secar"];
$usuario_secar_gols = $rs["Secar_Gols"];
$usuario_camisa = $rs["Camisa"];
$usuario_moderador = $rs["Moderador"];
$usuario_avatar_cor = $rs["Avatar_Cor"];
$usuario_avatar_cabelo = $rs["Avatar_Cabelo"];
$usuario_avatar_cabelo_cor = $rs["Avatar_Cabelo_Cor"];
$usuario_avatar_olho = $rs["Avatar_Olho"];
$usuario_avatar_olho_cor = $rs["Avatar_Olho_Cor"];
$usuario_energia = $rs["Energia"];
$usuario_sacola = $rs["Sacola"];
$usuario_veneno = $rs["Veneno"];
$usuario_escudo = $rs["Escudo"];
$usuario_desafios = $rs["Desafios"];
$usuario_desafio_vitorias = $rs["Desafio_Vitorias"];
$usuario_desafio_empates = $rs["Desafio_Empates"];
$usuario_desafio_derrotas = $rs["Desafio_Derrotas"];
$usuario_desafio_total = $rs["Desafio_Total"];
$usuario_desafio_recusados = $rs["Desafio_Recusados"];
$usuario_desafio_saldo = $rs["Desafio_Saldo"];

$query = mysql_query("SELECT Time, Presidente, Diretor, Olheiro_1, Olheiro_2, Olheiro_3 FROM Times WHERE ID = '". $usuario_time ."'");
$rs = mysql_fetch_array($query);

$usuario_time_nome = $rs["Time"];
$usuario_time_presidente = $rs["Presidente"];
$usuario_time_diretor = $rs["Diretor"];
$usuario_time_olheiro_1 = $rs["Olheiro_1"];
$usuario_time_olheiro_2 = $rs["Olheiro_2"];
$usuario_time_olheiro_3 = $rs["Olheiro_3"];

if ($usuario_time_presidente == $id) {
	$usuario_presidente = 1;
}

if ($usuario_time_diretor == $id) {
	$usuario_diretor = 1;
}

if ($usuario_time_olheiro_1 == $id or $usuario_time_olheiro_2 == $id or $usuario_time_olheiro_3 == $id) {
	$usuario_olheiro = 1;
}

if ($usuario_secar != 0) {

$query = mysql_query("SELECT Time FROM Times WHERE ID = '". $usuario_secar ."'");
$rs = mysql_fetch_array($query);

$usuario_time_secar_nome = $rs["Time"];

}

$query = mysql_query("SELECT Count(ID) AS historico_quantidade FROM Historico WHERE Usuario = '". $id ."'");
$rs = mysql_fetch_array($query);

$historico_quantidade = $rs["historico_quantidade"];

$query = mysql_query("SELECT Count(ID) AS carreira_quantidade FROM Carreira WHERE Usuario = '". $id ."'");
$rs = mysql_fetch_array($query);

$carreira_quantidade = $rs["carreira_quantidade"];

$query = mysql_query("SELECT Count(ID) AS amigos_quantidade FROM Amigos WHERE Usuario = '". $id ."'");
$rs = mysql_fetch_array($query);

$amigos_quantidade = $rs["amigos_quantidade"];

$query = mysql_query("SELECT Count(ID) AS convidados_quantidade FROM Usuarios WHERE Convite = '". $id ."'");
$rs = mysql_fetch_array($query);

$convidados_quantidade = $rs["convidados_quantidade"];

$query = mysql_query("SELECT ID FROM Usuarios WHERE Gols_Rodada > 0 AND Camisa = '". $usuario_camisa ."' ORDER BY Gols_Rodada DESC LIMIT 1");
$rs = mysql_fetch_array($query);

if ($rs) {
	$selecao_id = $rs["ID"];
} else {
	$selecao_id = 0;
}

if ($selecao_id == $id) {
	$usuario_selecao = 1;
}

if ($_COOKIE["usuarioid"] and $id != $mc_id) {

$logado = 1;

$query = mysql_query("SELECT Usuario, Amigo FROM Amigos WHERE Usuario = '". $mc_id ."' AND Amigo = '". $id ."'");
$rs = mysql_fetch_array($query);

if ($rs) {
	$amigo_existe = 1;
}

}
include_once("usuario_ranks.php");
?>

<script language="javascript">
usuariomensagem = 0;
usuariousando = 0;
</script>

<div id="principal_metade">

<div id="principal_metade_esquerda">

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1><?=$usuario_nome?></h1></div></div></div>
	<div class="conteudo">

<?php if ($usuario_moderador == 1) { ?>

<div id="linha10"><span class="img25"><img width="25" height="25" src="figuras/niveis/adm.png" title="Administrador" alt="Administrador"></span> <b>Administrador</b></div>

<?php } else if ($usuario_moderador == 2) { ?>

<div id="linha10"><span class="img25"><img width="25" height="25" src="figuras/niveis/mod.png" title="Moderador" alt="Moderador"></span> <b>Moderador</b></div>

<?php } else if ($usuario_moderador == 3) { ?>

<div id="linha10"><span class="img25"><img width="25" height="25" src="figuras/niveis/div.png" title="Divulgador" alt="Divulgador"></span> <b>Divulgador</b></div>

<?php } ?>

<?php if ($usuario_moderador == 1 or $usuario_moderador == 2 or $usuario_moderador == 3) { ?>

<div id="linha6"><span class="img25"><img width="25" height="25" src="figuras/niveis/<?=$usuario_nivel?>.png" title="<?=$usuario_nivel?>" alt="<?=$usuario_nivel?>"></span> <?php if ($usuario_vip < time()) { ?><span class="img16"><img width="16" height="16" src="figuras/principal/usuario_normal.png" title="Conta Normal" alt="Conta Normal"></span> <span id="usuario_normal">Conta Normal</span><?php } else { ?><span class="img16"><img width="16" height="16" src="figuras/principal/usuario_vip.png" title="Conta VIP" alt="Conta VIP"></span> <span id="usuario_vip<?=$usuario_vip_cor?>">Conta VIP</span><?php } ?></div>

<?php } else { ?>

<div id="linha10"><span class="img25"><img width="25" height="25" src="figuras/niveis/<?=$usuario_nivel?>.png" title="<?=$usuario_nivel?>" alt="<?=$usuario_nivel?>"></span> <?php if ($usuario_vip < time()) { ?><span class="img16"><img width="16" height="16" src="figuras/principal/usuario_normal.png" title="Conta Normal" alt="Conta Normal"></span> <span id="usuario_normal">Conta Normal</span><?php } else { ?><span class="img16"><img width="16" height="16" src="figuras/principal/usuario_vip.png" title="Conta VIP" alt="Conta VIP"></span> <span id="usuario_vip<?=$usuario_vip_cor?>">Conta VIP</span><?php } ?></div>

<?php } ?>

<?php if ($usuario_selecao == 1) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/selecao.png" title="Seleção" alt="Seleção"></span> Seleção da Rodada</div>

<?php } ?>

<?php if ($usuario_presidente == 1) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/presidente.png" title="Presidente" alt="Presidente"></span> Presidente do Clube</div>

<?php } else if ($usuario_diretor == 1) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/diretor.png" title="Diretor" alt="Diretor"></span> Diretor do Clube</div>

<?php } else if ($usuario_olheiro == 1) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/olheiro.png" title="Olheiro" alt="Olheiro"></span> Olheiro do Clube</div>

<?php } ?>

<div id="linha10"><b>Time:</b> <span class="img20"><a href="time.php?id=<?=$usuario_time?>"><img width="20" height="20" src="figuras/times_pequenos/<?=$usuario_time?>.png" title="<?=$usuario_time_nome?>" alt="<?=$usuario_time_nome?>" border="0"></a></span> <a href="time.php?id=<?=$usuario_time?>"><?=$usuario_time_nome?></a> <span class="align5">(<?=number_format($usuario_gols_time,0,',','.')?> <?php if ($usuario_gols_time == 1) { ?> gol<?php } else { ?> gols<?php } ?>)</span></div>

<?php if ($usuario_secar != 0) { ?>

<div id="linha10"><b>Secando:</b> <span class="img20"><a href="time.php?id=<?=$usuario_secar?>"><img width="20" height="20" src="figuras/times_pequenos/<?=$usuario_secar?>.png" title="<?=$usuario_time_secar_nome?>" alt="<?=$usuario_time_secar_nome?>" border="0"></a></span> <a href="time.php?id=<?=$usuario_secar?>"><?=$usuario_time_secar_nome?></a> <span class="align5">(<?=$usuario_secar_gols?> <?php if ($usuario_secar_gols == 1) { ?> gol<?php } else { ?> gols<?php } ?>)</span></div>

<?php } ?>

<div id="linha10" style="padding-top: 15"><span class="img16"><img width="16" height="16" src="figuras/principal/dinheiro.png" title="Dinheiro" alt="Dinheiro"></span> <b>Dinheiro:</b> <?=number_format($usuario_dinheiro,0,',','.')?> <span class="align20"><span class="img16"><?php if ($usuario_status == 1) { ?><img width="16" height="16" src="figuras/principal/online.png" title="Online" alt="Online"><?php } else { ?><img width="16" height="16" src="figuras/principal/offline.png" title="Offline" alt="Offline"><?php } ?></span> <?php if ($usuario_status == 1) { ?>Online<?php } else { ?>Offline<?php } ?></span></div>

<div id="linha10" style="padding-top: 15"><span class="img16"><img width="16" height="16" src="figuras/principal/camisa.png" title="Camisa" alt="Camisa"></span> <b>Camisa:</b> <?=$usuario_camisa?> <span class="align20"><span class="img16"><img width="16" height="16" src="figuras/principal/sorte.png" title="Sorte" alt="Sorte"></span> <b>Sorte:</b> <?=number_format($usuario_sorte,0,',','.')?> / 1.000</span></div>

<div id="linha10" style="padding-top: 15"><span class="img16"><img width="16" height="16" src="figuras/principal/amigos.png" title="Amigos" alt="Amigos"></span> <b>Amigos:</b> <?=$amigos_quantidade?> <span class="align20"><span class="img16"><img width="16" height="16" src="figuras/principal/convidados.png" title="Convidados" alt="Convidados"></span> <b>Convidados:</b> <?=number_format($convidados_quantidade,0,',','.')?></span></div>

<div id="linha10" style="padding-top: 15"><span class="img16"><a href="mercado.php?id=<?=$id?>"><img width="16" height="16" src="figuras/principal/mercado.png" title="Mercado" alt="Mercado" border="0"></a></span> <a href="mercado.php?id=<?=$id?>"><b>Mercado:</b> <?=$usuario_mercado?></a> <span class="align20"><span class="img16"><a href="usuario_conquistas.php?id=<?=$id?>"><img width="16" height="16" src="figuras/principal/conquistas.png" title="Conquistas" alt="Conquistas" border="0"></a></span> <a href="usuario_conquistas.php?id=<?=$id?>"><b>Conquistas:</b> <?=number_format($usuario_conquistas,0,',','.')?></a></span></div>

<?php if ($logado == 1) { ?>

<div id="linha10" style="padding-top: 15"><span class="img16"><?php if ($amigo_existe != 1) { ?><a href="add_amigo.php?id=<?=$id?>"><img width="16" height="16" src="figuras/principal/add_amigo.png" title="Adicionar Amigo" alt="Adicionar Amigo"></a><?php } else { ?><a href="del_amigo.php?id=<?=$id?>"><img width="16" height="16" src="figuras/principal/del_amigo.png" title="Excluir Amigo" alt="Excluir Amigo"></a><?php } ?></span> <?php if ($amigo_existe != 1) { ?><a href="add_amigo.php?id=<?=$id?>"><b>Add Amigo</b></a><?php } else { ?><a href="del_amigo.php?id=<?=$id?>"><b>Del Amigo</b></a><?php } ?> <span class="align20"><span class="img16"><a id="cursor" onClick="javascript:change_div('usuario_mensagem');"><img width="16" height="16" src="figuras/principal/mensagens.png" title="Mensagem" alt="Mensagem"></a></span> <a id="cursor" onClick="javascript:change_div('usuario_mensagem');"><b>Mensagem</b></a></span>
</div><p></p>

<? if($eu_olheiro == 1){ ?>
<span style=" margin-left:45px;" class="align20"><span class="img16"><a id="cursor" onClick="javascript:change_div('usuario_olheiro');"><img width="16" height="16" src="figuras/principal/olheiro.png" title="Olheiro" alt="Olheiro"></a></span> <a id="cursor" onClick="javascript:change_div('usuario_olheiro');"><b>Painel Olheiro</b></a></span>
<? }else{ ?>
<?php }} ?>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<?php if (anti_inj($_GET["msg_amigo"]) == 1) { ?>

<div id="divide"></div>

<div class="box_branco">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"></div></div></div>
	<div class="conteudo">

<div><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Limite de 100 amigos!</div>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<?php } ?>

<?php if (anti_inj($_GET["msg_mensagem"]) == 1) { ?>

<div id="divide"></div>

<div class="box_branco">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"></div></div></div>
	<div class="conteudo">

<div><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_sim.png"></span> Mensagem enviada com sucesso!</div>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<?php } ?>

<div id="usuario_mensagem" style="display: none">

<div id="divide"></div>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Escrever Mensagem</h1></div></div></div>
	<div class="conteudo">

<form name="mensagem" method="post" action="usuario_mensagem_salvar.php?id=<?=$id?>" onSubmit="return valida_mensagem()">
<div id="linha10"><input name="mensagem" type="text" maxlength="200" style="width: 250px; height: 20px"></div>

<div id="linha12"><input name="submit" type="image" src="figuras/principal/botao_enviar.png" onClick="return valida_mensagem()"></div>
</form>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

</div>
<?php if (anti_inj($_GET["msg_olheiro"]) == 1) { ?>

<div id="divide"></div>

<div class="box_branco">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"></div></div></div>
	<div class="conteudo">

<div><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_sim.png"></span> Usuário enviado com Sucesso!</div>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<?php }else if (anti_inj($_GET["msg_olheiro"]) == 2) { ?>

<div id="divide"></div>

<div class="box_branco">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"></div></div></div>
	<div class="conteudo">

<div><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Esse usuário já foi indicado por algum olheiro do seu Time</div>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<? } ?>

<div id="usuario_olheiro" style="display: none">

<div id="divide"></div>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Painel Olheiro</h1></div></div></div>
	<div class="conteudo">

<form name="mensagem" method="post" action="usuario_olheiro_salvar.php?id=<?=$id?>" onSubmit="return valida_olheiro()">
<div id="linha10"><input name="olheiro" type="text" maxlength="200" style="width: 250px; height: 20px" placeholder="Escreva aqui o Motivo"></div>

<div id="linha12"><input name="submit" type="image" src="figuras/principal/botao_enviar.png" onClick="return valida_olheiro()"></div>
</form>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

</div>

<div id="divide"></div>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Menu do Usuário</h1></div></div></div>
	<div class="conteudo">

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/seta1.png"></span> <a href="usuario_carreira.php?id=<?=$id?>"><b>Carreira (<?=number_format($carreira_quantidade,0,',','.')?>)</b></a> <span class="img16"><img width="16" height="16" src="figuras/principal/seta1.png"></span> <a href="usuario_historico.php?id=<?=$id?>"><b>Histórico (<?=number_format($historico_quantidade,0,',','.')?>)</b></a></div>
<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/seta1.png"></span> <a id="cursor" onClick="javascript:change_div('usuario_usando');"><b>Usando Agora</b></a><?php if ($logado == 1) { ?> <span class="img16"><img width="16" height="16" src="figuras/principal/seta1.png"></span> <a href="usuario_pedra.php?id=<?=$id?>"><b>Jogar Pedra</b></a><?php } ?></div>

<?php if ($logado == 1) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/seta1.png"></span> <a href="usuario_doar_dinheiro.php?id=<?=$id?>"><b>Doar Dinheiro</b></a> <span class="img16"><img width="16" height="16" src="figuras/principal/seta1.png"></span> <a href="usuario_doar_vip.php?id=<?=$id?>"><b>Doar VIP</b></a></div>

<?php } ?>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<div id="usuario_usando" style="display: none">

<div id="divide"></div>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Usando Agora</h1></div></div></div>
	<div class="conteudo">

<?php if ($usuario_energia > 0) { ?>
<?php $itens_uso = 1; ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/energia.png" title="Energia" alt="Energia"></span> Energia</div>

<?php } ?>

<?php if ($usuario_sacola > 0) { ?>
<?php $itens_uso = 1; ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/sacola.png" title="Sacola" alt="Sacola"></span> Sacola</div>

<?php } ?>

<?php if ($usuario_veneno > 0) { ?>
<?php $itens_uso = 1; ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/veneno.png" title="Veneno" alt="Veneno"></span> Veneno</div>

<?php } ?>

<?php if ($usuario_escudo > 0) { ?>
<?php $itens_uso = 1; ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/escudo.png" title="Escudo" alt="Escudo"></span> Escudo</div>

<?php } ?>

<?php if ($itens_uso != 1) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Nenhum ítem em uso.</div>

<?php } ?>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

</div>

<div id="divide"></div>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Ranking</h1></div></div></div>
	<div class="conteudo">
<?php
$query = mysql_query("SELECT ID, VIP_Tempo FROM Usuarios WHERE ID = '". $_GET['id'] ."'");
$rs = mysql_fetch_array($query);
?>

<div id="linha10"><b>Hora:</b> <?=rankhora($rs['ID'])?>º</div>
<div id="linha10"><b>Rodada:</b> <?=rankrodada($rs['ID'])?>º</div>
<div id="linha10"><b>Temporada:</b> <?=ranktemporada($rs['ID'])?>º</div>
<div id="linha10"><b>Total:</b> <?=ranktotal($rs['ID'])?>º</div>
<div id="linha10"><b>Passe Certo:</b> <?=rankpasse($rs['ID'])?>º</div>
<div id="linha10"><b>Falta:</b> <?=rankfalta($rs['ID'])?>º</div>
<div id="linha10"><b>Pênalti:</b> <?=rankpenalt($rs['ID'])?>º</div>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<?php
$query = mysql_query("SELECT Falta, Falta_Acertos FROM Usuarios WHERE ID = '". $id ."'");
$rs = mysql_fetch_array($query);

$usuario_falta = $rs["Falta"];
$usuario_falta_acertos = $rs["Falta_Acertos"];


if ($usuario_passe_certo > 0) {
$p_passe_certo = ($usuario_passe_certo_acertos / $usuario_passe_certo) * 100;
$p_exp = explode(".", $p_passe_certo);
$p_passe_certo = $p_exp[0];
}

if ($usuario_falta > 0) {
$p_falta = ($usuario_falta_acertos / $usuario_falta) * 100;
$p_falta = explode(".", $p_falta);
$p_falta = $p_falta[0];
}

if ($usuario_penalti > 0) {
$p_penalti = ($usuario_penalti_acertos / $usuario_penalti) * 100;
$p_exp = explode(".", $p_penalti);
$p_penalti = $p_exp[0];
}


?>

<div id="divide"></div>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Gols / Record</h1></div></div></div>
	<div class="conteudo">

<div id="linha10"><b>Hora:</b> <?=number_format($usuario_gols_hora,0,',','.')?> / <?=number_format($usuario_gols_hora_record,0,',','.')?></div>
<div id="linha10"><b>Rodada:</b> <?=number_format($usuario_gols_rodada,0,',','.')?> / <?=number_format($usuario_gols_rodada_record,0,',','.')?></div>
<div id="linha10"><b>Temporada:</b> <?=number_format($usuario_gols_temporada,0,',','.')?> / <?=number_format($usuario_gols_temporada_record,0,',','.')?></div>
<div id="linha10"><b>Total:</b> <?=number_format($usuario_gols_total,0,',','.')?></div>
<div id="linha10"><b>Passe Certo:</b> <?=number_format($usuario_passe_certo_acertos,0,',','.')?> de <?=number_format($usuario_passe_certo,0,',','.')?><?php if ($usuario_passe_certo > 0) { ?> <span class="align5">(<?=$p_passe_certo?>%)</span><?php } ?></div>
<div id="linha10"><b>Falta:</b> <?=number_format($usuario_falta_acertos,0,',','.')?> de <?=number_format($usuario_falta,0,',','.')?><?php if ($usuario_falta > 0) { ?> <span class="align5">(<?=$p_falta?>%)</span><?php } ?></div>
<div id="linha10"><b>Pênalti:</b> <?=number_format($usuario_penalti_acertos,0,',','.')?> de <?=number_format($usuario_penalti,0,',','.')?><?php if ($usuario_penalti > 0) { ?> <span class="align5">(<?=$p_penalti?>%)</span><?php } ?></div>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

</div>
<div id="principal_metade_direita">

<div class="box_branco">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"></div></div></div>
	<div class="conteudo">

<div id="usuario_avatar_swf" style="text-align: center">
<a href="http://www.adobe.com/go/EN_US-H-GET-FLASH" target="_blank"><img src="http://www.adobe.com/images/shared/download_buttons/get_adobe_flash_player.png" border="0"></a>

<script type="text/javascript">
	var fo = new FlashObject("swf/avatar.swf?avatar_adm=0&avatar_time=<?=$usuario_time?>&avatar_sexo=<?=$usuario_sexo?>&avatar_cor=<?=$usuario_avatar_cor?>&avatar_cabelo=<?=$usuario_avatar_cabelo?>&avatar_cabelo_cor=<?=$usuario_avatar_cabelo_cor?>&avatar_olho=<?=$usuario_avatar_olho?>&avatar_olho_cor=<?=$usuario_avatar_olho_cor?>", "uavatar", "220", "320", "7", "#fff");
	fo.addParam("quality", "high");
	fo.addParam("menu", "false");
	fo.addParam("wmode", "transparent");
	fo.addParam("scale", "noscale");
	fo.write("usuario_avatar_swf");
</script>
</div>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<div id="divide"></div>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Desafios</h1></div></div></div>
	<div class="conteudo">

<div id="linha10"><b>Vitórias:</b> <?=number_format($usuario_desafio_vitorias,0,',','.')?></div>
<div id="linha10"><b>Empates:</b> <?=number_format($usuario_desafio_empates,0,',','.')?></div>
<div id="linha10"><b>Derrotas:</b> <?=number_format($usuario_desafio_derrotas,0,',','.')?></div>
<div id="linha10"><b>Total:</b> <?=number_format($usuario_desafio_total,0,',','.')?></div>
<div id="linha10"><b>Recusados:</b> <?=number_format($usuario_desafio_recusados,0,',','.')?></div>
<div id="linha10"><b>Saldo:</b> <?php if ($usuario_desafio_saldo < 0) { ?><span class="fonte3"><?=number_format($usuario_desafio_saldo,0,',','.')?></span><?php } else { ?><?=number_format($usuario_desafio_saldo,0,',','.')?><?php } ?></div>

<?php if ($usuario_desafios == 0) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/icon_info.png"></span> Não quero receber desafios.</div>

<?php } ?>

<div id="linha10"><?php if ($logado == 1 and $usuario_desafios == 1) { ?><span class="img16"><img width="16" height="16" src="figuras/principal/seta1.png"></span> <a href="usuario_desafio.php?id=<?=$id?>"><b>Desafiar</b></a> <?php } ?><span class="img16"><img width="16" height="16" src="figuras/principal/seta1.png"></span> <a href="usuario_desafios.php?id=<?=$id?>"><b>Resultados</b></a></div>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<div id="divide"></div>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Contrato</h1></div></div></div>
	<div class="conteudo">

<div id="linha10"><b>Trocas na Temporada:</b> <?=$usuario_trocas?> / <?=$trocas_total?></div>

<?php if ($usuario_rescisao != 0) { ?>
<?php
$mc_vip_tempo = $usuario_rescisao_dias;
$data_inicial = time()-86400 ;
$data_final = $mc_vip_tempo;
$diferenca = $data_final - $data_inicial;
$dias = (int)floor( $diferenca / (60 * 60 * 24));
?>
<? if($mc_vip_tempo > time()){ ?>
<div id="linha10"><b>Rescisão:</b> <?=number_format($usuario_rescisao,0,',','.')?> (<?=$dias?> <?php if ($dias == 1) { ?> dia<?php } else { ?> dias<?php } ?>)</div>
<? }else{}?>

<?php } ?>

<div id="linha10"><b>Passe:</b> <?=number_format($usuario_valor,0,',','.')?></div>

<?php if ($usuario_rescisao != 0) { ?>

<div id="linha10"><b>Total:</b> <?=number_format($usuario_valor+$usuario_rescisao,0,',','.')?></div>

<?php } ?>

<?php if ($usuario_propostas == 0) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/icon_info.png"></span> Não quero receber propostas.</div>

<?php } ?>

<?php if ($usuario_rescisao_dias_vip > time()) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/icon_info.png"></span> Tenho VIP do time e não posso sair.</div>

<?php } ?>

<?php if ($logado == 1) { ?>

<?php if ($usuario_propostas == 1 and $eu_presidente == 1 and $usuario_rescisao_dias_vip < time() and $usuario_time != $mc_time or $usuario_propostas == 1 and $eu_diretor == 1 and $usuario_rescisao_dias_vip < time() and $usuario_time != $mc_time) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/seta1.png"></span> <a href="usuario_proposta.php?id=<?=$id?>"><b>Fazer Proposta</b></a></div>

<?php } else if ($usuario_propostas == 1 and $eu_presidente == 1 and $usuario_time == $mc_time or $usuario_propostas == 1 and $eu_diretor == 1 and $usuario_time == $mc_time) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/seta1.png"></span> <a href="usuario_renovar.php?id=<?=$id?>"><b>Renovar Contrato</b></a></div>

<?php } else if ($usuario_propostas == 1 and $eu_olheiro == 1 and $usuario_rescisao_dias_vip == 0 and $usuario_time != $mc_time) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/seta1.png"></span> <a href="usuario_indicar.php?id=<?=$id?>"><b>Indicar Jogador</b></a></div>

<?php } ?>

<?php } ?>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<?php if ($usuario_texto) { ?>

<div id="divide"></div>

<div class="box_branco">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"></div></div></div>
	<div class="conteudo">

<div><?=$usuario_texto?></div>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<?php } ?>

</div>

</div>


<!-- FIM DA PÁGINA -->
</div>
<div class="clear"></div>

</div>
<div id="baixo"><?php include("baixo.php") ?></div>
</div>
</body>
</html>