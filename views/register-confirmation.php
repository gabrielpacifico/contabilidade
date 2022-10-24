<?php 
include('../includes/conn.php');
session_start();
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/bootstrap-iso.css">
    <link rel="shortcut icon" href="../img/favicon.ICO">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/cadastros.css">
    <title>Fazer Login</title>
</head>

<body>

<?php

$nome = mysqli_real_escape_string($conexao, $_POST['user']);
$email = mysqli_real_escape_string($conexao, $_POST['email']);
$senha = mysqli_real_escape_string($conexao, $_POST['pass']);
$stats = "Inativo";

date_default_timezone_set('America/Sao_Paulo');
$data_cadastro = date('d-m-Y H:i:s', time());

$found_user = "SELECT * FROM usuarios WHERE nome = '$nome'";
                    $result_user = mysqli_query($conexao, $found_user);
                    $qnt_user = mysqli_num_rows($result_user);

                if($qnt_user > 0){
                    $_SESSION['user_already_exists'] = true;
                    echo "<script>window.location.href='login.php';</script>";
                    exit();
                }else{

                    $insert = "INSERT INTO usuarios (nome, email, senha, data_criacao, stats) VALUES ('$nome', '$email', md5('$senha'), '$data_cadastro', '$stats')";   

                    if (mysqli_query($conexao, $insert)) {
                        echo "<div class='formarea'><h1> Cadastro Concluído, aguarde até ser aceito!<h1></div>
                        <div class='center'> <a href='login.php' id='voltar'>Voltar</a></div>'";
                    }else{
                        echo "<div class='formarea'><h1> Erro ao cadastrar, tente novamente!<h1></div>
                        <div class='center'> <a href='login.php' id='voltar'>Voltar</a></div>'";
                    }
                
                }
?>
