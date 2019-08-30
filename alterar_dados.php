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


<script language="javascript">
function somente_numeros(evt) {

var key_code = evt.keyCode  ? evt.keyCode  :
				evt.charCode ? evt.charCode :
				evt.which    ? evt.which    : void 0;

if (key_code == 8 ||  key_code == 9 ||  key_code == 13 || key_code == 48 ||  key_code == 49 ||  key_code == 50 ||  key_code == 51 ||  key_code == 52 ||  key_code == 53 ||  key_code == 54 ||  key_code == 55 ||  key_code == 56 ||  key_code == 57) { return true; }

return false;

}

function valida_alterar_dados() {

if (document.alterar_dados.valor.value=="") {
	alert("É necessário preencher o valor.");
	document.alterar_dados.valor.focus();
	return false;
}

if (document.alterar_dados.valor.value==0) {
	alert("É necessário preencher um valor maior.");
	document.alterar_dados.valor.focus();
	return false;
}

}
</script>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Alterar Dados</h1></div></div></div>
	<div class="conteudo">

<?php if (anti_inj($_GET["msg_alterar"]) == 1) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_sim.png"></span> Dados alterados com sucesso!</div>

<?php } else if (anti_inj($_GET["msg_alterar"]) == 2) { ?>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/alerta_nao.png"></span> Preencha o valor somente com números!</div>

<?php } ?>

<form name="alterar_dados" method="post" action="alterar_dados_salvar.php" onSubmit="return valida_alterar_dados()">

<div id="linha10">
<span class="fonte_form">Qual o seu sexo?</span>
<span class="align_form">
<select name="sexo" style="width: 100px; height: 26px">
<option value="1" <?php if ($mc_sexo == 1) { ?>selected<?php } ?>>Masculino</option>
<option value="2"<?php if ($mc_sexo == 2) { ?>selected<?php } ?>>Feminino</option>
</select>
</span>
</div>

<div id="linha15">
<span class="fonte_form">Qual o número da sua camisa?</span>
<span class="align_form">
<select name="camisa" style="width: 100px; height: 26px">
<option value="1" <?php if ($mc_camisa == 1) { ?>selected<?php } ?>>1</option>
<option value="2" <?php if ($mc_camisa == 2) { ?>selected<?php } ?>>2</option>
<option value="3" <?php if ($mc_camisa == 3) { ?>selected<?php } ?>>3</option>
<option value="4" <?php if ($mc_camisa == 4) { ?>selected<?php } ?>>4</option>
<option value="5" <?php if ($mc_camisa == 5) { ?>selected<?php } ?>>5</option>
<option value="6" <?php if ($mc_camisa == 6) { ?>selected<?php } ?>>6</option>
<option value="7" <?php if ($mc_camisa == 7) { ?>selected<?php } ?>>7</option>
<option value="8" <?php if ($mc_camisa == 8) { ?>selected<?php } ?>>8</option>
<option value="9" <?php if ($mc_camisa == 9) { ?>selected<?php } ?>>9</option>
<option value="10" <?php if ($mc_camisa == 10) { ?>selected<?php } ?>>10</option>
<option value="11" <?php if ($mc_camisa == 11) { ?>selected<?php } ?>>11</option>
</select>
</span>
</div>

<div id="linha15">
<span class="fonte_form">Quer receber propostas?</span>
<span class="align_form">
<select name="propostas" style="width: 100px; height: 26px">
<option value="1" <?php if ($mc_propostas == 1) { ?>selected<?php } ?>>Sim</option>
<option value="0" <?php if ($mc_propostas == 0) { ?>selected<?php } ?>>Não</option>
</select>
</span>
</div>

<div id="linha15">
<span class="fonte_form">Quer receber desafios?</span>
<span class="align_form">
<select name="desafios" style="width: 100px; height: 26px">
<option value="1" <?php if ($mc_desafios == 1) { ?>selected<?php } ?>>Sim</option>
<option value="0" <?php if ($mc_desafios == 0) { ?>selected<?php } ?>>Não</option>
</select>
</span>
</div>

<div id="linha15">
<span class="fonte_form">Comemoração no automático?</span>
<span class="align_form">
<select name="comemoracao" style="width: 100px; height: 26px">
<option value="1" <?php if ($mc_comemoracao == 1) { ?>selected<?php } ?>>Sim</option>
<option value="0" <?php if ($mc_comemoracao == 0) { ?>selected<?php } ?>>Não</option>
</select>
</span>
</div>

<div id="linha15">
<span class="fonte_form">Som ao marcar o gol?</span>
<span class="align_form">
<select name="som" style="width: 100px; height: 26px">
<option value="1" <?php if ($mc_som == 1) { ?>selected<?php } ?>>Sim</option>
<option value="0" <?php if ($mc_som == 0) { ?>selected<?php } ?>>Não</option>
</select>
</span>
</div>

<div id="linha15"><span class="fonte_form">Qual o valor do seu passe?</span> <span class="align_form"><input name="valor" type="text" maxlength="6" value="<?=$mc_valor?>" style="width: 90px; height: 20px" onKeyPress="return somente_numeros(event);"></span></div>

<div id="linha15"><span class="fonte_form">Qual a sua mensagem pessoal?</span> <span class="align_form"><input name="texto" type="text" maxlength="200" value="<?=$mc_texto?>" style="width: 200px; height: 20px"></span></div>

<div id="linha15"><span class="fonte_form">Qual a sua comemoração?</span> <span class="align_form"><input name="comemoracao_frase" type="text" maxlength="200" value="<?=$mc_comemoracao_frase?>" style="width: 200px; height: 20px"></span></div>

<div id="linha12"><input name="submit" type="image" src="figuras/principal/botao_confirmar.png" onClick="return valida_alterar_dados()"></div>
</form>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<div id="divide"></div>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Outros Dados</h1></div></div></div>
	<div class="conteudo">

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/seta1.png"></span> <a href="alterar_nome.php"><b>Alterar Nome</b></a></div>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/seta1.png"></span> <a href="alterar_avatar.php"><b>Alterar Avatar</b></a></div>

<div id="linha10"><span class="img16"><img width="16" height="16" src="figuras/principal/seta1.png"></span> <a href="alterar_senha.php"><b>Alterar Senha</b></a></div>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>

<div id="divide"></div>

<div class="box">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"><h1>Importante</h1></div></div></div>
	<div class="conteudo">

<div id="linha10">O som do gol só é disparado na página de comemoração.</div>
<div id="linha10">No valor do seu passe, preencha apenas com números.</div>
<div id="linha10">Na comemoração, preencha <b>[eu]</b> para o seu nome e <b>[gol]</b> para o gol marcado.</div>

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