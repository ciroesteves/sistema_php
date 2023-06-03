<?php
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

<body class="corpo">
  <?php
    echo "<span class='padrao'>";
    gerar_tabela('tb_tipo_fornecedor', 'tipo', 'Tipo Fornecedores', 'tipo_fornecedor.php');
    gerar_tabela('tb_raca', 'raca', 'Raças', 'raca.php');
    echo "</span>";
    echo "<span class='padrao'>";
    gerar_tabela('tb_vacina', 'vacina', 'Vacinas', 'vacina.php');
    gerar_tabela('tb_lote', 'lote', 'Lotes', 'lote.php');
    echo "</span>";
    ?>
</body>

<style>
    .table-container {
        width: 30%;
        height: 400px;
        overflow-y: scroll;
    }   

    .padrao {
      display: flex;
      justify-content: space-around;
      margin-top: 3%;
    }
</style>