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
<?php
function TimeID($id){
	$r=mysql_fetch_array(mysql_query("select * from Times where ID2='".$id."'"));
	return $r['ID'];
}
function CPNome($id){
	$r=mysql_fetch_array(mysql_query("select * from Times where ID2='".$id."'"));
	return $r['Time'];
}
$rod=mysql_fetch_array(mysql_query("select Temporada from Configuracoes"));
$temp=$rod['Temporada'];
$temporada=$temp;
$seltemporada = intval($temp);
if (isset($_POST["ctemporada"])) $seltemporada = intval($_POST["ctemporada"]);
if ($seltemporada < 1) $seltemporada = 1;
$r=mysql_fetch_array(mysql_query("select * from Campeoes where Temporada={$seltemporada}"));
?>
<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Temporada</h1></div></div></div>
	<div class="conteudo">
<br><br>
<form method="post" action="">
  <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td width="4%">&nbsp;</td>
      <td width="62%">
          <select name="ctemporada" onchange="this.form.submit();" style="width:500px; height:40px;">
<? for($i=1;$i<=$temporada;$i++) { ?>
          <option <? if ($i == $seltemporada) echo "selected "; ?>value="<?=$i;?>"><?=$i;?>ª temporada</option>
<? } ?>
          </select>
      </td>
      <td width="34%">&nbsp;</td>
    </tr>
  </table>
  </form> 
<br>
	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>
<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio">
	  <h1>Campeões do Brasileir&atilde;o <?=$seltemporada;?> &ordf; temporada</h1></div></div></div>
	<div class="conteudo">
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr height="21">
    <td colspan="4" height="21"></td>
    </tr>
  <tr>
    <td width="25%" align="center" class="normalfont">1&ordf; divis&atilde;o</td>
    <td width="25%" align="center" class="normalfont">2&ordf; divis&atilde;o</td>
    <td width="25%" align="center" class="normalfont">3&ordf; divis&atilde;o</td>
  </tr>
  <tr height="11">
    <td colspan="4" height="11"></td>
    </tr>
  <tr>
    <td align="center" valign="middle" class="normalfont">
	<? $br=mysql_query("select * from Campeoes where Serie='A' and Campeonato='Brasileirao' and Temporada={$seltemporada} ORDER BY Posicao");
	   $mnr=mysql_num_rows($br);
       while($rs=mysql_fetch_array($br)){
		   $Time1=$rs['Time'];
	   if($rs=mysql_fetch_array($br)){
		   $Time2=$rs['Time'];
	   }
	   }
	   $br1=mysql_query("select * from Campeoes where Serie='B' and Campeonato='Brasileirao' and Temporada={$seltemporada} ORDER BY Posicao");
	   $mnr1=mysql_num_rows($br1);
       while($rs=mysql_fetch_array($br1)){
		   $bTime1=$rs['Time'];
	   if($rs=mysql_fetch_array($br1)){
		   $bTime2=$rs['Time'];
	   }
	   }
	   $br2=mysql_query("select * from Campeoes where Serie='C' and Campeonato='Brasileirao' and Temporada={$seltemporada} ORDER BY Posicao");
	   $mnr2=mysql_num_rows($br2);
       while($rs=mysql_fetch_array($br2)){
		   $cTime1=$rs['Time'];
	   if($rs=mysql_fetch_array($br2)){
		   $cTime2=$rs['Time'];
	   }
	   }
	   $br3=mysql_query("select * from Campeoes where Serie='D' and Campeonato='Brasileirao' and Temporada={$seltemporada} ORDER BY Posicao");
	   $mnr3=mysql_num_rows($br3);
       while($rs=mysql_fetch_array($br3)){
		   $dTime1=$rs['Time'];
	   if($rs=mysql_fetch_array($br3)){
		   $dTime2=$rs['Time'];
	   }
	   }


    ?>

	
	<? if($mnr>0){ ?><img width="60" height="60" src="figuras/times_grandes/<?=TimeID($Time1)?>.png"><? }else{ ?><img src="figuras/times_grandes/descon.gif"><? } ?></td>
    <td align="center" valign="middle"><? if($mnr1>0){ ?><img width="60" height="60" src="figuras/times_grandes/<?=TimeID($bTime1)?>.png"><? }else{ ?><img src="figuras/times_grandes/descon.gif"><? } ?></td>
    <td align="center" valign="middle"><? if($mnr2>0){ ?><img width="60" height="60" src="figuras/times_grandes/<?=TimeID($cTime1)?>.png"><? }else{ ?><img src="figuras/times_grandes/descon.gif"><? } ?></td>
  </tr>
  <tr height="8">
    <td colspan="4" align="center" valign="middle" height="8"></td>
  </tr>
  <tr>
    <td align="center" valign="middle" class="normalfont"><? if($mnr>0){ ?><?=CPNome($Time1)?><? }else{}?></td>
    <td align="center" valign="middle" class="normalfont"><? if($mnr>0){ ?><?=CPNome($bTime1)?><? }else{}?></td>
    <td align="center" valign="middle" class="normalfont"><? if($mnr>0){ ?><?=CPNome($cTime1)?><? }else{}?></td>
  </tr>
  <tr>
    <td align="center" valign="middle" class="normalfont">&nbsp;</td>
    <td align="center" valign="middle" class="normalfont">&nbsp;</td>
    <td align="center" valign="middle" class="normalfont">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" valign="middle" class="normalfont"><? if($mnr>0){ ?>
      <img width="60" height="60" src="figuras/times_grandes/<?=TimeID($Time2)?>.png">
      <? }else{ ?>
      <img src="figuras/times_grandes/descon.gif">
      <? } ?></td>
    <td align="center" valign="middle" class="normalfont"><? if($mnr1>0){ ?>
      <img width="60" height="60" src="figuras/times_grandes/<?=TimeID($bTime2)?>.png">
      <? }else{ ?>
      <img src="figuras/times_grandes/descon.gif">
      <? } ?></td>
    <td align="center" valign="middle" class="normalfont"><? if($mnr2>0){ ?>
      <img width="60" height="60" src="figuras/times_grandes/<?=TimeID($cTime2)?>.png">
      <? }else{ ?>
      <img src="figuras/times_grandes/descon.gif">
      <? } ?></td>
  </tr>
  <tr>
    <td align="center" valign="middle" class="normalfont"><? if($mnr>0){ ?>
      <?=CPNome($Time2)?>
      <? }else{}?></td>
    <td align="center" valign="middle" class="normalfont"><? if($mnr>0){ ?>
      <?=CPNome($bTime2)?>
      <? }else{}?></td>
    <td align="center" valign="middle" class="normalfont"><? if($mnr>0){ ?>
      <?=CPNome($cTime2)?>
      <? }else{}?></td>
  </tr>
  
</table>
	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>
<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio">
	  <h1>Campeão da Copa do Brasil <?=$seltemporada;?> &ordf; temporada</h1></div></div></div>
	<div class="conteudo">
    
    <?
	$br=mysql_query("select * from Campeoes where Campeonato='Copadobrasil' and Temporada={$seltemporada} ORDER BY Posicao");
	   $mnr=mysql_num_rows($br);
       while($rs=mysql_fetch_array($br)){
		   $Time1=$rs['Time'];
	   }
	?>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr height="21">
    <td height="21"></td>
  </tr>
  <tr>
    <td align="center" valign="middle"><? if($mnr>0){ ?><img width="60" height="60" src="figuras/times_grandes/<?=TimeID($Time1)?>.png"><? }else{ ?><img src="figuras/times_grandes/descon.gif"><? } ?></td>
    </tr>
  <tr height="8">
    <td align="center" valign="middle" height="8"></td>
  </tr>
  <tr>
    <td align="center" valign="middle" class="normalfont"><? if($mnr>0){ ?><?=CPNome($Time1)?><? }else{}?></td>
    </tr>
</table>
	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>
<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Campeão da COPA LC <?=$seltemporada;?> &ordf; temporada</h1></div></div></div>
	<div class="conteudo">
       <?
	$br=mysql_query("select * from Campeoes where Campeonato='Copalc' and Temporada={$seltemporada} ORDER BY Posicao");
	   $mnr=mysql_num_rows($br);
       while($rs=mysql_fetch_array($br)){
		   $Time1=$rs['Time'];
	   }
	?>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr height="21">
    <td height="21"></td>
  </tr>
  <tr>
    <td align="center" valign="middle"><? if($mnr>0){ ?><img width="60" height="60" src="figuras/times_grandes/<?=TimeID($Time1)?>.png"><? }else{ ?><img src="figuras/times_grandes/descon.gif"><? } ?></td>
  </tr>
  <tr height="8">
    <td align="center" valign="middle" height="8"></td>
  </tr>
  <tr>
    <td align="center" valign="middle" class="normalfont"><? if($mnr>0){ ?><?=CPNome($Time1)?><? }else{}?></td>
  </tr>
</table>
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