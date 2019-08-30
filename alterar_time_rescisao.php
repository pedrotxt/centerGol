<?php include_once("fun_anti_inj.php") ?>
<?php include("verificar_cookie.php") ?>
<?php include("conexao.php") ?>
<?php include("verificar_conexao.php") ?>
<?php include("verificar_cargo.php") ?>
<?php
if ($eu_presidente == 1 or $eu_diretor == 1 or $eu_olheiro == 1) {
	header("Location: alterar_time.php"); break;
}

$query = mysql_query("SELECT Trocas, Temporada FROM Configuracoes");
$rs = mysql_fetch_array($query);

$trocas_total = $rs["Trocas"];
$temporada = $rs["Temporada"];

$query = mysql_query("SELECT Time, Dinheiro, Trocas, Rescisao, Rescisao_Dias_VIP FROM Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$rs = mysql_fetch_array($query);

$mc_time = $rs["Time"];
$mc_dinheiro = $rs["Dinheiro"];
$mc_trocas = $rs["Trocas"];
$mc_rescisao = $rs["Rescisao"];
$mc_rescisao_dias_vip = $rs["Rescisao_Dias_VIP"];

if ($mc_rescisao == 0) {
	header("Location: alterar_time.php"); break;
}

if ($mc_trocas >= $trocas_total) {
	header("Location: alterar_time.php"); break;
}

if ($mc_rescisao_dias_vip > 0) {
	header("Location: alterar_time.php"); break;
}

if ($mc_dinheiro < $mc_rescisao) {
	header("Location: alterar_time.php?msg_time=1"); break;
}

mysql_query("UPDATE Times SET Dinheiro = Dinheiro + '". $mc_rescisao ."' WHERE ID = '". $mc_time ."'");
mysql_query("UPDATE Usuarios SET Dinheiro = Dinheiro - '". $mc_rescisao ."', Rescisao = 0, Rescisao_Dias = 0 WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");

$acao = "pagou a rescisão com time.";

mysql_query("INSERT INTO Historico (Usuario,Tipo,Acao) VALUES ('". $mc_id ."',24,'". $acao ."')");

header("Location: alterar_time.php"); break;
?>