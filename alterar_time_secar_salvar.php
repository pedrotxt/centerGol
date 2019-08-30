<?php include_once("fun_anti_inj.php") ?>
<?php include("verificar_cookie.php") ?>
<?php include("conexao.php") ?>
<?php include("verificar_conexao.php") ?>
<?php
$time_secar = anti_inj($_POST['time_secar']);

if (!$time_secar) {
	header("Location: index.php"); break;
}

if (ereg('[^0-9]',$time_secar)) {
	header("Location: index.php"); break;
}

if ($time_secar < 1 and $time_secar > 40) {
	header("Location: index.php"); break;
}

$custo = 500;

$query = mysql_query("SELECT ID, Time, Dinheiro, Secar, VIP, VIP_Tempo FROM Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$rs = mysql_fetch_array($query);

$mc_id = $rs["ID"];
$mc_time = $rs["Time"];
$mc_dinheiro = $rs["Dinheiro"];
$mc_secar = $rs["Secar"];
$mc_vip = $rs["VIP_Tempo"];

if ($mc_vip < time()) {
	header("Location: alterar_time_secar.php"); break;
}

if ($mc_dinheiro < $custo) {
	header("Location: alterar_time_secar.php?msg_secar=1"); break;
}

if ($time_secar == $mc_secar) {
	header("Location: alterar_time_secar.php?msg_secar=2"); break;
}

if ($time_secar == $mc_time) {
	header("Location: alterar_time_secar.php?msg_secar=3"); break;
}

mysql_query("UPDATE Usuarios SET Dinheiro = Dinheiro - '". $custo ."', Secar = '". $time_secar ."', Secar_Gols = 0 WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");

mysql_query("DELETE FROM Historico WHERE Usuario = '". $mc_id. "' AND Tipo = 4");

$acao = "está Secando um time.";

mysql_query("INSERT INTO Historico (Usuario,Tipo,Acao) VALUES ('". $mc_id ."',4,'". $acao ."')");

header("Location: inicio.php"); break;
?>