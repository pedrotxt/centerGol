<?php include_once("fun_anti_inj.php") ?>
<?php include("verificar_cookie.php") ?>
<?php include("conexao.php") ?>
<?php include("verificar_conexao.php") ?>
<?php include("verificar_cargo.php") ?>
<?php
if ($eu_presidente == 1 or $eu_diretor == 1 or $eu_olheiro == 1) {
	header("Location: alterar_time.php"); break;
}

$time_novo = anti_inj($_POST['time']);

if (!$time_novo) {
	header("Location: index.php"); break;
}

if (ereg('[^0-9]',$time_novo)) {
	header("Location: index.php"); break;
}

if ($time_novo < 1 and $time_novo > 40) {
	header("Location: index.php"); break;
}

$query = mysql_query("SELECT Trocas, Temporada FROM Configuracoes");
$rs = mysql_fetch_array($query);

$trocas_total = $rs["Trocas"];
$temporada = $rs["Temporada"];

$query = mysql_query("SELECT Time, Dinheiro, Trocas, Gols_Time, Rescisao, Rescisao_Dias_VIP FROM Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$rs = mysql_fetch_array($query);

$mc_time = $rs["Time"];
$mc_dinheiro = $rs["Dinheiro"];
$mc_trocas = $rs["Trocas"];
$mc_gols_time = $rs["Gols_Time"];
$mc_rescisao = $rs["Rescisao"];
$mc_rescisao_dias_vip = $rs["Rescisao_Dias_VIP"];

$custo = 10000;
$custo_total = $mc_rescisao + $custo;

if ($mc_time == $time_novo) {
	header("Location: alterar_time.php?msg_time=2"); break;
}

if ($mc_dinheiro < $custo_total) {
	header("Location: alterar_time.php?msg_time=1"); break;
}

if ($mc_trocas >= $trocas_total) {
	header("Location: alterar_time.php"); break;
}

if ($mc_rescisao_dias_vip > 0) {
	header("Location: alterar_time.php"); break;
}

if ($mc_gols_time < 0) {
	header("Location: alterar_time.php"); break;
}

mysql_query("UPDATE Times SET Dinheiro = Dinheiro + '". $mc_rescisao ."' WHERE ID = '". $mc_time ."'");

mysql_query("UPDATE Usuarios SET Time = '". $time_novo ."', Dinheiro = Dinheiro - '". $custo_total ."', Trocas = Trocas + 1, Rescisao = 0, Rescisao_Dias = 0, Gols_Time = 0 WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");

$query = mysql_query("SELECT Time FROM Times WHERE ID = '". $time_novo ."'");
$rs = mysql_fetch_array($query);

$time_novo_nome = $rs["Time"];

mysql_query("INSERT INTO Movimentacoes (Usuario,Time,Valor,Tipo) VALUES ('". $mc_id ."','". $time_novo ."','0',1)");

mysql_query("INSERT INTO Movimentacoes (Usuario,Time,Valor,Tipo) VALUES ('". $mc_id ."','". $mc_time ."','0',2)");

mysql_query("INSERT INTO Carreira (Usuario,Time,Temporada,Gols) VALUES ('". $mc_id ."','". $mc_time ."','". $temporada ."','". $mc_gols_time ."')");

$acao = "mudou para o <a href=time.php?id=". $time_novo ."><b>". $time_novo_nome ."</b></a>.";

mysql_query("INSERT INTO Historico (Usuario,Tipo,Acao) VALUES ('". $mc_id ."',23,'". $acao ."')");

mysql_query("DELETE FROM Propostas WHERE Usuario = '". $mc_id ."'");

mysql_query("DELETE FROM Renovacoes WHERE Usuario = '". $mc_id ."'");

mysql_query("DELETE FROM Cargos WHERE Usuario = '". $mc_id ."'");

header("Location: inicio.php"); break;
?>