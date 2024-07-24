<?php

    try {
        $sql_select_emprestimos = "SELECT usuario_idusuario, livros_idlivros, data_emprestimo, devolucao_emprestimo FROM emprestimo";
        $select_emprestimos = $conexao->query($sql_select_emprestimos);

        $emprestimos = $select_emprestimos->fetchAll(PDO::FETCH_ASSOC);

        foreach ($emprestimos as $emprestimo) {

            $id_usuario_emprestimo = $emprestimo['usuario_idusuario'];
            $id_livro_emprestimo = $emprestimo['livros_idlivros'];
            $data_emprestimo = $emprestimo['data_emprestimo'];
            $devolucao_emprestimo = $emprestimo['devolucao_emprestimo'];
        
        $sql_select_usuario_emprestimo = "SELECT nome_usuario, rg_usuario FROM usuario WHERE idusuario = :id_usuario";
        $select_usuario_emprestimo = $conexao->prepare($sql_select_usuario_emprestimo);
        $select_usuario_emprestimo->bindParam(':id_usuario', $id_usuario_emprestimo);
        $select_usuario_emprestimo->execute();
        
        $info_aluno = $select_usuario_emprestimo->fetch(PDO::FETCH_ASSOC);
        $nome_aluno = $info_aluno['nome_usuario'];
        $rg_aluno = $info_aluno['rg_usuario'];


        $sql_select_livro_emprestimo = "SELECT nome_livros FROM livros WHERE idlivros = :id_livros";
        $select_livro_emprestimo = $conexao->prepare($sql_select_livro_emprestimo);
        $select_livro_emprestimo->bindParam(':id_livros', $id_livro_emprestimo);
        $select_livro_emprestimo->execute();

        $info_livro = $select_livro_emprestimo->fetch(PDO::FETCH_ASSOC);
        $nome_livro = $info_livro['nome_livros'];

        $exibicao_emprestimo = "";

        $exibicao_emprestimo .= '<div class="box">' ;
        $exibicao_emprestimo .=    '<div class="column pessoa">' . $nome_aluno .  '  </div>' ;
        $exibicao_emprestimo .=    '<div class="column livro"> ' . $nome_livro .  ' </div>' ;
        $exibicao_emprestimo .=    '<div class="column data"> ' . $data_emprestimo .  ' </div>' ;
        $exibicao_emprestimo .=    '<div class="column devolucao"> ' . $devolucao_emprestimo . '</div>';
        $exibicao_emprestimo .=    '<div class="column rg"> ' . $rg_aluno .  ' </div>';
        $exibicao_emprestimo .= '</div>' ;

        }




    }
    catch (Exception $e) { }





?>