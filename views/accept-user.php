<?php
include('../includes/conn.php');
session_start();
$usuario = $_SESSION['usuario'];

if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
}

$id = mysqli_real_escape_string($conexao, $_GET['id']);

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contabilidade - Aceitar ou recusar usuário</title>
    <link rel="shortcut icon" href="../img/favicon.ICO">
    <link rel="stylesheet" href="../bootstrap/bootstrap-iso.css">
    <link rel="stylesheet" href="../css/cadastros.css">
    <link rel="stylesheet" href="../css/menu.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
</head>

<body>

    <?php include_once('../includes/navbar.html'); ?>

    <?php

    $sql = "SELECT * FROM usuarios WHERE id = '$id' AND stats = 'Inativo'";
    $res = mysqli_query($conexao, $sql);

    while ($row = mysqli_fetch_assoc($res)) {
        $usuario = $row['nome'];
        $email = $row['email'];
        $data_criacao = $row['data_criacao'];
        $status = $row['stats'];

        $data_criacao_pt = str_replace("-", "/", $data_criacao);
    ?>

        <section class="formarea">
        <h1>Informações do usuário</h1>
        <i class="fa-solid fa-angles-left" onclick="window.location.href='acesso-usuarios.php'"></i>

            <div class="bootstrap-iso">
                <div class="form-group" id="formulario">
                    <div class="select">
                        <label>Usuário: </label>
                        <input type="text" class="form-control" id="select" value="<?= $usuario ?>" autocomplete="off" readonly>
                    </div>

                    <div class="select">
                        <label>Email: </label>
                        <input type="text" class="form-control" id="select" value="<?= $email ?>" autocomplete="off" readonly>
                    </div>

                    <div class="select">
                        <label>Data criação: </label>
                        <input type="text" class="form-control" id="select" value="<?= $data_criacao_pt?>" autocomplete="off" readonly>
                    </div>

                    <div class="select">
                        <label>Status: </label>
                        <input type="text" class="form-control" id="select" value="<?= $status ?>" autocomplete="off" readonly>
                    </div>
                </div>
                <div class="center">
                    <a href="recusar-usuario.php?id=<?=$id?>" id="remove-user">Recusar</a>
                    <a href="aceitar-usuario.php?id=<?=$id?>" id="accept-user">Aceitar</a>
                </div>
            </div>
        </section>

    <?php } ?>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>