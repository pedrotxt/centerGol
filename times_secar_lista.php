<?
$r=mysql_query("select * from Times ORDER BY ID limit 0,60");
?>
<select name="time_secar" style="width: 180px; height: 26px">
<? while($rs=mysql_fetch_array($r)){ ?>
<option value="<?=$rs['ID']?>"><?=$rs['Time']?> - <?=$rs['Estado']?></option>
<? } ?>
</select>
