<?php 

include_once '../../templates/sistemas_php/config.php';

try {
    $sql_select_livros = "SELECT idlivros, nome_livros, capas_idcapas FROM livros";
    $select_exibir = $conexao->query($sql_select_livros);

    $livros_armaz = ''; // Variável para armazenar o HTML dos livros
    $info_livro = $select_exibir->fetchAll(PDO::FETCH_ASSOC);
    /* $info_livros = $info_livro[0]; */
    

    /* echo '<pre>';
        var_dump($info_livro);
    echo '</pre>';

    echo '<pre>';
        var_dump($info_capa);
    echo '</pre>'; */

    
    $qnt_carrossel = 5;
    $qnt_livros = count($info_livro);
    $max_divisoes = 2;
    /* shuffle($info_livro); */
    $livros_selecao = array_slice($info_livro, 0, $qnt_carrossel * $max_divisoes);

    /* echo '<pre>';
    var_dump($livros_selecao);
    echo '</pre>'; */

    $livros_divididos = array_chunk($livros_selecao, $qnt_carrossel);
    

    /* echo '<pre>';
    var_dump($livros_divididos);
    echo '</pre>'; */


    foreach ($livros_divididos as $divisao) {

        /* echo '<pre>';
        var_dump($divisao);
        echo '</pre>'; */

        $livros_armaz .= '<div class="swiper-slide">';
            /* $livros_armaz .= '<div class="project-img">'; */
            /* $livros_armaz .= '<div class="carouselImg">'; */

        foreach ($divisao as $livro_sep) {
            /* echo '<pre>';
            var_dump($livro_sep);
            echo '</pre>'; */

            /* echo $livro_sep['idlivros']; 
            

            echo ' ' . $livro_sep['nome_livros']; 

            echo ' id_capas: ' . $livro_sep['capas_idcapas'];
            echo '<br>'; */

            $livros_armaz .= 'id_livro: ' . $livro_sep['idlivros'];
            $livros_armaz .= ' nome_livro: ' . $livro_sep['nome_livros']; 
            $livros_armaz .= ' id_capa: ' . $livro_sep['capas_idcapas'];
            









            

            foreach ($livro_sep as $sep) {

                

                /* $id_capas_dlivros = $sep['capas_idcapas'];
                $sql_select_capa = "SELECT idcapas, local_capas FROM capas WHERE idcapas = :idcapas";
                $select_capa = $conexao->prepare($sql_select_capa);
                $select_capa->bindParam(':idcapas', $id_capas_dlivros);
                $select_capa->execute();

                $info_capa = $select_capa->fetch(PDO::FETCH_ASSOC);
                $local_capa = $info_capa['local_capas'];

                $livros_armaz .= '<img src="' . $local_capa . '" class="image">';
                $livros_armaz .= '<div class="carouselText">';
                $livros_armaz .= '<a href="../agendamento/index.php?id=' . $sep['idlivros'] . '">Ver mais de ' . $sep['nome_livros'] . '</a>'; */
                
                

            }

            /* $livros_armaz .= '</div>'; */
            /* $livros_armaz .= '</div>'; */
            /* $livros_armaz .= '</div>'; */
            $livros_armaz .= '</div>';

            
        }

        
        
        /* $livros_armaz .= '<div class="swiper-slide">';
        $livros_armaz .= '<div class="project-img">';
        $livros_armaz .= '<div class="carouselImg">';

        foreach ($divisao as $livro_sep) {

        $id_capas_dlivros = $livro_sep['capas_idcapas'];
        $sql_select_capa = "SELECT idcapas, local_capas FROM capas WHERE idcapas = :idcapas";
        $select_capa = $conexao->prepare($sql_select_capa);
        $select_capa->bindParam(':idcapas', $id_capas_dlivros);
        $select_capa->execute();

        $info_capa = $select_capa->fetch(PDO::FETCH_ASSOC);
        $local_capa = $info_capa['local_capas'];

        $livros_armaz .= '<img src="' . $local_capa . '" class="image">';
        $livros_armaz .= '<div class="carouselText">';
        $livros_armaz .= '<a href="../agendamento/index.php?id=' . $livro_sep['idlivros'] . '">Ver mais de ' . $livro_sep['nome_livros'] . '</a>';

        }

        $livros_armaz .= '</div>';
        $livros_armaz .= '</div>';
        $livros_armaz .= '</div>';
        $livros_armaz .= '</div>'; */

    }

    /* echo '<pre>';
    var_dump($info_livro);
    echo '</pre>'; */








    /* foreach ($info_livro as $livro_sep) {
        $id_capas_dlivros = $livro_sep['capas_idcapas'];
        $sql_select_capa = "SELECT idcapas, local_capas FROM capas WHERE idcapas = :idcapas";
        $select_capa = $conexao->prepare($sql_select_capa);
        $select_capa->bindParam(':idcapas', $id_capas_dlivros);
        $select_capa->execute();

        $info_capa = $select_capa->fetch(PDO::FETCH_ASSOC);
        $local_capa = $info_capa['local_capas'];

        $livros_armaz .= '<div class="carouselImg">';
        $livros_armaz .= '<img src="' . $local_capa . '" class="image">';
        $livros_armaz .= '<div class="carouselText">';
        $livros_armaz .= '<a href="../agendamento/index.php?id=' . $livro_sep['idlivros'] . '">Ver mais de ' . $livro_sep['nome_livros'] . '</a>';
        $livros_armaz .= '</div>';
        $livros_armaz .= '</div>';



        
    } */

    


} catch (PDOException $e) {
    // Lidar com erros de consulta
}


















?>