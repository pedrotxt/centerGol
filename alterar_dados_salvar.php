<?php include_once("fun_anti_inj.php") ?>
<?php include("verificar_cookie.php") ?>
<?php include("conexao.php") ?>
<?php include("verificar_conexao.php") ?>
<?php
$sexo = anti_inj($_POST['sexo']);
$camisa = anti_inj($_POST['camisa']);
$propostas = anti_inj($_POST['propostas']);
$desafios = anti_inj($_POST['desafios']);
$comemoracao = anti_inj($_POST['comemoracao']);
$som = anti_inj($_POST['som']);
$valor = anti_inj($_POST['valor']);
$texto = anti_inj($_POST['texto']);
$comemoracao_frase = anti_inj($_POST['comemoracao_frase']);

if ($sexo == "" or $camisa == "" or $propostas == "" or $desafios == "" or $comemoracao == "" or $som == "" or $valor == "") {
	header("Location: index.php"); break;
}

if ($sexo != 1 and $sexo != 2) {
	header("Location: index.php"); break;
}

if ($camisa != 1 and $camisa != 2 and $camisa != 3 and $camisa != 4 and $camisa != 5 and $camisa != 6 and $camisa != 7 and $camisa != 8 and $camisa != 9 and $camisa != 10 and $camisa != 11) {
	header("Location: index.php"); break;
}

if ($propostas != 0 and $propostas != 1) {
	header("Location: index.php"); break;
}

if ($desafios != 0 and $desafios != 1) {
	header("Location: index.php"); break;
}

if ($comemoracao != 0 and $comemoracao != 1) {
	header("Location: index.php"); break;
}

if ($som != 0 and $som != 1) {
	header("Location: index.php"); break;
}

if (strlen($valor) > 6) {
	header("Location: index.php"); break;
}

if (ereg('[^0-9]',$valor)) {
	header("Location: alterar_dados.php?msg_alterar=2"); break;
}

if (strlen($texto) > 200) {
	header("Location: index.php"); break;
}

if (strlen($comemoracao_frase) > 200) {
	header("Location: index.php"); break;
}

$query = mysql_query("SELECT ID FROM Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$rs = mysql_fetch_array($query);

$mc_id = $rs["ID"];

mysql_query("UPDATE Usuarios SET Sexo = '". $sexo ."', Camisa = '". $camisa ."', Propostas = '". $propostas ."', Desafios = '". $desafios ."', Comemoracao = '". $comemoracao ."', Som = '". $som ."', Valor = '". $valor ."', Texto = '". $texto ."', Comemoracao_Frase = '". $comemoracao_frase ."' WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");

mysql_query("DELETE FROM Historico WHERE Usuario = '". $mc_id ."' AND Tipo = 2");

$acao = "alterou os dados cadastrais.";

mysql_query("INSERT INTO Historico (Usuario,Tipo,Acao) VALUES ('". $mc_id ."',2,'". $acao ."')");

header("Location: alterar_dados.php?msg_alterar=1"); break;
?>