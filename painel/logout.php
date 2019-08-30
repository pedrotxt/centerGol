<?php include("fun_anti_inj.php") ?>
<?php include("verificar_cookie.php") ?>
<?php
setcookie ("admid", "", time()-3600);

header("Location: login.php"); break;
?>