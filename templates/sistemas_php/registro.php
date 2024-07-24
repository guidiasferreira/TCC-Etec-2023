<?php

    if (isset($_POST['envio'])) {

        function inserirOuVerificar($conexao, $nome_tabela, $tabela, $valor) {
            $consulta_sql = "SELECT * FROM $tabela WHERE $nome_tabela LIKE :valor";
            $consultar = $conexao->prepare($consulta_sql);
            $consultar->bindParam(":valor", $valor);
            $consultar->execute();
            $result = $consultar->rowCount();
            
            if ($result > 0) {
                $_SESSION['msg'] = "<h1 class='erro'>Erro: Já possui este $tabela!</h1>";
            } else {
                $inserir_sql = "INSERT INTO $tabela ($nome_tabela) VALUES (:valor)";
                $inserir = $conexao->prepare($inserir_sql);
                $inserir->bindParam(":valor", $valor);
                $inserir->execute();
                header("Location: ./index4.php");
                exit;
            }
        }
        
        if (isset($_POST['autor'])) {
            $nome_autor = $_POST['autor'];
            inserirOuVerificar($conexao, 'nome_autor', 'autor', $nome_autor);
        } elseif (isset($_POST['categoria'])) {
            $nome_categoria = $_POST['categoria'];
            inserirOuVerificar($conexao, 'nome_categoria', 'categoria', $nome_categoria);
        } elseif (isset($_POST['editora'])) {
            $nome_editora = $_POST['editora'];
            inserirOuVerificar($conexao, 'nome_editora', 'editora', $nome_editora);
        }




        
        /* if (isset($_POST['autor'])){
            $nome_autor = $_POST['autor'];

            $consulta_autor_sql = "SELECT nome_autor FROM autor WHERE nome_autor LIKE :nome_autor";
            $consultar_autor = $conexao->prepare($consulta_autor_sql);
            $consultar_autor->bindParam(":nome_autor", $nome_autor);
            $consultar_autor->execute();
            $result_consultar_autor = $consultar_autor->rowCount();
               
            if ($result_consultar_autor > 0){
                $_SESSION['msg'] = "<h1 class='erro'>Erro: Já possuí este autor!</h1>";
            } else{

            $inserir_sql = "INSERT INTO autor (nome_autor) VALUES (:nome_autor)";
            $inserir_autor = $conexao->prepare($inserir_sql);
            $inserir_autor->bindParam(":nome_autor", $nome_autor);
            $inserir_autor->execute();
            header("Location: ./index4.php");
            exit;
            }
            
        } 
        elseif (isset($_POST['categoria'])){
            $nome_categoria = $_POST['categoria'];

            $consulta_categoria_sql = "SELECT nome_categoria FROM categoria WHERE nome_categoria LIKE :nome_categoria";
            $consultar_categoria = $conexao->prepare($consulta_categoria_sql);
            $consultar_categoria->bindParam(":nome_categoria", $nome_categoria);
            $consultar_categoria->execute();
            $result_consultar_categoria = $consultar_categoria->rowCount();
               
            if ($result_consultar_categoria > 0){
                $_SESSION['msg'] = "<h1 class='erro'>Erro: Já possuí este categoria!</h1>";
            } else{

            $inserir_sql = "INSERT INTO categoria (nome_categoria) VALUES (:nome_categoria)";
            $inserir_categoria = $conexao->prepare($inserir_sql);
            $inserir_categoria->bindParam(":nome_categoria", $nome_categoria);
            $inserir_categoria->execute();
            header("Location: ./index4.php");
            exit;
            }
        }
        elseif (isset($_POST['editora'])){
            $nome_editora = $_POST['editora'];

            $consulta_editora_sql = "SELECT nome_editora FROM editora WHERE nome_editora LIKE :nome_editora";
            $consultar_editora = $conexao->prepare($consulta_editora_sql);
            $consultar_editora->bindParam(":nome_editora", $nome_editora);
            $consultar_editora->execute();
            $result_consultar_editora = $consultar_editora->rowCount();
               
            if ($result_consultar_editora > 0){
                $_SESSION['msg'] = "<h1 class='erro'>Erro: Já possuí este editora!</h1>";
            } else{

            $inserir_sql = "INSERT INTO editora (nome_editora) VALUES (:nome_editora)";
            $inserir_editora = $conexao->prepare($inserir_sql);
            $inserir_editora->bindParam(":nome_editora", $nome_editora);
            $inserir_editora->execute();
            header("Location: ./index4.php");
            exit;
            }
        } */
        
    }

    
    
























    
?>



