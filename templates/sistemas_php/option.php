<?php
include_once 'config.php';

function fetchAndStoreData($table, $columnName, &$resultArray, $conexao){
    $select_query = "SELECT $columnName FROM $table ORDER BY $columnName";
    $stmt = $conexao->prepare($select_query);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($result as $row) {
        $resultArray[] = $row[$columnName];
    }
}

$nomes_das_editoras = array();
fetchAndStoreData("editora", "nome_editora", $nomes_das_editoras, $conexao);

$nomes_das_categorias = array();
fetchAndStoreData("categoria", "nome_categoria", $nomes_das_categorias, $conexao);

$nomes_dos_autores = array();
fetchAndStoreData("autor", "nome_autor", $nomes_dos_autores, $conexao);
?>