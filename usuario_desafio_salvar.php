<?php include_once("fun_anti_inj.php") ?>
<?php include("verificar_cookie.php") ?>
<?php include("conexao.php") ?>
<?php include("verificar_conexao.php") ?>
<?php
$id = anti_inj($_GET['id']);
$cod = anti_inj($_GET['cod']);
$aposta = anti_inj($_GET['a']);
$c1 = anti_inj($_GET['c1']);
$c2 = anti_inj($_GET['c2']);
$c3 = anti_inj($_GET['c3']);
$c4 = anti_inj($_GET['c4']);
$c5 = anti_inj($_GET['c5']);
$d1 = anti_inj($_GET['d1']);
$d2 = anti_inj($_GET['d2']);
$d3 = anti_inj($_GET['d3']);
$d4 = anti_inj($_GET['d4']);
$d5 = anti_inj($_GET['d5']);

if (!$id) {
	header("Location: index.php"); break;
}

if (ereg('[^0-9]',$id)) {
	header("Location: index.php"); break;
}

if (ereg('[^0-9]',$cod)) {
	header("Location: index.php"); break;
}

if ($cod < 1000 or $cod > 9999) {
	header("Location: index.php"); break;
}

if (ereg('[^0-9]',$aposta)) {
	header("Location: index.php"); break;
}

if (strlen($aposta) > 6) {
	header("Location: index.php"); break;
}

if ($aposta < 100) {
	header("Location: index.php"); break;
}

if ($c1 != 1 and $c1 != 2 and $c1 != 3) {
	header("Location: index.php"); break;
}

if ($c2 != 1 and $c2 != 2 and $c2 != 3) {
	header("Location: index.php"); break;
}

if ($c3 != 1 and $c3 != 2 and $c3 != 3) {
	header("Location: index.php"); break;
}

if ($c4 != 1 and $c4 != 2 and $c4 != 3) {
	header("Location: index.php"); break;
}

if ($c5 != 1 and $c5 != 2 and $c5 != 3) {
	header("Location: index.php"); break;
}

if ($d1 != 1 and $d1 != 2 and $d1 != 3) {
	header("Location: index.php"); break;
}

if ($d2 != 1 and $d2 != 2 and $d2 != 3) {
	header("Location: index.php"); break;
}

if ($d3 != 1 and $d3 != 2 and $d3 != 3) {
	header("Location: index.php"); break;
}

if ($d4 != 1 and $d4 != 2 and $d4 != 3) {
	header("Location: index.php"); break;
}

if ($d5 != 1 and $d5 != 2 and $d5 != 3) {
	header("Location: index.php"); break;
}

$query = mysql_query("SELECT ID, Dinheiro, Desafio_Cod FROM Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$rs = mysql_fetch_array($query);

$mc_id = $rs["ID"];
$mc_dinheiro = $rs["Dinheiro"];
$mc_cod = $rs["Desafio_Cod"];

if ($cod != $mc_cod) {
	header("Location: index.php"); break;
}

if ($id == $mc_id) {
	header("Location: index.php"); break;
}

if ($mc_dinheiro < 100) {
	header("Location: usuario_desafio.php?id=".$id); break;
}

$query = mysql_query("SELECT ID FROM Desafios WHERE Usuario_1 = ". $mc_id ." AND Usuario_2 = ". $id ." OR Usuario_1 = ". $id ." AND Usuario_2 = '". $mc_id ."'");
$rs = mysql_fetch_array($query);

if ($rs) {
	header("Location: usuario_desafio.php?id=".$id); break;
}

$query = mysql_query("SELECT ID, Usuario, Dinheiro, VIP, VIP_Cor, Desafios FROM Usuarios WHERE ID = '". $id ."'");
$rs = mysql_fetch_array($query);

$usuario_id = $rs["ID"];
$usuario_nome = $rs["Usuario"];
$usuario_dinheiro = $rs["Dinheiro"];
$usuario_vip = $rs["VIP"];
$usuario_vip_cor = $rs["VIP_Cor"];
$usuario_desafios = $rs["Desafios"];

if ($usuario_desafios == 0) {
	header("Location: usuario_desafio.php?id=".$id); break;
}

if ($usuario_dinheiro < 100) {
	header("Location: usuario_desafio.php?id=".$id); break;
}

if ($mc_dinheiro < $aposta) {
	header("Location: usuario_desafio.php?id=".$id."&msg_desafio=2"); break;
}

if ($usuario_dinheiro < $aposta) {
	header("Location: usuario_desafio.php?id=".$id."&msg_desafio=3"); break;
}

$desafio_cod = rand(1000,9999);
$data = date("d/m");
$hora = date("H:i");

mysql_query("INSERT INTO Desafios (Usuario_1,Usuario_2,Chute_1_1,Chute_1_2,Chute_1_3,Chute_1_4,Chute_1_5,Defesa_1_1,Defesa_1_2,Defesa_1_3,Defesa_1_4,Defesa_1_5,Aposta,Data,Hora) VALUES ('". $mc_id ."','". $id ."','". $c1 ."','". $c2 ."','". $c3 ."','". $c4 ."','". $c5 ."','". $d1 ."','". $d2 ."','". $d3 ."','". $d4 ."','". $d5 ."','". $aposta ."','". $data ."','". $hora ."')");

mysql_query("UPDATE Usuarios SET Dinheiro = Dinheiro - ". $aposta .", Desafio_Cod = '". $desafio_cod ."' WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");

if ($usuario_vip > 0) {
	$acao = "enviou desafio para <span id=usuario_vip". $usuario_vip_cor ."><a href=usuario.php?id=". $usuario_id .">". $usuario_nome ."</a></span>.";
} else {
	$acao = "enviou desafio para <span id=usuario_normal><a href=usuario.php?id=". $usuario_id .">". $usuario_nome ."</a></span>.";
}

mysql_query("INSERT INTO Historico (Usuario,Tipo,Acao) VALUES ('". $mc_id ."',21,'". $acao ."')");

header("Location: usuario_desafio.php?id=".$id."&msg_desafio=1"); break;
?>