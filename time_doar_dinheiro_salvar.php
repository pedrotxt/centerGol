<?php include_once("fun_anti_inj.php") ?>
<?php include("verificar_cookie.php") ?>
<?php include("conexao.php") ?>
<?php include("verificar_conexao.php") ?>
<?php
$id = anti_inj($_GET['id']);
$q = anti_inj($_POST['q']);

if (!$id or !$q) {
	header("Location: index.php"); break;
}

if (ereg('[^0-9]',$id)) {
	header("Location: index.php"); break;
}

if ($id < 1 and $id > 40) {
	header("Location: index.php"); break;
}

if (ereg('[^0-9]',$q)) {
	header("Location: index.php"); break;
}

if (strlen($q) > 6) {
	header("Location: index.php"); break;
}

if ($q < 100) {
	header("Location: time_doar_dinheiro.php?id=". $id ."&msg_doar_dinheiro=3"); break;
}

$query = mysql_query("SELECT ID, Usuario, Dinheiro, VIP, VIP_Cor FROM Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$rs = mysql_fetch_array($query);

$mc_id = $rs["ID"];
$mc_nome = $rs["Usuario"];
$mc_dinheiro = $rs["Dinheiro"];
$mc_vip = $rs["VIP"];
$mc_vip_cor = $rs["VIP_Cor"];

if ($q > $mc_dinheiro) {
	header("Location: time_doar_dinheiro.php?id=". $id ."&msg_doar_dinheiro=2"); break;
}

mysql_query("UPDATE Usuarios SET Dinheiro = Dinheiro - '". $q ."' WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
mysql_query("UPDATE Times SET Dinheiro = Dinheiro + '". $q ."' WHERE ID = '". $id ."'");

$query = mysql_query("SELECT Time, Presidente, Diretor FROM Times WHERE ID = '". $id ."'");
$rs = mysql_fetch_array($query);

$time_nome = $rs["Time"];
$time_presidente = $rs["Presidente"];
$time_diretor = $rs["Diretor"];

$acao = "doou ". number_format($q,0,',','.') ." para o time <a href=time.php?id=". $id. "><b>". $time_nome ."</b></a>.";

mysql_query("INSERT INTO Historico (Usuario,Tipo,Acao) VALUES ('". $mc_id ."',13,'". $acao ."')");

$data = date("d/m");
$hora = date("H:i");

if ($mc_vip == 1) {
	$mensagem = "Usuário <span id=usuario_vip". $mc_vip_cor ."><a href=usuario.php?id=". $mc_id .">". $mc_nome ."</a></span> doou ". number_format($q,0,',','.') ." para o time <a href=time.php?id=". $id ."><b>". $time_nome ."</b></a>.";
} else {
	$mensagem = "Usuário <span id=usuario_normal><a href=usuario.php?id=". $mc_id .">". $mc_nome ."</a></span> doou ". number_format($q,0,',','.') ." para o time <a href=time.php?id=". $id ."><b>". $time_nome ."</b></a>.";
}

if ($time_presidente != 0) {

mysql_query("INSERT INTO Mensagens_Usuario (Usuario,Para,Mensagem,Data,Hora) VALUES (0,'". $time_presidente ."','". $mensagem ."','". $data ."','". $hora ."')");

}

if ($time_diretor != 0) {

mysql_query("INSERT INTO Mensagens_Usuario (Usuario,Para,Mensagem,Data,Hora) VALUES (0,'". $time_diretor."','". $mensagem ."','". $data ."','". $hora ."')");

}

header("Location: time_doar_dinheiro.php?id=". $id ."&msg_doar_dinheiro=1"); break;
?>