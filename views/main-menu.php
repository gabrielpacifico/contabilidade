<?php
include('../includes/conn.php');
session_start();
$usuario = $_SESSION['usuario'];

if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
}

date_default_timezone_set('America/Sao_Paulo');
$ano = date('Y');
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../img/favicon.ICO">
    <link rel="stylesheet" href="../bootstrap/bootstrap-iso.css">
    <link rel="stylesheet" href="../css/menu.css">
    <link rel="stylesheet" href="../css/respose.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    <title>Contabilidade - Menu Principal</title>
</head>

<body>

    <?php include_once('../includes/navbar.html'); ?>

    <div class="title">
        <h1>Mapa digitalização de processos da contabilidade</h1>
    </div>
    <div class="subtitle">
        <h2>Resumo do ano de <?php echo $ano ?></h2>
    </div>

    <?php

    $sql = "SELECT COUNT(DISTINCT secretaria) AS qnt_sec FROM contabilidade WHERE ano = '$ano' AND secretaria != ''";
    $res_sec = mysqli_query($conexao, $sql);
    $fetch_sec = mysqli_fetch_assoc($res_sec);
    $total_sec = $fetch_sec['qnt_sec'];

    $sql = "SELECT SUM(qt_pastas) AS qnt_pastas FROM contabilidade WHERE ano = '$ano' AND qt_pastas != ''";
    $res_pastas = mysqli_query($conexao, $sql);
    $fetch_pastas = mysqli_fetch_assoc($res_pastas);
    $total_pastas = $fetch_pastas['qnt_pastas'];

    $sql = "SELECT SUM(qt_proc) AS qnt_proc FROM contabilidade WHERE ano = '$ano' AND qt_proc != ''";
    $res_proc = mysqli_query($conexao, $sql);
    $fetch_proc = mysqli_fetch_assoc($res_proc);
    $total_proc = $fetch_proc['qnt_proc'];
    ?>

    <div class="resume">
        <div class="resume2">
            <h1>Secretarias . . . . . . . . . . . . . . . . . . <?php if($total_sec == 0) { echo "Sem resultados.";}else{echo $total_sec; }?></h1>
            <h1>Pastas digitalizadas . . . . . . . . . . . . . . <?php if($total_pastas == 0){ echo "Sem resultados.";}else{echo $total_pastas; } ?></h1>
            <h1>Processos digitalizados . . . . . . . . . . . . . <?php if($total_proc == 0){echo "Sem resultados.";}else{echo $total_proc;} ?></h1>
        </div>
    </div>

    <section class="quadros">
        <h1 class="titulo-cadastro">Área para Cadastros</h1>

        <div class="q1" onclick="window.location.href='cadastro-processos.php'">
            <h1>Cadastro Processos</h1>
        </div>
        <p>Cadastrar processos mensais digitalizados usando: Mês, ano, secretaria, quantidade de pastas e processos.</p>
        <hr>
        <div class="q2" onclick="window.location.href='cadastro-secretarias.php'">
            <h1>Cadastro Secretarias</h1>
        </div>
        <p>Cadastrar as secretarias para serem usadas no sistema.</p>
    </section>

    <section class="quadros2">
        <h1 class="titulo-listas">Visualizar e editar processos</h1>
        <div class="align-center2">
            <div class="proc" onclick="window.location.href='mapa-processos.php'">
                <h1>Mapa de Processos</h1>
            </div>
            <div class="sec" onclick="window.location.href='editar-processos.php'">
                <h1>Editar Processos</h1>
            </div>
            <div class="res" onclick="window.location.href='resumo-anos.php'">
                <h1>Resumo de outros anos</h1>
            </div>
        </div>
    </section>

    <section class="quadros">
        <h1 class="titulo-cadastro">Acesso de usuários</h1>

        <div class="q1" onclick="window.location.href='acesso-usuarios.php'">
            <h1>Acessar usuários</h1>
        </div>
        <p>Aceitar ou recusar novos usuários para acessarem sistema.</p>
    </section>

    <?php include_once('../includes/footer.html'); ?>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>