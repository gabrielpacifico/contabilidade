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
    <link rel="stylesheet" href="../css/respose.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    <title>Contabilidade - Cadastro Processos</title>
</head>

<body>

    <?php include_once('../includes/navbar.html'); ?>

    <section class="formarea">
        <h1>Cadastro de Processos</h1>
        <i class="fa-solid fa-angles-left" onclick="window.location.href='main-menu.php'"></i>

        <?php
        if (isset($_SESSION['duplicado'])) {
        ?>

            <div class="center"><span>Cadastro duplicado, tente novamente!</span></div>

        <?php
        }
        unset($_SESSION['duplicado'])
        ?>

        <form action="insert-processo.php" method="POST" class="bootstrap-iso">
            <div class="form-group" id="formulario">
                <div class="select">
                    <label>Mês: </label>
                    <select name="mes" class="form-control" id="select" required>
                        <option value="" selected>Mês</option>
                        <option value="Janeiro">Janeiro</option>
                        <option value="Fevereiro">Fevereiro</option>
                        <option value="Março">Março</option>
                        <option value="Abril">Abril</option>
                        <option value="Maio">Maio</option>
                        <option value="Junho">Junho</option>
                        <option value="Julho">Julho</option>
                        <option value="Agosto">Agosto</option>
                        <option value="Setembro">Setembro</option>
                        <option value="Outubro">Outubro</option>
                        <option value="Novembro">Novembro</option>
                        <option value="Dezembro">Dezembro</option>
                    </select>
                </div>

                <div class="select">
                    <label>Ano: </label>
                    <select name="ano" class="form-control" id="select" required>
                        <option value="" selected>Ano</option>
                        <option value="2017">2017</option>
                        <option value="2018">2018</option>
                        <option value="2019">2019</option>
                        <option value="2020">2020</option>
                        <option value="2021">2021</option>
                        <option value="2022">2022</option>
                        <option value="2023">2023</option>
                        <option value="2024">2024</option>
                        <option value="2025">2025</option>
                        <option value="2026">2026</option>
                        <option value="2027">2027</option>
                        <option value="2028">2028</option>
                        <option value="2029">2029</option>
                        <option value="2030">2030</option>
                    </select>
                </div>

                <div class="select">
                    <label>Secretaria: </label>
                    <select name="secretaria" class="form-control" id="select" required>
                        <option value="" selected>Secretaria</option>
                        <?php
                        $sql = "SELECT * FROM secretarias ORDER BY secretaria DESC";
                        $query = mysqli_query($conexao, $sql);
                        while ($array = mysqli_fetch_assoc($query)) {
                            $sec = $array['secretaria'];
                            echo "<option value='$sec'>$sec</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="select">
                    <label>Quantidade de pastas: </label>
                    <input type="text" name="qnt_pastas" class="form-control" id="select" placeholder="Quantidade de pastas" required autocomplete="off">
                </div>

                <div class="select">
                    <label>Quantidade de processos: </label>
                    <input type="text" name="qnt_proc" class="form-control" id="select" placeholder="Quantidade de processos" required autocomplete="off">
                </div>
                <button type="submit" onclick="return confirm('Tem certeza que deseja cadastrar?')">Cadastrar</button>
            </div>
        </form>
    </section>


    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>