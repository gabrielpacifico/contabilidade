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
    <link rel="stylesheet" href="../css/listagens.css">
    <link rel="stylesheet" href="../css/menu.css">
    <link rel="stylesheet" href="../css/respose.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    <title>Contabilidade - Editar Processos</title>
</head>
<body>
    <?php include_once('../includes/navbar.html'); ?>

    <section class="tablearea">
        <h1>Editar processos - Ano <?= $ano ?></h1>
        <i class="fa-solid fa-angles-left" onclick="window.location.href='main-menu.php'"></i>

        <div class="bootstrap-iso">
            <form action="edit-pesquisar.php" method="GET">
                <div class="search">
                    <div class="input-group">
                        <input type="number" class="form-control" name="ano" placeholder="Buscar por ano" id="input" autocomplete="off">
                        <div class="input-group-append">
                            <button type="submit" id="btn-pesquisar">Buscar</button>
                        </div>
                    </div>
            </form>
        </div>

        <div class="bootstrap-iso">
            <div id="table">
                <table class="table table-borderless table-responsive table-dark table-hover">
                    <thead>
                        <tr>
                            <th>Mês</th>
                            <th>Ano</th>
                            <th>Secretaria</th>
                            <th>Qnt. Pastas</th>
                            <th>Qnt. Proc</th>
                        </tr>
                    </thead>
                    <?php

                    $sql = "SELECT * FROM contabilidade WHERE ano = '$ano' ORDER BY id DESC";
                    $query = mysqli_query($conexao, $sql);
                    $rows = mysqli_num_rows($query);

                    if($rows == 0){
                        echo "<style>table{ display: none; } </style>
                            <div class='aviso'>
                            <div class='center'><span>Nenhum resultado encontrado, tente novamente!</span></div>
                            </div>";
                    }
                    while ($array = mysqli_fetch_assoc($query)) {
                        $id = $array['id'];
                        $mes = $array['mes'];
                        $ano = $array['ano'];
                        $secretaria = $array['secretaria'];
                        $qnt_pastas = $array['qt_pastas'];
                        $qnt_proc = $array['qt_proc'];

                    ?>
                        <tbody>
                            <tr onclick="window.location.href='info-processo.php?id=<?=$id?>'" style="cursor: pointer;">
                                <th><?= $mes ?></th>
                                <td><?= $ano ?></td>
                                <td><?= $secretaria ?></td>
                                <td><?= $qnt_pastas ?></td>
                                <td><?= $qnt_proc ?></td>
                            </tr>
                        </tbody>
                    <?php } ?>
                </table>
                <span class="numrows">Número de processos encontrados: <?= $rows ?> </span>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>