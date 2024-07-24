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
    } else {}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cadastro</title>
    <link rel="stylesheet" href="../../assets/css/cadastro.css">
    <!-- <link rel="shortcut icon" href="/img/icon.png" type="image/x-icon"> -->
</head>
<body>
    <div class="container">
        <main>
            <div class="main1">

                <?php
                    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

                    if (!empty($dados['SendCadastro'])) {
                        $query_usuario = "SELECT idusuario, email_usuario, senha_usuario FROM usuario WHERE email_usuario =:email_usuario  LIMIT 1";  //'" . $dados['usuario'] . "'
                        
                        $result_usuario = $conexao->prepare($query_usuario);
                        $result_usuario->bindParam(':email_usuario', $dados['email_usuario'], PDO::PARAM_STR);

                        $result_usuario->execute();

                        $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
                    }
                ?>

                <form name="cadastro" method="POST" action="envbanc.php">        
                    <h1 class="log">Cadastro</h1>
                    <input class="formButton" type="text" name="nome_usuario" placeholder="Digite seu nome" required>    
                    <input class="formButton" type="email" name="email_usuario" placeholder="Digite seu email" required>          
                    <input class="formButton" type="password" name="senha_usuario" placeholder="Digite sua senha" required>
                    <input class="formButton" type="password" name="senha_usuario" placeholder="Confirme sua senha" required>              
                    <input class="btn"   type="submit"   name="SendCadastro" value="Cadastrar" >
                    <p class="conta"> Possui conta? <a id="cadas" href="../login/login.php">Entrar</a></p>   
                </form>
                    
            </div>
            <div class="main2">
                <div>
                    <h1>Bem-vindo!</h1> 
                    <p class="msg">Confirme seus dados para fazer o cadastro</p>
                </div>
                
            </div>
         
        </main>
    </div>
</body>
</html>