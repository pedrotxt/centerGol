<?php
if ($_COOKIE["admid"]) {
	if (!ctype_alnum($_COOKIE["admid"])) {
		setcookie ("admid", "", time()-3600);
		header("Location: login.php"); break;
	}
}
?>