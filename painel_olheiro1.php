<?php ob_start(); ?>
<?php include_once("fun_anti_inj.php") ?>
<?php include("verificar_cookie.php") ?>
<?php include("conexao.php") ?>
<?php include("verificar_conexao.php") ?>
<?php include("verificar_cargo.php") ?>
<!DOCTYPE html>
<html>
<?php include("head.php") ?>
<body>
<div id="container">
<div id="cima"><?php include("cima.php") ?></div>
<div id="conteudo">

<div id="esquerda"><?php include("esquerda.php") ?></div>
<div id="direita"><?php include("direita.php") ?></div>
<div id="principal">
<!-- INÍCIO DA PÁGINA -->


<script language="javascript">
function valida_procurar() {

if (document.procurar.usuario.value=="") {
	alert("É necessário preencher o nome.");
	document.procurar.usuario.focus();
	return false;
}

if (document.procurar.usuario.value.length<2) {
	alert("É necessário preencher um nome maior.");
	document.procurar.usuario.focus();
	return false;
}

}
</script>

<?php
if ($eu_presidente == 0) {
	header("Location: index.php"); break;
}

$usuario = anti_inj($_POST['usuario']);

if ($usuario) {

if (!ctype_alnum($usuario)) {
	header("Location: index.php"); break;
}

if (strlen($usuario) > 15) {
	header("Location: index.php"); break;
}

}

$query = mysql_query("SELECT Olheiro_1 FROM Times WHERE ID = '". $mc_time ."'");
$rs = mysql_fetch_array($query);

$olheiro_1 = $rs["Olheiro_1"];

if ($olheiro_1 != 0) {
	header("Location: index.php"); break;
}

$query = mysql_query("SELECT Usuario FROM Cargos WHERE Time = '". $mc_time ."' AND Cargo = 2");
$rs = mysql_fetch_array($query);

if ($rs) {
	header("Location: index.php"); break;
}

ob_end_flush();
?>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Convidar Olheiro 1</h1></div></div></div>
	<div class="conteudo">

<?php if (anti_inj($_GET["msg_cupula"]) == 1) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Esse usuário tem outro cargo no seu time!</div>

<?php } ?>

<form name="procurar" method="post" action="painel_olheiro1.php" onSubmit="return valida_procurar()">
<div id="linha10"><span class="fonte_form">Qual o nome do usuário?</span> <span class="align_form"><input name="usuario" type="text" maxlength="15" value="<?=$usuario?>" style="width: 200px; height: 20px"></span></div>

<div id="linha12"><input name="submit" type="image" src="figuras/principal/botao_procurar_interno.png" onClick="return valida_procurar()"> <a href="painel_cupula.php"><img src="figuras/principal/botao_voltar.png" border="0"></a></div>
</form>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<?php if (!$usuario) { ?>

<div id="divide"></div>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Importante</h1></div></div></div>
	<div class="conteudo">

<div id="linha10">Para convidar o usuário, basta clicar no nome dele.</div>
<div id="linha10">Sistema listará apenas 30 resultados em ordem de gols.</div>
<div id="linha10">Seja o mais preciso possível na sua busca.</div>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<?php } else { ?>

<?php
$query = mysql_query("SELECT Count(ID) AS procurar_quantidade FROM Usuarios WHERE Usuario like '%". $usuario ."%' AND Time = '". $mc_time ."' AND ID <> '". $mc_id ."' AND Confirmar = '0'");
$rs = mysql_fetch_array($query);

$procurar_quantidade = $rs["procurar_quantidade"];
?>
<div id="divide"></div>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Resultado</h1></div></div></div>
	<div class="conteudo" style="padding-top: 4px">

<?php if ($procurar_quantidade > 0) { ?>

<div id="linha6">

<table width="550" cellpadding="0" cellspacing="0">

<?php

$query_wl = 0;

$query = mysql_query("SELECT Usuarios.ID as Usuario_ID, Usuarios.Usuario as Usuario_Nome, Usuarios.Nivel as Usuario_Nivel, Usuarios.Gols_Total as Usuario_Gols_Total, Usuarios.VIP as Usuario_VIP, Usuarios.VIP_Cor as Usuario_VIP_Cor, Times.Id as Time_ID, Times.Time as Time_Nome FROM Usuarios INNER JOIN Times ON Times.ID = Usuarios.Time WHERE Usuario like '%". $usuario ."%' AND Usuarios.Time = '". $mc_time ."' AND Usuarios.ID <> '". $mc_id ."' AND Confirmar = '0' ORDER BY Gols_Total DESC LIMIT 30");

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
		<td style="padding-top: 5px"><span class="img25"><img width="25" height="25" src="figuras/niveis/<?=$rs["Usuario_Nivel"]?>.png" title="<?=$rs["Usuario_Nivel"]?>" alt="<?=$rs["Usuario_Nivel"]?>"></span> <a href="painel_olheiro1_salvar.php?id=<?=$rs["Usuario_ID"]?>"><?php if ($rs["Usuario_VIP"] > 0) { ?><span id="usuario_vip<?=$rs["Usuario_VIP_Cor"]?>"><?=$rs["Usuario_Nome"]?></span><?php } else { ?><span id="usuario_normal"><?=$rs["Usuario_Nome"]?></span><?php } ?></a></td>
		<td style="padding-top: 5px"><span class="img20"><a href="time.php?id=<?=$rs["Time_ID"]?>"><img width="20" height="20" src="figuras/times_pequenos/<?=$rs["Time_ID"]?>.png" title="<?=$rs["Time_Nome"]?>" alt="<?=$rs["Time_Nome"]?>" border="0"></a></span> <a href="time.php?id=<?=$rs["Time_ID"]?>"><?=$rs["Time_Nome"]?></a></td>
		<td style="padding-top: 5px"><?=number_format($rs["Usuario_Gols_Total"],0,',','.')?></td>
	</tr>

<?php } ?>

</table>

</div>

<?php } else { ?>

<div id="linha6"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Nenhum usuário encontrado.</div>

<?php } ?>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<?php } ?>


<!-- FIM DA PÁGINA -->
</div>
<div class="clear"></div>

</div>
<div id="baixo"><?php include("baixo.php") ?></div>
</div>
</body>
</html>