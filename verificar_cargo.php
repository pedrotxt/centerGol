<?php
if ($_COOKIE["usuarioid"]) {

$query = mysql_query("SELECT ID, Time FROM Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$rs = mysql_fetch_array($query);

$mc_id = $rs["ID"];
$mc_time = $rs["Time"];

$query = mysql_query("SELECT Presidente, Diretor, Olheiro_1, Olheiro_2, Olheiro_3 FROM Times WHERE ID = '". $mc_time ."'");
$rs = mysql_fetch_array($query);

$time_presidente = $rs["Presidente"];
$time_diretor = $rs["Diretor"];
$time_olheiro_1 = $rs["Olheiro_1"];
$time_olheiro_2 = $rs["Olheiro_2"];
$time_olheiro_3 = $rs["Olheiro_3"];

if ($time_presidente == $mc_id) {
	$eu_presidente = 1;
}

if ($time_diretor == $mc_id) {
	$eu_diretor = 1;
}

if ($time_olheiro_1 == $mc_id or $time_olheiro_2 == $mc_id or $time_olheiro_3 == $mc_id) {
	$eu_olheiro = 1;
}

}
?>