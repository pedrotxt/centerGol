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
<script language="javascript">
function valida_mensagem() {

if (document.mensagem.mensagem.value=="") {
	alert("É necessário preencher a mensagem.");
	document.mensagem.mensagem.focus();
	return false;
}

}
</script>

<form name="mensagem" method="post" action="stfc_responder_salvar.php?id=<?=$id?>" onSubmit="return valida_mensagem()">

<div><input name="mensagem" type="text" maxlength="200" style="width: 250px; height: 20px"> <span class="align_botao_mensagem_pequeno"><input name="submit" type="image" src="../figuras/principal/botao_enviar_pequeno.png" onClick="return valida_mensagem()"></span></div>

</form>
</table>
</div>
</div>
</body>
</html>