<?php ob_start(); ?>
<?php include_once("fun_anti_inj.php") ?>
<?php include("verificar_cookie.php") ?>
<?php include("conexao.php") ?>
<?php include("verificar_conexao.php") ?>
<?php
$pid = anti_inj($_POST['pid']);

if (!$pid) {
	header("Location: index.php"); break;
}

if (ereg('[^0-9]',$pid)) {
	header("Location: index.php"); break;
}

$query = mysql_query("SELECT ID, Usuario, Item, Quantidade, Valor FROM Mercado WHERE ID = '". $pid ."'");
$rs = mysql_fetch_array($query);

if (!$rs) {
	header("Location: index.php"); break;
}

$mercado_id = $rs["ID"];
$mercado_usuario = $rs["Usuario"];
$mercado_item = $rs["Item"];
$mercado_quantidade = $rs["Quantidade"];
$mercado_valor = $rs["Valor"];

$query = mysql_query("SELECT ID, Usuario, Dinheiro, VIP_Tempo, VIP_Cor FROM Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$rs = mysql_fetch_array($query);

$mc_id = $rs["ID"];
$mc_nome = $rs["Usuario"];
$mc_dinheiro = $rs["Dinheiro"];
$mc_vip = $rs["VIP_Tempo"];
$mc_vip_cor = $rs["VIP_Cor"];

if ($mercado_usuario == $mc_id) {
	header("Location: mercado.php?id=". $mercado_usuario ."&msg_mercado=4"); break;
}

if ($mercado_valor > $mc_dinheiro) {
	header("Location: mercado.php?id=". $mercado_usuario ."&msg_mercado=2"); break;
}

$query = mysql_query("SELECT Usuario, VIP, VIP_Cor, Item_Sorte, Item_Pedra, Item_Energia, Item_Sacola, Item_Veneno, Item_Escudo, Rescisao_Dias_VIP FROM Usuarios WHERE ID = '". $mercado_usuario ."'");
$rs = mysql_fetch_array($query);

$usuario_nome = $rs["Usuario"];
$usuario_vip_cor = $rs["VIP_Cor"];
$usuario_sorte = $rs["Item_Sorte"];
$usuario_pedra = $rs["Item_Pedra"];
$usuario_energia = $rs["Item_Energia"];
$usuario_sacola = $rs["Item_Sacola"];
$usuario_veneno = $rs["Item_Veneno"];
$usuario_escudo = $rs["Item_Escudo"];
$usuario_vip = $rs["VIP"] - 1;
$usuario_vip_rescisao = $rs["Rescisao_Dias_VIP"];
$usuario_vip_total = $usuario_vip - $usuario_vip_rescisao;

if ($mercado_item == 1 and $usuario_sorte < $mercado_quantidade) {
	header("Location: mercado.php?id=". $mercado_usuario ."&msg_mercado=3"); break;
}

if ($mercado_item == 2 and $usuario_pedra < $mercado_quantidade) {
	header("Location: mercado.php?id=". $mercado_usuario ."&msg_mercado=3"); break;
}

if ($mercado_item == 3 and $usuario_energia < $mercado_quantidade) {
	header("Location: mercado.php?id=". $mercado_usuario ."&msg_mercado=3"); break;
}

if ($mercado_item == 4 and $usuario_sacola < $mercado_quantidade) {
	header("Location: mercado.php?id=". $mercado_usuario ."&msg_mercado=3"); break;
}

if ($mercado_item == 5 and $usuario_veneno < $mercado_quantidade) {
	header("Location: mercado.php?id=". $mercado_usuario ."&msg_mercado=3"); break;
}

if ($mercado_item == 6 and $usuario_escudo < $mercado_quantidade) {
	header("Location: mercado.php?id=". $mercado_usuario ."&msg_mercado=3"); break;
}

if ($mercado_item == 7 and $usuario_vip_total <= 0 or $mercado_item == 7 and $usuario_vip_total < $mercado_quantidade) {
	header("Location: mercado.php?id=". $mercado_usuario ."&msg_mercado=3"); break;
}

mysql_query("DELETE FROM Mercado WHERE ID = '". $mercado_id ."'");


if ($mercado_item == 1) {

mysql_query("UPDATE Usuarios SET Dinheiro = Dinheiro - '". $mercado_valor ."', Item_Sorte = Item_Sorte + '". $mercado_quantidade ."' WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
mysql_query("UPDATE Usuarios SET Dinheiro = Dinheiro + '". $mercado_valor ."', Item_Sorte = Item_Sorte - '". $mercado_quantidade ."', Mercado_Itens = Mercado_Itens - 1 WHERE ID = '". $mercado_usuario ."'");

} else if ($mercado_item == 2) {

mysql_query("UPDATE Usuarios SET Dinheiro = Dinheiro - '". $mercado_valor ."', Item_Pedra = Item_Pedra + '". $mercado_quantidade ."' WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
mysql_query("UPDATE Usuarios SET Dinheiro = Dinheiro + '". $mercado_valor ."', Item_Pedra = Item_Pedra - '". $mercado_quantidade ."', Mercado_Itens = Mercado_Itens - 1 WHERE ID = '". $mercado_usuario ."'");

} else if ($mercado_item == 3) {

mysql_query("UPDATE Usuarios SET Dinheiro = Dinheiro - '". $mercado_valor ."', Item_Energia = Item_Energia + '". $mercado_quantidade ."' WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
mysql_query("UPDATE Usuarios SET Dinheiro = Dinheiro + '". $mercado_valor ."', Item_Energia = Item_Energia - '". $mercado_quantidade ."', Mercado_Itens = Mercado_Itens - 1 WHERE ID = '". $mercado_usuario ."'");

} else if ($mercado_item == 4) {

mysql_query("UPDATE Usuarios SET Dinheiro = Dinheiro - '". $mercado_valor ."', Item_Sacola = Item_Sacola + '". $mercado_quantidade ."' WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
mysql_query("UPDATE Usuarios SET Dinheiro = Dinheiro + '". $mercado_valor ."', Item_Sacola = Item_Sacola - '". $mercado_quantidade ."', Mercado_Itens = Mercado_Itens - 1 WHERE ID = '". $mercado_usuario ."'");

} else if ($mercado_item == 5) {

mysql_query("UPDATE Usuarios SET Dinheiro = Dinheiro - '". $mercado_valor ."', Item_Veneno = Item_Veneno + '". $mercado_quantidade ."' WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
mysql_query("UPDATE Usuarios SET Dinheiro = Dinheiro + '". $mercado_valor ."', Item_Veneno = Item_Veneno - '". $mercado_quantidade ."', Mercado_Itens = Mercado_Itens - 1 WHERE ID = '". $mercado_usuario ."'");

} else if ($mercado_item == 6) {

mysql_query("UPDATE Usuarios SET Dinheiro = Dinheiro - '". $mercado_valor ."', Item_Escudo = Item_Escudo + '". $mercado_quantidade ."' WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
mysql_query("UPDATE Usuarios SET Dinheiro = Dinheiro + '". $mercado_valor ."', Item_Escudo = Item_Escudo - '". $mercado_quantidade ."', Mercado_Itens = Mercado_Itens - 1 WHERE ID = '". $mercado_usuario ."'");


} else if ($mercado_item == 7) {
	
$query = mysql_query("SELECT VIP_Tempo FROM Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$vip = mysql_fetch_array($query);
$mc_vip_tempo = $vip["VIP_Tempo"];
if($mc_vip_tempo < time()){
mysql_query("UPDATE Usuarios SET Dinheiro = Dinheiro - '". $mercado_valor ."', VIP_Tempo = '". (time()+$mercado_quantidade*86400) ."' WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
mysql_query("UPDATE Usuarios SET Dinheiro = Dinheiro + '". $mercado_valor ."', VIP = VIP - '". $mercado_quantidade ."', Mercado_Itens = Mercado_Itens - 1 WHERE ID = '". $mercado_usuario ."'");
}else{
mysql_query("UPDATE Usuarios SET Dinheiro = Dinheiro - '". $mercado_valor ."', VIP_Tempo = VIP_Tempo + '". ($mercado_quantidade*86400) ."' WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
mysql_query("UPDATE Usuarios SET Dinheiro = Dinheiro + '". $mercado_valor ."', VIP = VIP - '". $mercado_quantidade ."', Mercado_Itens = Mercado_Itens - 1 WHERE ID = '". $mercado_usuario ."'");
}

}

if ($mercado_item == 1 and $mercado_quantidade == 1) {
	$item_nome = "Sorte";
} else if ($mercado_item == 1 and $mercado_quantidade > 1) {
	$item_nome = "Sortes";
} else if ($mercado_item == 2 and $mercado_quantidade == 1) {
	$item_nome = "Pedra";
} else if ($mercado_item == 2 and $mercado_quantidade > 1) {
	$item_nome = "Pedras";
} else if ($mercado_item == 3 and $mercado_quantidade == 1) {
	$item_nome = "Energia";
} else if ($mercado_item == 3 and $mercado_quantidade > 1) {
	$item_nome = "Energias";
} else if ($mercado_item == 4 and $mercado_quantidade == 1) {
	$item_nome = "Sacola";
} else if ($mercado_item == 4 and $mercado_quantidade > 1) {
	$item_nome = "Sacolas";
} else if ($mercado_item == 5 and $mercado_quantidade == 1) {
	$item_nome = "Veneno";
} else if ($mercado_item == 5 and $mercado_quantidade > 1) {
	$item_nome = "Venenos";
} else if ($mercado_item == 6 and $mercado_quantidade == 1) {
	$item_nome = "Escudo";
} else if ($mercado_item == 6 and $mercado_quantidade > 1) {
	$item_nome = "Escudos";
} else if ($mercado_item == 7) {
	$item_nome = "VIP";
}

$item_nome_msg = $mercado_quantidade ." ". $item_nome;

$data = date("d/m");
$hora = date("H:i");

if ($mc_vip < time()) {
	$mensagem = "Usuário <span id=usuario_vip". $mc_vip_cor ."><a href=usuario.php?id=". $mc_id .">". $mc_nome ."</a></span> comprou o pacote de ". $item_nome_msg ." no seu mercado.";
} else {
	$mensagem = "Usuário <span id=usuario_normal><a href=usuario.php?id=". $mc_id .">". $mc_nome ."</a></span> comprou o pacote de ". $item_nome_msg ." no seu mercado.";
}

mysql_query("INSERT INTO Mensagens_Usuario (Usuario,Para,Mensagem,Data,Hora) VALUES (0,'". $mercado_usuario ."','". $mensagem ."','". $data ."','". $hora ."')");

if ($usuario_vip > 0) {
	$acao = "comprou no mercado de <span id=usuario_vip". $usuario_vip_cor ."><a href=usuario.php?id=". $mercado_usuario .">". $usuario_nome ."</a></span>.";
} else {
	$acao = "comprou no mercado de <span id=usuario_normal><a href=usuario.php?id=". $mercado_usuario .">". $usuario_nome ."</a></span>.";
}

mysql_query("INSERT INTO Historico (Usuario,Tipo,Acao) VALUES ('". $mc_id ."',19,'". $acao ."')");

header("Location: mercado.php?id=". $mercado_usuario ."&msg_mercado=1"); break;

ob_end_flush();
?>