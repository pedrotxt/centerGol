<?php include_once("fun_anti_inj.php") ?>
<?php include("verificar_cookie.php") ?>
<?php include("conexao.php") ?>
<?php include("verificar_conexao.php") ?>
<?php
$id = anti_inj($_GET['id']);
$cod = anti_inj($_GET['cod']);
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

$query = mysql_query("SELECT ID, Usuario, Dinheiro, VIP, VIP_Cor, Desafio_Cod FROM Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$rs = mysql_fetch_array($query);

$mc_id = $rs["ID"];
$mc_nome = $rs["Usuario"];
$mc_dinheiro = $rs["Dinheiro"];
$mc_vip = $rs["VIP"];
$mc_vip_cor = $rs["VIP_Cor"];
$mc_cod = $rs["Desafio_Cod"];

if ($cod != $mc_cod) {
	header("Location: index.php"); break;
}

$query = mysql_query("SELECT Usuario_1, Aposta, Chute_1_1, Chute_1_2, Chute_1_3, Chute_1_4, Chute_1_5, Defesa_1_1, Defesa_1_2, Defesa_1_3, Defesa_1_4, Defesa_1_5 FROM Desafios WHERE ID = ". $id ." AND Usuario_2 = '". $mc_id ."'");
$rs = mysql_fetch_array($query);

if (!$rs) {
	header("Location: index.php"); break;
}

$desafio_usuario = $rs["Usuario_1"];
$desafio_aposta = $rs["Aposta"];
$desafio_aposta_dobro = $rs["Aposta"] * 2;
$chute_1_1 = $rs["Chute_1_1"];
$chute_1_2 = $rs["Chute_1_2"];
$chute_1_3 = $rs["Chute_1_3"];
$chute_1_4 = $rs["Chute_1_4"];
$chute_1_5 = $rs["Chute_1_5"];
$defesa_1_1 = $rs["Defesa_1_1"];
$defesa_1_2 = $rs["Defesa_1_2"];
$defesa_1_3 = $rs["Defesa_1_3"];
$defesa_1_4 = $rs["Defesa_1_4"];
$defesa_1_5 = $rs["Defesa_1_5"];

if ($mc_dinheiro < $desafio_aposta) {
	header("Location: desafios.php?msg_desafios=1"); break;
}

$query = mysql_query("SELECT ID, Usuario, VIP, VIP_Cor FROM Usuarios WHERE ID = '". $desafio_usuario ."'");
$rs = mysql_fetch_array($query);

$usuario_id = $rs["ID"];
$usuario_nome = $rs["Usuario"];
$usuario_vip = $rs["VIP"];
$usuario_vip_cor = $rs["VIP_Cor"];

$usuario_1 = $desafio_usuario;
$usuario_2 = $mc_id;
$placar_1 = 0;
$placar_2 = 0;

if ($chute_1_1 != $d1) {
	$placar_1 = $placar_1 + 1;
}

if ($chute_1_2 != $d2) {
	$placar_1 = $placar_1 + 1;
}

if ($chute_1_3 != $d3) {
	$placar_1 = $placar_1 + 1;
}

if ($chute_1_4 != $d4) {
	$placar_1 = $placar_1 + 1;
}

if ($chute_1_5 != $d5) {
	$placar_1 = $placar_1 + 1;
}

if ($c1 != $defesa_1_1) {
	$placar_2 = $placar_2 + 1;
}

if ($c2 != $defesa_1_2) {
	$placar_2 = $placar_2 + 1;
}

if ($c3 != $defesa_1_3) {
	$placar_2 = $placar_2 + 1;
}

if ($c4 != $defesa_1_4) {
	$placar_2 = $placar_2 + 1;
}

if ($c5 != $defesa_1_5) {
	$placar_2 = $placar_2 + 1;
}

mysql_query("DELETE FROM Desafios WHERE ID = '". $id ."'");

mysql_query("INSERT INTO Desafios_Resultados (Usuario_1,Usuario_2,Placar_1,Placar_2,Aposta) VALUES ('". $usuario_1 ."','". $usuario_2 ."','". $placar_1 ."','". $placar_2 ."','". $desafio_aposta ."')");

if ($placar_1 == $placar_2) {

mysql_query("UPDATE Usuarios SET Desafio_Total = Desafio_Total + 1, Desafio_Empates = Desafio_Empates + 1, Dinheiro = Dinheiro + '". $desafio_aposta ."' WHERE ID = '". $usuario_1 ."'");

mysql_query("UPDATE Usuarios SET Desafio_Total = Desafio_Total + 1, Desafio_Empates = Desafio_Empates + 1 WHERE ID = '". $usuario_2 ."'");

} else if ($placar_1 > $placar_2) {

mysql_query("UPDATE Usuarios SET Desafio_Total = Desafio_Total + 1, Desafio_Vitorias = Desafio_Vitorias + 1, Desafio_Saldo = Desafio_Saldo + '". $desafio_aposta ."', Dinheiro = Dinheiro + '". $desafio_aposta_dobro ."' WHERE ID = '". $usuario_1 ."'");

mysql_query("UPDATE Usuarios SET Desafio_Total = Desafio_Total + 1, Desafio_Derrotas = Desafio_Derrotas + 1, Desafio_Saldo = Desafio_Saldo - '". $desafio_aposta ."', Dinheiro = Dinheiro - '". $desafio_aposta ."' WHERE ID = '". $usuario_2 ."'");

} else if ($placar_2 > $placar_1) {

mysql_query("UPDATE Usuarios SET Desafio_Total = Desafio_Total + 1, Desafio_Vitorias = Desafio_Vitorias + 1, Desafio_Saldo = Desafio_Saldo + '". $desafio_aposta ."', Dinheiro = Dinheiro + '". $desafio_aposta ."' WHERE ID = '". $usuario_2 ."'");

mysql_query("UPDATE Usuarios SET Desafio_Total = Desafio_Total + 1, Desafio_Derrotas = Desafio_Derrotas + 1, Desafio_Saldo = Desafio_Saldo - '". $desafio_aposta ."' WHERE ID = '". $usuario_1 ."'");

}

$desafio_cod = rand(1000,9999);
$data = date("d/m");
$hora = date("H:i");

mysql_query("UPDATE Usuarios SET Desafio_Cod = '". $desafio_cod ."' WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");

$desafio_aposta = number_format($desafio_aposta,0,',','.');

if ($mc_vip > 0 and $usuario_vip > 0) {
	$mensagem = "Resultado: <span id=usuario_vip". $usuario_vip_cor ."><a href=usuario.php?id=". $usuario_id .">". $usuario_nome ."</a></span> ". $placar_1 ." x ". $placar_2 ." <span id=usuario_vip". $mc_vip_cor ."><a href=usuario.php?id=". $mc_id .">". $mc_nome ."</a></span> - Aposta: ".$desafio_aposta;
} else if ($mc_vip > 0 and $usuario_vip == 0) {
	$mensagem = "Resultado: <span id=usuario_normal><a href=usuario.php?id=". $usuario_id .">". $usuario_nome ."</a></span> ". $placar_1 ." x ". $placar_2 ." <span id=usuario_vip". $mc_vip_cor ."><a href=usuario.php?id=". $mc_id .">". $mc_nome ."</a></span> - Aposta: ".$desafio_aposta;
} else if ($mc_vip == 0 and $usuario_vip > 0) {
	$mensagem = "Resultado: <span id=usuario_vip". $usuario_vip_cor ."><a href=usuario.php?id=". $usuario_id .">". $usuario_nome ."</a></span> ". $placar_1 ." x ". $placar_2 ." <span id=usuario_normal><a href=usuario.php?id=". $mc_id .">". $mc_nome ."</a></span> - Aposta: ".$desafio_aposta;
} else {
	$mensagem = "Resultado: <span id=usuario_normal><a href=usuario.php?id=". $usuario_id .">". $usuario_nome ."</a></span> ". $placar_1 ." x ". $placar_2 ." <span id=usuario_normal><a href=usuario.php?id=". $mc_id .">". $mc_nome ."</a></span> - Aposta: ".$desafio_aposta;
}

mysql_query("INSERT INTO Mensagens_Usuario (Usuario,Para,Mensagem,Data,Hora) VALUES (0,'". $usuario_1 ."','". $mensagem ."','". $data ."','". $hora ."')");
mysql_query("INSERT INTO Mensagens_Usuario (Usuario,Para,Mensagem,Data,Hora) VALUES (0,'". $usuario_2 ."','". $mensagem ."','". $data ."','". $hora ."')");

header("Location: desafios.php"); break;
?>