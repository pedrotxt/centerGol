<?php include("fun_anti_inj.php") ?>
<?php include("verificar_cookie.php") ?>
<?php include("conexao.php") ?>
<?php include("verificar_conexao.php") ?>
<?php
$id = anti_inj($_GET['id']);

if (!$id) {
	header("Location: index.php"); break;
}

if (ereg('[^0-9]',$id)) {
	header("Location: index.php"); break;
}

$query = mysql_query("SELECT ID, Time, Rescisao, Trocas, Gols_Time FROM Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$rs = mysql_fetch_array($query);

$mc_id = $rs["ID"];
$mc_time = $rs["Time"];
$mc_rescisao = $rs["Rescisao"];
$mc_trocas = $rs["Trocas"];
$mc_gols_time = $rs["Gols_Time"];

if ($mc_gols_time < 100) {
	header("Location: propostas.php?msg_propostas=2"); break;
}

$query = mysql_query("SELECT Usuario, Time, De, Valor, Rescisao_Dias, Rescisao_Dias_VIP FROM Propostas WHERE Usuario = '". $mc_id ."' AND ID = '". $id ."'");
$rs = mysql_fetch_array($query);

if (!$rs) {
	header("Location: index.php"); break;
}

$proposta_usuario = $rs["Usuario"];
$proposta_time = $rs["Time"];
$proposta_de = $rs["De"];
$proposta_valor = $rs["Valor"];
$proposta_rescisao_dias = $rs["Rescisao_Dias"];
$proposta_rescisao_dias_vip = $rs["Rescisao_Dias_VIP"];

$query = mysql_query("SELECT Trocas, Temporada FROM Configuracoes");
$rs = mysql_fetch_array($query);

$trocas_total = $rs["Trocas"];
$temporada = $rs["Temporada"];

if ($mc_trocas >= $trocas_total) {
	header("Location: propostas.php?msg_propostas=1"); break;
}

$query = mysql_query("SELECT ID, Time, Dinheiro FROM Times WHERE ID = '". $proposta_time ."'");
$rs = mysql_fetch_array($query);

$time_id = $rs["ID"];
$time_nome = $rs["Time"];
$time_dinheiro = $rs["Dinheiro"];

if ($time_dinheiro < $proposta_valor) {
	header("Location: propostas.php?msg_propostas=3"); break;
}

if ($proposta_rescisao_dias_vip > 0) {

$query = mysql_query("SELECT VIP, Rescisao_Dias_VIP FROM Usuarios WHERE ID = '". $proposta_de ."'");
$rs = mysql_fetch_array($query);

$de_vip = $rs["VIP"] - 1;
$de_vip_rescisao = $rs["Rescisao_Dias_VIP"];
$de_vip_total = $de_vip - $de_vip_rescisao;

if ($de_vip_total <= 0 or $proposta_rescisao_dias_vip > $de_vip_total) {
	header("Location: propostas.php?msg_propostas=4"); break;
}

}

$query = mysql_query("SELECT ID, VIP_Tempo FROM Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$rs = mysql_fetch_array($query);
$mc_vip_tempo = $rs["VIP_Tempo"];

if ($mc_rescisao != 0) {

mysql_query("UPDATE Times SET Dinheiro = Dinheiro + '". $mc_rescisao ."' WHERE ID = '". $mc_time ."'");

$valor_usuario = $proposta_valor - $mc_rescisao;
if($mc_vip_tempo < time()){
mysql_query("UPDATE Usuarios SET Time = '". $proposta_time ."', Rescisao = '". $proposta_valor * 2 ."', Rescisao_Dias = '". (time()+$proposta_rescisao_dias*86400) ."', Dinheiro = Dinheiro + '". $valor_usuario ."', Trocas = Trocas + 1, Gols_Time = 0, Rescisao_Dias_VIP = '". (time()+$proposta_rescisao_dias_vip*86400) ."', VIP_Tempo = '". (time()+$proposta_rescisao_dias_vip*86400) ."' WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
}else{
mysql_query("UPDATE Usuarios SET Time = '". $proposta_time ."', Rescisao = '". $proposta_valor * 2 ."', Rescisao_Dias = '". (time()+$proposta_rescisao_dias*86400) ."', Dinheiro = Dinheiro + '". $valor_usuario ."', Trocas = Trocas + 1, Gols_Time = 0, Rescisao_Dias_VIP = '". (time()+$proposta_rescisao_dias_vip*86400) ."', VIP_Tempo = VIP_Tempo + '". ($proposta_rescisao_dias_vip*86400) ."' WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");

}
} else {
	$valor_usuario = $proposta_valor;
if($mc_vip_tempo < time()){
mysql_query("UPDATE Usuarios SET Time = '". $proposta_time ."', Rescisao = '". $proposta_valor * 2 ."', Rescisao_Dias = '". (time()+$proposta_rescisao_dias*86400) ."', Dinheiro = Dinheiro + '". $valor_usuario ."', Trocas = Trocas + 1, Gols_Time = 0, Rescisao_Dias_VIP = '". (time()+$proposta_rescisao_dias_vip*86400) ."', VIP_Tempo = '". (time()+$proposta_rescisao_dias_vip*86400) ."' WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
}else{
mysql_query("UPDATE Usuarios SET Time = '". $proposta_time ."', Rescisao = '". $proposta_valor * 2 ."', Rescisao_Dias = '". (time()+$proposta_rescisao_dias*86400) ."', Dinheiro = Dinheiro + '". $valor_usuario ."', Trocas = Trocas + 1, Gols_Time = 0, Rescisao_Dias_VIP = '". (time()+$proposta_rescisao_dias_vip*86400) ."', VIP_Tempo = VIP_Tempo + '". ($proposta_rescisao_dias_vip*86400) ."' WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");

}
}

$proposta_valor_historico = number_format($proposta_valor,0,',','.');

mysql_query("UPDATE Times SET Dinheiro = Dinheiro - '". $proposta_valor ."' WHERE ID = '". $proposta_time ."'");

mysql_query("UPDATE Usuarios SET VIP = VIP - '". $proposta_rescisao_dias_vip ."' WHERE ID = '". $proposta_de ."'");

mysql_query("INSERT INTO Movimentacoes (Usuario,Time,Valor,Tipo) VALUES ('". $mc_id ."','". $time_id ."','". $proposta_valor ."',1)");

mysql_query("INSERT INTO Movimentacoes (Usuario,Time,Valor,Tipo) VALUES ('". $mc_id ."','". $mc_time ."','". $proposta_valor ."',2)");

mysql_query("INSERT INTO Carreira (Usuario,Time,Temporada,Gols) VALUES ('". $mc_id ."','". $mc_time ."','". $temporada ."','". $mc_gols_time ."')");

$acao = "aceitou a proposta do <a href=time.php?id=". $time_id ."><b>". $time_nome ."</b></a> no valor de ". $proposta_valor_historico .".";

mysql_query("INSERT INTO Historico (Usuario,Tipo,Acao) VALUES ('". $mc_id ."',12,'". $acao ."')");

mysql_query("DELETE FROM Propostas WHERE Usuario = '". $mc_id ."'");

mysql_query("DELETE FROM Renovacoes WHERE Usuario = '". $mc_id ."'");

mysql_query("DELETE FROM Cargos WHERE Usuario = '". $mc_id ."'");

header("Location: inicio.php"); break;
?>