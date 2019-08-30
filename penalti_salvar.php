<?php include_once("fun_anti_inj.php") ?>
<?php include("verificar_cookie.php") ?>
<?php include("conexao.php") ?>
<?php include("verificar_conexao.php") ?>
<?php
$cod = anti_inj($_GET['cod']);
$chute = anti_inj($_GET['id']);

if (!$cod or !$chute) {
	header("Location: index.php"); break;
}

if (ereg('[^0-9]',$cod)) {
	header("Location: index.php"); break;
}

if ($cod < 1000 or $cod > 9999) {
	header("Location: index.php"); break;
}

if ($chute != 1 and $chute != 2 and $chute != 3 and $chute != 4 and $chute != 5 and $chute != 6) {
	header("Location: index.php"); break;
}

$query = mysql_query("SELECT Penalti_Cod, Penalti_Tent, ID, Nivel, Time FROM Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$rs = mysql_fetch_array($query);

$mc_cod = $rs["Penalti_Cod"];

if ($cod != $mc_cod) {
	header("Location: index.php"); break;
}

$mc_penalti_tent = $rs["Penalti_Tent"];

if ($mc_penalti_tent == 0) {
	header("Location: index.php"); break;
}

$mc_id = $rs["ID"];
$mc_nivel = $rs["Nivel"];
$mc_time = $rs["Time"];

$penalti_cod = rand(1000,9999);
$goleiro1_conf = rand(1,6);
$goleiro2_conf = rand(1,6);

if ($goleiro1_conf == $goleiro2_conf) {
	$goleiro2_conf = $goleiro2_conf + 1;
}

if ($goleiro2_conf > 6) {
	$goleiro2_conf = 1;
}

$verificar_gol = 1;

if ($chute == $goleiro1_conf or $chute == $goleiro2_conf) {
	$verificar_gol = 0;
}

if ($verificar_gol == 1) {

$query = mysql_query("SELECT Rodada, Dinheiro_Penalti, Convite, Status FROM Configuracoes");
$rs = mysql_fetch_array($query);

$rodada = $rs["Rodada"];
$dinheiro = $rs["Dinheiro_Penalti"];
$convite = $rs["Convite"];
$status = $rs["Status"];

mysql_query("UPDATE Configuracoes SET Gols_Rodada = Gols_Rodada + 1, Gols_Temporada = Gols_Temporada + 1, Gols_Total = Gols_Total + 1 FROM Configuracoes");

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

mysql_query("UPDATE Usuarios SET Gols_Hora = Gols_Hora + 1, Gols_Rodada = Gols_Rodada + 1, Gols_Temporada = Gols_Temporada + 1, Gols_Total = Gols_Total + 1, Gols_Time = Gols_Time + 1, Dinheiro = Dinheiro + '". $dinheiro ."', Penalti = Penalti + 1, Penalti_Acertos = Penalti_Acertos + 1, Penalti_Cod = '". $penalti_cod ."', Penalti_Tent = Penalti_Tent - 1, Status = 1 WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");

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

} else {

mysql_query("UPDATE Usuarios SET Penalti = Penalti + 1, Penalti_Cod = '". $penalti_cod ."', Penalti_Tent = Penalti_Tent - 1, Status = 1 WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");

}

if ($verificar_gol == 1) {
	header("Location: comemoracao.php"); break;
} else {
	header("Location: penalti_erro.php"); break;
}
?>