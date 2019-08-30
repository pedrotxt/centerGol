<?php include_once("fun_anti_inj.php") ?>
<?php include("verificar_cookie.php") ?>
<?php
if ($_COOKIE["usuarioid"]) {
	header("Location: index.php"); break;
}

$id = anti_inj($_GET['id']);

if (ereg('[^0-9]',$id)) {
	header("Location: index.php"); break;
}

setcookie("convite", $id, time()+3600);

header("Location: login.php"); break;
?>