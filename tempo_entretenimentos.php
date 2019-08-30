<?php include_once("fun_anti_inj.php") ?>
<?php include("verificar_cookie.php") ?>
<?php include("conexao.php") ?>
<?php include("verificar_conexao.php") ?>
<?php
$query = mysql_query("SELECT ID, Entretenimentos_Tempo, Passe_Certo_Tent, Falta_Tent, Penalti_Tent, VIP_Tempo, Secar, Sacola FROM Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$rs = mysql_fetch_array($query);

$mc_id = $rs["ID"];
$mc_tempo_entretenimentos = $rs["Entretenimentos_Tempo"];
$mc_vip = $rs["VIP_Tempo"];
$mc_secar = $rs["Secar"];
$mc_sacola = $rs["Sacola"];
$passe = $rs["Passe_Certo_Tent"];
$falta = $rs["Falta_Tent"];
$penalti = $rs["Penalti_Tent"];
?>

<?php if ($mc_tempo_entretenimentos <= date("Y-m-d H:i:s")) { ?>

<?php

if ($mc_vip > time()) {
	$tempo_entretenimentos = date("Y-m-d H:i:s", strtotime("+4 mins"));
} else {
	$tempo_entretenimentos = date("Y-m-d H:i:s", strtotime("+8 mins"));
}

if($mc_sacola > 0){
	$max_ent = 2;
}else{
	$max_ent = 1;
}
if($mc_sacola > 0 and $passe < 2){
mysql_query("UPDATE Usuarios SET Entretenimentos_Tempo = '". $tempo_entretenimentos ."', Passe_Certo_Tent = Passe_Certo_Tent+1 WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
}elseif($mc_sacola == 0 and $passe < 1){
mysql_query("UPDATE Usuarios SET Entretenimentos_Tempo = '". $tempo_entretenimentos ."', Passe_Certo_Tent = Passe_Certo_Tent+1 WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
}else{
mysql_query("UPDATE Usuarios SET Entretenimentos_Tempo = '". $tempo_entretenimentos ."' WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
}
if($mc_sacola > 0 and $falta < 2){
mysql_query("UPDATE Usuarios SET Entretenimentos_Tempo = '". $tempo_entretenimentos ."', Falta_Tent = Falta_Tent+1 WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");	
}elseif($mc_sacola == 0 and $falta < 1){
mysql_query("UPDATE Usuarios SET Entretenimentos_Tempo = '". $tempo_entretenimentos ."', Falta_Tent = Falta_Tent+1 WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");	
}else{
mysql_query("UPDATE Usuarios SET Entretenimentos_Tempo = '". $tempo_entretenimentos ."' WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
}
if($mc_sacola > 0 and $penalti < 2){
mysql_query("UPDATE Usuarios SET Entretenimentos_Tempo = '". $tempo_entretenimentos ."', Penalti_Tent = Penalti_Tent+1 WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");	
}elseif($mc_sacola == 0 and $penalti < 1){
mysql_query("UPDATE Usuarios SET Entretenimentos_Tempo = '". $tempo_entretenimentos ."', Penalti_Tent = Penalti_Tent+1 WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");	
}else{
mysql_query("UPDATE Usuarios SET Entretenimentos_Tempo = '". $tempo_entretenimentos ."' WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
}

?>

<script language="javascript">
entretenimentos();
</script>

<?php } ?>

<?php
$query = mysql_query("SELECT Entretenimentos_Tempo FROM Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$rs = mysql_fetch_array($query);

$mc_tempo_entretenimentos = $rs["Entretenimentos_Tempo"];
$tempo = explode(" ", $mc_tempo_entretenimentos);
$mc_tempo_entretenimentos = $tempo[1];
$tempo = explode(":", $mc_tempo_entretenimentos);

$hora = $tempo[0];
$minuto = $tempo[1];
$segundo = $tempo[2];
?>

<script language="javascript">
var te_hora_futuro = <?=$hora?>;
var te_hora_hoje = <?=date("H")?>;

if (te_hora_futuro < te_hora_hoje) { te_hora_futuro = te_hora_futuro + 24; }

var te_horas = te_hora_futuro - te_hora_hoje;
var te_horas = te_horas * 60;
var te_horas = te_horas * 60;
var te_minutos = <?=$minuto - date("i")?>;
var te_minutos = te_minutos * 60;
var te_segundos = <?=$segundo - date("s")?>;

var tempo_entretenimentos = te_horas + te_minutos + te_segundos;

temp_entretenimentos();

function temp_entretenimentos() {
	if (tempo_entretenimentos > 0) {
		document.getElementById("tempo_entretenimentos").innerHTML = conv(parseInt(tempo_entretenimentos % 3600 / 60)) + ":" + conv(parseInt(tempo_entretenimentos % 60));
		tempo_entretenimentos = tempo_entretenimentos - 1;
		setTimeout("temp_entretenimentos()", 1000);
	}
	else {
		document.getElementById('tempo_entretenimentos').innerHTML = 'Computando...';
		ajaxGet('tempo_entretenimentos.php',"document.getElementById('tempo_entretenimentos').innerHTML", false);
	}
}
</script>