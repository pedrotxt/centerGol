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

if (strlen($q) > 6) {
	header("Location: index.php"); break;
}

if ($q < 100) {
	header("Location: usuario_doar_dinheiro.php?id=". $id ."&msg_doar_dinheiro=3"); break;
}

$query = mysql_query("SELECT ID, Usuario, Nivel, Dinheiro, VIP, VIP_Cor FROM Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$rs = mysql_fetch_array($query);

$mc_id = $rs["ID"];
$mc_nome = $rs["Usuario"];
$mc_nivel = $rs["Nivel"];
$mc_dinheiro = $rs["Dinheiro"];
$mc_vip = $rs["VIP"];
$mc_vip_cor = $rs["VIP_Cor"];

if ($id == $mc_id) {
	header("Location: index.php"); break;
}

if ($mc_nivel < 15) {
	header("Location: usuario_doar_dinheiro.php?id=". $id ."&msg_doar_dinheiro=4"); break;
}

if ($q > $mc_dinheiro) {
	header("Location: usuario_doar_dinheiro.php?id=". $id ."&msg_doar_dinheiro=2"); break;
}

mysql_query("UPDATE Usuarios SET Dinheiro = Dinheiro - '". $q ."' WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");

mysql_query("UPDATE Usuarios SET Dinheiro = Dinheiro + '". $q ."' WHERE ID = '". $id ."'");

$query = mysql_query("SELECT Usuario, VIP, VIP_Cor FROM Usuarios WHERE ID = '". $id ."'");
$rs = mysql_fetch_array($query);

$usuario_nome = $rs["Usuario"];
$usuario_vip = $rs["VIP"];
$usuario_vip_cor = $rs["VIP_Cor"];

if ($usuario_vip > 0) {
	$acao = "doou ". number_format($q,0,',','.') ." para <span id=usuario_vip". $usuario_vip_cor ."><a href=usuario.php?id=". $id .">". $usuario_nome ."</a></span>.";
} else {
	$acao = "doou ". number_format($q,0,',','.') ." para <span id=usuario_normal><a href=usuario.php?id=". $id .">". $usuario_nome ."</a></span>.";
}

mysql_query("INSERT INTO Historico (Usuario,Tipo,Acao) VALUES ('". $mc_id ."',14,'". $acao ."')");

$data = date("d/m");
$hora = date("H:i");

if ($mc_vip > 0) {
	$mensagem = "Usuário <span id=usuario_vip". $mc_vip_cor ."><a href=usuario.php?id=". $mc_id .">". $mc_nome ."</a></span> doou ". number_format($q,0,',','.') ." para você.";
} else {
	$mensagem = "Usuário <span id=usuario_normal><a href=usuario.php?id=". $mc_id .">". $mc_nome ."</a></span> doou ". number_format($q,0,',','.') ." para você.";
}

mysql_query("INSERT INTO Mensagens_Usuario (Usuario,Para,Mensagem,Data,Hora) VALUES (0,'". $id ."','". $mensagem ."','". $data ."','". $hora ."')");

header("Location: usuario_doar_dinheiro.php?id=". $id ."&msg_doar_dinheiro=1"); break;
?>