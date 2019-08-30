<?php include("fun_anti_inj.php") ?>
<?php include("conexao.php") ?>
<?php include("verificar_conexao.php") ?>
<html>
<head>
<title>FutClube - Líder em Futebol Online!</title>
<link href="../css/style.css" rel="stylesheet" type="text/css">
</head>
<body topmargin="0" leftmargin="0" style="overflow: hidden">
<?php
$id = anti_inj($_GET['id']);

if (!$id) {
	die();
}

if (ereg('[^0-9]',$id)) {
	die();
}
?>

<div style="padding-top: 5"><span class="img16"><img width="16" height="16" src="../figuras/painel/alerta_sim.png"></span> Denúncia respondida com sucesso! <a href="stfc_responder.php?id=<?=$id?>">(escrever outra)</a>
</div>
</div>
</body>
</html>