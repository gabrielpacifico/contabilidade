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
    <title>Contabilidade - Edição </title>
    <link rel="shortcut icon" href="../img/favicon.ICO">
    <link rel="stylesheet" href="../bootstrap/bootstrap-iso.css">
    <link rel="stylesheet" href="../css/cadastros.css">
    <link rel="stylesheet" href="../css/menu.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
</head>

<body>

    <?php include_once('../includes/navbar.html'); ?>

    <?php

    $id = mysqli_real_escape_string($conexao, $_POST['id']);
    $mes = mysqli_real_escape_string($conexao, $_POST['mes']);
    $ano = mysqli_real_escape_string($conexao, $_POST['ano']);
    $secretaria = mysqli_real_escape_string($conexao, $_POST['secretaria']);
    $qnt_pastas = mysqli_real_escape_string($conexao, $_POST['qnt_pastas']);
    $qnt_proc = mysqli_real_escape_string($conexao, $_POST['qnt_proc']);

    // Verificando e pegando pelo id o registro que já existe na tabela antes da edição
    $verify_id = "SELECT * FROM contabilidade WHERE id = '$id'";
    $res_id = mysqli_query($conexao, $verify_id);
    $numrows_id = mysqli_num_rows($res_id);

    while ($rowid = mysqli_fetch_assoc($res_id)) {
        $mes_id = $rowid['mes'];
        $ano_id = $rowid['ano'];
        $secretaria_id = $rowid['secretaria'];
        $qnt_pastas_id = $rowid['qt_pastas'];
        $qnt_proc_id = $rowid['qt_proc'];
    }
    $array_string_id = array($mes_id, $ano_id, $secretaria_id, $qnt_pastas_id, $qnt_proc_id);
    $string_id = implode("-", $array_string_id); // Transformando o array em string para comparar com o outro array

    // Verificando na tabela se já existe um registro com os dados passados pelo input
    $verify = "SELECT * FROM contabilidade WHERE mes = '$mes' AND ano = '$ano' AND secretaria = '$secretaria' AND qt_pastas = '$qnt_pastas' AND qt_proc = '$qnt_proc'";
    $res = mysqli_query($conexao, $verify);
    $numrows = mysqli_num_rows($res);

    while ($rowedit = mysqli_fetch_assoc($res)) {
        $mes_edit = $rowedit['mes'];
        $ano_edit = $rowedit['ano'];
        $secretaria_edit = $rowedit['secretaria'];
        $qnt_pastas_edit = $rowedit['qt_pastas'];
        $qnt_proc_edit = $rowedit['qt_proc'];
    }
    if ($numrows > 0) {
        $array_string_edit = array($mes_edit, $ano_edit, $secretaria_edit, $qnt_pastas_edit, $qnt_proc_edit);
        $string_edit = implode("-", $array_string_edit); // Transformando o array em string para comparar com o primeiro array
        if ($array_string_id == $array_string_edit) { // Caso os dois arrays sejam iguais, ou seja não tenha mudado nada nos inputs e apenas clicado em editar, então a edição será feita
            $update_iguais = "UPDATE contabilidade SET `mes`='$mes',`ano`='$ano',`secretaria`='$secretaria',`qt_pastas`='$qnt_pastas',`qt_proc`='$qnt_proc' WHERE id = '$id'";
            if (mysqli_query($conexao, $update_iguais)) {
                echo "<div class='formarea'><h1> Edição Concluída!<h1></div>
                <div class='center'> <a href='editar-processos.php' id='voltar'>Voltar</a></div>'";
            } else {
                echo "<div class='formarea'><h1> Erro ao editar, tente novamente!<h1></div>
                <div class='center'> <a href='editar-processos.php' id='voltar'>Voltar</a></div>'";
            }
        }
    } else {
        // Verificar se existe mais de um processo no banco de dados, exceto o que estamos editando, se sim redireciona a passa o erro.
        $verify2 = "SELECT * FROM contabilidade WHERE mes = '$mes' AND ano = '$ano' AND secretaria = '$secretaria'";
        $res2 = mysqli_query($conexao, $verify2);
        $numrows2 = mysqli_num_rows($res2);
        $remove_row = ($numrows2 - 1); // Remove uma linha de $numrows2, para que consigamos editar apenas a qnt de pastas e/ou qnt proc de um processo que já existe.

        if ($remove_row <= 0) { // Se o número de registros for menor ou igual a zero, não realize a edição
            $_SESSION['processo-duplicado'] = true;
            echo "<script>window.location.href='info-processo.php?id=$id'</script>";
            exit();
        } else {
            $update_padrao = "UPDATE contabilidade SET `mes`='$mes',`ano`='$ano',`secretaria`='$secretaria',`qt_pastas`='$qnt_pastas',`qt_proc`='$qnt_proc' WHERE id = '$id'";
            if (mysqli_query($conexao, $update_padrao)) {
                echo "<div class='formarea'><h1> Edição Concluída!<h1></div>
                <div class='center'> <a href='editar-processos.php' id='voltar'>Voltar</a></div>'";
            } else {
                echo "<div class='formarea'><h1> Erro ao editar, tente novamente!<h1></div>
                <div class='center'> <a href='editar-processos.php' id='voltar'>Voltar</a></div>'";
            }
        }
    }

    ?>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>