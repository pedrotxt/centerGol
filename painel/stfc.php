<?php include("fun_anti_inj.php") ?>
<?php include("conexao.php") ?>
<?php include("verificar_conexao.php") ?>
<html>
<?php include("head.php") ?>
<body>
<center>
<?php
$p = anti_inj($_GET['p']);

if (ereg('[^0-9]',$p)) {
	header("Location: stfc.php"); break;
}

if (!$p) {
	$p = 1;
}

$limite = 10;
$inicio = $p - 1;
$inicio = $limite * $inicio;

$query = mysql_query("SELECT Count(ID) AS stfc_quantidade FROM STFC");
$rs = mysql_fetch_array($query);

$stfc_quantidade = $rs["stfc_quantidade"];

$p_total = ceil($stfc_quantidade / $limite);

if ($p_total < 1) {
	$p_total = 1;
}

if ($p > $p_total) {
	header("Location: stfc.php?p=1"); break;
}
?>

<script language="javascript">
var checkflag = "false";
function check(field) {
        if (checkflag == "false") {
            for (i = 0; i < field.length; i++) {
                field[i].checked = true;
            }
            checkflag = "true";
            return true;
        }
        else {
            for (i = 0; i < field.length; i++) {
                field[i].checked = false;
            }
            checkflag = "false";
            return true;
        }
}
</script>

<table width="770" cellpadding="0" cellspacing="0">
	<tr>
		<td id="cima" colspan="2"><?php include("cima.php") ?></td>
	</tr>
	<tr>
		<td id="menu" align="right"><?php include("menu.php") ?></td>
		<td id="principal" align="center">

(as denúncias serão respondidas como Sistema Automático)<br><br>


<table id="tabela" width="426" cellpadding="0" cellspacing="0">
	<tr>
		<td class="fonte_titulo1">Superior Tribunal FutClube (<?=number_format($stfc_quantidade,0,',','.')?>)</td>
	</tr>
	<tr>
		<td class="fonte1" style="padding: 10">

<?php if ($stfc_quantidade > 0) { ?>

<div id="linha10"><?php if ($stfc_quantidade > 1) { ?><a id="cursor" onClick="javascript:check(document.stfc_selecao.todos);"><img src="../figuras/principal/botao_selecionar_todas.png" border="0"></a> <?php } ?><input type="image" src="../figuras/principal/botao_excluir.png" onClick="javascript:document.stfc_selecao.submit();"></div>

<?php } else { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="../figuras/principal/alerta_nao.png"></span> Nenhuma denúncia encontrada.</div>

<?php } ?>



<?php if ($stfc_quantidade > 0) { ?>

<form name="stfc_selecao" action="stfc_excluir.php" method="post">

<?php

$query_wl = 0;

$query = mysql_query("SELECT ID, Usuario, Assunto, Denuncia, Data FROM STFC ORDER BY ID DESC LIMIT $inicio,$limite");

?>

<?php while ($rs = mysql_fetch_array($query)) { ?>

<?php $query_wl = $query_wl + 1; ?>

<script language="javascript">
responder<?=$rs["ID"]?> = 0;

function change_responder_<?=$rs["ID"]?>() {

		if (responder<?=$rs["ID"]?> == 0) {
			document.getElementById('responder_<?=$rs["ID"]?>').style.display = "block";
			responder<?=$rs["ID"]?> = 1;
		} else {
			document.getElementById('responder_<?=$rs["ID"]?>').style.display = "none";
			responder<?=$rs["ID"]?> = 0;
		}

}
</script>

<?php

$query2 = mysql_query("SELECT Usuarios.Usuario as Usuario_Nome, Usuarios.VIP as Usuario_VIP, Usuarios.VIP_Cor as Usuario_VIP_Cor, Usuarios.Status as Usuario_Status, Times.ID as Time_ID, Times.Time as Time_Nome FROM Usuarios INNER JOIN Times ON Times.ID = Usuarios.Time WHERE Usuarios.ID = '". $rs["Usuario"] ."'");
$rs2 = mysql_fetch_array($query2);

$usuario_nome = $rs2["Usuario_Nome"];
$usuario_time = $rs2["Time_ID"];
$usuario_time_nome = $rs2["Time_Nome"];
$usuario_vip = $rs2["Usuario_VIP"];
$usuario_vip_cor = $rs2["Usuario_VIP_Cor"];
$usuario_status = $rs2["Usuario_Status"];

?>

<table width="450" cellpadding="0" cellspacing="0">
	<tr>
		<td width="170" style="padding: 17px 0 6px 0"><span class="img16"><a id="cursor" onClick="javascript:change_responder_<?=$rs["ID"]?>();"><img width="16" height="16" src="../figuras/principal/responder.png" title="Responder" alt="Responder" border="0"></a></span> <span class="align_radio"><input name="stfc_selecao[]" type="checkbox" value="<?=$rs["ID"]?>" id="todos"></span> <span class="img16"><?php if ($usuario_status == 1) { ?><img width="16" width="16" src="../figuras/principal/online.png" title="Online" alt="Online"><?php } else { ?><img width="16" height="16" src="../figuras/principal/offline.png" title="Offline" alt="Offline"><?php } ?></span> <a href="usuario.php?id=<?=$rs["Usuario"]?>"><?php if ($usuario_vip > 0) { ?><span id="usuario_vip<?=$usuario_vip_cor?>"><?=$usuario_nome?></span><?php } else { ?><span id="usuario_normal"><?=$usuario_nome?></span><?php } ?></a></td>
		<td width="155" style="padding: 17px 0 6px 0"><span class="img20"><a href="time.php?id=<?=$usuario_time?>"><img width="20" height="20" src="../figuras/times_pequenos/<?=$usuario_time?>.png" title="<?=$usuario_time_nome?>" alt="<?=$usuario_time_nome?>" border="0"></a></span> <a href="time.php?id=<?=$usuario_time?>"><span style="font-weight: normal"><?=$usuario_time_nome?></span></a></td>
        <td width="125" style="padding: 17px 0 6px 0"><span class="img16"><img width="16" height="16" src="../figuras/principal/data.png" title="Data" alt="Data"></span> <?=$rs["Data"]?></td>
	</tr>
 	<tr>
		<td colspan="3" style="padding: 10px 0 10px 0; border-top: 1px solid #CCCCCC"><?=$rs["Assunto"]?></td>
	</tr>
  
 	<tr>
		<td colspan="3"><div id="responder_<?=$rs["ID"]?>" style="display: none; padding-top: 10px; border-top: 1px solid #CCCCCC"><div id="linha10"><iframe name="responder" width="100%" height="35" src="stfc_responder.php?id=<?=$rs["Usuario"]?>" scrolling="0" frameborder="0" marginwidth="0" marginheight="0"></iframe></div></div></td>
	</tr>

 	<tr>
		<td colspan="3" style="padding: 10px 0 10px 0; border-top: 1px solid #CCCCCC; border-bottom: 2px solid #000"><?=$rs["Denuncia"]?></td>
	</tr>
</table>





<?php } ?>

</form>

<?php
if ($stfc_quantidade > $limite) {
	$p_nome = "stfc";
	include("paginacao1.php");
}
?>

<?php } ?>
















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