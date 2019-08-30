<?php ob_start(); ?>
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
if(!isset($_COOKIE["usuarioid"])){
	echo'Você não esta logado';
}else{
    include("config/conexao.php");
	require("config/config.php");
	$chat = new Chat();
	$a=mysql_fetch_array(mysql_query("select ID,ID_Cod,Usuario,Nivel,Moderador from Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')"));
	if($a['Moderador'] == 1){
	$nome='<a href=./usuario.php?id='.$a['ID'].'><img src=figuras/niveis/adm.png width=20 height=20  /> '.$a['Usuario'].'</a>';
	}elseif($a['Moderador'] == 2){
	$nome='<a href=./usuario.php?id='.$a['ID'].'><img src=figuras/niveis/mod.png width=20 height=20  /> '.$a['Usuario'].'</a>';
	}elseif($a['Moderador'] == 3){
	$nome='<a href=./usuario.php?id='.$a['ID'].'><img src=figuras/niveis/div.png width=20 height=20  /> '.$a['Usuario'].'</a>';
	}else{
	$nome='<a href=./usuario.php?id='.$a['ID'].'><img src=figuras/niveis/'.$a['Nivel'].'.png width=20 height=20  /> '.$a['Usuario'].'</a>';
	}
	$chat->setNome($nome);
	setcookie('nome', $chat->getNome(), time()+3600*24*TEMPO_LIMITE);
	$chat = new Chat();


?>
<link rel="stylesheet" type="text/css" href="./css/chats.css" />
<script type="text/javascript"	src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js"></script>
<script type="text/javascript"	src="js/chat.js"></script>


<div id="painel">
<?php 
	foreach($chat->listar() as $v){
				$ativo = ($v['nome'] == $_COOKIE['nome']) ? ' class="ativo"' : '';
				printf('<p%s>%s - %s</p>', $ativo, $v['nome'], strip_tags($v['mensagem']));
			}
?>
</div>

<form action="" method="post" id="frm-msg">
	<fieldset>
		<label> 
			<span>Mensagem</span> 
			<textarea name="mensagem" id="mensagem" cols="70" rows="5"></textarea>
		</label> 
		<input type="button" id="submit" value="Enviar" />
	</fieldset>
</form>
<? } ?>

<!-- FIM DA PÁGINA -->
</div>
<div class="clear"></div>

</div>
<div id="baixo"><?php include("baixo.php") ?></div>
</div>
</body>
</html>