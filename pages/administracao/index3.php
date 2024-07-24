<?php
session_start();

include_once "../../templates/sistemas_php/config.php";
include_once "../../templates/sistemas_php/upload.php";
include_once "../../templates/sistemas_php/option.php";

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
    <title>Registro de Livros</title>
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <link rel="shortcut icon" href="/img/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../../assets/css/adm3.css">
    <script src="../../assets/js/jquery-3.5.1.min.js"></script>
    <link href="../../assets/css/select2.min.css" rel="stylesheet" />
    <script src="../../assets/js/select2.min.js"></script>
</head>
<body>
    <div class="container">
        <?php require_once "../../templates/sidebar.php"; ?>
        <main>
            <form class="box" method="POST" enctype="multipart/form-data" action="">
                <div class="left">
                    <div class="text">
                        <h1>Informações</h1>
                        <div class="divInput">
                            <label for="nomeLivro">Digite o nome do livro</label>
                            <input type="text" name="nome_livros" id="nomeLivro" required>
                        </div>
                        <div class="divInput">
                            <label for="autor">Selecione um autor</label>
                            <select id="autor" name="nome_autor[]" multiple="multiple" required>
                            <?php
                                    try {
                                        foreach ($nomes_dos_autores as $nome_autor) {
                                                echo "<option value='$nome_autor'>$nome_autor</option>";
                                            }
                                        
                                    } catch (PDOException $e) {
                                        echo "erro";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="divInput">
                            <label for="editora">Selecione uma editora</label>
                            <select id="editora" name="nome_editora" required>
                                <option value=""></option>
                                <?php
                                    try {
                                        foreach ($nomes_das_editoras as $nome_editora) {
                                                echo "<option value='$nome_editora'>$nome_editora</option>";
                                            }
                                        
                                    } catch (PDOException $e) {
                                        echo "erro";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="divInput" id="category">
                            <label for="categorias">Categoria</label>
                            <select id="categorias" name="nome_categoria[]" multiple="multiple" required>
                            <?php
                                    try {
                                        foreach ($nomes_das_categorias as $nome_categoria) {
                                                echo "<option value='$nome_categoria'>$nome_categoria</option>";
                                            }
                                        
                                    } catch (PDOException $e) {
                                        echo "erro";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="right">
                    <h1>Capa do livro</h1>
                    <label class="picture" for="input">
                        <span class="pictureImage">
                        </span>
                    </label>
                    <input type="file" name="imagem_capas" id="input" required>
                    <input type="submit" name="sendLivros" value="Enviar" class="btn btn1">
                </div>
            </form>
        </main>
    </div>
    <script src="../../assets/js/insertImg.js"></script>
    <script src="../../assets/js/sidebar.js"></script>
    <script src="../../assets/js/adm3.js"></script>
</body>
</html>