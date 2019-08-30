<? include ('conexao.php');?>

<select name="time" style="width: 180px; height: 26px">
<?
$times=mysql_query("select ID, Time from Times"); 
while($r=mysql_fetch_array($times)){
?>
<option value="<?=$r['ID']?>"><?=$r['Time']?></option>
<? } ?>
</select>