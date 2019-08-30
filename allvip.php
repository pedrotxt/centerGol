<?php ob_start(); ?>
<?php include_once("fun_anti_inj.php") ?>
<?php include("verificar_cookie.php") ?>
<?php include("conexao.php") ?>


<?
mysql_query("update Usuarios set VIP_Tempo=VIP_Tempo+(60*60*24*2) where VIP_Tempo>='".time()."'");
mysql_query("update Usuarios set VIP_Tempo='".time()."'+(60*60*24*2) where VIP_Tempo<'".time()."'");


?>