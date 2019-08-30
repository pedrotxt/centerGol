<?php ob_start(); ?>
<?php include_once("fun_anti_inj.php") ?>
<?php include("verificar_cookie.php") ?>
<?php include("conexao.php") ?>
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
function somente_numeros(evt) {

var key_code = evt.keyCode  ? evt.keyCode  :
				evt.charCode ? evt.charCode :
				evt.which    ? evt.which    : void 0;

if (key_code == 8 ||  key_code == 9 ||  key_code == 13 || key_code == 48 ||  key_code == 49 ||  key_code == 50 ||  key_code == 51 ||  key_code == 52 ||  key_code == 53 ||  key_code == 54 ||  key_code == 55 ||  key_code == 56 ||  key_code == 57) { return true; }

return false;

}

function valida_nivel() {

if (document.nivel.nivel.value=="") {
	alert("É necessário preencher o nível.");
	document.nivel.nivel.focus();
	return false;
}

if (document.nivel.nivel.value==0 || document.nivel.nivel.value==1) {
	alert("É necessário preencher um nível maior.");
	document.nivel.nivel.focus();
	return false;
}

}
</script>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Níveis</h1></div></div></div>
	<div class="conteudo">

<?php if (anti_inj($_GET["msg_nivel"]) == 1) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Preencha um nível maior!</div>

<?php } else if (anti_inj($_GET["msg_nivel"]) == 2) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Preencha um nível menor!</div>

<?php } ?>

<?php
$nivel = anti_inj($_POST['nivel']);

if ($nivel) {

if (ereg('[^0-9]',$nivel)) {
	header("Location: index.php"); break;
}

if (strlen($nivel) > 4) {
	header("Location: index.php"); break;
}

if ($nivel == 0 or $nivel == 1) {
	header("Location: niveis.php?msg_nivel=1"); break;
}

if ($nivel > 1000) {
	header("Location: niveis.php?msg_nivel=2"); break;
}

}

ob_end_flush();
?>

<form name="nivel" method="post" action="niveis.php" onSubmit="return valida_nivel()">
<div id="linha10"><span class="fonte_form">Qual o nível desejado?</span> <span class="align_form"><input name="nivel" type="text" maxlength="4" value="<?=$nivel?>" style="width: 60px; height: 20px" onKeyPress="return somente_numeros(event);"></span></div>

<div id="linha12"><input name="submit" type="image" src="figuras/principal/botao_confirmar.png" onClick="return valida_nivel()"></div>
</form>

<script language="javascript">
document.nivel.nivel.focus();
</script>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<?php if (!$nivel) { ?>

<div id="divide"></div>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Importante</h1></div></div></div>
	<div class="conteudo">

<div id="linha10">Veja algumas informações sobre o nível desejado.</div>
<div id="linha10">Sistema com 1.000 níveis até o momento.</div>
<div id="linha10">Preencha o nível somente com números.</div>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<?php } ?>

<?php if ($nivel) { ?>

<?php
$query = mysql_query("SELECT Count(ID) AS nivel_quantidade FROM Usuarios WHERE Nivel = '". $nivel ."'");
$rs = mysql_fetch_array($query);

$nivel_quantidade = $rs["nivel_quantidade"];

$query = mysql_query("SELECT Gols FROM Niveis WHERE Nivel = '". $nivel ."'");
$rs = mysql_fetch_array($query);

$nivel_gols = $rs["Gols"];
?>

<div id="divide"></div>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Sobre o Nível <?=number_format($nivel,0,',','.')?></h1></div></div></div>
	<div class="conteudo">

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/bola.png" title="Gols" alt="Gols"></span> <b>Gols:</b>  <?=number_format($nivel_gols,0,',','.')?></div>
<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/usuario.png" title="Usuários" alt="Usuários"></span> <b>Usuários:</b>  <?=number_format($nivel_quantidade,0,',','.')?></div>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<div id="divide"></div>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Melhores do Nível</h1></div></div></div>
	<div class="conteudo" style="padding-top: 4px">

<?php if ($nivel_quantidade > 0) { ?>

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

$query = mysql_query("SELECT Usuarios.ID as Usuario_ID, Usuarios.Usuario as Usuario_Nome, Usuarios.Nivel as Usuario_Nivel, Usuarios.Gols_Total as Usuario_Gols_Total, Usuarios.VIP as Usuario_VIP, Usuarios.VIP_Cor as Usuario_VIP_Cor, Times.ID as Time_ID, Times.Time as Time_Nome FROM Usuarios INNER JOIN Times ON Times.ID = Usuarios.Time WHERE Nivel = '". $nivel ."' ORDER BY Gols_Total DESC LIMIT 5");

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
		<td style="padding-top: 5px"><span class="img25"><img width="25" height="25" src="figuras/niveis/<?=$rs["Usuario_Nivel"]?>.png" title="<?=$rs["Usuario_Nivel"]?>" alt="<?=$rs["Usuario_Nivel"]?>"></span> <a href="usuario.php?id=<?=$rs["Usuario_ID"]?>"><?php if ($rs["Usuario_VIP"] > 0) { ?><span id="usuario_vip<?=$rs["Usuario_VIP_Cor"]?>"><?=$rs["Usuario_Nome"]?></span><?php } else { ?><span id="usuario_normal"><?=$rs["Usuario_Nome"]?></span><?php } ?></a> <?php if ($rs["Usuario_ID"] == $medalha_1) { ?><span class="medalha"><img width="16" height="16" src="figuras/principal/medalha1.png" title="Top 1 da Hora" alt="Top 1 da Hora"></span><?php } else if ($rs["Usuario_ID"] == $medalha_2) { ?><span class="medalha"><img width="16" height="16" src="figuras/principal/medalha2.png" title="Top 2 da Hora" alt="Top 2 da Hora"></span><?php } else if ($rs["Usuario_ID"] == $medalha_3) { ?><span class="medalha"><img width="16" height="16" src="figuras/principal/medalha3.png" title="Top 3 da Hora" alt="Top 3 da Hora"></span><?php } ?></td>
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