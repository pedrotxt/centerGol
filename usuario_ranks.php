<?
function rankhora($perso){
	$sql=mysql_query("select ID from Usuarios order by Gols_Hora DESC");
	$i = 1;
	while($linha=mysql_fetch_array($sql))
	{
	if($linha['ID'] == $perso)
	$ok=$i;
	$i++;
	}
	return $ok;
	}
function rankrodada($perso){
	$sql=mysql_query("select ID from Usuarios order by Gols_Rodada DESC");
	$i = 1;
	while($linha=mysql_fetch_array($sql))
	{
	if($linha['ID'] == $perso)
	$ok=$i;
	$i++;
	}
	return $ok;
	}
function ranktemporada($perso){
	$sql=mysql_query("select ID from Usuarios order by Gols_Temporada DESC");
	$i = 1;
	while($linha=mysql_fetch_array($sql))
	{
	if($linha['ID'] == $perso)
	$ok=$i;
	$i++;
	}
	return $ok;
	}
function ranktotal($perso){
	$sql=mysql_query("select ID from Usuarios order by Gols_Total DESC");
	$i = 1;
	while($linha=mysql_fetch_array($sql))
	{
	if($linha['ID'] == $perso)
	$ok=$i;
	$i++;
	}
	return $ok;
	}
function rankpasse($perso){
	$sql=mysql_query("select ID from Usuarios order by Passe_Certo_Acertos DESC");
	$i = 1;
	while($linha=mysql_fetch_array($sql))
	{
	if($linha['ID'] == $perso)
	$ok=$i;
	$i++;
	}
	return $ok;
	}
function rankpenalt($perso){
	$sql=mysql_query("select ID from Usuarios order by Penalti_Acertos DESC");
	$i = 1;
	while($linha=mysql_fetch_array($sql))
	{
	if($linha['ID'] == $perso)
	$ok=$i;
	$i++;
	}
	return $ok;
	}
function rankfalta($perso){
	$sql=mysql_query("select ID from Usuarios order by Falta_Acertos DESC");
	$i = 1;
	while($linha=mysql_fetch_array($sql))
	{
	if($linha['ID'] == $perso)
	$ok=$i;
	$i++;
	}
	return $ok;
	}
	?>