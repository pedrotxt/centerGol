<?php include("conexao.php") ?>
<?
$token = "262A94AC132C9CCA0532E97A875FFEAC";

/* Montando as variáveis de retorno */

$id_transacao = $_POST['id_transacao'];
$data_transacao = $_POST['data_transacao'];
$data_credito = $_POST['data_credito'];
$valor_original = $_POST['valor_original'];
$valor_loja = $_POST['valor_loja'];
$valor_total = $_POST['valor_total'];
$desconto = $_POST['desconto'];
$acrescimo = $_POST['acrescimo'];
$tipo_pagamento = $_POST['tipo_pagamento'];
$parcelas = $_POST['parcelas'];
$cliente_nome = $_POST['cliente_nome'];
$cliente_email = $_POST['cliente_email'];
$cliente_rg = $_POST['cliente_rg'];
$cliente_data_emissao_rg = $_POST['cliente_data_emissao_rg'];
$cliente_orgao_emissor_rg = $_POST['cliente_orgao_emissor_rg'];
$cliente_estado_emissor_rg = $_POST['cliente_estado_emissor_rg'];
$cliente_cpf = $_POST['cliente_cpf'];
$cliente_sexo = $_POST['cliente_sexo'];
$cliente_data_nascimento = $_POST['cliente_data_nascimento'];
$cliente_endereco = $_POST['cliente_endereco'];
$cliente_complemento = $_POST['cliente_complemento'];
$status = $_POST['status'];
$cod_status = $_POST['cod_status'];
$cliente_bairro = $_POST['cliente_bairro'];
$cliente_cidade = $_POST['cliente_cidade'];
$cliente_estado = $_POST['cliente_estado'];
$cliente_cep = $_POST['cliente_cep'];
$frete = $_POST['frete'];
$tipo_frete = $_POST['tipo_frete'];
$informacoes_loja = $_POST['informacoes_loja'];
$id_pedido = $_POST['id_pedido'];
$free = $_POST['free'];

/* Essa variável indica a quantidade de produtos retornados */
$qtde_produtos = $_POST['qtde_produtos'];

/* Verificando ID da transação */
/* Verificando status da transação */
/* Verificando valor original */
/* Verificando valor da loja */

$post = "transacao=$id_transacao" . "&status=$status" . "&cod_status=$cod_status" . "&valor_original=$valor_original" . "&valor_loja=$valor_loja" . "&token=$token";
$enderecoPost = "https://www.pagamentodigital.com.br/checkout/verify/";

ob_start();
$ch = curl_init();
curl_setopt ($ch, CURLOPT_URL, $enderecoPost);
curl_setopt ($ch, CURLOPT_POST, 1);
curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
curl_exec ($ch);
$resposta = ob_get_contents();
ob_end_clean();

if (trim($resposta) == "VERIFICADO") {

$produto_codigo = $_POST['produto_codigo_1'];
$produto_descricao = $_POST['produto_descricao_1'];
$produto_qtde = $_POST['produto_qtde_1'];
$produto_valor = $_POST['produto_valor_1'];
$produto_extra = $_POST['produto_extra_1'];

if ($cod_status == 0) { // se a compra estiver em analise


$query = mysql_query("SELECT ID FROM Loja WHERE ID_Tran = '". $id_transacao ."'");
$rs = mysql_fetch_array($query);

if ($rs) {
	mysql_query("UPDATE Loja SET Status = 0 WHERE ID_Tran = '". $id_transacao ."'");
} else {
	mysql_query("INSERT INTO Loja (ID_Tran,Usuario,Produto,Quantidade,Data,Status) VALUES ('". $id_transacao ."', '". $produto_extra ."', '". $produto_codigo ."','". $produto_qtde ."','". date("Y-m-d H:i:s") ."',0)");
}


} else if ($cod_status == 1) { // se a compra for confirmada





$query = mysql_query("SELECT ID, Status FROM Loja WHERE ID_Tran = '". $id_transacao ."'");
$rs = mysql_fetch_array($query);

if ($rs) {
	$status_tran = $rs["Status"];
} else {
	$status_tran = 0;
	mysql_query("INSERT INTO Loja (ID_Tran,Usuario,Produto,Quantidade,Data,Status) VALUES ('". $id_transacao ."', '". $produto_extra ."', '". $produto_codigo ."','". $produto_qtde ."','". date("Y-m-d H:i:s") ."',0)");
}


if ($status_tran != 1) { // se ainda nao tiver confirmado na conta do usuario

mysql_query("UPDATE Loja SET Status = 1 WHERE ID_Tran = '". $id_transacao ."'");



if ($produto_codigo == "Pacote 1") {

$vip = $produto_qtde * 61;
$fidelidade = $produto_qtde * 1;

mysql_query("UPDATE Usuarios SET VIP = VIP + '". $vip ."', Presidente_Dias = Presidente_Dias + '". $presidente ."', Fidelidade = Fidelidade + '". $fidelidade ."' WHERE ID = '". $produto_extra ."'");

} else if ($produto_codigo == "Pacote 2") {

$vip = $produto_qtde * 151;
 $fidelidade = $produto_qtde * 2;

mysql_query("UPDATE Usuarios SET VIP = VIP + '". $vip ."', Presidente_Dias = Presidente_Dias + '". $presidente ."', Fidelidade = Fidelidade + '". $fidelidade ."' WHERE ID = '". $produto_extra ."'");

} else if ($produto_codigo == "Pacote 3") {

$vip = $produto_qtde * 231;
 $fidelidade = $produto_qtde * 3;

mysql_query("UPDATE Usuarios SET VIP = VIP + '". $vip ."', Presidente_Dias = Presidente_Dias + '". $presidente ."', Fidelidade = Fidelidade + '". $fidelidade ."' WHERE ID = '". $produto_extra ."'");

} else if ($produto_codigo == "Pacote 4") {

$vip = $produto_qtde * 311;
 $fidelidade = $produto_qtde * 4;

mysql_query("UPDATE Usuarios SET VIP = VIP + '". $vip ."', Presidente_Dias = Presidente_Dias + '". $presidente ."', Fidelidade = Fidelidade + '". $fidelidade ."' WHERE ID = '". $produto_extra ."'");

} else if ($produto_codigo == "Pacote 5") {

$vip = $produto_qtde * 391; 
$fidelidade = $produto_qtde * 5;

mysql_query("UPDATE Usuarios SET VIP = VIP + '". $vip ."', Presidente_Dias = Presidente_Dias + '". $presidente ."', Fidelidade = Fidelidade + '". $fidelidade ."' WHERE ID = '". $produto_extra ."'");

} else if ($produto_codigo == "Pacote 6") {

$vip = $produto_qtde * 1011;
$fidelidade = $produto_qtde * 10;

mysql_query("UPDATE Usuarios SET VIP = VIP + '". $vip ."', Presidente_Dias = Presidente_Dias + '". $presidente ."', Fidelidade = Fidelidade + '". $fidelidade ."' WHERE ID = '". $produto_extra ."'");

} else if ($produto_codigo == "Pacote 7") {

$dinheiro = $produto_qtde * 100000;
$fidelidade = $produto_qtde * 1;

mysql_query("UPDATE Usuarios SET Dinheiro = Dinheiro + '". $dinheiro ."', Fidelidade = Fidelidade + '". $fidelidade ."' WHERE ID = '". $produto_extra ."'");

} else if ($produto_codigo == "Pacote 8") {

$dinheiro = $produto_qtde * 250000;
$fidelidade = $produto_qtde * 2;

mysql_query("UPDATE Usuarios SET Dinheiro = Dinheiro + '". $dinheiro ."', Fidelidade = Fidelidade + '". $fidelidade ."' WHERE ID = '". $produto_extra ."'");

} else if ($produto_codigo == "Pacote 9") {

$dinheiro = $produto_qtde * 400000;
$fidelidade = $produto_qtde * 3;

mysql_query("UPDATE Usuarios SET Dinheiro = Dinheiro + '". $dinheiro ."', Fidelidade = Fidelidade + '". $fidelidade ."' WHERE ID = '". $produto_extra ."'");

} else if ($produto_codigo == "Pacote 10") {

$dinheiro = $produto_qtde * 900000;
$fidelidade = $produto_qtde * 6;

mysql_query("UPDATE Usuarios SET Dinheiro = Dinheiro + '". $dinheiro ."', Fidelidade = Fidelidade + '". $fidelidade ."' WHERE ID = '". $produto_extra ."'");

}

}




} else if ($cod_status == 2) { // se a compra for cancelada


$query = mysql_query("SELECT ID FROM Loja WHERE ID_Tran = '". $id_transacao ."'");
$rs = mysql_fetch_array($query);

if ($rs) {
	mysql_query("UPDATE Loja SET Status = 2 WHERE ID_Tran = '". $id_transacao ."'");
} else {
	mysql_query("INSERT INTO Loja (ID_Tran,Usuario,Produto,Quantidade,Data,Status) VALUES ('". $id_transacao ."', '". $produto_extra ."', '". $produto_codigo ."','". $produto_qtde ."','". date("Y-m-d H:i:s") ."',2)");
}


}

}
?> 