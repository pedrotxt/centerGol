<?php include("fun_anti_inj.php") ?>
<?php include("verificar_cookie.php") ?>
<?php include("conexao.php") ?>
<?php include("verificar_conexao.php") ?>
<?php
$pacote = anti_inj($_POST['pacote']);

if ($pacote != 1 and $pacote != 2 and $pacote != 3 and $pacote != 4 and $pacote != 5 and $pacote != 6 and $pacote != 7 and $pacote != 8 and $pacote != 9 and $pacote != 10) {
	header("Location: index.php"); break;
}

if ($pacote == 1) {
	$custo = 12;
	$vip = 30;
	$futcash = 0;
} else if ($pacote == 2) {
	$custo = 20;
	$vip = 60;
	$futcash = 0;
} else if ($pacote == 3) {
	$custo = 28;
	$vip = 130;
	$futcash = 0;
} else if ($pacote == 4) {
	$custo = 50;
	$vip = 260;
	$futcash = 0;
} else if ($pacote == 5) {
	$custo = 15;
	$vip = 0;
	$futcash = 75000;
} else if ($pacote == 6) {
	$custo = 20;
	$vip = 0;
	$futcash = 175000;
} else if ($pacote == 7) {
	$custo = 30;
	$vip = 0;
	$futcash = 325000;
} else if ($pacote == 8) {
	$custo = 28;
	$vip = 70;
	$futcash = 80000;
} else if ($pacote == 9) {
	$custo = 48;
	$vip = 150;
	$futcash = 180000;
} else if ($pacote == 10) {
	$custo = 90;
	$vip = 280;
	$futcash = 350000;
}

$query = mysql_query("SELECT ID, Fidelidade FROM Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$rs = mysql_fetch_array($query);

$mc_id = $rs["ID"];
$mc_pontos = $rs["Fidelidade"];

if ($mc_pontos < $custo) {
	header("Location: fidelidade.php?msg_fidelidade=2"); break;
}

mysql_query("UPDATE Usuarios SET Fidelidade = Fidelidade - '". $custo ."', VIP = VIP + '". $vip ."', Dinheiro = Dinheiro + '". $futcash ."' WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");

mysql_query("DELETE FROM Historico WHERE Usuario = '". $mc_id ."' AND Tipo = 5");

$acao = "trocou os Pontos de Fidelidade.";

mysql_query("INSERT INTO Historico (Usuario,Tipo,Acao) VALUES ('". $mc_id ."',5,'". $acao ."')");

header("Location: fidelidade.php?msg_fidelidade=1"); break;
?>