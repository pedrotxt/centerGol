<?php include_once("fun_anti_inj.php") ?>
<?php include("verificar_cookie.php") ?>
<?php include("conexao.php") ?>
<?php include("verificar_conexao.php") ?>
<?php

$query = mysql_query("SELECT Dinheiro,Presidente_Dias FROM Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$rs = mysql_fetch_array($query);

$mc_dinheiro = $rs["Dinheiro"];
$mc_presidente_tempo = $rs['Presidente_Dias'];
$valor = 200000;
$valor_total = $valor;

if ($valor_total > $mc_dinheiro) {
	header("Location: itens_comprar.php?msg_comprar=1"); break;
}

if($mc_presidente_tempo < time()){
$valorp=time()+20*86400;
}else{
$valorp=20*86400;
}

mysql_query("UPDATE Usuarios SET Dinheiro = Dinheiro - '". $valor_total ."', Presidente_Dias = Presidente_Dias + '". $valorp ."' WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");

header("Location: itens_comprar.php?msg_comprar=8"); break;
?>