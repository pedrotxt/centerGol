<head>
<title>FUTCLUBE - Área de Controle!</title>
<link rel="shortcut icon" href="../figuras/principal/futclube.ico">
<link href="../css/painel.css" rel="stylesheet" type="text/css" media="screen">
</head>
<?php
$query = mysql_query("SELECT Email, Nome, Cargo FROM Administradores WHERE ID_Cod = password('". $_COOKIE["admid"] ."')");
$rs = mysql_fetch_array($query);

if (!$rs) {
	die("<br><b>Tente novamente!</b> <meta http-equiv='refresh' content='1; url=logout.php'>");
}

$mc_email = $rs["Email"];
$mc_nome = $rs["Nome"];
$mc_cargo = $rs["Cargo"];
?>