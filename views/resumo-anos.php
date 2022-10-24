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
    <title>Contabilidade - Resumos</title>
    <link rel="shortcut icon" href="../img/favicon.ICO">
    <link rel="stylesheet" href="../bootstrap/bootstrap-iso.css">
    <link rel="stylesheet" href="../css/cadastros.css">
    <link rel="stylesheet" href="../css/menu.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
</head>
<body>
    
    <?php include_once('../includes/navbar.html') ?>
    
    <div class="title">
            <h1>Resumo Geral - Anos </h1>
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
        
        
        <i class="fa-solid fa-angles-left" id="icon-voltar" onclick="window.location.href='main-menu.php'"></i>
        <div class="resume">
            <div class="resume2">
            <h1>Secretarias . . . . . . . . . . . . . . . . . . . . . . <?php if($total_sec == 0) { echo "Sem resultados.";}else{echo $total_sec; }?></h1>
            <h1>Pastas digitalizadas . . . . . . . . . . . . . . . . . . . . . . <?php if($total_pastas == 0){ echo "Sem resultados.";}else{echo $total_pastas; } ?></h1>
            <h1>Processos digitalizados . . . . . . . . . . . . . . . . . . . . . . <?php if($total_proc == 0){echo "Sem resultados.";}else{echo $total_proc;} ?></h1>
            </div>
        </div>

        <div class="select-ano">
            <form action="resumo-pesq.php" method="GET">
                <div class="bootstrap-iso">
                    <h1>Selecionar ano: </h1>
                    <select name="ano" id="select" class="form-control">
                        <option value="" selected>Ano</option>
                        <option value="2017">2017</option>
                        <option value="2018">2018</option>
                        <option value="2019">2019</option>
                        <option value="2020">2020</option>
                        <option value="2021">2021</option>
                        <option value="2022">2022</option>
                        <option value="2023">2023</option>
                        <option value="2024">2024</option>
                        <option value="2025">2025</option>
                        <option value="2026">2026</option>
                        <option value="2027">2027</option>
                        <option value="20278">2028</option>
                        <option value="2029">2029</option>
                        <option value="2030">2030</option>
                    </select>
                    <button type="submit" id="btn-ano">Buscar</button>
                </div>
            </form>
        </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>