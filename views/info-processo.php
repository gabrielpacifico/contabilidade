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
    <title>Contabilidade - Info Processo</title>
    <link rel="shortcut icon" href="../img/favicon.ICO">
    <link rel="stylesheet" href="../bootstrap/bootstrap-iso.css">
    <link rel="stylesheet" href="../css/cadastros.css">
    <link rel="stylesheet" href="../css/menu.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
</head>

<body>

    <?php

    $id = mysqli_real_escape_string($conexao, $_GET['id']);

    $sql = "SELECT * FROM contabilidade WHERE id = '$id'";
    $res = mysqli_query($conexao, $sql);

    while ($rows = mysqli_fetch_assoc($res)) {
        $mes = $rows['mes'];
        $ano = $rows['ano'];
        $secretaria = $rows['secretaria'];
        $qnt_pastas = $rows['qt_pastas'];
        $qnt_proc = $rows['qt_proc'];

    ?>

        <?php include_once('../includes/navbar.html'); ?>

        <section class="formarea">
            <h1>Informações sobre o processo</h1>
            <i class="fa-solid fa-angles-left" onclick="window.location.href='javascript:history.back()'"></i>

            <?php
            if (isset($_SESSION['processo-duplicado'])) {
            ?>

                <div class="center"><span>Processo duplicado, tente novamente!</span></div>

            <?php
            }
            unset($_SESSION['processo-duplicado'])
            ?>

            <form action="edit-finished.php" method="POST" class="bootstrap-iso">
                <div class="form-group" id="formulario">
                    <div class="select">
                        <label>Mês: </label>
                        <select name="mes" class="form-control" id="select" required>
                            <option <?= ($mes == '') ? 'selected' : '' ?>>Mês</option>
                            <option <?= ($mes == 'Janeiro') ? 'selected' : '' ?>>Janeiro</option>
                            <option <?= ($mes == 'Fevereiro') ? 'selected' : '' ?>>Fevereiro</option>
                            <option <?= ($mes == 'Março') ? 'selected' : '' ?>>Março</option>
                            <option <?= ($mes == 'Abril') ? 'selected' : '' ?>>Abril</option>
                            <option <?= ($mes == 'Maio') ? 'selected' : '' ?>>Maio</option>
                            <option <?= ($mes == 'Junho') ? 'selected' : '' ?>>Junho</option>
                            <option <?= ($mes == 'Julho') ? 'selected' : '' ?>>Julho</option>
                            <option <?= ($mes == 'Agosto') ? 'selected' : '' ?>>Agosto</option>
                            <option <?= ($mes == 'Setembro') ? 'selected' : '' ?>>Setembro</option>
                            <option <?= ($mes == 'Outubro') ? 'selected' : '' ?>>Outubro</option>
                            <option <?= ($mes == 'Novembro') ? 'selected' : '' ?>>Novembro</option>
                            <option <?= ($mes == 'Dezembro') ? 'selected' : '' ?>>Dezembro</option>
                        </select>
                    </div>

                    <div class="select">
                        <label>Ano: </label>
                        <select name="ano" class="form-control" id="select" required>
                            <option <?= ($ano == '') ? 'selected' : '' ?>>Ano</option>
                            <option <?= ($ano == '2017') ? 'selected' : '' ?>>2017</option>
                            <option <?= ($ano == '2018') ? 'selected' : '' ?>>2018</option>
                            <option <?= ($ano == '2019') ? 'selected' : '' ?>>2019</option>
                            <option <?= ($ano == '2020') ? 'selected' : '' ?>>2020</option>
                            <option <?= ($ano == '2021') ? 'selected' : '' ?>>2021</option>
                            <option <?= ($ano == '2022') ? 'selected' : '' ?>>2022</option>
                            <option <?= ($ano == '2023') ? 'selected' : '' ?>>2023</option>
                            <option <?= ($ano == '2024') ? 'selected' : '' ?>>2024</option>
                            <option <?= ($ano == '2025') ? 'selected' : '' ?>>2025</option>
                            <option <?= ($ano == '2026') ? 'selected' : '' ?>>2026</option>
                            <option <?= ($ano == '2027') ? 'selected' : '' ?>>2027</option>
                            <option <?= ($ano == '2028') ? 'selected' : '' ?>>2028</option>
                            <option <?= ($ano == '2029') ? 'selected' : '' ?>>2029</option>
                            <option <?= ($ano == '2030') ? 'selected' : '' ?>>2030</option>
                        </select>
                    </div>

                    <div class="select">
                        <label>Secretaria: </label>
                        <select name="secretaria" class="form-control" id="select" required>
                            <option <?= ($secretaria == '') ? 'selected' : '' ?>>Secretaria</option>
                            <option <?= ($secretaria == 'SEC SAÚDE') ? 'selected' : '' ?>>SEC SAÚDE</option>
                            <option <?= ($secretaria == 'SEC MEIO AMBIENTE') ? 'selected' : '' ?>>SEC MEIO AMBIENTE</option>
                            <option <?= ($secretaria == 'SEC INFRAESTRUTURA') ? 'selected' : '' ?>>SEC INFRAESTRUTURA</option>
                            <option <?= ($secretaria == 'SEC ESPORTE') ? 'selected' : '' ?>>SEC ESPORTE</option>
                            <option <?= ($secretaria == 'SEC EDUCAÇÃO (FUNDEB)') ? 'selected' : '' ?>>SEC EDUCAÇÃO (FUNDEB)</option>
                            <option <?= ($secretaria == 'SEC EDUCAÇÃO (FME)') ? 'selected' : '' ?>>SEC EDUCAÇÃO (FME)</option>
                            <option <?= ($secretaria == 'SEC CULTURA') ? 'selected' : '' ?>>SEC CULTURA</option>
                            <option <?= ($secretaria == 'SEC ASSIST. SOCIAL') ? 'selected' : '' ?>>SEC ASSIST. SOCIAL</option>
                            <option <?= ($secretaria == 'SEC AGRICULTURA') ? 'selected' : '' ?>>SEC AGRICULTURA</option>
                            <option <?= ($secretaria == 'SEC ADM. E FINANÇAS') ? 'selected' : '' ?>>SEC ADM. E FINANÇAS</option>
                            <option <?= ($secretaria == 'PROJU') ? 'selected' : '' ?>>PROJU</option>
                            <option <?= ($secretaria == 'GABINETE') ? 'selected' : '' ?>>GABINETE</option>
                            <option <?= ($secretaria == 'CITRAN') ? 'selected' : '' ?>>CITRAN</option>
                        </select>
                    </div>

                    <div class="select">
                        <label>Quantidade de pastas: </label>
                        <input type="text" name="qnt_pastas" class="form-control" id="select" value="<?= $qnt_pastas ?>" required autocomplete="off">
                    </div>
                    <input type="text" name="id" value="<?= $id ?>" style="display: none;" required>

                    <div class="select">
                        <label>Quantidade de processos: </label>
                        <input type="text" name="qnt_proc" class="form-control" id="select" value="<?= $qnt_proc ?>" required autocomplete="off">
                    </div>
                    <div class="buttons">
                        <a href="remover-processo.php?id=<?=$id;?>" id="btn-remove" onclick="return confirm('Tem certeza que deseja excluir?');">Remover</a>
                        <button type="submit" onclick="return confirm('Tem certeza que deseja Editar?');">Editar</button>
                    </div>
                </div>
            </form>
        <?php } ?>
        </section>


        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>