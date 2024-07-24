<?php 
    
    
    session_start();
    include_once "../../templates/sistemas_php/config.php";
    include_once '../../templates/sistemas_php/exibicao.php';
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
    <title>Home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../assets/css/home.css">
    
</head>

<body>
    <?php require_once "../../templates/header.php"; ?>

    <div class="container">

        <?php require_once "../../templates/sidebar.php"; ?>
        
        <main>
            <div class="conteudo">
                <div class="divCarousels">

                    <?php require_once "../../templates/carouselLiteratura.php"; ?>
                    
                    <?php require_once "../../templates/carouselHumanas.php"; ?>

                </div>
                <div class="meio">
                    <img src="../../assets/img/banner.png">
                </div>
                <div class="divCarousels">

                    <?php require_once "../../templates/carouselExatas.php"; ?>

                    <?php require_once "../../templates/carouselBiologicas.php";?>

                </div>
                <?php require_once "../../templates/footer.php";?>
            </div>
        </main>
    </div>
    <script src="../../assets/js/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="../../assets/js/sidebar.js"></script>
    <script src="../../assets/js/home.js"></script>
    <!-- <script src="../../assets/js/header.js"></script> -->
    <script src="../../assets/js/searchinput.js"></script>
    
    
</body>

</html>