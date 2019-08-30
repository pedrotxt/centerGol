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

<div id="esquerda"><?php include("esquerda.php") ?>></div>
<div id="direita"><?php include("direita.php") ?></div>
<div id="principal">
<!-- INÍCIO DA PÁGINA -->


<?php
$id = anti_inj($_GET['id']);
$cod = anti_inj($_GET['cod']);

if (!$id or !$cod) {
	header("Location: index.php"); break;
}

if (ereg('[^0-9]',$id)) {
	header("Location: index.php"); break;
}

if (!ctype_alnum($cod)) {
	header("Location: index.php"); break;
}

$query = mysql_query("SELECT ID FROM Usuarios WHERE ID = '". $id ."' AND Confirmar = '0'");
$rs = mysql_fetch_array($query);

if ($rs) {
	$confirmado = 1;
}

if ($confirmado != 1) {

$query = mysql_query("SELECT ID FROM Usuarios WHERE ID = '". $id ."' AND Confirmar = '". $cod ."'");
$rs = mysql_fetch_array($query);

if ($rs) {
	$confirmado = 2;
	mysql_query("UPDATE Usuarios SET Confirmar = 0 WHERE ID = '". $id ."'");
	$acao = "se cadastrou com sucesso.";
	mysql_query("INSERT INTO Historico (Usuario,Tipo,Acao) VALUES ('". $id ."',1,'". $acao ."')");
} else {
	$confirmado = 3;
}
}

ob_end_flush();
?>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Cadastro</h1></div></div></div>
	<div class="conteudo">

<?php if ($confirmado == 1) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Essa conta já está confirmada!</div>

<?php } else if ($confirmado == 2) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_sim.png"></span> Conta confirmada com sucesso!</div>

<?php } else if ($confirmado == 3) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Código inválido, tente reenviar para o seu email!</div>

<?php } ?>

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