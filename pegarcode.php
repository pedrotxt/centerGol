<?php
$email='diegostrey@gmail.com';
$cod_estrutura = $email ."". date("Y-m-d H:i:s");
$cod = md5($cod_estrutura);
echo"{$cod}";
?>

