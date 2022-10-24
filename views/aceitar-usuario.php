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
    <title>Contabilidade - Usuário aceito</title>
    <link rel="shortcut icon" href="../img/favicon.ICO">
    <link rel="stylesheet" href="../bootstrap/bootstrap-iso.css">
    <link rel="stylesheet" href="../css/cadastros.css">
    <link rel="stylesheet" href="../css/menu.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
</head>
<body>

<?php include_once('../includes/navbar.html'); ?>

    <?php 

        $update = "UPDATE usuarios SET stats = 'Ativo' WHERE id = '$id'";

        if(mysqli_query($conexao, $update)){
            echo "<div class='formarea'><h1> Usuário aceito com sucesso!<h1></div>
            <div class='center'> <a href='acesso-usuarios.php' id='voltar'>Voltar</a></div>'";
        }else{
            echo "<div class='formarea'><h1> Erro ao aceitar, tente novamente!<h1></div>
            <div class='center'> <a href='acesso-usuarios.php' id='voltar'>Voltar</a></div>'";
        }

    ?>
    
</body>
</html>