<?php 

    include_once "../../templates/sistemas_php/config.php";
    

    $id_livro = $_GET['id'];

    $sql_select_get = "SELECT nome_livros, editora_ideditora, capas_idcapas FROM livros WHERE idlivros = :id_livro";
    $select_get_livro = $conexao->prepare($sql_select_get);
    $select_get_livro->bindParam(':id_livro', $id_livro);
    $select_get_livro->execute();

    $info_livro = $select_get_livro->fetch(PDO::FETCH_ASSOC);

    $nome_livro = $info_livro['nome_livros'];
    $id_editora = $info_livro['editora_ideditora'];
    $id_capa = $info_livro['capas_idcapas'];


    $sql_select_editora = "SELECT nome_editora FROM editora WHERE ideditora = :id_editora";
    $select_editora = $conexao->prepare($sql_select_editora);
    $select_editora->bindParam(':id_editora', $id_editora);
    $select_editora->execute();
    
    $editora = $select_editora->fetch(PDO::FETCH_ASSOC);
    $nome_editora = $editora['nome_editora'];

    $sql_select_capas = "SELECT local_capas FROM capas WHERE idcapas = :id_capas";
    $select_capas = $conexao->prepare($sql_select_capas);
    $select_capas->bindParam(':id_capas', $id_capa);
    $select_capas->execute();
    
    $capa = $select_capas->fetch(PDO::FETCH_ASSOC);
    $local_capa = $capa['local_capas'];


    $sql_select_autores = "SELECT autor_id FROM livros_autor WHERE livros_id = :livros_id";
    $select_autores = $conexao->prepare($sql_select_autores);
    $select_autores->bindParam(':livros_id', $id_livro, PDO::PARAM_INT);
    $select_autores->execute();
    $autores = $select_autores->fetchAll(PDO::FETCH_ASSOC);
    $nome_autor = '';
    foreach ($autores as $id_autor) {
        $autor_id = $id_autor['autor_id'];
        $sql_select_autor = "SELECT nome_autor FROM autor WHERE idautor = :idautor";
        $select_autor = $conexao->prepare($sql_select_autor);
        $select_autor->bindParam(':idautor', $autor_id, PDO::PARAM_INT);
        $select_autor->execute();
        
        $autor = $select_autor->fetchAll(PDO::FETCH_ASSOC);
        $nome_autor .= $autor[0]['nome_autor'] . ', ';
    }

    $sql_select_categorias = "SELECT categoria_id FROM livros_categoria WHERE livros_id = :livros_id";
    $select_categorias = $conexao->prepare($sql_select_categorias);
    $select_categorias->bindParam(':livros_id', $id_livro, PDO::PARAM_INT);
    $select_categorias->execute();
    $categorias = $select_categorias->fetchAll(PDO::FETCH_ASSOC);
    $nome_categoria = '';

    foreach ($categorias as $id_categoria) {
        $categoria_id = $id_categoria['categoria_id'];
        $sql_select_categoria = "SELECT nome_categoria FROM categoria WHERE idcategoria = :idcategoria";
        $select_categoria = $conexao->prepare($sql_select_categoria);
        $select_categoria->bindParam(':idcategoria', $categoria_id, PDO::PARAM_INT);
        $select_categoria->execute();
        
        $categoria = $select_categoria->fetchAll(PDO::FETCH_ASSOC);
        $nome_categoria .= $categoria[0]['nome_categoria'] . ', ';
    }




    



    /* $nome_autor = $info_livro[''];
    $nome_categoria = $info_livro[''];*/
    

    /* echo '<pre>';
        var_dump($categorias);
    echo '</pre>'; */









?>