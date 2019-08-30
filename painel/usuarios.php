<?php include("fun_anti_inj.php") ?>
<?php include("conexao.php") ?>
<?php include("verificar_conexao.php") ?>
<html>
<?php include("head.php") ?>
<body>
<script language="javascript">
function valida_procurar_id()
{
if (document.procurar_id.id.value==""){
alert("É necessário preencher o id.");
document.procurar_id.id.focus();
return false; }
}
function valida_procurar()
{
if (document.procurar.usuario.value==""){
alert("É necessário preencher o usuário.");
document.procurar.usuario.focus();
return false; }

if (document.procurar.usuario.value.length<2){
alert("É necessário preencher um usuário maior.");
document.procurar.usuario.focus();
return false; }
}
</script>
<center>
<table width="770" cellpadding="0" cellspacing="0">
	<tr>
		<td id="cima" colspan="2"><?php include("cima.php") ?></td>
	</tr>
	<tr>
		<td id="menu" align="right"><?php include("menu.php") ?></td>
		<td id="principal" align="center">

<form name="procurar_id" method="get" action="usuario.php" onSubmit="return valida_procurar_id()">
<table id="tabela" width="426" cellpadding="0" cellspacing="0">
	<tr>
		<td class="fonte_titulo1">Entrar por ID</td>
	</tr>
	<tr>
		<td align="center" style="padding-top: 10; padding-bottom: 10"><input name="id" type="text" class="fonte1" size="22" maxlength="10"></td>
	</tr>
	<tr>
		<td align="center" style="padding: 10"><input name="submit" type="submit" class="input2" onClick="return valida_procurar_id()" value="ENTRAR"></td>
	</tr>
</table>
</form>

<table>
	<tr>
		<td class="tabela_divisao"></td>
	</tr>
</table>
<table>
	<tr>
		<td class="tabela_divisao"></td>
	</tr>
</table>


<?php
ob_start();

$usuario = anti_inj($_POST['usuario']);

if ($usuario) {

if (!ctype_alnum($usuario)) {
	header("Location: usuarios.php"); break;
}

if (strlen($usuario) > 15) {
	header("Location: usuarios.php"); break;
}

}

ob_end_flush();
?>



<form name="procurar" method="post" action="usuarios.php" onSubmit="return valida_procurar()">
<table id="tabela" width="426" cellpadding="0" cellspacing="0">
	<tr>
		<td class="fonte_titulo1">Procurar por Usuário</td>
	</tr>
	<tr>
		<td align="center" style="padding-top: 10; padding-bottom: 10"><input name="usuario" type="text" class="fonte1" size="22" maxlength="15" value="<?=$usuario?>"></td>
	</tr>
	<tr>
		<td align="center" style="padding: 10"><input name="submit" type="submit" class="input2" onClick="return valida_procurar()" value="PROCURAR"></td>
	</tr>
</table>
</form>

<?php if ($usuario) { ?>





<?php
$query = mysql_query("SELECT Count(ID) AS procurar_quantidade FROM Usuarios WHERE Usuario like '%". $usuario ."%' AND Confirmar = '0'");
$rs = mysql_fetch_array($query);

$procurar_quantidade = $rs["procurar_quantidade"];
?>
<table>
	<tr>
		<td class="tabela_divisao"></td>
	</tr>
</table>

<table>
	<tr>
		<td class="tabela_divisao"></td>
	</tr>
</table>

<div class="conteudo" style="padding-top: 4px">

<?php if ($procurar_quantidade > 0) { ?>

<div id="linha6">

<table width="550" cellpadding="0" cellspacing="0">

<?php

$medalha = 0;
$query = mysql_query("SELECT ID FROM Usuarios WHERE Gols_Hora > 0 ORDER BY Gols_Hora DESC LIMIT 3");

while ($rs = mysql_fetch_array($query)) {

$medalha = $medalha + 1;

if ($medalha == 1) {
	$medalha_1 = $rs["ID"];
} else if ($medalha == 2) {
	$medalha_2 = $rs["ID"];
} else if ($medalha == 3) {
	$medalha_3 = $rs["ID"];
}

}

$query_wl = 0;

$query = mysql_query("SELECT Usuarios.ID as Usuario_ID, Usuarios.Usuario as Usuario_Nome, Usuarios.Nivel as Usuario_Nivel, Usuarios.Gols_Total as Usuario_Gols_Total, Usuarios.VIP as Usuario_VIP, Usuarios.VIP_Cor as Usuario_VIP_Cor, Times.Id as Time_ID, Times.Time as Time_Nome FROM Usuarios INNER JOIN Times ON Times.ID = Usuarios.Time WHERE Usuario like '%". $usuario ."%' AND Confirmar = '0' ORDER BY Gols_Total DESC LIMIT 30");

?>

<?php while ($rs = mysql_fetch_array($query)) { ?>

<?php $query_wl = $query_wl + 1; ?>

<?php if ($query_wl == 1) { ?>
	<tr height="25" bgcolor="#B6B6B6">
		<td width="238" style="padding-left: 31px" class="fonte1_negrito">Usuário</td>
		<td width="237" class="fonte1_negrito">Time</td>
		<td width="75" class="fonte1_negrito">Gols</td>
	</tr>
<?php } ?>

	<tr>
		<td style="padding-top: 5px"><span class="img25"><img width="25" height="25" src="../figuras/niveis/<?=$rs["Usuario_Nivel"]?>.png" title="<?=$rs["Usuario_Nivel"]?>" alt="<?=$rs["Usuario_Nivel"]?>"></span> <a href="usuario.php?id=<?=$rs["Usuario_ID"]?>"><?php if ($rs["Usuario_VIP"] > 0) { ?><span id="usuario_vip<?=$rs["Usuario_VIP_Cor"]?>"><?=$rs["Usuario_Nome"]?></span><?php } else { ?><span id="usuario_normal"><?=$rs["Usuario_Nome"]?></span><?php } ?></a></td>
		<td style="padding-top: 5px"><span class="img20"><a href="time.php?id=<?=$rs["Time_ID"]?>"><img width="20" height="20" src="../figuras/times_pequenos/<?=$rs["Time_ID"]?>.png" title="<?=$rs["Time_Nome"]?>" alt="<?=$rs["Time_Nome"]?>" border="0"></a></span> <a href="time.php?id=<?=$rs["Time_ID"]?>"><?=$rs["Time_Nome"]?></a></td>
		<td style="padding-top: 5px"><?=number_format($rs["Usuario_Gols_Total"],0,',','.')?></td>
	</tr>

<?php } ?>

</table>

</div>

<?php } else { ?>

<div id="linha6"><span class="img16"><img width="16" height="16" src="../figuras/painel/alerta_nao.png"></span> Nenhum usuário encontrado.</div>

<?php } ?>

<?php } ?>

</div>

		</td>
	</tr>
	<tr>
		<td id="baixo" colspan="2"><?php include("baixo.php") ?></td>
	</tr>
</table>
</center>
</body>
</html>