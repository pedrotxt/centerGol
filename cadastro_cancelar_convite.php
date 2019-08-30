<?php
if (!$_COOKIE["convite"]) {
	header("Location: index.php"); break;
}

setcookie ("convite", "", time()-3600);

header("Location: cadastro.php?c=1"); break;
?>