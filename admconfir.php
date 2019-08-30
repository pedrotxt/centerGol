<?php include_once("fun_anti_inj.php") ?>
<?php include("verificar_cookie.php") ?>
<?php include("conexao.php") ?>
<?php include("verificar_conexao.php") ?>
<?php
$query = mysql_query("SELECT Presidente_Dias FROM Usuarios WHERE ID = {$_POST['id_usuario']}");
@$rs = mysql_fetch_array($query);

$mc_presidente_tempo = $rs['Presidente_Dias'];

$query = mysql_query("SELECT Moderador FROM Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$rs1 = mysql_fetch_array($query);

if($rs1['Moderador'] == 1){
/* Normal

if(isset($_POST['Confirmar'])){
if($_POST['pacote'] == 1){
$vip=40;
if($mc_presidente_tempo < time()){
$diasp=time()+30*86400;
mysql_query("Update Usuarios set Presidente_Dias = {$diasp} where ID = {$_POST['id_usuario']}");
}else{
$diasp=30*86400;
mysql_query("Update Usuarios set Presidente_Dias = Presidente_Dias+{$diasp} where ID = {$_POST['id_usuario']}");
}
$chuteoff=10;
mysql_query("Update Usuarios set VIP=VIP+{$vip}, Item_Chuteoff=Item_Chuteoff+{$chuteoff} where ID = {$_POST['id_usuario']}");

}elseif($_POST['pacote'] == 2){
$vip=80;
if($mc_presidente_tempo < time()){
$diasp=time()+40*86400;
mysql_query("Update Usuarios set Presidente_Dias = {$diasp} where ID = {$_POST['id_usuario']}");
}else{
$diasp=40*86400;
mysql_query("Update Usuarios set Presidente_Dias = Presidente_Dias+{$diasp} where ID = {$_POST['id_usuario']}");
}
$chuteoff=20;
mysql_query("Update Usuarios set VIP=VIP+{$vip}, Item_Chuteoff=Item_Chuteoff+{$chuteoff} where ID = {$_POST['id_usuario']}");

}elseif($_POST['pacote'] == 3){
$vip=120;
if($mc_presidente_tempo < time()){
$diasp=time()+50*86400;
mysql_query("Update Usuarios set Presidente_Dias = {$diasp} where ID = {$_POST['id_usuario']}");
}else{
$diasp=50*86400;
mysql_query("Update Usuarios set Presidente_Dias = Presidente_Dias+{$diasp} where ID = {$_POST['id_usuario']}");
}
$chuteoff=30;
mysql_query("Update Usuarios set VIP=VIP+{$vip}, Item_Chuteoff=Item_Chuteoff+{$chuteoff} where ID = {$_POST['id_usuario']}");
}elseif($_POST['pacote'] == 4){
$vip=160;
if($mc_presidente_tempo < time()){
$diasp=time()+60*86400;
mysql_query("Update Usuarios set Presidente_Dias = {$diasp} where ID = {$_POST['id_usuario']}");
}else{
$diasp=60*86400;
mysql_query("Update Usuarios set Presidente_Dias = Presidente_Dias+{$diasp} where ID = {$_POST['id_usuario']}");
}
$chuteoff=40;
mysql_query("Update Usuarios set VIP=VIP+{$vip}, Item_Chuteoff=Item_Chuteoff+{$chuteoff} where ID = {$_POST['id_usuario']}");

}elseif($_POST['pacote'] == 5){
$vip=200;
if($mc_presidente_tempo < time()){
$diasp=time()+80*86400;
mysql_query("Update Usuarios set Presidente_Dias = {$diasp} where ID = {$_POST['id_usuario']}");
}else{
$diasp=80*86400;
mysql_query("Update Usuarios set Presidente_Dias = Presidente_Dias+{$diasp} where ID = {$_POST['id_usuario']}");
}
$chuteoff=50;
mysql_query("Update Usuarios set VIP=VIP+{$vip}, Item_Chuteoff=Item_Chuteoff+{$chuteoff} where ID = {$_POST['id_usuario']}");

}elseif($_POST['pacote'] == 6){
$vip=500;
if($mc_presidente_tempo < time()){
$diasp=time()+160*86400;
mysql_query("Update Usuarios set Presidente_Dias = {$diasp} where ID = {$_POST['id_usuario']}");
}else{
$diasp=160*86400;
mysql_query("Update Usuarios set Presidente_Dias = Presidente_Dias+{$diasp} where ID = {$_POST['id_usuario']}");
}
$chuteoff=100;
mysql_query("Update Usuarios set VIP=VIP+{$vip}, Item_Chuteoff=Item_Chuteoff+{$chuteoff} where ID = {$_POST['id_usuario']}");

}
*/

// Promoção

if(isset($_POST['Confirmar'])){
if($_POST['pacote'] == 1){
$vip=100;
if($mc_presidente_tempo < time()){
$diasp=time()+30*86400;
mysql_query("Update Usuarios set Presidente_Dias = {$diasp} where ID = {$_POST['id_usuario']}");
}else{
$diasp=30*86400;
mysql_query("Update Usuarios set Presidente_Dias = Presidente_Dias+{$diasp} where ID = {$_POST['id_usuario']}");
}
$chuteoff=10;
mysql_query("Update Usuarios set VIP=VIP+{$vip}, Item_Chuteoff=Item_Chuteoff+{$chuteoff} where ID = {$_POST['id_usuario']}");

}elseif($_POST['pacote'] == 2){
$vip=200;
if($mc_presidente_tempo < time()){
$diasp=time()+40*86400;
mysql_query("Update Usuarios set Presidente_Dias = {$diasp} where ID = {$_POST['id_usuario']}");
}else{
$diasp=40*86400;
mysql_query("Update Usuarios set Presidente_Dias = Presidente_Dias+{$diasp} where ID = {$_POST['id_usuario']}");
}
$chuteoff=20;
mysql_query("Update Usuarios set VIP=VIP+{$vip}, Item_Chuteoff=Item_Chuteoff+{$chuteoff} where ID = {$_POST['id_usuario']}");

}elseif($_POST['pacote'] == 3){
$vip=300;
if($mc_presidente_tempo < time()){
$diasp=time()+50*86400;
mysql_query("Update Usuarios set Presidente_Dias = {$diasp} where ID = {$_POST['id_usuario']}");
}else{
$diasp=50*86400;
mysql_query("Update Usuarios set Presidente_Dias = Presidente_Dias+{$diasp} where ID = {$_POST['id_usuario']}");
}
$chuteoff=30;
mysql_query("Update Usuarios set VIP=VIP+{$vip}, Item_Chuteoff=Item_Chuteoff+{$chuteoff} where ID = {$_POST['id_usuario']}");
}elseif($_POST['pacote'] == 4){
$vip=400;
if($mc_presidente_tempo < time()){
$diasp=time()+60*86400;
mysql_query("Update Usuarios set Presidente_Dias = {$diasp} where ID = {$_POST['id_usuario']}");
}else{
$diasp=60*86400;
mysql_query("Update Usuarios set Presidente_Dias = Presidente_Dias+{$diasp} where ID = {$_POST['id_usuario']}");
}
$chuteoff=40;
mysql_query("Update Usuarios set VIP=VIP+{$vip}, Item_Chuteoff=Item_Chuteoff+{$chuteoff} where ID = {$_POST['id_usuario']}");

}elseif($_POST['pacote'] == 5){
$vip=500;
if($mc_presidente_tempo < time()){
$diasp=time()+80*86400;
mysql_query("Update Usuarios set Presidente_Dias = {$diasp} where ID = {$_POST['id_usuario']}");
}else{
$diasp=80*86400;
mysql_query("Update Usuarios set Presidente_Dias = Presidente_Dias+{$diasp} where ID = {$_POST['id_usuario']}");
}
$chuteoff=50;
mysql_query("Update Usuarios set VIP=VIP+{$vip}, Item_Chuteoff=Item_Chuteoff+{$chuteoff} where ID = {$_POST['id_usuario']}");

}elseif($_POST['pacote'] == 6){
$vip=600;
if($mc_presidente_tempo < time()){
$diasp=time()+160*86400;
mysql_query("Update Usuarios set Presidente_Dias = {$diasp} where ID = {$_POST['id_usuario']}");
}else{
$diasp=160*86400;
mysql_query("Update Usuarios set Presidente_Dias = Presidente_Dias+{$diasp} where ID = {$_POST['id_usuario']}");
}
$chuteoff=100;
mysql_query("Update Usuarios set VIP=VIP+{$vip}, Item_Chuteoff=Item_Chuteoff+{$chuteoff} where ID = {$_POST['id_usuario']}");

}
}
?>
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
<style type="text/css">
input[type="submit"]
{
	background:url(figuras/principal/botao_confirmar.png) no-repeat;
	width:100px;
	height:30px;
	border:none;
}
</style>
<!-- INÍCIO DA PÁGINA -->
<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Confirmar Pagamento</h1></div></div></div>
	<div class="conteudo">
    <div id="linha10">
<form action="" method="post">
        <select id="pacote" name="pacote">
        <? 
		$query=mysql_query("Select * From Pagseguro Order by ID");

		while($rs=mysql_fetch_array($query)){ ?>
        	<option value="<?=$rs['ID']?>"><?=$rs['Nome']?></option>
        <? } ?>
        </select>
        <br><br>
       <input name="id_usuario" type="text" style="width:430px; height:30px;" placeholder="ID Usuario">
       <input name="Confirmar" type="submit" value=" " style="margin-left:10px; position:absolute;"><br>
</form>
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
<? }else{ ?>
Essa página não existe
<? } ?>