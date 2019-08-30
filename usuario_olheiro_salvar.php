<?php include_once("fun_anti_inj.php") ?>
<?php include("verificar_cookie.php") ?>
<?php include("conexao.php") ?>
<?php include("verificar_conexao.php") ?>
<?php
$id = anti_inj($_GET['id']);
$olheiro = anti_inj($_POST['olheiro']);

if (!$id or !$olheiro) {
	header("Location: index.php"); break;
}

if (ereg('[^0-9]',$id)) {
	header("Location: index.php"); break;
}

if (strlen($olheiro) > 200) {
	header("Location: index.php"); break;
}
$query = mysql_query("SELECT Time FROM Usuarios WHERE ID = '". $id ."'");
$rs = mysql_fetch_array($query);

$usuario_time = $rs['Time'];

$query = mysql_query("SELECT ID,Time FROM Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$rs = mysql_fetch_array($query);

$mc_id = $rs["ID"];
$mc_time = $rs["Time"];

if ($id == $mc_id) {
	header("Location: index.php"); break;
}
if(mysql_num_rows(mysql_query("select ID from Olheiro where Usuario='".$id."'"))>=1){
	
	header("Location: usuario.php?id=". $id ."&msg_olheiro=2"); break;

}
$data = date("d/m");
$hora = date("H:i");

mysql_query("INSERT INTO Olheiro (Usuario,De,Time,Time_User,Motivo,Data,Hora) VALUES ('". $id ."','". $mc_id ."','". $mc_time ."','".$usuario_time."','". $olheiro ."','". $data ."','". $hora ."')");

header("Location: usuario.php?id=". $id ."&msg_olheiro=1"); break;
?>