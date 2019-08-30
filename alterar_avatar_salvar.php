<?php include_once("fun_anti_inj.php") ?>
<?php include("verificar_cookie.php") ?>
<?php include("conexao.php") ?>
<?php include("verificar_conexao.php") ?> 
<?php
$avatar_cor = anti_inj($_POST['avatar_cor_salvar']);
$avatar_cabelo = anti_inj($_POST['avatar_cabelo_salvar']);
$avatar_cabelo_cor = anti_inj($_POST['avatar_cabelo_cor_salvar']);
$avatar_olho = anti_inj($_POST['avatar_olho_salvar']);
$avatar_olho_cor = anti_inj($_POST['avatar_olho_cor_salvar']);

$query = mysql_query("SELECT ID, Sexo FROM Usuarios WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");
$result = mysql_fetch_array($query);

$mc_id = $result["ID"];
$mc_sexo = $result["Sexo"];

if ($mc_sexo == 1) { // Se o sexo for masculino...

if ($avatar_cor != 1 and $avatar_cor != 2 and $avatar_cor != 3 and $avatar_cor != 4) { $avatar_cor = 1; }

if ($avatar_cabelo != 1 and $avatar_cabelo != 2 and $avatar_cabelo != 3 and $avatar_cabelo != 4 and $avatar_cabelo != 5 and $avatar_cabelo != 6 and $avatar_cabelo != 7 and $avatar_cabelo != 8 and $avatar_cabelo != 9 and $avatar_cabelo != 10 and $avatar_cabelo != 11) { $avatar_cabelo = 1; }

if ($avatar_cabelo_cor != 1 and $avatar_cabelo_cor != 2 and $avatar_cabelo_cor != 3 and $avatar_cabelo_cor != 4 and $avatar_cabelo_cor != 5 and $avatar_cabelo_cor != 6 and $avatar_cabelo_cor != 7 and $avatar_cabelo_cor != 8 and $avatar_cabelo_cor != 9 and $avatar_cabelo_cor != 10 and $avatar_cabelo_cor != 11 and $avatar_cabelo_cor != 12) { $avatar_cabelo_cor = 1; }

if ($avatar_olho != 1 and $avatar_olho != 2 and $avatar_olho != 3 and $avatar_olho != 4 and $avatar_olho != 5 and $avatar_olho != 6) { $avatar_olho = 1; }

if ($avatar_olho_cor != 1 and $avatar_olho_cor != 2 and $avatar_olho_cor != 3 and $avatar_olho_cor != 4) { $avatar_olho_cor = 1; }

} else if ($mc_sexo == 2) { // Se o sexo for feminino...

if ($avatar_cor != 1 and $avatar_cor != 2 and $avatar_cor != 3 and $avatar_cor != 4) { $avatar_cor = 1; }

if ($avatar_cabelo != 1 and $avatar_cabelo != 2 and $avatar_cabelo != 3 and $avatar_cabelo != 4 and $avatar_cabelo != 5 and $avatar_cabelo != 6 and $avatar_cabelo != 7) { $avatar_cabelo = 1; }

if ($avatar_cabelo_cor != 1 and $avatar_cabelo_cor != 2 and $avatar_cabelo_cor != 3 and $avatar_cabelo_cor != 4 and $avatar_cabelo_cor != 5 and $avatar_cabelo_cor != 6 and $avatar_cabelo_cor != 7 and $avatar_cabelo_cor != 8 and $avatar_cabelo_cor != 9 and $avatar_cabelo_cor != 10 and $avatar_cabelo_cor != 11 and $avatar_cabelo_cor != 12) { $avatar_cabelo_cor = 1; }

if ($avatar_olho != 1 and $avatar_olho != 2 and $avatar_olho != 3 and $avatar_olho != 4 and $avatar_olho != 5 and $avatar_olho != 6) { $avatar_olho = 1; }

if ($avatar_olho_cor != 1 and $avatar_olho_cor != 2 and $avatar_olho_cor != 3 and $avatar_olho_cor != 4) { $avatar_olho_cor = 1; }

}

mysql_query("UPDATE Usuarios SET Avatar_Cor = '". $avatar_cor ."', Avatar_Cabelo = '". $avatar_cabelo ."', Avatar_Cabelo_Cor = '". $avatar_cabelo_cor ."', Avatar_Olho = '". $avatar_olho ."', Avatar_Olho_Cor = '". $avatar_olho_cor ."' WHERE ID_Cod = password('". $_COOKIE["usuarioid"] ."')");

mysql_query("DELETE FROM Historico WHERE Usuario = '". $mc_id ."' AND Tipo = 16");

$acao = "alterou o avatar.";

mysql_query("INSERT INTO Historico (Usuario,Tipo,Acao) VALUES ('". $mc_id ."',16,'". $acao ."')");

echo "&avatar_alterar_status=2";
?>