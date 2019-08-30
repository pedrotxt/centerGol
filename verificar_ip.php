<?php include_once("fun_anti_inj.php") ?>
<?php include("verificar_cookie.php") ?>
<?php include("conexao.php") ?>
<?php


if ($_COOKIE["usuarioid"]) {
$query = mysql_query("SELECT * FROM Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$ver_ip = mysql_fetch_array($query);
$mc_ip = $_SERVER["REMOTE_ADDR"];
if($mc_ip <> $ver_ip['IP']){
mysql_query("UPDATE Usuarios SET IP='".$mc_ip."' WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
}
$query = mysql_query("SELECT Clone, Online_Record FROM Configuracoes");
$rs = mysql_fetch_array($query);
$clones = $rs["Clone"];
$query = mysql_query("SELECT Count(ID) AS usuario_clones FROM Usuarios WHERE Status = 1 AND IP = '". $mc_ip ."'");
$rs = mysql_fetch_array($query);
$mc_clones = $rs["usuario_clones"] + 1;

if ($mc_clones > $clones) {
	alerta('Você foi deslogado por conter + de 3 contas logadas com mesmo IP!'); 
	redirect('logout.php');

}
	}
?>