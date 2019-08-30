<?php ob_start(); ?>
<?php include_once("fun_anti_inj.php") ?>
<?php include("verificar_cookie.php") ?>
<?php include("conexao.php") ?>
<?php include("verificar_conexao.php") ?>
<?php include("verificar_cargo.php") ?>
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
if ($eu_presidente == 0) {
	header("Location: index.php"); break;
}

$query = mysql_query("SELECT Time, Presidente, Diretor, Olheiro_1, Olheiro_2, Olheiro_3 FROM Times WHERE ID = '". $mc_time ."'");
$rs = mysql_fetch_array($query);

$time_nome = $rs["Time"];
$presidente = $rs["Presidente"];
$diretor = $rs["Diretor"];
$olheiro_1 = $rs["Olheiro_1"];
$olheiro_2 = $rs["Olheiro_2"];
$olheiro_3 = $rs["Olheiro_3"];

if ($diretor != 0) {

$query = mysql_query("SELECT Usuario, Nivel, Gols_Total, VIP, VIP_Cor, Status FROM Usuarios WHERE ID = '". $diretor ."'");
$rs = mysql_fetch_array($query);

$diretor_nome = $rs["Usuario"];
$diretor_nivel = $rs["Nivel"];
$diretor_gols_total = $rs["Gols_Total"];
$diretor_vip = $rs["VIP"];
$diretor_vip_cor = $rs["VIP_Cor"];
$diretor_status = $rs["Status"];

} else {

$query = mysql_query("SELECT Usuario FROM Cargos WHERE Time = '". $mc_time ."' AND Cargo = 1");
$rs = mysql_fetch_array($query);

if ($rs) {

$query = mysql_query("SELECT ID, Usuario, Nivel, Gols_Total, VIP, VIP_Cor, Status FROM Usuarios WHERE ID = '". $rs["Usuario"] ."'");
$rs = mysql_fetch_array($query);

$diretor_pendente = 1;
$diretor_pendente_id = $rs["ID"];
$diretor_pendente_nome = $rs["Usuario"];
$diretor_pendente_nivel = $rs["Nivel"];
$diretor_pendente_gols_total = $rs["Gols_Total"];
$diretor_pendente_vip = $rs["VIP"];
$diretor_pendente_vip_cor = $rs["VIP_Cor"];
$diretor_pendente_status = $rs["Status"];

}

}

if ($olheiro_1 != 0) {

$query = mysql_query("SELECT Usuario, Nivel, Gols_Total, VIP, VIP_Cor, Status FROM Usuarios WHERE ID = '". $olheiro_1 ."'");
$rs = mysql_fetch_array($query);

$olheiro_1_nome = $rs["Usuario"];
$olheiro_1_nivel = $rs["Nivel"];
$olheiro_1_gols_total = $rs["Gols_Total"];
$olheiro_1_vip = $rs["VIP"];
$olheiro_1_vip_cor = $rs["VIP_Cor"];
$olheiro_1_status = $rs["Status"];

} else {

$query = mysql_query("SELECT Usuario FROM Cargos WHERE Time = '". $mc_time ."' AND Cargo = 2");
$rs = mysql_fetch_array($query);

if ($rs) {

$query = mysql_query("SELECT ID, Usuario, Nivel, Gols_Total, VIP, VIP_Cor, Status FROM Usuarios WHERE ID = '". $rs["Usuario"] ."'");
$rs = mysql_fetch_array($query);

$olheiro_1_pendente = 1;
$olheiro_1_pendente_id = $rs["ID"];
$olheiro_1_pendente_nome = $rs["Usuario"];
$olheiro_1_pendente_nivel = $rs["Nivel"];
$olheiro_1_pendente_gols_total = $rs["Gols_Total"];
$olheiro_1_pendente_vip = $rs["VIP"];
$olheiro_1_pendente_vip_cor = $rs["VIP_Cor"];
$olheiro_1_pendente_status = $rs["Status"];

}

}

if ($olheiro_2 != 0) {

$query = mysql_query("SELECT Usuario, Nivel, Gols_Total, VIP, VIP_Cor, Status FROM Usuarios WHERE ID = '". $olheiro_2 ."'");
$rs = mysql_fetch_array($query);

$olheiro_2_nome = $rs["Usuario"];
$olheiro_2_nivel = $rs["Nivel"];
$olheiro_2_gols_total = $rs["Gols_Total"];
$olheiro_2_vip = $rs["VIP"];
$olheiro_2_vip_cor = $rs["VIP_Cor"];
$olheiro_2_status = $rs["Status"];

} else {

$query = mysql_query("SELECT Usuario FROM Cargos WHERE Time = '". $mc_time ."' AND Cargo = 3");
$rs = mysql_fetch_array($query);

if ($rs) {

$query = mysql_query("SELECT ID, Usuario, Nivel, Gols_Total, VIP, VIP_Cor, Status FROM Usuarios WHERE ID = '". $rs["Usuario"] ."'");
$rs = mysql_fetch_array($query);

$olheiro_2_pendente = 1;
$olheiro_2_pendente_id = $rs["ID"];
$olheiro_2_pendente_nome = $rs["Usuario"];
$olheiro_2_pendente_nivel = $rs["Nivel"];
$olheiro_2_pendente_gols_total = $rs["Gols_Total"];
$olheiro_2_pendente_vip = $rs["VIP"];
$olheiro_2_pendente_vip_cor = $rs["VIP_Cor"];
$olheiro_2_pendente_status = $rs["Status"];

}

}

if ($olheiro_3 != 0) {

$query = mysql_query("SELECT Usuario, Nivel, Gols_Total, VIP, VIP_Cor, Status FROM Usuarios WHERE ID = '". $olheiro_3 ."'");
$rs = mysql_fetch_array($query);

$olheiro_3_nome = $rs["Usuario"];
$olheiro_3_nivel = $rs["Nivel"];
$olheiro_3_gols_total = $rs["Gols_Total"];
$olheiro_3_vip = $rs["VIP"];
$olheiro_3_vip_cor = $rs["VIP_Cor"];
$olheiro_3_status = $rs["Status"];

} else {

$query = mysql_query("SELECT Usuario FROM Cargos WHERE Time = '". $mc_time ."' AND Cargo = 4");
$rs = mysql_fetch_array($query);

if ($rs) {

$query = mysql_query("SELECT ID, Usuario, Nivel, Gols_Total, VIP, VIP_Cor, Status FROM Usuarios WHERE ID = '". $rs["Usuario"] ."'");
$rs = mysql_fetch_array($query);

$olheiro_3_pendente = 1;
$olheiro_3_pendente_id = $rs["ID"];
$olheiro_3_pendente_nome = $rs["Usuario"];
$olheiro_3_pendente_nivel = $rs["Nivel"];
$olheiro_3_pendente_gols_total = $rs["Gols_Total"];
$olheiro_3_pendente_vip = $rs["VIP"];
$olheiro_3_pendente_vip_cor = $rs["VIP_Cor"];
$olheiro_3_pendente_status = $rs["Status"];

}

}

ob_end_flush();
?>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Cúpula do <?=$time_nome?></h1></div></div></div>
	<div class="conteudo">

<div id="linha10">Defina uma equipe boa e dedicada para o sucesso do seu clube, antes de convidar alguém para o cargo, verifique se o usuário entra com frequência e tenha total confiança no mesmo. Diretor pode contratar e tem acesso ao dinheiro do clube e os Olheiros apenas indicam.</div>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<div id="divide"></div>
<?php
$query = mysql_query("SELECT ID, VIP_Tempo FROM Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$rs = mysql_fetch_array($query);
$mc_vip_tempo = $rs["VIP_Tempo"];
?>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Presidente</h1></div></div></div>
	<div class="conteudo">

<div id="linha10"><span class="img25"><img width="25" height="25" src="figuras/niveis/<?=$mc_nivel?>.png" title="<?=$mc_nivel?>" alt="<?=$mc_nivel?>"></span> <span class="img16"><img width="16" width="16" src="figuras/principal/online.png" title="Online" alt="Online"></span> <a href="usuario.php?id=<?=$mc_id?>"><?php if ($mc_vip_tempo < time()) { ?><span id="usuario_vip<?=$mc_vip_cor?>"><?=$mc_usuario?></span><?php } else { ?><span id="usuario_normal"><?=$mc_usuario?></span><?php } ?></a></div>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<div id="divide"></div>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Diretor</h1></div></div></div>
	<div class="conteudo">

<?php if ($diretor != 0) { ?>

<div id="linha10"><span class="img25"><img width="25" height="25" src="figuras/niveis/<?=$diretor_nivel?>.png" title="<?=$diretor_nivel?>" alt="<?=$diretor_nivel?>"></span> <span class="img16"><?php if ($diretor_status == 1) { ?><img width="16" width="16" src="figuras/principal/online.png" title="Online" alt="Online"><?php } else { ?><img width="16" height="16" src="figuras/principal/offline.png" title="Offline" alt="Offline"><?php } ?></span> <a href="usuario.php?id=<?=$diretor?>"><?php if ($diretor_vip > 0) { ?><span id="usuario_vip<?=$diretor_vip_cor?>"><?=$diretor_nome?></span><?php } else { ?><span id="usuario_normal"><?=$diretor_nome?></span><?php } ?></a></div>
<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/seta1.png"></span> <a href="painel_diretor_excluir.php"><b>Tirar do Cargo</b></a></div>

<?php } else { ?>

<?php if ($diretor_pendente == 1) { ?>

<div id="linha10"><span class="img25"><img width="25" height="25" src="figuras/niveis/<?=$diretor_pendente_nivel?>.png" title="<?=$diretor_pendente_nivel?>" alt="<?=$diretor_pendente_nivel?>"></span> <span class="img16"><?php if ($diretor_pendente_status == 1) { ?><img width="16" width="16" src="figuras/principal/online.png" title="Online" alt="Online"><?php } else { ?><img width="16" height="16" src="figuras/principal/offline.png" title="Offline" alt="Offline"><?php } ?></span> <a href="usuario.php?id=<?=$diretor_pendente_id?>"><?php if ($diretor_pendente_vip > 0) { ?><span id="usuario_vip<?=$diretor_pendente_vip_cor?>"><?=$diretor_pendente_nome?></span><?php } else { ?><span id="usuario_normal"><?=$diretor_pendente_nome?></span><?php } ?></a> (Aguardando Resposta)</div>
<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/seta1.png"></span> <a href="painel_diretor_pendente_excluir.php"><b>Cancelar Convite</b></a></div>

<?php } else { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Nenhum usuário com essa função.</div>
<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/seta1.png"></span> <a href="painel_diretor.php"><b>Convidar</b></a></div>

<?php } ?>

<?php } ?>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<div id="divide"></div>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Olheiro 1</h1></div></div></div>
	<div class="conteudo">

<?php if ($olheiro_1 != 0) { ?>

<div id="linha10"><span class="img25"><img width="25" height="25" src="figuras/niveis/<?=$olheiro_1_nivel?>.png" title="<?=$olheiro_1_nivel?>" alt="<?=$olheiro_1_nivel?>"></span> <span class="img16"><?php if ($olheiro_1_status == 1) { ?><img width="16" width="16" src="figuras/principal/online.png" title="Online" alt="Online"><?php } else { ?><img width="16" height="16" src="figuras/principal/offline.png" title="Offline" alt="Offline"><?php } ?></span> <a href="usuario.php?id=<?=$olheiro_1?>"><?php if ($olheiro_1_vip > 0) { ?><span id="usuario_vip<?=$olheiro_1_vip_cor?>"><?=$olheiro_1_nome?></span><?php } else { ?><span id="usuario_normal"><?=$olheiro_1_nome?></span><?php } ?></a></div>
<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/seta1.png"></span> <a href="painel_olheiro_excluir.php?id=1"><b>Tirar do Cargo</b></a></div>

<?php } else { ?>

<?php if ($olheiro_1_pendente == 1) { ?>

<div id="linha10"><span class="img25"><img width="25" height="25" src="figuras/niveis/<?=$olheiro_1_pendente_nivel?>.png" title="<?=$olheiro_1_pendente_nivel?>" alt="<?=$olheiro_1_pendente_nivel?>"></span> <span class="img16"><?php if ($olheiro_1_pendente_status == 1) { ?><img width="16" width="16" src="figuras/principal/online.png" title="Online" alt="Online"><?php } else { ?><img width="16" height="16" src="figuras/principal/offline.png" title="Offline" alt="Offline"><?php } ?></span> <a href="usuario.php?id=<?=$olheiro_1_pendente_id?>"><?php if ($olheiro_1_pendente_vip > 0) { ?><span id="usuario_vip<?=$olheiro_1_pendente_vip_cor?>"><?=$olheiro_1_pendente_nome?></span><?php } else { ?><span id="usuario_normal"><?=$olheiro_1_pendente_nome?></span><?php } ?></a> (Aguardando Resposta)</div>
<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/seta1.png"></span> <a href="painel_olheiro_pendente_excluir.php?id=1"><b>Cancelar Convite</b></a></div>

<?php } else { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Nenhum usuário com essa função.</div>
<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/seta1.png"></span> <a href="painel_olheiro1.php"><b>Convidar</b></a></div>

<?php } ?>

<?php } ?>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<div id="divide"></div>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Olheiro 2</h1></div></div></div>
	<div class="conteudo">

<?php if ($olheiro_2 != 0) { ?>

<div id="linha10"><span class="img25"><img width="25" height="25" src="figuras/niveis/<?=$olheiro_2_nivel?>.png" title="<?=$olheiro_2_nivel?>" alt="<?=$olheiro_2_nivel?>"></span> <span class="img16"><?php if ($olheiro_2_status == 1) { ?><img width="16" width="16" src="figuras/principal/online.png" title="Online" alt="Online"><?php } else { ?><img width="16" height="16" src="figuras/principal/offline.png" title="Offline" alt="Offline"><?php } ?></span> <a href="usuario.php?id=<?=$olheiro_2?>"><?php if ($olheiro_2_vip > 0) { ?><span id="usuario_vip<?=$olheiro_2_vip_cor?>"><?=$olheiro_2_nome?></span><?php } else { ?><span id="usuario_normal"><?=$olheiro_2_nome?></span><?php } ?></a></div>
<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/seta1.png"></span> <a href="painel_olheiro_excluir.php?id=2"><b>Tirar do Cargo</b></a></div>

<?php } else { ?>

<?php if ($olheiro_2_pendente == 1) { ?>

<div id="linha10"><span class="img25"><img width="25" height="25" src="figuras/niveis/<?=$olheiro_2_pendente_nivel?>.png" title="<?=$olheiro_2_pendente_nivel?>" alt="<?=$olheiro_2_pendente_nivel?>"></span> <span class="img16"><?php if ($olheiro_2_pendente_status == 1) { ?><img width="16" width="16" src="figuras/principal/online.png" title="Online" alt="Online"><?php } else { ?><img width="16" height="16" src="figuras/principal/offline.png" title="Offline" alt="Offline"><?php } ?></span> <a href="usuario.php?id=<?=$olheiro_2_pendente_id?>"><?php if ($olheiro_2_pendente_vip > 0) { ?><span id="usuario_vip<?=$olheiro_2_pendente_vip_cor?>"><?=$olheiro_2_pendente_nome?></span><?php } else { ?><span id="usuario_normal"><?=$olheiro_2_pendente_nome?></span><?php } ?></a> (Aguardando Resposta)</div>
<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/seta1.png"></span> <a href="painel_olheiro_pendente_excluir.php?id=2"><b>Cancelar Convite</b></a></div>

<?php } else { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Nenhum usuário com essa função.</div>
<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/seta1.png"></span> <a href="painel_olheiro2.php"><b>Convidar</b></a></div>

<?php } ?>

<?php } ?>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<div id="divide"></div>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Olheiro 3</h1></div></div></div>
	<div class="conteudo">

<?php if ($olheiro_3 != 0) { ?>

<div id="linha10"><span class="img25"><img width="25" height="25" src="figuras/niveis/<?=$olheiro_3_nivel?>.png" title="<?=$olheiro_3_nivel?>" alt="<?=$olheiro_3_nivel?>"></span> <span class="img16"><?php if ($olheiro_3_status == 1) { ?><img width="16" width="16" src="figuras/principal/online.png" title="Online" alt="Online"><?php } else { ?><img width="16" height="16" src="figuras/principal/offline.png" title="Offline" alt="Offline"><?php } ?></span> <a href="usuario.php?id=<?=$olheiro_3?>"><?php if ($olheiro_3_vip > 0) { ?><span id="usuario_vip<?=$olheiro_3_vip_cor?>"><?=$olheiro_3_nome?></span><?php } else { ?><span id="usuario_normal"><?=$olheiro_3_nome?></span><?php } ?></a></div>
<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/seta1.png"></span> <a href="painel_olheiro_excluir.php?id=3"><b>Tirar do Cargo</b></a></div>

<?php } else { ?>

<?php if ($olheiro_3_pendente == 1) { ?>

<div id="linha10"><span class="img25"><img width="25" height="25" src="figuras/niveis/<?=$olheiro_3_pendente_nivel?>.png" title="<?=$olheiro_3_pendente_nivel?>" alt="<?=$olheiro_3_pendente_nivel?>"></span> <span class="img16"><?php if ($olheiro_3_pendente_status == 1) { ?><img width="16" width="16" src="figuras/principal/online.png" title="Online" alt="Online"><?php } else { ?><img width="16" height="16" src="figuras/principal/offline.png" title="Offline" alt="Offline"><?php } ?></span> <a href="usuario.php?id=<?=$olheiro_3_pendente_id?>"><?php if ($olheiro_3_pendente_vip > 0) { ?><span id="usuario_vip<?=$olheiro_3_pendente_vip_cor?>"><?=$olheiro_3_pendente_nome?></span><?php } else { ?><span id="usuario_normal"><?=$olheiro_3_pendente_nome?></span><?php } ?></a> (Aguardando Resposta)</div>
<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/seta1.png"></span> <a href="painel_olheiro_pendente_excluir.php?id=3"><b>Cancelar Convite</b></a></div>

<?php } else { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Nenhum usuário com essa função.</div>
<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/seta1.png"></span> <a href="painel_olheiro3.php"><b>Convidar</b></a></div>

<?php } ?>

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