<?php ob_start(); ?>
<?php include("fun_anti_inj.php") ?>
<?php include("conexao.php") ?>
<?php include("verificar_conexao.php") ?>
<html>
<?php include("head.php") ?>
<?php include("verificar_cargo.php") ?>
<?php ob_end_flush(); ?>
<body>
<center>

<table width="770" cellpadding="0" cellspacing="0">
	<tr>
		<td id="cima" colspan="2"><?php include("cima.php") ?></td>
	</tr>
	<tr>
		<td id="menu" align="right"><?php include("menu.php") ?></td>
		<td id="principal" align="center">

<table width="426" cellpadding="0" cellspacing="0">
	<tr>
		<td class="fonte_titulo2">Times / Onlines</td>
	</tr>
</table>
<table width="426" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td style="padding-top: 10; padding-bottom: 10">

<div id="linha10">

<table width="426" cellpadding="0" cellspacing="1">

<?php
$query = mysql_query("SELECT ID, Time FROM Times");
?>

<?php while ($rs = mysql_fetch_array($query)) { ?>

<?php
$query2 = mysql_query("SELECT Count(ID) AS online FROM Usuarios WHERE Time = '". $rs["ID"] ."' AND Status = 1");
$rs2 = mysql_fetch_array($query2);

$online = $rs2["online"];
?>
	<tr>
		<td width="220" style="padding: 3px 0 3px 5px"><a href="time.php?id=<?=$rs["ID"]?>"><span class="img20"><img width="20" height="20" src="../figuras/times_pequenos/<?=$rs["ID"]?>.png" title="<?=$rs["Time"]?>" alt="<?=$rs["Time"]?>" border="0"></span> <?=$rs["Time"]?></a></td>
		<td align="center" style="padding: 3px 0 3px 0"><?=$online?> onlines</td>
	</tr>

<?php } ?>

</table>

</div>

		</td>
	</tr>
</table>

		</td>
	</tr>
	<tr>
		<td id="baixo" colspan="2"><?php include("baixo.php") ?></td>
	</tr>
</table>
</center>
</body>
</html>