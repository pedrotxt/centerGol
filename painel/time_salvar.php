<?php include("fun_anti_inj.php") ?>
<?php include("conexao.php") ?>
<?php include("verificar_conexao.php") ?>
<?php
$id = anti_inj($_GET['id']);

if (!$id) {
	header("Location: times.php"); break;
}

if (ereg('[^0-9]',$id)) {
	header("Location: times.php"); break;
}

if ($id < 1) {
	header("Location: times.php"); break;
}

$time = anti_inj($_POST['time']);
$estado = anti_inj($_POST['estado']);
$estadio = anti_inj($_POST['estadio']);
$capacidade = anti_inj($_POST['capacidade']);
$ingresso = anti_inj($_POST['ingresso']);
$reputacao = anti_inj($_POST['reputacao']);
$dinheiro = anti_inj($_POST['dinheiro']);
$campeonato_fc_titulos = anti_inj($_POST['campeonato_fc_titulos']);
$campeonato_fc_vices = anti_inj($_POST['campeonato_fc_vices']);
$copa_brasil_titulos = anti_inj($_POST['copa_brasil_titulos']);
$copa_brasil_vices = anti_inj($_POST['copa_brasil_vices']);
$copa_fc_titulos = anti_inj($_POST['copa_fc_titulos']);
$copa_fc_vices = anti_inj($_POST['copa_fc_vices']);
$texto = anti_inj($_POST['texto']);

if ($time == "" or $estado == "" or $estadio == "" or $capacidade == "" or $ingresso == "" or $reputacao == "" or $dinheiro == "" or $campeonato_fc_titulos == "" or $campeonato_fc_vices == "" or $copa_brasil_titulos == "" or $copa_brasil_vices == "" or $copa_fc_titulos == "" or $copa_fc_vices == "") {
	header("Location: times.php"); break;
}

if ($ingresso != 5 and $ingresso != 10) {
	header("Location: times.php"); break;
}

if (strlen($texto) > 200) {
	header("Location: times.php"); break;
}

mysql_query("UPDATE Times SET Time = '". $time ."', Estado = '". $estado ."', Estadio = '". $estadio ."', Capacidade = '". $capacidade ."', Ingresso = '". $ingresso ."', Reputacao = '". $reputacao ."', Dinheiro = '". $dinheiro ."', Campeonato_FC_Titulos = '". $campeonato_fc_titulos ."', Campeonato_FC_Vices = '". $campeonato_fc_vices ."', Copa_Brasil_Titulos = '". $copa_brasil_titulos ."', Copa_Brasil_Vices = '". $copa_brasil_vices ."', Copa_FC_Titulos = '". $copa_fc_titulos ."', Copa_FC_Vices = '". $copa_fc_vices ."', Texto = '". $texto ."' WHERE ID = '". $id ."'");

header("Location: time.php?id=$id&msg=1"); break;
?>