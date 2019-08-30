<?php
if (!$_COOKIE["usuarioid"]) {
	header("Location: restrito.php"); break;
}
?>