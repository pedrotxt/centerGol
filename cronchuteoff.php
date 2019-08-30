<?php include("conexao.php") ?>
<?php
$tempo = date("Y-m-d H:i:s");
@$r=mysql_fetch_array(mysql_query("select * from Usuarios where Status=2 and Chuteoff=1"));
if($r['Chutar_Tempo'] < $tempo){
$tempo_chutar = date("Y-m-d H:i:s", strtotime("+6 mins"));
mysql_query("UPDATE Usuarios SET Chutar_Tempo = '". $tempo_chutar ."', Gols_Hora = Gols_Hora + 1, Gols_Rodada = Gols_Rodada + 1, Gols_Temporada = Gols_Temporada + 1, Gols_Total = Gols_Total + 1, Gols_Time = Gols_Time + 1, Dinheiro = Dinheiro + '". $dinheiro ."' WHERE Status=2 and Chuteoff=1");
}
?>