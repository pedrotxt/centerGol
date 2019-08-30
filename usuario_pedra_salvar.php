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

if (strlen($q) > 4) {
	header("Location: index.php"); break;
}

if ($q < 1 or $q > 1000) {
	header("Location: index.php"); break;
}

$query = mysql_query("SELECT Usuario, VIP, VIP_Cor, Sorte, Escudo FROM Usuarios WHERE ID = '". $id ."'");
$rs = mysql_fetch_array($query);

$usuario_nome = $rs["Usuario"];
$usuario_vip = $rs["VIP"];
$usuario_vip_cor = $rs["VIP_Cor"];
$usuario_sorte = $rs["Sorte"];
$usuario_escudo = $rs["Escudo"];

if ($usuario_escudo == 1) {
	header("Location: usuario_pedra.php?id=".$id); break;
}

if ($usuario_sorte == 0) {
	header("Location: usuario_pedra.php?id=".$id); break;
}

$query = mysql_query("SELECT ID, Usuario, Dinheiro, Item_Pedra, VIP, VIP_Cor FROM Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$rs = mysql_fetch_array($query);

$mc_id = $rs["ID"];
$mc_nome = $rs["Usuario"];
$mc_dinheiro = $rs["Dinheiro"];
$mc_item_pedra = $rs["Item_Pedra"];
$mc_vip = $rs["VIP"];
$mc_vip_cor = $rs["VIP_Cor"];

if ($id == $mc_id) {
	header("Location: index.php"); break;
}

if ($mc_dinheiro < 100) {
	header("Location: usuario_pedra.php?id=". $id ."&msg_jogar_pedra=2"); break;
}

if ($q > $mc_item_pedra) {
	header("Location: usuario_pedra.php?id=". $id ."&msg_jogar_pedra=3"); break;
}

if ($q > $usuario_sorte) {
	$q = $usuario_sorte;
}

mysql_query("UPDATE Usuarios SET Dinheiro = Dinheiro - 100, Item_Pedra = Item_Pedra - '". $q ."' WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");

mysql_query("UPDATE Usuarios SET Sorte = Sorte - '". $q ."' WHERE ID = '". $id ."'");

if ($usuario_vip > 0 and $q == 1) {
	$acao = "jogou 1 Pedra em <span id=usuario_vip". $usuario_vip_cor ."><a href=usuario.php?id=". $id .">". $usuario_nome ."</a></span>.";
} else if ($usuario_vip > 0 and $q > 1) {
	$acao = "jogou ". number_format($q,0,',','.') ." Pedras em <span id=usuario_vip". $usuario_vip_cor ."><a href=usuario.php?id=". $id .">". $usuario_nome ."</a></span>.";
} else if ($usuario_vip == 0 and $q == 1) {
	$acao = "jogou 1 Pedra em <span id=usuario_normal><a href=usuario.php?id=". $id .">". $usuario_nome ."</a></span>.";
} else if ($usuario_vip == 0 and $q > 1) {
	$acao = "jogou ". number_format($q,0,',','.') ." Pedras em <span id=usuario_normal><a href=usuario.php?id=". $id .">". $usuario_nome ."</a></span>.";
}

mysql_query("INSERT INTO Historico (Usuario,Tipo,Acao) VALUES ('". $mc_id ."',14,'". $acao ."')");

$data = date("d/m");
$hora = date("H:i");

if ($mc_vip > 0 and $q == 1) {
	$mensagem = "Usuário <span id=usuario_vip". $mc_vip_cor ."><a href=usuario.php?id=". $mc_id .">". $mc_nome ."</a></span> jogou 1 Pedra em você.";
} else if ($mc_vip > 0 and $q > 1) {
	$mensagem = "Usuário <span id=usuario_vip". $mc_vip_cor ."><a href=usuario.php?id=". $mc_id .">". $mc_nome ."</a></span> jogou ". number_format($q,0,',','.') ." Pedras em você.";
} else if ($mc_vip == 0 and $q == 1) {
	$mensagem = "Usuário <span id=usuario_normal><a href=usuario.php?id=". $mc_id .">". $mc_nome ."</a></span> jogou 1 Pedra em você.";
} else if ($mc_vip == 0 and $q > 1) {
	$mensagem = "Usuário <span id=usuario_normal><a href=usuario.php?id=". $mc_id .">". $mc_nome ."</a></span> jogou ". number_format($q,0,',','.') ." Pedras em você.";
}

mysql_query("INSERT INTO Mensagens_Usuario (Usuario,Para,Mensagem,Data,Hora) VALUES (0,'". $id ."','". $mensagem ."','". $data ."','". $hora ."')");

header("Location: usuario_pedra.php?id=". $id ."&msg_jogar_pedra=1"); break;
?>