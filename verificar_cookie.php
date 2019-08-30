<?php
if ($_COOKIE["usuarioid"]) {
	if (!ctype_alnum($_COOKIE["usuarioid"]) or ereg('[^0-1]',$_COOKIE["mcnivel"]) or ereg('[^0-1]',$_COOKIE["mcitens"])) {
		setcookie ("usuarioid", "", time()-3600);
		setcookie ("mcnivel", "", time()-3600);
		setcookie ("mcitens", "", time()-3600);
		header("Location: index.php"); break;
	}
}

?>
