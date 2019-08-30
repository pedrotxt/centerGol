<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>jQuery UI Dialog - Modal message</title>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script>
$(function() {
$( "#dialog-message" ).dialog({
modal: true,
buttons: {
Ok: function() {
$( this ).dialog( "close" );
}
}
});
});
</script>
</head>
<body>
<div id="dialog-message" title="Download complete">
<p>
<span class="ui-icon ui-icon-circle-check" style="float:left; margin:0 7px 50px 0;"></span>
Your files have downloaded successfully into the My Downloads folder.
</p>
<p>
Currently using <b>36% of your storage space</b>.
</p>
</div>
</body>
</html>