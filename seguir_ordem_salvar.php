<?php include_once("fun_anti_inj.php") ?>
<?php include("verificar_cookie.php") ?>
<?php include("conexao.php") ?>
<?php include("verificar_conexao.php") ?>
<?php include("head.php") ?>

<?php
$time_secar = anti_inj($_POST['time_secar']);

if (!$time_secar) {
	header("Location: index.php"); break;
}

if (ereg('[^0-9]',$time_secar)) {
	header("Location: index.php"); break;
}

if ($time_secar < 1 and $time_secar > 40) {
	header("Location: index.php"); break;
}

$query = mysql_query("SELECT ID, Dinheiro, Ordem FROM Times WHERE ID = {$mc_time}");
$rs = mysql_fetch_array($query);

$custo=25000;
$mc_time = $rs["ID"];
$mc_dinheiro = $rs["Dinheiro"];
$mc_ordem = $rs["Ordem"];



if($mc_dinheiro < $custo){
$msg = '<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Time não tem dinheiro suficiente!</div>';
}elseif($mc_ordem != 1){
$msg = '<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Você já deu uma ordem nessa Rodada!</div>';
}elseif($mc_time == $_POST['time_secar']){
$msg = '<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Você não pode secar o seu time!</div>';
}

?>