<?php 

    include_once "../../templates/sistemas_php/config.php";

    $sql_perfil_emprestimo = "SELECT usuario_idusuario, livros_idlivros, data_emprestimo, devolucao_emprestimo FROM emprestimo WHERE usuario_idusuario = :id_usuario";
    $perfil_emprestimo = $conexao->prepare($sql_perfil_emprestimo);
    $perfil_emprestimo->bindParam(':id_usuario', $id_usuario_log);
    $perfil_emprestimo->execute();

    $info_emprestimo = $perfil_emprestimo->fetch(PDO::FETCH_ASSOC);

    if (isset($info_emprestimo['usuario_idusuario'])) {


        $devolucao_emprestimo = $info_emprestimo['devolucao_emprestimo'];

        $info_id_livro = $info_emprestimo['livros_idlivros'];
        $info_id_usuario = $info_emprestimo['usuario_idusuario'];

        /* $sql_busca_usuario */
        $sql_busca_livro = "SELECT idlivros, nome_livros, capas_idcapas FROM livros WHERE idlivros = :id_livros";
        $busca_livro = $conexao->prepare($sql_busca_livro);
        $busca_livro->bindParam(':id_livros', $info_id_livro);
        $busca_livro->execute();

        $info_livro = $busca_livro->fetch(PDO::FETCH_ASSOC);

        $id_livro_emprestimo = $info_livro['idlivros'];
        $nome_livro_emprestimo = $info_livro['nome_livros']; 
        $id_capas_emprestimo = $info_livro['capas_idcapas'];

        $sql_busca_capa = "SELECT local_capas FROM capas WHERE idcapas = :id_capas";
        $busca_capa = $conexao->prepare($sql_busca_capa);
        $busca_capa->bindParam(':id_capas', $id_capas_emprestimo);
        $busca_capa->execute();

        $info_capa = $busca_capa->fetch(PDO::FETCH_ASSOC);
        $local_capa_emprestimo = $info_capa['local_capas'];


        $informacoes = "";

        $informacoes .= '<div class="box">';

        $informacoes .= '<h1>' . $nome_livro_emprestimo . '</h1>';
        $informacoes .= '<div class="divImg">';
        $informacoes .=     '<img src="' . $local_capa_emprestimo . '">';
        $informacoes .= '</div>';

        $informacoes .= '<p>Devolver dia: ' . $devolucao_emprestimo . '</p>';
        $informacoes .= '<a href="../agendamento/index.php?id=' . $id_livro_emprestimo . '" class="btn"> Visitar </a> ';
        $informacoes .= '</div>';



    }



?>