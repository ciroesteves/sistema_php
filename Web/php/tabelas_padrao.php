<<?php
require_once './navegador.php';
include 'gerador_de_tabelas.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Fazenda</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
  <?php
    gerar_tabela('tb_tipo_fornecedor', 'tipo', 'Tipo Fornecedores');
    gerar_tabela('tb_raca', 'raca', 'Raças');
    gerar_tabela('tb_vacina', 'vacina', 'Vacinas');
    gerar_tabela('tb_lote', 'nome', 'Lotes');
    ?>
</body>

<style>
    .container {
        max-height: 300px;
        overflow-y: auto;
    }   
</style>