<?php include_once("fun_anti_inj.php") ?>
<?php include("verificar_cookie.php") ?>
<?php include("conexao.php") ?>
<?php include("verificar_conexao.php") ?>
<?php
$query = mysql_query("SELECT Passe_Certo_Tent, Falta_Tent, Penalti_Tent FROM Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$rs = mysql_fetch_array($query);

$mc_passe_certo_tent = $rs["Passe_Certo_Tent"];
$mc_falta_tent = $rs["Falta_Tent"];
$mc_penalti_tent = $rs["Penalti_Tent"];
?>
<?php if ($mc_passe_certo_tent == 0) { ?>
<div><img src="figuras/principal/botao_passe_certo0.png"></div>
<?php } else if ($mc_passe_certo_tent == 1) { ?>
		<div align="center"><a href="passe_certo.php"><img src="figuras/principal/botao_passe_certo1.png" border="0"></a></div>
<?php } else if ($mc_passe_certo_tent > 1) { ?>
		<div align="center"><a href="passe_certo.php"><img src="figuras/principal/botao_passe_certo2.png" border="0"></a></div>
<?php } ?>

<?php if ($mc_falta_tent == 0) { ?>
<div id="linha6"><img src="figuras/principal/botao_falta0.png"></div>
<?php } else if ($mc_falta_tent == 1) { ?>
		<div id="linha6" align="center"><a href="falta.php"><img src="figuras/principal/botao_falta1.png" border="0"></a></div>
<?php } else if ($mc_falta_tent > 1) { ?>
		<div id="linha6" align="center"><a href="falta.php"><img src="figuras/principal/botao_falta2.png" border="0"></a></div>
<?php } ?>

<?php if ($mc_penalti_tent == 0) { ?>
<div id="linha6"><img src="figuras/principal/botao_penalti0.png"></div>
<?php } else if ($mc_penalti_tent == 1) { ?>
		<div id="linha6" align="center"><a href="penalti.php"><img src="figuras/principal/botao_penalti1.png" border="0"></a></div>
<?php } else if ($mc_penalti_tent > 1) { ?>
		<div id="linha6" align="center"><a href="penalti.php"><img src="figuras/principal/botao_penalti2.png" border="0"></a></div>
<?php } ?>