<?php
/* 
    if (isset($_POST['SendCadastro']) && !empty($_POST['nome']) && !empty($_POST['email']) && !empty($_POST['senha']) )
        {

            include_once('../sistemas_php/config.php');

            $nome = $_POST ['nome'];
            $email = $_POST ['email'];
            $senha = $_POST ['senha'];


            $result = $conexao->prepare("INSERT INTO usuario(nome,email,senha) VALUES ('$nome','$email', AES_ENCRYPT('$senha','chave'))");

            $result->bindParam(1, $nome);
            $result->bindParam(2, $email);
            $result->bindParam(3, $senha);

            $result->execute();

            header('location: ../login/login.php');

        }

    else
    {
        echo "Erro no cadastro";
    }



 */



    if (isset($_POST['SendCadastro']) && !empty($_POST['nome_usuario']) && !empty($_POST['email_usuario']) && !empty($_POST['senha_usuario']))
    {

        include_once "../../templates/sistemas_php/config.php";

        $nome = $_POST['nome_usuario'];
        $email = $_POST['email_usuario'];
        $senha = $_POST['senha_usuario'];
        $senha = password_hash("$senha", PASSWORD_DEFAULT);
    
        $stmt = $conexao->prepare("INSERT INTO usuario (nome_usuario, email_usuario, senha_usuario) VALUES (?, ?, ?)");
        $stmt->bindParam(1, $nome);
        $stmt->bindParam(2, $email);
        $stmt->bindParam(3, $senha);
        $stmt->execute();
    
        header('Location: ../login/login.php');
        exit();
    }
    else
    {
        echo "Erro no cadastro";
    }
 










