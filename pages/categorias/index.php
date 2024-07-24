<?php

    session_start();
    include_once "../../templates/sistemas_php/pesquisa.php";
    include_once "../../templates/sistemas_php/config.php";
    if ($_SESSION['id_usuario']) {
        
        
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
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../assets/css/categorias.css">
    <!-- <link rel="stylesheet" href="../../assets/css/home.css"> -->
    <title> Categorias </title>
</head>

<body>

    <script src="../../assets/js/sidebar.js" defer></script> 
    <!-- <script src="../../assets/js/home.js" defer></script> -->
    <script src="../../assets/js/searchinput.js" defer></script>

    <?php require_once "../../templates/header.php"; ?>

    <div class="container">

        <?php require_once "../../templates/sidebar.php"; ?>
        <main>
            <div class="conteudo">
                <div class="teste">
                <div class="divBox">
                
                    <?php
                        if (isset($_GET['busca_livros'])) { 
                            if (count($resultados)) {
                                foreach($resultados as $resultado) {
                                    $capa_id = $resultado['capas_idcapas'];
                                    $livro_id = $resultado['idlivros'];


                                    $sql_capas_busca = 'SELECT idcapas, local_capas FROM capas WHERE idcapas = :id_capas';
                                    $capas_busca = $conexao->prepare($sql_capas_busca);
                                    $capas_busca->bindParam(':id_capas', $capa_id, PDO::PARAM_INT);
                                    $capas_busca->execute();
                                    
                                    $capa = $capas_busca->fetch(PDO::FETCH_ASSOC);



                                    echo "<div class='box'>
                                            <img src='" . $capa['local_capas'] . "' alt='Capa' class='image'>
                                            <div class='boxText'>
                                                <a href='../agendamento/index.php?id=$livro_id' >" . $resultado['nome_livros'] . "</a>
                                            </div>
                                          </div>";
                                }
                            }
                            } elseif (isset($_GET['busca_categoria'])) {

                                if (count($resultados)) {
                                    foreach($resultados as $resultado) {
                                        $capa_id = $resultado['capas_idcapas'];
                                        $livro_id = $resultado['idlivros'];
    
    
                                        $sql_capas_busca = 'SELECT idcapas, local_capas FROM capas WHERE idcapas = :id_capas';
                                        $capas_busca = $conexao->prepare($sql_capas_busca);
                                        $capas_busca->bindParam(':id_capas', $capa_id, PDO::PARAM_INT);
                                        $capas_busca->execute();
                                        
                                        $capa = $capas_busca->fetch(PDO::FETCH_ASSOC);
    
    
    
                                        echo "<div class='box'>
                                                <img src='" . $capa['local_capas'] . "' alt='Capa' class='image'>
                                                <div class='boxText'>
                                                    <a href='../agendamento/index.php?id=$livro_id' >" . $resultado['nome_livros'] . "</a>
                                                </div>
                                              </div>";
                                    }


                                }

                            } else {
                                foreach($geral_livros as $geral_livro) {
                                    $capa_id = $geral_livro['capas_idcapas'];
                                    $livro_id = $geral_livro['idlivros'];


                                    $sql_capas_busca = 'SELECT idcapas, local_capas FROM capas WHERE idcapas = :id_capas';
                                    $capas_busca = $conexao->prepare($sql_capas_busca);
                                    $capas_busca->bindParam(':id_capas', $capa_id, PDO::PARAM_INT);
                                    $capas_busca->execute();
                                    
                                    $capa = $capas_busca->fetch(PDO::FETCH_ASSOC);



                                    echo "<div class='box'>
                                            <img src='" . $capa['local_capas'] . "' alt='Capa' class='image'>
                                            <div class='boxText'>
                                                <a href='../agendamento/index.php?id=$livro_id' >" . $geral_livro['nome_livros'] . "</a>
                                            </div>
                                          </div>";
                                }
                                
                                /* echo "<p> Não foi encontrado resultados pelo termo buscado... </p>"; */
                            }
                        
                    ?>
                    
                </div>
                </div>
                
            </div>
        </main>
    </div>
    
    <script src="../../assets/js/sidebar.js"></script>
</body>

</html>