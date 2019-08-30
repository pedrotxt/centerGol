<?php include_once("fun_anti_inj.php") ?>
<?php include("verificar_cookie.php") ?>
<?php include("conexao.php") ?>
<?php
$email = anti_inj(strtolower($_POST['email']));
$senha = anti_inj($_POST['senha']);

if (!$email or !$senha) {
	header("Location: index.php"); break;
}

$passe_certo_cod = rand(1000,9999);
$penalti_cod = rand(1000,9999);
$falta_cod = rand(1000,9999);
$desafio_cod = rand(1000,9999);

$query = mysql_query("SELECT ID, Time, VIP_Tempo, Banido, Secar, Confirmar, Energia, Veneno, Clone FROM Usuarios WHERE Email = '". $email ."' AND Senha = password('". $senha ."')");
$rs = mysql_fetch_array($query);

if ($rs) {

$mc_id = $rs["ID"];
$mc_time = $rs["Time"];
$mc_vip = $rs["VIP_Tempo"];
$mc_banido = $rs["Banido"];
$mc_secar = $rs["Secar"];
$mc_confirmar = $rs["Confirmar"];
$mc_energia = $rs["Energia"];
$mc_veneno = $rs["Veneno"];
$mc_clone = $rs["Clone"];

} else {
	header("Location: index.php?msg_autenticar=1"); break;
}

if ($mc_confirmar != "0") {
	header("Location: index.php?msg_autenticar=2"); break;
}

if ($mc_banido == 1) {
	header("Location: index.php?msg_autenticar=3"); break;
}

$query = mysql_query("SELECT Clone, Online_Record FROM Configuracoes");
$rs = mysql_fetch_array($query);

$clones = $rs["Clone"];
$online_record = $rs["Online_Record"];

if ($mc_clone == 0 and $mc_vip == 0) {
$mc_ip = $_SERVER["REMOTE_ADDR"];

$query = mysql_query("SELECT Count(ID) AS usuario_clones FROM Usuarios WHERE Status = 1 AND IP = '". $mc_ip ."'");
$rs = mysql_fetch_array($query);

$mc_clones = $rs["usuario_clones"] + 1;

if ($mc_clones > $clones) {
	header("Location: index.php?msg_autenticar=4"); break;
}

}

if ($mc_vip > time() and $mc_energia == 1) {
	$tempo_chutar = date("Y-m-d H:i:s", strtotime("+4 mins"));
} else if ($mc_vip > 0 and $mc_energia == 0) {
	$tempo_chutar = date("Y-m-d H:i:s", strtotime("+5 mins"));
} else {
	$tempo_chutar = date("Y-m-d H:i:s", strtotime("+8 mins"));
}

if ($mc_secar != 0 and $mc_veneno == 1) {
	$tempo_secar = date("Y-m-d H:i:s", strtotime("+11 mins"));
} else if ($mc_secar != 0 and $mc_veneno == 0) {
	$tempo_secar = date("Y-m-d H:i:s", strtotime("+12 mins"));
} else {
	$tempo_secar = date("Y-m-d H:i:s", strtotime("+12 mins"));
}

if ($mc_vip > 0 and $mc_secar != 0) {
	$tempo_entretenimentos = date("Y-m-d H:i:s", strtotime("+4 mins"));
} else if ($mc_vip > 0 and $mc_secar == 0) {
	$tempo_entretenimentos = date("Y-m-d H:i:s", strtotime("+5 mins"));
} else {
	$tempo_entretenimentos = date("Y-m-d H:i:s", strtotime("+10 mins"));
}

$cod_estrutura = $email ."". date("Y-m-d H:i:s");
$cod = md5($cod_estrutura);
$mc_ip = $_SERVER["REMOTE_ADDR"];

mysql_query("UPDATE Usuarios SET ID_Cod = password('". $cod ."'), Chutar_Tempo = '". $tempo_chutar ."', Secar_Tempo = '". $tempo_secar ."', Entretenimentos_Tempo = '". $tempo_entretenimentos ."', Passe_Certo_Cod = '". $passe_certo_cod ."', Penalti_Cod = '". $penalti_cod ."', Desafio_Cod = '". $desafio_cod ."', Recuperar = 0, Status = 1, Acessos = Acessos + 1, Ultimo_Acesso = '". date("Y-m-d H:i:s") ."', IP = '". $mc_ip ."' WHERE ID = '". $mc_id ."'");

mysql_query("UPDATE Amigos SET Ultimo_Acesso = '". date("Y-m-d H:i:s") ."' WHERE Amigo = '". $mc_id ."'");

setcookie("usuarioid", $cod, time()+31536000); 
setcookie("mcnivel", 0, time()+31536000); 
setcookie("mcitens", 0, time()+31536000); 

$query = mysql_query("SELECT Count(ID) AS online_quantidade FROM Usuarios WHERE Status = 1");
$rs = mysql_fetch_array($query);

$online_quantidade = $rs["online_quantidade"];

if ($online_quantidade > $online_record) {
	mysql_query("UPDATE Configuracoes SET Online_Record = '". $online_quantidade ."'");
}

header("Location: inicio.php"); break;
?>