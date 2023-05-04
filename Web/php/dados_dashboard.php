<?php


function obterDados()
{
    require_once '../lib/php/DB.class.php';
    $objDB = new DB();
    $objDB->connect();

    // Consulta os dados
    $results = $objDB->readAll('tb_fornecedor');

    // Armazena os dados em um array
    $dados = array();
    foreach ($results as $linha) {
        $dados[] = $linha;
    }
    // Retorna os dados no formato adequado para o gráfico
    return $dados;
}
