<?php include_once("fun_anti_inj.php") ?>
<?php include("verificar_cookie.php") ?>
<?php include("conexao.php") ?>
<?php include("verificar_conexao.php") ?>
<?php include("verificar_cargo.php") ?>
<?php
function alerta($msg){
	echo "<script charset = \"ISO-8859-1\">window.alert('".strip_tags($msg)."')</script>";
};
?>
<?php
$id = anti_inj($_GET['id']);

if (!$id) {
	header("Location: index.php"); break;
}

if (ereg('[^0-9]',$id)) {
	header("Location: index.php"); break;
}
$query = mysql_query("SELECT Time FROM Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$rs = mysql_fetch_array($query);

$mc_time = $rs["Time"];

if($eu_olheiro == 1){
$query = mysql_query("SELECT * FROM Olheiro WHERE De = '". $mc_id ."'AND ID='".$id."'");
}elseif($eu_presidente == 1){
$query = mysql_query("SELECT * FROM Olheiro WHERE Time = '". $mc_time ."'AND ID='".$id."'");
}
$rs = mysql_fetch_array($query);

if (!$rs) {
	header("Location: index.php"); break;
}

mysql_query("DELETE FROM Olheiro WHERE ID = '". $id ."'");
alerta('Indicação Excluida!');
redirect('painel_indicacoes.php');
?>