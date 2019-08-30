<?php
function anti_inj($str) {
if (!is_numeric($str)) {
	$str = get_magic_quotes_gpc() ? stripslashes($str) : $str;
	$str = function_exists('mysql_real_escape_string') ? mysql_real_escape_string($str) : mysql_escape_string($str);
}
return strip_tags($str);
}
?>