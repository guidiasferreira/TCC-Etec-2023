<?php

    session_start();
    include_once "../../templates/sistemas_php/config.php";

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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administração</title>
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../assets/css/adm.css">
</head>

<body>
    <header>
        <h1>PAINEL ADMINSTRATIVO</h1>
    </header>
    <div class="container">

        <?php require_once "../../templates/sidebar.php"; ?>

        <main>
            <div class="divImg"><img src="../../assets/img/foto-livros2.png"></div>
            <div class="painel">
                <h1>O que deseja fazer?</h1>
                <div class="flex">
                    <div class="box">
                        <a href="index3.php" class="btn">Registrar livro</a>
                    </div>
                    <div class="box">
                        <a href="index2.php" class="btn">Livros locados</a>
                    </div>
                </div>
                <div class="block">
                    <div class="box">
                        <a href="index4.php" class="btn">Inserir novo registro(autor,editora ou categoria)</a>
                    </div>
                </div>
            </div>
            <div class="divImg"><img src="../../assets/img/foto-livros2.png"></div>
        </main>
    </div>
    <script src="../../assets/js/sidebar.js"></script>

</body>

</html>