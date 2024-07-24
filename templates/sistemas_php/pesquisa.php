<?php 
    include_once 'config.php';

    if (isset($_GET['busca_livros'])) {

        $busca_livros = "%".trim($_GET['busca_livros'])."%";

        $busca_bd_livros = "SELECT idlivros, nome_livros, capas_idcapas FROM livros WHERE nome_livros LIKE :busca_livros ORDER BY nome_livros";

        $nome_livros = $conexao->prepare($busca_bd_livros);
        $nome_livros->bindParam(':busca_livros', $busca_livros, PDO::PARAM_STR);
        $nome_livros->execute();
        $resultados = $nome_livros->fetchAll(PDO::FETCH_ASSOC);
        

    } elseif (isset($_GET['busca_categoria'])) {

        $busca_categoria = trim($_GET['busca_categoria']);

        $select_categoria = "SELECT idcategoria FROM categoria WHERE nome_categoria = :busca_categoria";
        $pesq_categoria = $conexao->prepare($select_categoria);
        $pesq_categoria->bindParam(':busca_categoria', $busca_categoria, PDO::PARAM_STR);
        $pesq_categoria->execute();
        $id_categoria = $pesq_categoria->fetch(PDO::FETCH_ASSOC);

        
        $categoria_id = $id_categoria['idcategoria'];
        
        $sql_select_categorias = "SELECT livros_id FROM livros_categoria WHERE categoria_id = :id_categoria";
        $select_categorias = $conexao->prepare($sql_select_categorias);
        $select_categorias->bindParam(':id_categoria', $categoria_id, PDO::PARAM_INT);
        $select_categorias->execute();
        $id_livros_busca = $select_categorias->fetchAll(PDO::FETCH_ASSOC);

        


        $busca_bd_categoria = "SELECT idlivros, nome_livros, capas_idcapas FROM livros WHERE idlivros IN (" . implode(',', array_column($id_livros_busca, 'livros_id')) . ") ORDER BY nome_livros";

        $nome_categoria = $conexao->prepare($busca_bd_categoria);
        $nome_categoria->execute();
        $resultados = $nome_categoria->fetchAll(PDO::FETCH_ASSOC);


        
    
       
    
    } else {
        $busca_bd_geral = "SELECT idlivros, nome_livros, capas_idcapas FROM livros ORDER BY nome_livros";
        $geral = $conexao->prepare($busca_bd_geral);
        $geral->execute();
        
        $geral_livros = $geral->fetchAll(PDO::FETCH_ASSOC);
        
    }

    

    

?>

