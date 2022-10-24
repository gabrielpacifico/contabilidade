<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contabilidade - Cadastro Secretarias</title>
    <link rel="shortcut icon" href="../img/favicon.ICO">
    <link rel="stylesheet" href="../bootstrap/bootstrap-iso.css">
    <link rel="stylesheet" href="../css/cadastros.css">
    <link rel="stylesheet" href="../css/menu.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
</head>
<body>
    
<?php
include('../includes/conn.php');
include_once('../includes/navbar.html');
session_start();
$usuario = $_SESSION['usuario'];

if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
}

$secretaria = mysqli_real_escape_string($conexao, $_POST['secretaria']);

$sql = "SELECT * FROM secretarias WHERE secretaria = '$secretaria'";
$verify = mysqli_query($conexao, $sql);
$rows = mysqli_num_rows($verify);

if($rows > 0){
    $_SESSION['duplicado'] = true;
    echo "<script>window.location.href='cadastro-secretarias.php'</script>";
    exit();
}

$insert = "INSERT INTO secretarias (`secretaria`) VALUES ('$secretaria')";
if(mysqli_query($conexao, $insert)){
    echo "<div class='formarea'><h1> Cadastro Concluído!<h1></div>
    <div class='center'> <a href='cadastro-secretarias.php' id='voltar'>Voltar</a></div>'";
}else{
    echo "<div class='formarea'><h1> Erro ao cadastrar, tente novamente!<h1></div>
    <div class='center'> <a href='cadastro-secretarias.php' id='voltar'>Voltar</a></div>'";
}
?>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>