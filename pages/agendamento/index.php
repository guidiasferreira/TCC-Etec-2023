<?php 

    session_start();
    
    include_once '../../templates/sistemas_php/config.php';
    include_once '../../templates/sistemas_php/info_livro.php';
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
    include_once "../../templates/sistemas_php/emprestimo.php";
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" /> -->
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../assets/css/agendamento.css">
    <title>Página de agendamento</title>
</head>

<body>


    <div class="container">
        <?php require_once "../../templates/sidebar.php"; ?>
        <main>
            <div class="box">
            <div class="left">
                    <div class="titulo">
                        <h1>Capa do livro</h1>
                    </div>
                    <div class="picture">
                        <div class="pictureImg">
                            <img src=" <?php echo $local_capa ?> " alt="erro" class="pictureImg">
                        </div>
                    </div>
                </div>
                <form class="right" action="" method="POST" id="agendamento">
                    <div class="titulo">
                        <input type="reset" value="" id="voltarButton">
                        <h1 class="info">Agendamento</h1>
                    </div>
                    <div class="agendamento">
                        <input class="prenc" type="text" name="nome_usuario" placeholder="Digite seu nome" required>
                        <input class="prenc" type="number" name="telefone_usuario" placeholder="Digite seu numero de telefone" required>
                        <input class="prenc" type="text" name="rg_usuario" placeholder="Digite seu RG" required>
                        <input type="submit" class="btn btn1" value="Agendar" name="agendar_livro">
                    </div>
                </form>
                <div class="right" id="informacoes">
                    <div class="titulo">
                        <h1>Informações</h1>
                    </div>

                    <div class="informacoes">
                        <div class="info">
                            <p> <u> Nome do livro:</u> <?php echo $nome_livro; ?> </p>
                            <p> <u>Autores: </u><?php echo rtrim($nome_autor, ', '); ?> </p>
                            <p> <u> Editora:</u> <?php echo $nome_editora; ?> </p>
                            <p> <u>Categorias:</u> <?php echo rtrim($nome_categoria, ', '); ?> </p>
                        </div>
                        <input type="button" value="Agendar" id="agendarButton" class="btn">
                    </div>
                </div>

            </div>
        </main>
    </div>


    <script src="../../assets/js/insertImg.js"></script>
    <script src="../../assets/js/agendamento.js"></script>
    <script src="../../assets/js/sidebar.js"></script>

</body>

</html>