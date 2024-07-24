<?php


    $dbhost = "Localhost";
    $dbUsername = "root";
    $dbPassword = null;
    $dbName = "tcc_biblioetec";


    try{
        $conexao = new PDO("mysql:host=$dbhost;dbname=" . $dbName, $dbUsername, $dbPassword);
    }catch(PDOException $err) {
        echo "Erro: Falha na conexão... Erro= " . $err->getMessage();
    }
    

    /* --------Testar a conexão com o banco---------- */

    /* if($conexao->connect_errno)
    {
        echo "Erro";
    }
    else 
    {
        echo "Conexão efetuada com sucesso";
    } */


?>