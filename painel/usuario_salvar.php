<?php include("fun_anti_inj.php") ?>
<?php include("conexao.php") ?>
<?php include("verificar_conexao.php") ?>
<?php
$id = anti_inj($_GET['id']);

if (!$id) {
	header("Location: usuarios.php"); break;
}

if (ereg('[^0-9]',$id)) {
	header("Location: usuarios.php"); break;
}

if ($id < 1) {
	header("Location: usuarios.php"); break;
}

$email = anti_inj(strtolower($_POST['email']));
$senha = anti_inj($_POST['senha']);
$usuario = anti_inj($_POST['usuario']);
$nivel = anti_inj($_POST['nivel']);
$camisa = anti_inj($_POST['camisa']);
$sexo = anti_inj($_POST['sexo']);
$time = anti_inj($_POST['time']);
$time_secar = anti_inj($_POST['time_secar']);
$dinheiro = anti_inj($_POST['dinheiro']);
$moderador = anti_inj($_POST['moderador']);
$clone = anti_inj($_POST['clone']);
$banido = anti_inj($_POST['banido']);
$propostas = anti_inj($_POST['propostas']);
$som = anti_inj($_POST['som']);
$comemoracao = anti_inj($_POST['comemoracao']);
$desafios = anti_inj($_POST['desafios']);
$trocas = anti_inj($_POST['trocas']);
$valor = anti_inj($_POST['valor']);
$texto = anti_inj($_POST['texto']);
$sorte = anti_inj($_POST['sorte']);
$rescisao = anti_inj($_POST['rescisao']);
$rescisao_dias = anti_inj($_POST['rescisao_dias']);
$rescisao_dias_vip = anti_inj($_POST['rescisao_dias_vip']);
$acessos = anti_inj($_POST['acessos']);
$vip = anti_inj($_POST['vip']);
$presidente_dias = anti_inj($_POST['presidente_dias']);
$fidelidade = anti_inj($_POST['fidelidade']);
$item_sorte = anti_inj($_POST['item_sorte']);
$item_pedra = anti_inj($_POST['item_pedra']);
$item_energia = anti_inj($_POST['item_energia']);
$item_escudo = anti_inj($_POST['item_escudo']);
$item_sacola = anti_inj($_POST['item_sacola']);
$item_veneno = anti_inj($_POST['item_veneno']);
$gols_hora = anti_inj($_POST['gols_hora']);
$gols_hora_record = anti_inj($_POST['gols_hora_record']);
$gols_rodada = anti_inj($_POST['gols_rodada']);
$gols_rodada_record = anti_inj($_POST['gols_rodada_record']);
$gols_temporada = anti_inj($_POST['gols_temporada']);
$gols_temporada_record = anti_inj($_POST['gols_temporada_record']);
$gols_total = anti_inj($_POST['gols_total']);
$gols_time = anti_inj($_POST['gols_time']);
$passe_certo = anti_inj($_POST['passe_certo']);
$passe_certo_acertos = anti_inj($_POST['passe_certo_acertos']);
$penalti = anti_inj($_POST['penalti']);
$penalti_acertos = anti_inj($_POST['penalti_acertos']);
$ip = anti_inj($_POST['ip']);
$cadastro = anti_inj($_POST['cadastro']);
$ultimo_acesso = anti_inj($_POST['ultimo_acesso']);


if ($sexo == "" or $camisa == "" or $propostas == "" or $comemoracao == "" or $som == "" or $valor == "") {
	header("Location: usuarios.php"); break;
}

if ($sexo != 1 and $sexo != 2) {
	header("Location: usuarios.php"); break;
}

if ($camisa != 1 and $camisa != 2 and $camisa != 3 and $camisa != 4 and $camisa != 5 and $camisa != 6 and $camisa != 7 and $camisa != 8 and $camisa != 9 and $camisa != 10 and $camisa != 11) {
	header("Location: usuarios.php"); break;
}

if ($propostas != 0 and $propostas != 1) {
	header("Location: usuarios.php"); break;
}

if ($comemoracao != 0 and $comemoracao != 1) {
	header("Location: usuarios.php"); break;
}

if ($som != 0 and $som != 1) {
	header("Location: usuarios.php"); break;
}

if (strlen($valor) > 6) {
	header("Location: usuarios.php"); break;
}

if (ereg('[^0-9]',$valor)) {
	header("Location: usuarios.php"); break;
}

if (strlen($texto) > 200) {
	header("Location: usuarios.php"); break;
}

$query = mysql_query("SELECT ID FROM Usuarios WHERE Email = '". $email ."' AND ID <> '". $id ."'");
$rs = mysql_fetch_array($query);

if ($rs) {
	header("Location: usuario.php?id=$id&msg=3"); break;
}

$query = mysql_query("SELECT ID FROM Usuarios WHERE Usuario = '". $usuario."' AND ID <> '". $id ."'");
$rs = mysql_fetch_array($query);

if ($rs) {
	header("Location: usuario.php?id=$id&msg=4"); break;
}

if ($senha != "") {
	mysql_query("UPDATE Usuarios SET Senha = password('". $senha ."') WHERE ID = '". $id ."'");
}

mysql_query("UPDATE Usuarios SET Email = '". $email ."', Usuario = '". $usuario ."', Nivel = '". $nivel ."', Time = '". $time ."', Secar = '". $time_secar ."', Sexo = '". $sexo ."', Camisa = '". $camisa ."', Dinheiro = '". $dinheiro ."', Moderador = '". $moderador ."', Clone = '". $clone ."', Banido = '". $banido ."', Propostas = '". $propostas ."', Desafios = '". $desafios ."', Comemoracao = '". $comemoracao ."', Som = '". $som ."', Trocas = '". $trocas ."', Valor = '". $valor ."', Texto = '". $texto ."', Sorte = '". $sorte ."', Rescisao = '". $rescisao ."', Rescisao_Dias = '". $rescisao_dias ."', Rescisao_Dias_VIP = '". $rescisao_dias_vip ."', Acessos = '". $acessos ."', VIP = '". $vip ."', Presidente_Dias = '". $presidente_dias ."', Fidelidade = '". $fidelidade ."', Item_Sorte = '". $item_sorte ."', Item_Pedra = '". $item_pedra ."', Item_Energia = '". $item_energia ."', Item_Escudo = '". $item_escudo ."', Item_Sacola = '". $item_sacola ."', Item_Veneno = '". $item_veneno ."', Gols_Hora = '". $gols_hora ."', Gols_Hora_Record = '". $gols_hora_record ."', Gols_Rodada = '". $gols_rodada ."', Gols_Rodada_Record = '". $gols_rodada_record ."', Gols_Temporada = '". $gols_temporada ."', Gols_Temporada_Record = '". $gols_temporada_record ."', Gols_Total = '". $gols_total ."', Gols_Time = '". $gols_time ."', Passe_Certo = '". $passe_certo ."', Passe_Certo_Acertos = '". $passe_certo_acertos ."', Penalti = '". $penalti ."', Penalti_Acertos = '". $penalti_acertos ."', IP = '". $ip ."', Cadastro = '". $cadastro ."', Ultimo_Acesso = '". $ultimo_acesso ."' WHERE ID = '". $id ."'");

header("Location: usuario.php?id=$id&msg=1"); break;
?>