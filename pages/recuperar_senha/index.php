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

        header("Location: ../home/.php");

        } else {
            
        }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperação de Senha</title>
    <link rel="stylesheet" href="../../assets/css/rec.css">
    <link rel="shortcut icon" href="/img/icon.png" type="image/x-icon">
</head>
<body>
    <div class="container">
        <main>

            <form name="recup" method="POST" action="">
                <h1 class="log">Recuperar Senha</h1>
                <?php
                $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

                if (!empty($dados['SendRecSenha'])) {


                    $query_usuario = "SELECT idusuario, email_usuario FROM usuario WHERE email_usuario = :email_usuario  LIMIT 1";  //'" . $dados['email'] . "'

                    $result_usuario = $conexao->prepare($query_usuario);
                    $result_usuario->bindParam(':email_usuario', $dados['email_usuario'], PDO::PARAM_STR);

                    $result_usuario->execute();

                    if (($result_usuario) and ($result_usuario->rowCount() != 0)) {
                        $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);

                        $chave_RecSenha = password_hash($row_usuario['idusuario'], PASSWORD_DEFAULT);


                        $query_up_usuario = "UPDATE usuario SET recuperar_senha_usuario = :recuperar_senha_usuario WHERE idusuario = :idusuario LIMIT 1";

                        $result_up_usuario = $conexao->prepare($query_up_usuario);
                        $result_up_usuario->bindParam(':recuperar_senha_usuario', $chave_RecSenha, PDO::PARAM_STR);
                        $result_up_usuario->bindParam(':idusuario', $row_usuario['idusuario'], PDO::PARAM_INT);

                        if ($result_up_usuario->execute()) {
                            echo "http://localhost/TCC/TCC/pages/atualizar_senha/index.php?chave=$chave_RecSenha";
                        } else {
                            $_SESSION['inf'] = "<p> Tente Novamente </p";
                        }



                        /* $_SESSION['inf'] = "<p> Link enviado para o email informado </p>"; */
                    } else {
                        $_SESSION['inf'] = "<p> Email não cadastrado </p>";
                    }
                }

                ?>
                <?php if (isset($_SESSION['inf'])) {
                    echo $_SESSION['inf'];
                    unset($_SESSION['inf']);
                } ?>

                <input class="prenc" type="email" name="email_usuario" placeholder="Digite seu email" required>
                <input class="prenc" type="email" name="email_usuario" placeholder="Confirme seu email" required>
                <input type="submit" value="Enviar" name="SendRecSenha" class="btn">
            </form>
        </main>

    </div>
</body>

</html>