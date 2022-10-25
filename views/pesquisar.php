<?php
include('../includes/conn.php');
session_start();
$usuario = $_SESSION['usuario'];

if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
}

$ano = mysqli_real_escape_string($conexao, $_GET['ano']);

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contabilidade - Exibindo pesquisa</title>
    <link rel="shortcut icon" href="../img/favicon.ICO">
    <link rel="stylesheet" href="../bootstrap/bootstrap-iso.css">
    <link rel="stylesheet" href="../css/listagens.css">
    <link rel="stylesheet" href="../css/menu.css">
    <link rel="stylesheet" href="../css/respose.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
</head>

<body>
    <?php include_once('../includes/navbar.html') ?>

    <section class="tablearea">
        <h1>Exibindo processos - Ano <?= $ano ?></h1>
        <i class="fa-solid fa-angles-left" onclick="window.location.href='mapa-processos.php'"></i>

        <div class="bootstrap-iso">
            <div id="table">
                <table class="table table-borderless table-responsive table-dark table-hover" id="hide-table">
                    <thead>
                        <tr>
                            <th>Mês</th>
                            <th>Ano</th>
                            <th>Secretaria</th>
                            <th>Qnt. Pastas</th>
                            <th>Qnt. Proc</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php

                        if (empty($_GET['ano'])) {
                            $_SESSION['campo-vazio'] = true;
                            header('Location: mapa-processos.php');
                            exit();
                        }

                        $query = "SELECT * FROM contabilidade WHERE ano = '$ano' ORDER BY id DESC";
                        $res = mysqli_query($conexao, $query);
                        $rows = mysqli_num_rows($res);

                        if($rows == 0){
                            echo "<style>#hide-table{ display: none; } </style>
                                <div class='aviso'>
                                <div class='center'><span>Nenhum resultado encontrado, tente novamente!</span></div>
                                </div>";
                        }
                        while ($row = mysqli_fetch_assoc($res)) {
                            $mes = $row['mes'];
                            $ano = $row['ano'];
                            $secretaria = $row['secretaria'];
                            $qnt_pastas = $row['qt_pastas'];
                            $qnt_proc = $row['qt_proc'];
                        ?>

                            <tr>
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