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
    echo "<div class='container col-3' style='width:1000px; display:flex-box;'>";
    gerar_tabela('tb_tipo_fornecedor', 'tipo', 'Tipo Fornecedores', 'cadastro_tipo_fornecedor.php');
    gerar_tabela('tb_raca', 'raca', 'Raças');
    echo "</div>";
    echo "<div class='container' style='width:400px; display:flex-box;'>";
    gerar_tabela('tb_vacina', 'vacina', 'Vacinas', 'cadastro_vacina.php');
    gerar_tabela('tb_lote', 'nome', 'Lotes');
    echo "</div>";
    ?>
</body>

<style>
    .table-container {
        height: 400px;
        overflow-y: scroll;
    }   
</style>