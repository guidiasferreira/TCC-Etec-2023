<?php

    

    if (isset($_POST['sendLivros']) && isset($_FILES['imagem_capas']) && isset($_POST['nome_livros']) && isset($_POST['nome_categoria']) && isset($_POST['nome_editora']) && isset($_POST['nome_autor'])) {

        $arquivo = $_FILES['imagem_capas'];
        
        $autores = isset($_POST['nome_autor']) ? $_POST['nome_autor'] : array();
        $categorias = isset($_POST['nome_categoria']) ? $_POST['nome_categoria'] : array();

        $nome_livros = $_POST['nome_livros'];
        $nome_editora = $_POST['nome_editora'];
        

        $sql = "SELECT * FROM livros WHERE nome_livros = :nome_livros";
        $consulta = $conexao->prepare($sql);
        $consulta->bindParam(":nome_livros", $nome_livros);
        $consulta->execute();

        $result_consulta_livros = $consulta->fetch(PDO::FETCH_ASSOC);
        $row_result_consulta_livros = $consulta->rowCount();

        /* echo '<pre>';
        var_dump($result_consulta_livros);
        echo '</pre>'; */
        
        if ($row_result_consulta_livros > 0) {

            $qnt_atual = $result_consulta_livros['qnt_livros'];
            $qnt_nova = $qnt_atual + 1;
            $update_sql = $conexao->prepare("UPDATE livros SET qnt_livros = :qnt_livros WHERE nome_livros = :nome_livros");
            $update_sql->bindParam(":qnt_livros", $qnt_nova);
            $update_sql->bindParam(":nome_livros", $nome_livros);
            $update_sql->execute();
                $_SESSION['msg'] = "<p> Um livro igual foi adicionado para o sistema! </p";

        } else {

            /* $sql_categoria = "SELECT idcategoria FROM categoria WHERE nome_categoria = :nome_categoria";
            $convert_sql_categoria = $conexao->prepare($sql_categoria);
            $convert_sql_categoria->bindParam(':nome_categoria', $nome_categoria);
            $convert_sql_categoria->execute();
            $result_consulta_categoria = $convert_sql_categoria->fetch(PDO::FETCH_ASSOC);
            $row_result_consulta_categoria = $convert_sql_categoria->rowCount();

            if ($row_result_consulta_categoria > 0) {
                $categoria_id_convert = $result_consulta_categoria['idcategoria'];
            } else {
                die($_SESSION['err'] = "<p> Erro: Categoria não encontrada em nosso sistema! </p");
            } */
            

            $sql_editora = "SELECT ideditora FROM editora WHERE nome_editora = :nome_editora";
            $convert_sql_editora = $conexao->prepare($sql_editora);
            $convert_sql_editora->bindParam(':nome_editora', $nome_editora);
            $convert_sql_editora->execute();
            $result_consulta_editora = $convert_sql_editora->fetch(PDO::FETCH_ASSOC);
            $row_result_consulta_editora = $convert_sql_editora->rowCount();

            if ($row_result_consulta_editora > 0) {
                $editora_id_convert = $result_consulta_editora['ideditora'];
            } else {
                die($_SESSION['err'] = "<p> Erro: editora não encontrada em nosso sistema! </p");
            }
        



            if ($arquivo['size'] > 2097152 ) {              /* 2097152 bytes = 2 mb  Tamanhos: 1024 bytes = 1 kb // 1024 kb = 1 mb // 1024 mb = 1 gb */
                die("Arquivo muito grande! Limite: 2 mb!");
            }else{
                $pasta = "../../livros/random/gerar";
                $nome_arquivo = $arquivo['name'];
                $new_nome_arquivo = uniqid();
                $extensao = strtolower(pathinfo($nome_arquivo, PATHINFO_EXTENSION));
        
                if ($extensao != "jpg" && $extensao != "png" ) {
                    die("Tipo de arquivo não aceito! Apenas imagens em 'jpg' ou 'png'!");
                }else{
                    $caminho = $pasta . $new_nome_arquivo . "." . $extensao;
            
                    $save = move_uploaded_file($arquivo["tmp_name"], $caminho);
            
                    if ($save) {
                        $insert_capas_sql = "INSERT INTO capas (local_capas, nome_capas) VALUES (:local_capas , :nome_capas)";
                        $inserir_capas = $conexao -> prepare($insert_capas_sql);
                        $inserir_capas->bindParam(":local_capas", $caminho);
                        $inserir_capas->bindParam(":nome_capas", $nome_arquivo);
                        $inserir_capas->execute();

                        $capas_id_convert = $conexao->lastInsertId();
                        // echo "Enviado!!";
                    }else{
                        die ("<p> Erro ao enviar!!</p>"); 
                    }
                }
            }

            $insert_newlivro = "INSERT INTO livros (nome_livros, qnt_livros, editora_ideditora, capas_idcapas) VALUES (:nome_livros, 1, :editora_id, :capas_id)";
            $inserir_newlivro = $conexao->prepare($insert_newlivro);
            $inserir_newlivro->bindParam(':nome_livros', $nome_livros);
            $inserir_newlivro->bindParam(':editora_id', $editora_id_convert);
            $inserir_newlivro->bindParam(':capas_id', $capas_id_convert);
            $inserir_newlivro->execute();


            // Obtém o ID do livro inserido
            $id_livros_insert = $conexao->lastInsertId();

            // Insere os autores associados ao livro na tabela "livros_autor"
            $sql_livros_autor = "INSERT INTO livros_autor (livros_id, autor_id) VALUES (:livros_id, :autor_id)";
            $insert_livros_autor = $conexao->prepare($sql_livros_autor);
            $insert_livros_autor->bindParam(":livros_id", $id_livros_insert);

            /* echo '<pre>';
            var_dump($);
            echo '</pre>'; */


            foreach ($autores as $autor) {
                // Consulta o ID do autor com base no nome do autor
                $sql_autor = "SELECT idautor FROM autor WHERE nome_autor = :nome_autor";
                $convert_sql_autor = $conexao->prepare($sql_autor);
                $convert_sql_autor->bindParam(':nome_autor', $autor);
                $convert_sql_autor->execute();
                $result_consulta_autor = $convert_sql_autor->fetch(PDO::FETCH_ASSOC);
                $row_result_consulta_autor = $convert_sql_autor->rowCount();
        
                if ($row_result_consulta_autor > 0) {
                    $autor_id_convert = $result_consulta_autor['idautor'];
                } else {
                    die($_SESSION['err'] = "<p> Erro: autor não encontrado em nosso sistema! </p");
                }
        
                $insert_livros_autor->bindParam(":autor_id", $autor_id_convert);
                $insert_livros_autor->execute();
            }
            

            // Insere as categorias associadas ao livro na tabela "livros_categoria"
            $sql_livros_categoria = "INSERT INTO livros_categoria (livros_id, categoria_id) VALUES (:livros_id, :categoria_id)";
            $insert_livros_categoria = $conexao->prepare($sql_livros_categoria);
            $insert_livros_categoria->bindParam(":livros_id", $id_livros_insert);
            

            foreach ($categorias as $categoria) {

                $sql_categoria = "SELECT idcategoria FROM categoria WHERE nome_categoria = :nome_categoria";
                $convert_sql_categoria = $conexao->prepare($sql_categoria);
                $convert_sql_categoria->bindParam(':nome_categoria', $categoria);
                $convert_sql_categoria->execute();
                $result_consulta_categoria = $convert_sql_categoria->fetch(PDO::FETCH_ASSOC);
                $row_result_consulta_categoria = $convert_sql_categoria->rowCount();

                if ($row_result_consulta_categoria > 0) {
                    $categoria_id_convert = $result_consulta_categoria['idcategoria'];
                } else {
                    die($_SESSION['err'] = "<p> Erro: Categoria não encontrada em nosso sistema! </p");
                }

                $insert_livros_categoria->bindParam(":categoria_id", $categoria_id_convert);
                $insert_livros_categoria->execute();
            }


        }
    


    }

?>