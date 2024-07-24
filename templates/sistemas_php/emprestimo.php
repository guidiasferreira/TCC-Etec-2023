<?php
    include_once 'config.php';

    /* try {
        $sql_info_livro = "SELECT nome_livro FROM livros WHERE idlivros = :id_livros";
        $select_livro = $conexao->prepare($sql_info_livro);
        $select_livro->bindParam(':id_livros', $livro_id_convert);
    } catch (PDOException ) {

    }
 */


    if (isset($_POST['agendar_livro']) && isset($_POST['nome_usuario']) && isset($_POST['telefone_usuario']) && isset($_POST['rg_usuario'])) {

        $nome_usuario = $_POST['nome_usuario'];
        $telefone_usuario = $_POST['telefone_usuario'];
        $rg_usuario = $_POST['rg_usuario'];
        
        $sql_verif_usuario = "SELECT idusuario, nome_usuario, rg_usuario, telefone_usuario FROM usuario WHERE idusuario = :idusuario AND nome_usuario = :nome_usuario";
        $verif_usuario = $conexao->prepare($sql_verif_usuario);
        $verif_usuario->bindParam(':idusuario', $id_usuario_log);
        $verif_usuario->bindParam(':nome_usuario', $nome_usuario);
        $verif_usuario->execute();


        $info_usuario = $verif_usuario->fetch(PDO::FETCH_ASSOC);

        $info_rg = $info_usuario['rg_usuario'];
        $info_tel = $info_usuario['telefone_usuario'];
        
        if (!isset($info_usuario['idusuario'])) {
            die ('Erro ao procurar usuário informado!');
        }

        $sql_verif_emprestimo = "SELECT usuario_idusuario FROM emprestimo WHERE usuario_idusuario = :id_usuario";
        $verif_emprestimo = $conexao->prepare($sql_verif_emprestimo);
        $verif_emprestimo->bindParam(':id_usuario', $id_usuario_log);
        $verif_emprestimo->execute();

        $verificacao = $verif_emprestimo->fetch(PDO::FETCH_ASSOC);
        
        if (isset($verificacao['usuario_idusuario'])) {
            die ('Erro, este usuário já se encontra com um livro emprestado!');
        }


        $sql_verif_livros = "SELECT nome_livros, qnt_livros FROM livros WHERE idlivros = :idlivros";
        $verif_livros = $conexao->prepare($sql_verif_livros);
        $verif_livros->bindParam(':idlivros', $id_livro);
        $verif_livros->execute();
        $livro = $verif_livros->fetch(PDO::FETCH_ASSOC);

        if  ($livro && $livro['qnt_livros'] > 0) {

            $data_emprestimo = date("Y-m-d");
            $devolucao_emprestimo = date("Y-m-d", strtotime("+7 days"));


            if  ($info_rg === null AND $info_tel === null) {

            $sql_update_info_usuario = "UPDATE usuario SET rg_usuario = :rg_usuario, telefone_usuario = :telefone_usuario WHERE idusuario = :id_usuario";
            $update_info_usuario = $conexao->prepare($sql_update_info_usuario);
            $update_info_usuario->bindParam(':rg_usuario', $rg_usuario);
            $update_info_usuario->bindParam(':telefone_usuario', $telefone_usuario);
            $update_info_usuario->bindParam(':id_usuario', $id_usuario_log);
            $update_info_usuario->execute();
        
            }

            $sql_insert_emprestimo = "INSERT INTO emprestimo (usuario_idusuario, livros_idlivros, data_emprestimo, devolucao_emprestimo) VALUES (:usuario_id, :livros_id, :data_emprestimo, :devolucao_emprestimo)";
            $insert_emprestimo = $conexao->prepare($sql_insert_emprestimo);
            $insert_emprestimo->bindParam(':usuario_id', $id_usuario_log);
            $insert_emprestimo->bindParam(':livros_id', $id_livro);
            $insert_emprestimo->bindParam(':data_emprestimo', $data_emprestimo);
            $insert_emprestimo->bindParam(':devolucao_emprestimo', $devolucao_emprestimo);
            $insert_emprestimo->execute();

            $sql_update_livro = "UPDATE livros SET qnt_livros = qnt_livros - 1 WHERE idlivros = :idlivros";
            $update_livro = $conexao->prepare($sql_update_livro);
            $update_livro->bindParam(':idlivros', $id_livro);
            $update_livro->execute();


        } else {
            echo "Este livro não está disponível para empréstimo";
        }


    }















































    //     $dados_log = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    //     if (!empty($dados_log['agendar_livro'])) {
    //         $disponivel = $dados_log['disponibilidade_livros'];
    //     }

        
    //     /* $dados_agend = ; */

    //     /* Função emprestar livros */
    // function emprestar_livros($idlivros) {

    //         /* Checar se tem disponibilidade */
    //         if ($disponivel === null) {
    //             $check = $conexao->prepare("SELECT * FROM livros WHERE id = :id AND disponibilidade_livros = 1");
    //             $check->bindParam(":id", $idlivros, PDO::PARAM_INT);
    //             $check->execute();
    //             $checked = $check->fetch(PDO::FETCH_ASSOC);
    //         }
    //         /* Registrar o livro como registrado */
    //         if ($checked) {
    //             $update = $conexao->prepare("UPDATE livros SET disponibilidade_livros = 0 WHERE id =:id");
    //             $update->bindParam(":id", $idlivros, PDO::PARAM_INT);
    //             $update->execute;

    //             $registro = $conexao->prepare("INSERT INTO emprestimo (idemprestimo, usuario_idusuario, livros_idlivros) VALUES (:idemprestimo, :usuario_idusuario, :livros_idlivros) ");
    //             $registro->bindParam(":idemprestimo", $dados_log['idemprestimo'], PDO::PARAM_INT);
    //             $registro->bindParam(":usuario_idusuario", $dados_log['usuario_idusuario'], PDO::PARAM_INT);
    //             $registro->bindParam(":livros_idlivros", $dados_log['livros_idlivros'], PDO::PARAM_INT);
    //             $registro->execute();

                
    //             $dados_log['info_emprestimo_usuario'] = $idlivros;
    //             $dados_log['data_emprestimo_usuario'] = $data_emprestimo_usuario;

    //             $disponivel_emprestimo = $dados_log['info_emprestimo_usuario'];
    //             $data_emprestimo = $dados_log['data_emprestimo_usuario'];
                
    //         }
    //     }

            
    //         function devolver_livros() {

    //         if ($disponivel_emprestimo !== null) {

    //             $data_emprestimo = date('Y-m-d');
    //             $data_emprestimo_limite = date('Y-m-d', strtotime($data_emprestimo . '+7 days'));

    //             if ($data_emprestimo <= $data_emprestimo_limite) {
    //                 // Atualizar o livro como disponível
    //                 $stmt = $pdo->prepare("UPDATE livros SET disponibilidade_livros = 1 WHERE idlivros = :idlivros");
    //                 $stmt->bindParam(':idlivros', $disponivel_emprestimo, PDO::PARAM_INT);
    //                 $stmt->execute();

    //                 // Remover o registro de empréstimo
    //                 $stmt = $pdo->prepare("DELETE FROM emprestimo WHERE usuario_idusuario = :usuario_idusuario AND livros_idlivros = :livros_idlivros");
    //                 $stmt->bindParam(':usuario_idusuario', $dados_log['idusuario'], PDO::PARAM_INT);
    //                 $stmt->bindParam(':livros_idlivros', $disponivel_emprestimo, PDO::PARAM_INT);
    //                 $stmt->execute();

    //                 $disponivel_emprestimo = null;
    //                 $data_emprestimo = null;
                    

    //                 }

    //             }
    
    //         }

?> 