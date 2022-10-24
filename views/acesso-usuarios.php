<?php
include('../includes/conn.php');
session_start();
$usuario = $_SESSION['usuario'];

if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contabilidade - Acesso usuários</title>
    <link rel="shortcut icon" href="../img/favicon.ICO">
    <link rel="stylesheet" href="../bootstrap/bootstrap-iso.css">
    <link rel="stylesheet" href="../css/listagens.css">
    <link rel="stylesheet" href="../css/menu.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
</head>
<body>

    <?php include_once('../includes/navbar.html'); ?>


    <section class="tablearea">
        <h1>Acesso de usuários</h1>
        <i class="fa-solid fa-angles-left" onclick="window.location.href='main-menu.php'"></i>

        <div class="bootstrap-iso">
            <div id="table">
                <table class="table table-borderless table-dark table-hover">
                    <thead>
                        <tr>
                            <th>Usuário</th>
                            <th>Email</th>
                            <th>Data cadastro</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <?php

                    $sql = "SELECT * FROM usuarios WHERE stats = 'Inativo' ORDER BY id DESC";
                    $query = mysqli_query($conexao, $sql);
                    $rows = mysqli_num_rows($query);

                    if($rows == 0){
                        echo "<style>table{ display: none } </style>
                            <div class='aviso'>
                            <div class='center'><span>Nenhum usuário em espera, aguarde...</span></div>
                            </div>";
                    }
                    while ($array = mysqli_fetch_assoc($query)) {
                        $id = $array['id'];
                        $nome = $array['nome'];
                        $email = $array['email'];
                        $data_criacao = $array['data_criacao'];
                        $status = $array['stats'];

                        $data_criacao_pt = str_replace("-", "/", $data_criacao);
                    ?>
                        <tbody>
                            <tr onclick="window.location.href='accept-user.php?id=<?=$id?>'" style="cursor: pointer;">
                                <th><?= $nome ?></th>
                                <td><?= $email ?></td>
                                <td><?=$data_criacao_pt?></td>
                                <td><?= $status ?></td>
                                </td>
                            </tr>
                        </tbody>
                    <?php } ?>
                </table>
                <span class="numrows">Número de usuários encontrados: <?= $rows ?> </span>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>