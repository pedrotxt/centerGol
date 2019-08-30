<?php include_once("fun_anti_inj.php") ?>
<?php include("verificar_cookie.php") ?>
<?php include("conexao.php") ?>
<?php include("verificar_conexao.php") ?>
<?php
$q = anti_inj($_POST['vips']);

if (!$q) {
	header("Location: index.php"); break;
}

if (ereg('[^0-9]',$q)) {
	header("Location: index.php"); break;
}

if (strlen($q) > 4) {
	header("Location: index.php"); break;
}

if ($q < 1 or $q > 1000) {
	header("Location: index.php"); break;
}

$query = mysql_query("SELECT ID, VIP, VIP_Tempo FROM Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$rs = mysql_fetch_array($query);

$mc_id = $rs["ID"];
$mc_vip = $rs["VIP"];
$mc_vip_tempo = $rs["VIP_Tempo"];

if ($q > $mc_vip) {
	header("Location: itens.php?msg_itens=1"); break;
}
if($mc_vip_tempo < time()){

mysql_query("UPDATE Usuarios SET VIP_Tempo = '". (time()+$q*86400) ."', VIP = VIP - '". $q ."' WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");

}else{
	
mysql_query("UPDATE Usuarios SET VIP_Tempo = VIP_Tempo + '". ($q*86400) ."', VIP = VIP - '". $q ."' WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");

}

mysql_query("DELETE FROM Historico WHERE Usuario = '". $mc_id ."' AND Tipo = 11");

$acao = "usou ".$q." dias de vip.";

mysql_query("INSERT INTO Historico (Usuario,Tipo,Acao) VALUES ('". $mc_id ."',11,'". $acao ."')");

header("Location: itens.php?msg_itens=14"); break;
?>