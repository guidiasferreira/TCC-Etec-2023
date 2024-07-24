<?php

session_start();
include_once "../../templates/sistemas_php/config.php";
include_once "../../templates/sistemas_php/info_alunos.php";

if (isset($_SESSION['id_usuario'])) {

    $sql_verif_log = "SELECT idusuario, nome_usuario FROM usuario WHERE idusuario = :id_usuario";
    $verif_log = $conexao->prepare($sql_verif_log);
    $verif_log->bindParam(':id_usuario', $_SESSION['id_usuario']);
    $verif_log->execute();
    $info_log = $verif_log->fetch(PDO::FETCH_ASSOC);
    $id_usuario_log = $info_log['idusuario'];
    $nome_usuario_log = $info_log['nome_usuario'];
} else {
    header("Location: ../login/login.php");
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adm</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../assets/css/adm2.css">
</head>
<body>
    <?php require_once "../../templates/header.php"; ?>
    <div class="container">
        <?php require_once "../../templates/sidebar.php"; ?>
        <main>
            <div class="conteudo">
                <div class="box box1" id="box">
                    <div class="column pessoa">
                        <p>Nome do(a) Aluno(a)</p>
                    </div>
                    <div class="column livro">
                        <p>Nome do Livro</p>
                    </div>
                    <div class="column data">
                        <p>Data de agendamento</p>
                    </div>
                    <div class="column devolucao">
                        <p>Data de devolução</p>
                    </div>
                    <div class="column rg">
                        <p>RG do aluno</p>
                    </div>
                    <div class="vazio"></div>
                </div>
            </div>

            <?php

            if (isset($exibicao_emprestimo)) {
                echo "<div class='dados-alunos'>$exibicao_emprestimo</div>";
            }
            ?>
    </main>
    </div>
    <script src="../../assets/js/sidebar.js"></script>
</body>
</html>