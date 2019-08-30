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

<div id="esquerda"><?php include("esquerda.php") ?></div>
<div id="direita"><?php include("direita.php") ?></div>
<div id="principal">
<!-- INÍCIO DA PÁGINA -->
<style type="text/css">
#botao0
{
	background:url(figuras/principal/botao_iniciar0.png) no-repeat;
	width:100px;
	height:30px;
	border:none;
}
#botao
{
	background:url(figuras/principal/botao_iniciar.png) no-repeat;
	width:100px;
	height:30px;
	border:none;
}
#botao1
{
	background:url(figuras/principal/botao_iniciar1.png) no-repeat;
	width:100px;
	height:30px;
	border:none;
}
#red
{
background-color:rgba(255, 0, 0, 0.40);
border-radius: 8px;
}
#green
{
background-color:rgba(0, 128, 0, 0.40);
border-radius: 8px;
}
</style>
<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Tarefas Liga Campeões</h1></div></div></div>
	<div class="conteudo">

<div id="linha10">
<table width="100%" border="0">
<? 
$query = mysql_query("SELECT * FROM Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$r = mysql_fetch_array($query);

$query = mysql_query("SELECT * FROM Tarefas_Usuarios WHERE Usuario_ID = {$r['ID']}");
$comp = mysql_fetch_array($query);

$query=mysql_query("select * from Tarefas ORDER BY ID"); 
$x=1;
while($rs=mysql_fetch_array($query)){
if($x == 1){
$id = $rs['ID'];
	if(mysql_num_rows(mysql_query("select * from Tarefas_Usuarios where Tarefa_ID={$id} and Usuario_ID={$r['ID']}"))>=1){
	$cor=green;
	$botao=botao1;
	$permissao=tarefa_ok;
	}elseif($r['Gols_Time'] >= $rs['Numero']){
	$cor=green;
	$botao=botao;
	$permissao=tarefa_ok;
	}else{
	$cor=red;
	$botao=botao0;
	$permissao=tarefa_error;
	$id = 0;
	$msg='id="tip-s" original-title="Faltam: '.$r['Gols_Time'].' / '.$rs['Numero'].' "';

	}
}
if($x == 2){
$id = $rs['ID'];
	if(mysql_num_rows(mysql_query("select * from Tarefas_Usuarios where Tarefa_ID={$id} and Usuario_ID={$r['ID']}"))>=1){
	$cor=green;
	$botao=botao1;
	$permissao=tarefa_ok;
	}elseif($r['Gols_Time'] >= $rs['Numero']){
	$cor=green;
	$botao=botao;
	$permissao=tarefa_ok;
	}else{
	$cor=red;
	$botao=botao0;
	$permissao=tarefa_error;
	$id = 0;
	$msg='id="tip-s" original-title="Faltam: '.$r['Gols_Time'].' / '.$rs['Numero'].' "';

	}
}
if($x == 3){
$id = $rs['ID'];
	if(mysql_num_rows(mysql_query("select * from Tarefas_Usuarios where Tarefa_ID={$id} and Usuario_ID={$r['ID']}"))>=1){
	$cor=green;
	$botao=botao1;
	$permissao=tarefa_ok;
	}elseif($r['Gols_Time'] >= $rs['Numero']){
	$cor=green;
	$botao=botao;
	$permissao=tarefa_ok;
	}else{
	$cor=red;
	$botao=botao0;
	$permissao=tarefa_error;
	$id = 0;
	$msg='id="tip-s" original-title="Faltam: '.$r['Gols_Time'].' / '.$rs['Numero'].' "';

	}
}
if($x == 4){
$id = $rs['ID'];
	if(mysql_num_rows(mysql_query("select * from Tarefas_Usuarios where Tarefa_ID={$id} and Usuario_ID={$r['ID']}"))>=1){
	$cor=green;
	$botao=botao1;
	$permissao=tarefa_ok;
	}elseif($r['Gols_Time'] >= $rs['Numero']){
	$cor=green;
	$botao=botao;
	$permissao=tarefa_ok;
	}else{
	$cor=red;
	$botao=botao0;
	$permissao=tarefa_error;
	$id = 0;
	$msg='id="tip-s" original-title="Faltam: '.$r['Gols_Time'].' / '.$rs['Numero'].' "';

	}
}
if($x == 5){
$id = $rs['ID'];
	if(mysql_num_rows(mysql_query("select * from Tarefas_Usuarios where Tarefa_ID={$id} and Usuario_ID={$r['ID']}"))>=1){
	$cor=green;
	$botao=botao1;
	$permissao=tarefa_ok;
	}elseif($r['Gols_Rodada'] >= $rs['Numero']){
	$cor=green;
	$botao=botao;
	$permissao=tarefa_ok;
	}else{
	$cor=red;
	$botao=botao0;
	$permissao=tarefa_error;
	$id = 0;
	$msg='id="tip-s" original-title="Faltam: '.$r['Gols_Rodada'].' / '.$rs['Numero'].' "';

	}
}
if($x == 6){
$id = $rs['ID'];
	if(mysql_num_rows(mysql_query("select * from Tarefas_Usuarios where Tarefa_ID={$id} and Usuario_ID={$r['ID']}"))>=1){
	$cor=green;
	$botao=botao1;
	$permissao=tarefa_ok;
	}elseif($r['Gols_Rodada'] >= $rs['Numero']){
	$cor=green;
	$botao=botao;
	$permissao=tarefa_ok;
	}else{
	$cor=red;
	$botao=botao0;
	$permissao=tarefa_error;
	$id = 0;
	$msg='id="tip-s" original-title="Faltam: '.$r['Gols_Rodada'].' / '.$rs['Numero'].' "';

	}
}
if($x == 7){
$id = $rs['ID'];
	if(mysql_num_rows(mysql_query("select * from Tarefas_Usuarios where Tarefa_ID={$id} and Usuario_ID={$r['ID']}"))>=1){
	$cor=green;
	$botao=botao1;
	$permissao=tarefa_ok;
	}elseif($r['Gols_Rodada'] >= $rs['Numero']){
	$cor=green;
	$botao=botao;
	$permissao=tarefa_ok;
	}else{
	$cor=red;
	$botao=botao0;
	$permissao=tarefa_error;
	$id = 0;
	$msg='id="tip-s" original-title="Faltam: '.$r['Gols_Rodada'].' / '.$rs['Numero'].' "';

	}
}
if($x == 8){
$id = $rs['ID'];
	if(mysql_num_rows(mysql_query("select * from Tarefas_Usuarios where Tarefa_ID={$id} and Usuario_ID={$r['ID']}"))>=1){
	$cor=green;
	$botao=botao1;
	$permissao=tarefa_ok;
	}elseif($r['Gols_Rodada'] >= $rs['Numero']){
	$cor=green;
	$botao=botao;
	$permissao=tarefa_ok;
	}else{
	$cor=red;
	$botao=botao0;
	$permissao=tarefa_error;
	$id = 0;
	$msg='id="tip-s" original-title="Faltam: '.$r['Gols_Rodada'].' / '.$rs['Numero'].' "';

	}
}
?>
  <tr align="center">
    <td id="<?=$cor?>" width="67%"><strong>Descricão</strong><br><div id="opci"><?=$rs['Descricao']?><br><br><strong>Recompensa</strong><br><img width="16" height="16" src="figuras/principal/dinheiro.png" title="Dinheiro" alt="Dinheiro"> <?=number_format($rs['Recompensa'],0,',','.')?></div></td>
    <td id="<?=$cor?>" width="23%">
    <img src="./figuras/principal/<?=$permissao?>.png" width="35" height="35" <?=$msg?> /><br>
    <form action="" method="post">
    <input id="<?=$botao?>" name="completar" type="submit" value="" />
    <input style="display:none;" name="id" type="text" value="<?=$id?>" />
    <input style="display:none;" name="Edite Aqui para Ganhar Dinheiro Infinito" type="text" value="0" />
    </form>
    </td>
  </tr>
<? 
$x++;
} ?>
<?
$a=mysql_fetch_array(mysql_query("select * from Tarefas where ID='".$_POST['id']."'"));
if(isset($_POST['completar'])){
	if($a['ID'] == 1){
	if(mysql_num_rows(mysql_query("select * from Tarefas_Usuarios where Tarefa_ID={$a['ID']} and Usuario_ID={$r['ID']}"))>=1){
	echo "Essa tarefa já foi completada!";
	}elseif($r['Gols_Time'] >= $a['Numero']){
	mysql_query("update Usuarios set Dinheiro=Dinheiro+{$a['Recompensa']} WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
	mysql_query("insert into Tarefas_Usuarios(Usuario_ID,Tarefa_ID)values('".$r['ID']."','".$a['ID']."')");
	echo "Parabéns você completou a tarefa";
	}else{
			echo "Você não completou essa Tarefa!";
	}
	}
	
	if($a['ID'] == 2){
	if(mysql_num_rows(mysql_query("select * from Tarefas_Usuarios where Tarefa_ID={$a['ID']} and Usuario_ID={$r['ID']}"))>=1){
	echo "Essa tarefa já foi completada!";
	}elseif($r['Gols_Time'] >= $a['Numero']){
	mysql_query("update Usuarios set Dinheiro=Dinheiro+{$a['Recompensa']} WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
	mysql_query("insert into Tarefas_Usuarios(Usuario_ID,Tarefa_ID)values('".$r['ID']."','".$a['ID']."')");
	echo "Parabéns você completou a tarefa";
	}else{
			echo "Você não completou essa Tarefa!";
	}
	}
	
		if($a['ID'] == 3){
	if(mysql_num_rows(mysql_query("select * from Tarefas_Usuarios where Tarefa_ID={$a['ID']} and Usuario_ID={$r['ID']}"))>=1){
	echo "Essa tarefa já foi completada!";
	}elseif($r['Gols_Time'] >= $a['Numero']){
	mysql_query("update Usuarios set Dinheiro=Dinheiro+{$a['Recompensa']} WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
	mysql_query("insert into Tarefas_Usuarios(Usuario_ID,Tarefa_ID)values('".$r['ID']."','".$a['ID']."')");
	echo "Parabéns você completou a tarefa";
	}else{
			echo "Você não completou essa Tarefa!";
	}
	}
	
		if($a['ID'] == 4){
	if(mysql_num_rows(mysql_query("select * from Tarefas_Usuarios where Tarefa_ID={$a['ID']} and Usuario_ID={$r['ID']}"))>=1){
	echo "Essa tarefa já foi completada!";
	}elseif($r['Gols_Time'] >= $a['Numero']){
	mysql_query("update Usuarios set Dinheiro=Dinheiro+{$a['Recompensa']} WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
	mysql_query("insert into Tarefas_Usuarios(Usuario_ID,Tarefa_ID)values('".$r['ID']."','".$a['ID']."')");
	echo "Parabéns você completou a tarefa";
	}else{
			echo "Você não completou essa Tarefa!";
	}
	}
	
		if($a['ID'] == 5){
	if(mysql_num_rows(mysql_query("select * from Tarefas_Usuarios where Tarefa_ID={$a['ID']} and Usuario_ID={$r['ID']}"))>=1){
	echo "Essa tarefa já foi completada!";
	}elseif($r['Gols_Rodada'] >= $a['Numero']){
	mysql_query("update Usuarios set Dinheiro=Dinheiro+{$a['Recompensa']} WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
	mysql_query("insert into Tarefas_Usuarios(Usuario_ID,Tarefa_ID)values('".$r['ID']."','".$a['ID']."')");
	echo "Parabéns você completou a tarefa";
	}else{
			echo "Você não completou essa Tarefa!";
	}
	}
	
		if($a['ID'] == 6){
	if(mysql_num_rows(mysql_query("select * from Tarefas_Usuarios where Tarefa_ID={$a['ID']} and Usuario_ID={$r['ID']}"))>=1){
	echo "Essa tarefa já foi completada!";
	}elseif($r['Gols_Rodada'] >= $a['Numero']){
	mysql_query("update Usuarios set Dinheiro=Dinheiro+{$a['Recompensa']} WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
	mysql_query("insert into Tarefas_Usuarios(Usuario_ID,Tarefa_ID)values('".$r['ID']."','".$a['ID']."')");
	echo "Parabéns você completou a tarefa";
	}else{
			echo "Você não completou essa Tarefa!";
	}
	}
	
		if($a['ID'] == 7){
	if(mysql_num_rows(mysql_query("select * from Tarefas_Usuarios where Tarefa_ID={$a['ID']} and Usuario_ID={$r['ID']}"))>=1){
	echo "Essa tarefa já foi completada!";
	}elseif($r['Gols_Rodada'] >= $a['Numero']){
	mysql_query("update Usuarios set Dinheiro=Dinheiro+{$a['Recompensa']} WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
	mysql_query("insert into Tarefas_Usuarios(Usuario_ID,Tarefa_ID)values('".$r['ID']."','".$a['ID']."')");
	echo "Parabéns você completou a tarefa";
	}else{
			echo "Você não completou essa Tarefa!";
	}
	}
	
		if($a['ID'] == 8){
	if(mysql_num_rows(mysql_query("select * from Tarefas_Usuarios where Tarefa_ID={$a['ID']} and Usuario_ID={$r['ID']}"))>=1){
	echo "Essa tarefa já foi completada!";
	}elseif($r['Gols_Rodada'] >= $a['Numero']){
	mysql_query("update Usuarios set Dinheiro=Dinheiro+{$a['Recompensa']} WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
	mysql_query("insert into Tarefas_Usuarios(Usuario_ID,Tarefa_ID)values('".$r['ID']."','".$a['ID']."')");
	echo "Parabéns você completou a tarefa";
	}else{
			echo "Você não completou essa Tarefa!";
	}
	}
	
	if($a['ID'] == 0 or $a['ID'] < 0){
	echo "Você não completou essa Tarefa!";
	}
}
?>
</table>

</div>

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