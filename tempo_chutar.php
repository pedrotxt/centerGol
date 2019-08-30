<?php include_once("fun_anti_inj.php") ?>
<?php include("verificar_cookie.php") ?>
<?php include("conexao.php") ?>
<?php include("verificar_conexao.php") ?>
<?php
$query = mysql_query("SELECT ID, Chutar_Tempo, Comemoracao, Nivel, Time, VIP_Tempo, Energia FROM Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$rs = mysql_fetch_array($query);

$mc_id = $rs["ID"];
$mc_tempo_chutar = $rs["Chutar_Tempo"];
$mc_comemoracao = $rs["Comemoracao"];
$mc_nivel = $rs["Nivel"];
$mc_vip = $rs["VIP_Tempo"];
$mc_energia = $rs["Energia"];
$mc_time = $rs["Time"];

?>

<?php if ($mc_tempo_chutar <= date("Y-m-d H:i:s")) { ?>

<?php

if ($mc_vip > time() and $mc_energia > 0) {
	$tempo_chutar = date("Y-m-d H:i:s", strtotime("+3 mins"));
} else if ($mc_vip > time() and $mc_energia == 0) {
	$tempo_chutar = date("Y-m-d H:i:s", strtotime("+4 mins"));
} else {
	$tempo_chutar = date("Y-m-d H:i:s", strtotime("+8 mins"));
}
$query = mysql_query("SELECT Rodada, Dinheiro_Chutar, Convite, Status FROM Configuracoes");
$rs = mysql_fetch_array($query);

$rodada = $rs["Rodada"];
$dinheiro = $rs["Dinheiro_Chutar"];
$convite = $rs["Convite"];
$status = $rs["Status"];

mysql_query("UPDATE Configuracoes SET Gols_Rodada = Gols_Rodada + 1, Gols_Temporada = Gols_Temporada + 1, Gols_Total = Gols_Total + 1 FROM Configuracoes");
$mc_ip = $_SERVER["REMOTE_ADDR"];

mysql_query("UPDATE Usuarios SET Chutar_Tempo = '". $tempo_chutar ."', IP = '". $mc_ip ."', Gols_Hora = Gols_Hora + 1, Gols_Rodada = Gols_Rodada + 1, Gols_Temporada = Gols_Temporada + 1, Gols_Total = Gols_Total + 1, Gols_Time = Gols_Time + 1, Dinheiro = Dinheiro + '". $dinheiro ."' WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
if ($status == 0) {

$query = mysql_query("SELECT ID2 FROM Times WHERE ID = '". $mc_time ."'");
$rs = mysql_fetch_array($query);

$mc_time_id2 = $rs["ID2"];

$query = mysql_query("SELECT ID, Time_1 FROM Jogos WHERE Rodada = '". $rodada ."' AND Time_1 = '". $mc_time_id2 ."' OR Rodada = '". $rodada ."' AND Time_2 = '". $mc_time_id2 ."'");
$rs = mysql_fetch_array($query);

$jogo_id = $rs["ID"];
$jogo_time_1 = $rs["Time_1"];

if ($mc_time_id2 == $jogo_time_1) {
	mysql_query("UPDATE Jogos SET Placar_1 = Placar_1 + 1 WHERE ID = '". $jogo_id ."'");
} else {
	mysql_query("UPDATE Jogos SET Placar_2 = Placar_2 + 1 WHERE ID = '". $jogo_id ."'");
}

}
$mc_nivel_ver = $mc_nivel + 1;

$query = mysql_query("SELECT Gols FROM Niveis WHERE Nivel = '". $mc_nivel_ver ."'");
$rs = mysql_fetch_array($query);

$mc_nivel_gols = $rs["Gols"];

$query = mysql_query("SELECT Gols_Hora, Gols_Hora_Record, Gols_Rodada, Gols_Rodada_Record, Gols_Temporada, Gols_Temporada_Record, Gols_Total, Convite FROM Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$rs = mysql_fetch_array($query);

$gols_hora = $rs["Gols_Hora"];
$gols_hora_record = $rs["Gols_Hora_Record"];
$gols_rodada = $rs["Gols_Rodada"];
$gols_rodada_record = $rs["Gols_Rodada_Record"];
$gols_temporada = $rs["Gols_Temporada"];
$gols_temporada_record = $rs["Gols_Temporada_Record"];
$gols_total = $rs["Gols_Total"];
$convite_id = $rs["Convite"];

$mc_nivel_gols = $mc_nivel_gols - $gols_total;

if ($mc_nivel_gols <= 0) {
	$mc_nivel = $mc_nivel + 1;
	$acao = "passou de nível.";
	mysql_query("INSERT INTO Historico (Usuario,Tipo,Acao) VALUES ('". $mc_id ."',18,'". $acao ."')");
}

if ($gols_hora > $gols_hora_record) {
	$gols_hora_record = $gols_hora;
}

if ($gols_rodada > $gols_rodada_record) {
	$gols_rodada_record = $gols_rodada;
}

if ($gols_temporada > $gols_temporada_record) {
	$gols_temporada_record = $gols_temporada;
}

mysql_query("UPDATE Usuarios SET Nivel = '". $mc_nivel ."', Gols_Hora_Record = '". $gols_hora_record ."', Gols_Rodada_Record = '". $gols_rodada_record ."', Gols_Temporada_Record = '". $gols_temporada_record ."' WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");

if ($gols_total == 10 and $convite_id != 0) {
	mysql_query("UPDATE Usuarios SET Dinheiro = Dinheiro + '". $convite ."' WHERE ID = '". $convite_id ."'");
}
?>



<?php /* if ($mc_clone == 0) { ?> 

<?php
$query = mysql_query("SELECT Count(ID) AS usuario_clones FROM Usuarios WHERE Status = 1 AND IP = '". $mc_ip ."'");
$rs = mysql_fetch_array($query);

$mc_clones = $rs["usuario_clones"];
?>

<?php if ($mc_clones > $clones) { ?>

<script type="text/javascript">
location.href='logout.php?id=1';
</script> 

<?php } ?>

<?php }


*/
?>



<?php if ($mc_comemoracao == 0) { ?> 

<script language="javascript">
gol();
</script>

<?php } else { ?>

<script language="javascript">
gol_comemoracao();
</script>

<?php } ?>

<?php } ?>

<?php
$query = mysql_query("SELECT Chutar_Tempo FROM Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$rs = mysql_fetch_array($query);

$mc_tempo_chutar = $rs["Chutar_Tempo"];
$tempo = explode(" ", $mc_tempo_chutar);
$mc_tempo_chutar = $tempo[1];
$tempo = explode(":", $mc_tempo_chutar);

$hora = $tempo[0];
$minuto = $tempo[1];
$segundo = $tempo[2];
?>

<script language="javascript">
var tc_hora_futuro = <?=$hora?>;
var tc_hora_hoje = <?=date("H")?>;

if (tc_hora_futuro < tc_hora_hoje) { tc_hora_futuro = tc_hora_futuro + 24; }

var tc_horas = tc_hora_futuro - tc_hora_hoje;
var tc_horas = tc_horas * 60;
var tc_horas = tc_horas * 60;
var tc_minutos = <?=$minuto - date("i")?>;
var tc_minutos = tc_minutos * 60;
var tc_segundos = <?=$segundo - date("s")?>;

var tempo_chutar = tc_horas + tc_minutos + tc_segundos;

temp_chutar();

function temp_chutar() {
	if (tempo_chutar > 0) {
		document.getElementById("tempo_chutar").innerHTML = conv(parseInt(tempo_chutar % 3600 / 60)) + ":" + conv(parseInt(tempo_chutar % 60));
		tempo_chutar = tempo_chutar - 1;
		setTimeout("temp_chutar()", 1000);
	}
	else {
		document.getElementById('tempo_chutar').innerHTML = 'Computando...';
		ajaxGet('tempo_chutar.php',"document.getElementById('tempo_chutar').innerHTML", false);
	}
}
</script>