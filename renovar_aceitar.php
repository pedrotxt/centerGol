<?php include_once("fun_anti_inj.php") ?>
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

$query = mysql_query("SELECT ID, Time FROM Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$rs = mysql_fetch_array($query);

$mc_id = $rs["ID"];
$mc_time = $rs["Time"];

$query = mysql_query("SELECT Renovacoes.Valor as Renovacao_Valor, Renovacoes.Rescisao_Dias as Renovacao_Rescisao_Dias, Renovacoes.Rescisao_Dias_VIP as Renovacao_Rescisao_Dias_VIP, Usuarios.ID as Usuario_ID, Usuarios.VIP_Tempo as Usuario_VIP, Usuarios.Rescisao_Dias_VIP as Usuario_Rescisao_Dias_VIP, Times.ID as Time_ID, Times.Time as Time_Nome, Times.Dinheiro as Time_Dinheiro FROM Renovacoes INNER JOIN Usuarios ON Usuarios.ID = Renovacoes.De INNER JOIN Times ON Times.ID = Renovacoes.Time WHERE Renovacoes.Time = '". $mc_time ."' AND Renovacoes.Usuario = '". $mc_id ."' AND Renovacoes.ID = '". $id ."'");
$rs = mysql_fetch_array($query);

if (!$rs) {
	header("Location: index.php"); break;
}

$usuario_id = $rs["Usuario_ID"];
$usuario_vip = $rs["Usuario_VIP"];
$usuario_vip_dias_rescisao = $rs["Usuario_Rescisao_Dias_VIP"];
$usuario_vip_total = $usuario_vip - $usuario_vip_dias_rescisao;

$time_id = $rs["Time_ID"];
$time_nome = $rs["Time_Nome"];
$time_dinheiro = $rs["Time_Dinheiro"];

$renovacao_valor = $rs["Renovacao_Valor"];
$renovacao_rescisao_dias = $rs["Renovacao_Rescisao_Dias"];
$renovacao_rescisao_dias_vip = $rs["Renovacao_Rescisao_Dias_VIP"];

if ($time_dinheiro < $renovacao_valor) {
	header("Location: inicio.php?msg_renovar=1"); break;
}

if ($usuario_vip_total <= 0 and $renovacao_rescisao_dias_vip > 0 or $renovacao_rescisao_dias_vip > $usuario_vip_total and $renovacao_rescisao_dias_vip > 0) {
	header("Location: inicio.php?msg_renovar=2"); break;
}

$renovacao_rescisao = $renovacao_valor * 2;

if ($renovacao_rescisao_dias_vip > 0) {
	
	$query = mysql_query("SELECT ID, VIP_Tempo FROM Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$rs = mysql_fetch_array($query);
$mc_vip_tempo = $rs["VIP_Tempo"];

if($mc_vip_tempo < time()){
mysql_query("UPDATE Usuarios SET Rescisao = '". $renovacao_rescisao ."', Rescisao_Dias = '". (time()+$renovacao_rescisao_dias*86400) ."', Dinheiro = Dinheiro + '". $renovacao_valor ."', Rescisao_Dias_VIP = '". (time()+$renovacao_rescisao_dias_vip*86400) ."', VIP_Tempo = '". (time()+$renovacao_rescisao_dias_vip*86400) ."' WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
}else{
mysql_query("UPDATE Usuarios SET Rescisao = '". $renovacao_rescisao ."', Rescisao_Dias = '". (time()+$renovacao_rescisao_dias*86400) ."', Dinheiro = Dinheiro + '". $renovacao_valor ."', Rescisao_Dias_VIP = '". (time()+$proposta_rescisao_dias_vip*86400) ."', VIP_Tempo = VIP_Tempo + '". ($renovacao_rescisao_dias_vip*86400) ."' WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
}
} else {
mysql_query("UPDATE Usuarios SET Rescisao = '". $renovacao_rescisao ."', Rescisao_Dias = '". (time()+$renovacao_rescisao_dias*86400) ."', Dinheiro = Dinheiro + '". $renovacao_valor ."', Rescisao_Dias_VIP = 0 WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");

}

mysql_query("UPDATE Times SET Dinheiro = Dinheiro - '". $renovacao_valor ."' WHERE ID = '". $time_id ."'");
mysql_query("UPDATE Usuarios SET VIP = VIP - '". $renovacao_rescisao_dias_vip ."' WHERE ID = '". $usuario_id ."'");

$renovacao_valor_historico = number_format($renovacao_valor,0,',','.');

$acao = "aceitou a renovação do <a href=time.php?id=". $time_id ."><b>". $time_nome ."</b></a> no valor de ". $renovacao_valor_historico .".";

mysql_query("INSERT INTO Historico (Usuario,Tipo,Acao) VALUES ('". $mc_id ."',25,'". $acao ."')");
mysql_query("DELETE FROM Propostas WHERE Usuario = '". $mc_id ."'");
mysql_query("DELETE FROM Renovacoes WHERE Usuario = '". $mc_id ."'");

header("Location: inicio.php"); break;
?>