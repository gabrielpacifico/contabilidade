<?php
include('../includes/conn.php');
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
    <title>Cadastrar Usuário</title>
</head>

<body>

    <section class="area-login">
        <div class="login">

            <div>
                <img src="../img/logo-pratica.png">
            </div>
            <h1 class="title-login">Cadastrar-se</h1>
            <form action="register-confirmation.php" method="POST">

                <label for="usuario" class="label-login">Usuário</label>
                <input type="text" name="user" class="form-control" placeholder="Usuário" required autocomplete="off">

                <label for="usuario" class="label-login">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Email" required autocomplete="off">

                <label for="usuario" class="label-login">Senha</label>
                <input type="password" name="pass" class="form-control" id="txtSenha" placeholder="Senha" required autocomplete="off">

                <label for="usuario" class="label-login">Repetir senha</label>
                <input type="password" name="repeat_pass" class="form-control" placeholder="Repetir senha" required autocomplete="off" oninput="validaSenha(this)">
                <button type="submit">Cadastrar</button>
            </form>
            <p>Já tem uma conta? <a href="login.php">Fazer Login</a></p>
        </div>
    </section>

    <script>
        function validaSenha(input) {
            if (input.value != document.getElementById('txtSenha').value) {
                input.setCustomValidity('As senhas não coincidem, tente novamente.');
            } else {
                input.setCustomValidity('');
            }
        }
    </script>

</body>

</html>