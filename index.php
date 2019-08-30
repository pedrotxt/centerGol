<?php 
ob_start();
include_once("fun_anti_inj.php") ?>
<?php include("verificar_cookie.php") ?>
<?php include("conexao.php") ?>
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
$query = mysql_query("SELECT Rodada, Temporada, Amistosos FROM Configuracoes");
$rs = mysql_fetch_array($query);

$rodada = $rs["Rodada"];
$amistoso = $rs["Amistosos"];
$temporada = $rs["Temporada"];

$query = mysql_query("SELECT Count(ID) AS historico_quantidade FROM Historico");
$rs = mysql_fetch_array($query);

$historico_quantidade = $rs["historico_quantidade"];

$query = mysql_query("SELECT Count(ID) AS marcadores_rodada FROM Usuarios WHERE Gols_Rodada > 0");
$rs = mysql_fetch_array($query);

$marcadores_rodada = $rs["marcadores_rodada"];

$query = mysql_query("SELECT Count(ID) AS marcadores_temporada FROM Usuarios WHERE Gols_Temporada > 0");
$rs = mysql_fetch_array($query);

$marcadores_temporada = $rs["marcadores_temporada"];

$medalha = 0;
$query = mysql_query("SELECT ID FROM Usuarios WHERE Gols_Hora > 0 ORDER BY Gols_Hora DESC LIMIT 3");

while ($rs = mysql_fetch_array($query)) {

$medalha = $medalha + 1;

if ($medalha == 1) {
	$medalha_1 = $rs["ID"];
} else if ($medalha == 2) {
	$medalha_2 = $rs["ID"];
} else if ($medalha == 3) {
	$medalha_3 = $rs["ID"];
}

}

$recordrodada = 0;
$query = mysql_query("SELECT ID FROM Usuarios WHERE Gols_Rodada_Record > 0 ORDER BY Gols_Rodada_Record DESC LIMIT 1");

while ($rs = mysql_fetch_array($query)) {

$recordrodada = $recordrodada + 1;

if ($recordrodada == 1) {
	$recordrodada_1 = $rs["ID"];
}
}

$recordtemporada = 0;
$query = mysql_query("SELECT ID FROM Usuarios WHERE Gols_Temporada_Record > 0 ORDER BY Gols_Temporada_Record DESC LIMIT 1");

while ($rs = mysql_fetch_array($query)) {

$recordtemporada = $recordtemporada + 1;

if ($recordtemporada == 1) {
	$recordtemporada_1 = $rs["ID"];
}
}
?>

seja bem vindo ao centergol 2.0! </br> qualquer bug, favor falar com algum administrador! abraço!
<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Histórico Geral</h1></div></div></div>
	<div class="conteudo" style="padding-top: 4px">

<?php if ($historico_quantidade > 0) { ?>

<?php

$query = mysql_query("SELECT Times.Time, Usuarios.Time as Time_ID, Usuarios.ID as Usuario_ID, Usuarios.Usuario, Usuarios.Nivel, Historico.Acao, Usuarios.VIP_Tempo, Usuarios.Gols_Total, Usuarios.VIP_Cor FROM Historico INNER JOIN Usuarios ON Usuarios.ID = Historico.Usuario INNER JOIN Times ON Usuarios.Time = Times.ID ORDER BY Historico.ID DESC LIMIT 5");

?>

<?php while ($rs = mysql_fetch_array($query)) { ?>

<div id="linha6"><span class="img25"><img width="25" height="25" src="figuras/niveis/<?=$rs["Nivel"]?>.png" title="<?=$rs["Nivel"]?>" alt="<?=$rs["Nivel"]?>"></span> <span class="img20"><a href="time.php?id=<?=$rs["Time_ID"]?>"><img width="20" height="20" src="figuras/times_pequenos/<?=$rs["Time_ID"]?>.png" title="<?=$rs["Time"]?>" alt="<?=$rs["Time"]?>" border="0"></a></span> <a href="usuario.php?id=<?=$rs["Usuario_ID"]?>"><?php if ($rs["VIP_Tempo"] > time()) { ?><span id="usuario_vip<?=$rs["VIP_Cor"]?>"><?=$rs["Usuario"]?></span><?php } else { ?><span id="usuario_normal"><?=$rs["Usuario"]?></span><?php } ?></a><?php if ($rs["Usuario_ID"] == $recordtemporada_1) { ?> <span class="medalha"><img width="14" height="14" src="figuras/principal/trofeu1.png" title="Top 1 da Temporada" alt="Top 1 da Temporada"></span> <? } ?><?php if ($rs["Usuario_ID"] == $recordrodada_1) { ?> <span class="medalha"><img width="14" height="14" src="figuras/principal/bola1.png" title="Top 1 da Rodada" alt="Top 1 da Rodada"></span> <? } ?> <?php if ($rs["Usuario_ID"] == $medalha_1) { ?><span class="medalha"><img width="14" height="14" src="figuras/principal/medalha1.png" title="Top 1 da Hora" alt="Top 1 da Hora"></span><?php } else if ($rs["Usuario_ID"] == $medalha_2) { ?><span class="medalha"><img width="14" height="14" src="figuras/principal/medalha2.png" title="Top 2 da Hora" alt="Top 2 da Hora"></span><?php } else if ($rs["Usuario_ID"] == $medalha_3) { ?><span class="medalha"><img width="14" height="14" src="figuras/principal/medalha3.png" title="Top 3 da Hora" alt="Top 3 da Hora"></span><?php } ?> <?=$rs["Acao"]?></div>

<?php } ?>

<div id="linha6"><span class="img16"><img width="14" height="14" src="figuras/principal/seta1.png"></span> <a href="historico.php"><b>Ver Completo</b></a></div>

<?php } else { ?>

<div id="linha6"><span class="img16"><img width="14" height="14" src="figuras/principal/alerta_nao.png"></span> Nenhum histórico encontrado.</div>

<?php } ?>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<div id="divide"></div>

<?php

$query = mysql_query("SELECT Usuarios.ID, Usuario, Nivel, Gols_Rodada_Record, VIP_Tempo, VIP_Cor, Usuarios.Time, Times.Time as Time_Nome FROM Usuarios INNER JOIN Times ON Times.ID = Usuarios.Time ORDER BY Gols_Rodada_Record DESC LIMIT 1");
$rs = mysql_fetch_array($query);

$rodada_record_id = $rs["ID"];
$rodada_record_usuario = $rs["Usuario"];
$rodada_record_nivel = $rs["Nivel"];
$rodada_record_gols_rodada = $rs["Gols_Rodada_Record"];
$rodada_record_vip = $rs["VIP_Tempo"];
$rodada_record_vip_cor = $rs["VIP_Cor"];
$rodada_record_time = $rs["Time"];
$rodada_record_time_nome = $rs["Time_Nome"];

$query = mysql_query("SELECT Usuarios.ID, Usuario, Nivel, Gols_Temporada_Record, VIP_Tempo, VIP_Cor, Usuarios.Time, Times.Time as Time_Nome FROM Usuarios INNER JOIN Times ON Times.ID = Usuarios.Time ORDER BY Gols_Temporada_Record DESC LIMIT 1");
$rs = mysql_fetch_array($query);

$temporada_record_id = $rs["ID"];
$temporada_record_usuario = $rs["Usuario"];
$temporada_record_nivel = $rs["Nivel"];
$temporada_record_gols_temporada = $rs["Gols_Temporada_Record"];
$temporada_record_vip = $rs["VIP_Tempo"];
$temporada_record_vip_cor = $rs["VIP_Cor"];
$temporada_record_time = $rs["Time"];
$temporada_record_time_nome = $rs["Time_Nome"];

?>

<div id="principal_metade">

<div id="principal_metade_esquerda">

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Melhores da Rodada</h1></div></div></div>
	<div class="conteudo" style="padding-top: 4px">

<?php if ($marcadores_rodada > 0) { ?>

<?php

$query = mysql_query("SELECT Usuarios.ID, Usuario, Nivel, Gols_Rodada, VIP_Tempo, VIP_Cor, Usuarios.Time, Times.Time as Time_Nome FROM Usuarios INNER JOIN Times ON Times.ID = Usuarios.Time WHERE Gols_Rodada > 0 ORDER BY Gols_Rodada DESC LIMIT 10");

?>

<?php while ($rs = mysql_fetch_array($query)) { ?>

<div id="linha6"><span class="img25"><img width="25" height="25" src="figuras/niveis/<?=$rs["Nivel"]?>.png" title="<?=$rs["Nivel"]?>" alt="<?=$rs["Nivel"]?>"></span> <span class="img20"><a href="time.php?id=<?=$rs["Time"]?>"><img width="20" height="20" src="figuras/times_pequenos/<?=$rs["Time"]?>.png" title="<?=$rs["Time_Nome"]?>" alt="<?=$rs["Time_Nome"]?>" border="0"></a></span> <a href="usuario.php?id=<?=$rs["ID"]?>"><?php if ($rs["VIP_Tempo"] > time()) { ?><span id="usuario_vip<?=$rs["VIP_Cor"]?>"><?=$rs["Usuario"]?></span><?php } else { ?><span id="usuario_normal"><?=$rs["Usuario"]?></span><?php } ?></a><?php if ($rs["ID"] == $recordtemporada_1) { ?> <span class="medalha"><img width="14" height="14" src="figuras/principal/trofeu1.png" title="Top 1 da Temporada" alt="Top 1 da Temporada"></span> <? } ?><?php if ($rs["ID"] == $recordrodada_1) { ?> <span class="medalha"><img width="14" height="14" src="figuras/principal/bola1.png" title="Top 1 da Rodada" alt="Top 1 da Rodada"></span> <? } ?> <?php if ($rs["ID"] == $medalha_1) { ?><span class="medalha"><img width="14" height="14" src="figuras/principal/medalha1.png" title="Top 1 da Hora" alt="Top 1 da Hora"></span><?php } else if ($rs["ID"] == $medalha_2) { ?><span class="medalha"><img width="14" height="14" src="figuras/principal/medalha2.png" title="Top 2 da Hora" alt="Top 2 da Hora"></span><?php } else if ($rs["ID"] == $medalha_3) { ?><span class="medalha"><img width="14" height="14" src="figuras/principal/medalha3.png" title="Top 3 da Hora" alt="Top 3 da Hora"></span><?php } ?> <span class="gols_rodada"><?=number_format($rs["Gols_Rodada"],0,',','.')?></span></div>

<?php } ?>

<div id="linha6"><span class="img16"><img width="14" height="14" src="figuras/principal/seta1.png"></span> <a href="ranking_rodada.php"><b>Ver Completo</b></a></div>

<?php } else { ?>

<div id="linha6"><span class="img16"><img width="14" height="14" src="figuras/principal/alerta_nao.png"></span> Nenhum marcador encontrado.</div>

<?php } ?>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<?php if ($rodada_record_gols_rodada != 0) { ?>
<div id="divide"></div>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Record</h1></div></div></div>
	<div class="conteudo">

<div id="linha10"><span class="img25"><img width="25" height="25" src="figuras/niveis/<?=$rodada_record_nivel?>.png" title="<?=$rodada_record_nivel?>" alt="<?=$rodada_record_nivel?>"></span> <span class="img20"><a href="time.php?id=<?=$rodada_record_time?>"><img width="20" height="20" src="figuras/times_pequenos/<?=$rodada_record_time?>.png" title="<?=$rodada_record_time_nome?>" alt="<?=$rodada_record_time_nome?>" border="0"></a></span> <a href="usuario.php?id=<?=$rodada_record_id?>"><?php if ($rodada_record_vip > time()) { ?><span id="usuario_vip<?=$rodada_record_vip_cor?>"><?=$rodada_record_usuario?></span><?php } else { ?><span id="usuario_normal"><?=$rodada_record_usuario?></span><?php } ?></a><?php if ($rodada_record_id == $recordtemporada_1) { ?> <span class="medalha"><img width="14" height="14" src="figuras/principal/trofeu1.png" title="Top 1 da Temporada" alt="Top 1 da Temporada"></span> <? } ?><?php if ($rodada_record_id == $recordrodada_1) { ?> <span class="medalha"><img width="14" height="14" src="figuras/principal/bola1.png" title="Top 1 da Rodada" alt="Top 1 da Rodada"></span> <? } ?> <?php if ($rodada_record_id == $medalha_1) { ?><span class="medalha"><img width="14" height="14" src="figuras/principal/medalha1.png" title="Top 1 da Hora" alt="Top 1 da Hora"></span><?php } else if ($rodada_record_id == $medalha_2) { ?><span class="medalha"><img width="14" height="14" src="figuras/principal/medalha2.png" title="Top 2 da Hora" alt="Top 2 da Hora"></span><?php } else if ($rodada_record_id == $medalha_3) { ?><span class="medalha"><img width="14" height="14" src="figuras/principal/medalha3.png" title="Top 3 da Hora" alt="Top 3 da Hora"></span><?php } ?> <span class="gols_rodada"><?=number_format($rodada_record_gols_rodada,0,',','.')?></span></div>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>
<?php } ?>

</div>
<div id="principal_metade_direita">

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Melhores da Temporada</h1></div></div></div>
	<div class="conteudo" style="padding-top: 4px">

<?php if ($marcadores_temporada > 0) { ?>

<?php

$query = mysql_query("SELECT Usuarios.ID, Usuario, Nivel, Gols_Temporada, VIP_Tempo, VIP_Cor, Usuarios.Time, Times.Time as Time_Nome FROM Usuarios INNER JOIN Times ON Times.ID = Usuarios.Time WHERE Gols_Temporada > 0 ORDER BY Gols_Temporada DESC LIMIT 10");

?>

<?php while ($rs = mysql_fetch_array($query)) { ?>

<div id="linha6"><span class="img25"><img width="25" height="25" src="figuras/niveis/<?=$rs["Nivel"]?>.png" title="<?=$rs["Nivel"]?>" alt="<?=$rs["Nivel"]?>"></span> <span class="img20"><a href="time.php?id=<?=$rs["Time"]?>"><img width="20" height="20" src="figuras/times_pequenos/<?=$rs["Time"]?>.png" title="<?=$rs["Time_Nome"]?>" alt="<?=$rs["Time_Nome"]?>" border="0"></a></span> <a href="usuario.php?id=<?=$rs["ID"]?>"><?php if ($rs["VIP_Tempo"] > time()) { ?><span id="usuario_vip<?=$rs["VIP_Cor"]?>"><?=$rs["Usuario"]?></span><?php } else { ?><span id="usuario_normal"><?=$rs["Usuario"]?></span><?php } ?></a><?php if ($rs["ID"] == $recordtemporada_1) { ?> <span class="medalha"><img width="14" height="14" src="figuras/principal/trofeu1.png" title="Top 1 da Temporada" alt="Top 1 da Temporada"></span> <? } ?><?php if ($rs["ID"] == $recordrodada_1) { ?> <span class="medalha"><img width="14" height="14" src="figuras/principal/bola1.png" title="Top 1 da Rodada" alt="Top 1 da Rodada"></span> <? } ?> <?php if ($rs["ID"] == $medalha_1) { ?><span class="medalha"><img width="14" height="14" src="figuras/principal/medalha1.png" title="Top 1 da Hora" alt="Top 1 da Hora"></span><?php } else if ($rs["ID"] == $medalha_2) { ?><span class="medalha"><img width="14" height="14" src="figuras/principal/medalha2.png" title="Top 2 da Hora" alt="Top 2 da Hora"></span><?php } else if ($rs["ID"] == $medalha_3) { ?><span class="medalha"><img width="14" height="14" src="figuras/principal/medalha3.png" title="Top 3 da Hora" alt="Top 3 da Hora"></span><?php } ?> <span class="gols_temporada"><?=number_format($rs["Gols_Temporada"],0,',','.')?></span></div>

<?php } ?>

<div id="linha6"><span class="img16"><img width="14" height="14" src="figuras/principal/seta1.png"></span> <a href="ranking_temporada.php"><b>Ver Completo</b></a></div>

<?php } else { ?>

<div id="linha6"><span class="img16"><img width="14" height="14" src="figuras/principal/alerta_nao.png"></span> Nenhum marcador encontrado.</div>

<?php } ?>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<?php if ($temporada_record_gols_temporada != 0) { ?>
<div id="divide"></div>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Record</h1></div></div></div>
	<div class="conteudo">

<div id="linha10"><span class="img25"><img width="25" height="25" src="figuras/niveis/<?=$temporada_record_nivel?>.png" title="<?=$temporada_record_nivel?>" alt="<?=$temporada_record_nivel?>"></span> <span class="img20"><a href="time.php?id=<?=$temporada_record_time?>"><img width="20" height="20" src="figuras/times_pequenos/<?=$temporada_record_time?>.png" title="<?=$temporada_record_time_nome?>" alt="<?=$temporada_record_time_nome?>" border="0"></a></span> <a href="usuario.php?id=<?=$temporada_record_id?>"><?php if ($temporada_record_vip > time()) { ?><span id="usuario_vip<?=$temporada_record_vip_cor?>"><?=$temporada_record_usuario?></span><?php } else { ?><span id="usuario_normal"><?=$temporada_record_usuario?></span><?php } ?></a><?php if ($temporada_record_id == $recordtemporada_1) { ?> <span class="medalha"><img width="14" height="14" src="figuras/principal/trofeu1.png" title="Top 1 da Temporada" alt="Top 1 da Temporada"></span> <? } ?><?php if ($temporada_record_id == $recordrodada_1) { ?> <span class="medalha"><img width="14" height="14" src="figuras/principal/bola1.png" title="Top 1 da Rodada" alt="Top 1 da Rodada"></span> <? } ?> <?php if ($temporada_record_id == $medalha_1) { ?><span class="medalha"><img width="14" height="14" src="figuras/principal/medalha1.png" title="Top 1 da Hora" alt="Top 1 da Hora"></span><?php } else if ($temporada_record_id == $medalha_2) { ?><span class="medalha"><img width="14" height="14" src="figuras/principal/medalha2.png" title="Top 2 da Hora" alt="Top 2 da Hora"></span><?php } else if ($temporada_record_id == $medalha_3) { ?><span class="medalha"><img width="14" height="14" src="figuras/principal/medalha3.png" title="Top 3 da Hora" alt="Top 3 da Hora"></span><?php } ?> <span class="gols_temporada"><?=number_format($temporada_record_gols_temporada,0,',','.')?></span></div>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>
<?php } ?>

</div>
</div>
<!-- FIM DA PÁGINA -->
</div>
<div class="clear"></div>
</div>
<div id="baixo"><?php include("baixo.php") ?></div>
</div>
</body>
</html>