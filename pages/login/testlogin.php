<?php 


    if(isset($_POST['submit']) && !empty($_POST['email_usuario']) && !empty($_POST['senha_usuario']) )
    {
        /* acessa */
        include_once "../../templates/sistemas_php/config.php";
        $email = $_POST['email_usuario'];
        $senha = $_POST['senha_usuario'];

        $sql = "SELECT * FROM usuario WHERE email_usuario = '$email' and senha_usuario = '$senha'";

        $result = $conexao->query($sql);

        header('Location: ../home/index.html');
    }
    else
    {
        /* Não acessa */
        header('Location: login.php');
        echo "Não foi possível estabelecer conexão";
    }


?>