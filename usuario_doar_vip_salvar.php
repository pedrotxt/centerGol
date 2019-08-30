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

if (ereg('[^0-9]',$q)) {
	header("Location: index.php"); break;
}

if (strlen($q) > 2) {
	header("Location: index.php"); break;
}

if ($q < 1) {
	header("Location: usuario_doar_vip.php?id=". $id ."&msg_doar_vip=3"); break;
}

$query = mysql_query("SELECT ID, Usuario, Nivel, VIP_Cor, VIP, Rescisao_Dias_VIP FROM Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$rs = mysql_fetch_array($query);

$mc_id = $rs["ID"];
$mc_nome = $rs["Usuario"];
$mc_nivel = $rs["Nivel"];
$mc_vip_cor = $rs["VIP_Cor"];
$mc_vip = $rs["VIP"] - 1;
$mc_vip_rescisao = $rs["Rescisao_Dias_VIP"];
$mc_vip_total = $mc_vip;

if ($id == $mc_id) {
	header("Location: index.php"); break;
}

if ($mc_nivel < 15) {
	header("Location: usuario_doar_vip.php?id=". $id ."&msg_doar_vip=4"); break;
}

if ($mc_vip_total <= 0 or $q > $mc_vip_total) {
	header("Location: usuario_doar_vip.php?id=". $id ."&msg_doar_vip=2"); break;
}

$query = mysql_query("SELECT ID, VIP_Tempo FROM Usuarios WHERE ID = '". $id ."'");
$rs = mysql_fetch_array($query);

$mc_vip_tempo = $rs["VIP_Tempo"];

if($mc_vip_tempo < time()){

mysql_query("UPDATE Usuarios SET VIP = VIP - '". $q ."' WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
mysql_query("UPDATE Usuarios SET VIP_Tempo = '". (time()+$q*86400) ."' WHERE ID = '". $id ."'");

}else{
	
mysql_query("UPDATE Usuarios SET VIP = VIP - '". $q ."' WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
mysql_query("UPDATE Usuarios SET VIP_Tempo = VIP_Tempo + '". ($q*86400) ."' WHERE ID = '". $id ."'");

}


$query = mysql_query("SELECT Usuario, VIP_Cor FROM Usuarios WHERE ID = '". $id ."'");
$rs = mysql_fetch_array($query);

$usuario_nome = $rs["Usuario"];
$usuario_vip_cor = $rs["VIP_Cor"];

if ($q == 1) {
	$acao = "doou 1 dia de VIP para <span id=usuario_vip". $usuario_vip_cor ."><a href=usuario.php?id=". $id .">". $usuario_nome ."</a></span>.";
} else {
	$acao = "doou ". $q ." dias de VIP para <span id=usuario_vip". $usuario_vip_cor ."><a href=usuario.php?id=". $id .">". $usuario_nome ."</a></span>.";
}

mysql_query("INSERT INTO Historico (Usuario,Tipo,Acao) VALUES ('". $mc_id ."',15,'". $acao ."')");

$data = date("d/m");
$hora = date("H:i");

if ($q == 1) {
	$mensagem = "Usuário <span id=usuario_vip". $mc_vip_cor ."><a href=usuario.php?id=". $mc_id .">". $mc_nome ."</a></span> doou 1 dia de VIP para você.";
} else {
	$mensagem = "Usuário <span id=usuario_vip". $mc_vip_cor ."><a href=usuario.php?id=". $mc_id .">". $mc_nome ."</a></span> doou ". $q ." dias de VIP para você.";
}

mysql_query("INSERT INTO Mensagens_Usuario (Usuario,Para,Mensagem,Data,Hora) VALUES (0,'". $id ."','". $mensagem ."','". $data ."','". $hora ."')");

header("Location: usuario_doar_vip.php?id=". $id ."&msg_doar_vip=1"); break;
?>