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


<script language="javascript">
function somente_numeros(evt) {

var key_code = evt.keyCode  ? evt.keyCode  :
				evt.charCode ? evt.charCode :
				evt.which    ? evt.which    : void 0;

if (key_code == 8 ||  key_code == 9 ||  key_code == 13 || key_code == 48 ||  key_code == 49 ||  key_code == 50 ||  key_code == 51 ||  key_code == 52 ||  key_code == 53 ||  key_code == 54 ||  key_code == 55 ||  key_code == 56 ||  key_code == 57) { return true; }

return false;

}

function valida_usar_sorte() {

if (document.usar_sorte.q.value=="") {
	alert("É necessário preencher a quantidade.");
	document.usar_sorte.q.focus();
	return false;
}

if (document.usar_sorte.q.value==0) {
	alert("É necessário preencher uma quantidade maior.");
	document.usar_sorte.q.focus();
	return false;
}

if (document.usar_sorte.q.value>1000) {
	alert("É necessário preencher uma quantidade menor.");
	document.usar_sorte.q.focus();
	return false;
}

}

itensinfo = 0;
</script>

<?php
$query = mysql_query("SELECT Item_Sorte, Item_Pedra, Item_Energia, Item_Veneno, Item_Sacola, Item_Escudo, Energia_Tempo, Veneno_Tempo, Sacola_Tempo, Escudo_Tempo, VIP, Item_Chuteoff, Chuteoff_Tempo, Chuteoff FROM Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$rs = mysql_fetch_array($query);

$quantidade_sorte = $rs["Item_Sorte"];
$quantidade_pedra = $rs["Item_Pedra"];
$quantidade_energia = $rs["Item_Energia"];
$quantidade_veneno = $rs["Item_Veneno"];
$quantidade_sacola = $rs["Item_Sacola"];
$quantidade_escudo = $rs["Item_Escudo"];
$quantidade_chuteoff = $rs["Item_Chuteoff"];
$tempo_energia = $rs["Energia_Tempo"];
$tempo_veneno = $rs["Veneno_Tempo"];
$tempo_sacola = $rs["Sacola_Tempo"];
$tempo_escudo = $rs["Escudo_Tempo"];
$mc_vip_itens =$rs["VIP"];
$tempo_chuteoff =$rs["Chuteoff_Tempo"];
$mc_chuteoff = $rs["Chuteoff"];
?>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Meus Ítens</h1></div></div></div>
	<div class="conteudo">

<?php if (anti_inj($_GET["msg_itens"]) == 1) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Você não tem essa quantidade!</div>

<?php } else if (anti_inj($_GET["msg_itens"]) == 2) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_sim.png"></span> Sorte usada com sucesso! <? echo $_POST['vips']; ?></div>

<?php } else if (anti_inj($_GET["msg_itens"]) == 3) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Limite de 1.000 Sortes!</div>

<?php } else if (anti_inj($_GET["msg_itens"]) == 4) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_sim.png"></span> Energia usada com sucesso!</div>

<?php } else if (anti_inj($_GET["msg_itens"]) == 5) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Você não é VIP!</div>

<?php } else if (anti_inj($_GET["msg_itens"]) == 8) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_sim.png"></span> Sacola usada com sucesso!</div>

<?php } else if (anti_inj($_GET["msg_itens"]) == 10) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_sim.png"></span> Veneno usado com sucesso!</div>

<?php } else if (anti_inj($_GET["msg_itens"]) == 11) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Você não está Secando nenhum time!</div>

<?php } else if (anti_inj($_GET["msg_itens"]) == 13) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_sim.png"></span> Escudo usado com sucesso!</div>

<?php }else if (anti_inj($_GET["msg_itens"]) == 14) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_sim.png"></span> Você usou <?= $_POST['vips'] ?> dias de vip.</div>

<?php }else if (anti_inj($_GET["msg_itens"]) == 15) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_sim.png"></span> Chute OFF usado com sucesso!</div>

<?php } ?>

<div id="linha10">
<table width="550" cellpadding="0" cellspacing="0">
	<tr height="25" bgcolor="#B6B6B6">
		<td width="100" style="padding-left: 22px" class="fonte1_negrito">Ítem</td>
		<td width="150" class="fonte1_negrito" align="center">Quantidade</td>
		<td width="190" class="fonte1_negrito" align="center">Usar</td>
        <td width="110">&nbsp;</td>
	</tr>

<form name="usar_sorte" method="post" action="itens_usar_sorte.php" onSubmit="return valida_usar_sorte()">
	<tr>
		<td style="padding-top: 5px"><span class="img16"><img width="16" height="16" src="figuras/principal/sorte.png" title="Sorte" alt="Sorte"></span> <b>Sorte</b> <a href="#" class="balao"><span class="img16"><img width="16" height="16" src="figuras/principal/icon_sobre.png"></span><span class="balao" style="width: 201px">Ajuda seu acerto no Passe Certo.</span></a></td>
		<td style="padding-top: 5px" align="center"><?=number_format($quantidade_sorte,0,',','.')?></td>
		<td style="padding-top: 5px" align="center"><input name="q" type="text" maxlength="4" value="1" style="width: 40px; height: 20px; text-align: center" onKeyPress="return somente_numeros(event);"></td>
        <td style="padding-top: 5px"><input name="submit" type="image" src="figuras/principal/botao_usar.png" onClick="return valida_usar_sorte()"></td>
	</tr>
</form>

	<tr>
		<td style="padding-top: 5px"><span class="img16"><img width="16" height="16" src="figuras/principal/energia.png" title="Energia" alt="Energia"></span> <b>Energia</b> <a href="#" class="balao"><span class="img16"><img width="16" height="16" src="figuras/principal/icon_sobre.png"></span><span class="balao" style="width: 249px">Reduz 1 minuto no seu Tempo de Chute.</span></a></td>
		<td style="padding-top: 5px" align="center"><?=number_format($quantidade_energia,0,',','.')?></td>
		<td style="padding-top: 5px" align="center">-</td>
        <td style="padding-top: 5px"><a href="itens_usar_energia.php"><img src="figuras/principal/botao_usar.png" title="Usar" alt="Usar" border="0"></a></td>
	</tr>

	<tr>
		<td style="padding-top: 5px"><span class="img16"><img width="16" height="16" src="figuras/principal/veneno.png" title="Veneno" alt="Veneno"></span> <b>Veneno</b> <a href="#" class="balao"><span class="img16"><img width="16" height="16" src="figuras/principal/icon_sobre.png"></span><span class="balao" style="width: 248px">Reduz 1 minuto no seu Tempo de Secar.</span></a></td>
		<td style="padding-top: 5px" align="center"><?=number_format($quantidade_veneno,0,',','.')?></td>
		<td style="padding-top: 5px" align="center">-</td>
        <td style="padding-top: 5px"><a href="itens_usar_veneno.php"><img src="figuras/principal/botao_usar.png" title="Usar" alt="Usar" border="0"></a></td>
	</tr>

	<tr>
		<td style="padding-top: 5px"><span class="img16"><img width="16" height="16" src="figuras/principal/sacola.png" title="Sacola" alt="Sacola"></span> <b>Sacola</b> <a href="#" class="balao"><span class="img16"><img width="16" height="16" src="figuras/principal/icon_sobre.png"></span><span class="balao" style="width: 275px">Acumula 2 chances em cada Entretenimento.</span></a></td>
		<td style="padding-top: 5px" align="center"><?=number_format($quantidade_sacola,0,',','.')?></td>
		<td style="padding-top: 5px" align="center">-</td>
        <td style="padding-top: 5px"><a href="itens_usar_sacola.php"><img src="figuras/principal/botao_usar.png" title="Usar" alt="Usar" border="0"></a></td>
	</tr>

	<tr>
		<td style="padding-top: 5px"><span class="img16"><img width="16" height="16" src="figuras/principal/escudo.png" title="Escudo" alt="Escudo"></span> <b>Escudo</b> <a href="#" class="balao"><span class="img16"><img width="16" height="16" src="figuras/principal/icon_sobre.png"></span><span class="balao" style="width: 221px">Impede que joguem Pedra em você.</span></a></td>
		<td style="padding-top: 5px" align="center"><?=number_format($quantidade_escudo,0,',','.')?></td>
		<td style="padding-top: 5px" align="center">-</td>
        <td style="padding-top: 5px"><a href="itens_usar_escudo.php"><img src="figuras/principal/botao_usar.png" title="Usar" alt="Usar" border="0"></a></td>
	</tr>

	<tr>
		<td style="padding-top: 5px"><span class="img16"><img width="16" height="16" src="figuras/principal/pedra.png" title="Pedra" alt="Pedra"></span> <b>Pedra</b> <a href="#" class="balao"><span class="img16"><img width="16" height="16" src="figuras/principal/icon_sobre.png"></span><span class="balao" style="width: 192px">Tira Sorte do usuário escolhido.</span></a></td>
		<td style="padding-top: 5px" align="center"><?=number_format($quantidade_pedra,0,',','.')?></td>
		<td style="padding-top: 5px" align="center">-</td>
        <td style="padding-top: 5px"><img src="figuras/principal/botao_usar_falso.png" title="Usar" alt="Usar"></td>
	</tr>
    <form name="usar_vip" method="post" action="itens_usar_vip.php" onSubmit="return valida_usar_vip()">
	<tr>
		<td style="padding-top: 5px"><span class="img16"><img width="16" height="16" src="figuras/principal/usuario_vip.png" title="Conta VIP" alt="Conta VIP"></span> <b>VIP</b> <a href="#" class="balao"><span class="img16"><img width="16" height="16" src="figuras/principal/icon_sobre.png"></span><span class="balao" style="width: 192px">Você pode guardar ou usar o VIP Quando quiser!</span></a></td>
		<td style="padding-top: 5px" align="center"><?=number_format($mc_vip_itens,0,',','.')?></td>
		<td style="padding-top: 5px" align="center"><input name="vips" type="text" maxlength="4" value="1" style="width: 40px; height: 20px; text-align: center" onKeyPress="return somente_numeros(event);"></td>
        <td style="padding-top: 5px"><input name="submit" type="image" src="figuras/principal/botao_usar.png" onClick="return valida_usar_vip()"></td>
	</tr>
      </form>
    <form name="usar_chuteoff" method="post" action="itens_usar_chuteoff.php" onSubmit="return valida_usar_chuteoff()">

   <tr>
		<td style="padding-top: 5px"><span class="img16"><img width="16" height="16" src="figuras/principal/iconbool.png" title="Conta VIP" alt="Conta VIP"></span> <b>Chute Off</b> <a href="#" class="balao"><span class="img16"><img width="16" height="16" src="figuras/principal/icon_sobre.png"></span><span class="balao" style="width: 192px">Chute Offline é um Item que faz você chutar automatico enquanto você está offline se você precisa sair ou está no trabalho esse item chuta automatico para você mesmo Offline!</span></a></td>
		<td style="padding-top: 5px" align="center"><?=number_format($quantidade_chuteoff,0,',','.')?></td>
		<td style="padding-top: 5px" align="center">-</td>
        <td style="padding-top: 5px"><a href="itens_usar_chuteoff.php"><img src="figuras/principal/botao_usar.png" title="Usar" alt="Usar" border="0"></td>
	</tr>

 </form>

</table>
</div>
<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/seta1.png"></span> <a href="itens_comprar.php"><b>Comprar Ítens</b></a></div>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<div id="divide"></div>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Usando Agora</h1></div></div></div>
	<div class="conteudo">

<?php if ($mc_energia != 0 or $mc_veneno != 0 or $mc_sacola != 0 or $mc_escudo != 0 or $mc_chuteoff != 0) { ?>

<div id="linha10">
<table width="550" cellpadding="0" cellspacing="0">
	<tr height="25" bgcolor="#B6B6B6">
		<td width="140" style="padding-left: 22px" class="fonte1_negrito">Ítem</td>
		<td width="410" class="fonte1_negrito">Tempo Restante</td>
	</tr>

<?php if ($mc_energia != 0) { ?>

	<tr>
		<td style="padding-top: 15px"><span class="img16"><img width="16" height="16" src="figuras/principal/energia.png" title="Energia" alt="Energia"></span> <b>Energia</b></td>
		<td style="padding-top: 15px"><span id="tempo_energia">00:00:00</span></td>
	</tr>

<?php
$tempo_energia_ex = explode(" ", $tempo_energia);
$tempo_energia_dia = $tempo_energia_ex[0];
$tempo_energia_hora = $tempo_energia_ex[1];

$tempo_energia_ex = explode("-", $tempo_energia_dia);
$tempo_energia_dia = $tempo_energia_ex[2];

$tempo_energia_ex = explode(":", $tempo_energia_hora);
$tempo_energia_hora = $tempo_energia_ex[0];
$tempo_energia_minuto = $tempo_energia_ex[1];
$tempo_energia_segundo = $tempo_energia_ex[2];
?>

<script language="javascript">
var tenergia_dia_futuro = <?=$tempo_energia_dia?>;
var tenergia_dia_hoje = <?=date("d")?>;

var tenergia_hora_futuro = <?=$tempo_energia_hora?>;
var tenergia_hora_hoje = <?=date("H")?>;

if (tenergia_dia_futuro != tenergia_dia_hoje) { tenergia_hora_futuro = tenergia_hora_futuro + 24; }

var tenergia_horas = tenergia_hora_futuro - tenergia_hora_hoje;
var tenergia_horas = tenergia_horas * 60 * 60;
var tenergia_minutos = <?=$tempo_energia_minuto - date("i")?>;
var tenergia_minutos = tenergia_minutos * 60;
var tenergia_segundos = <?=$tempo_energia_segundo - date("s")?>;

var tempo_energia = tenergia_horas + tenergia_minutos + tenergia_segundos;

temp_energia();

function temp_energia() {
	if (tempo_energia > 0) {
		document.getElementById("tempo_energia").innerHTML = conv(parseInt(tempo_energia / 3600)) + ":" + conv(parseInt(tempo_energia % 3600 / 60)) + ":" + conv(parseInt(tempo_energia % 60));
		tempo_energia = tempo_energia - 1;
		setTimeout("temp_energia()", 1000);
	}
	else {
		document.getElementById('tempo_energia').innerHTML = 'Acabando...';
	}
}
</script>

<?php } ?>

<?php if ($mc_veneno != 0) { ?>

	<tr>
		<td style="padding-top: 15px"><span class="img16"><img width="16" height="16" src="figuras/principal/veneno.png" title="Veneno" alt="Veneno"></span> <b>Veneno</b></td>
		<td style="padding-top: 15px"><span id="tempo_veneno">00:00:00</span></td>
	</tr>

<?php
$tempo_veneno_ex = explode(" ", $tempo_veneno);
$tempo_veneno_dia = $tempo_veneno_ex[0];
$tempo_veneno_hora = $tempo_veneno_ex[1];

$tempo_veneno_ex = explode("-", $tempo_veneno_dia);
$tempo_veneno_dia = $tempo_veneno_ex[2];

$tempo_veneno_ex = explode(":", $tempo_veneno_hora);
$tempo_veneno_hora = $tempo_veneno_ex[0];
$tempo_veneno_minuto = $tempo_veneno_ex[1];
$tempo_veneno_segundo = $tempo_veneno_ex[2];
?>

<script language="javascript">
var tveneno_dia_futuro = <?=$tempo_veneno_dia?>;
var tveneno_dia_hoje = <?=date("d")?>;

var tveneno_hora_futuro = <?=$tempo_veneno_hora?>;
var tveneno_hora_hoje = <?=date("H")?>;

if (tveneno_dia_futuro != tveneno_dia_hoje) { tveneno_hora_futuro = tveneno_hora_futuro + 24; }

var tveneno_horas = tveneno_hora_futuro - tveneno_hora_hoje;
var tveneno_horas = tveneno_horas * 60 * 60;
var tveneno_minutos = <?=$tempo_veneno_minuto - date("i")?>;
var tveneno_minutos = tveneno_minutos * 60;
var tveneno_segundos = <?=$tempo_veneno_segundo - date("s")?>;

var tempo_veneno = tveneno_horas + tveneno_minutos + tveneno_segundos;

temp_veneno();

function temp_veneno() {
	if (tempo_veneno > 0) {
		document.getElementById("tempo_veneno").innerHTML = conv(parseInt(tempo_veneno / 3600)) + ":" + conv(parseInt(tempo_veneno % 3600 / 60)) + ":" + conv(parseInt(tempo_veneno % 60));
		tempo_veneno = tempo_veneno - 1;
		setTimeout("temp_veneno()", 1000);
	}
	else {
		document.getElementById('tempo_veneno').innerHTML = 'Acabando...';
	}
}
</script>

<?php } ?>

<?php if ($mc_sacola != 0) { ?>

	<tr>
		<td style="padding-top: 15px"><span class="img16"><img width="16" height="16" src="figuras/principal/sacola.png" title="Sacola" alt="Sacola"></span> <b>Sacola</b></td>
		<td style="padding-top: 15px"><span id="tempo_sacola">00:00:00</span></td>
	</tr>

<?php
$tempo_sacola_ex = explode(" ", $tempo_sacola);
$tempo_sacola_dia = $tempo_sacola_ex[0];
$tempo_sacola_hora = $tempo_sacola_ex[1];

$tempo_sacola_ex = explode("-", $tempo_sacola_dia);
$tempo_sacola_dia = $tempo_sacola_ex[2];

$tempo_sacola_ex = explode(":", $tempo_sacola_hora);
$tempo_sacola_hora = $tempo_sacola_ex[0];
$tempo_sacola_minuto = $tempo_sacola_ex[1];
$tempo_sacola_segundo = $tempo_sacola_ex[2];
?>

<script language="javascript">
var tsacola_dia_futuro = <?=$tempo_sacola_dia?>;
var tsacola_dia_hoje = <?=date("d")?>;

var tsacola_hora_futuro = <?=$tempo_sacola_hora?>;
var tsacola_hora_hoje = <?=date("H")?>;

if (tsacola_dia_futuro != tsacola_dia_hoje) { tsacola_hora_futuro = tsacola_hora_futuro + 24; }

var tsacola_horas = tsacola_hora_futuro - tsacola_hora_hoje;
var tsacola_horas = tsacola_horas * 60 * 60;
var tsacola_minutos = <?=$tempo_sacola_minuto - date("i")?>;
var tsacola_minutos = tsacola_minutos * 60;
var tsacola_segundos = <?=$tempo_sacola_segundo - date("s")?>;

var tempo_sacola = tsacola_horas + tsacola_minutos + tsacola_segundos;

temp_sacola();

function temp_sacola() {
	if (tempo_sacola > 0) {
		document.getElementById("tempo_sacola").innerHTML = conv(parseInt(tempo_sacola / 3600)) + ":" + conv(parseInt(tempo_sacola % 3600 / 60)) + ":" + conv(parseInt(tempo_sacola % 60));
		tempo_sacola = tempo_sacola - 1;
		setTimeout("temp_sacola()", 1000);
	}
	else {
		document.getElementById('tempo_sacola').innerHTML = 'Acabando...';
	}
}
</script>

<?php } ?>

<?php if ($mc_escudo != 0) { ?>

	<tr>
		<td style="padding-top: 15px"><span class="img16"><img width="16" height="16" src="figuras/principal/escudo.png" title="Escudo" alt="Escudo"></span> <b>Escudo</b></td>
		<td style="padding-top: 15px"><span id="tempo_escudo">00:00:00</span></td>
	</tr>

<?php
$tempo_escudo_ex = explode(" ", $tempo_escudo);
$tempo_escudo_dia = $tempo_escudo_ex[0];
$tempo_escudo_hora = $tempo_escudo_ex[1];

$tempo_escudo_ex = explode("-", $tempo_escudo_dia);
$tempo_escudo_dia = $tempo_escudo_ex[2];

$tempo_escudo_ex = explode(":", $tempo_escudo_hora);
$tempo_escudo_hora = $tempo_escudo_ex[0];
$tempo_escudo_minuto = $tempo_escudo_ex[1];
$tempo_escudo_segundo = $tempo_escudo_ex[2];
?>

<script language="javascript">
var tescudo_dia_futuro = <?=$tempo_escudo_dia?>;
var tescudo_dia_hoje = <?=date("d")?>;

var tescudo_hora_futuro = <?=$tempo_escudo_hora?>;
var tescudo_hora_hoje = <?=date("H")?>;

if (tescudo_dia_futuro != tescudo_dia_hoje) { tescudo_hora_futuro = tescudo_hora_futuro + 24; }

var tescudo_horas = tescudo_hora_futuro - tescudo_hora_hoje;
var tescudo_horas = tescudo_horas * 60 * 60;
var tescudo_minutos = <?=$tempo_escudo_minuto - date("i")?>;
var tescudo_minutos = tescudo_minutos * 60;
var tescudo_segundos = <?=$tempo_escudo_segundo - date("s")?>;

var tempo_escudo = tescudo_horas + tescudo_minutos + tescudo_segundos;

temp_escudo();

function temp_escudo() {
	if (tempo_escudo > 0) {
		document.getElementById("tempo_escudo").innerHTML = conv(parseInt(tempo_escudo / 3600)) + ":" + conv(parseInt(tempo_escudo % 3600 / 60)) + ":" + conv(parseInt(tempo_escudo % 60));
		tempo_escudo = tempo_escudo - 1;
		setTimeout("temp_escudo()", 1000);
	}
	else {
		document.getElementById('tempo_escudo').innerHTML = 'Acabando...';
	}
}
</script>

<?php } ?>
<?php if ($mc_chuteoff != 0) { ?>

	<tr>
		<td style="padding-top: 15px"><span class="img16"><img width="16" height="16" src="figuras/principal/iconbool.png" title="Chute Offline" alt="Chute Offline"></span> <b>Chute Offline</b></td>
		<td style="padding-top: 15px"><span id="tempo_chuteoff">00:00:00</span></td>
	</tr>

<?php
$tempo_chuteoff_ex = explode(" ", $tempo_chuteoff);
$tempo_chuteoff_dia = $tempo_chuteoff_ex[0];
$tempo_chuteoff_hora = $tempo_chuteoff_ex[1];

$tempo_chuteoff_ex = explode("-", $tempo_chuteoff_dia);
$tempo_chuteoff_dia = $tempo_chuteoff_ex[2];

$tempo_chuteoff_ex = explode(":", $tempo_chuteoff_hora);
$tempo_chuteoff_hora = $tempo_chuteoff_ex[0];
$tempo_chuteoff_minuto = $tempo_chuteoff_ex[1];
$tempo_chuteoff_segundo = $tempo_chuteoff_ex[2];
?>

<script language="javascript">
var tchuteoff_dia_futuro = <?=$tempo_chuteoff_dia?>;
var tchuteoff_dia_hoje = <?=date("d")?>;

var tchuteoff_hora_futuro = <?=$tempo_chuteoff_hora?>;
var tchuteoff_hora_hoje = <?=date("H")?>;

if (tchuteoff_dia_futuro != tchuteoff_dia_hoje) { tchuteoff_hora_futuro = tchuteoff_hora_futuro + 24; }

var tchuteoff_horas = tchuteoff_hora_futuro - tchuteoff_hora_hoje;
var tchuteoff_horas = tchuteoff_horas * 60 * 60;
var tchuteoff_minutos = <?=$tempo_chuteoff_minuto - date("i")?>;
var tchuteoff_minutos = tchuteoff_minutos * 60;
var tchuteoff_segundos = <?=$tempo_chuteoff_segundo - date("s")?>;

var tempo_chuteoff = tchuteoff_horas + tchuteoff_minutos + tchuteoff_segundos;

temp_chuteoff();

function temp_chuteoff() {
	if (tempo_chuteoff > 0) {
		document.getElementById("tempo_chuteoff").innerHTML = conv(parseInt(tempo_chuteoff / 3600)) + ":" + conv(parseInt(tempo_chuteoff % 3600 / 60)) + ":" + conv(parseInt(tempo_chuteoff % 60));
		tempo_chuteoff = tempo_chuteoff - 1;
		setTimeout("temp_chuteoff()", 1000);
	}
	else {
		document.getElementById('tempo_chuteoff').innerHTML = 'Acabando...';
	}
}
</script>


<?php } ?>

</table>
</div>

<?php } else { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Nenhum ítem em uso.</div>

<?php } ?>

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