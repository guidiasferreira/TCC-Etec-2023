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

        header("Location: ../home/index.php");

    }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../../assets/css/login.css">
    <!-- <link rel="shortcut icon" href="/img/icon.png" type="image/x-icon"> -->
</head>
<body>
    <div class="container">
        <main>
            <div class="main1">
                <div>
                    <h1>Bem-vindo!</h1> 
                    <p class="msg">Você pode logar para acessar sua conta.</p>
                </div>
            </div>
            <div class="main2">
                
                    <?php
                        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

                        if (!empty($dados['SendLogin'])) {
                            $query_usuario = "SELECT idusuario, email_usuario, senha_usuario FROM usuario WHERE email_usuario = :email_usuario  LIMIT 1";  //'" . $dados['email'] . "'
                            
                            $result_usuario = $conexao->prepare($query_usuario);
                            $result_usuario->bindParam(':email_usuario', $dados['email_usuario'], PDO::PARAM_STR);

                            $result_usuario->execute();



                            if (($result_usuario) AND ($result_usuario->rowCount() != 0)){
                                $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
                                
                                if(password_verify($dados['senha_usuario'], $row_usuario['senha_usuario'])){
                                    
                                    $_SESSION['id_usuario'] = $row_usuario['idusuario'];
                                    $_SESSION['nome_usuario'] = $row_usuario['nome_usuario'];
                                    header("Location: ../home/index.php");  /* refresh:3;url= ../home/index.php */
                                }else{
                                    $_SESSION['inf'] = "<p class='inf'> Email ou senha Inválida! </p>";
                                }
                            }else{
                                $_SESSION['inf'] = "<p class='inf'> Email ou Senha Inválida! </p>";
                            }
                            
                        }

                        
                    ?>

                <form name="login" method="POST" action="">        
                        <h1 class="log">Login</h1>
                        <?php if(isset($_SESSION['inf'])) { echo $_SESSION['inf']; unset($_SESSION['inf']); } ?>  <!-- Mensagem de erro -->   
                        <input class="formButton" type="email" name="email_usuario" placeholder="Digite seu email" value="<?php if(isset($dados['email'])){ echo $dados['email']; } ?>" required>             
                        <input class="formButton" type="password" name="senha_usuario" placeholder="Digite sua senha" value="<?php if(isset($dados['senha'])){ echo $dados['senha']; } ?>" required>          
                        <input type="submit" value="Entrar" name="SendLogin" class="btn">
                        <a class="senha" href="../recuperar_senha/index.php">Esqueceu a senha?</a>
                        <p class="conta"> Não possui conta? <a id="cadas" href="../cadastro/index.php">cadastre-se</a></p>   
                </form>
            </div>
        </main>
    </div>
</body>
</html>