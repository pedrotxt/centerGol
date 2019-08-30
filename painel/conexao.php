<?php
/* MANUTENÇÃO
if ($_SERVER["REMOTE_ADDR"] <> "177.130.200.173") {
	header("Location: manutencao.php"); break;
}
*/

$db_host = "localhost";
$db_username = "dbzuo257_fut";
$db_password = "123456a";
$db_name = "dbzuo257_futclube";

$dbh = mysql_connect($db_host, $db_username, $db_password) or die("Não foi possível conectar.");

mysql_select_db($db_name, $dbh) or die("Não foi possível conectar.");
?>