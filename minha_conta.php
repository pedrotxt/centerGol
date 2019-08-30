<?php include_once("fun_anti_inj.php"); ?>
<?php include("verificar_cookie.php"); ?>
<?php include("conexao.php"); ?>
<?php include("verificar_conexao.php"); ?>
<?php
if (!$mc_id) {

header("Content-Type: text/html; charset=ISO-8859-1",true);

$query = mysql_query("SELECT ID, Dinheiro, Gols_Hora, Gols_Rodada, Gols_Temporada, Gols_Total, VIP, VIP_Cor, Nivel, Energia, Veneno, Sacola, Escudo, Propostas, Desafios FROM Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$rs = mysql_fetch_array($query);

$mc_id = $rs["ID"];
$mc_dinheiro = $rs["Dinheiro"];
$mc_gols_hora = $rs["Gols_Hora"];
$mc_gols_rodada = $rs["Gols_Rodada"];
$mc_gols_temporada = $rs["Gols_Temporada"];
$mc_gols_total = $rs["Gols_Total"];
$mc_vip = $rs["VIP"];
$mc_vip_cor = $rs["VIP_Cor"];
$mc_nivel = $rs["Nivel"];
$mc_energia = $rs["Energia"];
$mc_veneno = $rs["Veneno"];
$mc_sacola = $rs["Sacola"];
$mc_escudo = $rs["Escudo"];
$mc_propostas = $rs["Propostas"];
$mc_desafios = $rs["Desafios"];

$mc_nivel_ver = $mc_nivel + 1;

$query = mysql_query("SELECT Gols FROM Niveis WHERE Nivel = '". $mc_nivel_ver ."'");
$rs = mysql_fetch_array($query);

$mc_nivel_gols = $rs["Gols"];
$mc_nivel_gols = $mc_nivel_gols - $mc_gols_total;

}

@$query = mysql_query("SELECT Count(ID) AS mensagens_quantidade FROM Mensagens_Usuario WHERE Para = '". $mc_id ."'");
@$rs = mysql_fetch_array($query);

$mensagens_quantidade = $rs["mensagens_quantidade"];

if ($mc_desafios == 1) {

$query = mysql_query("SELECT Count(ID) AS desafios_quantidade FROM Desafios WHERE Usuario_2 = '". $mc_id ."'");
$rs = mysql_fetch_array($query);

$desafios_quantidade = $rs["desafios_quantidade"];

}

if ($mc_propostas == 1) {

$query = mysql_query("SELECT Count(ID) AS propostas_quantidade FROM Propostas WHERE Usuario = '". $mc_id ."'");
$rs = mysql_fetch_array($query);

$propostas_quantidade = $rs["propostas_quantidade"];

}

$query = mysql_query("SELECT Count(ID) AS amigos_quantidade FROM Amigos WHERE Usuario = '". $mc_id ."'");
$rs = mysql_fetch_array($query);

$amigos_quantidade = $rs["amigos_quantidade"];

$query = mysql_query("SELECT Count(ID) AS convidados_quantidade FROM Usuarios WHERE Convite = '". $mc_id ."'");
$rs = mysql_fetch_array($query);

$convidados_quantidade = $rs["convidados_quantidade"];
?>

<script language="javascript">
mcnivel = <?=$_COOKIE["mcnivel"]?>;
mcitens = <?=$_COOKIE["mcitens"]?>;
</script>
<?php
$query = mysql_query("SELECT ID, VIP_Tempo,Presidente_Dias FROM Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$rs = mysql_fetch_array($query);
$mc_vip_tempo = $rs["VIP_Tempo"];
$mc_diasp_tempo = $rs["Presidente_Dias"];
$data_inicial = time()-86400 ;
$data_final = $mc_vip_tempo;
$diferenca = $data_final - $data_inicial;
$dias = (int)floor( $diferenca / (60 * 60 * 24));

$data_inicial_p = time()-86400 ;
$data_final_p = $mc_diasp_tempo;
$diferenca_p = $data_final_p - $data_inicial_p;
$dias_p = (int)floor( $diferenca_p / (60 * 60 * 24));

?>
<div><span class="img25"><img width="25" height="25" src="figuras/niveis/<?=$mc_nivel?>.png" title="<?=$mc_nivel?>" alt="<?=$mc_nivel?>"></span> <? if ($mc_vip_tempo < time()) { ?><span class="img16"><img width="16" height="16" src="figuras/principal/usuario_normal.png" title="Conta Normal" alt="Conta Normal"></span> <span id="usuario_normal">Conta Normal</span><? } else { ?><span class="img16"><img width="16" height="16" src="figuras/principal/usuario_vip.png" title="Conta VIP" alt="Conta VIP"></span> <span id="usuario_vip<?=$mc_vip_cor?>"> <a href="#" class="mais_informacoes" id="a">VIP (<?=$dias?> <?php if ($dias == 1) { ?> dia<?php } else { ?> dias<?php } ?>)</a><div class="descricao"><?= date("d/m/Y \à\s H:i",$mc_vip_tempo) ?></div></span><?php } ?></div>
<? if ($mc_diasp_tempo < time()) { ?><? }else{ ?><div><span class="img25"><img width="16" height="16" src="figuras/principal/presidente.png" title="Dias Presidente" alt="Dias Presidente"> <strong>DIAS P (<?=$dias_p?> dias)</strong></span></div><? } ?>

		<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.0.min.js"></script>		
		<script type="text/javascript">		
			$(function() {
				$('.descricao').hide();
				$('a.mais_informacoes').click(function(){					
                    $("#"+$(this).attr("id")+" + div").toggle()
				});
			});
		</script>              

<div id="linha10"><a id="cursor" onClick="javascript:change_div('minha_conta_nivel');"><span class="img16"><img width="16" height="16" src="figuras/principal/icon_duvida.png" title="Próximo" alt="Próximo" border="0"></span> <b>Próximo Nível</b></a></div>

<div id="minha_conta_nivel" <?php if ($_COOKIE["mcnivel"] == 1) { ?>style="display: block"<?php } else { ?>style="display: none"<?php } ?>>

<div id="linha10">Próximo em <?=number_format($mc_nivel_gols,0,',','.')?> <?php if ($mc_nivel_gols == 1) { ?> gol<?php } else { ?> gols<?php } ?>.</div>

</div>

<div id="linha10"><a id="cursor" onClick="javascript:change_div('minha_conta_itens');"><span class="img16"><img width="16" height="16" src="figuras/principal/icon_info.png" title="Usando" alt="Usando" border="0"></span> <b>Usando Agora</b></a></div>

<div id="minha_conta_itens" <?php if ($_COOKIE["mcitens"] == 1) { ?>style="display: block"<?php } else { ?>style="display: none"<?php } ?>>

<?php if ($mc_energia == 1) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/energia.png" title="Energia" alt="Energia"></span> Energia</div>

<?php } ?>

<?php if ($mc_sacola == 1) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/sacola.png" title="Sacola" alt="Sacola"></span> Sacola</div>

<?php } ?>

<?php if ($mc_veneno == 1) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/veneno.png" title="Veneno" alt="Veneno"></span> Veneno</div>

<?php } ?>

<?php if ($mc_escudo == 1) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/escudo.png" title="Escudo" alt="Escudo"></span> Escudo</div>

<?php } ?>

<?php if ($mc_energia == 0 and $mc_sacola == 0 and $mc_veneno == 0 and $mc_escudo == 0) { ?>

<div id="linha10">Nenhum ítem em uso.</div>

<?php } ?>

</div>

<div id="linha10"><b>Hora:</b> <?=number_format($mc_gols_hora,0,',','.')?></div>
<div id="linha10"><b>Rodada:</b> <?=number_format($mc_gols_rodada,0,',','.')?></div>
<div id="linha10"><b>Temporada:</b> <?=number_format($mc_gols_temporada,0,',','.')?></div>
<div id="linha10"><b>Total:</b> <?=number_format($mc_gols_total,0,',','.')?></div>

<div style="padding-top: 15px"><span class="img16"><img width="16" height="16" src="figuras/principal/dinheiro.png" title="Dinheiro" alt="Dinheiro"></span> <?=number_format($mc_dinheiro,0,',','.')?></div>

<div id="linha10"><a href="mensagens.php"><span class="img16"><img width="16" height="16" src="figuras/principal/mensagens.png" title="Mensagens" alt="Mensagens" border="0"></span> <b><?=$mensagens_quantidade?></b> <?php if ($mensagens_quantidade == 1) { ?> mensagem<?php } else { ?>mensagens<?php } ?></a></div>

<? if ($mc_desafios == 1) { ?>

<div id="linha10"><a href="desafios.php"><span class="img16"><img width="16" height="16" src="figuras/principal/desafios.png" title="Desafios" alt="Desafios" border="0"></span> <b><?=$desafios_quantidade?></b> <?php if ($desafios_quantidade == 1) { ?> desafio<?php } else { ?> desafios<?php } ?></a></div>

<?php } ?>

<?php if ($mc_propostas == 1) { ?>

<div id="linha10"><a href="propostas.php"><span class="img16"><img width="16" height="16" src="figuras/principal/propostas.png" title="Propostas" alt="Propostas" border="0"></span> <b><?=$propostas_quantidade?></b>  <?php if ($propostas_quantidade == 1) { ?> proposta<?php } else { ?> propostas<?php } ?></a></div>

<?php } ?>

<?php if ($mc_renovar == 1) { ?>

<div id="linha10"><a href="propostas.php"><span class="img16"><img width="16" height="16" src="figuras/principal/propostas.png" title="Propostas" alt="Propostas" border="0"></span> <b><?=$renovar_quantidade?></b>  <?php if ($renovar_quantidade == 1) { ?> renovar<?php } else { ?> renovar<?php } ?></a></div>

<?php } ?>

<div id="linha10"><a href="amigos.php"><span class="img16"><img width="16" height="16" src="figuras/principal/amigos.png" title="Amigos" alt="Amigos" border="0"></span> <b><?=$amigos_quantidade?></b> <?php if ($amigos_quantidade == 1) { ?> amigo<?php } else { ?> amigos<?php } ?></a></div>

<div id="linha10"><a href="convidados.php"><span class="img16"><img width="16" height="16" src="figuras/principal/convidados.png" title="Convidados" alt="Convidados" border="0"></span> <b><?=$convidados_quantidade?></b> <?php if ($convidados_quantidade == 1) { ?> convidado<?php } else { ?> convidados<?php } ?></a></div>