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
    <link rel="shortcut icon" href="../img/favicon.ICO">
    <link rel="stylesheet" href="../bootstrap/bootstrap-iso.css">
    <link rel="stylesheet" href="../css/login.css">
    <title>Fazer Login</title>
</head>

<body>

<section class="area-login">
    <div class="login">

                <div>
                    <img src="../img/logo-pratica.png">
                </div>
                <h1 class="title-login">Fazer login</h1>

                <?php 
                        if(isset($_SESSION['sem_autenticacao'])){
                    ?>

                        <span>Usuário ou senha inválidos, tente novamente!</span>

                    <?php 
                    }
                    unset($_SESSION['sem_autenticacao'])
                    ?>
                <form action="login-authentication.php" method="POST">

                        <label for="usuario" class="label-login">Usuário</label>
                        <input type="text" name="user" class="form-control" placeholder="Usuário" required autocomplete="off">
                   
                        <label for="usuario" class="label-login">Senha</label>
                        <input type="password" name="pass" class="form-control" placeholder="Senha" required autocomplete="off">
                        <button type="submit">Entrar</button>
                    </form>
                    <p>Ainda não tem uma conta? <a href="cadastro-usuario.php">Cadastrar-se</a></p>
                </div>
            </section>

</body>

</html>