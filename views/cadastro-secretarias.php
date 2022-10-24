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
    <link rel="shortcut icon" href="../img/favicon.ICO">
    <link rel="stylesheet" href="../bootstrap/bootstrap-iso.css">
    <link rel="stylesheet" href="../css/cadastros.css">
    <link rel="stylesheet" href="../css/menu.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    <title>Contabilidade - Cadastro Secretarias</title>
</head>

<body>

    <?php include_once('../includes/navbar.html'); ?>

    <section class="formarea">
        <h1>Cadastro de Secretarias</h1>
        <i class="fa-solid fa-angles-left" onclick="window.location.href='main-menu.php'"></i>

        <?php
        if (isset($_SESSION['duplicado'])) {
        ?>

            <div class="center"><span>Cadastro duplicado, tente novamente!</span></div>

        <?php
        }
        unset($_SESSION['duplicado'])
        ?>

        <form action="insert-secretaria.php" method="POST" class="bootstrap-iso">
            <div class="form-group" id="formulario">
                <div class="select">
                    <label>Secretaria: </label>
                    <input type="text" name="secretaria" class="form-control" id="select" placeholder="Secretaria" required autocomplete="off">
                </div>

                <button type="submit" onclick="return confirm('Tem certeza que deseja cadastrar?')">Cadastrar</button>
            </div>
        </form>
    </section>




    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>