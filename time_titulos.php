<?php ob_start(); ?>
<?php include_once("fun_anti_inj.php") ?>
<?php include("verificar_cookie.php") ?>
<?php include("conexao.php") ?>
<?php include("verificar_conexao.php") ?>
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
<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Ranking Times</h1></div></div></div>
	<div class="conteudo">
<style type="text/css">
.camp1{display:block;}
.camp2{display:none;}
.camp3{display:none;}
</style>
<br>
<select id="serie" onchange="if(this.value == 'a'){
$('.camp1').show();
$('.camp2').hide();
$('.camp3').hide();
}else if(this.value == 'b'){
$('.camp2').show();
$('.camp1').hide();
$('.camp3').hide();
}else{
$('.camp3').show();
$('.camp2').hide();
$('.camp1').hide();
};">
<option value="a">Campeonato LC</option>
<option value="b">Copa Do Brasil</option>
<option value="c">Liga LC</option></select>
<div class="camp1">

<div id="linha6">

<table width="550" cellpadding="0" cellspacing="0">



	<tr height="25" bgcolor="#B6B6B6">
		<td width="55">&nbsp;</td>
        <td width="200" style="padding-left: 31px" class="fonte1_negrito">Time</td>
		<td width="200" class="fonte1_negrito">Campe&atilde;o</td>
		<td width="95" class="fonte1_negrito">Vice</td>
	</tr>
<?
	  $res=mysql_query("select * from Times order by Campeonato_FC_Titulos desc, Campeonato_FC_Vices desc limit 0,20");
	  $i=1;
	  while($r=mysql_fetch_array($res)){
?>	<tr>
    	<td style="padding-top: 5px; vertical-align: top">

        <table width="45" height="25" cellpadding="0" cellspacing="0">
            <tr>
                <td class="fonte2_negrito" align="center" bgcolor="#666"><?=$i?></td>
            </tr>
        </table>

		</td>
		<td style="padding-top: 5px"><img style="margin-top:-2px;position:absolute;margin-left:4px;" width="20" height="20" src="figuras/times_pequenos/<?=$r['ID']?>.png" /> <span style="margin-left:28px;"> <a href="time.php?id=<?=$r['ID']?>"> <strong><?=$r['Time']?></strong> </a></span>
</td>
		<td style="padding-top: 5px"><img style="margin-left:15px;" src="figuras/titulos/<?=$r['Campeonato_FC_Titulos']?>.png"></td>
		<td style="padding-top: 5px"><img src="figuras/titulos/<?=$r['Campeonato_FC_Vices']?>.png"></td>
	</tr>
<? 
$i++;
} ?>
</table>
</div>

</div>
<div class="camp2">

<div id="linha6">

<table width="550" cellpadding="0" cellspacing="0">



	<tr height="25" bgcolor="#B6B6B6">
		<td width="55">&nbsp;</td>
        <td width="200" style="padding-left: 31px" class="fonte1_negrito">Time</td>
		<td width="200" class="fonte1_negrito">Campe&atilde;o</td>
		<td width="95" class="fonte1_negrito">Vice</td>
	</tr>
<?
	  $res=mysql_query("select * from Times order by Copa_Brasil_Titulos desc, Copa_Brasil_Vices desc limit 0,20");
	  $i=1;
	  while($r=mysql_fetch_array($res)){
?>	<tr>
    	<td style="padding-top: 5px; vertical-align: top">

        <table width="45" height="25" cellpadding="0" cellspacing="0">
            <tr>
                <td class="fonte2_negrito" align="center" bgcolor="#666"><?=$i?></td>
            </tr>
        </table>

		</td>
		<td style="padding-top: 5px"><img style="margin-top:-2px;position:absolute;margin-left:4px;" width="20" height="20" src="figuras/times_pequenos/<?=$r['ID']?>.png" /> <span style="margin-left:28px;"> <a href="time.php?id=<?=$r['ID']?>"> <strong><?=$r['Time']?></strong> </a></span>
</td>
		<td style="padding-top: 5px"><img style="margin-left:15px;" src="figuras/titulos/<?=$r['Copa_Brasil_Titulos']?>.png"></td>
		<td style="padding-top: 5px"><img src="figuras/titulos/<?=$r['Copa_Brasil_Vices']?>.png"></td>
	</tr>
<? 
$i++;
} ?>
</table>
</div>


</div>
<div class="camp3">

<div id="linha6">

<table width="550" cellpadding="0" cellspacing="0">



	<tr height="25" bgcolor="#B6B6B6">
		<td width="55">&nbsp;</td>
        <td width="200" style="padding-left: 31px" class="fonte1_negrito">Time</td>
		<td width="200" class="fonte1_negrito">Campe&atilde;o</td>
		<td width="95" class="fonte1_negrito">Vice</td>
	</tr>
<?
	  $res=mysql_query("select * from Times order by Copa_FC_Titulos desc, Copa_FC_Vices desc limit 0,20");
	  $i=1;
	  while($r=mysql_fetch_array($res)){
?>	<tr>
    	<td style="padding-top: 5px; vertical-align: top">

        <table width="45" height="25" cellpadding="0" cellspacing="0">
            <tr>
                <td class="fonte2_negrito" align="center" bgcolor="#666"><?=$i?></td>
            </tr>
        </table>

		</td>
		<td style="padding-top: 5px"><img style="margin-top:-2px;position:absolute;margin-left:4px;" width="20" height="20" src="figuras/times_pequenos/<?=$r['ID']?>.png" /> <span style="margin-left:28px;"> <a href="time.php?id=<?=$r['ID']?>"> <strong><?=$r['Time']?></strong> </a></span>
</td>
		<td style="padding-top: 5px"><img style="margin-left:15px;" src="figuras/titulos/<?=$r['Copa_FC_Titulos']?>.png"></td>
		<td style="padding-top: 5px"><img src="figuras/titulos/<?=$r['Copa_FC_Vices']?>.png"></td>
	</tr>
<? 
$i++;
} ?>
</table>
</div>

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