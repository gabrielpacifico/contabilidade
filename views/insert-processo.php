<?php
session_start();
include('../includes/conn.php');
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
        <title>Contabilidade - Cadastro Processos</title>
        <link rel="shortcut icon" href="../img/favicon.ICO">
        <link rel="stylesheet" href="../bootstrap/bootstrap-iso.css">
        <link rel="stylesheet" href="../css/cadastros.css">
        <link rel="stylesheet" href="../css/menu.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    </head>
<body>

<?php
include_once('../includes/navbar.html');

date_default_timezone_set('America/Sao_Paulo');
$data_cadastro = date('d-m-Y H:i:s', time());

$mes = mysqli_real_escape_string($conexao, $_POST['mes']);
$ano = mysqli_real_escape_string($conexao, $_POST['ano']);
$secretaria = mysqli_real_escape_string($conexao, $_POST['secretaria']);
$qnt_pastas = mysqli_real_escape_string($conexao, $_POST['qnt_pastas']);
$qnt_processos = mysqli_real_escape_string($conexao, $_POST['qnt_proc']);

$sql = "SELECT * FROM contabilidade WHERE mes = '$mes' AND ano = '$ano' AND secretaria = '$secretaria'";
$verify = mysqli_query($conexao, $sql);
$rows = mysqli_num_rows($verify);

if($rows > 0){
    $_SESSION['duplicado'] = true;
    echo "<script>window.location.href='cadastro-processos.php'</script>";
    exit();
}

$insert = "INSERT INTO contabilidade (`mes`, `ano`, `secretaria`, `qt_pastas`, `qt_proc`, `responsavel`, `data_cadastro`) 
VALUES ('$mes', '$ano', '$secretaria', '$qnt_pastas', '$qnt_processos', '{$usuario}', '$data_cadastro' )";

if(mysqli_query($conexao, $insert)){
    echo "<div class='formarea'><h1> Cadastro Concluído!<h1></div>
    <div class='center'> <a href='cadastro-processos.php' id='voltar'>Voltar</a></div>'";
}else{
    echo "<div class='formarea'><h1> Erro ao cadastrar, tente novamente!<h1></div>
    <div class='center'> <a href='cadastro-processos.php' id='voltar'>Voltar</a></div>'";
}
?>


    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
