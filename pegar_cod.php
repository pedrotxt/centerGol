<?php include_once("fun_anti_inj.php") ?>
<?php include("verificar_cookie.php") ?>
<?php include("conexao.php") ?>
<?php include("verificar_conexao.php") ?> 
<?php
$id = anti_inj($_POST['id']);

if ($id == 1) {

$query = mysql_query("SELECT Passe_Certo_Cod FROM Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$result = mysql_fetch_array($query);

$mc_cod = $result["Passe_Certo_Cod"];

echo "&cod_imp=". $mc_cod;

} else if ($id == 2) {

$query = mysql_query("SELECT Penalti_Cod FROM Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$result = mysql_fetch_array($query);

$mc_cod = $result["Penalti_Cod"];

echo "&cod_imp=". $mc_cod;

}
?>