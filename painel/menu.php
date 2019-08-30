<table id="tabela_esquerda1" width="140" cellpadding="0" cellspacing="0">
	<tr>
		<td class="fonte_titulo1">Menu</td>
	</tr>
	<tr>
		<td class="fonte_menu1"><img src="../figuras/painel/menu_seta1.png"> <a href="index.php">Principal</a></td>
	</tr>
	<tr>
		<td class="fonte_menu1"><img src="../figuras/painel/menu_seta1.png"> <a href="alterar_dados.php">Alterar dados</a></td>
	</tr>
<?php if ($mc_cargo == 1) { ?>
	<tr>
		<td class="fonte_menu1"><img src="../figuras/painel/menu_seta1.png"> <a href="configuracoes.php">Configurações</a></td>
	</tr>
<?php } ?>
<?php if ($mc_cargo == 1) { ?>
	<tr>
		<td class="fonte_menu1"><img src="../figuras/painel/menu_seta1.png"> <a href="administradores.php">Administradores</a></td>
	</tr>
<?php } ?>
	<tr>
		<td class="fonte_menu1"><img src="../figuras/painel/menu_seta1.png"> <a href="usuarios.php">Usuários</a></td>
	</tr>
<?php if ($mc_cargo == 1) { ?>
	<tr>
		<td class="fonte_menu1"><img src="../figuras/painel/menu_seta1.png"> <a href="times.php">Times</a></td>
	</tr>
<?php } ?>
<?php if ($mc_cargo == 1) { ?>
	<tr>
		<td class="fonte_menu1"><img src="../figuras/painel/menu_seta1.png"> <a href="mensagem_global.php">Mensagem Global</a></td>
	</tr>
<?php } ?>
	<tr>
		<td class="fonte_menu1"><img src="../figuras/painel/menu_seta1.png"> <a href="stfc.php">STFC</a></td>
	</tr>
	<tr>
		<td class="fonte_menu2"><img src="../figuras/painel/menu_seta1.png"> <a href="logout.php">Sair</a></td>
	</tr>
</table>