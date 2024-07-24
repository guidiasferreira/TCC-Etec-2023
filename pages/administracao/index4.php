<?php   
    
    session_start();
    include_once "../../templates/sistemas_php/config.php";
    include_once "../../templates/sistemas_php/registro.php";

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
    <title>Registro</title>
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../assets/css/adm4.css">
</head>

<body>
    <header>
        <h1>Painel de registro</h1>
    </header>
    <div class="container">
        <?php require_once "../../templates/sidebar.php"; ?>
        <main>

            <label for="registro" id="label">
            <?php if(isset($_SESSION['msg'])) { echo $_SESSION['msg']; unset($_SESSION['msg']); } ?>
                <h1>O que deseja registrar?</h1>
            </label>
            <form action="" method="POST">
                <select id="registro">
                    <option selected></option>
                    <option value="autor" id="autor">Autor</option>
                    <option value="editora" id="editora">Editora</option>
                    <option value="categoria" id="categoria">Categoria</option>
                </select>
                <button onclick="verificarSelecao()" id="btn">Confirmar</button>
                <div class="divInput display-none">
                    <input type="text"foc id="input" name="" placeholder="" required > <!-- onkeydown="return event.key =='Enter';" -->
                    <input type="submit" value="enviar" name="envio" id="envio">

                    <button onclick="voltar()">Voltar</button>
                </div>
            </form>
        </main>
    </div>

    <script src="../../assets/js/adm4.js"></script>
    <script src="../../assets/js/sidebar.js"></script>
</body>

</html>