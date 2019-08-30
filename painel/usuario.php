<?php include("fun_anti_inj.php") ?>
<?php include("conexao.php") ?>
<?php include("verificar_conexao.php") ?>
<?php
$id = anti_inj($_GET['id']);

if (!$id) {
	header("Location: usuarios.php"); break;
}

if (ereg('[^0-9]',$id)) {
	header("Location: usuarios.php"); break;
}

if ($id < 1) {
	header("Location: usuarios.php"); break;
}
?>
<html>
<?php include("head.php") ?>
<script language="javascript" src="../js/principal.js"></script>
<script language="javascript">
function valida_usuario()
{
if (document.usuario.email.value==""){
alert("É necessário preencher o email.");
document.usuario.email.focus();
return false; }

var email=document.usuario.email.value;

if (email.indexOf("@")==-1){
alert("É necessário preencher o email corretamente.");
document.usuario.email.focus();
return false; }

var sufxemail=email.substring(email.indexOf("@"));

if (email.length<9 || email.indexOf(",")>-1 || email.indexOf("'")>-1 || email.indexOf(" ")>-1 || sufxemail.length<6 || sufxemail.indexOf(".")==-1){
alert("É necessário preencher o email corretamente.");
document.usuario.email.focus();
return false; }

if (document.usuario.usuario.value==""){
alert("É necessário preencher o usuário.");
document.usuario.usuario.focus();
return false; }

if (document.usuario.usuario.value.length<2){
alert("É necessário preencher um usuário maior.");
document.usuario.usuario.focus();
return false; }
}
function verificaremail()
{
	verificar_email("usuario_verificar_email.php?email="+document.usuario.email.value);
}
function verificarusuario()
{
	verificar_usuario("usuario_verificar_usuario.php?usuario="+document.usuario.usuario.value);
}
</script>
<body>
<center>
<table width="770" cellpadding="0" cellspacing="0">
	<tr>
		<td id="cima" colspan="2"><?php include("cima.php") ?></td>
	</tr>
	<tr>
		<td id="menu" align="right"><?php include("menu.php") ?></td>
		<td id="principal" align="center">
<?php
$query = mysql_query("SELECT Email, Usuario, Nivel, Sexo, Time, Secar, Dinheiro, Camisa, Banido, Desafios, Propostas, Som, Comemoracao, Trocas, Sorte, Valor, Rescisao, Rescisao_Dias, Rescisao_Dias_VIP, Acessos, Texto, VIP, Presidente_Dias, Gols_Hora, Gols_Hora_Record, Gols_Rodada, Gols_Rodada_Record, Gols_Temporada, Gols_Temporada_Record, Gols_Total, Gols_Time, Passe_Certo, Passe_Certo_Acertos, Penalti, Penalti_Acertos, Status, IP, Cadastro, Ultimo_Acesso, Item_Sorte, Item_Pedra, Item_Energia, Item_Sacola, Item_Veneno, Item_Escudo, Moderador, Fidelidade, Clone FROM Usuarios WHERE ID = '". $id ."'");
$rs = mysql_fetch_array($query);

if (!$rs) {
	header("Location: usuarios.php"); break;
}

$usuario_email = $rs["Email"];
$usuario_nome = $rs["Usuario"];
$usuario_nivel = $rs["Nivel"];
$usuario_sexo = $rs["Sexo"];
$usuario_time = $rs["Time"];
$usuario_time_secar = $rs["Secar"];
$usuario_dinheiro = $rs["Dinheiro"];
$usuario_camisa = $rs["Camisa"];
$usuario_banido = $rs["Banido"];
$usuario_propostas = $rs["Propostas"];
$usuario_som = $rs["Som"];
$usuario_comemoracao = $rs["Comemoracao"];
$usuario_desafios = $rs["Desafios"];
$usuario_trocas = $rs["Trocas"];
$usuario_sorte = $rs["Sorte"];
$usuario_valor = $rs["Valor"];
$usuario_rescisao = $rs["Rescisao"];
$usuario_rescisao_dias = $rs["Rescisao_Dias"];
$usuario_rescisao_dias_vip = $rs["Rescisao_Dias_VIP"];
$usuario_acessos = $rs["Acessos"];
$usuario_texto = $rs["Texto"];
$usuario_vip = $rs["VIP"];
$usuario_presidente_dias = $rs["Presidente_Dias"];
$usuario_gols_hora = $rs["Gols_Hora"];
$usuario_gols_hora_record = $rs["Gols_Hora_Record"];
$usuario_gols_rodada = $rs["Gols_Rodada"];
$usuario_gols_rodada_record = $rs["Gols_Rodada_Record"];
$usuario_gols_temporada = $rs["Gols_Temporada"];
$usuario_gols_temporada_record = $rs["Gols_Temporada_Record"];
$usuario_gols_total = $rs["Gols_Total"];
$usuario_gols_time = $rs["Gols_Time"];
$usuario_passe_certo = $rs["Passe_Certo"];
$usuario_passe_certo_acertos = $rs["Passe_Certo_Acertos"];
$usuario_penalti = $rs["Penalti"];
$usuario_penalti_acertos = $rs["Penalti_Acertos"];
$usuario_status = $rs["Status"];
$usuario_ip = $rs["IP"];
$usuario_cadastro = $rs["Cadastro"];
$usuario_ultimo_acesso = $rs["Ultimo_Acesso"];
$usuario_item_energia = $rs["Item_Energia"];
$usuario_item_sacola = $rs["Item_Sacola"];
$usuario_item_veneno = $rs["Item_Veneno"];
$usuario_item_escudo = $rs["Item_Escudo"];
$usuario_item_pedra = $rs["Item_Pedra"];
$usuario_item_sorte = $rs["Item_Sorte"];
$usuario_moderador = $rs["Moderador"];
$usuario_fidelidade = $rs["Fidelidade"];
$usuario_clone = $rs["Clone"];
?>
<form name="usuario" method="post" action="usuario_salvar.php?id=<?=$id?>" onSubmit="return valida_usuario()">
<table id="tabela" width="426" cellpadding="0" cellspacing="0">
	<tr>
		<td class="fonte_titulo1">Usuário</td>
	</tr>
<?php if (anti_inj($_GET["msg"]) == 1) { ?>
	<tr>
		<td align="center" style="padding-top: 15; padding-bottom: 5">

<table width="200" cellpadding="0" cellspacing="0">
	<tr>
		<td width="20"><img src="../figuras/painel/alerta_sim.png"></td>
		<td class="fonte1">Usuário alterado com sucesso!</td>
	</tr>
</table>

		</td>
	</tr>
<?php } ?>
<?php if (anti_inj($_GET["msg"]) == 2) { ?>
	<tr>
		<td align="center" style="padding-top: 15; padding-bottom: 5">

<table width="115" cellpadding="0" cellspacing="0">
	<tr>
		<td width="20"><img src="../figuras/painel/alerta_nao.png"></td>
		<td class="fonte1">Houve um erro!</td>
	</tr>
</table>

		</td>
	</tr>
<?php } ?>
<?php if (anti_inj($_GET["msg"]) == 3) { ?>
	<tr>
		<td align="center" style="padding-top: 15; padding-bottom: 5">

<table width="207" cellpadding="0" cellspacing="0">
	<tr>
		<td width="20"><img src="../figuras/painel/alerta_nao.png"></td>
		<td class="fonte1">Esse email não pode ser usado!</td>
	</tr>
</table>

		</td>
	</tr>
<?php } ?>
<?php if (anti_inj($_GET["msg"]) == 4) { ?>
	<tr>
		<td align="center" style="padding-top: 15; padding-bottom: 5">

<table width="207" cellpadding="0" cellspacing="0">
	<tr>
		<td width="20"><img src="../figuras/painel/alerta_nao.png"></td>
		<td class="fonte1">Esse nome não pode ser usado!</td>
	</tr>
</table>

		</td>
	</tr>
<?php } ?>
	<tr>
		<td align="center" style="padding-top: 10; padding-bottom: 10">
<table width="250" cellpadding="0" cellspacing="0">
	<tr>
		<td width="80" class="fonte1">Email:</td>
		<td width="130"><input name="email" type="text" class="fonte1" size="22" maxlength="50" value="<?=$usuario_email?>"></td>
		<td width="40"><a href="#" onClick="javascript:verificaremail();"><img src="../figuras/painel/verificar.png" border="0" title="Verificar Email" alt="Verificar Email"></a></td>
	</tr>
	<tr>
		<td colspan="3" class="fonte1" style="padding-top: 8"><div id="verificar_email"></div></td>
	</tr>
	<tr>
		<td class="fonte1" style="padding-top: 10">Senha:</td>
		<td colspan="2" style="padding-top: 10"><input name="senha" type="password" class="fonte1" size="22" maxlength="12"></td>
	</tr>
	<tr>
		<td colspan="3" class="fonte1" style="padding-top: 8">(deixe em branco para manter a senha atual)</td>
	</tr>
	<tr>
		<td class="fonte1" style="padding-top: 10">Nome:</td>
		<td style="padding-top: 10"><input name="usuario" type="text" class="fonte1" size="22" maxlength="15" value="<?=$usuario_nome?>"></td>
        <td width="40"><a href="#" onClick="javascript:verificarusuario();"><img src="../figuras/painel/verificar.png" border="0" title="Verificar Usuário" alt="Verificar Usuário"></a></td>
	</tr>
	<tr>
		<td colspan="3" class="fonte1" style="padding-top: 8"><div id="verificar_usuario"></div></td>
	</tr>
	<tr>
		<td class="fonte1" style="padding-top: 10">Nível:</td>
		<td colspan="2" style="padding-top: 10"><input name="nivel" type="text" class="fonte1" size="22" maxlength="4" value="<?=$usuario_nivel?>"></td>
	</tr>
	<tr>
		<td class="fonte1" style="padding-top: 10">Sexo:</td>
		<td colspan="2" style="padding-top: 10"><select name="sexo" size="1" class="fonte1">
<option value="1" <?php if ($usuario_sexo == 1) { ?>selected<?php } ?>>Masculino</option>
<option value="2" <?php if ($usuario_sexo == 2) { ?>selected<?php } ?>>Feminino</option>
</select></td>
	</tr>
	<tr>
		<td class="fonte1" style="padding-top: 10">Time:</td>
		<td colspan="2" style="padding-top: 10"><?php include("times_lista.php") ?></td>
	</tr>
	<tr>
		<td class="fonte1" style="padding-top: 10">Secar:</td>
		<td colspan="2" style="padding-top: 10"><?php include("times_secar_lista.php") ?></td>
	</tr>
<?php if ($mc_cargo == 1) { ?>
	<tr>
		<td class="fonte1" style="padding-top: 10">Dinheiro:</td>
		<td colspan="2" style="padding-top: 10"><input name="dinheiro" type="text" class="fonte1" size="22" maxlength="50" value="<?=$usuario_dinheiro?>"></td>
	</tr>
<?php } ?>
	<tr>
		<td class="fonte1" style="padding-top: 10">Camisa:</td>
		<td colspan="2" style="padding-top: 10"><select name="camisa" size="1" class="fonte1">
<option value="1" <?php if ($usuario_camisa == 1) { ?>selected<?php } ?>>1</option>
<option value="2" <?php if ($usuario_camisa == 2) { ?>selected<?php } ?>>2</option>
<option value="3" <?php if ($usuario_camisa == 3) { ?>selected<?php } ?>>3</option>
<option value="4" <?php if ($usuario_camisa == 4) { ?>selected<?php } ?>>4</option>
<option value="5" <?php if ($usuario_camisa == 5) { ?>selected<?php } ?>>5</option>
<option value="6" <?php if ($usuario_camisa == 6) { ?>selected<?php } ?>>6</option>
<option value="7" <?php if ($usuario_camisa == 7) { ?>selected<?php } ?>>7</option>
<option value="8" <?php if ($usuario_camisa == 8) { ?>selected<?php } ?>>8</option>
<option value="9" <?php if ($usuario_camisa == 9) { ?>selected<?php } ?>>9</option>
<option value="10" <?php if ($usuario_camisa == 10) { ?>selected<?php } ?>>10</option>
<option value="11" <?php if ($usuario_camisa == 11) { ?>selected<?php } ?>>11</option>
</select></td>
	</tr>
<?php if ($mc_cargo == 1) { ?>
	<tr>
		<td class="fonte1" style="padding-top: 10">Moderador:</td>
		<td colspan="2" style="padding-top: 10"><select name="moderador" size="1" class="fonte1">
<option value="0" <?php if ($usuario_moderador == 0) { ?>selected<?php } ?>>Normal</option>
<option value="1" <?php if ($usuario_moderador == 1) { ?>selected<?php } ?>>Administrador</option>
<option value="2" <?php if ($usuario_moderador == 2) { ?>selected<?php } ?>>Moderador</option>
<option value="3" <?php if ($usuario_moderador == 3) { ?>selected<?php } ?>>Divulgador</option>
</select></td>
	</tr>
<?php } ?>
	<tr>
		<td class="fonte1" style="padding-top: 10">Clone:</td>
		<td colspan="2" style="padding-top: 10"><select name="clone" size="1" class="fonte1">
<option value="1" <?php if ($usuario_clone == 1) { ?>selected<?php } ?>>Sim</option>
<option value="0" <?php if ($usuario_clone == 0) { ?>selected<?php } ?>>Não</option>
</select></td>
	</tr>
	<tr>
		<td class="fonte1" style="padding-top: 10">Banido:</td>
		<td colspan="2" style="padding-top: 10"><select name="banido" size="1" class="fonte1">
<option value="1" <?php if ($usuario_banido == 1) { ?>selected<?php } ?>>Sim</option>
<option value="0" <?php if ($usuario_banido == 0) { ?>selected<?php } ?>>Não</option>
</select></td>
	</tr>
	<tr>
		<td class="fonte1" style="padding-top: 10">Propostas:</td>
		<td colspan="2" style="padding-top: 10"><select name="propostas" size="1" class="fonte1">
<option value="1" <?php if ($usuario_propostas == 1) { ?>selected<?php } ?>>Sim</option>
<option value="0" <?php if ($usuario_propostas == 0) { ?>selected<?php } ?>>Não</option>
</select></td>
	</tr>
	<tr>
		<td class="fonte1" style="padding-top: 10">Som:</td>
		<td colspan="2" style="padding-top: 10"><select name="som" size="1" class="fonte1">
<option value="1" <?php if ($usuario_som == 1) { ?>selected<?php } ?>>Sim</option>
<option value="0" <?php if ($usuario_som == 0) { ?>selected<?php } ?>>Não</option>
</select></td>
	</tr>
	<tr>
		<td class="fonte1" style="padding-top: 10">Comemoração:</td>
		<td colspan="2" style="padding-top: 10"><select name="comemoracao" size="1" class="fonte1">
<option value="1" <?php if ($usuario_comemoracao == 1) { ?>selected<?php } ?>>Sim</option>
<option value="0" <?php if ($usuario_comemoracao == 0) { ?>selected<?php } ?>>Não</option>
</select></td>
	</tr>
	<tr>
		<td class="fonte1" style="padding-top: 10">Desafios:</td>
		<td colspan="2" style="padding-top: 10"><select name="desafios" size="1" class="fonte1">
<option value="1" <?php if ($usuario_desafios == 1) { ?>selected<?php } ?>>Sim</option>
<option value="0" <?php if ($usuario_desafios == 0) { ?>selected<?php } ?>>Não</option>
</select></td>
	</tr>
	<tr>
		<td class="fonte1" style="padding-top: 10">Trocas:</td>
		<td colspan="2" style="padding-top: 10"><input name="trocas" type="text" class="fonte1" size="22" maxlength="50" value="<?=$usuario_trocas?>"></td>
	</tr>
	<tr>
		<td class="fonte1" style="padding-top: 10">Sorte:</td>
		<td colspan="2" style="padding-top: 10"><input name="sorte" type="text" class="fonte1" size="22" maxlength="50" value="<?=$usuario_sorte?>"></td>
	</tr>
	<tr>
		<td class="fonte1" style="padding-top: 10">Valor:</td>
		<td colspan="2" style="padding-top: 10"><input name="valor" type="text" class="fonte1" size="22" maxlength="50" value="<?=$usuario_valor?>"></td>
	</tr>
	<tr>
		<td class="fonte1" style="padding-top: 10">Rescisão:</td>
		<td colspan="2" style="padding-top: 10"><input name="rescisao" type="text" class="fonte1" size="22" maxlength="50" value="<?=$usuario_rescisao?>"></td>
	</tr>
	<tr>
		<td class="fonte1" style="padding-top: 10">Rescisão Dias:</td>
		<td colspan="2" style="padding-top: 10"><input name="rescisao_dias" type="text" class="fonte1" size="22" maxlength="50" value="<?=$usuario_rescisao_dias?>"></td>
	</tr>
	<tr>
		<td class="fonte1" style="padding-top: 10">Rescisão VIP:</td>
		<td colspan="2" style="padding-top: 10"><input name="rescisao_dias_vip" type="text" class="fonte1" size="22" maxlength="50" value="<?=$usuario_rescisao_dias_vip?>"></td>
	</tr>
	<tr>
		<td class="fonte1" style="padding-top: 10">Acessos:</td>
		<td colspan="2" style="padding-top: 10"><input name="acessos" type="text" class="fonte1" size="22" maxlength="50" value="<?=$usuario_acessos?>"></td>
	</tr>
	<tr>
		<td colspan="3" style="padding-top: 10"><textarea name="texto" cols="29" rows="4" class="fonte1" onKeyDown="limite_texto(this, this.form.contador, 200);" onKeyUp="limite_texto(this, this.form.contador, 200);"><?=$usuario_texto?></textarea> <input name="contador" class="fonte1" size="3" value="200" disabled></td>
	</tr>
<?php if ($mc_cargo == 1) { ?>
	<tr>
		<td colspan="3" class="fonte1_negrito" style="padding-top: 15">Vantagens:</td>
	</tr>
	<tr>
		<td class="fonte1" style="padding-top: 10">VIP:</td>
		<td colspan="2" style="padding-top: 10"><input name="vip" type="text" class="fonte1" size="22" maxlength="4" value="<?=$usuario_vip?>"></td>
	</tr>
	<tr>
		<td class="fonte1" style="padding-top: 10">Presidente Dias:</td>
		<td colspan="2" style="padding-top: 10"><input name="presidente_dias" type="text" class="fonte1" size="22" maxlength="4" value="<?=$usuario_presidente_dias?>"></td>
	</tr>
	<tr>
		<td class="fonte1" style="padding-top: 10">Fidelidade:</td>
		<td colspan="2" style="padding-top: 10"><input name="fidelidade" type="text" class="fonte1" size="22" maxlength="5" value="<?=$usuario_fidelidade?>"></td>
	</tr>
	<tr>
		<td colspan="3" class="fonte1_negrito" style="padding-top: 15">Ítens:</td>
	</tr>
	<tr>
		<td class="fonte1" style="padding-top: 10">Sorte:</td>
		<td colspan="2" style="padding-top: 10"><input name="item_sorte" type="text" class="fonte1" size="22" maxlength="3" value="<?=$usuario_item_sorte?>"></td>
	</tr>
	<tr>
		<td class="fonte1" style="padding-top: 10">Pedra:</td>
		<td colspan="2" style="padding-top: 10"><input name="item_pedra" type="text" class="fonte1" size="22" maxlength="3" value="<?=$usuario_item_pedra?>"></td>
	</tr>
	<tr>
		<td class="fonte1" style="padding-top: 10">Energia:</td>
		<td colspan="2" style="padding-top: 10"><input name="item_energia" type="text" class="fonte1" size="22" maxlength="3" value="<?=$usuario_item_energia?>"></td>
	</tr>
	<tr>
		<td class="fonte1" style="padding-top: 10">Sacola:</td>
		<td colspan="2" style="padding-top: 10"><input name="item_sacola" type="text" class="fonte1" size="22" maxlength="3" value="<?=$usuario_item_sacola?>"></td>
	</tr>
	<tr>
		<td class="fonte1" style="padding-top: 10">Veneno:</td>
		<td colspan="2" style="padding-top: 10"><input name="item_veneno" type="text" class="fonte1" size="22" maxlength="3" value="<?=$usuario_item_veneno?>"></td>
	</tr>
	<tr>
		<td class="fonte1" style="padding-top: 10">Escudo:</td>
		<td colspan="2" style="padding-top: 10"><input name="item_escudo" type="text" class="fonte1" size="22" maxlength="3" value="<?=$usuario_item_escudo?>"></td>
	</tr>
	<tr>
		<td colspan="3" class="fonte1_negrito" style="padding-top: 15">Gols:</td>
	</tr>
	<tr>
		<td class="fonte1" style="padding-top: 10">Hora:</td>
		<td colspan="2" style="padding-top: 10"><input name="gols_hora" type="text" class="fonte1" size="22" maxlength="10" value="<?=$usuario_gols_hora?>"></td>
	</tr>
	<tr>
		<td class="fonte1" style="padding-top: 10">Hora Record:</td>
		<td colspan="2" style="padding-top: 10"><input name="gols_hora_record" type="text" class="fonte1" size="22" maxlength="10" value="<?=$usuario_gols_hora_record?>"></td>
	</tr>
	<tr>
		<td class="fonte1" style="padding-top: 10">Rodada:</td>
		<td colspan="2" style="padding-top: 10"><input name="gols_rodada" type="text" class="fonte1" size="22" maxlength="10" value="<?=$usuario_gols_rodada?>"></td>
	</tr>
	<tr>
		<td class="fonte1" style="padding-top: 10">Rodada Record:</td>
		<td colspan="2" style="padding-top: 10"><input name="gols_rodada_record" type="text" class="fonte1" size="22" maxlength="10" value="<?=$usuario_gols_rodada_record?>"></td>
	</tr>
	<tr>
		<td class="fonte1" style="padding-top: 10">Temporada:</td>
		<td colspan="2" style="padding-top: 10"><input name="gols_temporada" type="text" class="fonte1" size="22" maxlength="10" value="<?=$usuario_gols_temporada?>"></td>
	</tr>
	<tr>
		<td class="fonte1" style="padding-top: 10">Temporada Record:</td>
		<td colspan="2" style="padding-top: 10"><input name="gols_temporada_record" type="text" class="fonte1" size="22" maxlength="10" value="<?=$usuario_gols_temporada_record?>"></td>
	</tr>
	<tr>
		<td class="fonte1" style="padding-top: 10">Total:</td>
		<td colspan="2" style="padding-top: 10"><input name="gols_total" type="text" class="fonte1" size="22" maxlength="10" value="<?=$usuario_gols_total?>"></td>
	</tr>
	<tr>
		<td class="fonte1" style="padding-top: 10">Gols Time:</td>
		<td colspan="2" style="padding-top: 10"><input name="gols_time" type="text" class="fonte1" size="22" maxlength="10" value="<?=$usuario_gols_time?>"></td>
	</tr>
	<tr>
		<td colspan="3" class="fonte1_negrito" style="padding-top: 15">Jogos:</td>
	</tr>
	<tr>
		<td class="fonte1" style="padding-top: 10">Passe Certo:</td>
		<td colspan="2" class="fonte1" style="padding-top: 10"><input name="passe_certo_acertos" type="text" class="fonte1" size="6" maxlength="10" value="<?=$usuario_passe_certo_acertos?>"> de <input name="passe_certo" type="text" class="fonte1" size="6" maxlength="10" value="<?=$usuario_passe_certo?>"></td>
	</tr>
	<tr>
		<td class="fonte1" style="padding-top: 10">Penalti:</td>
		<td colspan="2" class="fonte1" style="padding-top: 10"><input name="penalti_acertos" type="text" class="fonte1" size="6" maxlength="10" value="<?=$usuario_penalti_acertos?>"> de <input name="penalti" type="text" class="fonte1" size="6" maxlength="10" value="<?=$usuario_penalti?>"></td>
	</tr>
<?php } ?>
	<tr>
		<td colspan="3" class="fonte1_negrito" style="padding-top: 15">Informações:</td>
	</tr>
	<tr>
		<td class="fonte1" style="padding-top: 10">Status:</td>
		<td colspan="2" style="padding-top: 10"><select name="usuario_status" size="1" class="fonte1">
<option value="1" <?php if ($usuario_status == 1) { ?>selected<?php } ?>>Online</option>
<option value="0" <?php if ($usuario_status == 0) { ?>selected<?php } ?>>Offline</option>
</select></td>
	</tr>
	<tr>
		<td class="fonte1" style="padding-top: 10">IP:</td>
		<td colspan="2" class="fonte1" style="padding-top: 10"><input name="ip" type="text" class="fonte1" size="22" maxlength="50" value="<?=$usuario_ip?>"></td>
	</tr>
	<tr>
		<td class="fonte1" style="padding-top: 10">Cadastro:</td>
		<td colspan="2" class="fonte1" style="padding-top: 10"><input name="cadastro" type="text" class="fonte1" size="22" maxlength="50" value="<?=$usuario_cadastro?>"></td>
	</tr>
	<tr>
		<td class="fonte1" style="padding-top: 10">Último Acesso:</td>
		<td colspan="2" class="fonte1" style="padding-top: 10"><input name="ultimo_acesso" type="text" class="fonte1" size="22" maxlength="50" value="<?=$usuario_ultimo_acesso?>"></td>
	</tr>
</table>
		</td>
	</tr>
	<tr>
		<td align="center" style="padding-top: 10; padding-bottom: 10;"><input name="submit" type="submit" class="input2" onClick="return valida_usuario()" value="ALTERAR"> <input name="voltar" type="button" class="input2" onClick="location.href='usuarios.php'" value="VOLTAR"></td>
	</tr>
</table>
</form>
<script language="javascript">
document.forms.usuario.time.value = "<?=$usuario_time?>";
document.forms.usuario.time_secar.value = "<?=$usuario_time_secar?>";
</script>

		</td>
	</tr>
	<tr>
		<td id="baixo" colspan="2"><?php include("baixo.php") ?></td>
	</tr>
</table>
</center>
</body>
</html>