<?php 

include_once '../../templates/sistemas_php/config.php';

try {
    $sql_select_livros = "SELECT idlivros, nome_livros, capas_idcapas FROM livros";
    $select_exibir = $conexao->query($sql_select_livros);

    /* $livros_armaz = ''; */ // Variável para armazenar o HTML dos livros
    $info_livro = $select_exibir->fetchAll(PDO::FETCH_ASSOC);
    
    $busca_categoria = "literatura";

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

        


        $busca_bd_categoria = "SELECT idlivros, nome_livros, capas_idcapas FROM livros WHERE idlivros IN (" . implode(',', array_column($id_livros_busca, 'livros_id')) . ")";

        $nome_categoria = $conexao->prepare($busca_bd_categoria);
        $nome_categoria->execute();
        $resultados = $nome_categoria->fetchAll(PDO::FETCH_ASSOC);

    /* echo '<pre>';
        var_dump($info_livro);
    echo '</pre>';

    echo '<pre>';
        var_dump($info_capa);
    echo '</pre>'; */


    $qnt_carrossel = 5;
    $qnt_livros = count($resultados);
    $max_divisoes = 2;
    shuffle($resultados);
    $livros_selecao = array_slice($resultados, 0, $qnt_carrossel * $max_divisoes);
    $livros_divididos = array_chunk($livros_selecao, $qnt_carrossel);
    

    $contador = 1;

    $livros_armaz = 'livros_armaz' . $contador; 
    foreach ($livros_divididos as $livro_selec) {

        

        foreach ($livro_selec as $livro_sep) {
           $livros_armaz = 'livros_armaz' . $contador; 

        $id_capas_dlivros = $livro_sep['capas_idcapas'];
        $sql_select_capa = "SELECT idcapas, local_capas FROM capas WHERE idcapas = :idcapas";
        $select_capa = $conexao->prepare($sql_select_capa);
        $select_capa->bindParam(':idcapas', $id_capas_dlivros);
        $select_capa->execute();

        $info_capa = $select_capa->fetch(PDO::FETCH_ASSOC);
        $local_capa = $info_capa['local_capas'];

        ${$livros_armaz} = '';
        ${$livros_armaz} .= '<div class="carouselImg">';
        ${$livros_armaz} .= '<img src="' . $local_capa . '" class="image">';
        ${$livros_armaz} .= '<div class="carouselText">';
        ${$livros_armaz} .= '<a href="../agendamento/index.php?id=' . $livro_sep['idlivros'] . '">' . $livro_sep['nome_livros'] . '</a>';
        ${$livros_armaz} .= '</div>';
        ${$livros_armaz} .= '</div>';

            $contador++;
        }
    
        
        
    }

    


} catch (PDOException $e) {
    // Lidar com erros de consulta
}


















?>