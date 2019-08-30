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

$query = mysql_query("SELECT Renovacoes.Valor as Renovacao_Valor, Times.ID as Time_ID, Times.Time as Time_Nome FROM Renovacoes INNER JOIN Times ON Times.ID = Renovacoes.Time WHERE Renovacoes.Time = '". $mc_time ."' AND Renovacoes.Usuario = '". $mc_id ."' AND Renovacoes.ID = '". $id ."'");
$rs = mysql_fetch_array($query);

if (!$rs) {
	header("Location: indeaax.php"); break;
}

$time_id = $rs["Time_ID"];
$time_nome = $rs["Time_Nome"];
$renovacao_valor = $rs["Renovacao_Valor"];
$renovacao_valor_historico = number_format($renovacao_valor,0,',','.');

$acao = "recusou a renovação do <a href=time.php?id=". $time_id ."><b>". $time_nome ."</b></a> no valor de ". $renovacao_valor_historico .".";

mysql_query("INSERT INTO Historico (Usuario,Tipo,Acao) VALUES ('". $mc_id ."',25,'". $acao ."')");
mysql_query("DELETE FROM Renovacoes WHERE Usuario = '". $mc_id ."'");

header("Location: inicio.php"); break;
?>