<?php include_once("fun_anti_inj.php") ?>
<?php include("verificar_cookie.php") ?>
<?php include("conexao.php") ?>
<?php include("verificar_conexao.php") ?>
<?php include("verificar_cargo.php") ?>
<?php
if ($eu_presidente == 0 and $eu_diretor == 0) {
	header("Location: index.php"); break;
}

$id = anti_inj($_POST['id']);
$valor = anti_inj($_POST['valor']);
$rescisao_multa = $valor * 2;
$rescisao_dias = anti_inj($_POST['rescisao_dias']);
$rescisao_dias_vip = anti_inj($_POST['rescisao_dias_vip']);
$mensagem = anti_inj($_POST['mensagem']);

if ($id == "" or $valor == "" or $rescisao_dias == "" or $rescisao_dias_vip == "") {
	header("Location: index.php"); break;
}

if (ereg('[^0-9]',$id)) {
	header("Location: index.php"); break;
}

if (ereg('[^0-9]',$valor)) {
	header("Location: index.php"); break;
}

if (ereg('[^0-9]',$rescisao_dias)) {
	header("Location: index.php"); break;
}

if (ereg('[^0-9]',$rescisao_dias_vip)) {
	header("Location: index.php"); break;
}

if (strlen($valor) > 7) {
	header("Location: index.php"); break;
}

if (strlen($rescisao_dias) > 2) {
	header("Location: index.php"); break;
}

if (strlen($rescisao_dias_vip) > 2) {
	header("Location: index.php"); break;
}

if ($rescisao_dias <= 0 or $rescisao_dias > 10) {
	header("Location: index.php"); break;
}

if ($rescisao_dias_vip < 0 or $rescisao_dias_vip > 10) {
	header("Location: index.php"); break;
}

$query = mysql_query("SELECT ID FROM Usuarios WHERE ID = '". $id ."'");
$rs = mysql_fetch_array($query);

if (!$rs) {
	header("Location: index.php"); break;
}

$query = mysql_query("SELECT ID, Time, VIP, Rescisao_Dias_VIP FROM Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$rs = mysql_fetch_array($query);

$mc_id = $rs["ID"];
$mc_time = $rs["Time"];
$mc_vip = $rs["VIP"] - 1;
$mc_vip_rescisao = $rs["Rescisao_Dias_VIP"];
$mc_vip_total = $mc_vip - $mc_vip_rescisao;

if ($id == $mc_id or $valor < 1) {
	header("Location: index.php"); break;
}

$query = mysql_query("SELECT ID FROM Renovacoes WHERE Time = '". $mc_time ."' AND Usuario = '". $id ."'");
$rs = mysql_fetch_array($query);

if ($rs) {
	header("Location: usuario_renovar.php?id=". $id ."&msg_renovar=2"); break;
}

$query = mysql_query("SELECT Dinheiro FROM Times WHERE ID = '". $mc_time ."'");
$rs = mysql_fetch_array($query);

$mc_time_dinheiro = $rs["Dinheiro"];

if ($mc_time_dinheiro < $valor) {
	header("Location: usuario_renovar.php?id=". $id ."&msg_renovar=3"); break;
}

$query = mysql_query("SELECT Time, Propostas FROM Usuarios WHERE ID = '". $id ."'");
$rs = mysql_fetch_array($query);

$usuario_time = $rs["Time"];
$usuario_propostas = $rs["Propostas"];

if ($usuario_propostas == 0) {
	header("Location: index.php"); break;
}

if ($mc_time != $usuario_time) {
	header("Location: usuario_renovar.php?id=". $id); break;
}

if ($mc_vip_total <= 0 and $rescisao_dias_vip > 0 or $rescisao_dias_vip > $mc_vip_total and $rescisao_dias_vip > 0) {
	header("Location: usuario_renovar.php?id=". $id ."&msg_renovar=4"); break;
}

$data = date("d/m");

mysql_query("INSERT INTO Renovacoes (Time,De,Usuario,Valor,Rescisao_Dias,Rescisao_Dias_VIP,Mensagem,Data) VALUES ('". $mc_time ."','". $mc_id ."','". $id ."','". $valor ."','". $rescisao_dias ."','". $rescisao_dias_vip ."','". $mensagem ."','". $data ."')");

header("Location: usuario_renovar.php?id=". $id ."&msg_renovar=1"); break;
?>