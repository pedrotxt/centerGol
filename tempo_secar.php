<?php include_once("fun_anti_inj.php") ?>
<?php include("verificar_cookie.php") ?>
<?php include("conexao.php") ?>
<?php include("verificar_conexao.php") ?>
<?php
function TimeID2($id){
	$r=mysql_fetch_array(mysql_query("select * from Times where ID='".$id."'"));
	return $r['ID2'];
}

$query = mysql_query("SELECT ID, Secar_Tempo, VIP_Tempo, Secar_Gols, Secar FROM Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$rs = mysql_fetch_array($query);

$mc_id = $rs["ID"];
$mc_tempo_secar = $rs["Secar_Tempo"];
$mc_vip_tempo = $rs["VIP_Tempo"];
$usuario_secar = TimeID2($rs["Secar"]);
$usuario_secar_gols = $rs["Secar_Gols"];
?>

<?php
if ($mc_tempo_secar <= date("Y-m-d H:i:s")) {

$sql = mysql_query("CALL Secar_Salvar(". $mc_id .",@mc_vip,@mc_veneno)");
$reg = mysql_query("SELECT @mc_vip,@mc_veneno");
$rs = mysql_fetch_array($reg);

$mc_vip = $rs[0];
$mc_veneno = $rs[1];

if ($mc_vip_tempo > time() and $mc_veneno > 0) {
	$tempo_secar = date("Y-m-d H:i:s", strtotime("+8 mins"));
} else if ($mc_vip_tempo > time() and $mc_veneno == 0) {
	$tempo_secar = date("Y-m-d H:i:s", strtotime("+9 mins"));
} else {
	$tempo_secar = date("Y-m-d H:i:s", strtotime("+10 mins"));
}
$query = mysql_query("SELECT Rodada FROM Configuracoes");
$rs = mysql_fetch_array($query);

$rodada = $rs["Rodada"];

if ($usuario_secar != 0) {
	
mysql_query("UPDATE Usuarios SET Secar_Gols = '". ($usuario_secar_gols+1) ."' WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$a=mysql_fetch_array(mysql_query("select Time_1,Time_2,Rodada,Placar_1,Placar_2 from Jogos where Time_1 = {$usuario_secar} and Rodada = {$rodada} or Time_2 = {$usuario_secar} and Rodada = {$rodada}"));

if($a['Time_1'] ==  $usuario_secar){
mysql_query("update Jogos set Placar_2 ='".($a['Placar_2']+1)."' where Time_1 = {$usuario_secar} and Rodada = {$rodada}");

}else{
mysql_query("update Jogos set Placar_1 ='".($a['Placar_1']+1)."' where Time_2 = {$usuario_secar} and Rodada = {$rodada}");

}
}


mysql_query("UPDATE Usuarios SET Secar_Tempo = '". $tempo_secar ."' WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
}
?>

<?php
$query = mysql_query("SELECT Secar_Tempo, Secar FROM Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$rs = mysql_fetch_array($query);

$mc_secar = $rs["Secar"];
$mc_tempo_secar = $rs["Secar_Tempo"];
$tempo = explode(" ", $mc_tempo_secar);
$mc_tempo_secar = $tempo[1];
$tempo = explode(":", $mc_tempo_secar);

$hora = $tempo[0];
$minuto = $tempo[1];
$segundo = $tempo[2];
?>

<?php if ($mc_secar != 0) { ?>

<script language="javascript">
var ts_hora_futuro = <?=$hora?>;
var ts_hora_hoje = <?=date("H")?>;

if (ts_hora_futuro < ts_hora_hoje) { ts_hora_futuro = ts_hora_futuro + 24; }

var ts_horas = ts_hora_futuro - ts_hora_hoje;
var ts_horas = ts_horas * 60;
var ts_horas = ts_horas * 60;
var ts_minutos = <?=$minuto - date("i")?>;
var ts_minutos = ts_minutos * 60;
var ts_segundos = <?=$segundo - date("s")?>;

var tempo_secar = ts_horas + ts_minutos + ts_segundos;

temp_secar();

function temp_secar() {
	if (tempo_secar > 0) {
		document.getElementById("tempo_secar").innerHTML = conv(parseInt(tempo_secar % 3600 / 60)) + ":" + conv(parseInt(tempo_secar % 60));
		tempo_secar = tempo_secar - 1;
		timesecar = setTimeout("temp_secar()", 1000);
	}
	else {
		document.getElementById('tempo_secar').innerHTML = 'Computando...';
		ajaxGet('tempo_secar.php',"document.getElementById('tempo_secar').innerHTML", false);
	}
}
</script>

<?php } else { ?>

<script type="text/javascript">
clearTimeout(timesecar);
</script>

<strong style="color:#FFF; font:Arial, Helvetica, sans-serif ;font-size:12px;">Selecione</strong>

<?php } ?>