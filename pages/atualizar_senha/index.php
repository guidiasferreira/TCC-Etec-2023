<?php
    session_start();
    include_once "../../templates/sistemas_php/config.php";
    if ($_SESSION['id_usuario']) {
        
        $sql_verif_log = "SELECT idusuario, nome_usuario FROM usuario WHERE idusuario = :id_usuario";
        $verif_log = $conexao->prepare($sql_verif_log);
        $verif_log->bindParam(':id_usuario', $_SESSION['id_usuario']);
        $verif_log->execute();
    
        $info_log = $verif_log->fetch(PDO::FETCH_ASSOC);
        $id_usuario_log = $info_log['idusuario'];
        $nome_usuario_log = $info_log['nome_usuario'];
    
        header("Location: ../home/index.php");
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Senha</title>
    <link rel="stylesheet" href="../../assets/css/atualizar.css">
    <link rel="shortcut icon" href="/img/icon.png" type="image/x-icon">
</head>
<body>
    <div class="container">
            <div class="main2">

            <?php

                $chave = filter_input(INPUT_GET, 'chave', FILTER_DEFAULT);
                if (!empty($chave)) {
                    

                    $query_usuario = "SELECT idusuario FROM usuario WHERE recuperar_senha_usuario = :recuperar_senha_usuario  LIMIT 1";  //'" . $dados['email'] . "'
                                
                    $result_usuario = $conexao->prepare($query_usuario);
                    $result_usuario->bindParam(':recuperar_senha_usuario', $chave, PDO::PARAM_STR);

                    $result_usuario->execute();

                    if (($result_usuario) AND ($result_usuario->rowCount() != 0)){
                        $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
                        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                        
                        if (!empty($dados['SendNovaSenha'])){
                            $senhaNova = password_hash($dados['senha_usuario'], PASSWORD_DEFAULT);

                            $query_up_usuario = "UPDATE usuario SET senha_usuario = :senhaNova WHERE idusuario = :idusuario LIMIT 1";

                            $result_up_usuario = $conexao->prepare($query_up_usuario);
                            $result_up_usuario->bindParam(':senhaNova', $senhaNova, PDO::PARAM_STR);
                            $result_up_usuario->bindParam(':idusuario', $row_usuario['idusuario'], PDO::PARAM_INT);

                            if($result_up_usuario->execute()){
                                $_SESSION['Inf'] = "<p> Senha Atualizada com Sucesso!";
                                header("refresh:3;url=");
                            }else{
                                $_SESSION['inf'] = "<p> Tente Novamente </p";
                            }

                        }else{

                        }
                    }else{
                        $_SESSION['inf'] = "<p> Link Inválido, solicite um novo link! </p>";
                        header("Location: ../recuperar_senha/index.php");
                    }
                }else{
                    $_SESSION['inf'] = "<p> Link Inválido, solicite um novo link! </p>";
                    header("Location: ../recuperar_senha/index.php");
                }
                
            ?>
            


                <form name="login" method="POST" action="">        
                        <h1 class="log">Atualizar Senha</h1>   
                        <?php  if(isset($_SESSION['info'])) { echo $_SESSION['info']; unset($_SESSION['inf']);}  ?>  
                        <input class="prenc" type="password" name="senha_usuario" placeholder="Digite sua nova senha" required> 
                        <input class="prenc" type="password" name="senha_usuario" placeholder="Confirmar senha" required>                     
                            <input type="submit" value="Atualizar" name="SendNovaSenha" class="btn">
                </form>
            </div>
        </main>
    </div>
</body>
</html>