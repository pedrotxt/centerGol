<?php include("fun_anti_inj.php") ?>
<?php include("conexao.php") ?>
<?php include("verificar_conexao.php") ?>
<?php
$rodada = anti_inj($_POST['rodada']);
$temporada = anti_inj($_POST['temporada']);
$dinheiro_chutar = anti_inj($_POST['dinheiro_chutar']);
$dinheiro_passe_certo = anti_inj($_POST['dinheiro_passe_certo']);
$dinheiro_penalti = anti_inj($_POST['dinheiro_penalti']);
$sorteio = anti_inj($_POST['sorteio']);
$convite = anti_inj($_POST['convite']);

if ($rodada == "" or $temporada == "" or $dinheiro_chutar == "" or $dinheiro_passe_certo == "" or $dinheiro_penalti == "" or $sorteio == "" or $convite == "") {
	header("Location: configuracoes.php"); break;
}

mysql_query("UPDATE Configuracoes SET Rodada = '". $rodada ."', Temporada = '". $temporada ."', Dinheiro_Chutar = '". $dinheiro_chutar ."', Dinheiro_Passe_Certo = '". $dinheiro_passe_certo ."', Dinheiro_Penalti = '". $dinheiro_penalti ."', Sorteio_Acumulado = '". $sorteio ."', Convite = '". $convite ."'");

header("Location: configuracoes.php?msg=1"); break;
?>