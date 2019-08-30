
<?php 

function alerta($msg){
	echo "<script charset = \"ISO-8859-1\">window.alert('".strip_tags($msg)."')</script>";
};
include("verificar_ip.php") ?><head>
<title>centergol | a inovação chegou!</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
<meta http-equiv="content-language" content="pt-br">
<meta http-equiv="expires" content="0">
<meta name="description" content="Ajude o seu time do coração! Maior e mais completo portal de futebol online do Brasil, jogue agora mesmo! Dispute compeonatos e vire o verdadeiro craque do seu time. Receba contratos e muito mais.">
<meta name="keywords" content="jogo, online, futebol, campeonato, brasileiro">
<meta name="robots" content="index,follow">
<meta name="author" content="Victor">
<link rel="shortcut icon" href="figuras/principal/header.ico">
<link href="css/style.css" rel="stylesheet" type="text/css">
<link href="css/menu.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/principal.js"></script>
<script type="text/javascript" src="js/flash_object.js"></script>
<script type="text/javascript" src="https://apis.google.com/js/plusone.js">{lang: 'pt-BR'}</script>
</head>
<?php
$query = mysql_query("SELECT Rodada, Temporada, Amistosos FROM Configuracoes");
$rs = mysql_fetch_array($query);
$rodada = $rs["Rodada"];
$amistoso = $rs["Amistosos"];
$temporada = $rs["Temporada"];
?>

<div style="margin-top:29px;"></div>
<div style="background:#000;margin-top:-29px; position:fixed; width:100%; margin-left:-3px; z-index:99;border-radius: 0px 0px 5px 5px;border-top:0px double #ccc;
border-left:3px double #ccc;border-right:3px double #ccc;border-bottom:3px double #ccc;
">
<div align="center" style=" background:#FFFFFF;"><span class="img16"><img width="14" height="14" src="figuras/principal/icon_data.png" title="Torneio" alt="Torneio"></span>

<?php if ($rodada == 0) { ?>
<a href="amistosos.php"><b>Amistosos - Temporada <?=$temporada?></b></a>

<?php } else if ($rodada <= 19) { ?>

<a href="campeonato_fc.php"><b>Brasileirão - Rodada <?=$rodada?> de 19 - Temporada <?=$temporada?></b></a>

<?php } else if ($rodada == 20) { ?>

<a href="copa_brasil.php"><b>Copa Brasil - Primeira Fase - Temporada <?=$temporada?></b></a>

<?php } else if ($rodada == 21) { ?>

<a href="copa_brasil.php"><b>Copa Brasil - Oitavas de Final - Temporada <?=$temporada?></b></a>

<?php } else if ($rodada == 22) { ?>

<a href="copa_brasil.php"><b>Copa Brasil - Quartas de Final - Temporada <?=$temporada?></b></a>

<?php } else if ($rodada == 23) { ?>

<a href="copa_brasil.php"><b>Copa Brasil - Semifinal - Temporada <?=$temporada?></b></a>

<?php } else if ($rodada == 24) { ?>

<a href="copa_brasil.php"><b>Copa Brasil - Final - Temporada <?=$temporada?></b></a>

<?php } else if ($rodada == 25) { ?>

<a href="copa_fc.php"><b>Copa LC - Quartas de Final - Temporada <?=$temporada?></b></a>

<?php } else if ($rodada == 26) { ?>

<a href="copa_fc.php"><b>Copa LC - Semifinal - Temporada <?=$temporada?></b></a>

<?php } else if ($rodada == 27) { ?>

<a href="copa_fc.php"><b>Copa LC - Final - Temporada <?=$temporada?></b></a>

<?php } ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php if($rodada == 0){ ?>
<span class="img16"><img width="14" height="14" src="figuras/principal/icon_data.png" title="Torneio" alt="Torneio"></span> <? if($amistoso <= 1){ ?><b>Proxima rodada comeca o Brasileirão</b> <? }else{ ?> <b>Faltam: <?=$amistoso?> Rodadas para o Brasileirão</b> <? } ?>
<? } ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<span class="img16"><img width="14" height="14" src="figuras/principal/icon_tempo_restante.png" title="Tempo Restante" alt="Tempo Restante"></span> <b>Tempo Restante:</b> <span id="tempo_restante">00:00:00</span>

<script language="javascript">
var tr_horas = <?=23 - date("H")?>;
var tr_horas = tr_horas * 60;
var tr_horas = tr_horas * 60;
var tr_minutos = <?=59 - date("i")?>;
var tr_minutos = tr_minutos * 60;
var tr_segundos = <?=59 - date("s")?>;

var tempo_restante = tr_horas + tr_minutos + tr_segundos;

temp_restante();

function temp_restante() {
	if (tempo_restante > 0) {
		document.getElementById("tempo_restante").innerHTML = conv(parseInt(tempo_restante / 3600)) + ":" + conv(parseInt(tempo_restante % 3600 / 60)) + ":" + conv(parseInt(tempo_restante % 60));
		tempo_restante = tempo_restante - 1;
		setTimeout("temp_restante()", 1000);
	}
	else {
		document.getElementById('tempo_restante').innerHTML = 'Fim da Rodada!';
	}
}
</script>


</div>
</div>

<?php
$query = mysql_query("SELECT Count(ID) AS usuarios_online FROM Usuarios WHERE Status > 0");
$rs = mysql_fetch_array($query);

$usuarios_online = $rs["usuarios_online"];

if ($_COOKIE["usuarioid"]) {

$query = mysql_query("SELECT ID, Usuario, Time, Dinheiro, Status, Gols_Hora, Gols_Rodada, Gols_Temporada, Gols_Total, VIP, VIP_Cor, Nivel, Secar, Energia, Veneno, Sacola, Escudo, Banido, Acessos, Convidados, Comemoracao, Comemoracao_Frase, Som, Propostas, Desafios, Fidelidade, Presidente_Dias, Sexo, Camisa, Valor, Texto, Fundo, Topo, Barra FROM Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$rs = mysql_fetch_array($query);

if (!$rs) {
	die("<br><b>Sua conta foi acessada em outro dispositivo!</b> <meta http-equiv='refresh' content='1; url=logout.php'>");
}

$mc_id = $rs["ID"];
$mc_usuario = $rs["Usuario"];
$mc_tuto = $rs["tutorial"];
$mc_tutovip = $rs["tutorialvip"];
$mc_time = $rs["Time"];
$mc_dinheiro = $rs["Dinheiro"];
$mc_status = $rs["Status"];
$mc_gols_hora = $rs["Gols_Hora"];
$mc_gols_rodada = $rs["Gols_Rodada"];
$mc_gols_temporada = $rs["Gols_Temporada"];
$mc_gols_total = $rs["Gols_Total"];
$mc_vip = $rs["VIP"];
$mc_vip_cor = $rs["VIP_Cor"];
$mc_nivel = $rs["Nivel"];
$mc_secar = $rs["Secar"];
$mc_energia = $rs["Energia"];
$mc_chuteoff = $rs["Chuteoff"];
$mc_veneno = $rs["Veneno"];
$mc_sacola = $rs["Sacola"];
$mc_escudo = $rs["Escudo"];
$mc_banido = $rs["Banido"];
$mc_acessos = $rs["Acessos"];
$mc_convidados = $rs["Convidados"];
$mc_comemoracao = $rs["Comemoracao"];
$mc_comemoracao_frase = $rs["Comemoracao_Frase"];
$mc_som = $rs["Som"];
$mc_propostas = $rs["Propostas"];
$mc_desafios = $rs["Desafios"];
$mc_fidelidade = $rs["Fidelidade"];
$mc_presidente_dias = $rs["Presidente_Dias"];
$mc_sexo = $rs["Sexo"];
$mc_camisa = $rs["Camisa"];
$mc_valor = $rs["Valor"];
$mc_texto = $rs["Texto"];
$mc_fundo = $rs["Fundo"];
$mc_topo = $rs["Topo"];
$mc_barra = $rs["Barra"];

if ($mc_status == 0 or $mc_status == 2) {
	mysql_query("UPDATE Usuarios SET Status = 1 WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
}

$mc_nivel_ver = $mc_nivel + 1;

$query = mysql_query("SELECT Gols FROM Niveis WHERE Nivel = '". $mc_nivel_ver ."'");
$rs = mysql_fetch_array($query);

$mc_nivel_gols = $rs["Gols"];
$mc_nivel_gols = $mc_nivel_gols - $mc_gols_total;

} else {

$mc_fundo = 1;
$mc_topo = 1;
$mc_barra = 1;

}

$tempo = date("Y-m-d H:i:s");
$tempo_resicao = time();

mysql_query("UPDATE Usuarios SET Energia = 0 WHERE Energia_Tempo < '". $tempo ."'");
mysql_query("UPDATE Usuarios SET Sacola = 0 WHERE Sacola_Tempo < '". $tempo ."'");
mysql_query("UPDATE Usuarios SET Veneno = 0 WHERE Veneno_Tempo < '". $tempo ."'");
mysql_query("UPDATE Usuarios SET Escudo = 0 WHERE Escudo_Tempo < '". $tempo ."'");
mysql_query("UPDATE Usuarios SET Chuteoff = 0 WHERE Chuteoff_Tempo < '". $tempo ."'");
mysql_query("UPDATE Usuarios SET Rescisao=0, Rescisao_Dias = 0 WHERE Rescisao_Dias < '". $tempo_resicao ."'");
mysql_query("UPDATE Usuarios SET Rescisao_Dias_VIP = 0 WHERE Rescisao_Dias_VIP < '". $tempo_resicao ."'");


@$r=mysql_fetch_array(mysql_query("select * from Usuarios where Status=2 and Chuteoff=1"));
	
$tempo1 = date("Y-m-d H:i:s", strtotime("-2 mins"));
$r1=mysql_fetch_array(mysql_query("select * from Usuarios WHERE Status = 1 AND Chutar_Tempo < '". $tempo1 ."'"));

if($r1['Chuteoff'] == 1){
mysql_query("UPDATE Usuarios SET Status = 2 WHERE Status = 1 AND Chutar_Tempo < '". $tempo1 ."'");
}else{
mysql_query("UPDATE Usuarios SET Status = 0 WHERE Status = 1 AND Chutar_Tempo < '". $tempo1 ."'");
}


$query=mysql_query("select ID,Time,Presidente_Dias From Usuarios where Presidente_Dias < '".time()."' and Presidente = 1");
while($diasp=mysql_fetch_array($query)){
mysql_query("UPDATE Times SET Presidente = 0 WHERE ID = '". $diasp['Time'] ."'");
mysql_query("UPDATE Usuarios SET Presidente = 0 WHERE ID = '". $diasp['ID']  ."'");
}
?>
<style type="text/css">
body { background-image: url(figuras/principal/fundo<?=$mc_fundo?>.jpg); }
</style>

<div style="display:none;"><script id="_wauv3v">var _wau = _wau || []; _wau.push(["classic", "gcbjgjhb9afr", "v3v"]);
(function() {var s=document.createElement("script"); s.async=true;
s.src="http://widgets.amung.us/classic.js";
document.getElementsByTagName("head")[0].appendChild(s);
})();</script></div>
<?php
function usuarionome($id){
	$r=mysql_fetch_array(mysql_query("select Usuario from Usuarios where ID='".$id."'"));
	return $r['Usuario'];
}
?>