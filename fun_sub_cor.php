<?php
function sub_cor($string) {
	$string = str_replace("[b]","<b>",$string);
	$string = str_replace("[/b]","</b>",$string);
	$string = str_replace("[i]","<i>",$string);
	$string = str_replace("[/i]","</i>",$string);
	$string = str_replace("[u]","<u>",$string);
	$string = str_replace("[/u]","</u>",$string);
	$string = str_replace("[red]","<font color=red>",$string);
	$string = str_replace("[/red]","</font>",$string);
	$string = str_replace("[blue]","<font color=blue>",$string);
	$string = str_replace("[/blue]","</font>",$string);
	$string = str_replace("[green]","<font color=green>",$string);
	$string = str_replace("[/green]","</font>",$string);
	$string = str_replace("[orange]","<font color=orange>",$string);
	$string = str_replace("[/orange]","</font>",$string);
	$string = str_replace("[navy]","<font color=navy>",$string);
	$string = str_replace("[/navy]","</font>",$string);
	$string = str_replace("[maroon]","<font color=maroon>",$string);
	$string = str_replace("[/maroon]","</font>",$string);
	$string = str_replace("[purple]","<font color=purple>",$string);
	$string = str_replace("[/purple]","</font>",$string);
	$string = str_replace("[pink]","<font color=violet>",$string);
	$string = str_replace("[/pink]","</font>",$string);
	$string = str_replace("\n","<br>",$string);
	return $string;
}
?>