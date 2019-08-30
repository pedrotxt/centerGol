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

$query = mysql_query("SELECT ID FROM Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$rs = mysql_fetch_array($query);

$mc_id = $rs["ID"];

$query = mysql_query("SELECT Time, Valor FROM Propostas WHERE Usuario = '". $mc_id ."' AND ID = '". $id ."'");
$rs = mysql_fetch_array($query);

if (!$rs) {
	header("Location: index.php"); break;
}

$proposta_time = $rs["Time"];
$proposta_valor = $rs["Valor"];

$query = mysql_query("SELECT ID, Time FROM Times WHERE ID = '". $proposta_time ."'");
$rs = mysql_fetch_array($query);

$time_id = $rs["ID"];
$time_nome = $rs["Time"];

$proposta_valor_historico = number_format($proposta_valor,0,',','.');

$acao = "recusou a proposta do <a href=time.php?id=". $time_id ."><b>". $time_nome ."</b></a> no valor de ". $proposta_valor_historico .".";

mysql_query("INSERT INTO Historico (Usuario,Tipo,Acao) VALUES ('". $mc_id ."',12,'". $acao ."')");

mysql_query("DELETE FROM Propostas WHERE ID = '". $id ."'");

header("Location: propostas.php"); break;
?>