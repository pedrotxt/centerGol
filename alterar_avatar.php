<?php include_once("fun_anti_inj.php") ?>
<?php include("verificar_cookie.php") ?>
<?php include("conexao.php") ?>
<?php include("verificar_conexao.php") ?>
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


<?php
$query = mysql_query("SELECT Time, Sexo, Avatar_Cor, Avatar_Cabelo, Avatar_Cabelo_Cor, Avatar_Olho, Avatar_Olho_Cor FROM Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$rs = mysql_fetch_array($query);

$avatar_time = $rs["Time"];
$avatar_sexo = $rs["Sexo"];
$avatar_cor = $rs["Avatar_Cor"];
$avatar_cabelo = $rs["Avatar_Cabelo"];
$avatar_cabelo_cor = $rs["Avatar_Cabelo_Cor"];
$avatar_olho = $rs["Avatar_Olho"];
$avatar_olho_cor = $rs["Avatar_Olho_Cor"];
?>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Alterar Avatar</h1></div></div></div>
	<div class="conteudo">

<div id="linha10">

<div id="avatar_swf" style="text-align: center">
<a href="http://www.adobe.com/go/EN_US-H-GET-FLASH" target="_blank"><img src="http://www.adobe.com/images/shared/download_buttons/get_adobe_flash_player.png" border="0"></a>

<script type="text/javascript">
	var fo = new FlashObject("swf/alterar_avatar.swf?avatar_adm=0&avatar_time=<?=$avatar_time?>&avatar_sexo=<?=$avatar_sexo?>&avatar_cor=<?=$avatar_cor?>&avatar_cabelo=<?=$avatar_cabelo?>&avatar_cabelo_cor=<?=$avatar_cabelo_cor?>&avatar_olho=<?=$avatar_olho?>&avatar_olho_cor=<?=$avatar_olho_cor?>", "aavatar", "350", "320", "7", "#fff");
	fo.addParam("quality", "high");
	fo.addParam("menu", "false");
	fo.addParam("wmode", "transparent");
	fo.addParam("scale", "noscale");
	fo.write("avatar_swf");
</script>
</div>

</div>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>


<!-- FIM DA PÁGINA -->
</div>
<div class="clear"></div>

</div>
<div id="baixo"><?php include("baixo.php") ?></div>
</div>
</body>
</html>