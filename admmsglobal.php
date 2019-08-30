<?php include_once("fun_anti_inj.php") ?>
<?php include("verificar_cookie.php") ?>
<?php include("conexao.php") ?>
<?php include("verificar_conexao.php") ?>
<?php

$query = mysql_query("SELECT * FROM Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$rs1 = mysql_fetch_array($query);
$usuario=$rs1['ID'];
$usuario1=$rs1['Usuario'];
if($rs1['Moderador'] == 1){

if(isset($_POST['enviar'])){
$data = date("d/m");
$hora = date("H:i");
$mensagem = $_POST['MSG'];
$query = mysql_query("SELECT * FROM Usuarios");
while($r=mysql_fetch_array($query)){	
mysql_query("INSERT INTO Mensagens_Usuario (Usuario,Para,Mensagem,Data,Hora) VALUES (0,'". $r['ID'] ."','". $mensagem ."<br><br>Enviada por: <a href=./usuario.php?id=".$usuario.">".$usuario1."</a>','". $data ."','". $hora ."')");

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
<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Mensagem Global</h1></div></div></div>
	<div class="conteudo">
<div id="linha10">

<form method="post" action="">
<table width="100%" border="0">
  <tr>
    <td width="19%">
      <input type="text" name="MSG" style="width:300px; height:200px">
    </td>
    <td width="81%">
      <input type="submit" name="enviar" style="width:150px; height:90px" value="Enviar" ></td>
  </tr>
</table>
</form>
</div>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

</div>
<div class="clear"></div>

</div>
<div id="baixo"><?php include("baixo.php") ?></div>
</div>
</body>
</html>
<? }else{ ?>
Essa página nao existe
<? } ?>